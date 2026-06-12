<?
namespace Cheope_ns\fw;
require_once("Factory_6.int.php");
require_once("db_item.const.php");
require_once("html.const.php");
//require_once("Html_writer.class.php");
require_once("Executable.int.php");
require_once("Creator.tra.php");

abstract class putInputCtrl_base implements Executable
{
	protected $name=STRING_NULL;
	protected $value; 
  protected $tabIndex;
  protected $onChange=STRING_NULL;
  protected $onClick=STRING_NULL;
  	
	function __construct(Html_writer $actHtmlWriter,
	string $actName,string|int|bool|array $actValue,
int|string $actTabIndex,
 string $actOnChange,
 string $actOnClick)
	{
	$this->setHtmlWriter($actHtmlWriter);
 	$this->setName($actName);
 	$this->setValue($actValue);
 	$this->setTabIndex($actTabIndex);
 	$this->setOnChange($actOnChange);
 	$this->setOnClick($actOnClick);
	}
	
 function setName(string $actName):void
 {
 	$this->name=$actName;
 }
 
 function getName():string
 {
 	return $this->name;
 }

 function setValue(string|int|bool|array $actValue):void
 {
 	$this->value=$actValue;
 }
 
 function getValue():string|int|bool|array
 {
 	return $this->value;
 }

 function setTabIndex(int|string $actTabIndex):void
 {
 	$this->tabIndex=$actTabIndex;
 }
 
 function getTabIndex():int|string
 {
 	return $this->tabIndex;
 } 
 
 function setHtmlWriter(Html_writer $actHtmlWriter):void
 {
 	$this->htmlWriter=$actHtmlWriter;
 }
 
 function getHtmlWriter():Html_writer
 {
 	return $this->htmlWriter;
 } 
 
 function setOnChange(string $actOnChange):void
 {
 	$this->onChange=$actOnChange;
 }
 
 function getOnChange():string
 {
 	return $this->onChange;
 } 
 
 function setOnClick(string $actOnClick):void
 {
 	$this->onClick=$actOnClick;
 }
 
 function getOnClick():string
 {
 	return $this->onClick;
 } 

	
	abstract function exec():void;
} 

class PutInputCtrl_atomic extends putInputCtrl_base
{
	private $length;
	private $stop;
	private $type=STRING_NULL;
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue,
   $actTabIndex,
   string $actOnChange,
   string $actOnClick)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue,
   $actTabIndex,
   $actOnChange,$actOnClick);
	}
	
  function setType(string $actType):void
  {
 	 $this->type=$actType;
  }
 
  function getType():string
  {
 	 return $this->type;
  } 
	
 function setLength(string|int $actLength):void
 {
 	$this->length=$actLength;
 }
 
 function getLength():string|int
 {
 	return $this->length;
 }
 
 function setStop(string|int $actStop):void
 {
 	$this->stop=$actStop;
 }
 
 function getStop():string|int
 {
 	return $this->stop;
 }  
	
	function exec():void
	{
		$type = $this->getType();
		$name = $this->getName();
		$value = $this->getValue();
		$value = (is_array($value)? current($value) : $value);
		$length = $this->getLength();
		$stop = $this->getStop();
		$tabIndex = $this->getTabIndex();
		$onChange = $this->getOnChange();
		$onClick = $this->getOnClick();
		$htmlWriter = $this->getHtmlWriter();
		
	  if(($type==FIELD_TYPE_INTEGER) ||($type==FIELD_TYPE_FLOAT) || 
	  ($type==FIELD_TYPE_STRING) ||
    ($type==FIELD_TYPE_DATE) || ($type==FIELD_TYPE_IP))
    {	   
	   $htmlWriter->putInputTag($name,$name,STRING_NULL,STRING_NULL,
	   $value,INPUT_TYPE_TEXT,STRING_NULL,
	   $length,$stop,$tabIndex,$onChange,$onClick);
    }
    elseif($type==FIELD_TYPE_BOOLEAN)
    {
   	 $htmlWriter->putInputTag($name . VAR_SEP . "checkbox",
   	 $name . VAR_SEP . "checkbox",STRING_NULL,STRING_NULL,
   	 $value,INPUT_TYPE_CHECKBOX,(($value!=0)||($value!="0"))?(1):(0),
   	 $length,0,$tabIndex,$onChange,"var idVal='" . $name . 
   	 "';var el=document.getElementById(idVal);if(this.checked){el.value=1;}else{el.value=0}");
     $htmlWriter->putInputTag($name,$name,STRING_NULL,STRING_NULL,$value,INPUT_TYPE_HIDDEN,0,$length,0,
     $tabIndex,STRING_NULL,STRING_NULL);
    }
	  elseif($type==FIELD_TYPE_BIG_STRING)
    {
     $numRows = round($length / TEXTAREA_NUM_COLS);
     $htmlWriter->putTextAreaTag($name,$name,STRING_NULL,STRING_NULL,
     $value,$numRows,TEXTAREA_NUM_COLS,
     $tabIndex,$onChange,$onClick);
    }
	  else
	  {
	   $htmlWriter->putInputTag($name,$name,STRING_NULL,STRING_NULL,
	   $value,INPUT_TYPE_TEXT,STRING_NULL,
	   $length,$stop,$tabIndex,$onChange,$onClick);
	  }
	}
}

