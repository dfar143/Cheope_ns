<?php
require_once("./fw/Std_accordion.class.php");
require_once("./fw/Html_fragment.class.php");

class XmlInterfaceSerializerManagementTest extends PHPUnit_Framework_TestCase
{
	public function testLoadItems()
	{
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setAppName("Test");
  	$obj->setDataFields(array("Test_field_1"));
  	$obj->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC));
  	$obj->setDataFieldsDomainsValues(array("Test_value_1"));
  	$obj1 = new Html_fragment();
  	$obj1->setHtmlFragment("<span>Hello</span>");
  	$intCont = new Interfaces_container(STRING_NULL);
  	$intCont->add($obj1);
  	$obj->setInterfacesContainer($intCont);
    $obj->serialize();
    $serializer=&$obj->getSerializer();
    $serializer->setDir("./tests");
    $obj->serializer_saveData("Test");
    $xmlString=<<<XML
<?xml version="1.0"?>
<Items>
  <ind_appName type="scalar" id="appName"><![CDATA[Test]]></ind_appName>
  <ind_pageName type="scalar" id="pageName"><![CDATA[Test]]></ind_pageName>
  <ind_op type="scalar" id="op"><![CDATA[]]></ind_op>
  <ind_type type="scalar" id="type"><![CDATA[accordion]]></ind_type>
  <ind_num type="scalar" id="num"><![CDATA[0]]></ind_num>
  <ind_shortName type="scalar" id="shortName"><![CDATA[]]></ind_shortName>
  <ind_cssClass type="scalar" id="cssClass"><![CDATA[accordion]]></ind_cssClass>
  <ind_style type="scalar" id="@style"><![CDATA[]]></ind_style>
  <ind_dispFields type="array" id="dispFields"/>
  <ind_obj type="scalar" id="obj"><![CDATA[]]></ind_obj>
  <ind_inheritData type="scalar" id="inheritData"><![CDATA[false]]></ind_inheritData>
  <ind_inheritDataFieldName type="scalar" id="inheritDataFieldName"><![CDATA[false]]></ind_inheritDataFieldName>
  <ind_dataFields type="array" id="dataFields">
    <ind_0 type="scalar" id="0"><![CDATA[Test_field_1]]></ind_0>
  </ind_dataFields>
  <ind_dataFieldsDomains type="array" id="dataFieldsDomains">
    <ind_0 type="scalar" id="0"><![CDATA[atomic]]></ind_0>
  </ind_dataFieldsDomains>
  <ind_dataFieldsDomainsValues type="array" id="dataFieldsDomainsValues">
    <ind_0 type="scalar" id="0"><![CDATA[Test_value_1]]></ind_0>
  </ind_dataFieldsDomainsValues>
  <ind_dataSource type="scalar" id="dataSource"><![CDATA[]]></ind_dataSource>
  <ind_fieldsFromDataSource type="scalar" id="fieldsFromDataSource"><![CDATA[false]]></ind_fieldsFromDataSource>
  <ind_fillSpace type="scalar" id="fillSpace"><![CDATA[true]]></ind_fillSpace>
  <ind_autoHeight type="scalar" id="autoHeight"><![CDATA[false]]></ind_autoHeight>
  <ind_collapsible type="scalar" id="collapsible"><![CDATA[true]]></ind_collapsible>
  <ind_event type="scalar" id="event"><![CDATA[click]]></ind_event>
  <ind_voicesField type="scalar" id="voicesField"><![CDATA[]]></ind_voicesField>
  <ind_interfacesContainer type="container" id="interfacesContainer">
    <ind_0 type="interface" id="0">Test!!html_fragment!!0</ind_0>
  </ind_interfacesContainer>
</Items>
XML;
    $this->assertXmlStringEqualsXmlFile("./tests/Test!!!accordion!!0",$xmlString);
	}
	
	public function testLoadData()
	{
		$dbStructTree = new Db_nodes_container(STRING_NULL);
		$dbQueries = new Queries_container(STRING_NULL);
  	$obj = new Std_accordion(OBJ_NONE,OP_NONE,NUM_0);
  	$obj->setDbStruct($dbStructTree);
  	$obj->setDbQueries($dbQueries);
    $serializer=&$obj->getSerializer();
    $serializer->setDir("./tests");
    $serializer->setInterfacesDir(THIS_DIR . DIR_SEP . "fw");
    $obj->serializer_loadData("Test"); 
    $obj->unserialize(); 
    $dataFields = $obj->getDataFields();
    $this->assertEquals("Test_field_1",$dataFields[0]);	
    $dataFieldsDomains = $obj->getDataFieldsDomains();
    $this->assertEquals(Int_domain::FIELD_DOMAIN_ATOMIC,$dataFieldsDomains[0]);
    $intContainer = &$obj->getInterfacesContainer();
    $contents = &$intContainer->getContents();
    $intObj = $contents[0];
    $this->assertInstanceOf(INT_HTML_FRAGMENT,$intObj);
	}
	
}