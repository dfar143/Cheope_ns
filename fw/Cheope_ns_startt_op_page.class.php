<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("http.const.php");
require_once("filesystem.fun.php");
require_once("javascript.fun.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"Startt");
define('THIS_PAGE',"startt.php");

class Cheope_ns_startt_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=0) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }
 
 function getPages():array
 {
 	$pages = array();
 	$pages[0]=array();
  $pages[1]=array();
  $pages[2]=array();
  $pages[3]=array();
  $pages[4]=array();
  $pages[5]=array();
  return $pages;
 }
 
 function getIds(array $actFiles):array
 {
 	$ids = array();
 	foreach($actFiles as $ind=>$file)
 	{
 	 $ids[$ind] = $file;
 	}
  return $ids;
 }
 
 function setForestCtrlDataSource(string $actAppDir,Cheope_ns_forest_ctrl $actIntForestCtrl):void
 {
 	 global $globalObjs;
 	  	 
   $files = scandir($actAppDir);
   $groupedFilesNames = groupFilesByCategories($files,$actAppDir);
   $num = count($globalObjs);
   $pages = $this->getPages();
   $groupedFilesIds = array();
   foreach($groupedFilesNames as $ind1=>$group)
   {
   	$groupedFilesIds[$ind1] = array();
   	foreach($group as $ind2=>$file)
   	{
   	 $groupedFilesIds[$ind1][$ind2] = $actAppDir . DIR_SEP . $file;
    }
   }
   $ids = $this->getIds($groupedFilesIds);
   $actIntForestCtrl->setGesPage(PAGE_ANALISI_MODULI);
   $actIntForestCtrl->setDataFieldDomainValueByPos(0,$groupedFilesNames);
   //echo $actIntForestCtrl->getType();
   //echo $actIntForestCtrl->getNum();
   //print_r($groupedFilesNames);
   $actIntForestCtrl->setDataFieldDomainValueByPos(1,$pages);
   $actIntForestCtrl->setDataFieldDomainValueByPos(2,$ids);
 }
 
 function setDbNameInSqlServerDefFile(string $actAppName):void
 {
 	$appFileName = PREVIOUS_DIR . DIR_SEP . $actAppName . DIR_SEP .  XML_DIR . 
   DIR_SEP . "sqlsrv_const" .  FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
  $xmlSerializer->loadData();
  $allItems = $xmlSerializer->getItems();
  $sectionsObj = $allItems[0];
  $sectionsArray = $sectionsObj->getItem();
  $sectionObj = $sectionsArray[0];
  $defsArray = $sectionObj->getItem();
  $defObj = $defsArray[3];
  $functionCallArray = $defObj->getItem();
  $functionCallObj = $functionCallArray[0];
  $argsArray = $functionCallObj->getItem();
  $argObj = $argsArray[1];
  $stringObj = $argObj->getItem();
  $stringObj->setItem($actAppName);
  $sectionsObj->setItem($sectionsArray);
  $allItems[0] = $sectionsObj;
  $xmlSerializer->setItems($allItems);
  $xmlSerializer->loadItems();
  $xmlSerializer->saveData();   	
 }
 
 function dumpDbConst(string $actAppName):void
 {
 	$appFileName = PREVIOUS_DIR . DIR_SEP . $actAppName . DIR_SEP .  XML_DIR . 
   DIR_SEP . "db_const" .  FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
  $xmlSerializer->setAppDir(PREVIOUS_DIR . DIR_SEP . $actAppName . DIR_SEP .  XML_DIR);
  $xmlSerializer->loadData();
  $items = $xmlSerializer->getItems();
  $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$items[0]);
 	$appFileName = PREVIOUS_DIR . DIR_SEP . $actAppName . DIR_SEP .  FRAMEWORK_DIR . 
   DIR_SEP . "db.const" .  FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
  $fileDumper->setFileName($appFileName);
  $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
  $fileDumper->dump();
 }
 
 function execActionProc(Interfaces_container $actInterfaces,string $actAppDir):void
 {
 	$htmlWriter = $this->getHtmlWriter();
  if (! is_dir($actAppDir))
  {
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];	
   if (make_dir($actAppDir))
    if (! createApplicationSkeleton($actAppDir,$appName))
     putScriptMsg(MSG_2,TEMP_MSG_DELAY);
    else
     putScriptMsg(MSG_3,TEMP_MSG_DELAY);
    else
     putScriptMsg(MSG_1,TEMP_MSG_DELAY);
   
   $appDirItems = explode(DIR_SEP,$actAppDir);
   $appName = $appDirItems[count($appDirItems)-1];
   $words = array();
   $words[0] = APPLICATION_NAME;
   $words[1] = strToLower(STANDARD_MOD_PREFIX);
   $words[2] = STANDARD_MOD_PREFIX;
   $words[3] = strToUpper(STANDARD_MOD_PREFIX);
   $words[4] = strToLower(APPLICATION_NAME);
   $appNames[0] = ucFirst($appName);
   $appNames[1] = strToLower($appName);
   $appNames[2] = ucFirst($appName);
   $appNames[3] = strToUpper($appName);
   $appNames[4] = strToLower($appName);
   $newAppDir = $actAppDir . DIR_SEP . FW_DIR;
   $newAppDir1 = $actAppDir . DIR_SEP . XML_DIR;
   $newAppDir2 = $actAppDir . DIR_SEP . INTERFACES_DIR;
   $newAppDir3 = $actAppDir . DIR_SEP . FPDF_DIR;
   $newAppDir4 = $actAppDir;
//   $newAppDir3 = $actAppDir . DIR_SEP . FPDF_DIR;

   //
   // Aggiusta file di gestione default db
   //
   if(file_exists($newAppDir . DIR_SEP . 
   STD_DB_OP_FUN_MOD))
   rename($newAppDir . DIR_SEP . 
   STD_DB_OP_FUN_MOD,$newAppDir . DIR_SEP .
   DB_OP_FUN_MOD);
   
   if(file_exists($newAppDir . DIR_SEP . 
   STD_SQLSRV_DB_OP_FUN_MOD))
   rename($newAppDir . DIR_SEP . 
   STD_SQLSRV_DB_OP_FUN_MOD,$newAppDir . DIR_SEP .
   SQLSRV_DB_OP_FUN_MOD);
   
   if(file_exists($newAppDir . DIR_SEP . 
   STD_ODBC_DB_OP_FUN_MOD))
   rename($newAppDir . DIR_SEP . 
   STD_ODBC_DB_OP_FUN_MOD,$newAppDir . DIR_SEP .
   ODBC_DB_OP_FUN_MOD);  
 
   if (! replace_words_in_file_name_of_dir($newAppDir,$words,$appNames))
    putScriptMsg(MSG_4,TEMP_MSG_DELAY);
    
   if (! replace_words_in_files_of_dir($newAppDir,$words,$appNames))
    putScriptMsg(MSG_5,TEMP_MSG_DELAY);
    
   if (! replace_words_in_file_name_of_dir($newAppDir1,$words,$appNames))
    putScriptMsg(MSG_4,TEMP_MSG_DELAY);
   if (! replace_words_in_files_of_dir($newAppDir1,$words,$appNames))
    putScriptMsg(MSG_5,TEMP_MSG_DELAY);
   
   $words1[0] = APPLICATION_NAME;
   //$words[1] = strToLower(STANDARD_MOD_PREFIX);
   //$words[2] = STANDARD_MOD_PREFIX;
   //$words[3] = strToUpper(STANDARD_MOD_PREFIX);
   $words1[1] = strToLower(APPLICATION_NAME);
   $appNames1[0] = ucFirst($appName);
   //$appNames[1] = strToLower($appName);
   //$appNames[2] = ucFirst($appName);
   //$appNames[3] = strToUpper($appName);
   $appNames1[1] = strToLower($appName);   
   
   if (! replace_words_in_files_of_dir($newAppDir3,$words1,$appNames1))
    putScriptMsg(MSG_5,TEMP_MSG_DELAY);  

   if (! replace_words_in_files_of_dir($actAppDir,$words1,$appNames1))
	putScriptMsg(MSG_66,TEMP_MSG_DELAY);
    
   if (! replace_words_in_files_of_dir($newAppDir4,$words,$appNames))
    putScriptMsg(MSG_5,TEMP_MSG_DELAY);   

   $this->setDbNameInSqlServerDefFile($appName);
   $this->dumpDbConst($appName);

   $itemsSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,"ajax_handler_def.xml");
   $itemsSerializer1->setDir($newAppDir1);
   $itemsSerializer1->setAppDir($newAppDir1);
   $itemsSerializer1->loadData();
   $allItems = $itemsSerializer1->getItems();
   $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
   $fileDumper->setFileName($actAppDir . DIR_SEP . "ajax_handler.php");
   $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
   $fileDumper->dump();
   
   rename($newAppDir2 . DIR_SEP . "Std!preview!html_page!!0",
   $newAppDir2 . DIR_SEP . $appName . "!preview!html_page!!0");    
 
   rename($newAppDir . DIR_SEP . "Model_jpgraphs.class.php",
   $newAppDir . DIR_SEP . "Jpgraph.class.php");
      
   rename($actAppDir . DIR_SEP . strToLower(APPLICATION_NAME) . VAR_SEP . 'prova.mdb',
   $actAppDir . DIR_SEP . "prova.mdb");
      
   if(! array_replace_in_file_content($newAppDir . 
   DIR_SEP . "Jpgraph.class.php",$words,$appNames))
    putScriptMsg(MSG_5,TEMP_MSG_DELAY);
    
  }
  $intForestCtrl = $actInterfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_NLEVELS_FOREST_CTRL,NUM_1); 
  $this->setForestCtrlDataSource($actAppDir,$intForestCtrl); 
 }
 
 function putActiveApp():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  $htmlWriter->putSpanOpenTag("active_application_label_id","static_text");
  $htmlWriter->putGenericHtmlString(LABEL_APPLICAZIONE_ATTIVA . STRING_COLON . ENTITY_SPACE);
	$htmlWriter->putGenericHtmlString(SPAN_CLOSE_TAG);
 	$appDir = STRING_NULL;
 	if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]))
 	{
 	 if(isset($_POST[FIELD_NOME_APPLICAZIONE]))
 	  $appDir = $_POST[FIELD_NOME_APPLICAZIONE];
 	 else
 	  $appDir = $_SESSION[SESSION_VAR_ACTIVE_APP];
 	 $htmlWriter->putHrefOpenTag("active_application_id",STRING_NULL,"active_app",STRING_CANCELLETTO);
 	 $htmlWriter->putGenericHtmlString(ENTITY_SPACE . $appDir);
 	 $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
   $appls = getApplicazioni_ns(PREVIOUS_DIR . DIR_SEP);
   $menuItems=STRING_NULL;
   foreach($appls as $file=>$ind)
   {
   	if(($file != STRING_NULL)&&($file != $appDir))
   	 $menuItems .= "<div dojoType=\"dijit.MenuItem\">" . 
   	 $file . "<script type=\"dojo/method\" event=\"onClick\" args=\"evt\">" .
   	 "ajaxHandler.synServerCall('" . AJAX_HANDLER_PAGE . "','setSessionActiveApp','" . 
   	 $file . "','text');window.location='" . THIS_DIR . DIR_SEP . 
   	 THIS_PAGE . "';</script></div>";
   }
   $htmlWriter->put("<div dojoType=\"dijit.Menu\" targetNodeIds=\"active_application_id\" style=\"display:none\" >" .
      $menuItems . "</div>"); 
  }
 }
 
 function putLinkTags():void
 {
 	parent::putLinkTags();
  putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
 }
 
 function putClientScriptIncludeCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
  $interfaces = $this->getInterfacesContainer();  
 	if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]))
 	{
   if(isset($_POST[FIELD_NOME_APPLICAZIONE]))
   {
   	$_SESSION[SESSION_VAR_ACTIVE_APP] = $_POST[FIELD_NOME_APPLICAZIONE];
  	$appDir = PREVIOUS_DIR . DIR_SEP . $_SESSION[SESSION_VAR_ACTIVE_APP];
  	unset($_SESSION[SESSION_VAR_DIR]);
  	$this->execActionProc($interfaces,$appDir);
   }
   elseif((isset($_GET['command'])) && ($_GET['command']=='changeDir') 
   && ($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
   {
    $appDir = PREVIOUS_DIR . DIR_SEP . $_SESSION[SESSION_VAR_ACTIVE_APP] . 
    DIR_SEP . $_GET['dir'];
    $_SESSION[SESSION_VAR_DIR] = $_GET['dir'];
    $interfaceHtmlDataTemplate1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,
    Interfaces_info::INT_HTML_DATA_TEMPLATE,NUM_1);
    switch($_GET['dir'])
    {
    case FRAMEWORK_DIR:
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_1,"checked");
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_2,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_3,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_4,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_5,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_6,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_7,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_8,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_9,STRING_NULL);
     break;
    case JAVASCRIPT_DIR:
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_1,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_2,"checked");
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_3,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_4,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_5,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_6,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_7,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_8,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_9,STRING_NULL);
     break;
    case CSS_DIR:
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_1,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_2,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_3,"checked");
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_4,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_5,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_6,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_7,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_8,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_9,STRING_NULL);
     break;
    case IMAGES_DIR:
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_1,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_2,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_3,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_4,"checked");
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_5,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_6,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_7,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_8,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_9,STRING_NULL);
     break;
    case XML_DIR:
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_1,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_2,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_3,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_4,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_5,"checked");
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_6,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_7,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_8,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_9,STRING_NULL);
     break;
    case JSON_DIR:
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_1,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_2,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_3,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_4,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_5,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_6,"checked");
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_7,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_8,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_9,STRING_NULL);
     break;
    case CSV_DIR:
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_1,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_2,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_3,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_4,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_5,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_6,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_7,"checked");
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_8,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_9,STRING_NULL);
     break;
    case INTERFACES_DIR:
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_1,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_2,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_3,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_4,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_5,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_6,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_7,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_8,"checked");
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_9,STRING_NULL);
     break;
    case AJAXOPS_DIR:
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_1,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_2,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_3,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_4,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_5,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_6,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_7,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_8,STRING_NULL);
     $interfaceHtmlDataTemplate1->setDataFieldDomainValueByName(FIELD_CHECKED_9,"checked");
     break;
   }
   $this->execActionProc($interfaces,$appDir); 
   }
   else
   {
  	$appDir = PREVIOUS_DIR . DIR_SEP . $_SESSION[SESSION_VAR_ACTIVE_APP];
  	unset($_SESSION[SESSION_VAR_DIR]);
  	$this->execActionProc($interfaces,$appDir);
   }
  }
  parent::putClientScriptIncludeCode();
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>"); 
  $htmlWriter->putGenericHtmlString("<script>" .
	"dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>");
 }
 
 function putBody():void
 {
 	$interfaces = $this->getInterfacesContainer();
 	if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]))
 	{
	$intHtmlCheck1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_0);
	$appDir = APPLICATION_NAME;
	$logFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
    DIR_SEP . XML_DIR . DIR_SEP . LOG_FILE . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
	//echo getcwd();
	//echo PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP;
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
   $stringVal = $stringObj1->getItem();
   if($stringVal=="true")
	$stringVal = 1;
   else
	$stringVal = 0;
   $intHtmlCheck1->setDataFieldsDomainsValues(array($stringVal));
   //
   //echo "WWWWWWWW";   
	//print_r($intHtmlCheck);
  $appls = getApplicazioni_ns(PREVIOUS_DIR . DIR_SEP);
  $intForm1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_FORM_2,NUM_1);
  $intForm1->setDataFieldDomainValueByName(FIELD_APPLICAZIONI,$appls);
  $int_iter = $interfaces->create();
  $int = $int_iter->last();
  $int->putData(); 
  }
  else
  {
	 $int = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_TEMP_MSG,NUM_0);
   $int->putData();
  }
 }
}
?>