class PutInputCtrl_radio extends putInputCtrl_base
{
	const ERROR_0="PutInputCtrl_radio:Incongruenza fra tipo di dati e dominio.";
	
	private $dataSource=array();
	private $op=STRING_NULL;
	private $selectedItem; 	

	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue,
   $actTabIndex,
   string $actOnChange,string $actOnClick)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue,
   $actTabIndex,
   $actOnChange,$actOnClick);
	}
	
	function getDataSource():array
	{
		return $this->dataSource;
	}
	
	function setDataSource(array $actDataSource):void
	{
		$this->dataSource = $actDataSource;
	}
	
  function setOp(string $actOp):void
  {
 	 $this->op=$actOp;
  }
 
  function getOp():string
  {
 	 return $this->op;
  }	
  
  function setSelectedItem(int|string $actSelectedItem):void
  {
 	 $this->selectedItem=$actSelectedItem;
  }
 
  function getSelectedItem():int|string
  {
 	 return $this->selectedItem;
  }
	
	function exec():void
	{
		$name = $this->getName();
		$value = $this->getValue();
		$tabIndex = $this->getTabIndex();
		$onChange = $this->getOnChange();
		$onClick = $this->getOnClick();
		$htmlWriter = $this->getHtmlWriter();
		$selectedItem = $this->getSelectedItem();
		
 	  if(is_array($value))
 	  {
 	  /* $num = count($value);
 	   $op = $this->getOp();
 	   $getValue = false;
 	   if($op==OP_MODIFICA)
 	   {
 	 	  $dataSource = $this->getDataSource();
 	 	  if(is_array($dataSource) && isset($dataSource[$name]) && (! is_array($dataSource[$name])))
 	 	  {
 	 	   $selectedItem = $dataSource[$name];
 	 	  // $getValue = true;
 	 	  }
 	 	  ///else
 	 	  // $getValue = false;
 	   }*/
 	   foreach($value as $ind=>$val)
 	   {
 	 	  $htmlWriter->putDivOpenTag($ind . VAR_SEP . "radio" . VAR_SEP . "id",
 	 	  "float:left;","radio_item");
      $htmlWriter->putSpanOpenTag();
      $htmlWriter->put($ind);
      $htmlWriter->put(SPAN_CLOSE_TAG);
      if($selectedItem==$val)
       $htmlWriter->putInputTag($name . VAR_SEP . $ind,
       $name,STRING_NULL,STRING_NULL,
       $val,INPUT_TYPE_RADIO,1 ,STRING_NULL,STRING_NULL,
       $tabIndex,$onChange,$onClick);
      else
       $htmlWriter->putInputTag($name . VAR_SEP . $ind,
       $name,STRING_NULL,STRING_NULL,
       $val,INPUT_TYPE_RADIO,0 ,STRING_NULL,STRING_NULL,
       $tabIndex,$onChange,$onClick);     
       $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
     }
    }
    else
     die(self::ERROR_0);
	}
}

