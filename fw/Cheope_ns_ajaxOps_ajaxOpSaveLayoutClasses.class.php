<?
namespace Cheope_ns\fw;
require_once("cheope_ns.fun.php");
require_once("Interfaces_info.class.php");
require_once("Executable.int.php");
require_once("Factory_8.int.php");
require_once("Creator.tra.php");

abstract class SaveLayoutBase implements Executable
{
 protected $root = null;
 protected $doc = null;
	
 function __construct(\DOMDocument $actDoc,\DOMElement $actRoot)
 {
 	$this->setDoc($actDoc);
 	$this->setRoot($actRoot);
 }	
	
 function setDoc(\DOMDocument $actDoc)
 {
 	$this->doc = $actDoc;
 }
 
 function getDoc()
 {
 	return $this->doc;
 }	
 
 function setRoot(\DOMElement $actRoot)
 {
 	$this->root = $actRoot;
 }
 
 function getRoot()
 {
 	return $this->root;
 }
 
}

class SaveLayout_int_simple_layout extends SaveLayoutBase
{
  function __construct(\DOMDocument $actDoc,\DOMElement $actRoot)
  {
  	parent::__construct($actDoc,$actRoot);
  } 
  
  function exec():void
  {
  	$doc = $this->getDoc();
  	$root = $this->getRoot();
		$el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "interfacesContainerCenter" );
		$el2->setAttribute ( "type", "container" );
		$el2->setAttribute ( "id", "interfacesContainerCenter" );
		$el2 = $root->appendChild ( $el2 );
		$val = $_POST ["center_container"];
		if ($val != STRING_NULL) 
		{
		 $valItems = explode ( STRING_SEMICOLON, $val );
		 $num = count ( $valItems );
		 for($i = 0; $i <= $num - 1; $i ++) 
		 {
			$valItemEl = $valItems [$i];
			if (trim ( $valItemEl ) != STRING_NULL) 
			{
			 $el3 = $doc->createElement ( "ind" . STRING_UNDERSCORE . $i );
			 $el3->setAttribute ( "type", "interface" );
			 $el3->setAttribute ( "id", $i );
			 $el4 = $doc->createCDATASection ( $valItemEl );
			 $el5 = $el3->appendChild ( $el4 );
			 $el3 = $el2->appendChild ( $el3 );
			}
		 }
		}
  }
}

class SaveLayout_two_columns_layout extends SaveLayoutBase
{
  function __construct(\DOMDocument $actDoc,\DOMElement $actRoot)
  {
  	parent::__construct($actDoc,$actRoot);
  }	
  
