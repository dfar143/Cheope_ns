<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_accordion.class.php");
 
 $sbg = new Cheope_ns_fpdf_img(OP_NONE,NUM_0);
 $sbg->serialize();
 $xmlIntSerializer = $sbg->getSerializer();
 $xmlIntSerializer->setFileName('prova_fpdf_img_serialize');
 $xmlIntSerializer->saveData();
?>