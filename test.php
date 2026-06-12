<?
namespace 
  			Cheope_ns\fw;
require_once("root.def.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_Test_op_page.class.php");
$interfacesContainer=new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
$serializer=new Xml_interface_serializer();
$serializer->setInterpolateConsts(true);
$serializer->setInterfacesContainer($interfacesContainer);
$serializer->setDbStruct($dbStructTree);
$serializer->setDbQueries($dbQueriesContainer);
$dbNode=null;
$decoratedObj=null;
$interface=new Html_div_tag(OP_NONE,NUM_0);
$interface->setNum(NUM_0);
$interface->setShortName("");
$interface->setSerializer($serializer);
$serializer->setXmlDir("./xml/");
$serializer->setInterfacesDir("./interfaces/");
$serializer->setPageName(DEFAULT_PAGE_NAME);
$interface->serializer_loadData("Cheope_ns");
$interface->unserialize();
$page=new Cheope_ns_Test_op_page();
$page->setSerializer($serializer);
$page->serializer_loadData("Cheope_ns");
$page->unserialize();
$interfacesContainer=$serializer->getInterfacesContainer();
$interfacesContainer->add($interface);
$page->setInterfacesContainer($interfacesContainer);
$page->setCREnabled(false);
$page->setDojoEnabled(false);
$page->setJQueryEnabled(false);
$ajaxOps=array();
$page->setAjaxOps($ajaxOps);
$page->putData();
?>