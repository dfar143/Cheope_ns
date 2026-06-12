<?
namespace Cheope_ns\fw;
require_once ("Cheope_ns_page.class.php");
require_once ("cheope_ns_db_struct.def.php");
require_once ("cheope_ns_db_queries.def.php");
require_once ("http.const.php");
require_once ("filesystem.fun.php");
require_once ("javascript.fun.php");
require_once ("struct.fun.php");

date_default_timezone_set ( "Europe/Rome" );
define ( 'DEFAULT_PAGE_NAME', "manage_interface_container" );
define ( 'THIS_PAGE', "manage_interface_container.php" );
define ( 'INTERFACE_NAME_SEP', Xml_interface_serializer::INTERFACE_NAME_SEP );
class Cheope_ns_manage_interface_container_op_page extends Cheope_ns_page {
	function __construct($actNum = 0) {
		parent::__construct ( DEFAULT_PAGE_NAME, OP_NONE, $actNum=0 );
		$this->isASessionPage = true;
	}
	function putLinkTags():void {
		$htmlWriter = $this->getHtmlWriter ();
		parent::putLinkTags ();
		putLinkTag ( STRING_NULL, CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . DIR_SEP . "nihilo" . STYLE_SHEET_FILE_POSTFIX );
		putLinkTag ( STRING_NULL, CLIENT_STYLE_SHEET_PATH . DIR_SEP . DEFAULT_PAGE_NAME . STYLE_SHEET_FILE_POSTFIX );
	}
	function putClientScriptIncludeCode():void {
		$htmlWriter = $this->getHtmlWriter ();
		$interfaces = $this->getInterfacesContainer ();
		if (! isset ( $_SESSION [SESSION_VAR_ACTIVE_APP] ) || (isset ( $_SESSION [SESSION_VAR_ACTIVE_APP] ) && ($_SESSION [SESSION_VAR_ACTIVE_APP] == STRING_NULL)) || ((! isset ( $_GET ["Interfaccia"] )) && (! isset ( $_GET ["Contenuto"] )))) {
			$interfaces->deleteByStringInType ( "javascript" );
		} elseif ((isset ( $_GET ["Contenuto"] )) && (isset ( $_GET ["Interfaccia"] )) && (isset ( $_GET ["ContainerName"] ))) {
			$intName = $_GET ["Interfaccia"];
			$contenuto = $_GET ["Contenuto"];
			$containerName = $_GET ["ContainerName"];
			$intDataTemp1 = $interfaces->getInterface ( OBJ_NONE, "manageOp2", Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE, NUM_1 );
			$intDataTemp1->setAjaxOpPar ( $intName );
			$intDataTemp2 = $interfaces->getInterface ( OBJ_NONE, "getContainer", Interfaces_info::INT_JAVASCRIPT_DATA_FRAGMENT, NUM_1 );
			$intDataTemp3 = $interfaces->getInterface ( OBJ_NONE, "setInterfaces", Interfaces_info::INT_JAVASCRIPT_DATA_FRAGMENT, NUM_1 );
			$intDataTemp3->setDataFieldDomainValueByName ( FIELD_INTERFACCE, $contenuto );
			$intDataTemp2->setDataFieldDomainValueByName ( FIELD_INTERFACCIA, $intName );
			$intDataTemp2->setDataFieldDomainValueByName ( FIELD_CONTAINER_NAME, $containerName );
		}
		parent::putClientScriptIncludeCode ();
		if (isset ( $_SESSION [SESSION_VAR_ACTIVE_APP] ) && isset ( $_GET ["Interfaccia"] ) && isset ( $_GET ["Contenuto"] )) {
			putGenericHtmlString ( "<script>dojo.require(\"dojo.parser\")</script>" );
			putGenericHtmlString ( "<script>dojo.require(\"dijit.layout.BorderContainer\")</script>" );
			putGenericHtmlString ( "<script>dojo.require(\"dijit.layout.StackContainer\")</script>" );
			putGenericHtmlString ( "<script>dojo.require(\"dijit.layout.ContentPane\")</script>" );
			putGenericHtmlString ( "<script>dojo.require(\"dojo.dnd.Source\");</script>" );
			putGenericHtmlString ( "<script>dojo.require(\"dijit.Menu\")</script>" );
			$htmlWriter->putGenericHtmlString ( "<script>" . "dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>" );
		}
	}
	function putActiveApp():void {
	}
	function putBody():void {
		$interfaces = $this->getInterfacesContainer ();
		
		if (isset ( $_SESSION [SESSION_VAR_ACTIVE_APP] ) && $_SESSION [SESSION_VAR_ACTIVE_APP] != STRING_NULL) {
			$int_iter = $interfaces->create ();
			$int = $int_iter->last ();
			$int->putData ();
		} else {
			$int = $interfaces->getInterface ( OBJ_NONE, OP_NONE, Interfaces_info::INT_TEMP_MSG, NUM_0 );
			$int->putData ();
		}
	}
}
?>