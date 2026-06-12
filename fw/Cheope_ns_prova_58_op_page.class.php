<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_int_struct.fun.php");
require_once("struct.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("Cheope_ns_db_queries.def.php");
require_once("Cheope_ns_page.class.php");
require_once("Html_fragment.class.php");
require_once("Cheope_ns_frame.class.php");

define('DEFAULT_PAGE_NAME',"prova_58");
define('THIS_PAGE',PAGE_PROVA_58);

class Cheope_ns_prova_58_op_page extends Cheope_ns_page
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
  "dojo.addOnLoad(function(){" .
  "var box=dojo.byId(\"box\");" .
  "dojo.connect(box,\"onclick\",function(evt){" .
  "var easing=function(x){return x;};" .
  "var a1=dojo.fx.slideTo({" .
  "node:box,easing:easing,duration:1000,top:\"150\",left:\"300\"});" .
  "var a2=dojo.fx.slideTo({" .
  "node:box,easing:easing,duration:400,top:\"20\",left:\"350\"});" .
  "var a3=dojo.fx.slideTo({" .
  "node:box,easing:easing,duration:800,top:\"350\",left:\"400\"});" .
  "dojo.fx.chain([a1,a2,a3]).play();});" .
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