class PutInputCtrl_atomic_static extends putInputCtrl_base
{
	private $type=STRING_NULL;
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue,
   int|string $actTabIndex,
   string $actOnChange,string $actOnClick)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue,
   $actTabIndex,
   $actOnChange,$actOnClick);
	}
  
  function setType(string $actType):void
  {
 	 $this->type=$actType;
  }
 
  function getType():string
  {
 	 return $this->type;
  } 
	
	function exec():void
	{
		$type = $this->getType();
		$name = $this->getName();
		$value = $this->getValue();
		$value = (is_array($value)? current($value) : $value);
		$tabIndex = $this->getTabIndex();
		$onChange = $this->getOnChange();
		$onClick = $this->getOnClick();
		$htmlWriter = $this->getHtmlWriter();
    if($type==FIELD_TYPE_BOOLEAN)
    {
     if(($value != 0)||($value != "0"))
      $htmlWriter->putInputTag($name,$name,STRING_NULL,STRING_NULL,
      1,INPUT_TYPE_CHECKBOX,0,
      STRING_NULL,STRING_NULL,$tabIndex,$onChange,$onClick);
     else
      $htmlWriter->putInputTag($name,$name,STRING_NULL,STRING_NULL,
      0,INPUT_TYPE_CHECKBOX,0,
      STRING_NULL,STRING_NULL,$tabIndex,$onChange,$onClick);    
    }
    else 	
     $htmlWriter->putGenericHtmlString($value);		
  }
}

class PutInputCtrl_password extends putInputCtrl_base
{
	private $length;
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue,
   int|string $actTabIndex,
   string $actOnChange,string $actOnClick)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue,
   $actTabIndex,
   $actOnChange,$actOnClick);
	}
	
  function setLength(string|int $actLength):void
  {
 	 $this->length=$actLength;
  }
 
  function getLength():string|int
  {
 	 return $this->length;
  } 
	
	function exec():void
	{
		$name = $this->getName();
		$value = $this->getValue();
		$value = (is_array($value)? current($value) : $value);
		$length = $this->getLength();
		$tabIndex = $this->getTabIndex();
		$onChange = $this->getOnChange();
		$onClick = $this->getOnClick();
		$htmlWriter = $this->getHtmlWriter();
    $htmlWriter->putInputTag($name,$name,STRING_NULL,STRING_NULL,$value,
    INPUT_TYPE_PASSWORD,STRING_NULL,$length,STRING_NULL,$tabIndex,
    $onChange,$onClick);		
  }
}

class PutInputCtrl_file extends putInputCtrl_base
{
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue,
   string|int $actTabIndex,
   string $actOnChange,string $actOnClick)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue,
   $actTabIndex,
   $actOnChange,$actOnClick);
	}
	
	function exec():void
	{
		$name = $this->getName();
		$value = $this->getValue();
		$value = (is_array($value)? current($value) : $value);
		$tabIndex = $this->getTabIndex();
		$onChange = $this->getOnChange();
		$onClick = $this->getOnClick();
		$htmlWriter = $this->getHtmlWriter();
    $htmlWriter->putInputTag($name,$name,STRING_NULL,STRING_NULL,
    $value,INPUT_TYPE_FILE,
    STRING_NULL,STRING_NULL,STRING_NULL,$tabIndex,$onChange,$onClick);	
  }
}

