<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_int_struct.fun.php");
require_once("struct.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("Cheope_ns_db_queries.def.php");
require_once("Cheope_ns_page.class.php");
require_once("Html_fragment.class.php");
require_once("Cheope_ns_frame.class.php");

define('DEFAULT_PAGE_NAME',"prova_61");
define('THIS_PAGE',PAGE_PROVA_61);

class Cheope_ns_prova_61_op_page extends Cheope_ns_page
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
 	 $htmlWriter->putGenericHtmlString("<style type=\"text/css\">");
   $htmlWriter->putGenericHtmlString(".box{" . 
   "width:200px;height:200px;text-align:center;float:left;position:absolute:margin:5px;}");
   $htmlWriter->putGenericHtmlString("</style>"); 
 	 $htmlWriter->putGenericHtmlString("<script>" .
 	"dojo.require(\"dojo.fx\");" .
 	"dojo.require(\"dojo.dnd.move\");" .
  "dojo.addOnLoad(function(){" .
  "var move = new dojo.dnd.Moveable(dojo.byId(\"ball\"));" .
  "var coords;" .
  "dojo.subscribe(\"/dnd/move/start\",function(e){" .
  "coords = dojo.coords(e.node);" .
  "});" .  
  "dojo.subscribe(\"/dnd/move/stop\",function(e){" .
  "dojo.fx.slideTo({" .
  "node:e.node,top:coords.t,left:coords.l,duration:1200," .
  "easing:function(x){return Math.pow(x,5);}}).play();})" .
  "});</script>");  
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
