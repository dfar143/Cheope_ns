<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_int_struct.fun.php");
require_once("struct.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("Cheope_ns_db_queries.def.php");
require_once("Cheope_ns_page.class.php");
require_once("Html_div_tag.class.php");
require_once("Html_textarea_tag.class.php");
require_once("Cheope_ns_frame.class.php");

define('DEFAULT_PAGE_NAME',"prova_51");
define('THIS_PAGE',PAGE_PROVA_51);

class Cheope_ns_prova_51_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum);
	$this->isASessionPage=true;
 }
 
  function putLinkTags():void
 {
 	parent::putLinkTags();
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
   $htmlWriter->putGenericHtmlString(".note{" . 
   "background:#FFFFBF;border-bottom:1px solid black;border-left:1px solid black;" .
   "border-right:1px solid black;width:302px;height:300px;margin:0px;padding:0px;}");
   $htmlWriter->putGenericHtmlString(".noteHandle{" . 
   "background:#FFFF8F;border-bottom:1px solid black;border-left:1px solid black;" .
   "border-right:1px solid black;border-top:1px solid black;cursor:pointer;" .
   "width:300px;height:10px;margin:0px;padding:0px;}");
//  $htmlWriter->putGenericHtmlString(".moveable{" . 
//   "background:#FFFFBF;border:1px solid black;width:100px;height:100px;cursor:pointer;}");
   $htmlWriter->putGenericHtmlString(".movingNote{" . 
   "background:#FFFF3F;}");
   $htmlWriter->putGenericHtmlString(".parent{" . 
   "background:#BFECFF;border:10px solid lightblue;width:400px;height:700px;padding:20px;margin:10px;}");
   $htmlWriter->putGenericHtmlString("#note1,#note2{" . 
   "width:302px;}");
   $htmlWriter->putGenericHtmlString("</style>"); 
	 $htmlWriter->putGenericHtmlString("<script type=\"text/javascript\">dojo.require(\"dojo.dnd.Moveable\");" .
	 "dojo.require(\"dojo.dnd.move\");" .
	 "dojo.addOnLoad(function(){" . 
   "new dojo.dnd.move.parentConstrainedMoveable(\"note1\",{" .
   "handle:\"dragHandle1\",area:\"margin\",within:true});" .
   "new dojo.dnd.move.parentConstrainedMoveable(\"note2\",{" .
   "handle:\"dragHandle2\",area:\"padding\",within:true});" .
	 "});" .	 
	 "</script>");
	
 	 //$htmlWriter->putGenericHtmlString("<script>" .
	//"dojo.addOnLoad(function(){dojo.parser.parse();});</script>");  
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