class PutInputCtrl_hidden extends putInputCtrl_base
{
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue,
   string|int $actTabIndex,
   string $actOnChange,string $actOnClick)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue,
   $actTabIndex,
   $actOnChange,$actOnClick);
	}
	
	function exec():void
	{
		$name = $this->getName();
		$value = $this->getValue();
		$value = (is_array($value)? current($value) : $value);
		$tabIndex = $this->getTabIndex();
		$onChange = $this->getOnChange();
		$onClick = $this->getOnClick();
		$htmlWriter = $this->getHtmlWriter();
    $htmlWriter->putInputTag($name,$name,STRING_NULL,STRING_NULL,
    $value,INPUT_TYPE_HIDDEN,
    STRING_NULL,STRING_NULL,STRING_NULL,$tabIndex,$onChange,$onClick);	  
  }
}

class PutInputCtrl_set extends putInputCtrl_base
{
	private $length;
	private $selectedItem=0;
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue,
   string|int $actTabIndex,
   string $actOnChange,string $actOnClick)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue,
   $actTabIndex,
   $actOnChange,$actOnClick);
	}
	
  function setSelectedItem(int|string $actSelectedItem):void
  {
 	 $this->selectedItem=$actSelectedItem;
  }
 
  function getSelectedItem():int|string
  {
 	 return $this->selectedItem;
  } 
	
  function setLength(int|string $actLength):void
  {
 	 $this->length=$actLength;
  }
 
  function getLength():int|string
  {
 	 return $this->length;
  } 
	
	function exec():void
	{
		$name = $this->getName();
		$value = $this->getValue();
		$length = $this->getLength();
		$tabIndex = $this->getTabIndex();
		$onChange = $this->getOnChange();
		$onClick = $this->getOnClick();
		$htmlWriter = $this->getHtmlWriter();
 	  $selectedItem = $this->getSelectedItem();
    $htmlWriter->putSelectTag($name,$name,STRING_NULL,STRING_NULL,
    $value,$tabIndex,0,$length,
    $selectedItem,$onChange,$onClick);	  
  }
}

class PutInputCtrl_multiple extends putInputCtrl_base
{
	private $length;
	private $selectedItem=0;
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue,
   string|int $actTabIndex,
   string $actOnChange,string $actOnClick)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue,
   $actTabIndex,
   $actOnChange,$actOnClick);
	}
	
  function setSelectedItem(int|string $actSelectedItem):void
  {
 	 $this->selectedItem=$actSelectedItem;
  }
 
  function getSelectedItem():int|string
  {
 	 return $this->selectedItem;
  } 
	
  function setLength(int|string $actLength):void
  {
 	 $this->length=$actLength;
  }
 
  function getLength():int|string
  {
 	 return $this->length;
  } 
	
	function exec():void
	{
		$name = $this->getName();
		$value = $this->getValue();
		$length = $this->getLength();
		$tabIndex = $this->getTabIndex();
		$onChange = $this->getOnChange();
		$onClick = $this->getOnClick();
		$htmlWriter = $this->getHtmlWriter();
 	  $selectedItem = $this->getSelectedItem();
    $htmlWriter->putSelectTag($name,$name,STRING_NULL,STRING_NULL,$value,$tabIndex,1,$length,
    $selectedItem,$onChange,$onClick);	  
  }
}

class PutInputCtrl_check extends putInputCtrl_base
{
 	private $length;
//	private $selectedItem; 

  function setLength(int|string $actLength):void
  {
 	 $this->length=$actLength;
  }
 
