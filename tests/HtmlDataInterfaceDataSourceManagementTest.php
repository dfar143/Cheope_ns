<?php
require_once("./fw/Std_accordion.class.php");

class HtmlDataInterfaceDataSourceManagementTest extends PHPUnit_Framework_TestCase
{
	public function testGetDataFieldAllValues_0()
	{
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1"));
  	$obj->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC));
  	$obj->setDataFieldsDomainsValues(array("Test_value_1"));
  	$dataValue = $obj->getDataFieldAllValues("Test_field_1",STRING_NULL);
  	$this->assertEquals("Test_value_1",$dataValue); 
	}
	
	public function testGetDataFieldAllValues_1()
	{
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1"));
  	$obj->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC));
  	$obj->setDataFieldsDomainsValues(array(STRING_NULL));
  	$dataValue = $obj->getDataFieldAllValues("Test_field_1","Test_value_2");
  	$this->assertEquals("Test_value_2",$dataValue); 
	}

	public function testGetDataFieldAllValues_2()
	{
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1"));
  	$obj->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC_STATIC));
  	$obj->setDataFieldsDomainsValues(array(STRING_NULL));
  	$dataValue = $obj->getDataFieldAllValues("Test_field_1","Test_value_2");
  	$this->assertEquals(STRING_NULL,$dataValue); 
	}
		
	public function testGetDataFieldAllValues_3()
	{
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1"));
  	$obj->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC_STATIC));
  	$obj->setDataFieldsDomainsValues(array("Test_value_1"));
  	$dataValue = $obj->getDataFieldAllValues("Test_field_1","Test_value_2");
  	$this->assertEquals("Test_value_1",$dataValue); 
	}
	
	public function testGetDataFieldAllValues_4()
	{
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1"));
  	$obj->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_SET));
  	$obj->setDataFieldsDomainsValues(array(array("Test_value_1")));
  	$dataValue = $obj->getDataFieldAllValues("Test_field_1","Test_value_2");
  	$this->assertEquals(array("Test_value_1"),$dataValue); 
	}
	
	public function testGetDataFieldAllValues_5()
	{
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1"));
  	$obj->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_OBJ));
  	$domainValue = $obj;
  	$obj->setDataFieldsDomainsValues(array($domainValue));
  	$dataValue = $obj->getDataFieldAllValues("Test_field_1");
  	$this->assertEquals($domainValue,$dataValue); 
	}
	
	public function testGetDataFieldAllValues_6()
	{
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDataFields(array("Test_field_1"));
  	$obj->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_FUNCTION));
  	$domainValue = function(){};
  	$obj->setDataFieldsDomainsValues(array($domainValue));
  	$dataValue = $obj->getDataFieldAllValues("Test_field_1");
  	$this->assertEquals($domainValue,$dataValue); 
	}
	
	public function testInitDataSource()
	{
   $obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
   $res = $obj->initDataSource("Test_value_1");
   $this->assertEquals(array(array("Test_value_1")),$res);
   $res = $obj->initDataSource(array("Test_value_1"));
   $this->assertEquals(array(array("Test_value_1")),$res); 
   $res = $obj->initDataSource(array(array("Test_value_1")));
   $this->assertEquals(array(array("Test_value_1")),$res); 
	}
	
  public function testExtractDataFromDataSource()
  {
   $obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
   $obj->setDataFields(
   array("Test_field_1","Test_field_2","Test_field_3","Test_field_4"));
   $obj->setDataFieldsDomains(
   array(Int_domain::FIELD_DOMAIN_ATOMIC,
   Int_domain::FIELD_DOMAIN_ATOMIC,
   Int_domain::FIELD_DOMAIN_SET,
   Int_domain::FIELD_DOMAIN_FUNCTION));
   $obj->setDataFieldsDomainsValues(array("Test_domain_value_1",
   Int_domain::FIELD_DOMAIN_VALUE_NONE ; ,array("Test_domain_value_2"),
   function($actInd,$actField){return $actField . VAR_SEP . $actInd;}));
 	 $dataSource=array(array("Test_field_1"=>"Test_value_1",
 	 "Test_field_2"=>"Test_value_2",
 	 "Test_field_3"=>"Test_value_3",
 	 "Test_field_4"=>"Test_value_4"
 	 ));
 	 $dataValues = $obj->extractDataFromDataSource($dataSource);
 	 $dataValuesExpected = array("Test_field_1"=>
 	 array("Test_domain_value_1"),
 	 "Test_field_2"=>
 	 array("Test_value_2"),
 	 "Test_field_3"=>
 	 array("Test_domain_value_2"),
 	 "Test_field_4"=>
 	 array("Test_field_4_0"));
 	 $this->assertEquals($dataValuesExpected,$dataValues);
 	 $dataSource=array(array());
 	 $dataValues = $obj->extractDataFromDataSource($dataSource);
 	 $dataValuesExpected = array("Test_field_1"=>
 	 array("Test_domain_value_1"),
 	 "Test_field_2"=>array(""),
 	 "Test_field_3"=>array("Test_domain_value_2"),
 	 "Test_field_4"=>array("Test_field_4_0"));
 	 $this->assertEquals($dataValuesExpected,$dataValues); 
  }
  
  public function testFieldsFromDataSource()
  {
   $obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
   $obj->setDataFields(
   array("Test_field_1","Test_field_2"));
   $obj->setDataFieldsDomains(
   array(Int_domain::FIELD_DOMAIN_ATOMIC,
   Int_domain::FIELD_DOMAIN_ATOMIC));
   $obj->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ; ,
   Int_domain::FIELD_DOMAIN_VALUE_NONE ; ));
   $dataSource = array(array("Test_field_3"=>"Test_value_1"));
   $obj->setDataSource($dataSource);
   $obj->setFieldsFromDataSource(true);
   $obj->fieldsFromDataSource();
   $dataFields = $obj->getDataFields();
   $dataFieldsExpected = array("Test_field_1","Test_field_2","Test_field_3");
   $this->assertEquals($dataFieldsExpected,$dataFields);
  }
	
}