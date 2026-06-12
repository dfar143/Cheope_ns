<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_form.class.php");
require_once(FRAMEWORK_PATH . "Html_data_file_template.class.php");
require_once(FRAMEWORK_PATH . "cheope_ns_db_struct.def.php");

$interfaceForm1 = new Cheope_ns_form($dbObjProva,OP_INSERIMENTO,NUM_1);
$interfaceForm1->setDataFields(array(FIELD_DATA_1,FIELD_DATA_2));
$fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC);
$interfaceForm1->setDataFieldsDomains($fieldsDomains);
$fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE );
$interfaceForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
$accessFields = array(ACCESS_OBB,ACCESS_OPT);
$interfaceForm1->setDataFieldsAccess($accessFields);
$interfaceForm1->setGesPage("");
$interfaceForm1->setCssClass(CSS_FORM);
 
$htmlDataFileTemplate1 = new Html_data_file_template(OBJ_NONE,OP_NONE,NUM_1);
$htmlDataFileTemplate1->setFileName("prova_43_template.html");
$htmlDataFileTemplate1->setDataFields(array(FIELD_OBJ_1,FIELD_DATA_2));
$fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC_STATIC);
$htmlDataFileTemplate1->setDataFieldsDomains($fieldsDomains);
$fieldsDomainsValues = array($interfaceForm1,"prova_43_template");
$htmlDataFileTemplate1->setDataFieldsDomainsValues($fieldsDomainsValues);
$htmlDataFileTemplate1->putData();
?>