  function getLength():int|string
  {
 	 return $this->length;
  } 
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue,
   string|int $actTabIndex,
   string $actOnChange,string $actOnClick)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue,
   $actTabIndex,
   $actOnChange,$actOnClick);
	}
		
	function exec():void
	{
		$name = $this->getName();
		$value = $this->getValue();
		$value = (is_array($value)? current($value) : $value);
		$tabIndex = $this->getTabIndex();
		$onChange = $this->getOnChange();
		$onClick = $this->getOnClick();
		$htmlWriter = $this->getHtmlWriter();
 	//  $selectedItem = $this->getSelectedItem();
    if((($value != 0)||($value != "0"))&&($value!=STRING_NULL))
     $htmlWriter->putInputTag($name,$name,STRING_NULL,STRING_NULL,
     1,INPUT_TYPE_CHECKBOX,1,
     STRING_NULL,0,$tabIndex,$onChange,$onClick);
    else
     $htmlWriter->putInputTag($name,$name,STRING_NULL,STRING_NULL,
     0,INPUT_TYPE_CHECKBOX,0,
     STRING_NULL,0,$tabIndex,$onChange,$onClick);     	 
  }
}


class PutInputCtrl_factory implements Factory_6
{
 use Creator;
 
 const ERROR_0="PutInputCtrl_factory:Incongruenza fra tipo di dati e dominio."; 
 
 private $name=STRING_NULL;
 private $value=STRING_NULL;
 private $type=STRING_NULL;
 private $length;
 private $stop;
 private $tabIndex;
 private $selectedItem;
 private $dataSource=array();
 private $op=STRING_NULL;
 private $onChange=STRING_NULL;
 private $onClick=STRING_NULL;
 
 function __construct(string $actName,array|string|int|bool $actValue,
 string $actType,int|string $actLength,
 int|string $actStop,int|string $actTabIndex,
 int|string $actSelectedItem,
 array $actDataSource,string $actOp,
 string $actOnChange,string $actOnClick)
 {
 	$this->setName($actName);
 	$this->setValue($actValue);
 	$this->setType($actType);
 	$this->setLength($actLength);
 	$this->setStop($actStop);
 	$this->setTabIndex($actTabIndex);
 	$this->setSelectedItem($actSelectedItem);
 	$this->setDataSource($actDataSource);
 	$this->setOp($actOp);
 	$this->setOnChange($actOnChange);
 	$this->setOnClick($actOnClick);
 }
 
 function setName(string $actName):void
 {
 	$this->name=$actName;
 }
 
 function getName():string
 {
 	return $this->name;
 }

 function setValue(array|string|int|bool $actValue):void
 {
 	$this->value=$actValue;
 }
 
 function getValue():array|string|int|bool
 {
 	return $this->value;
 } 

 function setType(string $actType):void
 {
 	$this->type=$actType;
 }
 
 function getType():string
 {
 	return $this->type;
 } 
 
 function setLength(int|string $actLength):void
 {
 	$this->length=$actLength;
 }
 
 function getLength():string|int
 {
 	return $this->length;
 } 

 function setStop(string|int $actStop):void
 {
 	$this->stop=$actStop;
 }
 
 function getStop():string|int
 {
 	return $this->stop;
 } 

 function setTabIndex(string|int $actTabIndex):void
 {
 	$this->tabIndex=$actTabIndex;
 }
 
 function getTabIndex():string|int
 {
 	return $this->tabIndex;
 } 
 
 function setSelectedItem(string|int $actSelectedItem):void
 {
 	$this->selectedItem=$actSelectedItem;
 }
 
 function getSelectedItem():string|int
 {
 	return $this->selectedItem;
 } 
 
 function setDataSource(array $actDataSource):void
 {
 	$this->dataSource=$actDataSource;
 }
 
 function getDataSource():array
 {
 	return $this->dataSource;
 } 
 
 function setOp(string $actOp):void
 {
 	$this->op=$actOp;
 }
 
 function getOp():string
 {
 	return $this->op;
 } 
 
 function setOnChange(string $actOnChange):void
 {
 	$this->onChange=$actOnChange;
 }
 
 function getOnChange():string
 {
 	return $this->onChange;
 } 
 
 function setOnClick(string $actOnClick):void
 {
 	$this->onClick=$actOnClick;
 }
 
 function getOnClick():string
 {
 	return $this->onClick;
 } 
 
