<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_int_struct.fun.php");
require_once("struct.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("Cheope_ns_db_queries.def.php");
require_once("Cheope_ns_page.class.php");
require_once("Html_input_ctrl.class.php");
require_once("Cheope_ns_simple_table.class.php");
require_once("Html_data_template.class.php");
require_once("Html_div_tag.class.php");
require_once("Html_button_tag.class.php");
require_once("Html_input_tag.class.php");
require_once("Html_form_tag.class.php");
require_once("Cheope_ns_frame.class.php");
require_once("Html_fieldset_decorator.class.php");
require_once("Sqlsrv_db_op.class.php");


define('DEFAULT_PAGE_NAME',"prova_65");
define('THIS_PAGE',PAGE_PROVA_65);

class Cheope_ns_prova_65_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum);
	$this->isASessionPage=true;
 }

 function putActiveApp():void
 {
 }
 
 // Metodo virtuale per l'output del codice di inclusione dei moduli javascript
 // esterni.
 function putClientScriptIncludeCode():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  parent::putClientScriptIncludeCode();
  $htmlWriter->putScriptIncludeTag("./js/formValidator.js");
  /*$htmlWriter->putScriptOpenTag();
  $htmlWriter->putGenericHtmlString("$('#simple_table__1').dataTable({\"aaSorting\":[[0,'asc']]});");*/
  $this->setBodyOnLoad("$('#simple_table__1').dataTable().fnSort([[0,'desc']]);"); 
  //."$('#simple_table__1').dataTable({'aoColumnsDef':[{'bSortable':false,'aTargets':[1]}]});");
  /*$htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);*/
 }
 
 // Metodo virtuale contenente la specifica della logica di visualizzazione del body.
 //
 function putBody():void
 {	 
  global $dbStructTree;
  
	$interfacesContainer = $this->getInterfacesContainer();
  $data = array();
  $dbOpClass = new Sqlsrv_db_op("sa","userroot","LO0508953DW7\SQLEXPRESS","Cheope");
  if(isset($_POST[PAR1]))
  {
  	$num = (int)((count($_POST)-1) / 4);
  	for($i=0;$i<=$num-1;$i++)
  	{
  		$data[$i][FIELD_ID_PROVA] = $_POST["html_input_ctrl__" . (string)$i . "_0_Temp_1_Id_prova"];
  		$data[$i][FIELD_DATA_1] = $_POST["html_input_ctrl__" . (string)$i . "_Data_1"];
  		$data[$i][FIELD_DATA_2] = $_POST["html_input_ctrl__" . (string)$i . "_Data_2"];
  		$data[$i][FIELD_ID_PROVA_2] = (int)$_POST["html_input_ctrl__" . (string)$i . "_Id_prova_2"];
  	}
  	$dbOpClass->updateDbRow(TABELLA_PROVA,FIELD_ID_PROVA,$data[0]);
  }
  
  $interfaceFrame = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_FRAME,NUM_1);  
  $intSimpleTable = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_SIMPLE_TABLE,NUM_1); 
  
  $objs=$dbStructTree->getElementsByName(TABELLA_PROVA);
  $obj=$objs[0];
  
  $iter = $dbStructTree->create();
  if(! $iter->gotoNext(1))
   echo "FALSE";
  $obj1 = $iter->current();
  echo $obj1->getName();
  
  $inputCtrl3 = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_3);
  $intSimpleTable->setObj($obj);  
  $intSimpleTable->setDataFieldDomainByName(FIELD_ID_PROVA_2,Int_domain::FIELD_DOMAIN_OBJ);
  $intSimpleTable->setDataFieldDomainValueByName(FIELD_ID_PROVA_2,$inputCtrl3);
  $interfaceFrame->putData();  
 }
}
