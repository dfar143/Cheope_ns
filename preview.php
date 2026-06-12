<?
namespace 
  			Cheope_ns\fw;
require("root.def.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_preview_op_page.class.php");
$InterfacesContainer=new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
$serializer=new Xml_interface_serializer();
$serializer->setInterpolateConsts(true);
$serializer->setInterfacesContainer($InterfacesContainer);
$serializer->setDbStruct($dbStructTree);
$serializer->setDbQueries($dbQueriesContainer);
$dbNode=null;
$interface=new Cheope_ns_barGradex(OBJ_NONE,OP_NONE,NUM_0);
$interface->setNum(NUM_0);
$interface->setShortName("");
$interface->setSerializer($serializer);
$serializer->setXmlDir("./xml/");
$serializer->setInterfacesDir("./interfaces/");
$serializer->setPageName("");
$interface->serializer_loadData("Cheope_ns");
$interface->unserialize();
$page=new Cheope_ns_preview_op_page();
$serializer->setPageName("preview");
$page->setSerializer($serializer);
$page->serializer_loadData("Cheope_ns");
$page->unserialize();
$page->setCssExtModule("cheope_ns");
$page->setJsExtModule("cheope_ns");
$InterfacesContainer=$serializer->getInterfacesContainer();
$InterfacesContainer->add($interface);
$page->setInterfacesContainer($InterfacesContainer);
$page->setCREnabled(true);
$page->putData();
?>