<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_int_struct.fun.php");
require_once("struct.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("Cheope_ns_db_queries.def.php");
require_once("Cheope_ns_page.class.php");
require_once("Html_fragment.class.php");
require_once("Cheope_ns_frame.class.php");

define('DEFAULT_PAGE_NAME',"prova_53");
define('THIS_PAGE',PAGE_PROVA_53);

class Cheope_ns_prova_53_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum);
	$this->isASessionPage=true;
 }
 
  function putLinkTags():void
 {
 	parent::putLinkTags();
 	$htmlWriter = $this->getHtmlWriter();
  $htmlWriter->putLinkTag(STRING_NULL,CLIENT_DOJO_CSS_PATH . DIR_SEP . "dnd.css");
 }

 function putActiveApp():void
 {
 }
 
 // Metodo virtuale per l'output del codice di inclusione dei moduli javascript
 // esterni.
 function putClientScriptIncludeCode():void
 {
	 parent::putClientScriptIncludeCode();
 	 $htmlWriter = $this->getHtmlWriter();
 	 $htmlWriter->putGenericHtmlString("<script>" .
  "dojo.addOnLoad(function(){dojo.parser.parse();" .
  "dojo.subscribe(\"/dnd/source/over\",function(source){ " .
  "console.log(\"/dnd/source/over\",source);});" .
  "dojo.subscribe(\"/dnd/start\",function(source,nodes,copy){ " .
  "console.log(\"/dnd/start\",source,nodes,copy);});" .
  "dojo.subscribe(\"/dnd/drop\",function(source,nodes,copy){ " .
  "console.log(\"/dnd/drop\",source,nodes,copy);});" .
  "dojo.subscribe(\"/dnd/cancel\",function(){ " .
  "console.log(\"/dnd/cancel\");});" .
  "});</script>" . 
	"<script type=\"text/javascript\">dojo.require(\"dojo.dnd.Source\");" .
	"dojo.require(\"dojo.parser\");</script>");  
 }
 
  
 // Metodo virtuale contenente la specifica della logica di visualizzazione del body.
 //
 function putBody():void
 {	 
  global $dbStructTree;
  
	$interfacesContainer = $this->getInterfacesContainer();
  
  $interfaceFrame = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_FRAME,NUM_1); 

  //$interfaceScript1 = $interfacesContainer->getInterface(OBJ_NONE,
  //OP_NONE,INT_HTML_TAGS,NUM_3);
  //$interfaceScript1->putData();
  
  $interfaceFrame->putData();  
 }
}
