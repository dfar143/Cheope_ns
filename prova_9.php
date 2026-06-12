<?
namespace 
  			Cheope_ns\fw;
require_once("root.def.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_Prova_9_op_page.class.php");
$interfacesContainer=new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
$serializer=new Xml_interface_serializer();
$serializer->setInterpolateConsts(true);
$serializer->setInterfacesContainer($interfacesContainer);
$serializer->setDbStruct($dbStructTree);
$serializer->setDbQueries($dbQueriesContainer);
$dbNode=null;
$decoratedObj=null;
$interface=new Cheope_ns_frame(OP_NONE,NUM_1);
$interface->setNum(NUM_1);
$interface->setShortName("");
$interface->setSerializer($serializer);
$serializer->setXmlDir("./xml/");
$serializer->setInterfacesDir("./interfaces/");
$serializer->setPageName(DEFAULT_PAGE_NAME);
$interface->serializer_loadData("Cheope_ns");
$interface->unserialize();
$page=new Cheope_ns_Prova_9_op_page();
$page->setSerializer($serializer);
$page->serializer_loadData("Cheope_ns");
$page->unserialize();
$interfacesContainer=$serializer->getInterfacesContainer();
$interfacesContainer->add($interface);
$page->setInterfacesContainer($interfacesContainer);
$page->setCREnabled(false);
$page->setDojoEnabled(true);
$page->setJQueryEnabled(true);
$ajaxOps=array();
$page->setAjaxOps($ajaxOps);
$page->putData();
?>