  function exec():void
  {
  	$doc = $this->getDoc();
  	$root = $this->getRoot();
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "containerLeftStyle" );
	 $el2->setAttribute ( "type", "scalar" );
	 $el2->setAttribute ( "id", "@containerLeftStyle" );
	 $el3 = $doc->createCDATASection ( $_POST ["left_style"] );
	 $el3 = $el2->appendChild ( $el3 );
	 $el4 = $root->appendChild ( $el2 );
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "interfacesContainerLeft" );
	 $el2->setAttribute ( "type", "container" );
	 $el2->setAttribute ( "id", "interfacesContainerLeft" );
	 $el2 = $root->appendChild ( $el2 );
	 $val = $_POST ["left_container"];
	 if ($val != STRING_NULL) 
	 {	 	
		$valItems = explode ( STRING_SEMICOLON, $val );
		$num = count ( $valItems );
		for($i = 0; $i <= $num - 1; $i ++) 
		{
		 $valItemEl = $valItems [$i];
		 if (trim ( $valItemEl ) != STRING_NULL) 
		 {
			$el3 = $doc->createElement ( "ind" . STRING_UNDERSCORE . $i );
			$el3->setAttribute ( "type", "interface" );
			$el3->setAttribute ( "id", $i );
			$el4 = $doc->createCDATASection ( $valItemEl );
		  $el5 = $el3->appendChild ( $el4 );
			$el3 = $el2->appendChild ( $el3 );
		 }
		}
	 }
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "containerRightStyle" );
	 $el2->setAttribute ( "type", "scalar" );
	 $el2->setAttribute ( "id", "@containerRightStyle" );
	 $el3 = $doc->createCDATASection ( $_POST ["right_style"] );
	 $el3 = $el2->appendChild ( $el3 );
	 $el4 = $root->appendChild ( $el2 );
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "interfacesContainerRight" );
	 $el2->setAttribute ( "type", "container" );
	 $el2->setAttribute ( "id", "interfacesContainerRight" );
	 $el2 = $root->appendChild ( $el2 );
	 $val = $_POST ["right_container"];
	 if ($val != STRING_NULL) 
	 {	 	
		$valItems = explode ( STRING_SEMICOLON, $val );
		$num = count ( $valItems );
	  for($i = 0; $i <= $num - 1; $i ++) 
	  {
		 $valItemEl = $valItems [$i];
		 if (trim ( $valItemEl ) != STRING_NULL) 
		 {
			$el3 = $doc->createElement ( "ind" . STRING_UNDERSCORE . $i );
			$el3->setAttribute ( "type", "interface" );
			$el3->setAttribute ( "id", $i );
			$el4 = $doc->createCDATASection ( $valItemEl );
			$el5 = $el3->appendChild ( $el4 );
			$el3 = $el2->appendChild ( $el3 );
		 }
		}
	 }
  }
}

class SaveLayout_three_columns_layout extends SaveLayoutBase
{
  function __construct(\DOMDocument $actDoc,\DOMElement $actRoot)
  {
  	parent::__construct($actDoc,$actRoot);
  }		

  function exec():void
  {	
  	$doc = $this->getDoc();
  	$root = $this->getRoot();
	
   $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "containerLeftStyle" );
   $el2->setAttribute ( "type", "scalar" );
   $el2->setAttribute ( "id", "@containerLeftStyle" );
   $el3 = $doc->createCDATASection ( $_POST ["left_style"] );
   $el3 = $el2->appendChild ( $el3 );
   $el4 = $root->appendChild ( $el2 );
   $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "interfacesContainerLeft" );
   $el2->setAttribute ( "type", "container" );
   $el2->setAttribute ( "id", "interfacesContainerLeft" );
   $el2 = $root->appendChild ( $el2 );
   $val = $_POST ["left_container"];
   if ($val != STRING_NULL) 
   {
	  $valItems = explode ( STRING_SEMICOLON, $val );
    $num = count ( $valItems );
	  for($i = 0; $i <= $num - 1; $i ++) 
 	  {
	   $valItemEl = $valItems [$i];
	   if (trim ( $valItemEl ) != STRING_NULL) 
	   {
		  $el3 = $doc->createElement ( "ind" . STRING_UNDERSCORE . $i );
		  $el3->setAttribute ( "type", "interface" );
		  $el3->setAttribute ( "id", $i );
		  $el4 = $doc->createCDATASection ( $valItemEl );
		  $el5 = $el3->appendChild ( $el4 );
		  $el3 = $el2->appendChild ( $el3 );
	   }
	  }
   }					
   $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "containerCenterStyle" );
   $el2->setAttribute ( "type", "scalar" );
   $el2->setAttribute ( "id", "@containerCenterStyle" );
   $el3 = $doc->createCDATASection ( $_POST ["center_style"] );
   $el3 = $el2->appendChild ( $el3 );
   $el4 = $root->appendChild ( $el2 );
   $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "interfacesContainerCenter" );
   $el2->setAttribute ( "type", "container" );
   $el2->setAttribute ( "id", "interfacesContainerCenter" );
   $el2 = $root->appendChild ( $el2 );
   $val = $_POST ["center_container"];
   if ($val != STRING_NULL) 
   {
	  $valItems = explode ( STRING_SEMICOLON, $val );
	  $num = count ( $valItems );
	  for($i = 0; $i <= $num - 1; $i ++) 
	  {
	   $valItemEl = $valItems [$i];
	   if (trim ( $valItemEl ) != STRING_NULL) 
	   {
		  $el3 = $doc->createElement ( "ind" . STRING_UNDERSCORE . $i );
		  $el3->setAttribute ( "type", "interface" );
		  $el3->setAttribute ( "id", $i );
		  $el4 = $doc->createCDATASection ( $valItemEl );
		  $el5 = $el3->appendChild ( $el4 );
	    $el3 = $el2->appendChild ( $el3 );
	   }
	  }
   }  				
   $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "containerRightStyle" );
   $el2->setAttribute ( "type", "scalar" );
   $el2->setAttribute ( "id", "@containerRightStyle" );
   $el3 = $doc->createCDATASection ( $_POST ["right_style"] );
   $el3 = $el2->appendChild ( $el3 );
   $el4 = $root->appendChild ( $el2 );
   $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "interfacesContainerRight" );
   $el2->setAttribute ( "type", "container" );
   $el2->setAttribute ( "id", "interfacesContainerRight" );
   $el2 = $root->appendChild ( $el2 );
   $val = $_POST ["right_container"];
   if ($val != STRING_NULL) 
   {
	  $valItems = explode ( STRING_SEMICOLON, $val );
	  $num = count ( $valItems );
	  for($i = 0; $i <= $num - 1; $i ++) 
	  {
	   $valItemEl = $valItems [$i];
	   if (trim ( $valItemEl ) != STRING_NULL) 
	   {
		  $el3 = $doc->createElement ( "ind" . STRING_UNDERSCORE . $i );
	    $el3->setAttribute ( "type", 'interface' );
		  $el3->setAttribute ( "id", $i );
		  $el4 = $doc->createCDATASection ( $valItemEl );
		  $el5 = $el3->appendChild ( $el4 );
		  $el3 = $el2->appendChild ( $el3 );
	   }
	  }
   }
  }
  
}

