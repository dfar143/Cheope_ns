<?php
require_once("./fw/Std_accordion.class.php");

class HtmlDataInterfaceSetAndGetPropsTest extends PHPUnit_Framework_TestCase
{
	
	public function testSetGetInterfacesTotNum()
  {
   Std_accordion::setInterfacesTotNum(0);
   $obj0 = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
   $obj1 = new Std_accordion(OBJ_NONE,OP_NONE,NUM_1);
   $this->assertEquals(2,Std_accordion::getInterfacesTotNum());
  }
  
  public function testSetGetCompleteInterfaceId_0()
  {
   $dbNode = new Db_node("Node_test");
   $obj = new Std_accordion($dbNode,"Op_test","0");
   $completeIntId = $obj->getCompleteInterfaceId(Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
   $this->assertEquals($completeIntId,"Node_test" .
   Generic_interface::INTERFACE_INSTANCE_CHAR_SEP . "accordion" .
   Generic_interface::INTERFACE_INSTANCE_CHAR_SEP . "Op_test" .
   Generic_interface::INTERFACE_INSTANCE_CHAR_SEP . "0");
  }
  
  public function testSetGetCompleteInterfaceId_1()
  {
   $dbStructTree = new Db_nodes_container();
   $dbQuery = new Db_query("Node_test",$dbStructTree);
   $obj = new Std_accordion($dbQuery,"Op_test","0");
   $completeIntId = $obj->getCompleteInterfaceId(Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
   $this->assertEquals($completeIntId,"Node_test" .
   Generic_interface::INTERFACE_INSTANCE_CHAR_SEP . "accordion" .
   Generic_interface::INTERFACE_INSTANCE_CHAR_SEP . "Op_test" .
   Generic_interface::INTERFACE_INSTANCE_CHAR_SEP . "0");
  }  
  
  public function testSetGetCompleteInterfaceId_2()
  {
   $serializer = new Xml_serializer(STRING_NULL);
   $xmlNode = new Xml_node($serializer);
   $xmlNode->setNodeName("Xml_node_test");
   $obj = new Std_accordion($xmlNode,"Op_test","0");
   $completeIntId = $obj->getCompleteInterfaceId(Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
   $this->assertEquals($completeIntId,"Xml_node_test" .
   Generic_interface::INTERFACE_INSTANCE_CHAR_SEP . "accordion" .
   Generic_interface::INTERFACE_INSTANCE_CHAR_SEP . "Op_test" .
   Generic_interface::INTERFACE_INSTANCE_CHAR_SEP . "0");
  }
  
  public function testSetGetDataFieldsVoid()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array());
  	$intFieldsContainer = $obj->getIntFieldsContainer();
  	$contents = &$intFieldsContainer->getContents();
    $this->assertEquals(array(),$contents);
  }
  
  public function testSetGetDataFields_0()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1"));
  	$intFieldsContainer = $obj->getIntFieldsContainer();
  	$contents = &$intFieldsContainer->getContents();
    $this->assertEquals("Test_field_1",$contents[0]->getName());
  }
  
