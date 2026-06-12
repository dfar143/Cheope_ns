<?php
require_once("./fw/Std_accordion.class.php");

class HtmlDataInterfaceConstructorSetAndGetArgsTest extends PHPUnit_Framework_TestCase
{
    public function testSetGetObjNone()
    {
     $obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
     $dataObj = $obj->getObj();
     $this->assertEquals($dataObj,OBJ_NONE);
    }
    
    public function testSetGetDbNodeDataObj()
    {
     $dbNode = new Db_node("Node_test");
     $obj = new Std_accordion($dbNode,OP_NONE,NUM_0);
     $dataObj = $obj->getObj();
     $this->assertEquals($dataObj,$dbNode);
    }
    
    public function testSetGetDbQueryDataObj()
    {
     $dbStructTree = new Db_nodes_container();
     $dbQuery = new Db_query("Node_test",$dbStructTree);
     $obj = new Std_accordion($dbQuery,OP_NONE,NUM_0);
     $dataObj = $obj->getObj();
     $this->assertEquals($dataObj,$dbQuery);
    }
    
    public function testSetGetXmlSerializableDataObj()
    {
     $serializer = new Xml_serializer(STRING_NULL);
     $xmlNode = new Xml_node($serializer);
     $xmlNode->setNodeName("Test_xml_node_1");
     $obj = new Std_accordion($xmlNode,OP_NONE,NUM_0);
     $dataObj = $obj->getObj();
     $this->assertEquals($dataObj,$xmlNode);
    }
        
    public function testSetGetJsonSerializableDataObj()
    {
     $serializer = new Json_serializer(STRING_NULL);
     $jsonNode = new Json_node($serializer);
     $jsonNode->setNodeName("Test_json_node_1");
     $obj = new Std_accordion($jsonNode,OP_NONE,NUM_0);
     $dataObj = $obj->getObj();
     $this->assertEquals($dataObj,$jsonNode);
    }
    
    public function testSetGetOp()
    {
    	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
    	$op = $obj->getOp();
    	$this->assertEquals(OP_NONE,$op);
    }
    
    public function testSetGetNum_0()
    {
    	$obj = new Std_accordion(OBJ_NONE,OP_NONE,STRING_NULL);
    	$num = $obj->getNum();
    	$this->assertEquals($num,Std_accordion::getInterfacesTotNum()-1);
    }
    
    public function testSetGetNum_1()
    {
    	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_1);
    	$num = $obj->getNum();
    	$this->assertEquals($num,NUM_1);
    }
}
?>