class SaveLayout_int_tb_layout extends SaveLayoutBase
{
	function __construct(\DOMDocument $actDoc,\DOMElement $actRoot)
  {
  	parent::__construct($actDoc,$actRoot);
  }	

  function exec():void
  {	
  	$doc = $this->getDoc();
  	$root = $this->getRoot();
	
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "containerTopStyle" );
	 $el2->setAttribute ( "type", "scalar" );
	 $el2->setAttribute ( "id", "@containerTopStyle" );
	 $el3 = $doc->createCDATASection ( $_POST ["top_style"] );
	 $el3 = $el2->appendChild ( $el3 );
	 $el4 = $root->appendChild ( $el2 );
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "interfacesContainerTop" );
	 $el2->setAttribute ( "type", "container" );
	 $el2->setAttribute ( "id", "interfacesContainerTop" );
	 $el2 = $root->appendChild ( $el2 );
	 $val = $_POST ["top_container"];
	 if ($val != STRING_NULL) 
	 {	
	  $valItems = explode ( STRING_SEMICOLON, $val );
		$num = count ( $valItems );
		for($i = 0; $i <= $num - 1; $i ++) 
		{			
		 $valItemEl = $valItems [$i];
		 if (trim ( $valItemEl ) != STRING_NULL) 
		 {
			$el3 = $doc->createElement ( "ind" . STRING_UNDERSCORE . $i );
			$el3->setAttribute ( "type", "interface" );
			$el3->setAttribute ( "id", $i );
			$el4 = $doc->createCDATASection ( $valItemEl );
			$el5 = $el3->appendChild ( $el4 );
			$el3 = $el2->appendChild ( $el3 );
		 }
		}
	 }
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "containerBottomStyle" );
	 $el2->setAttribute ( "type", "scalar" );
	 $el2->setAttribute ( "id", "@containerBottomStyle" );
	 $el3 = $doc->createCDATASection ( $_POST ["bottom_style"] );
	 $el3 = $el2->appendChild ( $el3 );
	 $el4 = $root->appendChild ( $el2 );
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "interfacesContainerBottom" );
	 $el2->setAttribute ( "type", "container" );
	 $el2->setAttribute ( "id", "interfacesContainerBottom" );
	 $el2 = $root->appendChild ( $el2 );
	 $val = $_POST ["bottom_container"];
	 if ($val != STRING_NULL) 
	 {
		$valItems = explode ( STRING_SEMICOLON, $val );
		$num = count ( $valItems );
	  for($i = 0; $i <= $num - 1; $i ++) 
	  {
		 $valItemEl = $valItems [$i];
		 if (trim ( $valItemEl ) != STRING_NULL) 
		 {
		  $el3 = $doc->createElement ( "ind" . STRING_UNDERSCORE . $i );
			$el3->setAttribute ( "type", "interface" );
			$el3->setAttribute ( "id", $i );
			$el4 = $doc->createCDATASection ( $valItemEl );
			$el5 = $el3->appendChild ( $el4 );
			$el3 = $el2->appendChild ( $el3 );
		 }
		}
	 }
  }  
}