  public function testSetGetDataFields_1()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1","Test_field_2"));
  	$intFieldsContainer = $obj->getIntFieldsContainer();
  	$contents = &$intFieldsContainer->getContents();
    $this->assertEquals("Test_field_2",$contents[1]->getName());
  }
  
  public function testSetGetDataFields_2()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1","Test_field_2"));
    $dataFields = $obj->getDataFields();
    $this->assertEquals("Test_field_1",$dataFields[0]);
    $this->assertEquals("Test_field_2",$dataFields[1]);
  }
  
  public function testSetGetDataFieldsDomains_0()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1"));
  	$obj->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC));
  	$intFieldsContainer = $obj->getIntFieldsContainer();
  	$contents = &$intFieldsContainer->getContents();
  	$int_field = $contents[0];
    $this->assertEquals(Int_domain::FIELD_DOMAIN_ATOMIC,$int_field->getDomain());
    $int_domain = $int_field->getDomainObj();
    $this->assertEquals(Int_domain::FIELD_DOMAIN_ATOMIC,$int_domain->getName());
  } 
  
  public function testSetGetDataFieldsDomains_1()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1","Test_field_2"));
  	$obj->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_SET));
    $dataFieldsDomains = $obj->getDataFieldsDomains();
    $this->assertEquals(Int_domain::FIELD_DOMAIN_ATOMIC,$dataFieldsDomains[0]);
    $this->assertEquals(Int_domain::FIELD_DOMAIN_SET,$dataFieldsDomains[1]);
  }
  
  public function testSetGetDataFieldsDomainsByName()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
    $obj->setDataFields(array("Test_field_1","Test_field_2")); 
    $obj->setDataFieldDomainByName("Test_field_1",Int_domain::FIELD_DOMAIN_ATOMIC);
    $dataFieldDomain = $obj->getDataFieldDomainByName("Test_field_1"); 
    $this->assertEquals(Int_domain::FIELD_DOMAIN_ATOMIC,$dataFieldDomain);   	
  }
  
  public function testSetGetDataFieldsDomainsByPos()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
    $obj->setDataFields(array("Test_field_1","Test_field_2")); 
    $obj->setDataFieldDomainByPos(0,Int_domain::FIELD_DOMAIN_ATOMIC);
    $dataFieldDomain = $obj->getDataFieldDomainByPos(0); 
    $this->assertEquals(Int_domain::FIELD_DOMAIN_ATOMIC,$dataFieldDomain);   	
  }  
  
  public function testSetGetDataFieldsDomainsValues_0()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1"));
  	$obj->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_TABLE));
  	$obj->setDataFieldsDomainsValues(array("Tabella_test_1"=>"Test_field_1"));
  	$intFieldsContainer = $obj->getIntFieldsContainer();
  	$contents = &$intFieldsContainer->getContents();
  	$int_field = $contents[0];
    $this->assertEquals(Int_domain::FIELD_DOMAIN_TABLE,$int_field->getDomain());
    $this->assertEquals("Test_field_1",$int_field->getDomainValue());
    $this->assertEquals("Tabella_test_1",$int_field->getDomainKey());
    $int_domain = $int_field->getDomainObj();
    $this->assertInstanceOf("Int_domain_table",$int_domain);
    $this->assertEquals(Int_domain::FIELD_DOMAIN_TABLE,$int_domain->getName());
    $this->assertEquals("Test_field_1",$int_domain->getValue());
    $this->assertEquals("Tabella_test_1",$int_domain->getKey());
  } 
  
  public function testSetGetDataFieldsDomainsValues_1()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1","Test_field_2"));
  	$obj->setDataFieldsDomainsValues(array("Test_value_1","Test_value_2"));
    $dataFieldsDomainsValues = $obj->getDataFieldsDomainsValues();
    $this->assertEquals("Test_value_1",$dataFieldsDomainsValues[0]);
    $this->assertEquals("Test_value_2",$dataFieldsDomainsValues[1]);
  }
  
  public function testSetGetDataFieldDomainValueByName()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
    $obj->setDataFields(array("Test_field_1","Test_field_2")); 
    $obj->setDataFieldDomainValueByName("Test_field_1","Test_value_1");
    $dataFieldDomainValue = $obj->getDataFieldDomainValueByName("Test_field_1"); 
    $this->assertEquals("Test_value_1",$dataFieldDomainValue);   	
  }
  
  public function testSetGetDataFieldDomainValueByPos()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
    $obj->setDataFields(array("Test_field_1","Test_field_2")); 
    $obj->setDataFieldDomainValueByPos(0,"Test_value_1");
    $dataFieldDomainValue = $obj->getDataFieldDomainValueByPos(0); 
    $this->assertEquals("Test_value_1",$dataFieldDomainValue);   	
  }
  
  public function testSetGetDataFieldsDomainsObjs()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
    $obj->setDataFields(array("Test_field_1","Test_field_2"));
    $domainObj0 = new Int_domain_atomic(); 
    $domainObj1 = new Int_domain_set();
    $obj->setDataFieldsDomainsObjs(array($domainObj0,$domainObj1));
    $domainsObjs = $obj->getDataFieldsDomainsObjs(); 
    $this->assertInstanceOf("Int_domain_atomic",$domainsObjs[0]);
    $this->assertInstanceOf("Int_domain_set",$domainsObjs[1]);		  	
  } 
  
  public function testSetGetDataFieldDomainObjByName()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
    $obj->setDataFields(array("Test_field_1","Test_field_2"));
    $domainObj0 = new Int_domain_atomic(); 
    $obj->setDataFieldDomainObjByName("Test_field_2",$domainObj0);
    $domainObj = $obj->getDataFieldDomainObjByName("Test_field_2"); 
    $this->assertInstanceOf("Int_domain_atomic",$domainObj);
  } 
  
  public function testSetGetDataFieldDomainObjByPos()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
    $obj->setDataFields(array("Test_field_1","Test_field_2"));
    $domainObj0 = new Int_domain_atomic(); 
    $obj->setDataFieldDomainObjByPos(1,$domainObj0);
    $domainObj = $obj->getDataFieldDomainObjByPos(1); 
    $this->assertInstanceOf("Int_domain_atomic",$domainObj);
  } 
  
  public function testAddField()
  {
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->addField("Test_field_1");
  	$intFieldsContainer = $obj->getIntFieldsContainer();
  	$contents = &$intFieldsContainer->getContents();
  	$int_field = $contents[0];
    $this->assertEquals("Test_field_1",$int_field->getName());
    $this->assertEquals(Int_domain::FIELD_DOMAIN_ATOMIC,$int_field->getDomain());
    $int_domain = $int_field->getDomainObj();
    $this->assertEquals(Int_domain::FIELD_DOMAIN_ATOMIC,$int_domain->getName());
 
  	$obj->addField("Test_field_2");
  	$int_field = $contents[1];
    $this->assertEquals("Test_field_2",$int_field->getName());
    $this->assertEquals(Int_domain::FIELD_DOMAIN_ATOMIC,$int_field->getDomain());
    $this->assertEquals(Int_domain::FIELD_DOMAIN_VALUE_NONE ; ,$int_field->getDomainValue());
    $int_domain = $int_field->getDomainObj();
    $this->assertEquals(Int_domain::FIELD_DOMAIN_ATOMIC,$int_domain->getName());
    $this->assertEquals(Int_domain::FIELD_DOMAIN_VALUE_NONE ; ,$int_domain->getValue());
 
  	$obj->addField("Test_field_3",array("Array_value_1"));
  	$int_field = $contents[2];
    $this->assertEquals("Test_field_3",$int_field->getName());
    $this->assertEquals(Int_domain::FIELD_DOMAIN_SET,$int_field->getDomain());
    $this->assertEquals(array("Array_value_1"),$int_field->getDomainValue());
    $int_domain = $int_field->getDomainObj();
    $this->assertEquals(Int_domain::FIELD_DOMAIN_SET,$int_domain->getName()); 
    $this->assertEquals(array("Array_value_1"),$int_domain->getValue());

    $intObj = new StdClass;
  	$obj->addField("Test_field_4",$intObj);    
  	$int_field = $contents[3];
    $this->assertEquals("Test_field_4",$int_field->getName());
    $this->assertEquals(Int_domain::FIELD_DOMAIN_OBJ,$int_field->getDomain());
    $this->assertEquals($intObj,$int_field->getDomainValue());
    $int_domain = $int_field->getDomainObj();
    $this->assertEquals(Int_domain::FIELD_DOMAIN_OBJ,$int_domain->getName());
    $this->assertEquals($intObj,$int_domain->getValue());
    
    $fun = function(){};
  	$obj->addField("Test_field_5",$fun);   
  	$int_field = $contents[4];
    $this->assertEquals("Test_field_5",$int_field->getName());
    $this->assertEquals(Int_domain::FIELD_DOMAIN_FUNCTION,$int_field->getDomain());
    $this->assertEquals($fun,$int_field->getDomainValue());
    $int_domain = $int_field->getDomainObj();
    $this->assertEquals(Int_domain::FIELD_DOMAIN_FUNCTION,$int_domain->getName());
    $this->assertEquals($fun,$int_domain->getValue());

  	$obj->addField("Test_field_6",array("Tabella_test_1"=>"Tabella_field_1"),Int_domain::FIELD_DOMAIN_TABLE);
  	$int_field = $contents[5];
    $this->assertEquals("Test_field_6",$int_field->getName());
    $this->assertEquals(Int_domain::FIELD_DOMAIN_TABLE,$int_field->getDomain());
    $this->assertEquals("Tabella_field_1",$int_field->getDomainValue());
    $this->assertEquals("Tabella_test_1",$int_field->getDomainKey());
    $int_domain = $int_field->getDomainObj();
    $this->assertEquals(Int_domain::FIELD_DOMAIN_TABLE,$int_domain->getName()); 
    $this->assertEquals("Tabella_field_1",$int_domain->getValue()); 
    $this->assertEquals("Tabella_test_1",$int_domain->getKey());
         	
  }    
	
	public function testDeleteField()
	{
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->addField("Test_field_1");
  	$intFieldsContainer = $obj->getIntFieldsContainer();
  	$obj->addField("Test_field_2");
    $obj->deleteField("Test_field_1");
  	$contents = &$intFieldsContainer->getContents();
  	$this->assertEquals("Test_field_2",$contents[0]->getName());
	}
}

?>