 function create(string $actDomain,Html_writer $actHtmlWriter):object
 {
 	$name=$this->getName();
 	$value=$this->getValue();
 	$type=$this->getType();
 	$length=$this->getLength();
 	$stop=$this->getStop();
 	$tabIndex=$this->getTabIndex();
 	$selectedItem=$this->getSelectedItem();
 	$dataSource=$this->getDataSource();
 	$op=$this->getOp();
 	$onChange=$this->getOnChange();
 	$onClick=$this->getOnClick();
 	if($actDomain==Int_domain::FIELD_DOMAIN_ATOMIC)
 	{
 		$obj = Creator::create("PutInputCtrl_atomic",STRING_NULL,
 		$actHtmlWriter,$name,
 		$value,$tabIndex,$onChange,$onClick);
 		$obj->setType($type);
 		$obj->setLength($length);
 		$obj->setStop($stop);
 	}
 	elseif($actDomain==Int_domain::FIELD_DOMAIN_RADIO)
 	{
 		$obj = Creator::create("PutInputCtrl_radio",STRING_NULL,
 		$actHtmlWriter,$name,
 		$value,$tabIndex,$onChange,$onClick);
 		$obj->setOp($op);
 		$obj->setDataSource($dataSource);
 		$obj->setSelectedItem($selectedItem);
 	}
 	elseif($actDomain==Int_domain::FIELD_DOMAIN_ATOMIC_STATIC)
 	{
 		$obj = Creator::create("PutInputCtrl_atomic_static",STRING_NULL,
 		$actHtmlWriter,$name,
 		$value,$tabIndex,$onChange,$onClick);
 		$obj->setType($type);
 	}
 	elseif($actDomain==Int_domain::FIELD_DOMAIN_PASSWORD)
 	{
 		$obj = Creator::create("PutInputCtrl_password",STRING_NULL,
 		$actHtmlWriter,$name,
 		$value,$tabIndex,$onChange,$onClick);
 		$obj->setLength($length);
 	}
 	elseif($actDomain==Int_domain::FIELD_DOMAIN_FILE)
 	{
 		$obj = Creator::create("PutInputCtrl_file",STRING_NULL,
 		$actHtmlWriter,$name,
 		$value,$tabIndex,$onChange,$onClick);
 	}
 	elseif($actDomain==Int_domain::FIELD_DOMAIN_HIDDEN)
 	{
 		$obj = Creator::create("PutInputCtrl_hidden",STRING_NULL,
 		$actHtmlWriter,$name,
 		$value,$tabIndex,$onChange,$onClick);
 	}
  elseif(($actDomain==Int_domain::FIELD_DOMAIN_SET)||
  ($actDomain==Int_domain::FIELD_DOMAIN_TABLE)||
  ($actDomain==Int_domain::FIELD_DOMAIN_TABLE_NO_LOOKUP))
 	{
 		$obj = Creator::create("PutInputCtrl_set",STRING_NULL,
 		$actHtmlWriter,$name,
 		$value,$tabIndex,$onChange,$onClick);
 		$obj->setLength($length);
 		$obj->setSelectedItem($selectedItem);
 	}
  elseif ($actDomain==Int_domain::FIELD_DOMAIN_MULTIPLE) 	
  {
  	$obj = Creator::create("PutInputCtrl_multiple",STRING_NULL,
  	$actHtmlWriter,$name,
 		$value,$tabIndex,$onChange,$onClick);
 		$obj->setLength($length);
 		$obj->setSelectedItem($selectedItem);
 	}
  elseif ($actDomain==Int_domain::FIELD_DOMAIN_CHECK) 	
  {
  	$obj = Creator::create("PutInputCtrl_check",STRING_NULL,
  	$actHtmlWriter,$name,
 		$value,$tabIndex,$onChange,$onClick);
 		$obj->setLength($length);
 	//	$obj->setSelectedItem($selectedItem);
 	}
 	else
 	{
 	 die(self::ERROR_0);
 	}
 	return $obj;
 }
}

?>