class SaveLayout_int_tb_simple_layout extends SaveLayoutBase
{
  function __construct(\DOMDocument $actDoc,\DOMElement $actRoot)
  {
  	parent::__construct($actDoc,$actRoot);
  }
  
  function exec():void
  {
  	$doc = $this->getDoc();
  	$root = $this->getRoot();
	
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "containerTopStyle" );
	 $el2->setAttribute ( "type", "scalar" );
	 $el2->setAttribute ( "id", "@containerTopStyle" );
	 $el3 = $doc->createCDATASection ( $_POST ["top_style"] );
	 $el3 = $el2->appendChild ( $el3 );
	 $el4 = $root->appendChild ( $el2 );
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "interfacesContainerTop" );
	 $el2->setAttribute ( "type", "container" );
	 $el2->setAttribute ( "id", "interfacesContainerTop" );
	 $el2 = $root->appendChild ( $el2 );
	 $val = $_POST ["top_container"];
	 if ($val != STRING_NULL) 
	 {
		$valItems = explode ( STRING_SEMICOLON, $val );
		$num = count ( $valItems );
		for($i = 0; $i <= $num - 1; $i ++) 
		{			
		 $valItemEl = $valItems [$i];
		 if (trim ( $valItemEl ) != STRING_NULL) 
		 {
			$el3 = $doc->createElement ( "ind" . STRING_UNDERSCORE . $i );
			$el3->setAttribute ( "type", "interface" );
			$el3->setAttribute ( "id", $i );
		  $el4 = $doc->createCDATASection ( $valItemEl );
			$el5 = $el3->appendChild ( $el4 );
			$el3 = $el2->appendChild ( $el3 );
		 }
		}
	 }
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "containerCenterStyle" );
	 $el2->setAttribute ( "type", "scalar" );
	 $el2->setAttribute ( "id", "@containerCenterStyle" );
	 $el3 = $doc->createCDATASection ( $_POST ["center_style"] );
	 $el3 = $el2->appendChild ( $el3 );
	 $el4 = $root->appendChild ( $el2 );
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "interfacesContainerCenter" );
	 $el2->setAttribute ( "type", "container" );
	 $el2->setAttribute ( "id", "interfacesContainerCenter" );
	 $el2 = $root->appendChild ( $el2 );
	 $val = $_POST ["center_container"];
	 if ($val != STRING_NULL) 
	 {
		$valItems = explode ( STRING_SEMICOLON, $val );
		$num = count ( $valItems );
		for($i = 0; $i <= $num - 1; $i ++) 
		{
		 $valItemEl = $valItems [$i];
		 if (trim ( $valItemEl ) != STRING_NULL) 
		 {
			$el3 = $doc->createElement ( "ind" . STRING_UNDERSCORE . $i );
			$el3->setAttribute ( "type", "interface" );
			$el3->setAttribute ( "id", $i );
			$el4 = $doc->createCDATASection ( $valItemEl );
			$el5 = $el3->appendChild ( $el4 );
			$el3 = $el2->appendChild ( $el3 );
		 }
		}
	 }
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "containerBottomStyle" );
	 $el2->setAttribute ( "type", "scalar" );
	 $el2->setAttribute ( "id", "@containerBottomStyle" );
	 $el3 = $doc->createCDATASection ( $_POST ["bottom_style"] );
	 $el3 = $el2->appendChild ( $el3 );
	 $el4 = $root->appendChild ( $el2 );
	 $el2 = $doc->createElement ( "ind" . STRING_UNDERSCORE . "interfacesContainerBottom" );
	 $el2->setAttribute ( "type", "container" );
	 $el2->setAttribute ( "id", "interfacesContainerBottom" );
	 $el2 = $root->appendChild ( $el2 );
	 $val = $_POST ["bottom_container"];
	 if ($val != STRING_NULL) 
	 {
		$valItems = explode ( STRING_SEMICOLON, $val );
		$num = count ( $valItems );
		for($i = 0; $i <= $num - 1; $i ++) 
		{
		 $valItemEl = $valItems [$i];
		 if (trim ( $valItemEl ) != STRING_NULL) 
		 {
			$el3 = $doc->createElement ( "ind" . STRING_UNDERSCORE . $i );
			$el3->setAttribute ( "type", "interface" );
			$el3->setAttribute ( "id", $i );
			$el4 = $doc->createCDATASection ( $valItemEl );
			$el5 = $el3->appendChild ( $el4 );
			$el3 = $el2->appendChild ( $el3 );
		 }
	  }
	 }
  }
}


