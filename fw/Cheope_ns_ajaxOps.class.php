<?
namespace Cheope_ns\fw;
require_once ("cheope_ns_reg.def.php");
require_once ("cheope_ns.fun.php");
require_once ("class.const.php");
require_once ("Xml_db_model.class.php");
require_once ("Interfaces_model.class.php");
require_once ("Interfaces_info.class.php");
require_once ("Xml_interface_file_analyzer.class.php");
require_once ("Xml_interface_serializer.class.php");
require_once ("AjaxOp.class.php");
require_once ("php_arrays.def.php");
require_once ("ric_sql_2.def.php");
require_once ("Parser.class.php");
require_once ("Html_data_interface.class.php");
require_once ("Cheope_ns_csv_table.class.php");
require_once ("cheope_ns_stdModules.def.php");
require_once ("PostSendInterfaceData_Classes.class.php");
require_once ("Cheope_ns_ajaxOps_ajaxOpSetAllCatalogInterfacesClasses.class.php");
require_once ("Cheope_ns_ajaxOps_ajaxOpSaveLayoutClasses.class.php");
require_once ("Creator.tra.php");

class AjaxOpJavascriptInjection extends AjaxOp {
	function __construct() {
		parent::__construct( AJAX_OP_JAVASCRIPT_INJECTION );
	}
    function exec_1(string $actId):array|string|bool|null
	{
	 session_start ();
     $ids = explode(VAR_SEP,$actId);
     $op = $ids[0];
     $num = $ids[1];
	 $javascriptCodeFileName = APPLICATION_NAME . Xml_interface_serializer::INTERFACE_NAME_SEP . Xml_interface_serializer::INTERFACE_NAME_SEP .
	 ucFirst(Interfaces_info::INT_JAVASCRIPT_CODE) . Xml_interface_serializer::INTERFACE_NAME_SEP . $op . Xml_interface_serializer::INTERFACE_NAME_SEP . $num;
     $javascriptCodeFilePath = THIS_DIR . DIR_SEP . INTERFACES_DIR . 
		DIR_SEP . $javascriptCodeFileName; 
     $interfaceSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$javascriptCodeFilePath);
		$interfaceSerializer->loadData ();
		$items = $interfaceSerializer->getItems ();
		$javascriptCode = $items["javascriptCode"];  
     return $javascriptCode;   		
	}
}	


class AjaxOpLocalization extends AjaxOp {
	function __construct() {
		parent::__construct( AJAX_OP_LOCALIZATION );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$ids = explode ( STRING_SEMICOLON, $actId );
		$locale = $ids [0];
		$localeFile = $ids [1];
		$appFileName = THIS_DIR . DIR_SEP . JSON_DIR . 
		DIR_SEP . $localeFile . FILE_NAME_ELEMENTS_SEP . JSON_SUFFIX;
		$jsonSerializer = Creator::create(getClassNameForCreate(Classes_info::JSON_SERIALIZER_CLASS),STRING_NULL,$appFileName);
		$jsonSerializer->loadData ();
		$items = $jsonSerializer->getItems ();
		$localizzazioni = $items;
		$item = array ();
		foreach ( $localizzazioni as $locale1 ) {
			if ($locale1 ["locale"] == $locale)
				$item = $locale1 ["items"];
		}
		return $item;
	}
}
class AjaxOpFileExists extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_FILE_EXISTS );
	}
	function exec_1(string $actId):array|string|bool|null
	{
		if(file_exists($actId))
		{
			return true; 
		}
		return false;
	}
}

class AjaxOpUnblockApp extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_UNBLOCK_APP );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$dir = PREVIOUS_DIR . DIR_SEP . $actId;
		$appFileName = $dir . DIR_SEP . "application" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
		if (is_file ( $appFileName )) {
			$xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$appFileName);
			$xmlSerializer->loadData ();
			$allItems = $xmlSerializer->getItems ();
			if ($allItems ["locked"] == "true") {
				$allItems ["locked"] = false;
				$allItems ["user"] = $_SESSION [SESSION_VAR_USER];
				$allItems ["password"] = $_SESSION [SESSION_VAR_PASSWORD];
				$xmlSerializer->loadItems ( $allItems );
				$xmlSerializer->saveData ();
				return true;
			} else
				return false;
		} else
			return false;
	}
}
class AjaxOpTestDir extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_TEST_DIR );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$ids = explode ( STRING_SEMICOLON, $actId );
		if (isset ( $_SESSION [SESSION_VAR_ACTIVE_APP] )) {
			$dir = PREVIOUS_DIR . DIR_SEP . $_SESSION [SESSION_VAR_ACTIVE_APP] . DIR_SEP . $ids [1];
			if (is_dir ( $dir ))
				return $actId;
			else
				return STRING_NULL;
		} else
			return STRING_NULL;
	}
}
class AjaxOpLogEnable extends AjaxOp{
	function __construct(){
		parent::__construct(AJAX_OP_LOG_ENABLE);
	}
	function exec_1(string $actId):array|string|bool|null{
	session_start();
	$appDir = APPLICATION_NAME;
	$logFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
    DIR_SEP . XML_DIR . DIR_SEP . LOG_FILE . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$logFileName);
   $xmlSerializer1->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP); 
   $xmlSerializer1->loadData();
   $allItems = $xmlSerializer1->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $sectionObj1 = $sectionsArray[1];
   $sectionArray = $sectionObj1->getItem();
   $defObj1 = $sectionArray[0];
   $defArray1 = $defObj1->getItem();
   $functionObj1 = $defArray1[0];
   $functionArray1 = $functionObj1->getItem();
   $argObj1 = $functionArray1[1];
   $stringObj1 = $argObj1->getItem();	
   $stringObj1->setItem($actId);
   $xmlSerializer1->loadItems($allItems);
   $xmlSerializer1->saveData();
   $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
   $logConstFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
    DIR_SEP . FW_DIR . DIR_SEP . strTolower(APPLICATION_NAME) . VAR_SEP . "log" .
   FILE_NAME_ELEMENTS_SEP . "const" .
   FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
   $fileDumper->setFileName($logConstFileName);
   $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
   $fileDumper->dump();
   return STRING_NULL;
}
}

class AjaxOpGetScrollData extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_SCROLL_DATA );
	}
	function exec_1(string $actId):array|string|bool|null {
		$row = getAllDataByQuery ( "Select * from " . OBJ_PROVA );
		return $row;
	}
}
class AjaxOpGetSheetData extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_SHEET_DATA );
	}
	function exec_1(string $actId):array|string|bool|null {
		$row = getExtendedUniqueRow ( OBJ_PROVA, FIELD_ID_PROVA, $actId );
		return $row;
	}
}
class AjaxOpGetFile extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_FILE );
	}
	function exec_1(string $actId):array|string|bool|null {
		$strFile = file ( $actId );
		$str = STRING_NULL;
		foreach ( $strFile as $ind => $val ) {
			$str .= $val;
		}
		return $str;
	}
}
class AjaxOpOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		$row = Array ();
		return $row;
	}
}
class AjaxOpOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		$row = getAllDataByQuery ( "Select * from " . OBJ_PROVA );
		return $row;
	}
}
class AjaxOpOp3 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_OP3 );
	}
	function exec_1(string $actId):array|string|bool|null {
		$row = getAllDataByQuery ( "Select * from " . OBJ_PROVA );
		return $row;
	}
}
class AjaxOpOp4 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_OP4 );
	}
	function exec_1(string $actId):array|string|bool|null {
	  $str = STRING_NULL;
		if(file_exists($actId))
		{
		 $strFile = file ( $actId );
		 foreach ( $strFile as $ind => $val ) 
			$str .= $val;
		}
		return $str;
	}
}
class AjaxOpOp5 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_OP5 );
	}
	function exec_1(string $actId):array|string|bool|null {
		$row = getAllDataByQuery ( "Select * from " . OBJ_PROVA );
		return $row;
	}
}
class AjaxOpOp6 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_OP6 );
	}
	function exec_1(string $actId):array|string|bool|null {
		$callBackFun = $_GET ["cucu"];
		return $callBackFun . "('" . $actId . "')";
	//    return $actId;
	}
}
class AjaxOpOp7 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_OP7 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return readFile ( 'Prova.html' );
	}
}
class AjaxOpSendFile extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SEND_FILE );
	}
	function exec_1(string $actId):array|string|bool|null {
		$fileName = $actId;
		$fileContents = stripslashes ( $_POST ['value'] );
		if (! ($handle = fopen ( $actId, "w" )))
			return false;
		if (! fwrite ( $handle, $fileContents ))
			return false;
		fclose ( $handle );
		return true;
	}
}
class AjaxOpGetDbObjsDefProps extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_DB_OBJS_DEF_PROPS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::getDbObjsDefProps ( $appName );
	}
}
class AjaxOpGetAllFieldsDefProps extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_ALL_FIELDS_DEF_PROPS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::getAllFieldsDefProps ( $appName, $actId );
	}
}

//
// Ritorna tutti i campi a
// partire dal nome della tabella.
//
class AjaxOpGetAllTableFields extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_ALL_TABLE_FIELDS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;		
		$retStruct = array ();
		$table = $GLOBALS["dbStructTree"]->getElementByAliasName ( $actId );
		$fields = $table->getFields ();
		$retStruct ["fields"] = $fields;
		return $retStruct;
	}
}

//
// Ritorna tutti i campi a
// partire dal nome dell'alias.
//
class AjaxOpGetAllAliasFields extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_ALL_ALIAS_FIELDS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;		
		$retStruct = array ();
		$alias = $GLOBALS["dbStructTree"]->getElementByAliasName ( $actId );
		$fields = $alias->getFields ();
		$retStruct ["fields"] = $fields;
		return $retStruct;
	}
}

//
// Ritorna tutti i campi a
// partire dal nome del module (xml o json).
//
class AjaxOpGetAllModuleFields extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_ALL_MODULE_FIELDS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$fileName = $actId;
		$retStruct = array ();
		$fields = array ();
		if (Xml_db_model::checkIfXmlModuleExists ( $appName, $fileName )) {
			$serializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$fileName );
			$xmlDir = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . XML_DIR;
			$serializer->setDir ( $xmlDir );
			$xmlNode = Creator::create(getClassNameForCreate(Classes_info::XML_NODE_CLASS),STRING_NULL,$serializer, $fileName ); 
			$fields = $xmlNode->getFields ();
		} elseif (Xml_db_model::checkIfJsonModuleExists ( $appName, $fileName )) {
			$serializer = Creator::create(getClassNameForCreate(Classes_info::JSON_SERIALIZER_CLASS),STRING_NULL,$fileName);
			$jsonDir = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . JSON_DIR;
			$serializer->setDir ( $jsonDir );
			$jsonNode = Creator::create(getClassNameForCreate(Classes_info::JSON_NODE_CLASS),STRING_NULL,$serializer,$fileName);//
			$fields = $jsonNode->getFields ();
		}
		$retStruct ["fields"] = $fields;
		return $retStruct;
	}
}

//
// Ritorna tutti i campi a
// partire dal nome della query.
//
class AjaxOpGetAllQueryFields extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_ALL_QUERY_FIELDS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;		
		$retStruct = array ();
		$query = $GLOBALS["dbQueriesContainer"]->getQuery ( $actId );
		$fields = $query->getFields ();
		$retStruct ["fields"] = $fields;
		return $retStruct;
	}
}
class AjaxOpGetAllBindFields extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_ALL_BIND_FIELDS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$retStruct = array ();
		$bindNodeType = Xml_db_model::getBindNodeType ( $appName, $actId );
		$bindNodeName = Xml_db_model::getBindNodeName ( $appName, $actId );
		
		if (($bindNodeType == "Table") || ($bindNodeType == "Alias"))
			$node = $GLOBALS["dbStructTree"]->getElementByAliasName ( $bindNodeName );
		elseif ($bindNodeType == "Query") {
			$node = $GLOBALS["dbQueriesContainer"]->getQuery ( $actId );
		}
		$fields = $node->getFields ();
		$retStruct ["fields"] = $fields;
		return $retStruct;
	}
}

//
// Imposta data una lista di tabelle i files 'db_objects_definition_def',
// 'tables_consts_def' , 'graph_definition_def'
// e 'binding_relations_to_objects_def'
//
class AjaxOpSetDbObjsDefProps extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_DB_OBJS_DEF_PROPS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		//var_dump ( $ids );
		return Xml_db_model::setDbObjsDefProps ( $appName, $ids );
	}
}

//
// L'aggiunta dei campi nella posizione data aggiorna i campi per quella data tabella
// in generale avr� dei doppioni che verranno eliminati sulla creazione del file
// di struttura globale db
//
class AjaxOpSetFieldsDefFieldsProps extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_FIELDS_DEF_FIELDS_PROPS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$ids = explode ( STRING_SEMICOLON, $actId );
		return Xml_db_model::setFieldsDefFieldsProps ( $appName, $ids );
	}
}
class AjaxOpSetFieldsConstsDef extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_FIELDS_CONSTS_DEF );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$ids = explode ( STRING_SEMICOLON, $actId );
		return Xml_db_model::setFieldsConstsDef ( $appName, $ids );
	}
}

//
// Rigenera tutti i campi e i tipi dei campi
// Aggiungendo anche le chiavi esterne.
//
class AjaxOpSetFieldsDef extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_FIELDS_DEF );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::setFieldsDef ( $appName, $actId );
	}
}

//
// Rigenera tutti i campi e i tipi dei campi non aggiungendo i campi chiavi esterne
//
class AjaxOpSetFieldsDefWithoutExtKeys extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_FIELDS_DEF_WITHOUT_EXT_KEYS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::setFieldsDefWithoutExtKeys ( $appName, $actId );
	}
}

//
// Richiamata dopo setDbObjsDefProps elimina le definizioni dei campi per le tabelle cancellate.
// Imposta il campo chiave di default per le tabelle nuove.
// Aggiorna anche fields_consts_def.
//
class AjaxOpSetFieldsDefAllFieldsProps extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_FIELDS_DEF_ALL_FIELDS_PROPS );
	}
	function exec_1(string $actId):array|string|bool|null {
		//echo "AJAX_OP_SET_FIELDS_DEF_ALL_FIELDS_PROPERTIES";
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::setFieldsDefAllFieldsProps ( $appName );
	}
}
class AjaxOpSetFieldsDefCandKeyFieldsProps extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_FIELDS_DEF_CAND_KEY_FIELDS_PROPS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		//echo $actId;
		$ids = explode ( STRING_SEMICOLON, $actId );
		$idsNum = count ( $ids );
		for($i = 1; $i <= $idsNum - 1; $i ++) {
			$candKey = explode ( STRING_COLON, $ids [$i] );
			$ids [$i] = $candKey;
		}
		//print_r ( $ids );
		return Xml_db_model::setFieldsDefCandKeyFieldsProps ( $appName, $ids );
	}
}
class AjaxOpSetFieldsDefExtKeyFieldsProps extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_FIELDS_DEF_EXT_KEY_FIELDS_PROPS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$ids = explode ( STRING_SEMICOLON, $actId );
		$idsNum = count ( $ids );
		for($i = 1; $i <= $idsNum - 1; $i ++) {
			$extItems = explode ( STRING_COLON, $ids [$i] );
			$ids [$i] = $extItems;
		}
		return Xml_db_model::setFieldsDefExtKeyFieldsProps ( $appName, $ids );
	}
}
class AjaxOpSet1NRelationsDefinitionProps extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_1N_RELATIONS_DEFINITION_PROPS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		//echo "Set1NRelationsDefinitionProps";
		//echo $actId;
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		//print_r ( $ids );
		return Xml_db_model::set1NRelations ( $appName, $ids );
	}
}
class AjaxOpGet1NRelations extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_1N_RELATIONS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::get1NRelations ( $appName, $actId );
	}
}
class AjaxOpGetMNRelations extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_MN_RELATIONS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::getMNRelations ( $appName, $actId );
	}
}
class AjaxOpSetMNRelationsDefinitionProps extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_MN_RELATIONS_DEFINITION_PROPS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		//echo "SetMNRelationsDefinitionProps";
		//echo $actId;
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		//print_r ( $ids );
		return Xml_db_model::setMNRelations ( $appName, $ids );
	}
}
class AjaxOpCheckIfIs1NRelationFather extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CHECK_IF_IS_1N_RELATION_FATHER );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::checkIfIs1NRelationFather ( $appName, $actId );
	}
}
class AjaxOpCheckIfIs1NRelationFatherOf extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CHECK_IF_IS_1N_RELATION_FATHER_OF );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		return Xml_db_model::checkIfIs1NRelationFatherOf ( $appName, $ids );
	}
}
class AjaxOpCheckIfIs1NRelation extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CHECK_IF_IS_1N_RELATION );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::checkIfIsIn1NRelation ( $appName, $actId );
	}
}
class AjaxOpCheckIfIsInRelation extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CHECK_IF_IS_IN_RELATION );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::checkIfIsInRelation ( $appName, $actId );
	}
}
class AjaxOpCheckIfExistMNRelationLinkTable extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CHECK_IF_EXIST_MN_RELATION_LINK_TABLE );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		return Xml_db_model::checkIfExistMNRelationLinkTable ( $appName, $ids );
	}
}
class AjaxOpGetFieldsDefProps extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_FIELDS_DEF_PROPS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::getFieldsDefProps ( $appName, $actId );
	}
}
class AjaxOpGetCandKeyFieldsProps extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_CAND_KEY_FIELDS_PROPS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::getCandKeyFieldsProps ( $appName, $actId );
	}
}
class AjaxOpGetExtKeyFieldsProps extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_EXT_KEY_FIELDS_PROPS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::getExtKeyFieldsProps ( $appName, $actId );
	}
}
class AjaxOpGetPkKeyField extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_PK_KEY_FIELD );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$keyFieldName = Xml_db_model::getPkField ( $appName, $actId );
		return $keyFieldName;
	}
}
class AjaxOpGetPkKeyByTableName extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_PK_KEY_BY_TABLE_NAME );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		//$ids = explode ( STRING_SEMICOLON, $actId );
		return Xml_db_model::getPkKeyByTableName ( $appName, $actId );
	}
}

//
// Quando cambio la pk in una tabella devo aggiornare le
// chiavi esterne in tutte le tabelle in relazione 1N.
//
class AjaxOpSetPk extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_PK );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		return Xml_db_model::setPk ( $appName, $ids );
	}
}
class AjaxOpCheckIfIsSuitablePkKey extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CHECK_IF_IS_SUITABLE_PK_KEY );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		return Xml_db_model::checkIfIsSuitablePkKey ( $appName, $ids );
	}
}
class AjaxOpCheckIfIsSuitableField extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CHECK_IF_IS_SUITABLE_FIELD );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		return Xml_db_model::checkIfIsSuitableField ( $appName, $ids );
	}
}
class AjaxOpCheckIfKeyCollides extends AjaxOp {
	function __constructs() {
		parent::__construct ( AJAX_OP_CHECK_IF_KEY_COLLIDES );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		return Xml_db_model::checkIfKeyCollides ( $appName, $ids );
	}
}
class AjaxOpCheckIfKeyCollidesWithSonsKeys extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CHECK_IF_KEY_COLLIDES_WITH_SONS_KEYS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		return Xml_db_model::checkIfKeyCollidesWithSonsKeys ( $appName, $ids );
	}
}

//
// Genera il file php di struttura della base dati.
//
class AjaxOpCreateDbStruct extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CREATE_DB_STRUCT );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appDir = $_SESSION [SESSION_VAR_ACTIVE_APP];
		//echo "WWWWW";
		if($appDir != STRING_NULL)
		{
         Xml_db_model::createDbStruct ( $appDir );			
		 return 'true';
	    }
		else
		 return 'false';
	}
	
}

class AjaxOpFixDbXmlFiles extends AjaxOp {
	function __construct(){
		parent::__construct(AJAX_OP_FIX_DB_XML_FILES);
	}
	
	function exec_1(string $actId):array|string|bool|null
	{
		$appDir = $_SESSION [SESSION_VAR_ACTIVE_APP];
		//echo "WWWWW";
		if($appDir != STRING_NULL)
		{
         $res = Xml_db_model::fixDbXmlFiles ( $appDir );			
		 return $res;
	    }
		else
		 return 'false';
	}
}

class AjaxOpPostSendInterfaceData extends AjaxOp {
	const ERROR_0 = "AjaxOpPostSendInterfaceData:" . MSG_59;
	const ERROR_1 = "AjaxOpPostSendInterfaceData:" . MSG_60;
	var $doc=null;
	var $appName=STRING_NULL;
	var $pageName=STRING_NULL;
	var $dir=STRING_NULL;
	var $dataFieldsDomains=array();
	
	function __construct() {
		parent::__construct ( AJAX_OP_POST_SEND_INTERFACE_DATA );
	}

	function setDataFieldsDomains(array $actDataFieldsDomains):void {
		$this->dataFieldsDomains = $actDataFieldsDomains;
	}
	function getDataFieldsDomains():array {
		return $this->dataFieldsDomains;
	}
	
	function exec_1(string $actId):array|string|bool|null {
		
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		if ((isset ( $_POST ["Nome_pagina"] )) && ($appName != STRING_NULL)) {			
			$pageName = $_POST ["Nome_pagina"];
			
			//
			// Controlla sintassi campi array
			//
			$mainPropsLevels = array ();
			foreach ( $_POST as $ind => $val ) {
				if (substr ( $ind, 0, 1 ) == STRING_CANCELLETTO) {
					// echo $val;
					$lex = Creator::create(getClassNameForCreate(Classes_info::LEXER_3_CLASS),STRING_NULL,STRING_NULL, $val);
					$lex->setRules ( $GLOBALS["phpArraysDefRules"] );
					$parser = Creator::create(getClassNameForCreate(Classes_info::PARSER_CLASS),STRING_NULL,$lex);
					$parser->setGrammarRulesContainer ( $GLOBALS["phpArraysDefGrRules"] );
					$propName = substr ( $ind, 1, strlen ( $ind ) - 1 );
					if (! $parser->exec ()) {
						echo $parser->getCurrentError () . STRING_SPACE . MSG_40 . STRING_SPACE . 
						STRING_SINGLE_QUOTE . $propName . STRING_SINGLE_QUOTE . "*_*" . $val;
						return STRING_NULL;
					}
					$grRule = $GLOBALS["phpArraysDefGrRules"]->getElement ( 0 );
					if (($propName == 'dataFields') || ($propName == 'dataFieldsDomains') || ($propName == 'dataFieldsDomainsValues')) {
						$mainPropsLevels [] = $grRule->getNumFirstLevelEls ();
						if (array_containDifferentValues ( $mainPropsLevels )) {
							echo MSG_41 . STRING_COLON . $propName . STRING_SPACE . MSG_42 . STRING_SPACE . $grRule->getNumFirstLevelEls () . STRING_SPACE . MSG_43 . STRING_POINT;
							return STRING_NULL;
						}
						$grRule->setNumFirstLevelEls ( 0 );
					} else
						$grRule->setNumFirstLevelEls ( 0 );
				}
			}
			$items = array ();
			
			$doc = Creator::create("DOMDocument",STRING_BACKSLASH,'1.0');
			$root = $doc->createElement ( Xml_interface_serializer::ROOT_TAG );
			$doc->appendChild ( $root );
			$nodeName = STRING_NULL;
			
			$oldIntName = $_POST["Nome_interfaccia"];
			unset($_POST["Nome_interfaccia"]);
	    $retVal = null;
			$nodeName = STRING_NULL;
			$flagObj=false;
			
			//
			// Ciclo generazione DOM.
			//
			foreach ( $_POST as $ind => $val ) {
			  $factory = Creator::create(getClassNameForCreate(Classes_info::POSTSENDINTERFACEDATA_FACTORY_CLASS),STRING_NULL,$ind,$val,$doc,$root);			  
				$branchObj = $factory->create($this,$appName,$pageName,$appXmlDir);
			  if(! is_null($branchObj))
				 $branchObj->exec($items);
				if ($ind=="obj")
				{
				 $flagObj = true;
				 $nodeName = $branchObj->getNodeName();	 	
			  }
			}
			$oldIntNameItems = explode(FILE_NAME_ELEMENTS_SEP,$oldIntName);
			$oldIntNameItemsNum = count($oldIntNameItems);
			if(($oldIntNameItemsNum==2)&&($oldIntNameItems[1]==XML_SUFFIX))
			 $intNameSuffix = FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
			else
			 $intNameSuffix = STRING_NULL;
			
			$dir = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . INTERFACES_DIR . DIR_SEP;
			if ((isset ( $_POST ["checkBox_IFreeName"] ) ? 
			(($_POST ["checkBox_IFreeName"] == "true") ? true : false) : false) && 
			($_POST ["shortName"] != STRING_NULL))
				$fileName = $_POST ["shortName"];
			elseif (! $flagObj)
				$fileName = $appName . Xml_interface_serializer::INTERFACE_NAME_SEP .
				$pageName . Xml_interface_serializer::INTERFACE_NAME_SEP . $items ["type"] .
				 Xml_interface_serializer::INTERFACE_NAME_SEP . $items ["op"] . 
				 Xml_interface_serializer::INTERFACE_NAME_SEP . $items ["num"] . $intNameSuffix;
			else
				$fileName = $appName . Xml_interface_serializer::INTERFACE_NAME_SEP . $pageName . 
				Xml_interface_serializer::INTERFACE_NAME_SEP . ($nodeName == "OBJ_NONE" ? STRING_NULL : $nodeName) . 
				Xml_interface_serializer::INTERFACE_NAME_SEP . $items ["type"] . 
				Xml_interface_serializer::INTERFACE_NAME_SEP . $items ["op"] . 
				Xml_interface_serializer::INTERFACE_NAME_SEP . $items ["num"] . $intNameSuffix;
			
			echo $dir . $fileName;
			$doc->formatOutput = true;
			$doc->save ( $dir . $fileName );
		}
	 return STRING_NULL;
	}
}
class AjaxOpCreateFile extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CREATE_FILE );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		if ($actId != STRING_NULL) {
			if (isset ( $_SESSION [SESSION_VAR_ACTIVE_APP] )) {
				$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
				if (isset ( $_SESSION [SESSION_VAR_DIR] )) {
					$appDir = $_SESSION [SESSION_VAR_DIR];
					$appFileName = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appDir . DIR_SEP . $actId;
				} else
					$appFileName = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $actId;
				
				if (! file_exists ( $appFileName )) {
					if ($handle = fopen ( $appFileName, "x+" )) {
						fclose ( $handle );
						echo MSG_12;
					}
				} else
					echo MSG_11;
			} else
				echo MSG_13;
		} else
			echo MSG_14;
	 return STRING_NULL;
	}
}
class AjaxOpDeleteFile extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_DELETE_FILE );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		if (isset ( $_SESSION [SESSION_VAR_ACTIVE_APP] )) {
			$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
			if (isset ( $_SESSION [SESSION_VAR_DIR] )) {
				$appDir = $_SESSION [SESSION_VAR_DIR];
				$appFileName = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appDir . DIR_SEP . $actId;
			} else
				$appFileName = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $actId;
			
			if (file_exists ( $appFileName )) {
				unlink ( $appFileName );
				echo MSG_15;
			} else
				echo MSG_16;
		} else
			echo MSG_17;
	 return STRING_NULL;
	}
}
class AjaxOpRenameFile extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_RENAME_FILE );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$items = explode ( STRING_SEMICOLON, $actId );
		if ((count ( $items ) == 2) && ($items [0] != STRING_NULL) && ($items [1] != STRING_NULL)) {
			if (isset ( $_SESSION [SESSION_VAR_ACTIVE_APP] )) {
				$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
				if (isset ( $_SESSION [SESSION_VAR_DIR] )) {
					$appDir = $_SESSION [SESSION_VAR_DIR];
					$appFileNameOld = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appDir . DIR_SEP . $items [0];
					$appFileNameNew = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appDir . DIR_SEP . $items [1];
				} else {
					$appFileNameOld = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $items [0];
					$appFileNameNew = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $items [1];
				}
				if (! (rename ( $appFileNameOld, $appFileNameNew )))
					echo MSG_18;
				else {
					echo MSG_19;
				}
			} else
				echo MSG_20;
		} else
			echo MSG_21;
	}
}
class AjaxOpCreatePage extends AjaxOp {
	const ERROR_0 = "AjaxOpCreatePage:" . MSG_61;
	const ERROR_1 = "AjaxOpCreatePage:" . MSG_22;
	const ERROR_2 = "AjaxOpCreatePage:" . MSG_27;
	function __construct() {
		parent::__construct ( AJAX_OP_CREATE_PAGE );
	}
	function exec_1(string $actId):array|string|bool|null {

		$dbStructTree = $GLOBALS["dbStructTreeLocal"];
		$dbQueriesContainer = $GLOBALS["dbQueriesContainerLocal"];
		$dbBindsContainer = $GLOBALS["dbBindsContainer"];
		
		// echo "******" . $actId . "***********";
		session_start ();
		$actIds = explode ( STRING_SEMICOLON, $actId );
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;		
		$ids = explode ( Xml_interface_serializer::INTERFACE_NAME_SEP, $actIds [0] );
			
		$shortName = STRING_NULL;
		if (count ( $ids ) == 6) {
			$nomePagina = $ids [1];
			$nomeOggettoDb = $ids [2];
			$tipoInterfaccia = $ids [3];
			$opInterfaccia = $ids [4];
			if ($opInterfaccia == STRING_NULL)
				$opInterfaccia = "OP_NONE";
			$numInterfaccia = $ids [5];
		  $numInterfacciaItems = explode(FILE_NAME_ELEMENTS_SEP,$numInterfaccia);
		  $numInterfacciaItemsNum = count($numInterfacciaItems);
		  if($numInterfacciaItemsNum ==2)
		   $numInterfaccia = $numInterfacciaItems[0];
		} elseif (count ( $ids ) == 1) {
			$shortName = $actIds [0];
			$intFreeFilePath = $appXmlDir . DIR_SEP . $actIds [0];
			$pageName = Xml_interface_file_analyzer::getScalarProperty ( $intFreeFilePath, "pageName" );
			$nomePagina = $pageName;
			$nomeOggettoDb = Xml_interface_file_analyzer::getScalarProperty ( $intFreeFilePath, "obj" );
			$nomeOggettoDbItems = explode ( STRING_POINT, $nomeOggettoDb );
			if ((count ( $nomeOggettoDbItems ) == 2) && ($nomeOggettoDbItems [1] == XML_SUFFIX))
				$nomeOggettoDb = OBJ_DATA_SOURCE;
			$tipoInterfaccia = Xml_interface_file_analyzer::getScalarProperty ( $intFreeFilePath, "type" );
			if($tipoInterfaccia == Interfaces_info::INT_HTML_FIELDSET_DECORATOR)
			 $decoratedObj =  Xml_interface_file_analyzer::getScalarProperty ( $intFreeFilePath, "decoratedObj" );
			else
			 $decoratedObj = null;
			$opInterfaccia = Xml_interface_file_analyzer::getScalarProperty ( $intFreeFilePath, "op" );
			if ($opInterfaccia == STRING_NULL)
				$opInterfaccia = "OP_NONE";
			$numInterfaccia = Xml_interface_file_analyzer::getScalarProperty ( $intFreeFilePath, "num" );
			$nomeOggettoDb = null;
		} elseif (count ( $ids ) == 5) {
			$intFreeFilePath = $appXmlDir . DIR_SEP . $actIds [0];
			$nomePagina = $ids [1];
			$nomeOggettoDb = null;
			$tipoInterfaccia = $ids [2];
			if($tipoInterfaccia == Interfaces_info::INT_HTML_FIELDSET_DECORATOR)
			 $decoratedObj =  Xml_interface_file_analyzer::getScalarProperty ( $intFreeFilePath, "decoratedObj" );
			else
			 $decoratedObj = null;
			$opInterfaccia = $ids [3];
			if ($opInterfaccia == STRING_NULL)
				$opInterfaccia = "OP_NONE";	
			$numInterfaccia = $ids [4];
		  $numInterfacciaItems = explode(FILE_NAME_ELEMENTS_SEP,$numInterfaccia);
		  $numInterfacciaItemsNum = count($numInterfacciaItems);
		  if($numInterfacciaItemsNum ==2)
		   $numInterfaccia = $numInterfacciaItems[0];
		} else
			die ( self::ERROR_0 );
		
		$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
		XML_DIR . DIR_SEP . "generic_application_template" . 
		FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
		$xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
		$xmlSerializer->loadData ();
		$allItems = $xmlSerializer->getItems ();
		
	  $scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		$scope1 = $scope . STRING_BACKSLASH . DB_NODE_CLASS;
		$scope2 = $scope . STRING_BACKSLASH . DB_QUERY_CLASS;
				
		// Creazione pagina applicativa
		
		$blockDefObj = $allItems [0];
		$blockDefArray = $blockDefObj->getItem ();
		$defObj1 = $blockDefArray [2];
		$defArray1 = $defObj1->getItem ();
		$functionCallObj1 = $defArray1 [0];
		$functionCallArray1 = $functionCallObj1->getItem ();
		$argObj1 = $functionCallArray1 [0];
		$exprObj1 = $argObj1->getItem ();
		$exprObj1->setItem ( "FRAMEWORK_PATH" . " . \"" . $appName . STRING_UNDERSCORE . 
		$nomePagina . STRING_UNDERSCORE . "op_page.class.php\"" );
		
		if (! is_null ( $nomeOggettoDb ) && ($nomeOggettoDb !== STRING_NULL) && ($nomeOggettoDb != OBJ_DATA_SOURCE)) 
		{
			$dbBind = $GLOBALS["dbBindsContainer"]->getElementByAliasName ( $nomeOggettoDb );
			$dbObj = $GLOBALS["dbStructTree"]->getElementByAliasName ( $nomeOggettoDb );
			$dbQuery = $GLOBALS["dbQueriesContainer"]->getQuery ( $nomeOggettoDb );
			if (! is_null ( $dbBind )) {
				$nodeType = "BINDING";
				if (is_a ( $dbBind, $scope1 )) {
					$containerName = "dbStructTree";
					$methodName = "getElementByAliasName";
				} elseif (is_a ( $dbBind, $scope2 )) {
					$containerName = "dbQueriesContainer";
					$methodName = "getQuery";
				} else {
					die ( "AjaxOpCreatePage:" . self::ERROR_2 );
				}
			} elseif (! is_null ( $dbObj )) {
				if ($dbObj->getAliasName () != $dbObj->getNodeName ())
					$nodeType = "ALIAS";
				else
					$nodeType = "TABELLA";
				$containerName = "dbStructTree";
				$methodName = "getElementByAliasName";
			} elseif (! is_null ( $dbQuery )) {
				$nodeType = "QUERY";
				$containerName = "dbQueriesContainer";
				$methodName = "getQuery";
			} else {
				die ( "AjaxOpCreatePage:" . self::ERROR_2 );
				return false;
			}
			$constObj = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$nodeType . CONST_SEP . $nomeOggettoDb);
			$argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj);
			$varObj = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$containerName);
			$methodCallObj = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL, array ($varObj,$argObj));
			$methodCallObj->setName ( $methodName );
			$varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbNode");
			$defObj21 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array ($varObj1,$methodCallObj));
			$blockDefArray [9] = $defObj21;
		} 
		else 
		{
			$varObj = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbNode");
			$exprItem = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"null");
			$defObj21 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array ($varObj,$exprItem ));
			$blockDefArray [9] = $defObj21;
		}
		$varObj = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"decoratedObj");
		$exprItem = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"null");
		$defObj21a = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL, array (
					$varObj,
					$exprItem 
			));
		$blockDefArray[10] = $defObj21a;
		$tipoInterfacciaItems = explode ( VAR_SEP, $tipoInterfaccia );
//		if ( (in_array('html',$tipoInterfacciaItems)|| (in_array('xml',$tipoInterfacciaItems))|| ($tipoInterfacciaItems [0] == APP_LANGUAGE))
		if ((strToLower($tipoInterfacciaItems [0]) == HTML_ACRONYM) || (in_array(XML_ACRONYM,$tipoInterfacciaItems))|| 
	($tipoInterfacciaItems [0] == APP_LANGUAGE) ||(in_array(Interfaces_info::INT_FCKEDITOR,$tipoInterfacciaItems)))
			$nomeCostruttore = $tipoInterfaccia;
//
// Le interfacce javascript non possono essere root interface.
//
		elseif ($tipoInterfacciaItems [0] != 'javascript')
			$nomeCostruttore = $appName . VAR_SEP . $tipoInterfaccia;
		else {
			die ( "AjaxOpCreatePage:" . self::ERROR_1 );
		}
		$defObj2 = $blockDefArray [11];
		$defArray2 = $defObj2->getItem ();
		$constructorCallObj1 = $defArray2 [1];
		$constructorCallObj1->setName ( ucFirst ( $nomeCostruttore ) );
		$constructorCallArray = $constructorCallObj1->getItem ();
		$newConstructorCallArray = array ();
		if (! is_null ( $nomeOggettoDb )) {
			 $argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
			if ($nomeOggettoDb == OBJ_NONE) {
				$constObj = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,'OBJ_NONE');
				$argObj->setItem ( $constObj );
			} elseif ($nomeOggettoDb == OBJ_DATA_SOURCE) {
				$constObj = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,'OBJ_DATA_SOURCE');
				$argObj->setItem ( $constObj );
			} else {
				$varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbNode");
				$argObj->setItem ( $varObj2 );
			}
			$newConstructorCallArray [0] = $argObj;
			$argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
			if ($opInterfaccia != "OP_NONE") {
				$stringObj = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$opInterfaccia);
				$argObj->setItem ( $stringObj );
			} else {
				$constObj = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$opInterfaccia);
				$argObj->setItem ( $constObj );
			}
			$newConstructorCallArray [1] = $argObj;
			$argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
			$constObj = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"NUM" . CONST_SEP . $numInterfaccia);
			$argObj->setItem ( $constObj );
			$newConstructorCallArray [2] = $argObj;
		} else {
		if($tipoInterfaccia=="html_fieldset_decorator")
		{
		 $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		 $exprItem = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"null");
		 $argObj1->setItem($exprItem);
		 $newConstructorCallArray[0] = $argObj1;
		 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		 if($opInterfaccia != "OP_NONE")
		  $opInterfacciaObj2 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$opInterfaccia);
		 else
		  $opIntrfacciaObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$opInterfaccia);
		 $argObj2->setItem ( $opInterfacciaObj2 );
		 $newConstructorCallArray [1] = $argObj2;
		 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		 $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"NUM" . CONST_SEP . $numInterfaccia);
		 $argObj2->setItem ( $constObj2 );
		 $newConstructorCallArray [2] = $argObj2;
		}
		else
		{
		 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		 if($opInterfaccia != "OP_NONE")
		  $opInterfacciaObj2 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$opInterfaccia);
		 else
		  $opInterfacciaObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$opInterfaccia);
		 $argObj2->setItem ( $opInterfacciaObj2 );
		 $newConstructorCallArray [0] = $argObj2;
		 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		 $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"NUM" . CONST_SEP . $numInterfaccia);
		 $argObj2->setItem ( $constObj2 );
		 $newConstructorCallArray [1] = $argObj2;
		}
	  }
		$constructorCallObj1->setItem ( $newConstructorCallArray );
		
		$defObj3a = $blockDefArray [12];
		$defArray3a = $defObj3a->getItem ();
		$methodCallObj = $defArray3a [0];
		$methodCallArray = $methodCallObj->getItem ();
		$argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		$constObj  = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"NUM" . CONST_SEP . $numInterfaccia);
		$argObj->setItem ( $constObj );
		$methodCallArray [1] = $argObj;
		$methodCallObj->setItem ( $methodCallArray );
		
		$defObj31 = $blockDefArray [13];
		$defArray31 = $defObj31->getItem ();
		$methodCallObj31 = $defArray31 [0];
		$methodCallArray31 = $methodCallObj31->getItem ();
		$argObj31 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		$constObj31 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$shortName);
		$argObj31->setItem ( $constObj31 );
		$methodCallArray31 [1] = $argObj31;
		$methodCallObj31->setItem ( $methodCallArray31 );
		
		$defObj3 = $blockDefArray [15];
		$defArray3 = $defObj3->getItem ();
		$methodCallObj = $defArray3 [0];
		$methodCallArray = $methodCallObj->getItem ();
		$argObj = $methodCallArray [1];
		$stringObj = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS));
		$stringObj->setItem ( THIS_DIR . DIR_SEP . XML_DIR . DIR_SEP );
		$stringObj->setType ( String_item::DOUBLE_QUOTED );
		$argObj->setItem ( $stringObj );
		
		$defObj31 = $blockDefArray [16];
		$defArray31 = $defObj31->getItem ();
		$methodCallObj = $defArray31 [0];
		$methodCallArray = $methodCallObj->getItem ();
		$argObj = $methodCallArray [1];
		$stringObj = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS));
		$stringObj->setItem ( THIS_DIR . DIR_SEP . INTERFACES_DIR . DIR_SEP );
		$stringObj->setType ( String_item::DOUBLE_QUOTED );
		$argObj->setItem ( $stringObj );
		
		$defObj4 = $blockDefArray [18];
		$defArray4 = $defObj4->getItem ();
		$methodCallObj = $defArray4 [0];
		$methodCallArray = $methodCallObj->getItem ();
		$argObj = $methodCallArray [1];
		$stringObj = $argObj->getItem ();
		$stringObj->setItem ( $appName );
		
		$defObj5 = $blockDefArray [20];
		$defArray5 = $defObj5->getItem ();
		$constructorCallObj2 = $defArray5 [1];
		$constructorCallObj2->setName ( $appName . VAR_SEP . $nomePagina . VAR_SEP . "op_page" );

        //die('WWWWWW');
        /*$serializer=Creator::create("Xml_interface_serializer");
        $serializer->setInterpolateConsts(true);
        //$serializer->setInterfacesContainer($interfacesContainer);
        $serializer->setDbStruct($dbStructTree);
        $serializer->setDbQueries($dbQueriesContainer);
        $serializer->setXmlDir("./xml/");
        $serializer->setInterfacesDir("./interfaces/");
        //$serializer->setPageName(DEFAULT_PAGE_NAME);
        $page = Creator::create($appName . VAR_SEP . $nomePagina . VAR_SEP . "op_page");
        $page->setSerializer($serializer);
        $page->serializer_loadData("Cheope_ns");
        $page->unserialize();*/
		$dojoEnabled = ($actIds [2]=='0')?"false":"true";
		
		
		$defObj10 = $blockDefArray [22];
		$defArray10 = $defObj10->getItem ();
		$methodCallObj = $defArray10 [0];
		$methodCallArray = $methodCallObj->getItem ();
		$argObj = $methodCallArray [1];
		$stringObj = $argObj->getItem ();
		$stringObj->setItem ( $appName );
		
		// Scrive le opzioni pagina.
		
		$defObj6 = $blockDefArray [27];
		$defArray6 = $defObj6->getItem ();
		$methodCallObj1 = $defArray6 [0];
		$methodCallArray1 = $methodCallObj1->getItem ();
		$argObj = $methodCallArray1 [1];
		$stringObj = $argObj->getItem ();
		if ($actIds [1] === '0')
			$stringObj->setItem ( 'false' );
		else
			$stringObj->setItem ( 'true' );
		
		$defObj7 = $blockDefArray [28];
		$defArray7 = $defObj7->getItem ();
		$methodCallObj2 = $defArray7 [0];
		$methodCallArray2 = $methodCallObj2->getItem ();
		$argObj = $methodCallArray2 [1];
		$stringObj = $argObj->getItem ();
		if ($actIds [2] === '0')
			$stringObj->setItem ( 'false' );
		else
			$stringObj->setItem ( 'true' );
		
		$defObj8 = $blockDefArray [29];
		$defArray8 = $defObj8->getItem ();
		$methodCallObj3 = $defArray8 [0];
		$methodCallArray3 = $methodCallObj3->getItem ();
		$argObj = $methodCallArray3 [1];
		$stringObj = $argObj->getItem ();
		if ($actIds [3] === '0')
			$stringObj->setItem ( 'false' );
		else
			$stringObj->setItem ( 'true' );
			
			// Scrive le operazioni ajax.
		
		$ajaxOps = array ();
		
		if (isset ( $_POST [FIELD_AJAXOPS] ) && ($_POST [FIELD_AJAXOPS] != STRING_NULL)) {
			$ajaxOpsStr = $_POST [FIELD_AJAXOPS];
			eval ( "\$ajaxOps = $ajaxOpsStr;" );
			$ajaxOpsNum = count ( $ajaxOps );
			$defArray9 = array ();
			$functionCallArray8 = array ();
			$i = 0;
			foreach ( $ajaxOps as $val ) {
				if ((trim ( $val ) != STRING_NULL) && (! defined ( $val ))) {
					$constName = strToUpper ( separateStringItems ( $val ) );
					$constObj = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"AJAX_OP" . $constName);
					$argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj);
					$functionCallArray8 [$i ++] = $argObj;
				} elseif (defined ( $val )) {
					$constObj = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$val);
					$argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj);
					$functionCallArray8 [$i ++] = $argObj;
				}
			}
			$functionCallObj8 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$functionCallArray8);
			$functionCallObj8->setName ( "array" );
			$varObj = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"ajaxOps");
			$defArray9 [0] = $varObj;
			$defArray9 [1] = $functionCallObj8;
			$defObj9 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray9);
			$blockDefArray [30] = $defObj9;
			
			$varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"page");
			$varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"ajaxOps");
			$argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj2);
			$methodCallArray4 = array (
					$varObj1,
					$argObj 
			);
			$methodCallObj4 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray4);
			$methodCallObj4->setName ( "setAjaxOps" );
			$defArray10 = array ();
			$defArray10 [0] = $methodCallObj4;
			$defObj10 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray10);
			$blockDefArray [31] = $defObj10;
			
			$varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"page");
			$methodCallArray5 = array (
					$varObj3 
			);
			$methodCallObj5 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray5);
			$methodCallObj5->setName ( "putData" );
			$defArray11 = array ();
			$defArray11 [0] = $methodCallObj5;
			$defObj11 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray11);
			$blockDefArray [32] = $defObj11;
		} else {
			$varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"page");
			$methodCallArray4 = array (
					$varObj1 
			);
			$methodCallObj4 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray4);
			$methodCallObj4->setName ( "putData" );
			$defArray11 = array ();
			$defArray11 [0] = $methodCallObj4;
			$defObj11 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray11);
			$blockDefArray [30] = $defObj11;
			if (isset ( $blockDefArray [31] ))
				unset ( $blockDefArray [31] );
			if (isset ( $blockDefArray [32] ))
				unset ( $blockDefArray [32] );
		}
		
		$blockDefObj->setItem ( $blockDefArray );
		$xmlSerializer->loadItems ( $allItems );
		$xmlSerializer->saveData ();
		
		$applicationPageFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
		$nomePagina . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
		
		$fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
		$fileDumper->setFileName ( $applicationPageFileName );
		$fileDumper->setFileOpenType ( File_dumper::OPEN_FILE_FOR_OVERWRITE );
		$fileDumper->dump ();
		echo MSG_24 . STRING_RETURN . STRING_LINE_FEED;
		
		// Caricamento interfacce
		
		if ($actIds [4] !== '0') {
			$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . DIR_SEP . 
			"generic_op_page_template" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
			$xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
			$xmlSerializer2->loadData ();
			$allItems = $xmlSerializer2->getItems ();
			
			$blockDefObj = $allItems [0];
			$blockDefArray = $blockDefObj->getItem ();			
			$defObj4 = $blockDefArray [2];
			$defArray4 = $defObj4->getItem ();
			$functionCallObj4 = $defArray4 [0];
			$functionCallArray4 = $functionCallObj4->getItem ();
			$argObj4 = $functionCallArray4 [0];
			$stringObj4 = $argObj4->getItem ();
			$stringObj4->setItem ( $appName . STRING_UNDERSCORE . "page" . 
			FILE_NAME_ELEMENTS_SEP . "class" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj2 = $blockDefArray [3];
			$defArray2 = $defObj2->getItem ();
			$functionCallObj2 = $defArray2 [0];
			$functionCallArray2 = $functionCallObj2->getItem ();
			$argObj2 = $functionCallArray2 [0];
			$stringObj2 = $argObj2->getItem ();
			$stringObj2->setItem ( strToLower ( $appName ) . STRING_UNDERSCORE . "db_struct" . 
			FILE_NAME_ELEMENTS_SEP . "def" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj3 = $blockDefArray [4];
			$defArray3 = $defObj3->getItem ();
			$functionCallObj3 = $defArray3 [0];
			$functionCallArray3 = $functionCallObj3->getItem ();
			$argObj3 = $functionCallArray3 [0];
			$stringObj3 = $argObj3->getItem ();
			$stringObj3->setItem ( strToLower ( $appName ) . STRING_UNDERSCORE . "db_queries" . 
			FILE_NAME_ELEMENTS_SEP . "def" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj4 = $blockDefArray [5];
			$defArray4 = $defObj4->getItem ();
			$functionCallObj4 = $defArray4 [0];
			$functionCallArray4 = $functionCallObj4->getItem ();
			$argObj4 = $functionCallArray4 [0];
			$stringObj4 = $argObj4->getItem ();
			$stringObj4->setItem ( strToLower ( $appName ) . STRING_UNDERSCORE . "db_connections" . 
			FILE_NAME_ELEMENTS_SEP . "def" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj5 = $blockDefArray [6];
			$defArray5 = $defObj5->getItem ();
			$functionCallObj5 = $defArray5 [0];
			$functionCallArray5 = $functionCallObj5->getItem ();
			$argObj5 = $functionCallArray5 [0];
			$stringObj5 = $argObj5->getItem ();
			$stringObj5->setItem ( strToLower ( $appName ) . STRING_UNDERSCORE . "db_binds" . 
			FILE_NAME_ELEMENTS_SEP . "def" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj6 = $blockDefArray [7];
			$defArray6 = $defObj6->getItem ();
			$functionCallObj6 = $defArray6 [0];
			$functionCallArray6 = $functionCallObj6->getItem ();
			$argObj6 = $functionCallArray6 [0];
			$stringObj6 = $argObj6->getItem ();
			$stringObj6->setItem ( $nomeCostruttore . FILE_NAME_ELEMENTS_SEP . "class" . 
			FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj7 = $blockDefArray [8];
			$defArray7 = $defObj7->getItem ();
			$functionCallObj7 = $defArray7 [0];
			$functionCallArray7 = $functionCallObj7->getItem ();
			$argObj7 = $functionCallArray7 [1];
			$stringObj7 = $argObj7->getItem ();
			$stringObj7->setItem ( $nomePagina );
			
			$defObj8 = $blockDefArray [9];
			$defArray8 = $defObj8->getItem ();
			$functionCallObj8 = $defArray8 [0];
			$functionCallArray8 = $functionCallObj8->getItem ();
			$argObj8 = $functionCallArray8 [1];
			$stringObj8 = $argObj8->getItem ();
			$stringObj8->setItem ( $nomePagina . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$classDefObj = $blockDefArray [10];
			//var_dump(get_class($classDefObj));
			//var_dump($classDefObj);
			$classDefObj->setName ( $appName . VAR_SEP . $nomePagina . VAR_SEP . "op_page" );
			$classDefObj->setExtendsClass ( $appName . VAR_SEP . "page" );
			
			//$blockDefObj1 = $classDefObj->getItem();
		    //var_dump(get_class($blockDefObj1));
			//var_dump($blockDefObj1);
			//$blockDefArray1 = $blockDefObj1->getItem();
			//$functionDefObj1 = $blockDefArray1[0];
			//$functionDefObj1->setRetType("void");
		    //var_dump(get_class($functionDefObj1));
			//var_dump($functionDefObj1);			
			$blockDefObj->setItem ( $blockDefArray );
			//print_r($blockDefArray);
			$xmlSerializer2->loadItems ( $allItems );
			$xmlSerializer2->saveData ();
			
			$dataPageFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
			FRAMEWORK_DIR . DIR_SEP . $appName . VAR_SEP . $nomePagina . 
			VAR_SEP . "op_page" . FILE_NAME_ELEMENTS_SEP . "class" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;

			if($dojoEnabled=="false")
			{
			 $xblockDefObj1 = $classDefObj->getItem();
			 $xblockDefArray1 = $xblockDefObj1->getItem();
			 $xfunctionDefObj1 = $xblockDefArray1[1];
			 $xfunctionDefArray1 = $xfunctionDefObj1->getItem();
			 $xblockDefObj2 = $xfunctionDefArray1[1];
			 $xblockDefArray2 = $xblockDefObj2->getItem();
			 $newXBlockDefArray2 = array($xblockDefArray2[0]);
			 $xblockDefObj2->setItem($newXBlockDefArray2);			 
			
			 $xfunctionDefObj2 = $xblockDefArray1[2]; 
			 $xfunctionDefArray2 = $xfunctionDefObj2->getItem();
			 $xblockDefObj3 = $xfunctionDefArray2[1];
			 $xblockDefArray3 = $xblockDefObj3->getItem();			 
			 $newXBlockDefArray3 = array($xblockDefArray3[0]);
			 $xblockDefObj3->setItem($newXBlockDefArray3);
			}
			
			$fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
			$fileDumper->setFileName ( $dataPageFileName );
			$fileDumper->setFileOpenType ( File_dumper::OPEN_FILE_FOR_OVERWRITE );
			$fileDumper->dump ();
			echo MSG_25 . STRING_RETURN . STRING_LINE_FEED;
		}
		if ($actIds [5] !== '0') {
			$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
			XML_DIR . DIR_SEP . "generic_javascript_ajaxop_handler_template" . 
			FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
			$xmlSerializer3 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
			$xmlSerializer3->loadData ();
			$allItems = $xmlSerializer3->getItems ();
			
			$blockDefObj1 = $allItems [0];
			$blockDefArray1 = array ();
			
			$i = 0;
			foreach ( $ajaxOps as $val ) {
				$stringObj0 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,"actName");
				$stringObj0->setType ( String_item::NO_QUOTED );
				$argObj0 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj0);
				$argListArray = array ();
				$argListArray [0] = $argObj0;
				$argsListObj = Creator::create(getClassNameForCreate(Classes_info::ARGS_LIST_ITEM_CLASS),STRING_NULL,$argListArray);
				
				$functionName = "Op" . $val;
				$codeObj1 = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"actXmlMsg");
				$codeObj2 = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"alert(actXmlMsg);");
                $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$codeObj1); 
				
				$functionDefArray = array ();
				$functionDefArray [0] = $argObj1;
				$functionDefArray [1] = $codeObj2;
				$functionDefObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_DEF_ITEM_CLASS),STRING_NULL,$functionDefArray);
				$functionDefObj->setName ( STRING_NULL );
				
				$stringObj3 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,"this.exec");
				$stringObj3->setType ( String_item::NO_QUOTED );
				$defArray1 [0] = $stringObj3;
				$defArray1 [1] = $functionDefObj;
				$defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray1);
				
				$stringObj4 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,"actName");
				$stringObj4->setType ( String_item::NO_QUOTED );
				$stringObj5 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,"this.name");
				$stringObj5->setType ( String_item::NO_QUOTED );
				$defArray2 = array ();
				$defArray2 [0] = $stringObj5;
				$defArray2 [1] = $stringObj4;
				$defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray2);
				
				$blockDefArray3 = array ();
				$blockDefArray3 [0] = $defObj2;
				$blockDefArray3 [1] = $defObj1;
				$blockDefObj3 = Creator::create(getClassNameForCreate(Classes_info::BLOCK_DEF_ITEM_CLASS),STRING_NULL,$blockDefArray3);
				
				$functionDefArray1 = array ();
				$functionDefArray1 [0] = $argsListObj;
				$functionDefArray1 [1] = $blockDefObj3;
				$functionDefObj1 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_DEF_ITEM_CLASS),STRING_NULL,$functionDefArray1);
				$functionDefObj1->setName ( $functionName );
				
				$blockDefArray1 [$i ++] = $functionDefObj1;
			}
			$blockDefObj1->setItem ( $blockDefArray1 );
			$xmlSerializer3->loadItems ( $allItems );
			$xmlSerializer3->saveData ();
			
			$javascriptAjaxOpsHandlerFileName = PREVIOUS_DIR . DIR_SEP . 
			$appDir . DIR_SEP . JAVASCRIPT_DIR . DIR_SEP . strToLower ( $appName ) . 
			VAR_SEP . $nomePagina . VAR_SEP . "ajaxHandler" . 
			FILE_NAME_ELEMENTS_SEP . JAVASCRIPT_ACRONYM;
			
			$fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
			$fileDumper->setFileName ( $javascriptAjaxOpsHandlerFileName );
			$fileDumper->setFileOpenType ( File_dumper::OPEN_FILE_FOR_OVERWRITE );
			$fileDumper->dump ();
			echo MSG_26 . STRING_RETURN . STRING_LINE_FEED;
		}
		echo MSG_23;
		return STRING_NULL;
	}
}

//
// Preview generico
//
class AjaxOpCreatePreview extends AjaxOp {
	const ERROR_0 = "AjaxOpCreatePreview:" . MSG_61;
	const ERROR_1 = "AjaxOpCreatePreview:" . MSG_22;
	const ERROR_2 = "AjaxOpCreatePreview:" . MSG_27;
	const ERROR_3 = "AjaxOpCreatePreview:" . MSG_53;
	function __construct() {
		parent::__construct ( AJAX_OP_CREATE_PREVIEW );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$dbStructTree = $GLOBALS["dbStructTreeLocal"];
		$dbQueriesContainer = $GLOBALS["dbQueriesContainerLocal"];
		$dbBindsContainer = $GLOBALS["dbBindsContainer"];
		$actIds = explode ( STRING_SEMICOLON, $actId );
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
				
		$ids = explode ( Xml_interface_serializer::INTERFACE_NAME_SEP, $actIds [0] );
		 
		$nomePagina = "preview";
		$shortName = STRING_NULL;

		if (count ( $ids ) == 6) {
			$nomeOggettoDb = $ids [2];
			$tipoInterfaccia = $ids [3];
			$opInterfaccia = $ids [4];
			if ($opInterfaccia == STRING_NULL)
				$opInterfaccia = "OP_NONE";
			$numInterfaccia = $ids [5];
		  $numInterfacciaItems = explode(FILE_NAME_ELEMENTS_SEP,$numInterfaccia);
		  $numInterfacciaItemsNum = count($numInterfacciaItems);
		  if($numInterfacciaItemsNum ==2)
		   $numInterfaccia = $numInterfacciaItems[0];			
			if ($numInterfaccia == STRING_NULL)
				$numInterfaccia = "0";
			$pageName = $ids [1];
		} elseif (count ( $ids ) == 1) {
			$shortName = $actIds [0];
			$intFreeFilePath = $appXmlDir . DIR_SEP . $shortName;
			$pageName = Xml_interface_file_analyzer::getScalarProperty ( $intFreeFilePath, "pageName" );
			$pageName = (($pageName==false)?STRING_NULL:$pageName);
			$nomeOggettoDb = Xml_interface_file_analyzer::getScalarProperty ( $intFreeFilePath, "obj" );
			$nomeOggettoDbItems = explode ( STRING_POINT, $nomeOggettoDb );
			if ((count ( $nomeOggettoDbItems ) == 2) && ($nomeOggettoDbItems [1] == XML_SUFFIX))
				$nomeOggettoDb = OBJ_DATA_SOURCE;
			$tipoInterfaccia = Xml_interface_file_analyzer::getScalarProperty ( $intFreeFilePath, "type" );
			$opInterfaccia = Xml_interface_file_analyzer::getScalarProperty ( $intFreeFilePath, "op" );
			if ($opInterfaccia == STRING_NULL)
				$opInterfaccia = "OP_NONE";
			$numInterfaccia = Xml_interface_file_analyzer::getScalarProperty ( $intFreeFilePath, "num" );
			if ($nomeOggettoDb !== false) {
				if ($nomeOggettoDb == "OBJ_NONE")
					$nomeOggettoDb = STRING_NULL;
			} else
				$nomeOggettoDb = null;
		} elseif (count ( $ids ) == 5) {
			$nomeOggettoDb = null;
			$tipoInterfaccia = $ids [2];
			$opInterfaccia = $ids [3];
			if ($opInterfaccia == STRING_NULL)
				$opInterfaccia = "OP_NONE";
			$numInterfaccia = $ids [4];
		  $numInterfacciaItems = explode(FILE_NAME_ELEMENTS_SEP,$numInterfaccia);
		  $numInterfacciaItemsNum = count($numInterfacciaItems);
		  if($numInterfacciaItemsNum ==2)
		   $numInterfaccia = $numInterfacciaItems[0];
			if ($numInterfaccia == STRING_NULL)
				$numInterfaccia = "0";
			$pageName = $ids [1];
		} else
			die ( self::ERROR_0 );
		
		$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
		DIR_SEP . "generic_preview_template" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
		$xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
		$xmlSerializer->loadData ();
		$allItems = $xmlSerializer->getItems ();

        //$serializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL);
        //$serializer->setInterpolateConsts(true);
        //$serializer->setInterfacesContainer($interfacesContainer);
        //$serializer->setDbStruct($dbStructTree);
        //$serializer->setDbQueries($dbQueriesContainer);
        //$serializer->setXmlDir("./xml/");
        //$serializer->setInterfacesDir("./interfaces/");
        //$serializer->setPageName(DEFAULT_PAGE_NAME);
		//$serializer->setPageName("preview");
		//die('AAAAAA1');
		
		$appIntFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR . 
		DIR_SEP . $appDir . Generic_interface::INTERFACE_NAME_SEP . "preview" . Generic_interface::INTERFACE_NAME_SEP .
		Interfaces_info::INT_HTML_PAGE . Generic_interface::INTERFACE_NAME_SEP . Generic_interface::INTERFACE_NAME_SEP . "0";
		//echo $appIntFileName;
		$serializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL);
		$serializer1->setFileName($appIntFileName);
        $serializer1->setInterpolateConsts(true);
        //$serializer->setInterfacesContainer($interfacesContainer);
        $serializer1->setDbStruct(Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL));
        $serializer1->setDbQueries(Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL));
        //$serializer1->setXmlDir("./xml/");
        $serializer1->setInterfacesDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP);       		
		$serializer1->setPageName("preview");
		$serializer1->setAppName($appDir);
		$serializer1->loadData();
		$items = $serializer1->getItems();
		$dojoEnabled = $items["dojoEnabled"];
		
        /*$page = Creator::create(APPLICATION_NAME . VAR_SEP . $nomePagina . VAR_SEP . "op_page");
        $page->setSerializer($serializer);
		die('AAAAAA2');
        $page->serializer_loadData("Cheope_ns");
        die('BBBBBBB');
        $page->unserialize();
        $dojoEnabled = $page->getDojoEnabled(); */		
		//echo "WWWW". var_dump($dojoEnabled) . "WWWW";		
	
		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		$scope1 = $scope . STRING_BACKSLASH . DB_NODE_CLASS;
		$scope2 = $scope . STRING_BACKSLASH . DB_QUERY_CLASS;		
		
		// Creazione pagina applicativa

		/*if($appDir !== APPLICATION_NAME)
		 $ind = -1;
	    else
		 $ind = 0;*/
		
		$blockDefObj = $allItems [0];
		$blockDefArray = $blockDefObj->getItem ();
		$defObj1 = $blockDefArray [2];
		$defArray1 = $defObj1->getItem ();
		$functionCallObj1 = $defArray1 [0];
		$functionCallArray1 = $functionCallObj1->getItem ();
		$argObj1 = $functionCallArray1 [0];
		$exprObj1 = $argObj1->getItem ();
		$exprObj1->setItem ( "FRAMEWORK_PATH" . " . \"" . $appName . VAR_SEP . 
		$nomePagina . VAR_SEP . "op_page.class.php\"" );
		
		if (! is_null ( $nomeOggettoDb ) && ($nomeOggettoDb != STRING_NULL) && 
		($nomeOggettoDb != OBJ_DATA_SOURCE)) {
			$dbBind = $GLOBALS["dbBindsContainer"]->getElementByAliasName ( $nomeOggettoDb );
			$dbObj = $GLOBALS["dbStructTree"]->getElementByAliasName ( $nomeOggettoDb );
			$dbQuery = $GLOBALS["dbQueriesContainer"]->getQuery ( $nomeOggettoDb );
			if (! is_null ( $dbBind )) {
				$nodeType = "BINDING";
				if (is_a ( $dbBind, $scope1 )) {
					$containerName = "dbStructTree";
					$methodName = "getElementByAliasName";
				} elseif (is_a ( $dbBind, $scope2 )) {
					$containerName = "dbQueriesContainer";
					$methodName = "getQuery";
				} else {
					die (self::ERROR_2 );
				}
			} elseif (! is_null ( $dbObj )) {
				if ($dbObj->getAliasName () != $dbObj->getNodeName ())
					$nodeType = "ALIAS";
				else
					$nodeType = "TABELLA";
				$containerName = "dbStructTree";
				$methodName = "getElementByAliasName";
			} elseif (! is_null ( $dbQuery )) {
				$nodeType = "QUERY";
				$containerName = "dbQueriesContainer";
				$methodName = "getQuery";
			} else {
				die (self::ERROR_2 );
				return false;
			}
			$constObj = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$nodeType . CONST_SEP . $nomeOggettoDb);
			$argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj);
			$varObj = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$containerName);
			$methodCallObj = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array (
					$varObj,
					$argObj 
			) );			
			$methodCallObj->setName ( $methodName );
			$varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbNode");
			$defObj21 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL, array (
					$varObj1,
					$methodCallObj 
			));
			$blockDefArray [9] = $defObj21;
		} else {
			$varObj = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbNode");
			$exprItem = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"null");
			$defObj21 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array (
					$varObj,
					$exprItem 
			));
			$blockDefArray [9] = $defObj21;
		}
		
		$tipoInterfacciaItems = explode ( VAR_SEP, $tipoInterfaccia );
		//print_r($tipoInterfacciaItems);
		if ((strToLower($tipoInterfacciaItems [0]) == HTML_ACRONYM) || (in_array(XML_ACRONYM,$tipoInterfacciaItems))|| ($tipoInterfacciaItems [0] == APP_LANGUAGE) ||(in_array(Interfaces_info::INT_FCKEDITOR,$tipoInterfacciaItems)))
			$nomeCostruttore = $tipoInterfaccia;
//
// Le interfacce javascript non possono essere interfacce radice di una pagina.
//
		elseif ($tipoInterfacciaItems [0] != 'javascript')
			$nomeCostruttore = $appName . VAR_SEP . $tipoInterfaccia;
		else {
			//echo $tipoInterfaccia;
			die (self::ERROR_1 );
		}
		$defObj2 = $blockDefArray [10];
		$defArray2 = $defObj2->getItem ();
		$constructorCallObj2 = $defArray2 [1];
		$constructorCallObj2->setName ( ucFirst ( $nomeCostruttore ) );
		$constructorCallArray2 = $constructorCallObj2->getItem ();
		$newConstructorCallArray2 = array ();
		if (! is_null ( $nomeOggettoDb )) {
			$argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
			if ($nomeOggettoDb == OBJ_NONE) {
				$constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,'OBJ_NONE');
				$argObj2->setItem ( $constObj2 );
			} elseif ($nomeOggettoDb == OBJ_DATA_SOURCE) {
				$constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,'OBJ_DATA_SOURCE');
				$argObj2->setItem ( $constObj2 );
			} else {
				$varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbNode");
				$argObj2->setItem ( $varObj2 );
			}
			$newConstructorCallArray2 [0] = $argObj2;
			$argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL);
			if ($opInterfaccia != "OP_NONE") {
				$stringObj2 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$opInterfaccia);
				$argObj2->setItem ( $stringObj2 );
			} else {
				$constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$opInterfaccia);
				$argObj2->setItem ( $constObj2 );
			}
			$newConstructorCallArray2 [1] = $argObj2;
			$argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
			$constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"NUM" . CONST_SEP . $numInterfaccia);
			$argObj2->setItem ( $constObj2 );
			$newConstructorCallArray2 [2] = $argObj2;
		} else {
		
		if($tipoInterfaccia=="html_fieldset_decorator")
		{
			$argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		 $exprItem = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"null");
		 $argObj1->setItem($exprItem);
		 $newConstructorCallArray2[0] = $argObj1;
		 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		 if($opInterfaccia != "OP_NONE")
		  $opInterfacciaObj2 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$opInterfaccia);
		 else
		  $opInterfacciaObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$opInterfaccia);
		 $argObj2->setItem ( $opInterfacciaObj2 );
		 $newConstructorCallArray2 [1] = $argObj2;
		 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		 $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"NUM" . CONST_SEP . $numInterfaccia);
		 $argObj2->setItem ( $constObj2 );
		 $newConstructorCallArray2 [2] = $argObj2;
		 $constructorCallObj2->setItem ( $newConstructorCallArray2 );			
		}
		else
		{
		// $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		// $argObj1 = new Arg_item();
		// $opInterfacciaObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"OBJ_NONE");
    // $opInterfacciaObj1 = new Const_item( "OBJ_NONE" );		
		// $argObj1->setItem ( $opInterfacciaObj1 );
		// $newConstructorCallArray2 [0] = $argObj1; 
		 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL);
		 $argObj2 = new Arg_item ();
		 if($opInterfaccia != "OP_NONE")
		  $opInterfacciaObj2 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$opInterfaccia);
		 else
		  $opInterfacciaObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$opInterfaccia);
		 $argObj2->setItem ( $opInterfacciaObj2 );
		 $newConstructorCallArray2 [0] = $argObj2;
		 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		 $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"NUM" . CONST_SEP . $numInterfaccia);
		 $argObj2->setItem ( $constObj2 );
		 $newConstructorCallArray2 [1] = $argObj2;
		 $constructorCallObj2->setItem ( $newConstructorCallArray2 );
		}
				
		}
		$constructorCallObj2->setItem ( $newConstructorCallArray2 );
		
		$defObj3 = $blockDefArray [11];
		$defArray3 = $defObj3->getItem ();
		$methodCallObj3 = $defArray3 [0];
		$methodCallArray3 = $methodCallObj3->getItem ();
		$argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		$constObj3 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"NUM" . CONST_SEP . $numInterfaccia );
		$argObj3->setItem ( $constObj3 );
		$methodCallArray3 [1] = $argObj3;
		$methodCallObj3->setItem ( $methodCallArray3 );
		
		$defObj31 = $blockDefArray [12];
		$defArray31 = $defObj31->getItem ();
		$methodCallObj31 = $defArray31 [0];
		$methodCallArray31 = $methodCallObj31->getItem ();
		$argObj31 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		$constObj31 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$shortName);
		$argObj31->setItem ( $constObj31 );
		$methodCallArray31 [1] = $argObj31;
		$methodCallObj31->setItem ( $methodCallArray31 );
		
		$defObj4 = $blockDefArray [14];
		$defArray4 = $defObj4->getItem ();
		$methodCallObj4 = $defArray4 [0];
		$methodCallArray4 = $methodCallObj4->getItem ();
		$argObj4 = $methodCallArray4 [1];
		$stringObj4 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS));
		$stringObj4->setItem ( THIS_DIR . DIR_SEP . INTERFACES_DIR . DIR_SEP );
		$stringObj4->setType ( String_item::DOUBLE_QUOTED );
		$argObj4->setItem ( $stringObj4 );
		
		$defObj41 = $blockDefArray [15];
		$defArray41 = $defObj41->getItem ();
		$methodCallObj41 = $defArray41 [0];
		$methodCallArray41 = $methodCallObj41->getItem ();
		$argObj41 = $methodCallArray4 [1];
		$stringObj41 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS));
		$stringObj41->setItem ( THIS_DIR . DIR_SEP . XML_DIR . DIR_SEP );
		$stringObj41->setType ( String_item::DOUBLE_QUOTED );
		$argObj41->setItem ( $stringObj41 );
		
		$defObj5 = $blockDefArray [16];
		$defArray5 = $defObj5->getItem ();
		$methodCallObj5 = $defArray5 [0];
		$methodCallArray5 = $methodCallObj5->getItem ();
		$argObj5 = $methodCallArray5 [1];
		$stringObj5 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$pageName);
		$argObj5->setItem ( $stringObj5 );
		
		$defObj6 = $blockDefArray [17];
		$defArray6 = $defObj6->getItem ();
		$methodCallObj6 = $defArray6 [0];
		$methodCallArray6 = $methodCallObj6->getItem ();
		$argObj6 = $methodCallArray6 [1];
		$stringObj6 = $argObj6->getItem ( $appName );
		$stringObj6->setItem ( $appName );
		
		$defObj7 = $blockDefArray [19];
		$defArray7 = $defObj7->getItem ();
		$constructorCallObj7 = $defArray7 [1];
		$constructorCallObj7->setName ( $appName . VAR_SEP . $nomePagina . VAR_SEP . "op_page" );
		
		$defObj8 = $blockDefArray [20];
		$defArray8 = $defObj8->getItem ();
		$methodCallObj8 = $defArray8 [0];
		$methodCallArray8 = $methodCallObj8->getItem ();
		$argObj8 = $methodCallArray8 [1];
		$stringObj8 = $argObj8->getItem ( $appName );
		$stringObj8->setItem ( $nomePagina );
		
		$defObj9 = $blockDefArray [21];
		$defArray9 = $defObj9->getItem ();
		$methodCallObj9 = $defArray9 [0];
		$methodCallArray9 = $methodCallObj9->getItem ();
		$argObj9 = $methodCallArray9 [1];
		$varObj9 = $argObj9->getItem ();
		$varObj9->setItem ( "serializer" );
		
		$defObj10 = $blockDefArray [22];
		$defArray10 = $defObj10->getItem ();
		$methodCallObj10 = $defArray10 [0];
		$methodCallArray10 = $methodCallObj10->getItem ();
		$argObj10 = $methodCallArray10 [1];
		$stringObj10 = $argObj10->getItem ();
		$stringObj10->setItem ( $appName );
		
		$defObj11 = $blockDefArray [24];
		$defArray11 = $defObj11->getItem ();
		$methodCallObj11 = $defArray11 [0];
		$methodCallArray11 = $methodCallObj11->getItem ();
		$argObj11 = $methodCallArray11 [1];
		$stringObj11 = $argObj11->getItem ( $appName );
		$stringObj11->setItem ( strToLower ( $appName ) . (($pageName != STRING_NULL) ? VAR_SEP . strToLower ( $pageName ) : STRING_NULL) );
		
		$defObj12 = $blockDefArray [25];
		$defArray12 = $defObj12->getItem ();
		$methodCallObj12 = $defArray12 [0];
		$methodCallArray12 = $methodCallObj12->getItem ();
		$argObj12 = $methodCallArray12 [1];
		$stringObj12 = $argObj12->getItem ( $appName );
		$stringObj12->setItem ( strToLower ( $appName ) . (($pageName != STRING_NULL) ? VAR_SEP . strToLower ( $pageName ) : STRING_NULL) );
		
		// Scrive le opzioni pagina.
		
		$defObj13 = $blockDefArray [29];
		$defArray13 = $defObj13->getItem ();
		$methodCallObj13 = $defArray13 [0];
		$methodCallArray13 = $methodCallObj13->getItem ();
		$argObj13 = $methodCallArray13 [1];
		$stringObj13 = $argObj13->getItem ();
		if ($actIds [1] === '0')
			$stringObj13->setItem ( 'false' );
		else
			$stringObj13->setItem ( 'true' );
		
		$blockDefObj->setItem ( $blockDefArray );
		$xmlSerializer->loadItems ( $allItems );
		$xmlSerializer->saveData ();
		
		$applicationPageFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
		DIR_SEP . $nomePagina . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
		
		$fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
		$fileDumper->setFileName ( $applicationPageFileName );
		$fileDumper->setFileOpenType ( File_dumper::OPEN_FILE_FOR_OVERWRITE );
		$fileDumper->dump ();
		// echo MSG_24 . STRING_RETURN . STRING_LINE_FEED;
		
		// Caricamento interfacce
		
		if ($actIds [4] !== '0') {
			$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
			XML_DIR . DIR_SEP . "generic_preview_op_page_template" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
			
			$xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
			$xmlSerializer2->loadData ();
			$allItems = $xmlSerializer2->getItems ();
			
			$blockDefObj = $allItems [0];
			$blockDefArray = $blockDefObj->getItem ();
			
			$defObj1 = $blockDefArray [2];
			$defArray1 = $defObj1->getItem ();
			$functionCallObj1 = $defArray1 [0];
			$functionCallArray1 = $functionCallObj1->getItem ();
			$argObj1 = $functionCallArray1 [0];
			$stringObj1 = $argObj1->getItem ();
			$stringObj1->setItem ( $appName . VAR_SEP . "page" . 
			FILE_NAME_ELEMENTS_SEP . "class" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj2 = $blockDefArray [3];
			$defArray2 = $defObj2->getItem ();
			$functionCallObj2 = $defArray2 [0];
			$functionCallArray2 = $functionCallObj2->getItem ();
			$argObj2 = $functionCallArray2 [0];
			$stringObj2 = $argObj2->getItem ();
			$stringObj2->setItem ( strToLower ( $appName ) . VAR_SEP . "db_struct" . 
			FILE_NAME_ELEMENTS_SEP . "def" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj3 = $blockDefArray [4];
			$defArray3 = $defObj3->getItem ();
			$functionCallObj3 = $defArray3 [0];
			$functionCallArray3 = $functionCallObj3->getItem ();
			$argObj3 = $functionCallArray3 [0];
			$stringObj3 = $argObj3->getItem ();
			$stringObj3->setItem ( strToLower ( $appName ) . VAR_SEP . "db_queries" . 
			FILE_NAME_ELEMENTS_SEP . "def" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj4 = $blockDefArray [5];
			$defArray4 = $defObj4->getItem ();
			$functionCallObj4 = $defArray4 [0];
			$functionCallArray4 = $functionCallObj4->getItem ();
			$argObj4 = $functionCallArray4 [0];
			$stringObj4 = $argObj4->getItem ();
			$stringObj4->setItem ( strToLower ( $appName ) . VAR_SEP . "db_connections" . 
			FILE_NAME_ELEMENTS_SEP . "def" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj5 = $blockDefArray [6];
			$defArray5 = $defObj5->getItem ();
			$functionCallObj5 = $defArray5 [0];
			$functionCallArray5 = $functionCallObj5->getItem ();
			$argObj5 = $functionCallArray5 [0];
			$stringObj5 = $argObj5->getItem ();
			$stringObj5->setItem ( strToLower ( $appName ) . VAR_SEP . "db_binds" . 
			FILE_NAME_ELEMENTS_SEP . "def" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj6 = $blockDefArray [7];
			$defArray6 = $defObj6->getItem ();
			$functionCallObj6 = $defArray6 [0];
			$functionCallArray6 = $functionCallObj6->getItem ();
			$argObj6 = $functionCallArray6 [0];
			$stringObj6 = $argObj6->getItem ();
			$stringObj6->setItem ( $nomeCostruttore . FILE_NAME_ELEMENTS_SEP . "class" . 
			FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj7 = $blockDefArray [8];
			$defArray7 = $defObj7->getItem ();
			$functionCallObj7 = $defArray7 [0];
			$functionCallArray7 = $functionCallObj7->getItem ();
			$argObj7 = $functionCallArray7 [1];
			$stringObj7 = $argObj7->getItem ();
			$stringObj7->setItem ( $nomePagina );
			
			$defObj8 = $blockDefArray [9];
			$defArray8 = $defObj8->getItem ();
			$functionCallObj8 = $defArray8 [0];
			$functionCallArray8 = $functionCallObj8->getItem ();
			$argObj8 = $functionCallArray8 [1];
			$stringObj8 = $argObj8->getItem ();
			$stringObj8->setItem ( $nomePagina . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$classDefObj = $blockDefArray [10];
			$classDefObj->setName ( $appName . VAR_SEP . $nomePagina . VAR_SEP . "op_page" );
			$classDefObj->setExtendsClass ( $appName . VAR_SEP . "page" );
			
			$blockDefObj1 = $classDefObj->getItem();
			$blockDefArray1 = $blockDefObj1->getItem();
			$functionDefObj1 = $blockDefArray1[1];
			$functionDefObj1->setRetType("void");
			$functionDefArray1 = $functionDefObj1->getItem();
			$blockDefObj2 = $functionDefArray1[1];
			$blockDefArray3 = $blockDefObj2->getItem();
			$functionDefObj2 = $blockDefArray1[2];
			$functionDefObj2->setRetType("void");
			$functionDefObj3 = $blockDefArray1[3];
			$functionDefObj3->setRetType("void");
			$functionDefObj4 = $blockDefArray1[4];
			$functionDefObj4->setRetType("void");
		    $functionDefObj2 = $blockDefArray1[2];
			$functionDefArray20 = $functionDefObj2->getItem();
			$blockDefObj6 = $functionDefArray20[1];
			$defArray1 = $blockDefObj6->getItem();
			if (($actIds [2] === '0')||($dojoEnabled=="false"))
			{
			 //echo "WWWWWWWWWWWWWWWWWWW";
			 if(isset($blockDefArray3[1]))
			 unset($blockDefArray3[1]);
			 if(isset($blockDefArray3[2]))
			 unset($blockDefArray3[2]);
			 //print_r($defArray1[3]);
			 //die('NNNN');
			 if(isset($defArray1[2]))
			 unset($defArray1[2]);
			 if(isset($defArray1[3]))
			 unset($defArray1[3]);			 
			}
			else
			{
			 //
			 // Ricostruisco $blockDefArray3
			 //
			 //echo "QQQQQQQQQQQQQQQ";
			 $codeObj1 = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL," CLIENT_DOJO_CSS_PATH . DIR_SEP . \"dojo\" .  STYLE_SHEET_FILE_POSTFIX  ");	
			 $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$codeObj1);
			 $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"STRING_NULL");
			 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
			 $argListArray = array($argObj2,$argObj1);
			 $argListObj = Creator::create(getClassNameForCreate(Classes_info::ARGS_LIST_ITEM_CLASS),STRING_NULL,$argListArray);
			 $functionCallObj9 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array($argListObj));
			 $functionCallObj9->setName("putLinkTag");
			 $defObj9 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($functionCallObj9));
			 $blockDefArray3[1]=$defObj9;

			 $codeObj2 = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,
			 " CLIENT_DIJIT_CSS_PATH . DIR_SEP . \"nihilo\" .  DIR_SEP . \"nihilo\" .  STYLE_SHEET_FILE_POSTFIX  ");
			 $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$codeObj2);
			 $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"STRING_NULL");
			 $argObj4 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj2);
			 $argListArray1 = array($argObj4,$argObj3);
			 $argListObj1 = Creator::create(getClassNameForCreate(Classes_info::ARGS_LIST_ITEM_CLASS),STRING_NULL,$argListArray1);
			 $functionCallObj10 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array($argListObj1));
			 $functionCallObj10->setName("putLinkTag");
			 $defObj10 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($functionCallObj10));
			 $blockDefArray3[2]=$defObj10;

             //
			 // Ricostruisco $defArray1
			 //
			 $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"htmlWriter");
			 $codeObj3 = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"\"<script>dojo.require(\\\"dojo.parser\\\")</script>\"");
			 $argObj5 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$codeObj3);
			 $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj1,$argObj5));
			 $methodCallObj1->setname("put");
			 $defObj11 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodCallObj1));
			 $defArray1[2]=$defObj11;
			 
			 $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"htmlWriter");
			 $codeObj4 = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"\"<script>dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>\"");
			 $argObj6 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$codeObj4);
			 $methodCallObj2 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj2,$argObj6));
			 $methodCallObj2->setname("put");
			 $defObj12 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodCallObj2));
			 $defArray1[3]=$defObj12;
			 
			}
			$blockDefObj2->setItem($blockDefArray3);
			$blockDefObj6->setItem($defArray1);
			
			$blockDefObj->setItem ( $blockDefArray );
			$xmlSerializer2->loadItems ( $allItems );
			$xmlSerializer2->saveData ();
			
			$dataPageFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
			FRAMEWORK_DIR . DIR_SEP . $appName . VAR_SEP . $nomePagina . VAR_SEP . 
			"op_page" . FILE_NAME_ELEMENTS_SEP . "class" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;

			/*if(! $dojoEnabled)
			{
			 $xblockDefObj1 = $classDefObj->getItem();
			 $xblockDefArray1 = $xblockDefObj1->getItem();
			 $xfunctionDefObj1 = $xblockDefArray1[1];
			 $xfunctionDefArray1 = $xfunctionDefObj1->getItem();
			 $xblockDefObj2 = $xfunctionDefArray1[1];
			 $xblockDefArray2 = $xblockDefObj2->getItem();
			 $newXBlockDefArray2 = array($xblockDefArray2[0]);
			 $xblockDefObj2->setItem($newXBlockDefArray2);			 
			
			 $xfunctionDefObj2 = $xblockDefArray1[2]; 
			 $xfunctionDefArray2 = $xfunctionDefObj2->getItem();
			 $xblockDefObj3 = $xfunctionDefArray2[1];
			 $xblockDefArray3 = $xblockDefObj3->getItem();			 
			 $newXBlockDefArray3 = array($xblockDefArray3[0]);
			 $xblockDefObj3->setItem($newXBlockDefArray3);
			}*/
			
			$fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
			$fileDumper->setFileName ( $dataPageFileName );
			$fileDumper->setFileOpenType ( File_dumper::OPEN_FILE_FOR_OVERWRITE );
			$fileDumper->dump ();
		}
	 return STRING_NULL;
	}
}

//
// Preview per i layouts
//
class AjaxOpCreateLayoutPreview extends AjaxOp {
	const ERROR_0 = "AjaxOpCreateLayoutPreview:" . MSG_61;
	const ERROR_1 = "AjaxOpCreateLayoutPreview:" . MSG_22;
	const ERROR_2 = "AjaxOpCreateLayoutPreview:" . MSG_27;
	function __construct() {
		parent::__construct ( AJAX_OP_CREATE_LAYOUT_PREVIEW );
	}
	function exec_1(string $actId):array|string|bool|null {		
		session_start ();
		
		$actIds = explode ( STRING_SEMICOLON, $actId );
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
				
		$ids0 = explode ( Xml_interface_serializer::INTERFACE_NAME_SEP, $actIds [0] );
		if (count ( $ids0 ) == 1)
			$shortName = $actIds [0];
		elseif(strpos($actIds [0],FILE_NAME_ELEMENTS_SEP) !== false)
		 $shortName = $actIds[0];
		else
			$shortName = STRING_NULL;
		
		$ids = Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir . DIR_SEP . $actIds [0] );	
		
		//print_r ( $ids );
		$nomePagina = "preview";
		if (count ( $ids ) == 6) {
			$nomeOggettoDb = $ids [2];
			$tipoInterfaccia = $ids [3];
			$opInterfaccia = $ids [4];
			if ($opInterfaccia == STRING_NULL)
				$opInterfaccia = "OP_NONE";
			$numInterfaccia = $ids [5];
			$numInterfacciaItems = explode(FILE_NAME_ELEMENTS_SEP,$numInterfaccia);
			$numInterfacciaItemsNum = count($numInterfacciaItems);
			if($numInterfacciaItemsNum==2)
			 $numInterfaccia1 = $numInterfacciaItems[0];
			else
			 $numInterfaccia1 = $numInterfaccia;
			$numInterfaccia = $numInterfaccia1;			
			if ($numInterfaccia == STRING_NULL)
				$numInterfaccia = "0";
			$pageName = $ids [1];
		} elseif (count ( $ids ) == 5) {
			$nomeOggettoDb = null;
			$tipoInterfaccia = $ids [2];
			$opInterfaccia = $ids [3];
			if ($opInterfaccia == STRING_NULL)
				$opInterfaccia = "OP_NONE";
			$numInterfaccia = $ids [4];
			$numInterfacciaItems = explode(FILE_NAME_ELEMENTS_SEP,$numInterfaccia);
			$numInterfacciaItemsNum = count($numInterfacciaItems);
			if($numInterfacciaItemsNum==2)
			 $numInterfaccia1 = $numInterfacciaItems[0];
			else
			 $numInterfaccia1 = $numInterfaccia;
			$numInterfaccia = $numInterfaccia1;			
			if ($numInterfaccia == STRING_NULL)
				$numInterfaccia = "0";
			$pageName = $ids [1];
		} else
			die ( self::ERROR_0 );
		
		$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
		XML_DIR . DIR_SEP . "generic_preview_template" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
		$xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
		$xmlSerializer->loadData ();
		$allItems = $xmlSerializer->getItems ();

		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		$scope1 = $scope . STRING_BACKSLASH . DB_NODE_CLASS;
		$scope2 = $scope . STRING_BACKSLASH . DB_QUERY_CLASS;
		
		// Creazione pagina applicativa
		
		$blockDefObj = $allItems [0];
		$blockDefArray = $blockDefObj->getItem ();
		$defObj1 = $blockDefArray [2];
		$defArray1 = $defObj1->getItem ();
		$functionCallObj1 = $defArray1 [0];
		$functionCallArray1 = $functionCallObj1->getItem ();
		$argObj1 = $functionCallArray1 [0];
		$exprObj1 = $argObj1->getItem ();
		$exprObj1->setItem ( "FRAMEWORK_PATH" . " . \"" . $appName . 
		VAR_SEP . $nomePagina . VAR_SEP . "op_page.class.php\"" );
		if (! is_null ( $nomeOggettoDb )) {
			$dbBind = $GLOBALS["dbBindsContainer"]->getElementByAliasName ( $nomeOggettoDb );
			$dbObj = $GLOBALS["dbStructTree"]->getElementByAliasName ( $nomeOggettoDb );
			$dbQuery = $GLOBALS["dbQueriesContainer"]->getQuery ( $nomeOggettoDb );
			if (! is_null ( $dbBind )) {
				$nodeType = "BINDING";
				if (is_a ( $dbBind, $scope1 )) {
					$containerName = "dbStructTree";
					$methodName = "getElementByAliasName";
				} elseif (is_a ( $dbBind, $scope2 )) {
					$containerName = "dbQueriesContainer";
					$methodName = "getQuery";
				} else {
					die (self::ERROR_2 );
				}
			} elseif (! is_null ( $dbObj )) {
				if ($dbObj->getAliasName () != $dbObj->getNodeName ())
					$nodeType = "ALIAS";
				else
					$nodeType = "TABELLA";
				$containerName = "dbStructTree";
				$methodName = "getElementByAliasName";
			} elseif (! is_null ( $dbQuery )) {
				$nodeType = "QUERY";
				$containerName = "dbQueriesContainer";
				$methodName = "getQuery";
			} else {
				die (self::ERROR_2 );
				return false;
			}
			$constObj = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$nodeType . CONST_SEP . $nomeOggettoDb);
			$argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj);
			$varObj = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$containerName);
			$methodCallObj = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL, array (
					$varObj,
					$argObj 
			));
			$methodCallObj->setName ( $methodName );
			$varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbNode");
			$defObj21 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL, array (
					$varObj1,
					$methodCallObj 
			) );
			$blockDefArray [9] = $defObj21;
		} else {
			$varObj = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbNode");
			$exprItem = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"null");
			$defObj21 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL, array (
					$varObj,
					$exprItem 
			));
			$blockDefArray [9] = $defObj21;
		}
		
		$tipoInterfacciaItems = explode ( VAR_SEP, $tipoInterfaccia );

		if (($tipoInterfacciaItems [0] == HTML_ACRONYM) || (in_array(XML_ACRONYM,$tipoInterfacciaItems))|| ($tipoInterfacciaItems [0] == APP_LANGUAGE) ||(in_array(Interfaces_info::INT_FCKEDITOR,$tipoInterfacciaItems)))
			$nomeCostruttore = $tipoInterfaccia;
//		if (($tipoInterfacciaItems [0] == 'html') || ($tipoInterfacciaItems [0] == APP_LANGUAGE))
//			$nomeCostruttore = $tipoInterfaccia;
//
// Le interfacce 'javascript' non possono essere radice del layout preview page
//
		elseif ($tipoInterfacciaItems [0] != 'javascript')
			$nomeCostruttore = $appName . VAR_SEP . $tipoInterfaccia;
		else {
			die (self::ERROR_1 );
		}
		
		$defObj2 = $blockDefArray [10];
		$defArray2 = $defObj2->getItem ();
		$constructorCallObj2 = $defArray2 [1];
		$constructorCallObj2->setName ( ucFirst ( $nomeCostruttore ) );
		$constructorCallArray = $constructorCallObj2->getItem ();
		$newConstructorCallArray2 = array ();
		
		if($tipoInterfaccia=="html_fieldset_decorator")
		{
		 $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));	
		 $exprItem = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"null");
		 $argObj1->setItem($exprItem);
		 $newConstructorCallArray2[0] = $argObj1;
		 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		 if($opInterfaccia != "OP_NONE")
		  $opInterfacciaObj2 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$opInterfaccia);
		 else
		  $opInterfacciaObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$opInterfaccia);
		 $argObj2->setItem ( $opInterfacciaObj2 );
		 $newConstructorCallArray2 [1] = $argObj2;
		 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		 $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"NUM" . CONST_SEP . $numInterfaccia);
		 $argObj2->setItem ( $constObj2 );
		 $newConstructorCallArray2 [2] = $argObj2;
		 $constructorCallObj2->setItem ( $newConstructorCallArray2 );			
		}
		else
		{
		 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		 if($opInterfaccia != "OP_NONE")
		  $opInterfacciaObj2 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$opInterfaccia);
		 else
		  $opInterfacciaObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$opInterfaccia);
		 $argObj2->setItem ( $opInterfacciaObj2 );
		 $newConstructorCallArray2 [0] = $argObj2;
		 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS));
		 $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"NUM" . CONST_SEP . $numInterfaccia);
		 $argObj2->setItem ( $constObj2 );
		 $newConstructorCallArray2 [1] = $argObj2;
		 $constructorCallObj2->setItem ( $newConstructorCallArray2 );
		}
		
		$defObj3 = $blockDefArray [11];
		$defArray3 = $defObj3->getItem ();
		$methodCallObj3 = $defArray3 [0];
		$methodCallArray3 = $methodCallObj3->getItem ();
		$argObj3 = $methodCallArray3 [1];
		$constObj3 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL, "NUM" . CONST_SEP . $numInterfaccia);
		$argObj3->setItem ( $constObj3 );
		
		$defObj31 = $blockDefArray [12];
		$defArray31 = $defObj31->getItem ();
		$methodCallObj31 = $defArray31 [0];
		$methodCallArray31 = $methodCallObj31->getItem ();
		$argObj31 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS)); 
		$constObj31 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$shortName);
		$argObj31->setItem ( $constObj31 );
		$methodCallArray31 [1] = $argObj31;
		$methodCallObj31->setItem ( $methodCallArray31 );
		
		$defObj4 = $blockDefArray [14];
		$defArray4 = $defObj4->getItem ();
		$methodCallObj4 = $defArray4 [0];
		$methodCallArray4 = $methodCallObj4->getItem ();
		$argObj4 = $methodCallArray4 [1];
		$stringObj4 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS));
		$stringObj4->setItem ( THIS_DIR . DIR_SEP . XML_DIR . DIR_SEP );
		$stringObj4->setType ( String_item::DOUBLE_QUOTED );
		$argObj4->setItem ( $stringObj4 );
		
		$defObj41 = $blockDefArray [15];
		$defArray41 = $defObj41->getItem ();
		$methodCallObj41 = $defArray41 [0];
		$methodCallArray41 = $methodCallObj41->getItem ();
		$argObj41 = $methodCallArray41 [1];
		$stringObj41 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS));
		$stringObj41->setItem ( THIS_DIR . DIR_SEP . INTERFACES_DIR . DIR_SEP );
		$stringObj41->setType ( String_item::DOUBLE_QUOTED );
		$argObj41->setItem ( $stringObj41 );
		
		$defObj5 = $blockDefArray [16];
		$defArray5 = $defObj5->getItem ();
		$methodCallObj5 = $defArray5 [0];
		$methodCallArray5 = $methodCallObj5->getItem ();
		$argObj5 = $methodCallArray5 [1];
		$stringObj5 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$pageName);
		$argObj5->setItem ( $stringObj5 );
		
		$defObj6 = $blockDefArray [17];
		$defArray6 = $defObj6->getItem ();
		$methodCallObj6 = $defArray6 [0];
		$methodCallArray6 = $methodCallObj6->getItem ();
		$argObj6 = $methodCallArray6 [1];
		$stringObj6 = $argObj6->getItem ( $appName );
		$stringObj6->setItem ( $appName );
		
		$defObj7 = $blockDefArray [19];
		$defArray7 = $defObj7->getItem ();
		$constructorCallObj7 = $defArray7 [1];
		$constructorCallObj7->setName ( $appName . VAR_SEP . $nomePagina . VAR_SEP . "op_page" );
		
		$defObj8 = $blockDefArray [20];
		$defArray8 = $defObj8->getItem ();
		$methodCallObj8 = $defArray8 [0];
		$methodCallArray8 = $methodCallObj8->getItem ();
		$argObj8 = $methodCallArray8 [1];
		$stringObj8 = $argObj8->getItem ( $appName );
		$stringObj8->setItem ( $nomePagina );
		
		$defObj9 = $blockDefArray [21];
		$defArray9 = $defObj9->getItem ();
		$methodCallObj9 = $defArray9 [0];
		$methodCallArray9 = $methodCallObj9->getItem ();
		$argObj9 = $methodCallArray9 [1];
		$varObj9 = $argObj9->getItem ();
		$varObj9->setItem ( "serializer" );
		
		$defObj10 = $blockDefArray [22];
		$defArray10 = $defObj10->getItem ();
		$methodCallObj10 = $defArray10 [0];
		$methodCallArray10 = $methodCallObj10->getItem ();
		$argObj10 = $methodCallArray10 [1];
		$stringObj10 = $argObj10->getItem ();
		$stringObj10->setItem ( $appName );
		
		$defObj11 = $blockDefArray [25];
		$defArray11 = $defObj11->getItem ();
		$methodCallObj11 = $defArray11 [0];
		$methodCallArray11 = $methodCallObj11->getItem ();
		$argObj11 = $methodCallArray11 [1];
		$stringObj11 = $argObj11->getItem ( $appName );
		$stringObj11->setItem ( strToLower ( $appName ) . VAR_SEP . $pageName );
		
		// Scrive le opzioni pagina.
		
		$defObj12 = $blockDefArray [29];
		$defArray12 = $defObj12->getItem ();
		$methodCallObj12 = $defArray12 [0];
		$methodCallArray12 = $methodCallObj12->getItem ();
		$argObj12 = $methodCallArray12 [1];
		$stringObj12 = $argObj12->getItem ();
		if ($actIds [1] === '0')
			$stringObj12->setItem ( 'false' );
		else
			$stringObj12->setItem ( 'true' );
			
		$blockDefObj->setItem ( $blockDefArray );
		$xmlSerializer->loadItems ( $allItems );
		$xmlSerializer->saveData ();
		
		$applicationPageFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
		$nomePagina . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
		
		$fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
		$fileDumper->setFileName ( $applicationPageFileName );
		$fileDumper->setFileOpenType ( File_dumper::OPEN_FILE_FOR_OVERWRITE );
		$fileDumper->dump ();
		// echo MSG_24 . STRING_RETURN . STRING_LINE_FEED;
		
		// Caricamento interfacce
		
		if ($actIds [4] !== '0') {
			$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
			XML_DIR . DIR_SEP . "generic_preview_op_page_template" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
			$xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
			$xmlSerializer2->loadData ();
			$allItems = $xmlSerializer2->getItems ();
			
			$blockDefObj = $allItems [0];
			$blockDefArray = $blockDefObj->getItem ();
			
			$defObj4 = $blockDefArray [2];
			$defArray4 = $defObj4->getItem ();
			$functionCallObj4 = $defArray4 [0];
			$functionCallArray4 = $functionCallObj4->getItem ();
			$argObj4 = $functionCallArray4 [0];
			$stringObj4 = $argObj4->getItem ();
			$stringObj4->setItem ( $appName . VAR_SEP . "page" . FILE_NAME_ELEMENTS_SEP . 
			"class" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj2 = $blockDefArray [3];
			$defArray2 = $defObj2->getItem ();
			$functionCallObj2 = $defArray2 [0];
			$functionCallArray2 = $functionCallObj2->getItem ();
			$argObj2 = $functionCallArray2 [0];
			$stringObj2 = $argObj2->getItem ();
			$stringObj2->setItem ( strToLower ( $appName ) . VAR_SEP . "db_struct" . 
			FILE_NAME_ELEMENTS_SEP . "def" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj3 = $blockDefArray [4];
			$defArray3 = $defObj3->getItem ();
			$functionCallObj3 = $defArray3 [0];
			$functionCallArray3 = $functionCallObj3->getItem ();
			$argObj3 = $functionCallArray3 [0];
			$stringObj3 = $argObj3->getItem ();
			$stringObj3->setItem ( strToLower ( $appName ) . VAR_SEP . "db_queries" . 
			FILE_NAME_ELEMENTS_SEP . "def" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj4 = $blockDefArray [5];
			$defArray4 = $defObj4->getItem ();
			$functionCallObj4 = $defArray4 [0];
			$functionCallArray4 = $functionCallObj4->getItem ();
			$argObj4 = $functionCallArray4 [0];
			$stringObj4 = $argObj4->getItem ();
			$stringObj4->setItem ( strToLower ( $appName ) . VAR_SEP . "db_connections" . 
			FILE_NAME_ELEMENTS_SEP . "def" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj5 = $blockDefArray [6];
			$defArray5 = $defObj5->getItem ();
			$functionCallObj5 = $defArray5 [0];
			$functionCallArray5 = $functionCallObj5->getItem ();
			$argObj5 = $functionCallArray5 [0];
			$stringObj5 = $argObj5->getItem ();
			$stringObj5->setItem ( strToLower ( $appName ) . VAR_SEP . "db_binds" . 
			FILE_NAME_ELEMENTS_SEP . "def" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj6 = $blockDefArray [7];
			$defArray6 = $defObj6->getItem ();
			$functionCallObj6 = $defArray6 [0];
			$functionCallArray6 = $functionCallObj6->getItem ();
			$argObj6 = $functionCallArray6 [0];
			$stringObj6 = $argObj6->getItem ();
			$stringObj6->setItem ( $nomeCostruttore . FILE_NAME_ELEMENTS_SEP . "class" . 
			FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$defObj7 = $blockDefArray [8];
			$defArray7 = $defObj7->getItem ();
			$functionCallObj7 = $defArray7 [0];
			$functionCallArray7 = $functionCallObj7->getItem ();
			$argObj7 = $functionCallArray7 [1];
			$stringObj7 = $argObj7->getItem ();
			$stringObj7->setItem ( $nomePagina );
			
			$defObj8 = $blockDefArray [9];
			$defArray8 = $defObj8->getItem ();
			$functionCallObj8 = $defArray8 [0];
			$functionCallArray8 = $functionCallObj8->getItem ();
			$argObj8 = $functionCallArray8 [1];
			$stringObj8 = $argObj8->getItem ();
			$stringObj8->setItem ( $nomePagina . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE );
			
			$classDefObj = $blockDefArray [10];
			$classDefObj->setName ( $appName . VAR_SEP . $nomePagina . VAR_SEP . "op_page" );
			$classDefObj->setExtendsClass ( $appName . VAR_SEP . "page" );
			$blockDefObj1 = $classDefObj->getItem();
			$blockDefArray1 = $blockDefObj1->getItem();
			$functionDefObj1 = $blockDefArray1[1];
			$functionDefObj1->setRetType("void");
			$functionDefArray1 = $functionDefObj1->getItem();
			$blockDefObj2 = $functionDefArray1[1];
			$blockDefArray3 = $blockDefObj2->getItem();
			$functionDefObj2 = $blockDefArray1[2];
			$functionDefObj2->setRetType("void");
			$functionDefObj3 = $blockDefArray1[3];
			$functionDefObj3->setRetType("void");
			$functionDefObj4 = $blockDefArray1[4];
			$functionDefObj4->setRetType("void");
			
			$blockDefObj->setItem ( $blockDefArray );
			$xmlSerializer2->loadItems ( $allItems );
			$xmlSerializer2->saveData ();
			
			$dataPageFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . FRAMEWORK_DIR . DIR_SEP . $appName . 
			VAR_SEP . $nomePagina . VAR_SEP . "op_page" . FILE_NAME_ELEMENTS_SEP . "class" . FILE_NAME_ELEMENTS_SEP . 
			APP_LANGUAGE;
			
			$fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
			$fileDumper->setFileName ( $dataPageFileName );
			$fileDumper->setFileOpenType ( File_dumper::OPEN_FILE_FOR_OVERWRITE );
			$fileDumper->dump ();
			// echo MSG_25 . STRING_RETURN . STRING_LINE_FEED;
		}
		// echo MSG_23;
	 return STRING_NULL;
	}
}
class AjaxOpGetQuery extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_QUERY );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		return Xml_db_model::getQueryFromRepository ( $appName, $ids );
	}
}
class AjaxOpSetQuery extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_QUERY );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = array ();
		$ids [0] = $_POST ["queryName"];
		$ids [1] = $_POST ["queryPos"];
		$ids [2] = $_POST ["queryBody"];
		$ids [3] = $_POST ["dataSource"];
		$ids1 = $ids;
		$isDataSource = $ids [3];
		$queryPos = $ids [1];
		if ($isDataSource == 'true') {
			unset ( $ids [3] );
			$queryName = Xml_db_model::getQueryNameInRepository ( $appName, $queryPos );
			//
			// Se $queryName==STRING_NULL � una query nuova
			//
			if ($queryName != STRING_NULL) {
				$oldQueryName = $queryName;
				$queryPos = Xml_db_model::getQueryPos ( $appName, $queryName );
				$ids [1] = $queryPos;
				Xml_db_model::setQuery ( $appName, $ids );
				if ($oldQueryName != $ids [0])
				{
					Xml_db_model::renameQueriesNamesInDbBinds ( $appName, $oldQueryName, $ids [0] );
				}
			} else {
				Xml_db_model::setQuery ( $appName, $ids );
			}
		} else {
			unset ( $ids [3] );
			$queryName = Xml_db_model::getQueryNameInRepository ( $appName, $queryPos );
			
			if ($queryName != STRING_NULL) {
				$isInDataSourcesQueries = Xml_db_model::checkIfDataSourceQueryExists ( $appName, $queryName );
				if ($isInDataSourcesQueries == 'true') {
					$queryPos = Xml_db_model::getQueryPos ( $appName, $queryName );
					$ids [0] = STRING_NULL;
					$ids [1] = $queryPos;
					Xml_db_model::setQuery ( $appName, $ids );
				   	Xml_db_model::updateBinds ( $appName );
				}
			}
		}
		Xml_db_model::setQueryInRepository ( $appName, $ids1 );
		return true;
	}
}
class AjaxOpSetAllQueries extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_ALL_QUERIES );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = $_POST;
		//print_r ( $ids );
		//echo count ( $ids );
		$idsRep = array ();
		$idsNew = array ();
		$newId1 = array ();
		$newId2 = array ();
		$i = 0;
		$j = 0;
		for($i = 0; $i <= ( int ) (count ( $ids ) / 3) - 1; $i ++) {
			$newId1 ["queryName"] = $ids ["queryName" . VAR_SEP . $i];
			$newId1 ["queryBody"] = $ids ["queryBody" . VAR_SEP . $i];
			$newId1 ["dataSource"] = $ids ["dataSource" . VAR_SEP . $i];
			$idsRep [$i] = $newId1;
			if ($newId1 ["dataSource"] == 'true') {
				$newId2 ["queryName"] = $ids ["queryName" . VAR_SEP . $j];
				$newId2 ["queryBody"] = $ids ["queryBody" . VAR_SEP . $j];
				$idsNew [$j ++] = $newId2;
			}
		}
		Xml_db_model::setAllQueriesInRepository ( $appName, $idsRep );
		Xml_db_model::setAllQueries ( $appName, $idsNew );
		return true;
	}
}

//
// Genera il file php di struttura della base dati.
//
class AjaxOpCreateQueriesStruct extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CREATE_QUERIES_STRUCT );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appDir = $_SESSION [SESSION_VAR_ACTIVE_APP];
		if ($appDir != STRING_NULL) {
			Xml_db_model::createQueriesStruct ( $appDir );
			return 'true';
		} else
			return 'false';
	}
}
class AjaxOpAddAjaxOpsFromPhpArray extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_ADD_AJAX_OPS_FROM_PHP_ARRAY );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		eval ( "\$ids = " . $actId . STRING_SEMICOLON );
		return Xml_db_model::addAjaxOps ( $ids, $appDir );
	}
}
class AjaxOpDumpAjaxOpsConstsFile extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_DUMP_AJAX_OPS_CONSTS_FILE );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		return Xml_db_model::dumpAjaxOpsConstsFile ( $appDir );
	}
}
class AjaxOpGetParents extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_PARENTS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		$appXmlDir2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;
		$files = scandir ( $appXmlDir1 );
		$parents = array ();
		$i = 0;
		foreach ( $files as $ind => $file ) {
			$fileItems = explode ( FILE_NAME_ELEMENTS_SEP, $file );
			$num = count ( $fileItems );
			if ((($file != $actId) && (! is_dir ( $file )) && ($num == 1))||
			(($file != $actId) && (! is_dir ( $file )) && ($num == 2)&&($fileItems[1]==XML_SUFFIX))) {
				$serializer = new Xml_interface_serializer ( $file );
				$serializer->setXmlDir ( $appXmlDir2 );
				$serializer->setInterfacesDir ( $appXmlDir1 );
				$serializer->setDbStruct ( Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL));
				$serializer->setDbQueries ( Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL));
				$intContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
				$serializer->setInterfacesContainer ( $intContainer );
				$serializer->setAppName ( $appName );
				$filesItems = preg_split ( STRING_SLASH . 
				Xml_interface_serializer::INTERFACE_NAME_SEP . 
				STRING_SLASH, $file );
				if (count ( $filesItems ) == 1)
					$nomePagina = Xml_interface_file_analyzer::getScalarProperty ( $appXmlDir1 . DIR_SEP . $file, "pageName" );
				else
					$nomePagina = $filesItems [1];
				$serializer->setPageName ( $nomePagina );
				$serializer->setLoadInterfaceAsString ( true );
				$serializer->loadData ();
				$items = $serializer->getItems ();
				foreach ( $items as $ind => $val ) {
					if ($ind == "dataFieldsDomains") {
						foreach ( $val as $ind2 => $val2 ) {
							if ($val2 == "object")
								if (($items ["dataFieldsDomainsValues"] [$ind2]->getItemName() == $actId)&&(! in_array($file,$parents)))
									$parents [$i ++] = $file;
						}
					}
				}
				foreach ( $items as $ind => $val ) {
					if ((strpos ( $ind, "interfacesContainer" ) !== false)/*&&($ind !== "ind_interfacesContainer")&&(! is_null($val))*/){
						$intCont = $val;
						if(is_string($intCont))
							echo $file;
						$intContIter = $intCont->create ();
						while ( $intContIter->hasMore () ) {
							$val2 = $intContIter->current ()->getItemName();
							if (($val2 == $actId)&&(! in_array($file,$parents)))
								$parents [$i ++] = $file;
							$intContIter->next ();
						}
					}
				}
			}
		}
		return $parents;
	}
}
class AjaxOpFilterParentsInterfacesFiles extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_FILTER_PARENTS_INTERFACES_FILES );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
	  $intObjName = $_POST["sourceInt"];
	  $i=0;
	  foreach($_POST as $ind=>$val)
	  {
	  	if($ind !== "sourceInt")
	  	 $vet[$i++]=$val;
	  }
		$newVet = array ();
		$parents = Xml_interface_serializer::getFamilyParents ( $appName, $intObjName );
		$parents1 = Xml_interface_serializer::getInterfacesContainerParents ( $appName, $intObjName );
		$parents2 = array_assoc_concat ( $parents, $parents1 );
		$parents2 = array_unique ( $parents2 );
		$parents2 = array_values ( $parents2 );
		foreach ( $vet as $ind => $intName ) {
			if (! in_array ( $intName, $parents2 ))
				$newVet [$ind] = $intName;
		}
		return $newVet;
	}
}
class AjaxOpGetAllInterfacesOfPage extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_ALL_INTERFACES_OF_PAGE );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$page = $actId;
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		$files = scandir ( $appXmlDir );
		$interfaces = array ();
		$i = 0;
		foreach ( $files as $ind => $file ) {
			$fileItems = explode ( FILE_NAME_ELEMENTS_SEP, $file );
			$fileItemsNum = count ( $fileItems );
			if (((! is_dir ( $file )) && ($fileItemsNum == 1))||
			((! is_dir ( $file))&&($fileItemsNum == 2)&&($fileItems[1]==XML_SUFFIX))) {
				$interfaceItems = Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir . DIR_SEP . $file );
				$interfaceAppItem = $interfaceItems [0];
				$interfacePageName = $interfaceItems [1];
				if (($interfaceAppItem == $appName) && (($interfacePageName == $actId) || ($interfacePageName == STRING_NULL)))
					$interfaces [$i ++] = $file;
			}
		}
		return $interfaces;
	}
}
class AjaxOpSqlServerImport extends AjaxOp {
	private $scope = STRING_NULL;
	
	function __construct() {
		parent::__construct ( AJAX_OP_SQL_SERVER_IMPORT );
	}
	function setTable($actTable):void {
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		Xml_db_model::setTable ( $appName, $actTable );
	}
	function translateSqlServerFieldsTypes(array $actFieldsTypes):array {
		$appDir = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$fieldsTypes = $actFieldsTypes;
		$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
		DIR_SEP . "sqlsrv_types" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
		$xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$appFileName); 
		$xmlSerializer->loadData ();
		$transTable = $xmlSerializer->getItems ();
		$found = false;
		foreach ( $fieldsTypes as $ind => $type ) {
			foreach ( $transTable as $ind2 => $item ) {
				$sqlServerType = trim ( $item ["sqlServerType"] );
				$type = trim ( $type );
				if (preg_match ( STRING_SLASH . "^" . $sqlServerType . STRING_SLASH, $type ) > 0) {
					$genericType = trim ( $item ["genericType"] );
					$found = true;
					break;
				}
			}
			if ($found) {
				$fieldsTypes [$ind] = $genericType;
				$found = false;
			} else
				$fieldsTypes [$ind] = "STRING";
		}
		return $fieldsTypes;
	}
	function setFieldsProps(string $actTable):void {
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$tablePos = Xml_db_model::getTablePos ( $appName, $actTable );
		
		$queryStr = "SELECT " . SQLSRV_DB . ".sys.columns.name, " . 
		SQLSRV_DB . ".sys.types.name as type " . "FROM   (" . SQLSRV_DB . 
		".sys.tables  inner join  " . SQLSRV_DB . ".sys.columns " . 
		"on " . SQLSRV_DB . ".sys.tables.object_id=" . SQLSRV_DB . 
		".sys.columns.object_id) " . "inner join " . SQLSRV_DB . 
		".sys.types on " . SQLSRV_DB . ".sys.columns.user_type_id = " . 
		SQLSRV_DB . ".sys.types.user_type_id " . "where " . SQLSRV_DB .
		 ".sys.tables.name='" . $actTable . "'";
		$scope = $this->getScope();
		$getAllDataByQuery = $scope . STRING_BACKSLASH . "getAllDataByQuery";
		$results = $getAllDataByQuery ( $queryStr );
		if (is_array ( $results ) && (count ( $results ) > 0)) {
			$fieldsNames = array ();
			$fieldsTypes = array ();
			foreach ( $results as $ind => $res ) {
				$fieldsNames [$ind] = $res ['name'];
				$fieldsTypes [$ind] = $res ['type'];
			}
			
			$fieldsTypes = $this->translateSqlServerFieldsTypes ( $fieldsTypes );
			
			$appDir = $_SESSION [SESSION_VAR_ACTIVE_APP];
			
			$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
			DIR_SEP . "fields_definition_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
			$xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
			$xmlSerializer->loadData ();
			$allItems = $xmlSerializer->getItems ();
			$sectionsObj = $allItems [0];
			$sectionsArray = $sectionsObj->getItem ();
			
			$appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
			DIR_SEP . "fields_consts_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
			$xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2);
			$xmlSerializer2->loadData ();
			$allItems2 = $xmlSerializer2->getItems ();
			$blockDefObj1 = $allItems2 [0];
			$blockDefArray1 = $blockDefObj1->getItem ();

		  //Patch per includere namespace	
		  
		  $blockDef1 = $blockDefArray1[0];
		  unset($blockDefArray1[0]);
			
			$fieldsNamesArgsArray1 = array ();
			$fieldsNamesArgsArray2 = array ();
			$fieldsConsts = array ();
			$fieldsNum = count ( $fieldsNames );
			
			for($m = 0; $m <= $fieldsNum - 1; $m = $m + 1) {
				$stringObj3 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,"FIELD" . CONST_SEP . strToUpper ( trim ( $fieldsNames [$m] ) ) );
				$stringObj3->setType ( String_item::SINGLE_QUOTED );
				$argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj3);
				$fieldsNamesArgsArray1 [$m] = $argObj3;
				$fieldsConsts [$m] = "FIELD" . CONST_SEP . strToUpper ( trim ( $fieldsNames [$m] ) );
				$stringObj4 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$fieldsNames[$m]);
				$stringObj4->setType ( String_item::DOUBLE_QUOTED );
				$argObj4 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj4);
				$fieldsNamesArgsArray2 [$m] = $argObj4;
			}
			
			$defArray = array ();
			for($n = 0; $n <= $fieldsNum - 1; $n ++) {
				$exprItemString = STRING_EXCLAMATION_MARK . STRING_SPACE . 
				"defined" . STRING_OPEN_PAR . STRING_SINGLE_QUOTE . 
				strToUpper ( $fieldsConsts [$n] ) . STRING_SINGLE_QUOTE . STRING_CLOSE_PAR;
				$exprItem = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,$exprItemString);
				$fieldsNamesFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL, array (
						$fieldsNamesArgsArray1 [$n],
						$fieldsNamesArgsArray2 [$n] 
				));
				$fieldsNamesFunctionCallObj->setName ( "define" );
				$defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array (
						$fieldsNamesFunctionCallObj 
				));
				$ifElseItemArray = array (
						$exprItem,
						$defObj 
				);
				$ifElseItemObj = Creator::create(getClassNameForCreate(Classes_info::IF_ELSE_ITEM_CLASS),STRING_NULL,$ifElseItemArray);
				$defArray [$n] = $ifElseItemObj;
			}
			
			$l = 0;
			$found = false;
			foreach ( $blockDefArray1 as $ind => $blockDefObj2 ) {
				if ($l == $tablePos) {
					$blockDefObj2->setItem ( $defArray );
					$blockDefArray1 [$ind] = $blockDefObj2;
					$blockDefObj1->setItem ( $blockDefArray1 );
					$found = true;
					break;
				}
				$l ++;
			}
			if (! $found) {
				$blockDefObj2 = Creator::create(getClassNameForCreate(Classes_info::BLOCK_DEF_ITEM_CLASS),STRING_NULL,$defArray);
				$blockDefArray1 [] = $blockDefObj2;
				$blockDefObj1->setItem ( $blockDefArray1 );
			}

      //Patch per includere namespace
 			
			$i=0;
			$blockDefArray2A = array();
			$blockDefArray2A[0] = $blockDef1;
			
			foreach($blockDefArray1 as $ind1=>$val1)
			{
				$blockDefArray2A[] = $val1;
			}
			$blockDefObj1->setItem ( $blockDefArray2A );
			
			$xmlSerializer2->loadItems ( $allItems2 );
			$xmlSerializer2->saveData ();
			
			$fieldsNamesArgsArray = array ();
			$fieldsTypesArgsArray = array ();
			
			// Aggiungo tutti i campi
			
			for($k = 0; $k <= $fieldsNum - 1; $k = $k + 1) {
				$constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"FIELD" . CONST_SEP . strToUpper ( trim ( $fieldsNames [$k] ) ));
				$constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"FIELD_TYPE" . CONST_SEP . trim ( $fieldsTypes [$k] ));
				$argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
				$argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj2);
				$fieldsNamesArgsArray [$k] = $argObj1;
				$fieldsTypesArgsArray [$k] = $argObj2;
			}
			
			$fieldsNamesFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$fieldsNamesArgsArray);
			$fieldsNamesFunctionCallObj->setName ( "array" );
			$fieldsTypesFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$fieldsTypesArgsArray);
			$fieldsTypesFunctionCallObj->setName ( "array" );
			
			$sectionArray = array ();
			
			// Definisco i campi
			
			$varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fields");
			$defArray1 = array (
					$varObj3,
					$fieldsNamesFunctionCallObj 
			);
			$defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray1);
			$sectionArray [0] = $defObj1;
			
			$varObj0 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst ( strToLower ( $actTable ) ) );
			$varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fields");
			$argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj1);
			$methodCallArray1 = array (
					$varObj0,
					$argObj1 
			);
			$methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
			$methodCallObj1->setName ( "setFields" );
			$defArray = array (
					$methodCallObj1 
			);
			$defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);
			$sectionArray [1] = $defObj;
			
			// Definisco i tipi dei campi
			
			$varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fieldsTypes");
			$defArray2 = array (
					$varObj4,
					$fieldsTypesFunctionCallObj 
			);
			$defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray2);
			$sectionArray [2] = $defObj2;
			
			$varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst ( strToLower ( $actTable ) ));
			$varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fieldsTypes");
			$argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj1);
			$methodCallArray1 = array (
					$varObj2,
					$argObj2 
			);
			$methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
			$methodCallObj1->setName ( "setFieldsTypes" );
			$defArray = array (
					$methodCallObj1 
			);
			$defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);
			$sectionArray [3] = $defObj;
			
			// Definisco la chiave primaria;
			
			$constObj = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"FIELD_ID" . CONST_SEP . strToUpper ( trim ( $actTable ) ));
			$argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj);
			$keyFieldArgsArray = array (
					$argObj 
			);
			$keyFieldFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$keyFieldArgsArray);
			$keyFieldFunctionCallObj->setName ( "array" );
			$varObj = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"keyFields");
			$defArray = array (
					$varObj,
					$keyFieldFunctionCallObj 
			);
			$defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);
			$sectionArray [4] = $defObj;
			
			$varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst ( strToLower ( $actTable ) ));
			$varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"keyFields");
			$argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj1);
			$methodCallArray1 = array (
					$varObj2,
					$argObj2 
			);
			$methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
			$methodCallObj1->setName ( "setKeyFields" );
			$defArray = array (
					$methodCallObj1 
			);
			$defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);
			$sectionArray [5] = $defObj;
			
			// Definisco le candKeyFields;
			
			$functionCallObj1 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
			$functionCallObj1->setName ( "array" );
			$varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"candKeyFields");
			$defArray = array (
					$varObj3,
					$functionCallObj1 
			);
			$defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);
			$sectionArray [6] = $defObj;
			
			$varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst ( strToLower ( $actTable ) ));
			$varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"candKeyFields");
			$argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj1);
			$methodCallArray1 = array (
					$varObj2,
					$argObj2 
			);
			$methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
			$methodCallObj1->setName ( "setCandKeyFields" );
			$defArray = array (
					$methodCallObj1 
			);
			$defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);
			$sectionArray [7] = $defObj;
			
			// Definisco le chiavi esterne
			
			$functionCallObj1 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
			$functionCallObj1->setName ( "array" );
			$varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"extKeyFields");
			$defArray = array (
					$varObj3,
					$functionCallObj1 
			);
			$defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);
			$sectionArray [8] = $defObj;
			
			$varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst ( strToLower ( $actTable ) ) );
			$varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"extKeyFields");
			$argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj1);
			$methodCallArray1 = array (
					$varObj2,
					$argObj2 
			);
			$methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
			$methodCallObj1->setName ( "setExtKeyFields" );
			$defArray = array (
					$methodCallObj1 
			);
			$defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);
			$sectionArray [9] = $defObj;
			
			$j = 0;
			$found = false;
			foreach ( $sectionsArray as $ind => $val ) {
				if ($j == $tablePos) {
					$sectionObj = $sectionsArray [$ind];
					$sectionObj->setItem ( $sectionArray );
					$found = true;
					break;
				}
				$j ++;
			}
			if ($found == false) {
				$sectionObj = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionArray);
				$sectionObj->setName ( "fields_definition" . STRING_UNDERSCORE . $j );
				$sectionsArray [$j] = $sectionObj;
			}
			$sectionsObj->setItem ( $sectionsArray );
			$xmlSerializer->loadItems ( $allItems );
			$xmlSerializer->saveData ();
		}
	}
	function setPk(string $actTable):void {
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$tablePos = Xml_db_model::getTablePos ( $appName, $actTable );
		
		$queryStr = "SELECT COLUMN_NAME  as name " . "FROM " . SQLSRV_DB . 
		".INFORMATION_SCHEMA.KEY_COLUMN_USAGE " . "where TABLE_NAME='" . 
		$actTable . "' and CONSTRAINT_NAME in " . "(select name from " . SQLSRV_DB . 
		".sys.key_constraints " . "where type_desc='PRIMARY_KEY_CONSTRAINT')";
		$scope = $this->getScope();
		$getAllDataByQuery = $scope . STRING_BACKSLASH . "getAllDataByQuery";
		$results = $getAllDataByQuery ( $queryStr );
		if (is_array ( $results ) && (count ( $results ) > 0)) {
			$pkName = $results [0] ["name"];
			
			$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
			$appDir = $appName;
			$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
			XML_DIR . DIR_SEP . "fields_definition_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
			$xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
			$xmlSerializer->loadData ();
			$allItems = $xmlSerializer->getItems ();
			$sectionsObj = $allItems [0];
			$sectionsArray = $sectionsObj->getItem ();
			if (count ( $sectionsArray ) > 0) {
				$sectionObj = $sectionsArray [$tablePos];
				$sectionInnerArray = $sectionObj->getItem ();
				$defObj = $sectionInnerArray [4];
				$defArray = $defObj->getItem ();
				$functionObj = $defArray [1];
				$functionArray = $functionObj->getItem ();
				$argObj = $functionArray [0];
				$constObj = $argObj->getItem ();
				$constObj->setItem ( "FIELD" . CONST_SEP . strToUpper ( $pkName ) );
			}
			$sectionsObj->setItem ( $sectionsArray );
			$xmlSerializer->loadItems ( $allItems );
			$xmlSerializer->saveData ();
		}
	}
	function setExternals(string $actTable):void {
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
		DIR_SEP . "db_objects_definition_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
		$tableName = $actTable;
		$xmlserializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
		$xmlSerializer->loadData ();
		$allItems = $xmlSerializer->getItems ();
		$sectionsObj = $allItems [0];
		$sectionsArray = $sectionsObj->getItem ();
		$sectionObj = $sectionsArray [0];
		$defsArray = $sectionObj->getItem ();
		$i = 0;
		foreach ( $defsArray as $ind => $val ) {
			$defObj = $val;
			$defInnerArray = $defObj->getItem ();
			$varObj = $defInnerArray [0];
			$varObjItem = $varObj->getItem ();
			if (trim ( $varObjItem ) == ("dbObj" . $tableName))
				break;
			$i ++;
		}
		$tablePos = $i;
		
		$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
		DIR_SEP . "fields_definition_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
		$xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
		$xmlSerializer1->loadData ();
		$allItems1 = $xmlSerializer1->getItems ();
		$sectionsObj1 = $allItems1 [0];
		$sectionsArray1 = $sectionsObj1->getItem ();
		
		$queryStr = "select " . SQLSRV_DB . ".sys.tables.name " . "from " . 
		SQLSRV_DB . ".sys.tables " . "where " . SQLSRV_DB . ".sys.tables.object_id in(" . 
		"select " . SQLSRV_DB . ".sys.foreign_key_columns.referenced_object_id from " . 
		"((" . SQLSRV_DB . ".sys.foreign_keys inner join " . SQLSRV_DB . ".sys.tables " . 
		"on " . SQLSRV_DB . ".sys.foreign_keys.parent_object_id = " . SQLSRV_DB . 
		".sys.tables.object_id) " . "inner join " . SQLSRV_DB . ".sys.foreign_key_columns on " . 
		SQLSRV_DB . ".sys.foreign_keys.object_id = " . SQLSRV_DB . ".sys.foreign_key_columns.constraint_object_id) " . 
		"where " . SQLSRV_DB . ".sys.tables.name = '" . $actTable . "')";
		$scope = $this->getScope();
		$getAllDataByQuery = $scope . STRING_BACKSLASH . "getAllDataByQuery";
		$results = $getAllDataByQuery ( $queryStr );
		$extTables = array ();
		$extFields = array ();
		if (is_array ( $results ) && (count ( $results ) > 0)) {
			foreach ( $results as $ind => $result ) {
				$extTables [$ind] = $result ["name"];
				$extTable = $result ["name"];
				$queryStr2 = "select " . SQLSRV_DB . ".sys.columns.name from " . 
				"(((" . SQLSRV_DB . ".sys.foreign_keys inner join " . SQLSRV_DB . 
				".sys.tables " . "on " . SQLSRV_DB . ".sys.foreign_keys.parent_object_id = " . 
				SQLSRV_DB . ".sys.tables.object_id)" . "inner join " . SQLSRV_DB . 
				".sys.foreign_key_columns on " . SQLSRV_DB . ".sys.foreign_keys.object_id=" . 
				SQLSRV_DB . ".sys.foreign_key_columns.constraint_object_id)" . 
				"inner join " . SQLSRV_DB . ".sys.columns on " . SQLSRV_DB . 
				".sys.foreign_key_columns.parent_column_id = " . SQLSRV_DB . 
				".sys.columns.column_id and " . SQLSRV_DB . ".sys.columns.object_id = " . 
				SQLSRV_DB . ".sys.tables.object_id)" . "where " . SQLSRV_DB . 
				".sys.tables.name='" . $actTable . "' and " . SQLSRV_DB . 
				".sys.foreign_keys.referenced_object_id in " . "(select " . SQLSRV_DB . 
				".sys.tables.object_id from " . SQLSRV_DB . ".sys.tables " . "where " . 
				SQLSRV_DB . ".sys.tables.name='" . $extTable . "')";
				$results2 = $getAllDataByQuery ( $queryStr2 );
				if (is_array ( $results2 ) && (count ( $results2 ) > 0))
					$extFields [$ind] = $results2 [0] ["name"];
			}
			$j = 0;
			foreach ( $sectionsArray1 as $ind => $val ) {
				if ($j == $tablePos) {
					$sectionObj = $sectionsArray1 [$j];
					$defsArray = $sectionObj->getItem ();
					$defObj = $defsArray [8];
					$defArray = $defObj->getItem ();
					$functionCall = $defArray [1];
					$argsArray = array ();
					$num1 = count ( $extTables );
					for($k = 0; $k <= $num1 - 1; $k ++) {
						$constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"TABELLA" . CONST_SEP . strToUpper ( $extTables [$k] ));
						$extKeyItem = $extFields [$k];
						$constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"FIELD" . CONST_SEP . strToUpper ( $extKeyItem ));
						$constArray = array (
								$constObj1,
								$constObj2 
						);
						$assObj = Creator::create(getClassNameForCreate(Classes_info::ASSOCIATIVE_ITEM_CLASS),STRING_NULL,$constArray);
						$argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$assObj);
						$argsArray [$k] = $argObj;
					}
					$functionCall->setItem ( $argsArray );
				}
				$j ++;
			}
			$xmlSerializer1->loadItems ( $allItems1 );
			$xmlSerializer1->saveData ();
		}
	}
	function set1NRelations(string $actTable):void {
		$queryStr = "select " . SQLSRV_DB . ".sys.tables.name " . "from " . SQLSRV_DB . 
		".sys.tables " . "where " . SQLSRV_DB . ".sys.tables.object_id in(" . "select " . 
		SQLSRV_DB . ".sys.foreign_key_columns.referenced_object_id from " . "((" . 
		SQLSRV_DB . ".sys.foreign_keys inner join " . SQLSRV_DB . ".sys.tables " . 
		"on " . SQLSRV_DB . ".sys.foreign_keys.parent_object_id = " . SQLSRV_DB . 
		".sys.tables.object_id) " . "inner join " . SQLSRV_DB . ".sys.foreign_key_columns on " . 
		SQLSRV_DB . ".sys.foreign_keys.object_id = " . SQLSRV_DB . ".sys.foreign_key_columns.constraint_object_id) " . 
		"where " . SQLSRV_DB . ".sys.tables.name = '" . $actTable . "')";
		$scope = $this->getScope();
		$getAllDataByQuery = $scope . STRING_BACKSLASH . "getAllDataByQuery";
		$results = $getAllDataByQuery ( $queryStr );
		if (is_array ( $results ) && (count ( $results ) > 0)) {
			$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
			$appDir = $appName;
			$ids = array ();
			for($i = 0; $i <= count ( $results ) - 1; $i ++) {
				$ids [$i + 1] = $results [$i] ["name"];
			}
			$ids [0] = $actTable;
			Xml_db_model::set1NRelations ( $appName, $ids );
		}
	}
	function testPk(string $actTable):void {
		$queryStr = "SELECT COLUMN_NAME  as name " . "FROM " . SQLSRV_DB . 
		".INFORMATION_SCHEMA.KEY_COLUMN_USAGE " . "where TABLE_NAME='" . $actTable . 
		"' and CONSTRAINT_NAME in " . "(select name from " . SQLSRV_DB . ".sys.key_constraints " . 
		"where type_desc='PRIMARY_KEY_CONSTRAINT')";
		$scope = $this->getScope();
		$getAllDataByQuery = $scope . STRING_BACKSLASH . "getAllDataByQuery";
		$results = $getAllDataByQuery ( $queryStr );
		if (is_array ( $results ) && (count ( $results ) > 0))
			if (count ( $results ) > 1) {
				$e = Creator::create("Exception",STRING_BACKSLASH,MSG_30 . $actTable);
				throw $e;
			}
	}
	function testExternals(string $actTable):void {
		$queryStr = "select " . SQLSRV_DB . ".sys.tables.name " . "from " . SQLSRV_DB . 
		".sys.tables " . "where " . SQLSRV_DB . ".sys.tables.object_id in(" . "select " . 
		SQLSRV_DB . ".sys.foreign_key_columns.referenced_object_id from " . "((" . 
		SQLSRV_DB . ".sys.foreign_keys inner join " . SQLSRV_DB . ".sys.tables " . 
		"on " . SQLSRV_DB . ".sys.foreign_keys.parent_object_id = " . SQLSRV_DB . 
		".sys.tables.object_id) " . "inner join " . SQLSRV_DB . ".sys.foreign_key_columns on " . 
		SQLSRV_DB . ".sys.foreign_keys.object_id = " . SQLSRV_DB . ".sys.foreign_key_columns.constraint_object_id) " . 
		"where " . SQLSRV_DB . ".sys.tables.name = '" . $actTable . "')";
		$scope = $this->getScope();
		$getAllDataByQuery = $scope . STRING_BACKSLASH . "getAllDataByQuery";
		$results = $getAllDataByQuery ( $queryStr );
		if (is_array ( $results ) && (count ( $results ) > 0))
			foreach ( $results as $ind => $result ) {
				$extTable = $result ["name"];
				$queryStr2 = "select " . SQLSRV_DB . ".sys.columns.name from " . "(((" . 
				SQLSRV_DB . ".sys.foreign_keys inner join " . SQLSRV_DB . ".sys.tables " . 
				"on " . SQLSRV_DB . ".sys.foreign_keys.parent_object_id = " . SQLSRV_DB . 
				".sys.tables.object_id)" . "inner join " . SQLSRV_DB . ".sys.foreign_key_columns on " . 
				SQLSRV_DB . ".sys.foreign_keys.object_id=" . SQLSRV_DB . ".sys.foreign_key_columns.constraint_object_id)" . 
				"inner join " . SQLSRV_DB . ".sys.columns on " . SQLSRV_DB . ".sys.foreign_key_columns.parent_column_id = " . 
				SQLSRV_DB . ".sys.columns.column_id and " . SQLSRV_DB . ".sys.columns.object_id = " . 
				SQLSRV_DB . ".sys.tables.object_id)" . "where " . SQLSRV_DB . ".sys.tables.name='" . 
				$actTable . "' and " . SQLSRV_DB . ".sys.foreign_keys.referenced_object_id in " . "(select " .
				 SQLSRV_DB . ".sys.tables.object_id from " . SQLSRV_DB . ".sys.tables " . "where " . SQLSRV_DB . 
				 ".sys.tables.name='" . $extTable . "')";
				$results2 =  $getAllDataByQuery ( $queryStr2 );
				if (is_array ( $results2 ) && (count ( $results2 ) > 0)) {
					if (count ( $results2 ) > 1) {
						$e = Creator::create("Exception",STRING_BACKSLASH,MSG_31 . $actTable);
						throw $e;
					}
					$columnName = $results2 [0] ["name"];
				} else
					$columnName = STRING_NULL;
			}
	}
	function importTables(string $actTable):void {
		$this->setTable ( $actTable );
		$this->setFieldsProps ( $actTable );
		$this->setPk ( $actTable );
	}
	function testFormats(string $actTable):void {
		try {
			$this->testPk ( $actTable );
			$this->testExternals ( $actTable );
		} catch ( \Exception $e ) {
			throw $e;
		}
	}
	function testRelations(string $actTable, array $actImportingTables):void {
		$queryStr = "select " . SQLSRV_DB . ".sys.tables.name " . "from " . SQLSRV_DB . 
		".sys.tables " . "where " . SQLSRV_DB . ".sys.tables.object_id in(" . "select " . 
		SQLSRV_DB . ".sys.foreign_key_columns.referenced_object_id from " . "((" . SQLSRV_DB . 
		".sys.foreign_keys inner join " . SQLSRV_DB . ".sys.tables " . "on " . SQLSRV_DB . 
		".sys.foreign_keys.parent_object_id = " . SQLSRV_DB . ".sys.tables.object_id) " . 
		"inner join " . SQLSRV_DB . ".sys.foreign_key_columns on " . SQLSRV_DB . 
		".sys.foreign_keys.object_id = " . SQLSRV_DB . ".sys.foreign_key_columns.constraint_object_id)" . 
		"where " . SQLSRV_DB . ".sys.tables.name='" . $actTable . "')";
		
		$scope = $this->getScope();
		$getAllDataByQuery = $scope . STRING_BACKSLASH . "getAllDataByQuery";
		$results = $getAllDataByQuery ( $queryStr );
		$found = false;
		$j = 0;
		if (is_array ( $results ) && (count ( $results ) > 0)) {
			$dim = count ( $results );
			foreach ( $results as $ind => $result ) {
				$extTable = $result ["name"];
				if (in_array ( $extTable, $actImportingTables )) {
					$j ++;
					continue;
				}
				$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
				$appDir = $appName;
				$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . DIR_SEP . 
				"db_objects_definition_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
				
				$xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
				$xmlSerializer->loadData ();
				$allItems = $xmlSerializer->getItems ();
				$sectionsObj = $allItems [0];
				$sectionsArray = $sectionsObj->getItem ();
				$sectionObj = $sectionsArray [0];
				$defsArray = $sectionObj->getItem ();
				foreach ( $defsArray as $ind => $defObj ) {
					$defElsArray = $defObj->getItem ();
					$methodCallObj = $defElsArray [1];
					$argsArray = $methodCallObj->getItem ();
					$argsObj = $argsArray [2];
					$constObj = $argsObj->getItem ();
					$constObjItem = $constObj->getItem ();
					$constEl = getOriginalItemName ( $constObjItem );
					if ($constEl == $extTable) {
						$found = true;
						break;
					}
				}
				if (! $found)
					break;
				else
					$found = false;
				$j ++;
			}
			if ($j < $dim) {
				$e = Creator::create("Exception",STRING_BACKSLASH,MSG_33 . $actTable . MSG_34 . $extTable . MSG_35); 
				throw $e;
			}
		}
	}
	function importRelations(string $actTable):void {
		$this->setExternals ( $actTable );
		$this->set1NRelations ( $actTable );
	}
	
	function setScope(string $actScope):void
	{
		$this->scope = $actScope;
	}
	
	function getScope():string
	{
		return $this->scope;
	}
	
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$ids = explode ( STRING_SEMICOLON, $actId );
		
		$scope = $_SESSION[SESSION_VAR_ACTIVE_APP] . STRING_BACKSLASH . FW_DIR ;
		$this->setScope($scope);
		
		$res = 'true';
		if ($ids [0] != STRING_NULL) {
			foreach ( $ids as $ind => $table ) {
				try {
					$this->testFormats ( $table );
				} catch ( \Exception $e ) {
					$res = $e->getMessage ();
					return $res;
				}
			}
			
			foreach ( $ids as $ind => $table ) {
				$this->importTables ( $table, $ids );
			}
			
			foreach ( $ids as $ind => $table ) {
				try {
					$this->testRelations ( $table, $ids );
				} catch ( \Exception $e ) {
					$res = $e->getMessage ();
					return $res;
				}
			}
			
			foreach ( $ids as $ind => $table ) {
				$this->importRelations ( $table );
			}
		}
		return $res;
	}
}
class AjaxOpTestConnection extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_TEST_CONNECTION );
	}
	function exec_1(string $actId):array|string|bool|null {
		try {
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		require_once(PREVIOUS_DIR . STRING_BACKSLASH . $appName .  
    STRING_BACKSLASH  . FRAMEWORK_DIR . STRING_BACKSLASH . "db_op.fun.php");
    $scope = STRING_BACKSLASH . $appName .  
    STRING_BACKSLASH   . FRAMEWORK_DIR . 
    STRING_BACKSLASH;
		eval("\$res = " . $scope . "testConnection ();");
        return $res;		
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
}
class AjaxOpViewAllFieldsOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_ALL_FIELDS_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpViewAllFieldsOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_ALL_FIELDS_OP2 );
	}
	function getFieldsProps(int|string $actPos):array {
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$ids = $actPos;
		$retStruct = array ();
		$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . DIR_SEP . 
		"fields_definition_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
		$xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
		$xmlSerializer->loadData ();
		$allItems = $xmlSerializer->getItems ();
		$sectionsObj = $allItems [0];
		$sectionsArray = $sectionsObj->getItem ();
		$retStruct = array ();
		if (count ( $sectionsArray ) > 0) {
			$sectionObj = $sectionsArray [$ids];
			$sectionInnerArray = $sectionObj->getItem ();
			$defObj = $sectionInnerArray [0];
			$defObjInnerArray = $defObj->getItem ();
			$functionCallObj = $defObjInnerArray [1];
			$functionCallObjInnerArray = $functionCallObj->getItem ();
			$i = 0;
			$j = 0;
			$allFields = array ();
			foreach ( $functionCallObjInnerArray as $ind => $val ) {
				$argObj = $val;
				$constObj = $argObj->getItem ();
				$allFields [$j] = $constObj->getItem ();
				if (! Xml_db_model::isAForeignKey ( $sectionInnerArray [8], $allFields [$j ++] )) {
					$retStruct [$i] = array ();
					$retStruct [$i ++] ["Field"] = getOriginalItemName ( $constObj->getItem () );
				}
			}
			$defObj2 = $sectionInnerArray [2];
			$defObjInnerArray2 = $defObj2->getItem ();
			$functionCallObj2 = $defObjInnerArray2 [1];
			$functionCallObjInnerArray2 = $functionCallObj2->getItem ();
			$i = 0;
			$j = 0;
			foreach ( $functionCallObjInnerArray2 as $ind2 => $val2 ) {
				$argObj2 = $val2;
				$constObj2 = $argObj2->getItem ();
				$fieldTypeItems = explode ( CONST_SEP, $constObj2->getItem () );
				$fieldTypeItemsNum = count ( $fieldTypeItems );
				$fieldType = $fieldTypeItems [2];
				for($k = 3; $k <= $fieldTypeItemsNum - 1; $k ++)
					$fieldType = $fieldType . VAR_SEP . $fieldTypeItems [$k];
				if (! Xml_db_model::isAForeignKey ( $sectionInnerArray [8], $allFields [$j ++] ))
					$retStruct [$i ++] ["Type"] = $fieldType;
			}
		}
		return $retStruct;
	}
	function exec_1(string $actId):array|string|bool|null {
		$dataSource = $this->getFieldsProps ( $actId );
		return $dataSource;
	}
}
class AjaxOpViewAllTablesOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_ALL_TABLES_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpViewAllTablesOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_ALL_TABLES_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$tables1 = array ();
		$tables = Xml_db_model::getDbObjsDefProps ( $appName );
		foreach ( $tables as $ind => $table ) {
			$tableArray = array ();
			$tableArray ["Table"] = $table;
			$tables1 [$ind] = $tableArray;
		}
		return $tables1;
	}
}
class AjaxOpViewAllRelationsOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_ALL_RELATIONS_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpViewAllRelationsOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_ALL_RELATIONS_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::getAllRelations ( $appName );
	}
}
class AjaxOpViewAllQueriesOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_ALL_QUERIES_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpViewAllQueriesOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_ALL_QUERIES_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$queries = Xml_db_model::getAllQueriesFromRepository ( $appName );
		return $queries;
	}
}
class AjaxOpSqlServerCreateTable extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SQL_SERVER_CREATE_TABLE );
	}
	function translateGenericFieldsTypesToSqlServer(array $actFieldsTypes):array {
		$appDir = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$fieldsTypes = $actFieldsTypes;
		$appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
		XML_DIR . DIR_SEP . "sqlsrv_types" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
		$xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$appFileName);
		$xmlSerializer->loadData ();
		$transTable = $xmlSerializer->getItems ();
		$found = false;
		foreach ( $fieldsTypes as $ind => $type ) {
			foreach ( $transTable as $ind2 => $item ) {
				if (isset ( $item ["default"] )) {
					$genericType = trim ( $item ["genericType"] );
					$type = trim ( $type );
					if (preg_match ( STRING_SLASH . "^" . $genericType . STRING_SLASH, $type ) > 0) {
						$sqlServerType = trim ( $item ["sqlServerType"] );
						$found = true;
						break;
					}
				}
			}
			if ($found) {
				if ($genericType == "STRING")
					$sqlServerType = $sqlServerType . "(255)";
				$fieldsTypes [$ind] = $sqlServerType;
				$found = false;
			} else
				$fieldsTypes [$ind] = "nvarchar";
		}
		return $fieldsTypes;
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$tableName = $actId;
		$scope = $_SESSION[SESSION_VAR_ACTIVE_APP] . STRING_BACKSLASH . FW_DIR ;
		$getAllDataByQuery = $scope . STRING_BACKSLASH . "getAllDataByQuery";

		$tables = $getAllDataByQuery ( "Select name from " . SQLSRV_DB . STRING_POINT . "sys" . STRING_POINT . "tables" );
		foreach ( $tables as $ind => $table ) {
			if ($tableName == $table ["name"])
				return MSG_37;
		}
		$tablePos = Xml_db_model::getTablePos ( $appName, $tableName );
		$fields = Xml_db_model::getFields ( $appName, $tablePos );
		$pkField = Xml_db_model::getPkField ( $appName, $tablePos );
		$fieldsTypes = Xml_db_model::getFieldsTypes ( $appName, $tablePos );
		$fieldsTypes = $this->translateGenericFieldsTypesToSqlServer ( $fieldsTypes );
		$foreignKeys = Xml_db_model::getForeignKeys ( $appName, $tablePos );
		$uniqueKeys = Xml_db_model::getUniqueKeys ( $appName, $tablePos );
		echo createTable ( $tableName, $fields, $fieldsTypes, $pkField, $foreignKeys, $uniqueKeys );
		return 'true';
	}
}
class AjaxOpRenameAllItems extends AjaxOp {
	function __construct() {
		return parent::__construct ( AJAX_OP_RENAME_ALL_ITEMS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		//print_r ( $ids );
		Xml_db_model::renameTableInBindingRelationsToObjectsDef ( $appName, $ids );
		Xml_db_model::renameTableInFieldsDefinitionDef ( $appName, $ids );
		Xml_db_model::renameTableInRelationsDefinitionDef ( $appName, $ids );
		Xml_db_model::renameTableInGraphDefinitionDef ( $appName, $ids );
		Xml_db_model::renameTableInStructureDefinitionDef ( $appName, $ids );
		Xml_db_model::renameTableInTablesConstsDef ( $appName, $ids );
		Xml_db_model::renameTableInAliasesDefinitionDef ( $appName, $ids );
		Xml_db_model::renameTableInDbObjDef ( $appName, $ids );
		Xml_db_model::renameTableInDbBinds ( $appName, $ids [0], $ids [1] );
		return true;
	}
}
class AjaxOpCheckIfIsDataSourceQuery extends AjaxOp {
	function __construct() {
		parent::__construct( AJAX_OP_CHECK_IF_IS_DATA_SOURCE_QUERY );
	}
	function exec_1(string $actId):array|string|bool|null {
		global $ricSql2DefRules;
		global $ricSql2DefGrRules;
		
		$lex = Creator::create(getClassNameForCreate(Classes_info::LEXER_3_CLASS),STRING_NULL,STRING_NULL,$actId);
		$lex->setRules ( $ricSql2DefRules );
		
		$parser = Creator::create(getClassNameForCreate(Classes_info::PARSER_CLASS),STRING_NULL,$lex);
		$parser->setGrammarRulesContainer ( $ricSql2DefGrRules );
		if (! $parser->exec ())
			return 'false';
		return 'true';
	}
}
class AjaxOpSetSessionActiveApp extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_SESSION_ACTIVE_APP );
	}
	
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$_SESSION [SESSION_VAR_ACTIVE_APP] = $actId;
		return true;
	}
}
class AjaxOpExportQueryToCsv extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_EXPORT_QUERY_TO_CSV );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		date_default_timezone_set ( "Europe/Rome" );
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$date = date ( "d_m_Y" );
		
		$appDir = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . CSV_DIR;
		
		$appFileName = "query" . STRING_UNDERSCORE . $date;
		
		$files = scandir ( $appDir );
		$i = 0;
		foreach ( $files as $ind => $file ) {
			if (is_file ( $appDir . DIR_SEP . $file )) {
				$fileNameItems = explode ( STRING_UNDERSCORE, $file );
				if (($fileNameItems [0] == "query") && (count ( $fileNameItems ) == 5)) {
					$fileDate = $fileNameItems [1] . STRING_UNDERSCORE . 
					$fileNameItems [2] . STRING_UNDERSCORE . $fileNameItems [3];
					if ($fileDate == $date)
						$i ++;
				}
			}
		}
		$appFileName = $appFileName . STRING_UNDERSCORE
		 . $i . FILE_NAME_ELEMENTS_SEP . CSV_SUFFIX;
		$intCsv = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CSV_TABLE);
		$intCsv->setFileName ( $appFileName );
		$intCsv->setDir($appDir);
    $scope = STRING_BACKSLASH . $appName .  
    STRING_BACKSLASH  . 
    FRAMEWORK_DIR . STRING_BACKSLASH;
		eval("\$dataSource = " . $scope . "getAllDataByQuery(\$actId);");
		$intCsv->setDataSource ( $dataSource );
		//print_r($dataSource);
		//die('AAAAAAAAAAA');
		$intCsv->setFieldsFromDataSource ( true );
		$intCsv->putData ();
		//echo "AAAA";
		return true;
	}
}
class AjaxOpGetDbOpPars extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_DB_OP_PARS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$pars = Xml_db_model::getDbOpPars ( $appName, $actId );
		return $pars;
	}
}
class AjaxOpGetConnection extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_CONNECTION );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$connection = Xml_db_model::getConnection ( $appName, $actId );
		return $connection;
	}
}
class AjaxOpSetConnection extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_CONNECTION );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = $_POST;
		$connectionPos = $ids ["connectionPos"];
		$connectionName = $ids ["connectionName"];
		$oldConnectionName = Xml_db_model::getConnectionName ( $appName, $connectionPos );
		if (($oldConnectionName != false) && ($connectionName != $oldConnectionName))
			Xml_db_model::renameConnectionsNamesInDbBinds ( $appName, $oldConnectionName, $connectionName );
		Xml_db_model::setConnection ( $appName, $ids );
		Xml_db_model::updateBinds ( $appName );
	    //Xml_db_model::createConnectionsStruct ( $appName );
		//Xml_db_model::createDbBinds ( $appName );
		return true;
	}
}

//
// Genera il file php di struttura della base dati.
//
class AjaxOpCreateConnectionsStruct extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CREATE_CONNECTIONS_STRUCT );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appDir = $_SESSION [SESSION_VAR_ACTIVE_APP];
		if ($appDir != STRING_NULL) {
			Xml_db_model::createConnectionsStruct ( $appDir );
			return 'true';
		} else
			return 'false';
	}
}
class AjaxOpViewAllConnectionsOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_ALL_CONNECTIONS_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$connections = Xml_db_model::getAllConnections ( $appName );
		return $connections;
	}
}
class AjaxOpCopyConnectionToDbPars extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_COPY_CONNECTION_TO_DB_PARS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::copyConnectionToDbPars ( $appName, $actId );
	}
}
class AjaxOpViewAllAliasesOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_ALL_ALIASES_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpViewAllAliasesOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_ALL_ALIASES_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$aliases = Xml_db_model::getAllAliases ( $appName, $actId );
		$aliases1 = array ();
		foreach ( $aliases as $ind => $alias ) {
			$aliasArray = array ();
			$aliasArray ["Alias"] = $alias;
			$aliases1 [$ind] = $aliasArray;
		}
		return $aliases1;
	}
}
class AjaxOpSetAllAliases extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_ALL_ALIASES );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		return Xml_db_model::setAllAliases ( $appName, $ids );
	}
}
class AjaxOpCheckIfAliasExists extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CHECK_IF_ALIAS_EXISTS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::checkIfAliasExists ( $appName, $actId );
	}
}
class AjaxOpCheckIfTableExists extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CHECK_IF_TABLE_EXISTS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::checkIfTableExists ( $appName, $actId );
	}
}
class AjaxOpViewTablesAndQueriesOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_TABLES_AND_QUERIES_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpViewTablesAndQueriesOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_TABLES_AND_QUERIES_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$items = array ();
		$items = Xml_db_model::getBindsFromTablesAndQueriesDef ( $appName );
		return $items;
	}
}
class AjaxOpViewTablesAndQueriesOp3 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_TABLES_AND_QUERIES_OP3 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$items = array ();;
		$items = Xml_db_model::getAllConnections ( $appName );
		return $items;
	}
}
class AjaxOpGetNodeType extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_NODE_TYPE );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$items = array ();
		$nodeType = Xml_db_model::getNodeType ( $appName, $actId );
		return $nodeType;
	}
}
class AjaxOpGetBindNodeType extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_BIND_NODE_TYPE );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$items = array ();
		$nodeType = Xml_db_model::getBindNodeType ( $appName, $actId );
		return $nodeType;
	}
}
class AjaxOpGetBindNodeName extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_BIND_NODE_NAME );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$items = array ();
		$nodeType = Xml_db_model::getBindNodeName ( $appName, $actId );
		return $nodeType;
	}
}
class AjaxOpSetAllTablesAndQueriesBinds extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_ALL_TABLES_AND_QUERIES_BINDS );
	}
	function exec_1(string $actId):array|string|bool|null {
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		$idsNum = count ( $ids );
		if($actId !== STRING_NULL)
		{
		 for($i = 0; $i <= $idsNum - 1; $i ++) {
			$binds = explode ( STRING_COLON, $ids [$i] );
			$ids [$i] = $binds;
		 }
		}
		else
		 $ids = array();
		//print_r ( $ids );
		return Xml_db_model::setAllTablesAndQueriesBinds ( $appName, $ids );
	}
}
class AjaxOpSetAllBinds extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_ALL_BINDS );
	}
	function exec_1(string $actId):array|string|bool|null {
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		if($actId !== STRING_NULL)
		{
		 $ids = explode ( STRING_SEMICOLON, $actId );
		 $idsNum = count ( $ids );
		 for($i = 0; $i <= $idsNum - 1; $i ++) {
			$binds = explode ( STRING_COLON, $ids [$i] );
			$ids [$i] = $binds;
		 }
		}
		else
		 $ids = array();
		//print_r ( $ids );
		return Xml_db_model::setAllBinds ( $appName, $ids );
	}
}

//
// Genera il file php di struttura della base dati.
//
class AjaxOpCreateDbBinds extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CREATE_DB_BINDS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appDir = $_SESSION [SESSION_VAR_ACTIVE_APP];
		if($appDir != STRING_NULL)
        {			
	     Xml_db_model::createDbBinds ( $appDir );
		 return 'true'; 
		}
		else
		 return 'false';
	}
}

//
// Genera il file php di struttura della base dati.
//
class AjaxOpUpdateBinds extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_UPDATE_BINDS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appDir = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::updateBinds ( $appDir );
	}
}
class AjaxOpGetTableFromAlias extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_TABLE_FROM_ALIAS );
	}
	function exec_1(string $actId):array|string|bool|null {
		$appDir = $_SESSION [SESSION_VAR_ACTIVE_APP];
		return Xml_db_model::getTableFromAlias ( $appDir, $actId );
	}
}
class AjaxOpGetLayouts extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_LAYOUTS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		$files = scandir ( $appXmlDir );
		$layouts = array ();
		$i = 0;
		foreach ( $files as $ind => $file ) {
			$fileItems = explode ( FILE_NAME_ELEMENTS_SEP, $file );
			$fileItemsNum = count ( $fileItems );
			if (((! is_dir ( $file )) && ($fileItemsNum == 1))||
			((! is_dir ( $file )) && ($fileItemsNum == 2) && ($fileItems[1]==XML_SUFFIX))) {
				$interfaceItems = Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir . DIR_SEP . $file );
				$fileItemsNum2 = count ( $interfaceItems );
				if ($fileItemsNum2 == 6)
					$interfaceType = $interfaceItems [3];
				elseif ($fileItemsNum2 == 5)
					$interfaceType = $interfaceItems [2];
				if ((strpos ( $interfaceType, 'layout' ) !== false)) {
					$layoutAppItem = $interfaceItems [0];
					$layoutPageName = $interfaceItems [1];
					if (($layoutAppItem == $appName) && ($layoutPageName == $actId))
						$layouts [$i ++] = $file;
				}
			}
		}
		return $layouts;
	}
}
class AjaxOpLayoutsOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_LAYOUTS_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpLayoutsOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_LAYOUTS_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		$interfaces = array ();
		$newInterfaces = array ();
		if (is_dir ( $appXmlDir )) {
			$files = scandir ( $appXmlDir );
			$i = 0;
			foreach ( $files as $ind => $file ) {
				$fileItems = explode ( FILE_NAME_ELEMENTS_SEP, $file );
				$fileItemsNum = count ( $fileItems );
				if (((! is_dir ( $file )) && ($fileItemsNum == 1))||
			((! is_dir ( $file )) && ($fileItemsNum == 2) && ($fileItems[1]==XML_SUFFIX))) {
				  if($fileItemsNum == 2)
				   $fileNameReducedSuffix = FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
				  else
				   $fileNameReducedSuffix = STRING_NULL;
					$interfaceItems = Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir . DIR_SEP . $file );
					$interfaceAppItem = $interfaceItems [0];
					$interfacePageName = $interfaceItems [1];
					$interfaceItemsNum = count ( $interfaceItems );
					if ($interfaceItemsNum == 6) {
						$interfaceType = $interfaceItems [3];
						$fileNameReduced = $interfaceItems [3] . 
						Xml_interface_serializer::INTERFACE_NAME_SEP . 
						$interfaceItems [2] . Xml_interface_serializer::INTERFACE_NAME_SEP . 
						$interfaceItems [4] . Xml_interface_serializer::INTERFACE_NAME_SEP .
						 $interfaceItems [5] . $fileNameReducedSuffix;
					} elseif ($interfaceItemsNum == 5) {
						$interfaceType = $interfaceItems [2];
						$fileNameReduced = $interfaceItems [2] . Xml_interface_serializer::INTERFACE_NAME_SEP . 
						$interfaceItems [3] . Xml_interface_serializer::INTERFACE_NAME_SEP . 
						$interfaceItems [4] . $fileNameReducedSuffix;
					}
					if (($interfaceAppItem == $appName) && (($interfacePageName == $actId) || ($interfacePageName == STRING_NULL))) {
						if (($interfacePageName == STRING_NULL) || (Xml_interface_file_analyzer::is_free_interface_file ( $appXmlDir . DIR_SEP . $file )))
							$interfaces [$i ++] = $file;
						else
							$interfaces [$i ++] = $fileNameReduced;
					}
				}
			}
			sort ( $interfaces );
			foreach ( $interfaces as $ind => $val ) {
				$interfaceItems = explode ( Xml_interface_serializer::INTERFACE_NAME_SEP, $val );
				$interfaceItemsNum = count ( $interfaceItems );		
				
				if ($interfaceItemsNum == 1) {
					$intFileName = $interfaceItems [0];
					$interfaceItems [0] = Xml_interface_file_analyzer::getScalarProperty ( $appXmlDir . DIR_SEP . $intFileName, "appName" );
					$interfaceItems [1] = Xml_interface_file_analyzer::getScalarProperty ( $appXmlDir . DIR_SEP . $intFileName, "pageName" );
					$j = 2;
					$obj = Xml_interface_file_analyzer::getScalarProperty ( $appXmlDir . DIR_SEP . $intFileName, "obj" );
					if ($obj !== false)
						$interfaceItems [$j ++] = $obj;
					$interfaceItems [$j ++] = Xml_interface_file_analyzer::getScalarProperty ( $appXmlDir . DIR_SEP . $intFileName, "type" );
					$interfaceItems [$j ++] = Xml_interface_file_analyzer::getScalarProperty ( $appXmlDir . DIR_SEP . $intFileName, "op" );
					$interfaceItems [$j] = Xml_interface_file_analyzer::getScalarProperty ( $appXmlDir . DIR_SEP . $intFileName, "num" );
					$interfaceItemsNum = $j + 1;
				}
				if ($interfaceItemsNum == 3) {
					$interfaceType = $interfaceItems [0];
					$fileNameRestored = $appName . Xml_interface_serializer::INTERFACE_NAME_SEP . 
					$actId . Xml_interface_serializer::INTERFACE_NAME_SEP . $val;
					$intCanonicalName = $fileNameRestored;
				} elseif ($interfaceItemsNum == 4) {
					$interfaceType = $interfaceItems [0];
					$fileNameRestored = $appName . Xml_interface_serializer::INTERFACE_NAME_SEP . 
					$actId . Xml_interface_serializer::INTERFACE_NAME_SEP . 
					$interfaceItems [1] . Xml_interface_serializer::INTERFACE_NAME_SEP . 
					$interfaceItems [0] . Xml_interface_serializer::INTERFACE_NAME_SEP . 
					$interfaceItems [2] . Xml_interface_serializer::INTERFACE_NAME_SEP .
					$interfaceItems [3];
					$intCanonicalName = $fileNameRestored;
				} elseif ($interfaceItemsNum == 5) {
					$interfaceType = $interfaceItems [2];
					$fileNameRestored = $val;
					$intCanonicalName = $interfaceItems [0] . 
					Xml_interface_serializer::INTERFACE_NAME_SEP . 
					$interfaceItems [1] . Xml_interface_serializer::INTERFACE_NAME_SEP . 
					$interfaceItems [2] . Xml_interface_serializer::INTERFACE_NAME_SEP . 
					$interfaceItems [3] . Xml_interface_serializer::INTERFACE_NAME_SEP . 
					$interfaceItems [4];
				} elseif ($interfaceItemsNum == 6) {
					$interfaceType = $interfaceItems [3];
					$fileNameRestored = $val;
					$intCanonicalName = $interfaceItems [0] . Xml_interface_serializer::INTERFACE_NAME_SEP . 
					$interfaceItems [1] . Xml_interface_serializer::INTERFACE_NAME_SEP . 
					($interfaceItems [2] == "OBJ_NONE" ? STRING_NULL : $interfaceItems [2]) . 
					Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [3] . 
					Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [4] .
					Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [5];
				}
				$newInterfaces [$ind] = array (
						FIELD_INTERFACCIA => $fileNameRestored,
						FIELD_TYPE => $interfaceType,
						FIELD_INTERFACE_CANONICAL_NAME => $intCanonicalName 
				);
			}
			return $newInterfaces;
		}
	}
}
class AjaxOpSaveLayout extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SAVE_LAYOUT );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		if ((isset ( $_POST ["pagina"] )) && ($appName != STRING_NULL)) {
			foreach ( $_POST as $ind => $val ) {
				$_POST [$ind] = ($_POST [$ind] == "undefined") ? STRING_NULL : $_POST [$ind];
			}
			
			$pageName = $_POST ["pagina"];
			$appDir = $appName;
			$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
			
			//$dispFields = 
			
			$intType = $_POST ["type"];
			$intOp = $_POST ["op"];
			$intNum = $_POST ["num"];
			$intShortName = $_POST ["shortName"];
			$intFreeName = $_POST ["checkBox_IFreeName"];
			
			if ($intNum === 0)
				$intNum = "0";
			
			$doc = Creator::create("DOMDocument",STRING_BACKSLASH,'1.0');
			$root = $doc->createElement ( Xml_interface_serializer::ROOT_TAG );
			$doc->appendChild ( $root );

			$oldIntName = $_POST["nome_interfaccia"];
			unset($_POST["nome_interfaccia"]);
			$oldIntNameItems = explode(FILE_NAME_ELEMENTS_SEP,$oldIntName);
			$oldIntNameItemsNum = count($oldIntNameItems);
			if(($oldIntNameItemsNum==2)&&($oldIntNameItems[1]==XML_SUFFIX))
			 $intNameSuffix = FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
			else
			 $intNameSuffix = STRING_NULL;	
			
			if (($intShortName == STRING_NULL) || ($intFreeName != "true"))
				$fileName = $appName . Xml_interface_serializer::INTERFACE_NAME_SEP . 
				$pageName . Xml_interface_serializer::INTERFACE_NAME_SEP . $intType . 
				Xml_interface_serializer::INTERFACE_NAME_SEP . $intOp .
				Xml_interface_serializer::INTERFACE_NAME_SEP . $intNum . $intNameSuffix;
			else {
				$fileName = $intShortName;
				$el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "pageName" );
				$el2->setAttribute ( "type", "scalar" );
				$el2->setAttribute ( "id", "pageName" );
				$el3 = $doc->createCDATASection ( $pageName );
				$el3 = $el2->appendChild ( $el3 );
				$el4 = $root->appendChild ( $el2 );
				
				$el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "appName" );
				$el2->setAttribute ( "type", "scalar" );
				$el2->setAttribute ( "id", "appName" );
				$el3 = $doc->createCDATASection ( $appName );
				$el3 = $el2->appendChild ( $el3 );
				$el4 = $root->appendChild ( $el2 );
			}
			
			$el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "type" );
			$el2->setAttribute ( "type", "scalar" );
			$el2->setAttribute ( "id", "type" );
			$el3 = $doc->createCDATASection ( $intType );
			$el3 = $el2->appendChild ( $el3 );
			$el4 = $root->appendChild ( $el2 );
			
			$el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "op" );
			$el2->setAttribute ( "type", "scalar" );
			$el2->setAttribute ( "id", "op" );
			$el3 = $doc->createCDATASection ( $intOp );
			$el3 = $el2->appendChild ( $el3 );
			$el4 = $root->appendChild ( $el2 );
			
			$el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "num" );
			$el2->setAttribute ( "type", "scalar" );
			$el2->setAttribute ( "id", "num" );
			$el3 = $doc->createCDATASection ( $intNum );
			$el3 = $el2->appendChild ( $el3 );
			$el4 = $root->appendChild ( $el2 );
			
			$el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "shortName" );
			$el2->setAttribute ( "type", "scalar" );
			$el2->setAttribute ( "id", "shortName" );
			$el3 = $doc->createCDATASection ( $intShortName );
			$el3 = $el2->appendChild ( $el3 );
			$el4 = $root->appendChild ( $el2 );
			
			$el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "withContainer" );
			$el2->setAttribute ( "type", "scalar" );
			$el2->setAttribute ( "id", "withContainer" );
			$el3 = $doc->createCDATASection ( $_POST ["withContainer"] );
			$el3 = $el2->appendChild ( $el3 );
			$el4 = $root->appendChild ( $el2 );
			
			$el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "containerStyle" );
			$el2->setAttribute ( "type", "scalar" );
			$el2->setAttribute ( "id", "@containerStyle" );
			$el3 = $doc->createCDATASection ( $_POST ["containerStyle"] );
			$el3 = $el2->appendChild ( $el3 );
			$el4 = $root->appendChild ( $el2 );
			
			switch ($intType)
			{
			 case "simple_layout":
			 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "bootstrapEnabled" );
			 $el2->setAttribute ( "type", "scalar" );
			 $el2->setAttribute ( "id", "*bootstrapEnabled" );
			 $el3 = $doc->createCDATASection ( $_POST ["bootstrapEnabled"] );
			 $el3 = $el2->appendChild ( $el3 );
			 $el4 = $root->appendChild ( $el2 );
			 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "bootstrapContainerType" );
			 $el2->setAttribute ( "type", "scalar" );
			 $el2->setAttribute ( "id", "bootstrapContainerType" );
			 $el3 = $doc->createCDATASection ( $_POST ["bootstrapContainerType"] );
			 $el3 = $el2->appendChild ( $el3 );
			 $el4 = $root->appendChild ( $el2 );			 
             break;
             case "two_columns_layout":
			 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "bootstrapEnabled" );
			 $el2->setAttribute ( "type", "scalar" );
			 $el2->setAttribute ( "id", "*bootstrapEnabled" );
			 $el3 = $doc->createCDATASection ( $_POST ["bootstrapEnabled"] );
			 $el3 = $el2->appendChild ( $el3 );
			 $el4 = $root->appendChild ( $el2 );
			 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "bootstrapContainerType" );
			 $el2->setAttribute ( "type", "scalar" );
			 $el2->setAttribute ( "id", "bootstrapContainerType" );
			 $el3 = $doc->createCDATASection ( $_POST ["bootstrapContainerType"] );
			 $el3 = $el2->appendChild ( $el3 );
			 $el4 = $root->appendChild ( $el2 );
			 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "bootstrapViewPortSizeType" );
			 $el2->setAttribute ( "type", "scalar" );
			 $el2->setAttribute ( "id", "bootstrapViewPortSizeType" );
			 $el3 = $doc->createCDATASection ( $_POST ["bootstrapViewPortSizeType"] );
			 $el3 = $el2->appendChild ( $el3 );
			 $el4 = $root->appendChild ( $el2 );
             break;
			 case "three_columns_layout":
			 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "bootstrapEnabled" );
			 $el2->setAttribute ( "type", "scalar" );
			 $el2->setAttribute ( "id", "*bootstrapEnabled" );
			 $el3 = $doc->createCDATASection ( $_POST ["bootstrapEnabled"] );
			 $el3 = $el2->appendChild ( $el3 );
			 $el4 = $root->appendChild ( $el2 );
			 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "bootstrapContainerType" );
			 $el2->setAttribute ( "type", "scalar" );
			 $el2->setAttribute ( "id", "bootstrapContainerType" );
			 $el3 = $doc->createCDATASection ( $_POST ["bootstrapContainerType"] );
			 $el3 = $el2->appendChild ( $el3 );
			 $el4 = $root->appendChild ( $el2 );
			 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "bootstrapViewPortSizeType" );
			 $el2->setAttribute ( "type", "scalar" );
			 $el2->setAttribute ( "id", "bootstrapViewPortSizeType" );
			 $el3 = $doc->createCDATASection ( $_POST ["bootstrapViewPortSizeType"] );
			 $el3 = $el2->appendChild ( $el3 );
			 $el4 = $root->appendChild ( $el2 );
			 break;
			 case "tb_simple_layout":
			 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "bootstrapEnabled" );
			 $el2->setAttribute ( "type", "scalar" );
			 $el2->setAttribute ( "id", "*bootstrapEnabled" );
			 $el3 = $doc->createCDATASection ( $_POST ["bootstrapEnabled"] );
			 $el3 = $el2->appendChild ( $el3 );
			 $el4 = $root->appendChild ( $el2 );
			 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "bootstrapContainerType" );
			 $el2->setAttribute ( "type", "scalar" );
			 $el2->setAttribute ( "id", "bootstrapContainerType" );
			 $el3 = $doc->createCDATASection ( $_POST ["bootstrapContainerType"] );
			 $el3 = $el2->appendChild ( $el3 );
			 $el4 = $root->appendChild ( $el2 );	
			 break;
			 case "tb_layout":
			 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "bootstrapEnabled" );
			 $el2->setAttribute ( "type", "scalar" );
			 $el2->setAttribute ( "id", "*bootstrapEnabled" );
			 $el3 = $doc->createCDATASection ( $_POST ["bootstrapEnabled"] );
			 $el3 = $el2->appendChild ( $el3 );
			 $el4 = $root->appendChild ( $el2 );
			 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "bootstrapContainerType" );
			 $el2->setAttribute ( "type", "scalar" );
			 $el2->setAttribute ( "id", "bootstrapContainerType" );
			 $el3 = $doc->createCDATASection ( $_POST ["bootstrapContainerType"] );
			 $el3 = $el2->appendChild ( $el3 );
			 $el4 = $root->appendChild ( $el2 );	
			 break;
			}
			
			$el2 = $doc->createElement("ind" . STRING_UNDERSCORE . "dispFields");
			$el2->setAttribute("type","array");
			$el2->setAttribute("id","dispFields");
			$el3 = $root->appendChild($el2);									
			
            $factory = Creator::create(getClassNameForCreate(Classes_info::SAVELAYOUT_FACTORY_CLASS),STRING_NULL,$doc,$root);
            $branchObj = $factory->create($intType);      			
			$branchObj->exec(); 
			
			echo $appXmlDir . DIR_SEP . $fileName;
			$doc->formatOutput = true;
			$doc->save ( $appXmlDir . DIR_SEP . $fileName );
		}
		return 'true';
	}
}
class AjaxOpGetLayout extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_LAYOUT );
	}
	function translateLayoutInterfacesContainer(array $actItems):array {
		$items = array ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		
		require_once(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
        FRAMEWORK_DIR . DIR_SEP . INTERFACES_CONTAINER_CLASS . 
        ".class.php");
		
		$scope1 = $scope . STRING_BACKSLASH . INTERFACES_CONTAINER_CLASS;
		
        require_once(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP .  
	 	 FRAMEWORK_DIR . DIR_SEP . INTERFACE_AS_STRING_CLASS . 
        ".class.php");

        $scope2 = $scope . STRING_BACKSLASH . INTERFACE_AS_STRING_CLASS;		
		
		foreach ( $actItems as $ind => $val ) {
			if (substr ( $ind, 0, 1 ) == STRING_AT)
				$ind = substr ( $ind, 1, strlen ( $ind ) - 1 );
			if (is_bool ( $val ))
				if ($val)
					$val = 'true';
				else
					$val = 'false';
			if (is_a ( $val, $scope1 )) {
				$cont = $val->getContents ();
				$cont2 = array ();
				foreach ( $cont as $ind2 => $val2 ) {
					if(is_a($val2,$scope2))
					 $val2 = $val2->getItemName();
					$cont2 [$ind2] = $val2;
				}
				$items [$ind] = $cont2;
			} else
				$items [$ind] = $val;
		}
		return $items;
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		$appXmlDir2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;
		$intSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$actId);
		$intSerializer->setDbStruct (Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL));
		$intSerializer->setDbQueries (Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL));
		$intSerializer->setXmlDir ( $appXmlDir2 );
		$intSerializer->setInterfacesDir ( $appXmlDir1 );
		$intSerializer->setAppName ( $appName );
		$intSerializer->setLoadInterfaceAsString ( true );
        $intSerializer->setInterpolateConsts(false);
        $intSerializer->setLoadSpecialChars(true);
        $scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
        $codeDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . FRAMEWORK_DIR;
		$intSerializer->setScope($scope);
		$intSerializer->setCodeDir($codeDir);
		$intSerializer->loadData ();
		$intItems = $intSerializer->getItems ();
		$intItems2 = $this->translateLayoutInterfacesContainer ( $intItems );
		return $intItems2;
	}
}
class AjaxOpManageOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_MANAGE_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpManageOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_MANAGE_OP2 );
	}
	function filterInterfacesFiles(string $actInt, array $actVet):array {
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$newVet = array ();
		$parents = Xml_interface_serializer::getFamilyParents ( $appName, $actInt );
		$parents1 = Xml_interface_serializer::getInterfacesContainerParents ( $appName, $actInt );
		$parents2 = array_assoc_concat ( $parents, $parents1 );
		$parents2 = array_unique ( $parents2 );
		$parents2 = array_values ( $parents2 );
		foreach ( $actVet as $ind => $intName ) {
			if (! in_array ( $intName, $parents2 ))
				$newVet [$ind] = $intName;
		}
		return $newVet;
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		if (file_exists ( $appXmlDir . DIR_SEP . $actId )) {
			$intItems = Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir . DIR_SEP . $actId );
			$pageName = $intItems [1];
		} else
			$pageName = STRING_NULL;
		$interfaces = array ();
		$newInterfaces = array ();
		$files = scandir ( $appXmlDir );
		$i = 0;
		foreach ( $files as $ind => $file ) {
			$fileItems = explode ( FILE_NAME_ELEMENTS_SEP, $file );
			$fileItemsNum = count ( $fileItems );
			if ((! is_dir ( $file )) && ($fileItemsNum == 1) && ($file != $actId)) {
				$interfaceItems = Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir . DIR_SEP . $file );
				$interfaceItemsNum = count ( $interfaceItems );
				$interfaceAppItem = $interfaceItems [0];
				$interfacePageName = $interfaceItems [1];
				if ($interfaceItemsNum == 6) {
					$interfaceType = $interfaceItems [3];
					$fileNameReduced = $interfaceType . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [2] . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [4] . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [5];
				} elseif ($interfaceItemsNum == 5) {
					$interfaceType = $interfaceItems [2];
					$fileNameReduced = $interfaceType . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [3] . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [4];
				}
				if (($interfaceAppItem == $appName) && (($interfacePageName == $pageName) || ($interfacePageName == STRING_NULL))) {
					if (($interfacePageName == STRING_NULL) || (Xml_interface_file_analyzer::is_free_interface_file ( $appXmlDir . DIR_SEP . $file )))
						$interfaces [$i ++] = $file;
					else
						$interfaces [$i ++] = $fileNameReduced;
				}
			}
		}
		sort ( $interfaces );
		foreach ( $interfaces as $ind => $val ) {
			$interfaceItems = explode ( Xml_interface_serializer::INTERFACE_NAME_SEP, $val );
			$interfaceItemsNum = count ( $interfaceItems );
			if ($interfaceItemsNum == 1) {
				$intFileName = $interfaceItems [0];
				$interfaceItems [0] = Xml_interface_file_analyzer::getScalarProperty ( $appXmlDir . DIR_SEP . $intFileName, "appName" );
				$interfaceItems [1] = Xml_interface_file_analyzer::getScalarProperty ( $appXmlDir . DIR_SEP . $intFileName, "pageName" );
				$j = 2;
				$obj = Xml_interface_file_analyzer::getScalarProperty ( $appXmlDir . DIR_SEP . $intFileName, "obj" );
				if ($obj !== false)
					$interfaceItems [$j ++] = $obj;
				$interfaceItems [$j ++] = Xml_interface_file_analyzer::getScalarProperty ( $appXmlDir . DIR_SEP . $intFileName, "type" );
				$interfaceItems [$j ++] = Xml_interface_file_analyzer::getScalarProperty ( $appXmlDir . DIR_SEP . $intFileName, "op" );
				$interfaceItems [$j] = Xml_interface_file_analyzer::getScalarProperty ( $appXmlDir . DIR_SEP . $intFileName, "num" );
				$interfaceItemsNum = $j + 1;
			}
			if ($interfaceItemsNum == 3) {
				$interfaceType = $interfaceItems [0];
				$fileNameRestored = $appName . Xml_interface_serializer::INTERFACE_NAME_SEP . $pageName . Xml_interface_serializer::INTERFACE_NAME_SEP . $val;
				$intCanonicalName = $fileNameRestored;
			} elseif ($interfaceItemsNum == 4) {
				$interfaceType = $interfaceItems [0];
				$fileNameRestored = $appName . Xml_interface_serializer::INTERFACE_NAME_SEP . $pageName . Xml_interface_serializer::INTERFACE_NAME_SEP . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceType . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [2] . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [3];
				$intCanonicalName = $fileNameRestored;
			} elseif ($interfaceItemsNum == 5) {
				$interfaceType = $interfaceItems [2];
				$fileNameRestored = $val;
				$intCanonicalName = $interfaceItems [0] . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [1] . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceType . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [3] . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [4];
			} elseif ($interfaceItemsNum == 6) {
				$interfaceType = $interfaceItems [3];
				$fileNameRestored = $val;
				$intCanonicalName = $interfaceItems [0] . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [1] . Xml_interface_serializer::INTERFACE_NAME_SEP . ($interfaceItems [2] == "OBJ_NONE" ? STRING_NULL : $interfaceItems [2]) . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceType . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [4] . Xml_interface_serializer::INTERFACE_NAME_SEP . $interfaceItems [5];
			}
			$newInterfaces [$ind] = array (
					FIELD_INTERFACCIA => $fileNameRestored,
					FIELD_TYPE => $interfaceType,
					FIELD_INTERFACE_CANONICAL_NAME => $intCanonicalName 
			);
		}
		$interfaces2 = $this->filterInterfacesFiles ( $actId, $newInterfaces );
		return $interfaces2;
	}
}
class AjaxOpGetNamedInterfacesContainer extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_NAMED_INTERFACE_CONTAINER );
	}
	function translateNamedInterfacesContainer(array $actItems,string $actIntContName):array {
		$items = array ();
		foreach ( $actItems as $ind => $val ) {
			if ($ind == "interfacesContainer" . ucFirst ( $actIntContName )) {
				$ind = "interfacesContainer";
				$scope = $_SESSION [SESSION_VAR_ACTIVE_APP] . STRING_BACKSLASH . FRAMEWORK_DIR;
				$scope1 = $scope . STRING_BACKSLASH . INTERFACES_CONTAINER_CLASS;
				if (is_a ( $val, $scope1 )) {
					$cont = $val->getContents ();
					$cont2 = array ();
					foreach ( $cont as $ind2 => $val2 ) {
						$cont2 [$ind2] = $val2->getItemName();
					}
					$items [$ind] = $cont2;
				}
			}
		}
		return $items;
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$ids = explode ( STRING_SEMICOLON, $actId );
		$intName = $ids [0];
		$intContName = $ids [1];
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		$appXmlDir2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;
		$intContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
		$intSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$intName);
		$intSerializer->setDbStruct (Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL));
		$intSerializer->setDbQueries (Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL));
		$intSerializer->setXmlDir ( $appXmlDir2 );
		$intSerializer->setInterfacesDir ( $appXmlDir1 );
		$intSerializer->setAppName ( $appName );
		$intSerializer->setLoadInterfaceAsString ( true );
		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		$intSerializer->setScope($scope);
		$intSerializer->loadData ();
		$intItems = $intSerializer->getItems ();
		$intItems2 = $this->translateNamedInterfacesContainer ( $intItems, $intContName );
		return $intItems2;
	}
}
class AjaxOpManageFieldsOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_MANAGE_FIELDS_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpManageFieldsOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_MANAGE_FIELDS_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {		
		$phpArraysDefRules = $GLOBALS["phpArraysDefRules"];
		$phpArraysDefGrRules = $GLOBALS["phpArraysDefGrRules"];
		
		session_start ();
		
		$i = 0;
		$mainPropLevels = array ();
		$fields = array ();
		$domains = array ();
		$domainsValues = array ();
		foreach ( $_POST as $ind => $val ) {
			$lex = Creator::create(getClassNameForCreate(Classes_info::LEXER_3_CLASS),STRING_NULL,STRING_NULL,$val);
			$lex->setRules ( $phpArraysDefRules );
			$parser = Creator::create(getClassNameForCreate(Classes_info::PARSER_CLASS),STRING_NULL,$lex);
			$parser->setGrammarRulesContainer ( $phpArraysDefGrRules );
			$propName = $ind;
			if (! $parser->exec ()) {
				echo $parser->getCurrentError () . STRING_SPACE . MSG_40 . STRING_SPACE . "'" . $propName . "'";
				return STRING_NULL;
			}
			$grRule = $phpArraysDefGrRules->getElement ( 0 );
			$mainPropsLevels [] = $grRule->getNumFirstLevelEls ();
			if (array_containDifferentValues ( $mainPropsLevels )) {
				echo MSG_41 . STRING_COLON . $propName . STRING_SPACE . MSG_42 . STRING_SPACE . $grRule->getNumFirstLevelEls () . STRING_SPACE . MSG_43 . STRING_POINT;
				return STRING_NULL;
			}
			$grRule->setNumFirstLevelEls ( 0 );
			
			$items = $grRule->getItems ();
			$keys = $grRule->getKeys ();
			$newItems = array ();
			$newKeys = array ();
			if ((is_array ( $items ))&&(is_array($keys)))
				if ($i < 2) {
					foreach ( $items as $ind2 => $item ) {
						$item = trim ( $item );
						$firstChar = substr ( $item, 0, 1 );
						if ($firstChar == STRING_SINGLE_QUOTE)
							$item2 = substr ( $item, 1, strlen ( $item ) - 2 );
						else
							$item2 = $item;
						$newItems [$ind2] = $item2;
					}
				} else {
					foreach ( $items as $ind2 => $item ) {
						$item = trim ( $item );
						$newItems [$ind2] = $item;
					}
					foreach ( $keys as $ind2 => $key ) {
						$key = trim ( $key );
						$newKeys [$ind2] = $key;
					}
				}
			
			if ($i == 0)
				$fields = $newItems;
			elseif ($i == 1)
				$domains = $newItems;
			elseif ($i == 2) {
				eval ( "\$domainsValuesKeys = " . $val . STRING_SEMICOLON );
				$domainsValues = $newItems;
			}
			$grRule->setItems ( array () );
			$i ++;
		}
		$domainsValuesKeys2 = array_keys ( $domainsValuesKeys );
		$i = 0;
		foreach ( $domainsValuesKeys2 as $ind => $key ) {
			if (! is_numeric ( $key ))
				$domainsValues [$ind] = STRING_SINGLE_QUOTE . $key . STRING_SINGLE_QUOTE . "=>" . $domainsValues [$ind];
		}
		$intItems = array ();
		foreach ( $fields as $ind => $field ) {
			$intItems [$ind] = array (
					FIELD_FIELD => $field,
					FIELD_DOMAIN => $domains [$ind],
					FIELD_DOMAIN_VALUE => $domainsValues [$ind] 
			);
		}
		return $intItems;
	}
}
class AjaxOpGetInterfaceIds extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_INTERFACE_IDS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . INTERFACES_DIR;
		$intItems = array ();
		if ($actId != STRING_NULL)
			$intItems = Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir . DIR_SEP . $actId );
		return $intItems;
	}
}
class AjaxOpExport extends AjaxOp {
	public $distinctFiles;
	function __construct() {
		parent::__construct ( AJAX_OP_EXPORT );
	}
	function setDistinctFiles(string|bool $actDistinctFiles):void {
		$this->distinctFiles = $actDistinctFiles;
	}
	function getDistinctFiles():string|bool {
		return $this->distinctFiles;
	}
	function expand(string $actFileName, string $actDir, array &$actGMatches, bool $actIsClassDeclaredDetected):array {
		$fileName = $actFileName;
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		
		if ($actDir != STRING_POINT)
			$appFileName = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $actDir . DIR_SEP . $fileName;
		else
			$appFileName = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $fileName;
				
		if ($actDir != STRING_POINT) {
			if (! file_exists ( PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName . DIR_SEP . $actDir ))
				mkDir ( PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName . DIR_SEP . $actDir );
			$destFileName = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName . DIR_SEP . $actDir . DIR_SEP . $fileName;
		} else
			$destFileName = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName . DIR_SEP . $fileName;
		
		$dir = $actDir;		
		$oldDir = $actDir;
		$fileContents = file ( $appFileName );
		$newFileContents = array ();
		$distinctFiles = $this->getDistinctFiles ();
		$i = 0;
		$flagRow=true;
		$isClassDeclaredDetected =  $actIsClassDeclaredDetected;
		foreach ( $fileContents as $ind => $val ) 
		{
			if ((preg_match ( "/require_once\(([A-Za-z0-9_\.\$\"\'\s\/]+)\)/i", $val, $matches ) > 0) && 
			(preg_match("/CLASS_SUFFIX/i",$val,$matches2)==0) &&
			(preg_match("/\\\$className/",$val,$matches4)==0) &&
			(preg_match("/(?<=\\\\\*)(.|\n|\r)+(?=\*\\\\)/",$val,$matches3)==0)) 
			{
				$codeDir = THIS_DIR;
				$oldMatches = $matches[1];
				/*if(strpos($matches[1],"DIR_SEP")!==false)
				{
				 echo __NAMESPACE__;
				 echo "****";
				 echo $matches[1] = preg_replace("/([A-Z_]{2,})/",__NAMESPACE__ . '\\\$1',$matches[1]);
				 echo "****";
				 echo $matches[1] = preg_replace("/(\\\)/",'${1}',$matches[1]);
				 echo "****";
				 echo "\$nFileName = " . $matches[1] . STRING_SEMICOLON;
				}*/
				
				$path =  "namespace Cheope_ns\\fw;\$nFileName = " . $matches[1] . STRING_SEMICOLON;
			  $path1 = preg_replace('/FRAMEWORK_PATH/i',"'./" . FRAMEWORK_ACRONYM . "/'",$path);
			  $path2 = preg_replace('/THIS_DIR/i',"'" . STRING_POINT . "'",$path1);
			  $path3 = preg_replace('/FRAMEWORK_DIR/i',"'" . FRAMEWORK_ACRONYM . "'",$path2);
			  $path4 = preg_replace('/DIR_SEP/i',"'" . STRING_SLASH . "'",$path3);
			    // eval("echo Cheope_ns\\fw\\XML_SERIALIZER_CLASS;");
				/*if(strpos($oldMatches,"DIR_SEP")!==false)
				{
				 echo $path;
				}*/
				eval ( $path4 );
			 
				$pregRes = preg_match ( STRING_SLASH . FRAMEWORK_DIR . STRING_SLASH, $nFileName, $nMatches );
				if ($pregRes > 0) {
					$mFileNameItems = explode ( DIR_SEP, $nFileName );
					if (count ( $mFileNameItems ) == 3) {
						$mFileName = $mFileNameItems [count ( $mFileNameItems ) - 1];
						$actDir = FRAMEWORK_DIR;
					} else
						$mFileName = STRING_NULL;
				} else
					$mFileName = $nFileName;
				
				/*if(strpos($oldMatches,"DIR_SEP")!==false)
				{
				 echo $path;
				}*/
			    // $newFileContents [$i++]= "******_******";
				
				if(strpos($oldMatches,"DIR_SEP") !== false)
				{
				 $expand=false;
				 $mFileName = str_replace("./",STRING_NULL,$mFileName);
				}
				else
				 $expand=true;
				
			//    if(! $expand)
			//	 $newFileContents [$i++]= "require_once(\"" . $mFileName . "\");";
				
            //   $newFileContents [$i++]= "******_******";
			  
			  $flagRow = false;
				if (($mFileName != STRING_NULL) && (! in_array ( $mFileName, $actGMatches ))) 
				{
					$actGMatches [] = $mFileName;
					$res = $this->expand ( $mFileName, $actDir, $actGMatches,$isClassDeclaredDetected );
					if (count ( $res ) > 0) {
						foreach ( $res as $ind2 => $val2 ) {
							$val2 = preg_replace ( "/(?<!\")(<\?)|(\?>)(?!\")/", STRING_NULL, $val2 );
							$newFileContents [$i++] = $val2;
						}
					} 
					else
					$newFileContents [$i++] = $val;
				} 
				elseif ($distinctFiles == 'true')
			  	 $newFileContents [$i++] = $val;
				//if($isClassDeclaredDetected)
				// $newFileContents [$i++] = "}";
			}
//			elseif(! (preg_match ( "/(?<!\")namespace(?!\")/", $val, $matches1 ) > 0))
    	//elseif ($distinctFiles == 'true')
       //elseif(! (preg_match ( "/(?<!\")namespace(?!\")/", $val, $matches1 ) > 0))
	    elseif(preg_match("/IsClassDeclared/",$val,$matches1)>0)
		{
		 //$val .= "{";
		 $newFileContents [$i++] = $val;
		 $isClassDeclaredDetected =true;
		 }
	    elseif(preg_match("/IsClassDeclared/",$val,$matches1)==0)
		{
		/* if(preg_match("/namespace\s[a-zA-Z_]/",$val,$matches5)>0)
		 {
		  $newFileContents [$i++] = STRING_NULL;
		 }
		 else
		 {
		  $newFileContents [$i++] = $val;
		 }*/
		 $newFileContents [$i++] = $val;
		 $isClassDeclaredDetected = false;
	    }
	    else
        $newFileContents [$i++] = $val;
        $dir = $oldDir;
		}

		$actDir = $oldDir;
		
		$distinctFiles = $this->getDistinctFiles ();
		if ($distinctFiles == "true") {
			if (! ($handle = fopen ( $destFileName, "w+" )))
				echo MSG_11;
			else {
				foreach ( $newFileContents as $ind => $content ) {
					fwrite ( $handle, $content );
					// return MSG_44;
				}
				fclose ( $handle );
			}
			$newFileContents = array ();
		}
		
		return $newFileContents;
	}
	function exportEnvironment(string $actSourceDir,string $actDestDir, array $actFiles) {
		foreach ( $actFiles as $file ) {
			$completeSourceFileName = $actSourceDir . DIR_SEP . $file;
			$completeDestFileName = $actDestDir . DIR_SEP . $file;
			if (! is_dir ( $completeSourceFileName )) {
				$timeStampSource = filemtime ( $completeSourceFileName );
				if (file_exists ( $completeDestFileName ))
					$timeStampDest = filemtime ( $completeDestFileName );
				else
					$timeStampDest = 0;
				if ($timeStampDest < $timeStampSource)
					if (! copy ( $completeSourceFileName, $completeDestFileName )) {
						echo $actSourceDir . DIR_SEP . $file;
						return false;
					}
			} else {
				$sourceDirName = $actSourceDir . DIR_SEP . $file;
				$destDirName = $actDestDir . DIR_SEP . $file;
				if (make_dir ( $destDirName )) {
					//subDirFiles = scandir ( $sourceDirName, 1 );
					// Elimina . e ..
					//
					//array_pop ( $subDirFiles );
					//array_pop ( $subDirFiles );
					$subDirFiles = array_diff(scandir($sourceDirName,1), array(PREVIOUS_DIR, THIS_DIR));
					$this->exportEnvironment ( $sourceDirName, $destDirName, $subDirFiles );
				} else
					return false;
			}
		}
		return true;
	}
	function deleteOldFiles():void {
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$dir1 = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName . DIR_SEP . FRAMEWORK_ACRONYM;
		if (file_exists ( $dir1 )) {
			$files = scandir ( $dir1 );
			foreach ( $files as $file ) {
				if (! is_dir ( $dir1 . DIR_SEP . $file ))
					unlink ( $dir1 . DIR_SEP . $file );
			}
		}
		$dir2 = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName;
		if (file_exists ( $dir2 )) {
			$files = scandir ( $dir2 );
			foreach ( $files as $file ) {
				if (! is_dir ( $dir2 . DIR_SEP . $file ))
					unlink ( $dir2 . DIR_SEP . $file );
			}
		}
	}
	function deleteOldEnvironmentFiles(string $actDir):void {
//		
// Controllare nelle successive implementazioni (attuale 7.3) l'eventuale cambio di
// ordinamento dei files della funzione scandir.
//		
		//$files = scandir ( $actDir, 1 );
		$files = array_diff(scandir($actDir,1), array(PREVIOUS_DIR, THIS_DIR));
		foreach ( $files as $ind => $file ) {
			if (! is_dir ( $actDir . DIR_SEP . $file ))
				{
					unlink ( $actDir . DIR_SEP . $file );
				}
			elseif ($file != FRAMEWORK_ACRONYM)
				$this->deleteOldEnvironmentFiles ( $actDir . DIR_SEP . $file );
		}
	}
	function deleteOldEnvironmentDirs(string $actDir):void {
		$emptyDir = false;
		
		while ( ! $emptyDir ) {
			$files = array_diff(scandir($actDir,1), array(PREVIOUS_DIR, THIS_DIR));			
			//$files = scandir ( $actDir, 1 );
			//array_pop ( $files );
			//array_pop ( $files );
			if ((count ( $files ) > 0) && (! ((count ( $files ) == 1) && (in_array ( FRAMEWORK_ACRONYM, $files ))))) {
				foreach ( $files as $ind => $file ) {
					if (is_dir ( $actDir . DIR_SEP . $file ) && ($file != FRAMEWORK_ACRONYM)) {
						//$files2 = scandir ( $actDir . DIR_SEP . $file, 1 );
						$files2 = array_diff(scandir($actDir . DIR_SEP . $file, 1 ), array(PREVIOUS_DIR, THIS_DIR));
						//array_pop ( $files2 );
						//array_pop ( $files2 );
						if (count ( $files2 ) > 0) {
							$this->deleteOldEnvironmentDirs ( $actDir . DIR_SEP . $file );
							break;
						} else
							rmDir ( $actDir . DIR_SEP . $file );
					}
				}
			} else
				$emptyDir = true;
		}
	}
	function isApplication(string $actIntFileName):bool {
		$fileItems = explode ( STRING_POINT, $actIntFileName );
		$suffix = $fileItems [count ( $fileItems ) - 1];
		if ((count ( $fileItems ) == 2) && ($suffix == APP_LANGUAGE))
			return true;
		else
			return false;
	}
	
	function getTypeFromTypeItems(array $actTypeItems,string $actAppName):string
	{
		$num = count($actTypeItems);
		$type = STRING_NULL;
		if($num > 0)
		{
			$i=0;
			$item = $actTypeItems[$i];
			for($i=1;$i<=$num-1;$i++)
			{
				if(strToLower($item) !== strToLower($actAppName))
				 $item = $item . VAR_SEP . $actTypeItems[$i];
				else
				 break;
			}
			if($i<=$num-1)
			{
			 $type = $actTypeItems[$i];
			 for($j=$i+1;$j<=$num-1;$j++)
			 {
			  $type = $type . VAR_SEP .  $actTypeItems[$j]; 
			 }
			} 
		}		
		return $type;
	}
	
	function extractRootInterface(string $actPage, array $actFileContent):string {
		//echo $actPage;
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$intDef = $actFileContent [13];
		//echo $intDef;
		preg_match ( "/\\\$interface=new\s([A-Z][A-Za-z_]*)\((\\\$[a-zA-Z_]+|OBJ_NONE|OBJ_DATA_SOURCE+)?,?" . "(\"[a-zA-Z_]+\"|OP_NONE),NUM_([0-9]+)\);\s*/", $intDef, $matches1 );
		
		$intShortNameDef = $actFileContent [15];
		//echo $intShortNameDef;
		preg_match ( "/\\\$interface\-\>setShortName\(\"([a-zA-Z]?[a-zA-Z0-9_]*)\"\);\s*/", $intShortNameDef, $matches2 );
		
		if (isset ( $matches2 [1] ) && ($matches2 [1] != STRING_NULL))
			$rootIntName = $matches2 [1];
		else {
			$sep = Xml_interface_serializer::INTERFACE_NAME_SEP;
			
			$typeItems = explode ( STRING_UNDERSCORE, $matches1 [1] );
			$type = $this->getTypeFromTypeItems($typeItems,$appName);
			
			if (trim ( $matches1 [2] ) != STRING_NULL) {
				if ($matches1 [2] == "OBJ_DATA_SOURCE")
					$objName = OBJ_DATA_SOURCE;
				elseif ($matches1 [2] == "OBJ_NONE")
					$objName = OBJ_NONE;
				else {
					$objName = preg_match ( "/\\\$dbObj([A-Z][a-zA-Z0-9_]*)/", $matches1 [1], $objItems );
					$objName = strToLower ( $objItems [1] );
					$objName = ucFirst ( $objName );
				}
				
				if ($matches1 [3] == "OP_NONE")
					$op = OP_NONE;
				else
					$op = str_replace ( STRING_DOUBLE_QUOTE, STRING_NULL, $matches1 [3] );
				
				$rootIntName = $appName . $sep . $actPage . $sep . $objName . $sep . strToLower ( $type ) . $sep . $op . $sep . $matches1 [4];
			} else {
				if ($matches1 [3] == "OP_NONE")
					$op = OP_NONE;
				else
					$op = str_replace ( STRING_DOUBLE_QUOTE, STRING_NULL, $matches1 [3] );
				
				$rootIntName = $appName . $sep . $actPage . $sep . strToLower ( $type ) . $sep . $op . $sep . $matches1 [4];
			}
		}
		
		return $rootIntName;
	}
	function getInterfacePhpFileNameFromCanonicalName(string $actIntName):string {
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . INTERFACES_DIR;
		$intItems = Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir . DIR_SEP . $actIntName );
		$num = count ( $intItems );
		if ($num == 6) {
			$interfaceType = $intItems [3];
			$interfaceOp = $intItems [4];
			$interfaceNum = $intItems [5];
			
			$interfaceTypeComps = explode ( VAR_SEP, $interfaceType );
			
			if (! (($interfaceTypeComps [0] == HTML_LANGUAGE) || ($interfaceTypeComps [0] == APP_LANGUAGE) || ($interfaceTypeComps [0] == JAVASCRIPT_LANGUAGE))) {
				$interfaceName = $appName . VAR_SEP . $interfaceType;
			} else {
				$interfaceName = $interfaceType;
			}
		} elseif ($num == 5) {
			$interfaceType = $intItems [2];
			$interfaceOp = $intItems [3];
			$interfaceNum = $intItems [4];
			
			$interfaceTypeComps = explode ( VAR_SEP, $interfaceType );
			
			if (! (($interfaceTypeComps [0] == HTML_LANGUAGE) || ($interfaceTypeComps [0] == APP_LANGUAGE) || ($interfaceTypeComps [0] == JAVASCRIPT_LANGUAGE))) {
				$interfaceName = $appName . VAR_SEP . $interfaceType;
			} else {
				$interfaceName = $interfaceType;
			}
		}
		return ucFirst ( $interfaceName ) . STRING_POINT . "class" . STRING_POINT . APP_LANGUAGE;
	}
	function extractInnerInterfacesFromRootInterface(string $actRootInt):array {
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$interfaces = array ();
		$interfacesContainerSons = Xml_interface_serializer::getInterfacesContainerSons ( $appName, $actRootInt );
		$familySons = Xml_interface_serializer::getFamilySons ( $appName, $actRootInt );
		$decoratedInterface = Xml_interface_serializer::getDecoratedInterface($appName,$actRootInt);
		//print_r ( $interfacesContainerSons );
		foreach ( $interfacesContainerSons as $ind => $val ) {
			if (! in_array ( $val, $interfaces ))
				$interfaces [] = $val;
		}
		foreach ( $familySons as $ind => $val ) {
			if (! in_array ( $val, $interfaces ))
				$interfaces [] = $val;
		}
		if(! is_null($decoratedInterface))
		{
			if(! in_array($decoratedInterface,$interfaces))
			 $interfaces[] = $decoratedInterface;
		}
		$newInterfaces = array ();
		foreach ( $interfaces as $ind => $val )
			$newInterfaces [$ind] = $this->getInterfacePhpFileNameFromCanonicalName ( $val );
		
		return $newInterfaces;
	}
	function exportAjaxHandler(string $actAppDir, string $actDir, bool|string $actDistinctFiles):void 
	{
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appFileName = $actAppDir . DIR_SEP . AJAX_HANDLER_PAGE;
		$fileContents = file ( $appFileName );
		$newFileContents = array ();
		$dir = $actDir;
		$oldDir = $actDir;
		$gMatches = array ();
		$i = 0;
		foreach ( $fileContents as $ind => $val ) 
		{
			if ((preg_match ( "/require_once\(([A-Za-z0-9_\.\"\'\s\/]+)\)/i", $val, $matches ) > 0) && 
			//(preg_match("/DIR_SEP/i",$val,$matches2)==0)&&
			(preg_match("/(?<=\\\\\*)(.|\n|\r)+(?=\*\\\\)/",$val,$matches3)==0)) 
			{
				$path =  "\$nFileName = " . $matches[1] . STRING_SEMICOLON;
			  $path1 = preg_replace('/FRAMEWORK_PATH/i',"'./" . FRAMEWORK_ACRONYM . "/'",$path);
			  $path2 = preg_replace('/THIS_DIR/i',"'" . STRING_POINT . "'",$path1);
			  $path3 = preg_replace('/FRAMEWORK_DIR/i',"'" . FRAMEWORK_ACRONYM . "'",$path2);
			  $path4 = preg_replace('/DIR_SEP/i',"'" . STRING_SLASH . "'",$path3);
				eval ( $path4 );
				$pregRes = preg_match ( "/" . FRAMEWORK_DIR . "/", $nFileName, $nMatches );
				if ($pregRes > 0) 
				{
					$mFileNameItems = explode ( DIR_SEP, $nFileName );
					if (count ( $mFileNameItems ) == 3) {
						$mFileName = $mFileNameItems [count ( $mFileNameItems ) - 1];
						$dir = FRAMEWORK_DIR;
					} else
						$mFileName = STRING_NULL;
				}
				else
					$mFileName = $nFileName;
					
				if (($mFileName != STRING_NULL) && (! in_array ( $mFileName, $gMatches ))) 
				{
					$gMatches [] = $mFileName;
					if(preg_match("/\\" . DIR_SEP . "/",$mFileName,$matches4) == 0)
					{
					// print_r($gMatches);
					$res = $this->expand ( $mFileName, $dir, $gMatches );
					// print_r($res);
					if (count ( $res ) > 0) 
					{
						foreach ( $res as $ind2 => $val2 ) 
						{
							$val2 = preg_replace ( "/(?<!\")(<\?)|(\?>)(?!\")/", STRING_NULL, $val2 );
							$newFileContents [$i++] = $val2;
						}
					} 
					else
					 $newFileContents [$i++] = $val;
				 }
				} 
				elseif ($actDistinctFiles == 'true')
				$newFileContents [$i ++] = $val;
			} 
			else
			 $newFileContents [$i ++] = $val;
			//$dir = $oldDir;
		}

		$destFileName = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName . DIR_SEP . AJAX_HANDLER_PAGE;
		if (! ($handle = fopen ( $destFileName, "w+" )))
			echo MSG_45;
		else 
		{
			foreach ( $newFileContents as $ind => $content ) 
			{
				fwrite ( $handle, $content );
			}
			fclose ( $handle );
		}
	}
	
	function appContainsAjaxOps(string $actAppFileName):bool {
		$fileContents = file ( $actAppFileName );
		$matches = array ();
		$i = 0;
		foreach ( $fileContents as $ind => $val ) {
			if (preg_match ( "/\\\$ajaxOps\s*=\s*array\(([A-Z_,]*)/i", $val, $matches ) > 0) {
				if ((isset ( $matches [1] )) && ($matches [1] !== STRING_NULL))
					return true;
			}
		}
		return false;
	}
	function exec_1(string $actId):array|string|bool|null {
		global $stdDirs;
		
		session_start();
		$appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		$dir = $ids [0];
		$dir1 = $dir;
		$oldDir = $dir;
		$fileName = $ids [1];
		$distinctFiles = $ids [2];
		$deleteOldFiles = $ids [3];
		$exportEnvironment = $ids [4];
		$deleteOldEnvironment = $ids [5];
		
		$this->setDistinctFiles ( $distinctFiles );
		
		if ($dir != STRING_POINT)
			$appFileName = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $dir . DIR_SEP . $fileName;
		else
			$appFileName = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $fileName;
		
		if ($deleteOldFiles == 'true')
			$this->deleteOldFiles ();
		
		if ($deleteOldEnvironment == 'true') {
			$this->deleteOldEnvironmentFiles ( PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName );
			$this->deleteOldEnvironmentDirs ( PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName );
		}
		if ($exportEnvironment == 'true') {
			if (! $this->exportEnvironment ( PREVIOUS_DIR . DIR_SEP . $appName, PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName, $stdDirs ))
				echo MSG_46;
		}
		
		if (! is_dir(PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName . DIR_SEP . JSON_DIR))
		{
		 mkdir(PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName . DIR_SEP . JSON_DIR);
         copy(PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . JSON_DIR . DIR_SEP . PHP_LOCALE_FILE .
         FILE_NAME_ELEMENTS_SEP . JSON_SUFFIX,
         PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . JSON_DIR . DIR_SEP . PHP_LOCALE_FILE .
         FILE_NAME_ELEMENTS_SEP . JSON_SUFFIX);
        }

		if ($dir !== STRING_POINT) {
			if (! file_exists ( PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName . DIR_SEP . FRAMEWORK_ACRONYM ))
				mkDir ( PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName . DIR_SEP . FRAMEWORK_ACRONYM );
			$destFileName = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName . DIR_SEP . FRAMEWORK_ACRONYM . DIR_SEP . $fileName;
		} else
			$destFileName = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $appName . DIR_SEP . $fileName;
		
		$fileContents = file ( $appFileName );
		//$firstLine = "namespace " . $appName . DIR_SEP . FW_DIR . STRING_SEMICOLON; 
		$newFileContents = array ();
		//$newFileContents[] = $firstLine;
		$gMatches = array ();
		$i = 0;
		
		foreach ( $fileContents as $ind => $val ) 
		{
			if ((preg_match ( "/require_once\(([A-Za-z0-9_\$\.\"\'\s\/]+)\)/i", $val, $matches ) > 0) && 
		//	(preg_match("/DIR_SEP/i",$val,$matches2)==0)&&
			(preg_match("/(?<=\\\\\*)(.|\n|\r)+(?=\*\\\\)/",$val,$matches3)==0)) 
			{
				$path =  "\$nFileName = " . $matches[1] . STRING_SEMICOLON;
			  $path1 = preg_replace('/FRAMEWORK_PATH/i',"'./" . FRAMEWORK_ACRONYM . "/'",$path);
			  $path2 = preg_replace('/THIS_DIR/i',"'" . STRING_POINT . "'",$path1);
			  $path3 = preg_replace('/FRAMEWORK_DIR/i',"'" . FRAMEWORK_ACRONYM . "'",$path2);
			  //$path4 = preg_replace('/DIR_SEP/i',"'" . STRING_SLASH . "'",$path3);
				eval ( $path3 );
				$pregRes = preg_match ( STRING_SLASH . FRAMEWORK_DIR . STRING_SLASH, $nFileName, $nMatches );
				if ($pregRes > 0) 
				{
					$mFileNameItems = explode ( DIR_SEP, $nFileName );
					if (count ( $mFileNameItems ) == 3) 
					{
						$mFileName = $mFileNameItems [count ( $mFileNameItems ) - 1];
						$dir = FRAMEWORK_DIR;
					} 
					else
						$mFileName = STRING_NULL;
				} 
				else
					$mFileName = $nFileName;
				
				$mFileName = THIS_DIR . DIR_SEP . $mFileName;
				
                 /*$newFileContents [$i++]= "************";
				 $newFileContents [$i++]= $mFileName;
				 $newFileContents [$i++]= "************";*/
				
				if (($mFileName != STRING_NULL) && (! in_array ( $mFileName, $gMatches ))) 
				{
					$gMatches [] = $mFileName;
					if(preg_match("/\\" . DIR_SEP . "/",$mFileName,$matches4) >= 0)
					{
					 $isClassDeclaredDetected = false;
					 $res = $this->expand ( $mFileName, $dir, $gMatches ,$isClassDeclaredDetected);
					 if (count ( $res ) > 0) 
					 {
						foreach ( $res as $ind2 => $val2 ) 
						{
							$val2 = preg_replace ( "/(?<!\")(<\?)|(\?>)(?!\")/", STRING_NULL, $val2 );
							$newFileContents [$i ++] = $val2;
						}
					 } 
					 else
						$newFileContents [$i++] = $val;
				  }
				} 
				elseif ($distinctFiles == 'true')
				 $newFileContents [$i++] = $val;
			} 
			else 
			{
				if (($this->isApplication ( $fileName )) && 
				(strpos ( $val, "\$interfacesContainer=new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);" ) 
				!== false)) 
				{
					$fileItems = explode ( STRING_POINT, $fileName );
					$rootInt = $this->extractRootInterface ( $fileItems [0], $fileContents );
					$pageInt = $appName . Xml_interface_serializer::INTERFACE_NAME_SEP . 
					$fileItems [0] . Xml_interface_serializer::INTERFACE_NAME_SEP . 
					"html_page" . Xml_interface_serializer::INTERFACE_NAME_SEP . 
					Xml_interface_serializer::INTERFACE_NAME_SEP . "0";
					$pageInnerInts = $this->extractInnerInterfacesFromRootInterface ( $pageInt );
					$rootInnerInts0 = $this->extractInnerInterfacesFromRootInterface ( $rootInt );
					$rootInnerInts = array_merge ( $pageInnerInts, $rootInnerInts0 );
					//echo "AAAA";
					//print_r ( $rootInnerInts );
					$dir = FRAMEWORK_DIR;
					foreach ( $rootInnerInts as $ind2 => $innerInt ) 
					{
						if (! in_array ( $innerInt, $gMatches )) 
						{
							$gMatches [] = $innerInt;
							$res = $this->expand ( $innerInt, $dir, $gMatches );
							if (count ( $res ) > 0) 
							{
								foreach ( $res as $ind3 => $val3 ) 
								{
									$val3 = preg_replace ( "/(?<!\")(<\?)|(\?>)(?!\")/", STRING_NULL, $val3 );
									$newFileContents [$i++ ] = $val3;
								}
							}
						}
					}
				}
				$newFileContents [$i++] = $val;
			}
			//$newFileContents [$i++] = $val;
			$dir = $oldDir;
		}
		 
		if ($this->isApplication ( $fileName ) && $this->appContainsAjaxOps ( $appFileName )) 
		{
			$this->exportAjaxHandler ( PREVIOUS_DIR . DIR_SEP . $appName, $dir1, $distinctFiles );
		}
		
		if (! ($handle = fopen ( $destFileName, "w+" )))
			echo MSG_45;
		else 
		{
			foreach ( $newFileContents as $ind => $content ) 
			{
				fwrite ( $handle, $content );
			}
			fclose ( $handle );
		}	
		return 'true';				
	}
}
class AjaxOpGetSingleMenus extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_SINGLE_MENUS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		$files = scandir ( $appXmlDir );
		$interfacesMenuNames = array (
				Interfaces_info::INT_LEVEL_MENU,
				Interfaces_info::INT_LEVEL_MENU_2,
				Interfaces_info::INT_MENUBAR,
			//	Interfaces_info::INT_MENUBAR_2,
				Interfaces_info::INT_CURTAIN_MENU ,
				Interfaces_info::INT_HOR_SCROLL_MENU,
				Interfaces_info::INT_SIDENAV,
				Interfaces_info::INT_FULLSCREEN_SLIDE_NAV,
			//	Interfaces_info::INT_ICON_NAV_BAR,
				Interfaces_info::INT_SPLITNAV,
				Interfaces_info::INT_SEARCH_BAR,
				Interfaces_info::INT_FIXED_SIDEBAR,
				Interfaces_info::INT_RESP_BOTTOM_NAV_BAR,
			//	Interfaces_info::INT_SIDEBAR,
				Interfaces_info::INT_BOTTOM_NAV_BAR,
				Interfaces_info::INT_SLIDE_DOWN,
				Interfaces_info::INT_OFFCANVAS_MENU,
			//	Interfaces_info::INT_EQUAL_WIDTH_NAV_BAR,
				Interfaces_info::INT_FIXED_TOP_MENU,
				Interfaces_info::INT_IMAGE_NAV_BAR,
				Interfaces_info::INT_STICKY_NAV_BAR,
				Interfaces_info::INT_SHRINK_NAV_BAR,
				Interfaces_info::INT_HIDE_NAV_BAR
		);
		$menus = array ();
		$i = 0;
		foreach ( $files as $ind => $file ) {
			$fileItems = explode ( FILE_NAME_ELEMENTS_SEP, $file );
			$fileItemsNum = count ( $fileItems );
			if (((! is_dir ( $file )) && ($fileItemsNum == 1))||
			((! is_dir ( $file ))&&($fileItemsNum==2)&&($fileItems[1]==XML_SUFFIX))) {
				$fileItems = Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir . DIR_SEP . $file );
				if ($fileItems [1] == $actId) {
					$fileItemsNum2 = count ( $fileItems );
					$obj = false;
					if ($fileItemsNum2 == 6) {
						$interfaceType = $fileItems [3];
						$obj = (($fileItems [2] == STRING_NULL) ? false : true);
					} elseif ($fileItemsNum2 == 5) {
						$interfaceType = $fileItems [2];
						$obj = false;
					}
					if ((! $obj) && (in_array ( $interfaceType, $interfacesMenuNames ))) {
						$menuAppItem = $fileItems [0];
						$menuPageName = $fileItems [1];
						if (($menuAppItem == $appName) && (($menuPageName == $actId) || ($menuPageName == STRING_NULL)))
							$menus [$i ++] = $file;
					}
				}
			}
		}
		return $menus;
	}
}
class AjaxOpGetMultiMenus extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_MULTI_MENUS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		$files = scandir ( $appXmlDir );
		$menus = array ();
		$i = 0;
		foreach ( $files as $ind => $file ) {
			$fileItems = preg_split("/\\"  . FILE_NAME_ELEMENTS_SEP  . "/",$file);
			$fileItemsNum = count ( $fileItems );
			if (((! is_dir ( $file )) && ($fileItemsNum == 1))||
			((! is_dir($file)&&($fileItemsNum == 2)&&($fileItems[1]==XML_SUFFIX)))) {
				$fileItems1 = Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir . DIR_SEP . $file );
				if ($fileItems1 [1] == $actId) {
					$fileItemsNum2 = count ( $fileItems1 );
					$obj = false;
					if ($fileItemsNum2 == 6) {
						$interfaceType = $fileItems1 [3];
						$obj = (($fileItems1 [2] == STRING_NULL) ? false : true);
					} elseif ($fileItemsNum2 == 5) {
						$interfaceType = $fileItems1 [2];
						$obj = false;
					}
					if ((! $obj) && ($interfaceType == Interfaces_info::INT_NLEVELS_MENU)) {
						$menuAppItem = $fileItems1 [0];
						$menuPageName = $fileItems1 [1];
						if (($menuAppItem == $appName) && (($menuPageName == $actId) || ($menuPageName == STRING_NULL)))
							$menus [$i ++] = $file;
					}
				}
			}
		}
		return $menus;
	}
}
class AjaxOpViewSingleMenuFieldsOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_SINGLE_MENU_FIELDS_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpTestIntFormat extends AjaxOp {
	function __construct(){
		parent::__construct(AJAX_OP_TEST_INT_FORMAT);
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$intName = $actId;
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
				
		$fileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP . $intName;
		$xmlIntSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$fileName);
		$xmlIntSerializer->setLoadInterfaceAsString ( true );
		$xmlIntSerializer->setDbStruct ( Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL) );
		$xmlIntSerializer->setDbQueries ( Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL) );
		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		$xmlIntSerializer->setScope($scope);
		$xmlIntSerializer->loadData ();
		$items = $xmlIntSerializer->getItems ();
		$dataFields = $items["dataFields"];
		$dataFieldsDomains = $items["dataFieldsDomains"];
		$dataFieldsDomainsValues = $items["dataFieldsDomainsValues"];
		foreach($dataFields as $ind=>$val)
		{
		 if(!(isset($dataFieldsDomains[$ind]) && isset($dataFieldsDomainsValues[$ind])))
		  return "false";	
		}
		return "true";
	}
}
	
class AjaxOpViewSingleMenuFieldsOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_SINGLE_MENU_FIELDS_OP2 );
	}
	function getVoicesPos(array $items,string $actVoicesField):bool|int
	{
	 $dataFields = $items["dataFields"];
	 $i=0;
	 foreach($dataFields as $ind=>$dataField)
	 {
	  if($dataField == $actVoicesField)
		return $i;
      $i++;
	 }
	 return false;
	}
	function getPagesPos(array $items,string $actPagesField):bool|int
	{
	 $dataFields = $items["dataFields"];
	 $i=0;
	 foreach($dataFields as $ind=>$dataField)
	 {
	  if($dataField == $actPagesField)
		return $i;
      $i++;
	 }
	 return false;
	}
	function getParsPos(array $items,string $actParsField):bool|int
	{
	 $dataFields = $items["dataFields"];
	 $i=0;
	 foreach($dataFields as $ind=>$dataField)
	 {
	  if($dataField == $actParsField)
		return $i;
      $i++;
	 }
	 return false;
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$intName = $actId;
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
				
		$fileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP . $intName;
		$xmlIntSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$fileName);
		$xmlIntSerializer->setLoadInterfaceAsString ( true );
		$xmlIntSerializer->setDbStruct ( Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL) );
		$xmlIntSerializer->setDbQueries ( Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL) );
		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		$xmlIntSerializer->setScope($scope);
		$xmlIntSerializer->loadData ();
		$items = $xmlIntSerializer->getItems ();
		$retStruct = array ();
		$dataArray = array ();
		$voicesField = (isset($items["titlesField"])?$items["titlesField"]:(isset($items["voicesField"])?$items["voicesField"]:STRING_NULL));
		$voicesPos = $this->getVoicesPos($items,$voicesField);
		if($voicesPos === false)
		  return $retStruct;
		$pagesField = $items["pagesField"];
		$pagesPos = $this->getPagesPos($items,$pagesField);
		if($pagesPos === false)
		  return $retStruct;
		$parsField = (isset($items["linksField"])?$items["linksField"]:(isset($items["idsField"])?$items["idsField"]:STRING_NULL));
		$parsPos = $this->getParsPos($items,$parsField);
		if($parsPos === false)
		  return $retStruct;
		if (count ( $items ["dataFieldsDomains"] ) >= 2) {
			$voicesDomain = $items ["dataFieldsDomains"] [$voicesPos];
			$pagesDomain = $items ["dataFieldsDomains"] [$pagesPos];
			$parsDomain = $items ["dataFieldsDomains"] [$parsPos];
			$fieldsValues = $items ["dataFieldsDomainsValues"] [$voicesPos];
			$pagesValues = $items ["dataFieldsDomainsValues"] [$pagesPos];
			$parsValues = $items ["dataFieldsDomainsValues"] [$parsPos];
			if (($voicesDomain == Int_domain::FIELD_DOMAIN_SET) && ($pagesDomain == Int_domain::FIELD_DOMAIN_SET)) {
				$i = 0;
				foreach ( $fieldsValues as $ind => $fieldValue ) {
					$dataArray = array ();
					$dataArray ["Voice"] = (! is_array ( $fieldValue )) ? $fieldValue : STRING_NULL;
					$dataArray ["Page"] = (! is_array ( $pagesValues [$ind] )) ? $pagesValues [$ind] : STRING_NULL;
					$dataArray ["Par"] = (! is_array ( $parsValues [$ind] )) ? $parsValues [$ind] : STRING_NULL;
					$retStruct [$i ++] = $dataArray;
				}
			} else
				$retStruct [0] = $dataArray;
		} else
			$retStruct [0] = $dataArray;
		return $retStruct;
	}
}
class AjaxOpSetSingleMenu extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_SINGLE_MENU );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$menuData = $_POST;
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		
		$intName = $_POST["IntName"];
		$intNameItems = explode(FILE_NAME_ELEMENTS_SEP,$intName);
		if(count($intNameItems)==2)
		 $suffix = FILE_NAME_ELEMENTS_SEP . $intNameItems[1];
		else
		 $suffix = STRING_NULL; 

		require_once (PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
        FRAMEWORK_DIR . DIR_SEP . "Html_data_interface.class.php");
		
		$page = $_POST ["Page"];
		$op = $_POST ["Op"];
		$type = $_POST ["Type"];
		$num = $_POST ["Num"];
		$intShortName = $_POST ["ShortName"];
		$intFreeName = $_POST ["CheckBox_IFreeName"];
		$sep = Xml_interface_serializer::INTERFACE_NAME_SEP;
		
		$isIntFree = false;
		if (($intShortName == STRING_NULL) || ($intFreeName != "true"))
			$intName = $appName . $sep . $page . $sep . $sep . $type . $sep . $op . $sep . $num . 
			$suffix;
		else {
			$intName = $intShortName;
			$isIntFree = true;
		}
		
		$fileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP . $intName;
		$xmlIntSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$fileName1);
		$xmlIntSerializer->setDbStruct (Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL));
		$xmlIntSerializer->setDbQueries ( Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL));
		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		$xmlIntSerializer->setScope($scope);
	  $xmlIntSerializer->setAppName($appName);
	  	  
		$fileExists = false;
		if (file_exists ( $fileName1 )) {
			$xmlIntSerializer->setLoadInterfaceAsString(true);
			$xmlIntSerializer->setDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR);
			$xmlIntSerializer->setInterfacesDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR);
			$xmlIntSerializer->setFileName($intName);
			$xmlIntSerializer->setLoadSpecialChars(true);
			$xmlIntSerializer->loadData ();
			$items = $xmlIntSerializer->getItems ();
			$fileExists = true;
		} else {
			$fileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
			INTERFACES_DIR . DIR_SEP . STANDARD_MOD_PREFIX . 
			 Xml_interface_serializer::INTERFACE_NAME_SEP .
			 Xml_interface_serializer::INTERFACE_NAME_SEP . 
			 Xml_interface_serializer::INTERFACE_NAME_SEP . $type . 
			 Xml_interface_serializer::INTERFACE_NAME_SEP . 
			 Xml_interface_serializer::INTERFACE_NAME_SEP . "0";
			$fileName3 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
			INTERFACES_DIR . DIR_SEP . STANDARD_MOD_PREFIX . 
			 Xml_interface_serializer::INTERFACE_NAME_SEP .
			 Xml_interface_serializer::INTERFACE_NAME_SEP . 
			 Xml_interface_serializer::INTERFACE_NAME_SEP . $type . 
			 Xml_interface_serializer::INTERFACE_NAME_SEP . 
			 Xml_interface_serializer::INTERFACE_NAME_SEP . "0" . 
			 FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
	
	   
	
	     if (file_exists($fileName2))
	      $fileName = $fileName2;
	     elseif (file_exists($fileName3))
	      $fileName = $fileName3;
	     else
	      die(MSG_16);

			$xmlIntSerializer->setFileName ( $fileName );
			$xmlIntSerializer->setLoadSpecialChars(true);
			$xmlIntSerializer->loadData ();
			$items = $xmlIntSerializer->getItems ();
			$xmlIntSerializer->setFileName ( $fileName1 );
		}
		if ($isIntFree) {
			$items ["appName"] = $appName;
			$items ["pageName"] = $page;
		}
		$items ["op"] = $op;
		$items ["type"] = $type;
		$items ["num"] = $num;
		$items ["shortName"] = $intShortName;
		//$items ["cssClass"] = $type;
		
		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
    $scope1 = $scope . STRING_BACKSLASH . DB_ITEM_CLASS;    
    $className = $scope1;

    $items["obj"] = Creator::create(getClassNameForCreate(Classes_info::DB_ITEM_CLASS),$scope,"OBJ_NONE");
		
		$items ["dataFields"] = array ();
		$items ["dataFields"] [0] = "field_0";
		$items ["dataFields"] [1] = "field_1";
		$items ["dataFields"] [2] = "field_2";
		$items ["dataFieldsDomains"] = array ();
		$items ["dataFieldsDomains"] [0] = "set";
		$items ["dataFieldsDomains"] [1] = "set";
		$items ["dataFieldsDomains"] [2] = "set";
		if ($type == Interfaces_info::INT_LEVEL_MENU_2) {
			$items ["dataFields"] [3] = "field_3";
			$items ["dataFields"] [4] = "field_4";
			$items ["dataFieldsDomains"] [3] = "set";
			$items ["dataFieldsDomains"] [4] = "set";
		}
		
		if(isset($items["voicesField"]))
		 $items["voicesField"]="field_0";
	    elseif(isset($items["titlesField"]))
		 $items["titlesField"]="field_0";
		 
		$items["pagesField"]="field_1";
		
		if(isset($items["idsField"]))
		 $items["idsField"]="field_2";
	    elseif(isset($items["linksField"]))
		 $items["linksField"]="field_2";		
		
		$i = 0;
		$isRows = isset ( $_POST ["Voice" . STRING_UNDERSCORE . $i] ) ? true : false;
		$voices = array ();
		$pages = array ();
		$pars = array();
		while ( $isRows !== false ) {
			//if ($isRows) {
				$voices [$i] = (isset ( $_POST ["Voice" . STRING_UNDERSCORE . $i] ) ? $_POST ["Voice" . STRING_UNDERSCORE . $i] : STRING_NULL);
				$pages [$i] = (isset ( $_POST ["Page" . STRING_UNDERSCORE . $i] ) ? $_POST ["Page" . STRING_UNDERSCORE . $i] : STRING_NULL);
				$pars [$i] = (isset ( $_POST ["Par" . STRING_UNDERSCORE . $i] ) ? $_POST ["Par" . STRING_UNDERSCORE . $i] : STRING_NULL);
				$i ++;
			//}
			$isRows = isset ( $_POST ["Voice" . STRING_UNDERSCORE . $i] ) ? true : false;
		}
		$items ["dataFieldsDomainsValues"] = array ();
		$items ["dataFieldsDomainsValues"] [0] = $voices;
		$items ["dataFieldsDomainsValues"] [1] = $pages;
		$items ["dataFieldsDomainsValues"] [2] = $pars;
		if (! $fileExists) {
			//$items ["dataFieldsDomainsValues"] [2] = array ();
			if ($type == Interfaces_info::INT_LEVEL_MENU_2) {
				$items ["dataFieldsDomainsValues"] [3] = array ();
				$items ["dataFieldsDomainsValues"] [4] = array ();
			} elseif (($type == Interfaces_info::INT_MENUBAR) 
			       || ($type == Interfaces_info::INT_MENUBAR_2)) {
				//$intContName = $scope . STRING_BACKSLASH . INTERFACES_CONTAINER_CLASS;
				$items["interfacesContainer"] = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),$scope,STRING_NULL);
				//$i = 0;
				/*foreach ( $voices as $val ) {
					$ids [$i] = "id" . STRING_UNDERSCORE . $i;
					$i ++;
				}
				$items ["dataFieldsDomainsValues"] [2] = $ids;*/
			}
		}
		//$scope = APPLICATION_NAME . STRING_BACKSLASH . FRAMEWORK_DIR;
	   // $items["obj"]=Creator::create(getClassNameForCreate(Classes_info::DB_ITEM_CLASS),$scope,"OBJ_NONE");
		/*elseif ((! isset ( $items ["dataFieldsDomainsValues"] [2] )) && 
			(($type == Interfaces_info::INT_LEVEL_MENU) || 
			($type == Interfaces_info::INT_LEVEL_MENU_2)))
    {
    	$items ["dataFieldsDomainsValues"] [2] = array();
    }
		else {
			if ((! isset ( $items ["dataFieldsDomainsValues"] [2] )) && 
			(($type == Interfaces_info::INT_MENUBAR) || 
			($type == Interfaces_info::INT_MENUBAR_2)||
			($type == Interfaces_info::INT_SIDENAV))) {
				$i = 0;
				foreach ( $voices as $val ) {
					$ids [$i] = "id" . STRING_UNDERSCORE . $i;
					$i ++;
				}
				$items ["dataFieldsDomainsValues"] [2] = $ids;
			}
		}*/
		//$scope = APPLICATION_NAME . STRING_BACKSLASH . FRAMEWORK_DIR;
		//echo $items["*inheritData"];
		//echo $items["inheritData"];
		//die('NNN');
		$xmlIntSerializer->setScope($scope);
		$xmlIntSerializer->loadItems ( $items );
		$xmlIntSerializer->saveData ();
		return true;
	}
}
class AjaxOpViewMultiMenuFieldsOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_MULTI_MENU_FIELDS_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpViewMultiMenuFieldsOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_MULTI_MENU_FIELDS_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$intName = $actId;
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		
		$fileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP . $intName;
		
		$xmlIntSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$fileName1);		
		$xmlIntSerializer->setLoadInterfaceAsString ( true );
		$xmlIntSerializer->setDbStruct ( Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL));
		$xmlIntSerializer->setDbQueries ( Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL));
		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		$xmlIntSerializer->setScope($scope);
		$xmlIntSerializer->loadData ();
		$items = $xmlIntSerializer->getItems ();
		$retStruct = array ();
		$dataFields = $items ["dataFields"];
		
		$fieldsDomains = $items ["dataFieldsDomains"];
		$fieldsDomainsValues = $items ["dataFieldsDomainsValues"];
		$i = 0;
		foreach ( $fieldsDomains as $ind => $domain ) {
			$dataArray = array ();
			if ($domain == Int_domain::FIELD_DOMAIN_OBJ) {
				$dataArray ["Voice"] = $dataFields [$ind];
				$dataArray ["Submenu"] = $fieldsDomainsValues [$ind]->getItemName();
			} elseif ($domain == Int_domain::FIELD_DOMAIN_SET) {
				$dataArray ["Voice"] = $dataFields [$ind];
				$dataArray ["Submenu"] = var_export ( $fieldsDomainsValues [$ind], true );
			} elseif (($domain == Int_domain::FIELD_DOMAIN_ATOMIC) || 
			($domain == Int_domain::FIELD_DOMAIN_ATOMIC_STATIC)) {
				$dataArray ["Voice"] = $fieldsDomainsValues [$ind];
				$dataArray ["Page"] = $dataFields [$ind];
			}
			$retStruct [$i ++] = $dataArray;
		}
		return $retStruct;
	}
}
class AjaxOpSetMultiMenu extends AjaxOp {
	const ERROR_0 = "AjaxOpSetMultiMenu:" . MSG_61;
	var $dir = STRING_NULL;
	var $appName = STRING_NULL;
	function __construct() {
		parent::__construct ( AJAX_OP_SET_MULTI_MENU );
	}
	function setDir(string $actDir):void {
		$this->dir = $actDir;
	}
	function getDir():string {
		return $this->dir;
	}
	function setAppName(string $actAppName):void {
		$this->appName = $actAppName;
	}
	function getAppName():string {
		return $this->appName;
	}
	function is_interface(string $actItem):bool {
		$appName = $this->getAppName ();
		$dir = $this->getDir ();
		$items = Generic_interface::decodeInterfaceId ( $actItem, Xml_interface_serializer::INTERFACE_NAME_SEP );
		$num = count ( $items );
		if (($actItem !== STRING_NULL) && file_exists ( $dir . DIR_SEP . $actItem ) && Xml_interface_file_analyzer::is_free_interface_file ( $dir . DIR_SEP . $actItem )) {
			$intFileName = $actItem;
			$intFreeAppName = Xml_interface_file_analyzer::getScalarProperty ( $dir . DIR_SEP . $intFileName, "appName" );
			if ($intFreeAppName == $appName)
				return true;
		} elseif (($items [0] == $appName) && (($num == 5) || ($num == 6)))
			return true;
		else
			return false;
	}
	function getInterfaceElements(string $intName):array {
		$dir = $this->getDir ();
		$elements = Xml_interface_file_analyzer::getInterfaceItems ( $dir . DIR_SEP . $intName );
		return $elements;
	}
	function exec_1(string $actId):array|string|bool|null {		
		$dbStructTree = $GLOBALS["dbStructTreeLocal"];
		$dbQueriesContainer = $GLOBALS["dbQueriesContainerLocal"];
		$phpArraysDefRules = $GLOBALS["phpArraysDefRules"];
		$phpArraysDefGrRules = $GLOBALS["phpArraysDefGrRules"];
		
		session_start ();
		$menuData = $_POST;
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$this->setAppName ( $appName );
		$dir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		$this->setDir ( $dir );
		
		require_once (PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
    FRAMEWORK_DIR . DIR_SEP . "Html_data_interface.class.php");
		
		$page = $_POST ["Page"];
		$op = $_POST ["Op"];
		$type = $_POST ["Type"];
		$num = $_POST ["Num"];
		
		$intName = $_POST["IntName"];
		$intNameItems = explode(FILE_NAME_ELEMENTS_SEP,$intName);
		if(count($intNameItems)==2)
		 $suffix = FILE_NAME_ELEMENTS_SEP . $intNameItems[1];
		else
		 $suffix = STRING_NULL;		
		
		$intShortName = $_POST ["ShortName"];
		$intFreeName = $_POST ["CheckBox_IFreeName"];
		$sep = Xml_interface_serializer::INTERFACE_NAME_SEP;
		
		$isIntFree = false;
		
		if (($intShortName == STRING_NULL) || ($intFreeName != "true"))
			$intName = $appName . $sep . $page . $sep . $sep . $type . $sep . $op . $sep . $num . 
			$suffix;
		else {
			$isIntFree = true;
			$intName = $intShortName;
		}

		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;		
		$fileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP . $intName;
		$xmlIntSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),$scope,$fileName);
		$xmlIntSerializer->setLoadInterfaceAsString ( true );
		$xmlIntSerializer->setDbStruct ( Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL) );
		$xmlIntSerializer->setDbQueries ( Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL) );
		$xmlIntSerializer->setAppName ( $appName );
		$xmlIntSerializer->setPageName ( $page );
		//$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		$xmlIntSerializer->setScope($scope);
		
		if (file_exists ( $fileName )) {
			$xmlIntSerializer->loadData ();
			$items = $xmlIntSerializer->getItems ();
		} else {
			$fileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
			INTERFACES_DIR . DIR_SEP . STANDARD_MOD_PREFIX . 
			Xml_interface_serializer::INTERFACE_NAME_SEP . 
			Xml_interface_serializer::INTERFACE_NAME_SEP . 
			Xml_interface_serializer::INTERFACE_NAME_SEP . $type . 
			Xml_interface_serializer::INTERFACE_NAME_SEP . 
			Xml_interface_serializer::INTERFACE_NAME_SEP . "0";
			
			$fileName3 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
			INTERFACES_DIR . DIR_SEP . STANDARD_MOD_PREFIX . 
			Xml_interface_serializer::INTERFACE_NAME_SEP . 
			Xml_interface_serializer::INTERFACE_NAME_SEP . 
			Xml_interface_serializer::INTERFACE_NAME_SEP . $type . 
			Xml_interface_serializer::INTERFACE_NAME_SEP . 
			Xml_interface_serializer::INTERFACE_NAME_SEP . "0" . 
			FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
			
			 if (file_exists($fileName2))
	      $fileName1 = $fileName2;
	     elseif (file_exists($fileName3))
	      $fileName1 = $fileName3;
	     else
	      die(MSG_16);
			
			$xmlIntSerializer->setFileName ( $fileName1 );
			$xmlIntSerializer->setLoadSpecialChars(true);
			$xmlIntSerializer->loadData ();
			$items = $xmlIntSerializer->getItems ();
			$xmlIntSerializer->setFileName ( $fileName );
		}
		
		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
        $scope1 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::DB_ITEM_CLASS);
        $className = $scope1;
		
		if ($isIntFree) {
			$items ["appName"] = $appName;
			$items ["pageName"] = $page;
		}
		$items ["op"] = $op;
		$items ["type"] = $type;
		$items ["num"] = $num;
		$items ["shortName"] = $intShortName;
		$items ["cssClass"] = $type;
		$items["obj"] = Creator::create(getClassNameForCreate(Classes_info::DB_ITEM_CLASS),$scope,"OBJ_NONE");
		
		$items ["dataFields"] = array ();
		$items ["dataFieldsDomains"] = array ();
		$items ["dataFieldsDomainsValues"] = array ();
		
		$i = 0;
		$isRows = isset ( $_POST ["Voice" . STRING_UNDERSCORE . $i] ) ? true : false;
		while ( $isRows !== false ) {
			if ($_POST ['SubMenu' . STRING_UNDERSCORE . $i] != STRING_NULL) 
			{
				if ($this->is_interface ( $_POST ['SubMenu' . STRING_UNDERSCORE . $i] )) 
				{
					$items ["dataFields"] [$i] = $_POST ["Voice" . STRING_UNDERSCORE . $i];
					$items ["dataFieldsDomains"] [$i] = "object";
					$loadedValue = Creator::create(getClassNameForCreate(Classes_info::INTERFACE_AS_STRING_CLASS),
					$scope,$_POST ['SubMenu' . STRING_UNDERSCORE . $i]);
					//	$items ["dataFieldsDomainsValues"] [$i] = $_POST ['SubMenu' . STRING_UNDERSCORE . $i];
					$items ["dataFieldsDomainsValues"] [$i] = $loadedValue;
				} 
				else 
				{
					$arraySubMenu = $_POST ['SubMenu' . STRING_UNDERSCORE . $i];
					$lex = Creator::create(getClassNameForCreate(Classes_info::LEXER_3_CLASS),STRING_NULL,STRING_NULL,$arraySubMenu);
					$lex->setRules ( $phpArraysDefRules );
					$parser = Creator::create(getClassNameForCreate(Classes_info::PARSER_CLASS),STRING_NULL,$lex);
					$parser->setGrammarRulesContainer ( $phpArraysDefGrRules );
					if (! $parser->exec ()) {
						echo $parser->getCurrentError ();
						return STRING_NULL;
					}
					$items ["dataFields"] [$i] = $_POST ["Voice" . STRING_UNDERSCORE . $i];
					$items ["dataFieldsDomains"] [$i] = "set";
					$strCode = "\$nextItem = " . $_POST ['SubMenu' . STRING_UNDERSCORE . $i] . STRING_SEMICOLON;
					eval ( $strCode );
					$items ["dataFieldsDomainsValues"] [$i] = $nextItem;
				}
			} 
			else 
			{
				if ($_POST ["Url" . STRING_UNDERSCORE . $i] != STRING_NULL)
					$items ["dataFields"] [$i] = $_POST ["Url" . STRING_UNDERSCORE . $i];
				$items ["dataFieldsDomains"] [$i] = "atomic";
				$items ["dataFieldsDomainsValues"] [$i] = $_POST ["Voice" . STRING_UNDERSCORE . $i];
			}
			$i ++;
			$isRows = isset ( $_POST ["Voice" . STRING_UNDERSCORE . $i] ) ? true : false;
		}
		
		//echo "WWWW" . $xmlIntSerializer->getScope() . "WWWW";
		$xmlIntSerializer->setScope($scope);
		$xmlIntSerializer->loadItems ( $items );
		$xmlIntSerializer->saveData ();
		return true;
	}
}
class AjaxOpGetFreeInterfaceCanonicalName extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_FREE_INTERFACE_CANONICAL_NAME );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$intName = $actId;
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$fileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP . $intName;
		$appName1 = Xml_interface_file_analyzer::getScalarProperty ( $fileName, "appName" );
		$appName = ((trim($appName) !== STRING_NULL)?$appName:$appName1);
		$pageName = Xml_interface_file_analyzer::getScalarProperty ( $fileName, "pageName" );
		$objName = Xml_interface_file_analyzer::getScalarProperty ( $fileName, "obj" );
		$op = Xml_interface_file_analyzer::getScalarProperty ( $fileName, "op" );
		$type = Xml_interface_file_analyzer::getScalarProperty ( $fileName, "type" );
		$num = Xml_interface_file_analyzer::getScalarProperty ( $fileName, "num" );
		if ($objName !== false) {
			if ($objName = "OBJ_NONE")
				$objName = STRING_NULL;
			$intCanonicalName = $appName . Xml_interface_serializer::INTERFACE_NAME_SEP . $pageName . Xml_interface_serializer::INTERFACE_NAME_SEP . $objName . Xml_interface_serializer::INTERFACE_NAME_SEP . $type . Xml_interface_serializer::INTERFACE_NAME_SEP . $op . Xml_interface_serializer::INTERFACE_NAME_SEP . $num;
		} else
			$intCanonicalName = $appName . Xml_interface_serializer::INTERFACE_NAME_SEP . $pageName . Xml_interface_serializer::INTERFACE_NAME_SEP . $type . Xml_interface_serializer::INTERFACE_NAME_SEP . $op . Xml_interface_serializer::INTERFACE_NAME_SEP . $num;
		return $intCanonicalName;
	}
}
class AjaxOpViewBindsOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_BINDS_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpViewBindsOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_BINDS_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$items = array ();
		$items = Xml_db_model::getBindsDef ( $appName );
		return $items;
	}
}
class AjaxOpViewBindsOp3 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_BINDS_OP3 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$items = array ();
		$items = Xml_db_model::getAllConnections ( $appName );
		return $items;
	}
}
class AjaxOpViewBindsOp4 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_BINDS_OP4 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$app = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$items = array ();
		$nodes = array ();
		
		$tables = Xml_db_model::getDbObjsDefProps ( $app );
		$i = 0;
		foreach ( $tables as $ind => $table ) {
			$nodes [$i ++] = $table;
			$tablePos = Xml_db_model::getTablePos ( $app, $table );
			$aliases = Xml_db_model::getAllAliases ( $app, $tablePos );
			foreach ( $aliases as $alias ) {
				$nodes [$i ++] = $alias;
			}
		}
		
		$queries = Xml_db_model::getAllDataSourceQueries ( $app );
		foreach ( $queries as $ind => $query ) {
			$nodes [$i ++] = $query;
		}
		
		foreach ( $nodes as $ind => $nodeName ) {
			$items [$ind] = array (
					"Nodes" => $nodeName 
			);
		}
		
		return $items;
	}
}
class AjaxOpRenameAliasName extends AjaxOp {
	function __construct() {
		return parent::__construct ( AJAX_OP_RENAME_ALIAS_NAME );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$ids = explode ( STRING_SEMICOLON, $actId );
		$oldAliasName = $ids [0];
		$newAliasName = $ids [1];
		return Xml_db_model::renameAliasesNamesInDbBinds ( $appName, $oldAliasName, $newAliasName );
	}
}
class AjaxOpCheckIfNodeIsUsed extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CHECK_IF_NODE_IS_USED );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		if ((trim ( $actId ) != STRING_NULL) && (Xml_db_model::checkIfNodeIsUsed ( $appName, $actId )))
			return 'true';
		return 'false';
	}
}
class AjaxOpCheckIfConnectionIsUsed extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CHECK_IF_CONNECTION_IS_USED );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		if (Xml_db_model::checkIfConnectionIsUsed ( $appName, $actId ))
			return 'true';
		return 'false';
	}
}
class AjaxOpViewBoundInterfacesOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_BOUND_INTERFACES_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$interfaces = Interfaces_model::getAllInterfacesByNode ( $appName, $actId );
		$newInterfaces = array ();
		foreach ( $interfaces as $interface )
			$newInterfaces [] = array (
					'Interface_name' => $interface 
			);
		return $newInterfaces;
	}
}
class AjaxOpViewBoundInterfacesOp3 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_VIEW_BOUND_INTERFACES_OP3 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$app = $appName;
		$items = Xml_db_model::getAllNodes ( $app );
		$nodes = array ();
		foreach ( $items as $ind => $nodeName ) {
			$nodes [$ind] = array (
					"Nodes" => $nodeName 
			);
		}
		return $nodes;
	}
}
class AjaxOpSetAllBoundInterfaces extends AjaxOp {
	const ERROR_1 = "AjaxOpSetAllBoundInterfaces:" . MSG_55;
	function __construct() {
		parent::__construct ( AJAX_OP_SET_ALL_BOUND_INTERFACES );
	}
	function exec_1(string $actId):array|string|bool|null {
		global $dbStructTree;
		global $dbQueriesContainer;
		
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$oldNode = $_POST ["oldNode"];
		$setAllTo = $_POST ["setAllTo"];
		$interfaces = $_POST ["interfaces"];
		$subEvery = $_POST ["subEvery"];
		$intArray = explode ( STRING_SEMICOLON, $interfaces );
		$nodes = $_POST ["nodes"];
		$nodesArray = explode ( STRING_SEMICOLON, $nodes );
		$appXmlDir1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		$appXmlDir2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;
		$intSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS));
		$intSerializer->setAppName ( $appName );
		$intSerializer->setDbStruct ( $dbStructTree );
		$intSerializer->setDbQueries ( $dbQueriesContainer );
		$intSerializer->setXmlDir ( $appXmlDir2 );
		$intSerializer->setInterfacesDir ( $appXmlDir1 );
		$intSerializer->setLoadInterfaceAsString ( true );
		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		$intSerializer->setScope($scope);
		$intSerializer->setLoadSpecialChars(true);
		
		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		$scope1 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::DB_ITEM_CLASS);
		$scope2 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::SERIALIZABLE_NODE_CLASS);
		
		if ($setAllTo != $oldNode) 
		{
			foreach ( $intArray as $interface ) {
				if ($interface != STRING_NULL) {
					$intSerializer->setFileName ( $interface );
					$intSerializer->loadData ();
					$items = $intSerializer->getItems ();
					$dbItem = $items ["obj"];
					if (is_a ( $dbItem, $scope1 ))
						$dbItem->setAliasName ( $setAllTo );
					elseif (is_a ( $dbItem, $scope2 ))
						$dbItem->setNodeName ( $setAllTo );
					$items ["obj"] = $dbItem;
					$intSerializer->loadItems ( $items );
					$intSerializer->saveData ();
					if (! Xml_interface_file_analyzer::is_free_interface_file ( $appXmlDir1 . DIR_SEP . $interface )) {
						if (isAXmlDataSource ( $setAllTo ))
							$setAllTo1 = OBJ_DATA_SOURCE;
					    else
						    $setAllTo1 = $setAllTo;
						$intItems = Generic_interface::decodeInterfaceId ( $interface, Xml_interface_serializer::INTERFACE_NAME_SEP );
						$newName = $intItems [0] . Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [1] . Xml_interface_serializer::INTERFACE_NAME_SEP . 
						$setAllTo1 . Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [3] . Xml_interface_serializer::INTERFACE_NAME_SEP . 
						$intItems [4] . Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [5];
						if (! rename ( $appXmlDir1 . DIR_SEP . $interface, $appXmlDir1 . DIR_SEP . $newName ))
							return self::ERROR_1 . $appXmlDir1 . DIR_SEP . $interface;
						if ($subEvery == "true")
							//Xml_db_model::replaceInAllInterfaces ( $appDir, $interface, $newName );
							{
							 $intSerializer->resetDOM();
							 $intSerializer->resetInterfacesContainer();
						     Interfaces_model::replaceIntNameInAllInterfaces($intSerializer,$interface,$newName);
							}
					}
					$intSerializer->resetDOM();
					$intSerializer->resetInterfacesContainer();
				}
			}
		} else {
			foreach ( $nodesArray as $ind => $node ) {
				if (($intArray [$ind] != STRING_NULL) && ($node != $oldNode)) 
				{
					$interface = $intArray [$ind];
					$intSerializer->setFileName ( $interface );
					$intSerializer->loadData ();
					$items = $intSerializer->getItems ();
					$dbItem = $items ["obj"];
					if (is_a ( $dbItem, $scope1 ))
						$dbItem->setAliasName ( $node );
					elseif (is_a ( $dbItem, $scope2 ))
						$dbItem->setNodeName ( $node );
					$intSerializer->loadItems ( $items );
					$intSerializer->saveData ();
					if (! Xml_interface_file_analyzer::is_free_interface_file ( $appXmlDir1 . DIR_SEP . $interface )) {
						if (isAXmlDataSource ( $node ))
							$node = OBJ_DATA_SOURCE;
						$intItems = Generic_interface::decodeInterfaceId ( $interface, Xml_interface_serializer::INTERFACE_NAME_SEP );
						$newName = $intItems [0] . Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [1] . Xml_interface_serializer::INTERFACE_NAME_SEP . $node . Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [3] . Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [4] . Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [5];
						if (! rename ( $appXmlDir1 . DIR_SEP . $interface, $appXmlDir1 . DIR_SEP . $newName ))
							return self::ERROR_1 . $appXmlDir1 . DIR_SEP . $interface;
						if ($subEvery == "true")
							//Xml_db_model::replaceInAllInterfaces ( $appDir, $interface, $newName );
							{
							 $intSerializer->resetDOM();
							 $intSerializer->resetInterfacesContainer();
						     Interfaces_model::replaceIntNameInAllInterfaces($intSerializer,$interface,$newName);
							}
					}
					$intSerializer->resetDOM();
					$intSerializer->resetInterfacesContainer();
				}
			}
		}
		return STRING_NULL;
	}
}
class AjaxOpCatalogOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CATALOG_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$idItems = explode ( STRING_SEMICOLON, $actId );
		$interfaces1 = array ();
		$interfaces2 = array ();
		if (isset ( $idItems [0] )) {
			$items1 = array ();
			$items1 = Interfaces_model::getAllInterfacesByPage ( $appName, $idItems [0] );
			foreach ( $items1 as $item )
				$interfaces1 [] = $item;
		}
		if (isset ( $idItems [1] )) {
			$items2 = array ();
			
			$items2 = Interfaces_model::getAllInterfacesByNode ( $appName, $idItems [1] );
			foreach ( $items2 as $item )
				$interfaces2 [] = $item;
		}
		$interfacesOld = array_intersect ( $interfaces1, $interfaces2 );
		$interfacesEmpty = array ();
		foreach ( $items1 as $ind => $item ) {
			$intItems = Generic_interface::decodeInterfaceId ( $item, Xml_interface_serializer::INTERFACE_NAME_SEP );
			$numIntItems=count($intItems);
			if($numIntItems>1)
			 $num=count($intItems);
			else	
			 $num = count ( Xml_interface_file_analyzer::getInterfaceItems ( PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . INTERFACES_DIR . DIR_SEP . $item ),false );
			if ($num == 5)
				$interfacesEmpty [] = $item;
		}
		$interfacesOld = array_merge ( $interfacesOld, $interfacesEmpty );
		sort ( $interfacesOld );
		$interfacesNew = array ();
		foreach ( $interfacesOld as $interface )
			$interfacesNew [] = array (
					"Interface_name" => $interface
			);
		return $interfacesNew;
	}
}
class AjaxOpCatalogOp3 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CATALOG_OP3 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$pages = array ();
		$items = Interfaces_model::getAllPages ( $appName );
		$pages [] = array (
				"Pagine" => STRING_NULL 
		);
		foreach ( $items as $item ) {
			$pages [] = array (
					"Pagine" => $item 
			);
		}
		return $pages;
	}
}
class AjaxOpCatalogOp4 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_CATALOG_OP4 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$app = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$items = Xml_db_model::getAllNodes ( $app );
		$nodes = array ();
		foreach ( $items as $ind => $nodeName ) {
			$nodes [$ind] = array (
					"Nodes" => $nodeName 
			);
		}
		return $nodes;
	}
}
class AjaxOpSetAllCatalogInterfaces extends AjaxOp {
	const ERROR_1 = "AjaxOpSetAllCatalogInterfaces:" . MSG_55;
	const ERROR_2 = "AjaxOpSetAllCatalogInterfaces:" . MSG_56;
	const ERROR_3 = "AjaxOpSetAllCatalogInterfaces:" . MSG_57;
	function __construct() {
		parent::__construct ( AJAX_OP_SET_ALL_CATALOG_INTERFACES );
	}
	function exec_1(string $actId):array|string|bool|null {
		$dbStructTree = $GLOBALS["dbStructTreeLocal"];
		$dbQueriesContainer = $GLOBALS["dbQueriesContainerLocal"]; 
		
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$oldNode = $_POST ["oldNode"];
		$oldPage = $_POST ["oldPage"];
		$setAllNodesTo = $_POST ["setAllNodesTo"];
		$setAllPagesTo = $_POST ["setAllPagesTo"];
		$oldInterfaces = $_POST ["oldInterfaces"];
		$subEvery = $_POST ["subEvery"];
		$oldIntArray = explode ( STRING_SEMICOLON, $oldInterfaces );
		$nodes = $_POST ["nodes"];
		$pages = $_POST ["pages"];
		$interfaces = $_POST ["interfaces"];
		$deleteInts = $_POST ["deleteInts"];
		$deleteIntsArray = explode ( STRING_SEMICOLON, $deleteInts );
		$nodesArray = explode ( STRING_SEMICOLON, $nodes );
		$pagesArray = explode ( STRING_SEMICOLON, $pages );
		$intArray = explode ( STRING_SEMICOLON, $interfaces );
		$appXmlDir1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		$appXmlDir2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;
		$appXmlDir3 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . FW_DIR;
		$jsonDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . JSON_DIR;
		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		
	    //if (! IsClassDeclared(XML_INTERFACE_SERIALIZER_CLASS))	 	 
	    require_once($appXmlDir3 . DIR_SEP . XML_INTERFACE_SERIALIZER_CLASS . ".class.php"); 
	 
		$intSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),$scope);
		$intSerializer->setAppName ( $appName );
		$intSerializer->setDbStruct ( $dbStructTree );
		$intSerializer->setDbQueries ( $dbQueriesContainer );
		$intSerializer->setXmlDir ( $appXmlDir2 );
		$intSerializer->setInterfacesDir ( $appXmlDir1 );
		$intSerializer->setCodeDir ( $appXmlDir3 );
		$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
		$intSerializer->setScope($scope);
		$intSerializer->setLoadSpecialChars(true);
		$scope1 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::DB_ITEM_CLASS);
		//echo $scope1;
		//die('AAAAA');
		$scope2 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::SERIALIZABLE_NODE_CLASS);
		
		$intSerializer->setLoadInterfaceAsString ( true );
		//echo "XXXXXXXXXXXXXXX";
		if (($setAllNodesTo != $oldNode) || ($setAllPagesTo != $oldPage)) 
		{
			foreach ( $oldIntArray as $interface ) {
				if ($interface != STRING_NULL) {
					$items1 = Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir1 . DIR_SEP . $interface,false );
					$intSerializer->setFileName ( $interface );
					$intSerializer->loadData ();
					$items = $intSerializer->getItems ();
					
					if (count ( $items1 ) == 6) {
						if ($setAllNodesTo != $oldNode) {
              /*$scope1 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::DB_ITEM_CLASS);
              $scope2 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::SERIALIZABLE_NODE_CLASS);
              $scope3 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS);
              $xmlSerializerClassName = $scope3;*/
			  if (! IsClassDeclared(XML_SERIALIZER_CLASS))	 	 
	               require_once($appXmlDir3 . DIR_SEP . XML_SERIALIZER_CLASS . ".class.php"); 
              $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),$scope);
			  $xmlSerializer->setDir($appXmlDir2);
              //$xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS));
							/*$scope4 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::XML_NODE_CLASS);
							$className1 = $scope4;
							$scope5 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::JSON_SERIALIZER_CLASS);
							$jsonSerializerClassName = $scope5;*/
			  if (! IsClassDeclared(JSON_SERIALIZER_CLASS))	 	 
	               require_once($appXmlDir3 . DIR_SEP . JSON_SERIALIZER_CLASS . ".class.php"); 
              $jsonSerializer = Creator::create(getClassNameForCreate(Classes_info::JSON_SERIALIZER_CLASS),$scope);
			  $jsonSerializer->setDir($jsonDir);
							//$jsonSerializer = Creator::create(getClassNameForCreate(Classes_info::JSON_SERIALIZER_CLASS));
							/*$scope6 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::JSON_NODE_CLASS);
							$className2 = $scope6;
							$scope7 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::DB_NODE_CLASS);
							$className3 = $scope7;
						  $scope8 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::DB_QUERY_CLASS);
							$className4 = $scope8;*/
							
							$factory = Creator::create(getClassNameForCreate(Classes_info::SETALLCATALOGINTERFACES_FACTORY_CLASS),
							STRING_NULL,$setAllNodesTo,$appXmlDir2,$jsonDir,$scope,
							$xmlSerializer,$jsonSerializer);
							$branchObj = $factory->create($dbStructTree,$dbQueriesContainer);
							$dataSourceItem = $branchObj->exec();
							        							
							$items["obj"] = $dataSourceItem;
						}
						if ($setAllPagesTo != $oldPage)
							$items ["pageName"] = $setAllPagesTo;
						$intSerializer->loadItems ( $items );
						$intSerializer->saveData ();
						$intSerializer->resetDOM ();
						$intSerializer->resetInterfacesContainer ();
						if (! Xml_interface_file_analyzer::is_free_interface_file ( $appXmlDir1 . DIR_SEP . $interface )) {
							if (isAXmlDataSource ( $setAllNodesTo ))
								$setAllNodesTo1 = OBJ_DATA_SOURCE;
							else
								$setAllNodesTo1 = $setAllNodesTo;
							$intItems = Generic_interface::decodeInterfaceId ( $interface, Xml_interface_serializer::INTERFACE_NAME_SEP );
							$newName = $intItems [0] . Xml_interface_serializer::INTERFACE_NAME_SEP . $setAllPagesTo .
							Xml_interface_serializer::INTERFACE_NAME_SEP . $setAllNodesTo1 . 
							Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [3] . 
							Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [4] . 
							Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [5];
							if (! rename ( $appXmlDir1 . DIR_SEP . $interface, $appXmlDir1 . DIR_SEP . $newName ))
								return self::ERROR_1 . $appXmlDir1 . DIR_SEP . $interface;
							if ($subEvery == "true")
								Interfaces_model::replaceInAllInterfaces ( $appDir, $interface, $newName );
						}
					} elseif (count ( $items1 ) == 5) {
						if ($setAllPagesTo != $oldPage)
							$items ["pageName"] = $setAllPagesTo;
						$intSerializer->loadItems ( $items );
						// echo "WWW2";
						// print_r($items);
						$intSerializer->saveData ();
						$intSerializer->resetDOM ();
						$intSerializer->resetInterfacesContainer ();
						if (! Xml_interface_file_analyzer::is_free_interface_file ( $appXmlDir1 . DIR_SEP . $interface )) {
							$intItems = Generic_interface::decodeInterfaceId ( $interface, Xml_interface_serializer::INTERFACE_NAME_SEP );
							$newName = $intItems [0] . Xml_interface_serializer::INTERFACE_NAME_SEP . $setAllPagesTo . 
							Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [2] . 
							Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [3] . 
							Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [4];
							if (! rename ( $appXmlDir1 . DIR_SEP . $interface, $appXmlDir1 . DIR_SEP . $newName ))
								return self::ERROR_1 . $appXmlDir1 . DIR_SEP . $interface;
							if ($subEvery == "true")
								Interfaces_model::replaceInAllInterfaces ( $appDir, $interface, $newName );
						}
					}
				}
			}
		} 
		else 
		{
			foreach ( $nodesArray as $ind => $node ) 
			{
				$page = $pagesArray [$ind];
				if ($oldIntArray [$ind] != STRING_NULL) 
				{
					$interface = $oldIntArray [$ind];
                    $items1 = Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir1 . DIR_SEP . $interface,false );
					if ((count ( $items1 ) == 6) && (($page != $oldPage) || ($node != $oldNode))) {
						if ($node != $oldNode) 
						{							
              /*$scope1 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::DB_ITEM_CLASS);
              $scope2 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::SERIALIZABLE_NODE_CLASS);
              $scope3 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS);
              $xmlSerializerClassName = $scope3;*/
			  $intSerializer->setFileName ( $interface );
			  $intSerializer->loadData ();
			  $items = $intSerializer->getItems ();
			  if (! IsClassDeclared(XML_SERIALIZER_CLASS))	 	 
	               require_once($appXmlDir3 . DIR_SEP . XML_SERIALIZER_CLASS . ".class.php"); 
              $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),$scope);
			  $xmlSerializer->setDir($appXmlDir2);
							/*$scope4 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::XML_NODE_CLASS);
							$className1 = $scope4;
							$scope5 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::JSON_SERIALIZER_CLASS);
							$jsonSerializerClassName = $scope5;*/
			  if (! IsClassDeclared(JSON_SERIALIZER_CLASS))	 	 
	               require_once($appXmlDir3 . DIR_SEP . JSON_SERIALIZER_CLASS . ".class.php"); 
							$jsonSerializer = Creator::create(getClassNameForCreate(Classes_info::JSON_SERIALIZER_CLASS),$scope);
							$jsonSerializer->setDir($jsonDir);
							/*$scope6 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::JSON_NODE_CLASS);
							$className2 = $scope6;
							$scope7 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::DB_NODE_CLASS);
							$className3 = $scope7;
						  $scope8 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::DB_QUERY_CLASS);
							$className4 = $scope8;*/
							
							$factory = Creator::create(getClassNameForCreate(Classes_info::SETALLCATALOGINTERFACES_FACTORY_CLASS),
							STRING_NULL,$node,$appXmlDir2,$jsonDir,$scope,
							$xmlSerializer,$jsonSerializer);
							$branchObj = $factory->create($dbStructTree,$dbQueriesContainer);
							$dataSourceItem = $branchObj->exec();
                 							
							$items["obj"] = $dataSourceItem;									  
						}
						if (($page != $oldPage)&&($node==$oldNode)) {
							$intSerializer->setFileName ( $interface );
			                $intSerializer->loadData ();
			                $items = $intSerializer->getItems ();
							$items ["pageName"] = $page;
						}
						elseif(($page != $oldPage)&&($node != $oldNode))
						{
						 $items ["pageName"] = $page;	
						}
						$intSerializer->loadItems ( $items );
						// echo "WWW3";
						// print_r($items);
						$intSerializer->saveData ();
						$intSerializer->resetDOM ();
		        $intSerializer->resetInterfacesContainer ();
						if (! Xml_interface_file_analyzer::is_free_interface_file ( $appXmlDir1 . DIR_SEP . $interface )) {
							if (isAXmlDataSource ( $node ))
								$node = OBJ_DATA_SOURCE;
							$intItems = Generic_interface::decodeInterfaceId ( $interface, Xml_interface_serializer::INTERFACE_NAME_SEP );
							$newName = $intItems [0] . Xml_interface_serializer::INTERFACE_NAME_SEP . $page . Xml_interface_serializer::INTERFACE_NAME_SEP . $node . Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [3] . Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [4] . Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [5];
							if (! rename ( $appXmlDir1 . DIR_SEP . $interface, $appXmlDir1 . DIR_SEP . $newName ))
								return self::ERROR_1 . $appXmlDir1 . DIR_SEP . $interface;
							if ($subEvery == "true")
								Interfaces_model::replaceInAllInterfaces ( $appDir, $interface, $newName );
						}
					} elseif ((count ( $items1 ) == 5) && ($page != $oldPage)) {
						if ($page != $oldPage) {
							$items ["pageName"] = $page;
						}
					    $intSerializer->setFileName ( $interface );
					    $intSerializer->loadData ();
					    $items = $intSerializer->getItems ();
						$intSerializer->loadItems ( $items );
						$intSerializer->saveData ();
						$intSerializer->resetDOM ();
						$intSerializer->resetInterfacesContainer ();
						if (! Xml_interface_file_analyzer::is_free_interface_file ( $appXmlDir1 . DIR_SEP . $interface )) {
							$intItems = Generic_interface::decodeInterfaceId ( $interface, Xml_interface_serializer::INTERFACE_NAME_SEP );
							$newName = $intItems [0] . Xml_interface_serializer::INTERFACE_NAME_SEP . $page . Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [2] . Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [3] . Xml_interface_serializer::INTERFACE_NAME_SEP . $intItems [4];
							if (! rename ( $appXmlDir1 . DIR_SEP . $interface, $appXmlDir1 . DIR_SEP . $newName ))
								return self::ERROR_1 . $appXmlDir1 . DIR_SEP . $interface;
							if ($subEvery == "true")
								Interfaces_model::replaceInAllInterfaces ( $appDir, $interface, $newName );
						}
					}
				}
			}
		}
		//echo "PPPPPPPPPPPPPPP";
		foreach ( $oldIntArray as $ind => $oldInterface ) {
			$interface = $intArray [$ind];
			if ($interface != $oldInterface) {
				//$intSerializer->resetDOM ();
				//$intSerializer->resetInterfacesContainer ();
				/*if ($subEvery == "true")
					Interfaces_model::replaceIntNameInAllInterfaces ( $intSerializer,$oldInterface, $interface );*/
				if (! rename ( $appXmlDir1 . DIR_SEP . $oldInterface, $appXmlDir1 . DIR_SEP . $interface ))
					return self::ERROR_1 . $appXmlDir1 . DIR_SEP . $oldInterface;
				$intSerializer->setFileName ( $interface );
				$intSerializer->loadData ();
				$items = $intSerializer->getItems ();
				$items ["shortName"] = $interface;
				$intSerializer->loadItems ( $items );
				// echo "WWW4";
				// print_r($items);
				$intSerializer->saveData ();
				$intSerializer->resetDOM ();
				$intSerializer->resetInterfacesContainer ();
				if ($subEvery == "true")
				{
					Interfaces_model::replaceIntNameInAllInterfaces ( $intSerializer,$oldInterface, $interface );
					$intSerializer->resetDOM ();
					$intSerializer->resetInterfacesContainer ();
				}
			}
		}
		//echo "MMMMMMMMMMMMMMMMMMM";
		foreach ( $intArray as $ind => $interface ) {
			if ($deleteIntsArray [$ind] == 'true') {
				if (! unlink ( $appXmlDir1 . DIR_SEP . $interface ))
					return self::ERROR_2 . $appXmlDir1 . DIR_SEP . $interface;
			}
		}
		return STRING_NULL;
	}
}
class AjaxOpGetInterfaceItemsNum extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_INTERFACE_ITEMS_NUM );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		return count ( Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir . DIR_SEP . $actId,false ) );
	}
}
class AjaxOpIsInterfaceBusy extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_IS_INTERFACE_BUSY );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		if (Interfaces_model::isInterfaceBusy ( $appName, $actId ))
			return 'true';
		else
			return 'false';
	}
}
class AjaxOpExportChanges extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_EXPORT_CHANGES );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		
	  $dbStructTree = $GLOBALS["dbStructTree"];
		$dbQueriesContainer = $GLOBALS["dbQueriesContainer"];	
		
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$idItems = explode ( STRING_SEMICOLON, $actId );
		$pageName = $idItems [0];
		$oldPageName = $pageName;
		$pageItems1 = explode ( STRING_POINT, $pageName );
		$pageName = $pageItems1 [0];
		$pageItems2 = explode ( Xml_interface_serializer::INTERFACE_NAME_SEP, $pageName );
		
		$subDir = $idItems [1];
		$sourcePath = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $subDir . DIR_SEP . $oldPageName;
		
		if (Xml_interface_file_analyzer::is_interface_file ( $sourcePath ) &&
		 (! Xml_interface_file_analyzer::is_free_interface_file ( $sourcePath )))
			$pageApp = $pageItems2 [0];
		else
			$pageApp = $appName;
		
		$pageName = $oldPageName;
		$num = count ( $idItems );
		$override = $idItems [2];
		try {
			for($i = 3; $i <= $num - 1; $i ++) {
				$app = $idItems [$i];
				$appDir = PREVIOUS_DIR . DIR_SEP . $app . DIR_SEP . $subDir;
				if (! Xml_interface_file_analyzer::is_interface_file ( $sourcePath )) {
					$nPageName = str_replace ( $pageApp, $app, $pageName );
					$newPath = $appDir . DIR_SEP . $nPageName;
					copy ( $sourcePath, $newPath );
					$words = array ();
					if ($override == '1') {
						$words [0] = $pageApp;
						array_replace_in_file_content ( $newPath, $words, array($app) );
						$words [0] = strToLower($pageApp);
						array_replace_in_file_content ( $newPath, $words, array(strToLower($app)));
					}
				} elseif (strToUpper ( $pageApp ) == strToUpper ( STANDARD_MOD_PREFIX )) {
					$newDir = $appDir . DIR_SEP . $pageName;
					$newPath = $newDir;
					copy ( $sourcePath, $newPath );
					$words [0] = strtolower ( STANDARD_MOD_PREFIX );
					$words [1] = STANDARD_MOD_PREFIX;
					$words [2] = strToUpper ( STANDARD_MOD_PREFIX );
					$appNames [0] = strtolower ( $app );
					$appNames [1] = ucfirst ( $app );
					$appNames [2] = strToUpper ( $app );
					array_replace_in_file_content ( $newPath, $words, $appNames );
				} else {
					$nPageName = str_replace ( $pageApp, $app, $pageName );
					$newPath = $appDir . DIR_SEP . $nPageName;
					copy ( $sourcePath, $newPath );
					$words = array ();
					if ($override == '1') {
						$xmlInt = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$nPageName);
						$xmlInt->setDbStruct ( $dbStructTree );
						$xmlInt->setDbQueries ( $dbQueriesContainer );
						$xmlInt->setInterfacesDir ( $appDir . DIR_SEP );
						$xmlInt->setLoadInterfaceAsString ( true );
						$xmlInt->replaceAppName ( $appName, $app );
					}
				}
			}
			return 'true';
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
}
class AjaxOpScanForItem extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SCAN_FOR_ITEM );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$rootDir = PREVIOUS_DIR . DIR_SEP . ucFirst ( APPLICATION_NAME ) . DIR_SEP . FW_DIR;
		$files = array_diff(scandir($rootDir), array(PREVIOUS_DIR, THIS_DIR));
		$stdFiles = getStdFiles ( $files );
		$res = false;
		foreach ( $stdFiles as $stdFile ) {
			if (scanForItem ( $rootDir . DIR_SEP . $stdFile, $actId )) {
				$res = true;
				break;
			}
		}
		if ($res)
			return 'true';
		else
			return 'false';
	}
}
class AjaxOpManageAjaxOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_MANAGE_AJAX_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpManageAjaxOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_MANAGE_AJAX_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$items1 = Xml_db_model::getAllAjaxOps ( $appDir );
		$items2 = Xml_db_model::getAllJsonAbilities ( $appDir );
		$ajaxOps = array ();
		foreach ( $items1 as $ind => $ajaxOp ) {
			$jsonAb = $items2 [$ind];
			$ajaxOps [$ind] = array (
					FIELD_AJAXOPS => $ajaxOp,
					FIELD_CHECKED => $jsonAb 
			);
		}
		return $ajaxOps;
	}
}
class AjaxOpSetAllAjaxOps extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_ALL_AJAX_OPS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$ids = explode ( STRING_SEMICOLON, $actId );
		//print_r($ids);
		return Xml_db_model::setAllAjaxOps ( $ids, $appDir );
	}
}
class AjaxOpManageAjaxClassesOp1 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_MANAGE_AJAX_CLASSES_OP1 );
	}
	function exec_1(string $actId):array|string|bool|null {
		return STRING_NULL;
	}
}
class AjaxOpManageAjaxClassesOp2 extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_MANAGE_AJAX_CLASSES_OP2 );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$items = Xml_db_model::getAllAjaxClasses ( $appDir );
		$ajaxClasses = array ();
		foreach ( $items as $ind => $ajaxClass ) {
			$ajaxClasses [$ind] = array (
					FIELD_AJAXOPS_CLASSES => $ajaxClass 
			);
		}
		return $ajaxClasses;
	}
}
class AjaxOpSetAllAjaxOpsClasses extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_SET_ALL_AJAX_OPS_CLASSES );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$ids = explode ( STRING_SEMICOLON, $actId );
		return Xml_db_model::setAllAjaxOpsClasses ( $ids, $appDir );
	}
}
class AjaxOpGenerateAjaxOpsClassesFiles extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GENERATE_AJAX_OPS_CLASSES_FILES );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		return Xml_db_model::generateAjaxOpsClassesFiles ( $appDir );
	}
}
class AjaxOpGenerateAjaxOpsConfigurationFiles extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GENERATE_AJAX_OPS_CONFIGURATION_FILES );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		return Xml_db_model::generateAjaxOpsConfigurationFiles ( $appDir );
	}
}
class AjaxOpPagesInterfacesExportChanges extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_PAGES_INTERFACES_EXPORT_CHANGES );
	}
	function exec_1(string $actId):array|string|bool|null {
		//global $dbStructTree;
		//global $dbQueriesContainer;
		
		$dbStructTree = $GLOBALS["dbStructTree"];
		$dbQueriesContainer = $GLOBALS["dbQueriesContainer"];	
		
		//die('AAAA' .$actId);
				
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$items = explode ( STRING_SEMICOLON, $actId );
		$page = $items [0];
		$override = $items [1];
		$appls = array ();
		$j = 0;
		for($i = 2; $i <= count ( $items ) - 1; $i ++)
			$appls [$j ++] = $items [$i];
		$sourceInterfacesDir = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . INTERFACES_DIR;
		$interfaces = Interfaces_model::getAllInterfacesByPage ( $appName, $page );
		foreach ( $appls as $app ) {
			$destInterfacesDir = PREVIOUS_DIR . DIR_SEP . $app . DIR_SEP . INTERFACES_DIR;
			foreach ( $interfaces as $interface ) {
				copy ( $sourceInterfacesDir . DIR_SEP . $interface, $destInterfacesDir . DIR_SEP . $interface );
				$xmlInt = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$interface);
				$xmlInt->setInterfacesDir ( $destInterfacesDir );
				$xmlInt->setLoadInterfaceAsString ( true );
				$xmlInt->setDbStruct ( $dbStructTree );
				$xmlInt->setDbQueries ( $dbQueriesContainer );
				$xmlInt->replaceAppName ( $appName, $app );
				replace_in_file_name ( $destInterfacesDir . DIR_SEP . $interface, array (
						$appName 
				), $app );
			}
		}
		return 'true';
	}
}

class AjaxOpViewFormsSectionGridOp1 extends AjaxOp {

 function __construct()
 {
	parent::__construct(AJAX_OP_VIEW_FORMS_SECTION_GRID_OP1);
 }
	
 function exec_1(string $actId):array|string|bool|null 
 {
	session_start ();
	$intName = $actId;
	$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
	$appDir = $appName;
	$fileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP . $intName;
	$xmlIntSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$fileName);
	$xmlIntSerializer->setLoadInterfaceAsString ( true );
	$xmlIntSerializer->setDbStruct (Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL) );
	$xmlIntSerializer->setDbQueries (Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL) );
	$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;

    $xmlIntSerializer->setLoadSpecialChars(true);
	$xmlIntSerializer->setScope($scope);
	$xmlIntSerializer->loadData ();
	$items = $xmlIntSerializer->getItems ();
	$retStruct = array();
	$retStruct["op"] = isset($items["op"])?$items["op"]:STRING_NULL;
	$retStruct["num"] = isset($items["num"])?$items["num"]:STRING_NULL;
	$retStruct["shortName"] = isset($items["shortName"])?$items["shortName"]:STRING_NULL;
	$retStruct["gridDimX"] = isset($items["gridDimX"])?$items["gridDimX"]:STRING_NULL;
	$retStruct["gridDimY"] = isset($items["gridDimY"])?$items["gridDimY"]:STRING_NULL;
	$retStruct["rowsStyles"] = isset($items["rowsStyles"])?$items["rowsStyles"]:array();
	$retStruct["rowsClasses"] = isset($items["rowsClasses"])?$items["rowsClasses"]:array();
	$retStruct["rowsStyle"] = isset($items["rowsStyle"])?$items["rowsStyle"]:STRING_NULL;
	$retStruct["rowsClass"] = isset($items["rowsClass"])?$items["rowsClass"]:STRING_NULL;
    $retStruct["labelSpacerWidth"] = isset($items["labelSpacerWidth"])?$items["labelSpacerWidth"]:STRING_NULL;
	$retStruct["cellPadding"] = isset($items["cellPadding"])?$items["cellPadding"]:STRING_NULL;
	$retStruct["cellSpacing"] = isset($items["cellSpacing"])?$items["cellSpacing"]:STRING_NULL;
	$retStruct["javascriptEnabled"] = isset($items["*javascriptEnabled"])?$items["*javascriptEnabled"]:STRING_NULL;
	$retStruct["style"] = isset($items["@style"])?$items["@style"]:STRING_NULL;
	$retStruct["dataFields"] = isset($items["dataFields"])?$items["dataFields"]:array();
	$retStruct["dataFieldsDomains"] = isset($items["dataFieldsDomains"])?$items["dataFieldsDomains"]:array();
	foreach($items["dataFieldsDomains"] as $ind=>$val)
	{
	 if($val=='object')
	 {
	  $items["dataFieldsDomainsValues"][$ind]=$items["dataFieldsDomainsValues"][$ind]->getItemName();
	 }
	}
	$retStruct["dataFieldsDomainsValues"] = isset($items["dataFieldsDomainsValues"])?$items["dataFieldsDomainsValues"]:array();
	$retStruct["fieldsColStyles"] = isset($items["\$fieldsColStyles"])?$items["\$fieldsColStyles"]:array();
	$retStruct["fieldsColClasses"] = isset($items["\$fieldsColClasses"])?$items["\$fieldsColClasses"]:array();
	$retStruct["fieldsStyles"] = isset($items["\$fieldsStyles"])?$items["\$fieldsStyles"]:array();
	$retStruct["fieldsLabels"] = isset($items["\$fieldsLabels"])?$items["\$fieldsLabels"]:array();
	$retStruct["fieldsTypes"] = isset($items["\$fieldsTypes"])?$items["\$fieldsTypes"]:array();
	$retStruct["fieldsStops"] = isset($items["\$fieldsStops"])?$items["\$fieldsStops"]:array();								
	$retStruct["fieldsLengths"] = isset($items["\$fieldsLengths"])?$items["\$fieldsLengths"]:array();
	$retStruct["fieldsMandatory"] = isset($items["\$fieldsMandatory"])?$items["\$fieldsMandatory"]:array();
	$retStruct["fieldsDefaultValues"] = isset($items["\$fieldsDefaultValues"])?$items["\$fieldsDefaultValues"]:array();
	$retStruct["fieldsHints"] = isset($items["\$fieldsHints"])?$items["\$fieldsHints"]:array();
	$retStruct["fieldsEvents"] = isset($items["\$fieldsEvents"])?$items["\$fieldsEvents"]:array();
	$retStruct["fieldsRegexps"] = isset($items["\$fieldsRegexps"])?$items["\$fieldsRegexps"]:array();
	$retStruct["labels"] = isset($items["\$labels"])?$items["\$labels"]:array();
	$retStruct["fieldsToolTips"] = isset($items["\$fieldsToolTips"])?$items["\$fieldsToolTips"]:array();
	$retStruct["fieldsDirections"] = isset($items["\$fieldsDirections"])?$items["\$fieldsDirections"]:array();
    //print_r($retStruct["fieldsDirections"]);	
	return $retStruct;
 }	
}	
	
class AjaxOpSaveFormSection extends AjaxOp {

 function __construct()
 {
	parent::__construct(AJAX_OP_SAVE_FORM_SECTION);
 }
 
 function parseToArray(string $actVal):array
 {
 	$retArray = preg_split("/" . STRING_COMMA . "/",$actVal);
 	return $retArray;
 }
 
 function parseToArraySetKeyAsValue(string $actVal):array
 {
 	$retArray = preg_split("/" . STRING_COMMA . "/",$actVal);
 	$retArray1 = array();
 	foreach($retArray as $ind=>$val)
 	{
 		$retArray1[$val]=$val;
 	}
 	return $retArray1;
 }
 
 function exec_1(string $actId):array|string|bool|null 
 { 	
	session_start (); 
	$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
	$appDir = $appName;
	$strVet = array();
	$i=0;
	foreach($_POST as $val)
	{
		$strVet[$i++] = $val;
	}
	$page = $strVet[0];
	$formName = $strVet[1];
	$formNameEls = Generic_interface::decodeInterfaceId($formName,Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
	
	$intName = $formName;
	$type = Interfaces_info::INT_FORM_SECTION;	
    $op = $strVet[2];
	$num = $strVet[3];
    $intShortName = $strVet[4]; 
    $intShortNamePath = PREVIOUS_DIR . DIR_SEP . 
	 $appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP . $intShortName;
	   
	if(is_array($formNameEls) && count($formNameEls)>1)
	{
	 $objName = $formNameEls[2];
	}
	elseif(($intShortName !== STRING_NULL) && (file_exists($intShortNamePath)) && 
	Xml_interface_file_analyzer::is_free_interface_file($intShortNamePath))
	{
	 $templateNameItems = Xml_interface_file_analyzer::getInterfaceItems($intShortNamePath); 	
	 $objName = $templateNameItems[2];
	}
	else
	{
	 $objName = STRING_NULL;
	}
		 
	$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;	 
   $scope1 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::DB_ITEM_CLASS); 	
  
   $obj = Creator::create(DB_ITEM_CLASS,$scope,$objName);	 
  
	$isIntFree = $strVet[5];
	$rowsClasses = $this->parseToArray($strVet[6]);
	$rowsClass = $strVet[7];
	$rowsStyles = $this->parseToArray($strVet[8]);
	$rowsStyle = $strVet[9];
	$cellPadding = $strVet[10];
	$cellSpacing = $strVet[11];
	$labelSpacerWidth = $strVet[12];
	$javascriptEnabled = $strVet[13];
    $bootstrapEnabled = $strVet[14];	
    $style = $strVet[15];
  	
	$sep = Xml_interface_serializer::INTERFACE_NAME_SEP;
		
	if (($intShortName == STRING_NULL) || ($isIntFree != "true"))
	{
	 $intNameItems = explode(FILE_NAME_ELEMENTS_SEP,$intName);
	 if(count($intNameItems)==2)
	  $suffix = FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
	 else
	  $suffix = STRING_NULL;
	 $intName = $appName . $sep . $page . $sep . $objName . $sep . 
	 $type . $sep . $op . $sep . $num . $suffix;
	 $flagIntFree=false;
	}
	else 
	{
	 $intName = $intShortName;
   $flagIntFree=true;
	}	
	
	$fileName = $intName;
 	 
	require_once(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . FRAMEWORK_ACRONYM . DIR_SEP . XML_INTERFACE_SERIALIZER_CLASS . 
     ".class.php");
	
	$xmlIntSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),$scope,$fileName);
	$xmlIntSerializer->setDbStruct($GLOBALS["dbStructTree"]);
	$xmlIntSerializer->setDbQueries($GLOBALS["dbQueriesContainer"]);
	$xmlIntSerializer->setAppName($appName);
	$xmlIntSerializer->setInterfacesDir(PREVIOUS_DIR . DIR_SEP . 
	$appDir . DIR_SEP . INTERFACES_DIR);
	$xmlIntSerializer->setCodeDir(PREVIOUS_DIR . DIR_SEP . 
	$appDir . DIR_SEP . FW_DIR);	
	$xmlIntSerializer->setScope($scope);
	
	$buf = array();

	//echo $dimVet;
	//print_r($strVet);
	$dimVet = count($strVet);
	$strVet1 = array_slice($strVet,16,$dimVet-16);
	$dimVet1 = count($strVet1);
	//echo $dimVet1;
	//echo "DimVet:" . $dimVet1;
	//print_r($strVet1);
	$ct=0;
	$ct1=0;
	$ctrlx = array();
	$num1=0;
 	while($ct1 <= $dimVet1 - 1)
	{		
	 $item = $strVet1[$ct1];
	 if($ct1==(20*$num1))
	 {
	 	//echo "*" . $ct1 . "*";
    $buf[] = STRING_UNDERSCORE;
    //echo "-" . $item . "-";
	  $items = preg_split("/" . STRING_UNDERSCORE . "/",$item);
	  $ctrlx[] = $items[2];
	  $ctrly = $items[1];
	  $num1++;
	  $ct=0;
	 }
	 else
	 {
	 	$buf[] = $item;
	 }
	 $ct++;
	 $ct1++;
	}

  //echo "buf";
  //print_r($buf);
  //echo "WWW1";
  //print_r($ctrlx);
  //echo "WWW2";

  $gridDimY = $ctrly + 1;
  $gridDimX = array_max($ctrlx) + 1; 
 
	$items = array();
	
	if($flagIntFree)
	{
	 $items["pageName"]=$page;
	 $items["appName"]=$appName;
	}
	
	$items["op"] = $op;
	$items["type"] = $type;
	$items["num"] = $num;
	$items["shortName"] = $intShortName;
	$items["cssClass"] = CSS_FORM_SECTION;
  $items["obj"] = $obj;	
	$items["gridDimX"] = $gridDimX;
	$items["gridDimY"] = $gridDimY;
	$items["rowsStyle"] = $rowsStyle;
	$items["rowsClasses"] = $rowsClasses;
	$items["rowsStyles"] = $rowsStyles;
	$items["rowsClass"] = $rowsClass;
  $items["labelSpacerWidth"] = $labelSpacerWidth;
	$items["cellPadding"] = $cellPadding;
  $items["cellSpacing"] = $cellSpacing;
  $items["*javascriptEnabled"] = $javascriptEnabled;
  $items["*bootstrapEnabled"] = $bootstrapEnabled;
  $items["*inheritData"] = false;
  $items["*inheritDataFieldName"] = false;
  $items["*fieldsFromDataSource"]=false;
  $items["@style"] = $style;
  
  $j=0;
  
  $dataFields = array();
  $dataFieldsDomains = array();
  $dataFieldsDomainsValues = array();
  $fieldsColStyles = array();
  $fieldsColClasses = array();
  $fieldsLabels = array();
  $fieldsStyles = array();
  $fieldsTypes = array();
  $fieldsStops = array();
  $fieldsLengths = array();
  $fieldsMandatory = array();
  $fieldsDefaultValues = array();
  $fieldsHints = array();
  $fieldsEvents = array();
  $fieldsRegexps = array();
  $labels = array();
  $fieldsToolTips = array();
  $fieldsDirections = array();
  
  $num2 = count($buf);
  $i=0;
  
  while($i <= $num2 - 1)
  {
   $val = $buf[$i++]; 
   if($val == STRING_UNDERSCORE)
   {   	
   	$val1 = $buf[$i++];
   	$dataFields[$j] = $val1;
   	$val1 = $buf[$i++];
   	$dataFieldsDomains[$j] = $val1;   	  	
   	$val1 = $buf[$i++];  	
   	   	
   	if($dataFieldsDomains[$j] == Int_domain::FIELD_DOMAIN_OBJ)
   	{
   	 $intObj = $xmlIntSerializer->createInterfaceFromString($val1);
   	 $dataFieldsDomainsValues[$j] = $intObj;
   	}
   	elseif(($dataFieldsDomains[$j] == Int_domain::FIELD_DOMAIN_SET)
   	||($dataFieldsDomains[$j] == Int_domain::FIELD_DOMAIN_MULTIPLE)
   /*	{
   	 if(strpos($val1,STRING_COMMA))
      $dataFieldsDomainsValues[$j] = $this->parseToArraySetKeyAsValue($val1);
     elseif($val1 !== STRING_NULL)
      $dataFieldsDomainsValues[$j] = array($val1=>$val1);
     else
      $dataFieldsDomainsValues[$j] = array('0'=>STRING_NULL);
    }*/
    ||($dataFieldsDomains[$j] == Int_domain::FIELD_DOMAIN_RADIO))
     $dataFieldsDomainsValues[$j] = $this->parseToArray($val1);
	 //$this->parseToArray($val1);
    else
     $dataFieldsDomainsValues[$j] = $val1;
     
    $val1 = $buf[$i++];
    $fieldsColStyles[$j] = $val1;
    $val1 = $buf[$i++];
    $fieldsColClasses[$j] = $val1;
    $val1 = $buf[$i++];
    $fieldsLabels[$j] = $val1;
    $val1 = $buf[$i++];
    $fieldsStyles[$j] = $val1;
    $val1 = $buf[$i++];
    $fieldsTypes[$j] = $val1;
    $val1 = $buf[$i++];
    $fieldsLengths[$j] = $val1;
    $val1 = $buf[$i++];
    $fieldsStops[$j] = $val1;
    $val1 = $buf[$i++];
    $fieldsHints[$j] = $val1;
    $val1 = $buf[$i++];
    $fieldsToolTips[$j] = $val1;
    $val1 = $buf[$i++];
    $fieldsEvents[$j] = $this->parseToArray($val1);
    $val1 = $buf[$i++];
    $fieldsRegexps[$j] = $val1;
    $val1 = $buf[$i++];
    $labels[$j] = $this->parseToArray($val1);
    $val1 = $buf[$i++]; 
    $fieldsDirections[$j] = $val1;
    $val1 = $buf[$i++]; 
    $fieldsDefaultValues[$j] = $val1;
    $val1 = $buf[$i++];
    $fieldsMandatory[$j] = $val1;    
    $i++;
    $j++;
   }
  } 
   
  $items['dataFields'] = $dataFields;
  $items['dataFieldsDomains'] = $dataFieldsDomains;
  $items['dataFieldsDomainsValues'] = $dataFieldsDomainsValues;
  $items['$fieldsColStyles'] = $fieldsColStyles;
  $items['$fieldsColClasses'] = $fieldsColClasses;
  $items['$fieldsLabels'] = $fieldsLabels;
  $items['$fieldsStyles'] = $fieldsStyles;
  $items['$fieldsTypes'] = $fieldsTypes;
  $items['$fieldsLengths'] = $fieldsLengths;
  $items['$fieldsStops'] = $fieldsStops;
  $items['$fieldsHints'] = $fieldsHints;
  $items['$fieldsToolTips'] = $fieldsToolTips;
  $items['$fieldsEvents'] = $fieldsEvents;
  $items['$fieldsRegexps'] = $fieldsRegexps;
  $items['$labels'] = $labels;
  $items['$fieldsDirections'] = $fieldsDirections;
  $items['$fieldsDefaultValues'] = $fieldsDefaultValues;
  $items['$fieldsMandatory'] = $fieldsMandatory; 
    
	$xmlIntSerializer->loadItems($items);
	$xmlIntSerializer->saveData();
	//print_r($buf);
	//echo $j;
  return STRING_NULL;
 }
}
	
class AjaxOpGetFormSections extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_FORM_SECTIONS );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		$files = scandir ( $appXmlDir );
		$formSections = array ();
		$i = 0;
		foreach ( $files as $ind => $file ) {
			$fileItems = explode ( FILE_NAME_ELEMENTS_SEP, $file );
			$fileItemsNum = count ( $fileItems );
			if (((! is_dir ( $file )) && ($fileItemsNum == 1))||
			((! is_dir ( $file ))&&($fileItemsNum==2)&&($fileItems[1]==XML_SUFFIX))) {
				$interfaceItems = 
				Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir . DIR_SEP . $file );
				$fileItemsNum2 = count ( $interfaceItems );
				if ($fileItemsNum2 == 6)
					$interfaceType = $interfaceItems [3];
				elseif ($fileItemsNum2 == 5)
					$interfaceType = $interfaceItems [2];
				if (($interfaceType == Interfaces_info::INT_FORM_SECTION)&&
				($interfaceItems [0]!==STANDARD_MOD_PREFIX)) {
					$formSectionPageName = $interfaceItems [1];
					if  ($formSectionPageName == $actId)
						$formSections [$i++] = $file;
				}
			}
		}
		return $formSections;
	}
}

// 
class AjaxOpViewPdfTemplateGridOp1 extends AjaxOp
{
function __construct()
{
parent::__construct(AJAX_OP_VIEW_PDF_TEMPLATE_GRID_OP1);
}

function exec_1(string $actId):array|string|bool|null
{
 session_start ();
 $appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
 $appDir = $appName;
 $intName = $actId;
 $fileName = PREVIOUS_DIR . DIR_SEP . 
	$appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP . $intName;
	$xmlIntSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$fileName);
	$xmlIntSerializer->setLoadInterfaceAsString ( true );
	$xmlIntSerializer->setDbStruct ( Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL) );
	$xmlIntSerializer->setDbQueries ( Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL) );
	$xmlIntSerializer->setXmlDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR);
	$xmlIntSerializer->loadData ();
	$items = $xmlIntSerializer->getItems ();
	$retStruct = array();
	$retStruct["shortName"] = $items["shortName"];
	$retStruct["gridDimX"] = $items["gridDimX"];
	$retStruct["gridDimY"] = $items["gridDimY"];
	$retStruct["dataFields"] = $items["dataFields"];
	$retStruct["dataFieldsDomains"] = $items["dataFieldsDomains"];
	foreach($items["dataFieldsDomains"] as $ind=>$val)
	{
	 if($val=='object')
	 {
	  $items["dataFieldsDomainsValues"][$ind]=$items["dataFieldsDomainsValues"][$ind]->getItemName();
	 }
	}
	$retStruct["dataFieldsDomainsValues"] = $items["dataFieldsDomainsValues"];
	return $retStruct;
 }	

}

// 
class AjaxOpSavePdfTemplate extends AjaxOp
{
	
const ERROR_0 = "AjaxOpSavePdfTemplate:" . MSG_58;

	
function __construct()
{
parent::__construct(AJAX_OP_SAVE_PDF_TEMPLATE);
}

function getObjNameFromIntName(string $actIntName):string
{  
	$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
	$appDir = $appName;
	
	$intShortNamePath = PREVIOUS_DIR . DIR_SEP . 
	$appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP . $actIntName;
	
	if(file_exists($intShortNamePath))
	  $objName = Xml_interface_file_analyzer::getScalarProperty(
       $intShortNamePath,"obj");
	else
	  $objName = STRING_NULL;
	
	return $objName;
}

 function getObjNodeInstance(string $actObjName):object
 {  
  $appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
  $appDir = $appName;
  
  $dbStructTree = $GLOBALS["dbStructTree"];
  $dbQueriesContainer = $GLOBALS["dbQueriesContainer"];
  
 // echo $actObjName;
  
	$scope = STRING_BACKSLASH . $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;	

  if ((! is_null($dbStructTree->getElementByAliasName($actObjName)))||
  (! is_null($dbQueriesContainer->getQuery($actObjName))))
  {
	 $scope1 = $scope . STRING_BACKSLASH . DB_ITEM_CLASS;
	 $obj = Creator::create(getClassNameForCreate(Classes_info::DB_ITEM_CLASS),$scope,$actObjName);
	}
	elseif (isAXmlDataSource($actObjName))
	{
	 $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;	
	 $scope2 = $scope . STRING_BACKSLASH . XML_SERIALIZER_CLASS;
	 $fileName = $appXmlDir . DIR_SEP . $actObjName;
	 
	 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),$scope,$actObjName);
	 $xmlSerializer->setDir($appXmlDir);
	 $scope1 = $scope . STRING_BACKSLASH . XML_NODE_CLASS;
	 $obj = Creator::create(getClassNameForCreate(Classes_info::XML_NODE_CLASS),$scope,$xmlSerializer);
	}
	elseif(isAJsonDataSource($actObjName))
	{
	 $appJsonDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . JSON_DIR;	
	 $scope2 = $scope . STRING_BACKSLASH . JSON_SERIALIZER_CLASS;
	 $fileName = $appJsonDir . DIR_SEP . $actObjName;
	 $jsonSerializer = Creator::create(getClassNameForCreate(Classes_info::JSON_SERIALIZER_CLASS),$scope,$actObjName);
	 $jsonSerializer->setDir($appJsonDir);
	 $scope1 = $scope . STRING_BACKSLASH . JSON_NODE_CLASS;
	 $obj = Creator::create(getClassNameForCreate(Classes_info::JSON_NODE_CLASS),$scope,$jsonSerializer);
	}
	else
	{
	 $scope1 = $scope . STRING_BACKSLASH . DB_ITEM_CLASS;
	 $obj = Creator::create(getClassNameForCreate(Classes_info::DB_ITEM_CLASS),$scope,OBJ_NONE);
	}
	return $obj;
 }
 
 function exec_1(string $actId):array|string|bool|null 
 {
	session_start (); 

  $appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
	$appDir = $appName;
	$strVet = array();
	$i=0;
	foreach($_POST as $val)
	{
		$strVet[$i++] = $val;
	}
	
	$page = $strVet[0];
	$templateName = $strVet[1];				
	$op = $strVet[2];
	$type = Interfaces_info::INT_FPDF_TEMPLATE;
	$num2 = $strVet[3];
	$shortName = $strVet[4];	
  $intShortName = $shortName; 

  $isIntFree = $strVet[5];
	$sep = Xml_interface_serializer::INTERFACE_NAME_SEP;
	if (($intShortName == STRING_NULL) || ($isIntFree != "true"))
	{
	 $intNameItems = explode(FILE_NAME_ELEMENTS_SEP,$templateName);
	 if($templateName!==STRING_NULL)
      $objName = $this->getObjNameFromIntName($templateName);
	 else
	  $objName = STRING_NULL;
	 if(count($intNameItems)==2)
	  $suffix = FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
	 else
	  $suffix = STRING_NULL;
	 $intName = $appName . $sep . $page . $sep . $objName . $sep . 
	 $type . $sep . $op . $sep . $num2 . $suffix;
	 $flagIntFree=false;	
	}
	else 
	{
	 $intName = $intShortName;
	 $objName = $this->getObjNameFromIntName($intShortName);
	 $flagIntFree=true;
	}	
	
  $obj = $this->getObjNodeInstance($objName);
		
	$intInfoScope = STRING_BACKSLASH . $appDir . STRING_BACKSLASH .  
  FRAMEWORK_DIR;
  
	$intInfoScope1 = STRING_BACKSLASH . $appDir . STRING_BACKSLASH . 
  FRAMEWORK_DIR;

  $intInfoClassName = $intInfoScope . STRING_BACKSLASH . INTERFACES_INFO_CLASS;
		
	$fileName = $intName;	
	
	require_once(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
    FRAMEWORK_ACRONYM . DIR_SEP . INTERFACES_INFO_CLASS . ".class.php");

	$xmlIntSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$fileName);
	
	$xmlIntSerializer->setDbStruct($GLOBALS["dbStructTree"]);
	$xmlIntSerializer->setDbQueries($GLOBALS["dbQueriesContainer"]);
	$xmlIntSerializer->setAppName($appName);
	$xmlIntSerializer->setInterfacesDir(PREVIOUS_DIR . DIR_SEP . 
	$appName . DIR_SEP . INTERFACES_DIR);
	$xmlIntSerializer->setXmlDir(PREVIOUS_DIR . DIR_SEP . 
	$appName . DIR_SEP . XML_DIR);
	$xmlIntSerializer->setCodeDir(PREVIOUS_DIR . DIR_SEP . $appName .
	 DIR_SEP . FW_DIR);
	$xmlIntSerializer->setScope($intInfoScope1);
		
	$buf = array();

    //print_r($strVet);
	//die('MMM');

	$dimVet = count($strVet);
	$strVet1 = array_slice($strVet,6,$dimVet-6);
	$dimVet1 = count($strVet1);

    //print_r($strVet1);
    //die('MMM');
	
	$ct=0;
	$ct1=0;
	$ctrlx = array();
	$num=0;
 	while($ct1 <= $dimVet1 - 1)
	{		
	 $item = $strVet1[$ct1];
	 //echo($item);
	 if($ct1==(21*$num))
	 {
    $buf[] = STRING_UNDERSCORE;
	  $items = preg_split("/" . STRING_UNDERSCORE . "/",$item);
	  //print_r($items);
	  $ctrlx[] = $items[2];
	  $ctrly = $items[1];
	  $num++;
	  $ct=0;
	 }
	 else
	 {
	 	$buf[] = $item;
	 }
	 $ct++;
	 $ct1++;
	}
 

  $gridDimY = $ctrly + 1;
  $gridDimX = array_max($ctrlx) + 1; 


	$items = array();

	if($flagIntFree)
	{
	 $items["pageName"]=$page;
	 $items["appName"]=$appName;
	}
 
	$items["op"] = $op;
	$items["type"] = $type;
	$items["num"] = $num2;
	$items["shortName"] = $shortName;
  $items["obj"] = $obj;	
	$items["gridDimX"] = $gridDimX;
	$items["gridDimY"] = $gridDimY;
  $items["fileName"] = $fileName;
    $items["*inheritData"] = false;
	$items["*inheritDataFieldName"]=false;
	$items["*fieldsFromDataSource"]=false;
 
  $dataFields1 = array();
  $dataFieldsDomains1 = array();
  $dataFieldsDomainsValues1 = array();
  $num1 = count($buf);
  $i=0;
  //print_r(array_slice($buf,63,20));
  //die('*');
  //die('A' . $num1 . 'A');
  while($i <= $num1 - 1)
  {
   $val = $buf[$i++];
   if(($val == STRING_UNDERSCORE)&&(count($buf)>1))
   {   	
    $val1 = $buf[$i++];
    $type = $val1; 
    $val1 = $buf[$i++];
    $shortName1 = $val1;
    
    $objName = $this->getObjNameFromIntName($shortName1);
    $obj = $this->getObjNodeInstance($objName);
     
    $val1 = $buf[$i++];
    $appName = $val1;
    $val1 = $buf[$i++];
    $num = $val1;
    $val1 = $buf[$i++];
    $op = $val1;
    $val1 = $buf[$i++]; 
    $pageName = $val1;
    $val1 = $buf[$i++];  
    
    switch($type)
    {
     case Interfaces_info::INT_FPDF_FIELD_H:
     
      if($shortName1 !== 'none')
       $dataFields = array($val1);
      else
       $dataFields = array();      

   	  $val1 = $buf[$i++];
	  
      if($shortName1 !== 'none')
       $dataFieldsDomains = array($val1);
      else
       $dataFieldsDomains = array();	  
	  
   	  //$dataFieldsDomains = array($val1);   	  	
   	  $val1 = $buf[$i++];  	
      
      if($shortName1 !== 'none')
       $dataFieldsDomainsValues = array($val1);
      else
       $dataFieldsDomainsValues = array();	  
	  
	  //$dataFieldsDomainsValues = array($val1);  
      $val1 = $buf[$i++]; 
      $val1 = $buf[$i++]; 
      $xCoord = $val1; 
      $val1 = $buf[$i++]; 
      $yCoord = $val1;
      $val1 = $buf[$i++];
      $height = $val1;
      $val1 = $buf[$i++];
      $font = $val1;
      $val1 = $buf[$i++];
      $fontStyle = $val1;
      $val1 = $buf[$i++];  
      $fontSize = $val1;
      $val1 = $buf[$i++];
      $labelName = $val1; 
      $i+=2;
      $val1 = $buf[$i];
//      if($shortName1 !== 'none')
      $dataFields1[] = $val1;
//      else
//       $dataFields1[] = STRING_NULL; 
      $dataFieldsDomains1[] = 'object';
      $interface = $intInfoClassName::createInterface(PREVIOUS_DIR . DIR_SEP . 
	    $appDir . DIR_SEP . FRAMEWORK_DIR ,
      $appDir . VAR_SEP . $type,OBJ_NONE,OP_NONE,0);	
      $interface->setShortName($shortName1);
      //echo get_class($interface);
      //die('DDDDD');
      $dataFieldsDomainsValues1[] = $interface; 	           
      break;
     case Interfaces_info::INT_FPDF_FIELD_V:
   	  $dataFields = array($val1);
   	  $val1 = $buf[$i++];
   	  $dataFieldsDomains = array($val1);   	  	
   	  $val1 = $buf[$i++];  	
      $dataFieldsDomainsValues = array($val1);  
      $val1 = $buf[$i++];     
      $val1 = $buf[$i++]; 
      $xCoord = $val1; 
      $val1 = $buf[$i++]; 
      $yCoord = $val1;
      $val1 = $buf[$i++];
      $height = $val1;
      $val1 = $buf[$i++];
      $font = $val1;
      $val1 = $buf[$i++];
      $fontStyle = $val1;
      $val1 = $buf[$i++];  
      $fontSize = $val1;
      $val1 = $buf[$i++];
      $labelName = $val1; 
      $i+=2;
      $val1 = $buf[$i];
      $dataFields1[] = $val1; 
      $dataFieldsDomains1[] = 'object'; 
      $interface = $intInfoClassName::createInterface(PREVIOUS_DIR . DIR_SEP . 
	    $appDir . DIR_SEP . FRAMEWORK_DIR ,
      $appDir . VAR_SEP . $type,OBJ_NONE,OP_NONE,0);
      $interface->setShortName($shortName1);
      $dataFieldsDomainsValues1[] = $interface;   
      break;
     case Interfaces_info::INT_FPDF_IMG:
      $i += 4;
      $val1 = $buf[$i++];
      $xCoord = $val1; 
      $val1 = $buf[$i++]; 
      $yCoord = $val1;
      $val1 = $buf[$i++];
      $height = $val1;
      $val1 = $buf[$i++];
      $width = $val1;
      $val1 = $buf[$i++];
      $fileName = $val1;
      $val1 = $buf[$i++];  
      $fileType = $val1;
      $i+=2;
      $val1 = $buf[$i];
      $dataFields1[] = $val1; 
      $dataFieldsDomains1[] = 'object'; 
      $interface = $intInfoClassName::createInterface(PREVIOUS_DIR . DIR_SEP . 
	    $appDir . DIR_SEP . FRAMEWORK_DIR ,
      $appDir . VAR_SEP . $type,OBJ_NONE,OP_NONE,0);
      $interface->setShortName($shortName1);
      $dataFieldsDomainsValues1[] = $interface; 
      break;
     case Interfaces_info::INT_FPDF_TXT:
   	  $dataFields = array($val1);
   	  $val1 = $buf[$i++];
   	  $dataFieldsDomains = array($val1);   	  	
   	  $val1 = $buf[$i++];  	
      $dataFieldsDomainsValues = array($val1);  
      $val1 = $buf[$i++]; 
      $val1 = $buf[$i++]; 
      $xCoord = $val1; 
      $val1 = $buf[$i++]; 
      $yCoord = $val1;
      $val1 = $buf[$i++];
      $height = $val1;
      $val1 = $buf[$i++];
      $width = $val1;
      $val1 = $buf[$i++];
      $font = $val1;
      $val1 = $buf[$i++];  
      $fontStyle = $val1;
      $val1 = $buf[$i++];  
      $fontSize = $val1;
      $i+=2;
      $val1 = $buf[$i];
      $dataFields1[] = $val1; 
      $dataFieldsDomains1[] = 'object';
      $interface = $intInfoClassName::createInterface(PREVIOUS_DIR . DIR_SEP . 
	    $appDir . DIR_SEP . FRAMEWORK_DIR ,
      $appDir . VAR_SEP . $type,OBJ_NONE,OP_NONE,0);
      $interface->setShortName($shortName1);
      $dataFieldsDomainsValues1[] = $interface; 
      break;
     case Interfaces_info::INT_FPDF_FIELD_TEMPLATE:
   	  $dataFields =  preg_split('/' . STRING_CANCELLETTO . '/',$val1);
   	  if(! is_array($dataFields))
   	   $dataFields = array();
   	  $val1 = $buf[$i++];
   	  $dataFieldsDomains =  preg_split('/' . STRING_CANCELLETTO . '/',$val1);
   	  if(! is_array($dataFieldsDomains))
   	   $dataFieldsDomains = array();   	  	
   	  $val1 = $buf[$i++];  	
      $dataFieldsDomainsValues =  preg_split('/' . STRING_CANCELLETTO . '/',$val1);      
   	  if(! is_array($dataFieldsDomainsValues))
   	   $dataFieldsDomainsValues = array();   
      $val1 = $buf[$i++]; 
      $val1 = $buf[$i++]; 
      $xCoord = $val1; 
      $val1 = $buf[$i++]; 
      $yCoord = $val1;
      $val1 = $buf[$i++];
      $height = $val1;
      $val1 = $buf[$i++];
      $width = $val1;
      $val1 = $buf[$i++];
      $font = $val1;
      $val1 = $buf[$i++];  
      $fontStyle = $val1;
      $val1 = $buf[$i++];  
      $fontSize = $val1;
      $val1 = $buf[$i++];
      $align = $val1;
      $val1 = $buf[$i++];
      $template = $val1;
      $val1 = $buf[$i];
      $dataFields1[] = $val1; 
      $dataFieldsDomains1[] = 'object';  
      $interface = $intInfoClassName::createInterface(PREVIOUS_DIR . DIR_SEP . 
	    $appDir . DIR_SEP . FRAMEWORK_DIR,
      $appDir . VAR_SEP . $type,OBJ_NONE,OP_NONE,0);
      $interface->setShortName($shortName1);
      //var_dump($interface);
      //die('AAAAAA');
      $dataFieldsDomainsValues1[] = $interface;    
      break;
     default:
      die(self::ERROR_0);
    }    
    $intItems = array(); 
    
    $intItems["op"] = OP_NONE;
    $intItems["type"] = $type;
    $intItems["num"] = "0";
    $intItems["shortName"] = $shortName1;
    $intItems["pageName"] = $page;   
    $intItems["appName"] = $appName;
    $intItems["xCoord"] = $xCoord;
    $intItems["yCoord"] = $yCoord;
    $intItems["height"] = $height;     

    switch($type)
    {
     case Interfaces_info::INT_FPDF_FIELD_H:
      $intItems["font"] = $font;
      $intItems["fontStyle"] = $fontStyle;  
      $intItems["fontSize"] = $fontSize;
      $intItems["labelName"] = $labelName;
      $intItems["obj"] = $obj;
      $intItems["dataFields"] = $dataFields;
      $intItems["dataFieldsDomains"] = $dataFieldsDomains;
      $intItems["dataFieldsDomainsValues"] = $dataFieldsDomainsValues;             
      break;
     case Interfaces_info::INT_FPDF_FIELD_V:
      $intItems["font"] = $font;
      $intItems["fontStyle"] = $fontStyle;  
      $intItems["fontSize"] = $fontSize;
      $intItems["labelName"] = $labelName;  
      $intItems["obj"] = $obj;
      $intItems["dataFields"] = $dataFields;
      $intItems["dataFieldsDomains"] = $dataFieldsDomains;
      $intItems["dataFieldsDomainsValues"] = $dataFieldsDomainsValues;   
      break;
     case Interfaces_info::INT_FPDF_IMG:
      $intItems["width"] = $width;
      $intItems["fileName"] = $fileName;  
      $intItems["fileType"] = $fileType;
      break;
     case Interfaces_info::INT_FPDF_TXT:
      $intItems["width"] = $width;
      $intItems["font"] = $font;
      $intItems["fontStyle"] = $fontStyle;  
      $intItems["fontSize"] = $fontSize;
      $intItems["obj"] = $obj;
      $intItems["dataFields"] = $dataFields;
      $intItems["dataFieldsDomains"] = $dataFieldsDomains;
      $intItems["dataFieldsDomainsValues"] = $dataFieldsDomainsValues;
      break;
     case Interfaces_info::INT_FPDF_FIELD_TEMPLATE:
      $intItems["width"] = $width;
      $intItems["align"] = $align;
      $intItems["font"] = $font;
      $intItems["fontStyle"] = $fontStyle;  
      $intItems["fontSize"] = $fontSize;
      $intItems["obj"] = $obj;
      $intItems["@template"] = $template;
      $intItems["dataFields"] = $dataFields;
      $intItems["dataFieldsDomains"] = $dataFieldsDomains;
      $intItems["dataFieldsDomainsValues"] = $dataFieldsDomainsValues;
      break;
     default:
      die(self::ERROR_0);
    }  
           
    $xmlIntSerializer->resetDOM();
    $xmlIntSerializer->setFileName($shortName1);    
	  $xmlIntSerializer->loadItems($intItems);
	  //print_r($intItems);
	  $xmlIntSerializer->saveData();    
    
    $i++;
   }
  } 
  
  $xmlIntSerializer->resetDOM();
  $items["dataFields"] = $dataFields1;
  $items["dataFieldsDomains"] = $dataFieldsDomains1;
	$items["dataFieldsDomainsValues"] = $dataFieldsDomainsValues1;
	//echo "****";
	//echo $intName;
	//echo "****";
	//die("Exit");

	$xmlIntSerializer->setFileName($intName);
  $xmlIntSerializer->loadItems($items);
	$xmlIntSerializer->saveData(); 
	return STRING_NULL;
 }
}

// 
class AjaxOpGetObjTypeByShortName extends AjaxOp
{
function __construct()
{
parent::__construct(AJAX_OP_GET_OBJ_TYPE_BY_SHORT_NAME);
}

function exec_1(string $actId):array|string|bool|null
{
 session_start ();
 $intName = $actId;
  $appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
	$appDir = $appName;
  $intType = STRING_NULL;
  $filesItems = Xml_interface_file_analyzer::getInterfaceItems(PREVIOUS_DIR . DIR_SEP . 
	    $appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP . $intName); 
  $num = count($filesItems);
  if($num==6)
   $intType = $filesItems[3];
  else
   $intType = $filesItems[2];
  return $intType;	
}
}

// 
class AjaxOpGetFpdfIntProps extends AjaxOp
{
function __construct()
{
parent::__construct(AJAX_OP_GET_FPDF_INT_PROPS);
}

function exec_1(string $actId):array|string|bool|null
{
 session_start ();
 $intName = $actId;
  $appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
	$appDir = $appName;
	$dir = PREVIOUS_DIR . DIR_SEP . 
	    $appDir . DIR_SEP . XML_DIR;
	$intDir = PREVIOUS_DIR . DIR_SEP . 
	    $appDir . DIR_SEP . INTERFACES_DIR;
  $fileName = $intDir . DIR_SEP . $intName;
  $xmlIntSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$fileName);
  $xmlIntSerializer->setXmlDir($dir);
	$xmlIntSerializer->setLoadInterfaceAsString ( true );
	$xmlIntSerializer->setDbStruct ( Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL) );
	$xmlIntSerializer->setDbQueries ( Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL));
	$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
	$xmlIntSerializer->setScope($scope);
	$xmlIntSerializer->loadData ();
	//die('CCCC');
	$scope1 = $scope . STRING_BACKSLASH . getClassNameForCreate(Classes_info::DB_ITEM_CLASS);
	
	$items = $xmlIntSerializer->getItems ();
	$retStruct = array();
	foreach($items as $ind=>$val)
	{
	 if(! is_object($val))
	  $retStruct[$ind] = $val;
	 elseif(is_a($val,$scope1))
	 {
	 	$retStruct[$ind] = $val->getAliasName();
	 }
	 else{
		 $retStruct[$ind] = $val->getItemName();
	 }
  }
	return $retStruct;		
}
}

//  
class AjaxOpGetPredInterfaces extends AjaxOp
{
function __construct()
{
parent::__construct(AJAX_OP_GET_PRED_INTERFACES);
}

function exec_1(string $actId):array|string|bool|null
{
 session_start ();
  $appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
	$appDir = $appName;
  $appDir = PREVIOUS_DIR . DIR_SEP . 
	    $appDir . DIR_SEP . INTERFACES_DIR;
  $ints = array();
  $files = scandir($appDir);
  $i=0;
  foreach($files as $ind=>$file)
  {
 	 if(! is_dir($file))
 	 {
    $filesItems2 = preg_split("/\\"  . FILE_NAME_ELEMENTS_SEP  . "/",$file);
    $intName = $filesItems2[0];
    $intNameItems = explode(Interfaces_info::INTERFACE_INSTANCE_CHAR_SEP,$intName);
    $prefix = $intNameItems[0];
    $num = count($filesItems2);
    if((($num==1)||(($num==2)&&($filesItems2[1]==XML_SUFFIX)))&&($prefix !== STANDARD_MOD_PREFIX))
    {
     $filesItems = Xml_interface_file_analyzer::getInterfaceItems($appDir . DIR_SEP . $file);
     if (
        (! in_array($file,$ints))&&
        (($file !== STRING_NULL)&&
        ((((count($filesItems)==5)&&
        (in_array($filesItems[2],array(Interfaces_info::INT_FPDF_FIELD_H,
     Interfaces_info::INT_FPDF_FIELD_V,Interfaces_info::INT_FPDF_IMG,
     Interfaces_info::INT_FPDF_TXT,
     Interfaces_info::INT_FPDF_FIELD_TEMPLATE)))))
     ||((count($filesItems)==6)&&
     (in_array($filesItems[3],array(Interfaces_info::INT_FPDF_FIELD_H,
     Interfaces_info::INT_FPDF_FIELD_V,Interfaces_info::INT_FPDF_IMG,
     Interfaces_info::INT_FPDF_TXT,
     Interfaces_info::INT_FPDF_FIELD_TEMPLATE)
     ))))))
   	  $ints[$i] = $file;
   	 $i++;
    }
   } 
  }
  return $ints; 		
}
}

// 
class AjaxOpGetPredInterfaces2 extends AjaxOp
{
function __construct()
{
parent::__construct(AJAX_OP_GET_PRED_INTERFACES_2);
}

function exec_1(string $actId):array|string|bool|null
{
 session_start ();
  $appName = ((isset($_SESSION [SESSION_VAR_ACTIVE_APP]) &&
  ($_SESSION[SESSION_VAR_ACTIVE_APP]) !== STRING_NULL)?
  ($_SESSION [SESSION_VAR_ACTIVE_APP]):(APPLICATION_NAME));
	$appDir = $appName;
  $appDir = PREVIOUS_DIR . DIR_SEP . 
	    $appDir . DIR_SEP . INTERFACES_DIR;
  $ints = array();
  $files = scandir($appDir);
  $retStruct = array();
  $i=0;
  foreach($files as $ind=>$file)
  {
 	 if(! is_dir($file))
 	 {
    $filesItems2 = preg_split("/\\"  . FILE_NAME_ELEMENTS_SEP  . "/",$file);
   $intName = $filesItems2[0];
    $intNameItems = explode(Interfaces_info::INTERFACE_INSTANCE_CHAR_SEP,$intName);
    $prefix = $intNameItems[0];
    $num = count($filesItems2);
    if((($num==1)||(($num==2)&&($filesItems2[1]==XML_SUFFIX)))&&($prefix !== STANDARD_MOD_PREFIX))   
    {
      $filesItems = Xml_interface_file_analyzer::getInterfaceItems($appDir . DIR_SEP . $file);
     if((! in_array($file,$ints))&&($file !== 'none')&&
     (($file !== STRING_NULL)&&((((count($filesItems)==5)&&
     (($filesItems[2]==Interfaces_info::INT_FPDF_FIELD_H)||
     ($filesItems[2]==Interfaces_info::INT_FPDF_FIELD_V)||
     ($filesItems[2]==Interfaces_info::INT_FPDF_IMG)||
     ($filesItems[2]==Interfaces_info::INT_FPDF_TXT)||
     ($filesItems[2]==Interfaces_info::INT_FPDF_FIELD_TEMPLATE)
     )))||((count($filesItems)==6)&&
     (($filesItems[3]==Interfaces_info::INT_FPDF_FIELD_H)||
     (($filesItems[3]==Interfaces_info::INT_FPDF_FIELD_V)||
     (($filesItems[3]==Interfaces_info::INT_FPDF_IMG)||
     (($filesItems[3]==Interfaces_info::INT_FPDF_TXT)||
     (($filesItems[3]==Interfaces_info::INT_FPDF_FIELD_TEMPLATE)
     )))))))))
     {
     	$ints[FIELD_FIELD] = $file;
   	  $retStruct[$i] = $ints;
   	  $i++;
   	 }
    }
   } 
  }
  return $retStruct; 	
 }
 }

// 
class AjaxOpInterfaceExists extends AjaxOp
{
function __construct()
{
parent::__construct(AJAX_OP_INTERFACE_EXISTS);
}

function exec_1(string $actId):array|string|bool|null
{
  session_start ();
  $appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
	$appDir = $appName;
  $appDir = PREVIOUS_DIR . DIR_SEP . 
	    $appDir . DIR_SEP . INTERFACES_DIR;
	$fileName = $appDir . DIR_SEP . $actId;
	
	if(file_exists($fileName))
	 return 'true';
	else
	 return 'false';
}
}

// 
class AjaxOpCreatePdf extends AjaxOp
{
function __construct()
{
parent::__construct(AJAX_OP_CREATE_PDF);
}

function exec_1(string $actId):array|string|bool|null
{	
	session_start ();
	//echo "VVVVVVV";
		//die('MMMM');
  $appName1 = $_SESSION [SESSION_VAR_ACTIVE_APP];
  $appDir = $appName1;
  $appDir1 = PREVIOUS_DIR . DIR_SEP . $appName1 . DIR_SEP . INTERFACES_DIR;
  $appDir2 = PREVIOUS_DIR . DIR_SEP . $appName1 . DIR_SEP . XML_DIR;
	$codeDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . FW_DIR;
	$fileName = $actId;
	$scope = $appName1 . STRING_BACKSLASH . FRAMEWORK_DIR;
	$intName = $appName1 . STRING_UNDERSCORE . "fpdf_template";
	$intFullName = $scope . STRING_BACKSLASH . $intName;

	require_once(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . "root.const.php");
	
	require_once(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
  FRAMEWORK_DIR . DIR_SEP . $appName1 . VAR_SEP . "generic.const.php");

  require_once (PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
  FPDF_DIR .  DIR_SEP . "Fpdf.class.php");	
  
  require_once (PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
  FRAMEWORK_DIR . DIR_SEP . $intName . ".class.php");	
	$fpdfTemp = Creator::create($intName,$scope);
	$fpdfTemp->setDbStruct($GLOBALS["dbStructTree"]);
	$fpdfTemp->setDbQueries($GLOBALS["dbQueriesContainer"]);
	$fpdf = $fpdfTemp::createFpdf();
	$fpdfTemp->setFpdf($fpdf);
	$fpdfTemp->setShortName($actId);
	$fpdfTemp->getSerializer()->setScope($scope);
	$fpdfTemp->getSerializer()->setAppName($appName1);
	$fpdfTemp->getSerializer()->setInterfacesDir($appDir1);
	$fpdfTemp->getSerializer()->setXmlDir($appDir2);
	$fpdfTemp->getSerializer()->setCodeDir($codeDir);

	$fpdfTemp->serializer_loadData();
	$fpdfTemp->unserialize();
	$intDir = PREVIOUS_DIR . DIR_SEP . $appName1  . DIR_SEP . PDF_DIR;
	$pdfFileName = $intDir . DIR_SEP . 'doc.pdf';
	$fpdfTemp->setFileName($pdfFileName);
	$fpdfTemp->putData();
	return 'true';
}
}


// 
class AjaxOpDeleteFile2 extends AjaxOp
{
function __construct()
{
parent::__construct(AJAX_OP_DELETE_FILE_2);
}

function exec_1(string $actId):array|string|bool|null
{
	session_start ();
  $appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
	$appDir = $appName;
  $appDir = PREVIOUS_DIR . DIR_SEP . 
	$appDir . DIR_SEP . PDF_DIR;
	$fileName = $appDir . DIR_SEP . $actId;
	
	if(file_exists($fileName))
	 $res = unlink($fileName);
	else
	 $res= 'true';
	
	if($res)
	 return 'true';
	else
	 return 'false';
}
}

class AjaxOpGetPdfTemplates extends AjaxOp {
	function __construct() {
		parent::__construct ( AJAX_OP_GET_PDF_TEMPLATES );
	}
	function exec_1(string $actId):array|string|bool|null {
		session_start ();
		$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
		$appDir = $appName;
		$appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
		$files = scandir ( $appXmlDir );
		$pdfTemplates = array ();
		$i = 0;
		foreach ( $files as $ind => $file ) {
			$fileItems = explode ( FILE_NAME_ELEMENTS_SEP, $file );
			$fileItemsNum = count ( $fileItems );
			if (((! is_dir ( $file )) && ($fileItemsNum == 1))||
			((! is_dir($file))&&($fileItemsNum==2)&&($fileItems[1]==XML_SUFFIX))) {
				$interfaceItems = 
				Xml_interface_file_analyzer::getInterfaceItems ( $appXmlDir . DIR_SEP . $file );
				$fileItemsNum2 = count ( $interfaceItems );
				if ($fileItemsNum2 == 6)
					$interfaceType = $interfaceItems [3];
				elseif ($fileItemsNum2 == 5)
					$interfaceType = $interfaceItems [2];
				if (($interfaceType == Interfaces_info::INT_FPDF_TEMPLATE)&&
				($interfaceItems [0]!==STANDARD_MOD_PREFIX)) {	
					$pdfTemplatePageName = $interfaceItems [1];
					if ($pdfTemplatePageName == $actId)
						$pdfTemplates [$i++] = $file;
				}
			}
		}
		return $pdfTemplates;
	}
}

class AjaxOpDojoInPreview extends AjaxOp
{
function __construct()
{
parent::__construct(AJAX_OP_DOJO_IN_PREVIEW);
}

function exec_1(string $actId):array|string|bool|null
{
  session_start ();
	$appName1 = $_SESSION [SESSION_VAR_ACTIVE_APP];
  $appDir = $appName1;
  $appDir1 = PREVIOUS_DIR . DIR_SEP . $appName1 . DIR_SEP . INTERFACES_DIR;
  $appDir2 = PREVIOUS_DIR . DIR_SEP . $appName1 . DIR_SEP . XML_DIR;
	$codeDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . FW_DIR;
	
	$scope = $appName1 . STRING_BACKSLASH . FRAMEWORK_DIR;
	
	$fileName = $appName1 . Xml_interface_serializer::INTERFACE_NAME_SEP . 
	"preview" . Xml_interface_serializer::INTERFACE_NAME_SEP . "html_page" .
	Xml_interface_serializer::INTERFACE_NAME_SEP . 
	Xml_interface_serializer::INTERFACE_NAME_SEP . "0";
	
	$xmlIntSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$fileName);
  $xmlIntSerializer->setXmlDir($appDir2);
  $xmlIntSerializer->setInterfacesDir($appDir1);
	$xmlIntSerializer->setLoadInterfaceAsString ( true );
	$xmlIntSerializer->setDbStruct ( Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL));
	$xmlIntSerializer->setDbQueries ( Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL));
	$scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
	$xmlIntSerializer->setScope($scope);
	$xmlIntSerializer->setCodeDir($codeDir);
	$xmlIntSerializer->loadData ();
	
	$items = $xmlIntSerializer->getItems ();
	
	if ($items["dojoEnabled"]=="true")
	 return 'true';
	else
	 return 'false';
}
}

class AjaxOpDeleteRelationsDefs extends AjaxOp
{
 function __construct()
 {
  parent::__construct(AJAX_OP_DELETE_RELATIONS_DEFS);
 }
 
 function exec_1(string $actId):array|string|bool|null
 {
	session_start();
	//echo "XXXXXXXXXXXXXXXXX";
	$appName = $_SESSION [SESSION_VAR_ACTIVE_APP];
	$ids = explode ( STRING_SEMICOLON, $actId );
	//print_r($ids);
	return Xml_db_model::deleteRelationsDefs ( $appName, $ids );
 }
}

?>