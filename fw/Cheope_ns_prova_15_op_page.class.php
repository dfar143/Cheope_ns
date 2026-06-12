<?
namespace Cheope_ns\fw;
require_once("cheope_ns.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("struct.fun.php");
require_once("Html_div_tag.class.php");
require_once("Cheope_ns_frame.class.php");
require_once("Cheope_ns_page.class.php");
require_once("Cheope_ns_NLevels_tree_ctrl.class.php");
require_once("Cheope_ns_NLevels_forest_ctrl.class.php");

define('DEFAULT_PAGE_NAME',"prova_15");
define('THIS_PAGE',PAGE_PROVA_15);

class Cheope_ns_prova_15_op_page extends Cheope_ns_page
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
 }
 
  
 // Metodo virtuale contenente la specifica della logica di visualizzazione del body.
 //
 function putBody():void
 {	 
  global $dbStructTree;
  
	$interfacesContainer = $this->getInterfacesContainer();

 	$intNLevelsTreeCtrl1 = $interfacesContainer->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_NLEVELS_TREE_CTRL,NUM_1);
 	$xmlNode = Html_data_interface::createXmlNode($intNLevelsTreeCtrl1,STRING_NULL); 

 	$intNLevelsTreeCtrl1->setObj($xmlNode);
  
  $interfaceDiv = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_0);  
 /* $dataSource1 = array(array("pageA"=>array("pageA1"=>array("pageA2"=>"pageA2")),
 "pageB"=>array("pageB1"=>array("pageB2"=>"pageB2")),
 "pageC"=>array("pageC1"=>array("pageC2"=>"pageC2")),
 "pageD"=>array()),
 array("labelA"=>array("labelA1"=>array("labelA2"=>"labelA2")),
 "labelB"=>array("labelB1"=>array("labelB2"=>"labelB2")),
 "labelC"=>array("labelC1"=>array("labelC2"=>"labelC2")),
 "labelD"=>array()),
 array("ida"=>array("ida1"=>array("ida2"=>"ida2")),
 "idb"=>array("idb1"=>array("idb2"=>"idb2")),
 "idc"=>array("idc1"=>array("idc2"=>"idc2")),
 "idd"=>array()));
 
 /*$dataSource2 = Array ("Data_1" => Array 
 ( "PageA" => Array ( "PageA1" => "PageA1" ), 
   "PageB" => Array ( "PageB1" => "PageB1" ), 
   "PageC" => Array ( "PageC1" => array("PageD2","PageD3")) ) 
                       ,"Data_2" => Array 
  ( "LabelA" => Array ( "LabelA1" => "LabelA1" ), 
  "LabelB" => Array ( "LabelB1" => "LabelB1" ), 
  "LabelC" => Array ( "LabelC1" => array("LabelD2","LabelD3")) )  
                       ,"Data_3" => Array 
  ( "IdA" => Array ( "IdA1" => "IdA1"), 
  "IdB" => Array ( "IdB1" => "IdB1" ), 
  "IdC" => Array ( "IdAC1" => array("IdD2","IdD3"))));*
  
  
 	$intNLevelsTreeCtrl1 = &$interfacesContainer->getInterface(OBJ_NONE,OP_NONE,INT_NLEVELS_TREE_CTRL,NUM_1);
  $intNLevelsTreeCtrl1->setDataSource($dataSource1);*/
  
  $interfaceDiv->putData();  
 }
}