class SaveLayout_factory implements Factory_8
{
	Use Creator;
	
	private $doc = null;
	private $root =null;
	
	function __construct(\DOMDocument $actDoc, \DOMElement $actRoot)
	{
		$this->setDoc($actDoc);
		$this->setRoot($actRoot);
	}
	
	function setDoc(\DOMDocument $actDoc)
	{
	 $this->doc = $actDoc;
	}
	
	function getDoc()
	{
	 return $this->doc;
	}
	
	function setRoot(\DOMElement $actRoot)
	{
	 $this->root = $actRoot;
	}
	
	function getRoot()
	{
	 return $this->root;
	}	
  	
	function create(string $actIntType):object
	{
       $doc = $this->getDoc();
        $root = $this->getRoot();	
		
		if($actIntType==Interfaces_info::INT_SIMPLE_LAYOUT)
		{
	   $obj = Creator::create("SaveLayout_int_simple_layout",STRING_NULL,$doc,$root);
		}
		elseif($actIntType==Interfaces_info::INT_TWO_COLUMNS_LAYOUT)
		{
	   $obj = Creator::create("SaveLayout_two_columns_layout",STRING_NULL,$doc,$root);
		}
		elseif($actIntType==Interfaces_info::INT_THREE_COLUMNS_LAYOUT)
		{
	   $obj = Creator::create("SaveLayout_three_columns_layout",STRING_NULL,$doc,$root);
		}
		elseif($actIntType==Interfaces_info::INT_TB_LAYOUT)
		{
	   $obj = Creator::create("SaveLayout_int_tb_layout",STRING_NULL,$doc,$root);
		}
		elseif($actIntType==Interfaces_info::INT_TB_SIMPLE_LAYOUT)
		{
     $obj = Creator::create("SaveLayout_int_tb_simple_layout",STRING_NULL,$doc,$root);               			
		}
     
    return $obj; 
	}
	
}

?>