<?
namespace Cheope_ns\fw;
require_once("db_item.const.php");
require_once("html.const.php");
//require_once("Html_writer.class.php");
require_once("Factory_6.int.php");
require_once("Executable.int.php");
require_once("Creator.tra.php");

abstract class putDojoInputCtrl_base implements Executable    
{
	protected $name=STRING_NULL;
	protected $value=STRING_NULL; 
  	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue)
	{
	 $this->setHtmlWriter($actHtmlWriter);
 	 $this->setName($actName);
 	 $this->setValue($actValue);
	}
	
 function setName(string $actName)
 {
 	$this->name=$actName;
 }
 
 function getName()
 {
 	return $this->name;
 }

 function setValue(array|string|int|bool $actValue)
 {
 	$this->value=$actValue;
 }
 
 function getValue():array|string|int|bool
 {
 	return $this->value;
 }
 
 function setHtmlWriter(Html_writer $actHtmlWriter)
 {
 	$this->htmlWriter=$actHtmlWriter;
 }
 
 function getHtmlWriter():Html_writer
 {
 	return $this->htmlWriter;
 } 
	
	abstract function exec():void;
} 

class putDojoInputCtrl_atomic extends putDojoInputCtrl_base
{
	private $length;
	private $stop;
	private $type = STRING_NULL;
	private $style = STRING_NULL;
	private $hint = STRING_NULL;
	private $toolTip = STRING_NULL;
	private $events = STRING_NULL;
	private $regexp = STRING_NULL;
	private $defaultValue = STRING_NULL;
	private $isMandatory = false;
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue)
	{
		parent::__construct($actHtmlWriter,$actName,$actValue);
	}
	
  function setType(string $actType):void
  {
 	 $this->type=$actType;
  }
 
  function getType():string
  {
 	 return $this->type;
  } 
  
  function setStyle(string $actStyle):void
  {
 	 $this->style=$actStyle;
  }
 
  function getStyle():string
  {
 	 return $this->style;
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
 
 function getHint():string
 {
 	return $this->hint;
 }  
 
  function setHint(string $actHint):void
 {
 	$this->hint=$actHint;
 }
 
 function getToolTip():string
 {
 	return $this->toolTip;
 }  
 
  function setToolTip(string $actToolTip):void
 {
 	$this->toolTip=$actToolTip;
 }
 
 function getEvents():array
 {
 	return $this->events;
 }  
 
  function setEvents(array $actEvents):void
 {
 	$this->events=$actEvents;
 }
 
 function getRegexp():string
 {
 	return $this->regexp;
 }  
 
 function setRegexp(string $actRegexp):void
 {
 	$this->regexp=$actRegexp;
 }
 
  function getDefaultValue():string|int
 {
 	return $this->defaultValue;
 }  
 
 function setDefaultValue(string|int $actDefaultValue):void
 {
 	$this->defaultValue=$actDefaultValue;
 }
 
 function getIsMandatory():bool
 {
 	return $this->isMandatory;
 }  
 
 function setIsMandatory(bool $actIsMandatory):void
 {
 	$this->isMandatory=$actIsMandatory;
 }
	
	function exec():void
	{		
		$name = $this->getName();
		$value = $this->getValue();
	  $style = $this->getStyle();
	  $type = $this->getType();
		$length = $this->getLength();
		$stop = $this->getStop();
		$hint = $this->getHint();
		$toolTip = $this->getToolTip();
		$events = $this->getEvents();
		$regexp = $this->getRegexp();
		$defaultValue = $this->getDefaultValue();
		$isMandatory = $this->getIsMandatory();
		//echo "WWWW" . $isMandatory;
		$onChange = (isset($events["onChange"])?($events["onChange"]):(isset($events[0])?$events[0]:STRING_NULL));
		$onClick = (isset($events["onClick"])?($events["onClick"]):(isset($events[1])?$events[1]:STRING_NULL));
		$htmlWriter = $this->getHtmlWriter();
		
	  if(($type==FIELD_TYPE_INTEGER) ||($type==FIELD_TYPE_FLOAT) || 
	  ($type==FIELD_TYPE_STRING) ||
    ($type==FIELD_TYPE_DATE) || ($type==FIELD_TYPE_IP))
    {
	   $htmlWriter->putDojoValidationTextBox($name,$name,$style,(($value != STRING_NULL)?$value:$defaultValue),
	   $isMandatory,$stop,$hint,
	   STRING_NULL,$regexp,$toolTip,'',"right",$onChange);
    }
    elseif($type==FIELD_TYPE_BOOLEAN)
    {
     $htmlWriter->putDojoCheckBox($name . VAR_SEP . "checkbox",$name . VAR_SEP . "checkbox",$style,
     STRING_NULL,(($value!=0)||($value!="0"))?(1):(0),$toolTip,$onChange,"var idVal='" . $name . 
   	 "';var el=document.getElementById(idVal);if(this.checked){el.value=1;}else{el.value=0}");
     $htmlWriter->putInputTag($name,$name,STRING_NULL,STRING_NULL,
     (($value != STRING_NULL)?$value:$defaultValue),INPUT_TYPE_HIDDEN,0,$length,0,
     STRING_NULL,STRING_NULL,STRING_NULL);
    }
	  elseif($type==FIELD_TYPE_BIG_STRING)
    {
     $numRows = round($length / TEXTAREA_NUM_COLS);
     $htmlWriter->putDojoSimpleTextArea($name,$name,STRING_NULL,STRING_NULL,
     (($value != STRING_NULL)?$value:$defaultValue),$numRows,TEXTAREA_NUM_COLS,$toolTip,$onChange);
    }
	  else
	  {	  	
	   $htmlWriter->putDojoValidationTextBox($name,$name,$style,(($value != STRING_NULL)?$value:$defaultValue),
	   $isMandatory,$stop,$hint,
	   STRING_NULL,$regexp,$toolTip,'', "right", $onChange);
	  }
	}
}

class putDojoInputCtrl_radio extends putDojoInputCtrl_base
{
	const ERROR_0="PutInputCtrl_radio:Incongruenza fra tipo di dati e dominio.";
	
	private $style=STRING_NULL;
	private $events=array();
	private $defaultValue;
	private $labels=STRING_NULL;
	private $toolTip=STRING_NULL;
	private $direction=STRING_NULL;
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue);
	}
	
	function getDirection():string
	{
		return $this->direction;
	}
	
	function setDirection(string $actDirection):void
	{
		$this->direction = $actDirection;
	}
	
	function getStyle():string
	{
		return $this->style;
	}
	
	function setStyle(string $actStyle):void
	{
		$this->style = $actStyle;
	}

	function getEvents():array
	{
		return $this->events;
	}
	
	function setEvents(array $actEvents):void
	{
		$this->events = $actEvents;
	}
	
 function getToolTip():string
 {
 	return $this->toolTip;
 }  
 
  function setToolTip(string $actToolTip):void
 {
 	$this->toolTip=$actToolTip;
 }	

	function getDefaultValue():string|int
	{
		return $this->defaultValue;
	}
	
	function setDefaultValue(string|int $actDefaultValue)
	{
		$this->defaultValue = $actDefaultValue;
	}		
	
	function getLabels():array|string
	{
		return $this->labels;
	}
	
	function setLabels(string|array $actLabels)
	{
		$this->labels = $actLabels;
	}			
	
	function exec():void
	{
		$name = $this->getName();
		$value = $this->getValue();
		$style = $this->getStyle();
		$events = $this->getEvents();
		$toolTip = $this->getToolTip();
		$direction = $this->getDirection();
		$onChange = (isset($events["onChange"])?($events["onChange"]):(isset($events[0])?$events[0]:STRING_NULL));
		$onClick = (isset($events["onClick"])?($events["onClick"]):(isset($events[1])?$events[1]:STRING_NULL));		
		$defaultValue = $this->getDefaultValue();
		$labels = $this->getLabels();
		$htmlWriter = $this->getHtmlWriter();
 	  $htmlWriter->putDojoRadioButton($name,$name,$style,$value,
 	  $labels,$defaultValue,$toolTip,$direction,$onChange);
	}
}

class putDojoInputCtrl_atomic_static extends putDojoInputCtrl_base
{
	private $type = STRING_NULL;
	private $style = STRING_NULL;
  private $events = STRING_NULL;
  private $toolTip = STRING_NULL;
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue);
	}
	
	function getToolTip():string
	{
		return $this->toolTip;
	}
	
	function setToolTip(string $actToolTip):void
	{
		$this->toolTip = $actToolTip;
	}
	
  function setType(string $actType):void
  {
 	 $this->type=$actType;
  }
 
  function getType():string
  {
 	 return $this->type;
  } 
  
	function getStyle():string
	{
		return $this->style;
	}
	
	function setStyle(string $actStyle):void
	{
		$this->style = $actStyle;
	}

	function getEvents():array
	{
		return $this->events;
	}
	
	function setEvents(array $actEvents):void
	{
		$this->events = $actEvents;
	}	
	
	function exec():void
	{
		$style = $this->getStyle();
 		$events = $this->getEvents();
		$value = $this->getValue();
		$value = (is_array($value)? current($value) : $value);
 		$type = $this->getType();
 		$toolTip = $this->getToolTip();

		$onChange = (isset($events["onChange"])?($events["onChange"]):(isset($events[0])?$events[0]:STRING_NULL));
		$onClick = (isset($events["onClick"])?($events["onClick"]):(isset($events[1])?$events[1]:STRING_NULL));		
 		
		$htmlWriter = $this->getHtmlWriter();
    if($type==FIELD_TYPE_BOOLEAN)
    {
     if(($value != 0)||($value != "0"))
      $htmlWriter->putDojoCheckBox($name . VAR_SEP . "checkbox",$name . VAR_SEP . "checkbox",$style,
      1,(($value!=0)||($value!="0"))?(1):(0),$toolTip,$onChange,$onClick);
     else
      $htmlWriter->putDojoCheckBox($name . VAR_SEP . "checkbox",$name . VAR_SEP . "checkbox",$style,
      0,0,$toolTip,$onChange,$onClick);  
    }
    else 	
     $htmlWriter->putGenericHtmlString($value);		
  }
}

class putDojoInputCtrl_password extends putDojoInputCtrl_base
{
	private $length;
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue);
	}
	
 function setStyle(string $actStyle):void
 {
 	$this->style = $actStyle;
 }
 
 function getStyle():string
 {
 	return $this->style;
 }	
	
 function setLength(int|string $actLength):void
 {
 	$this->length=$actLength;
 }
 
 function getLength():int|string
 {
 	return $this->length;
 }
 
 function setStop(int|string $actStop)
 {
 	$this->stop=$actStop;
 }
 
 function getStop():string|int
 {
 	return $this->stop;
 } 
 
 function getToolTip():string
 {
 	return $this->toolTip;
 }  
 
  function setToolTip(string $actToolTip):void
 {
 	$this->toolTip=$actToolTip;
 } 
 
 function getEvents():array
 {
 	return $this->events;
 }  
 
 function setEvents(array $actEvents):void
 {
 	$this->events=$actEvents;
 }
 
 function getIsMandatory():bool
 {
 	return $this->isMandatory;
 }  
 
 function setIsMandatory(bool $actIsMandatory)
 {
 	$this->isMandatory=$actIsMandatory;
 }
	
	function exec():void
	{ 		
		$style = $this->getStyle();
		$name = $this->getName();
		$value = $this->getValue();
		$value = (is_array($value)? current($value) : $value);
		$length = $this->getLength();
		$stop = $this->getStop();
		$events = $this->getEvents();
		$isMandatory  = $this->getIsMandatory();
	  $toolTip = $this->getToolTip();
	  	
		$onChange = (isset($events["onChange"])?($events["onChange"]):(isset($events[0])?$events[0]:STRING_NULL));
		$onClick = (isset($events["onClick"])?($events["onClick"]):(isset($events[1])?$events[1]:STRING_NULL));		

		$htmlWriter = $this->getHtmlWriter();
    $htmlWriter->putDojoTextBox($name,$name,$style,$value, 
    INPUT_TYPE_PASSWORD,$isMandatory,$length,$stop,$toolTip,
    $onChange,$onClick);		
  }
}

class putDojoInputCtrl_file extends putDojoInputCtrl_base
{
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue);
	}
	
 function setStyle(string $actStyle):void
 {
 	$this->style = $actStyle;
 }
 
 function getStyle():string
 {
 	return $this->style;
 }	
	
 function setLength(string|int $actLength)
 {
 	$this->length=$actLength;
 }
 
 function getLength():int|string
 {
 	return $this->length;
 }
 
 function setStop(string|int $actStop)
 {
 	$this->stop=$actStop;
 }
 
 function getStop():int|string
 {
 	return $this->stop;
 }
 
 function getToolTip():string
 {
 	return $this->toolTip;
 }  
 
  function setToolTip(string $actToolTip):void
 {
 	$this->toolTip=$actToolTip;
 }   
 
 function getEvents():array
 {
 	return $this->events;
 }  
 
 function setEvents(array $actEvents):void
 {
 	$this->events=$actEvents;
 }
 
 function getIsMandatory():bool
 {
 	return $this->isMandatory;
 }  
 
 function setIsMandatory(bool $actIsMandatory)
 {
 	$this->isMandatory=$actIsMandatory;
 }

	
	function exec():void
	{
		$style = $this->getStyle();
		$name = $this->getName();
		$value = $this->getValue();
		$value = (is_array($value)? current($value) : $value);
		$length = $this->getLength();
		$stop = $this->getStop();
		$events = $this->getEvents();
		$isMandatory = $this->getIsMandatory();
	  $toolTip = $this->getToolTip();
		$onChange = (isset($events["onChange"])?($events["onChange"]):(isset($events[0])?$events[0]:STRING_NULL));
		$onClick = (isset($events["onClick"])?($events["onClick"]):(isset($events[1])?$events[1]:STRING_NULL));		
    $isMandatory = $this->getIsMandatory();
		$htmlWriter = $this->getHtmlWriter();
		
    $htmlWriter->putDojoTextBox($name,$name,$style,$value, 
    INPUT_TYPE_FILE,$isMandatory,$length,$stop,$toolTip,
    $onChange,$onClick);			
	
  }
}

class putDojoInputCtrl_hidden extends putDojoInputCtrl_base
{
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue);
	}
	
	function exec():void
	{
		$name = $this->getName();
		$value = $this->getValue();
		$value = (is_array($value)? current($value) : $value);
		$htmlWriter = $this->getHtmlWriter();
    $htmlWriter->putDojoTextBox($name,$name,STRING_NULL,$value, 
    INPUT_TYPE_HIDDEN,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
    STRING_NULL,STRING_NULL);
  }
}

class putDojoInputCtrl_set extends putDojoInputCtrl_base
{
	private $style = STRING_NULL;
	private $events = STRING_NULL;
	private $isMandatory;
	private $defaultValue;
	private $stop;
	private $hint = STRING_NULL;
	private $toolTip = STRING_NULL;
	private $regexp = STRING_NULL;
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue);
	}
	
	function getStyle():string
	{
		return $this->style;
	}
	
	function setStyle(string $actStyle):void
	{
		$this->style=$actStyle;
  }
  
	function getStop():string|int
	{
		return $this->stop;
	}
	
	function setStop(int|string $actStop):void
	{
		$this->stop=$actStop;
  }
  
	function getHint():string
	{
		return $this->hint;
	}
	
	function setHint(string $actHint):void
	{
		$this->hint=$actHint;
  }
  
 function getToolTip():string
 {
 	return $this->toolTip;
 }  
 
  function setToolTip(string $actToolTip):void
 {
 	$this->toolTip=$actToolTip;
 }  
  
	function getRegexp():string
	{
		return $this->regexp;
	}
	
	function setRegexp(string $actRegexp):void
	{
		$this->regexp=$actRegexp;
  }
   
  function setEvents(array $actEvents):void
  {
 	 $this->events=$actEvents;
  }
 
  function getEvents():array
  {
 	 return $this->events;
  } 
  
  function setDefaultValue(string|int $actDefaultValue):void
  {
 	 $this->defaultValue = $actDefaultValue;
  }
 
  function getDefaultValue():string|int
  {
 	 return $this->defaultValue;
  } 
  
  function setIsMandatory(bool $actIsMandatory)
  {
 	 $this->isMandatory = $actIsMandatory;
  }
 
  function getIsMandatory():bool
  {
 	 return $this->isMandatory;
  } 
	
	function exec():void
	{		
		$name = $this->getName();
		$value = $this->getValue();
		$style = $this->getStyle();
		$events = $this->getEvents();
		$isMandatory = $this->getIsMandatory();
		$stop = $this->getStop();
		$hint = $this->getHint();
		$toolTip = $this->getToolTip();
		$regexp = $this->getRegexp();
		$defaultValue = $this->getDefaultValue();
		$onChange = (isset($events["onChange"])?($events["onChange"]):(isset($events[0])?$events[0]:STRING_NULL));
		$onClick = (isset($events["onClick"])?($events["onClick"]):(isset($events[1])?$events[1]:STRING_NULL));		
		$htmlWriter = $this->getHtmlWriter();
    $htmlWriter->putDojoComboBox($name,$name,$style,
    $value,$stop,$hint,STRING_NULL,$toolTip,"right",$regexp,
    $defaultValue,$isMandatory,true,$onChange);	  
  }
}

class putDojoInputCtrl_multiple extends putDojoInputCtrl_base
{
	private $length;
	private $defaultValue;
	private $style=STRING_NULL;
	private $toolTip=STRING_NULL;
	private $events=array();
	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue);
	}
	
  function setDefaultValue(string|int $actDefaultValue):void
  {
 	 $this->defaultValue=$actDefaultValue;
  }
 
  function getDefaultValue():string|int
  {
 	 return $this->defaultValue;
  } 
 
  function getStyle():string
  {
 	 return $this->style;
  } 
  
  function setStyle(string $actStyle):void
  {
 	 $this->style=$actStyle;
  }
  
  function setLength(int|string $actLength)
  {
 	 $this->length=$actLength;
  }
 
  function getLength():string|int
  {
 	 return $this->length;
  }
	
 function getEvents():array
 {
 	return $this->events;
 }  
 
 function setEvents(array $actEvents):void
 {
 	$this->events=$actEvents;
 }
 
 function getToolTip():string
 {
 	return $this->toolTip;
 }  
 
  function setToolTip(string $actToolTip):void
 {
 	$this->toolTip=$actToolTip;
 }
	
	function exec():void
	{
		$name = $this->getName();
		$value = $this->getValue();
		$length = $this->getLength();
		$style= $this->getStyle();
		$events = $this->getEvents();
		$toolTip = $this->getToolTip();
		$onChange = (isset($events["onChange"])?($events["onChange"]):(isset($events[0])?$events[0]:STRING_NULL));
		$onClick = (isset($events["onClick"])?($events["onClick"]):(isset($events[1])?$events[1]:STRING_NULL));		
		$toolTip = $this->getToolTip();
		$htmlWriter = $this->getHtmlWriter();
    $defaultValue = $this->getDefaultValue();
    $htmlWriter->putDojoMultiSelect($name,$name,$value,$style,$defaultValue,$length,
    $toolTip,"right",$onClick,$onChange);	  
  }
}

class putDojoInputCtrl_check extends putDojoInputCtrl_base
{
 	private $length;
 	private $style=STRING_NULL;
 	private $events=array();
  private $toolTip=STRING_NULL;

  function setLength(int|string $actLength):void
  {
 	 $this->length=$actLength;
  }
 
  function getLength():string|int
  {
 	 return $this->length;
  } 
  
	function getStyle():string
	{
		return $this->style;
	}
	
	function setStyle(string $actStyle):void
	{
		$this->style=$actStyle;
	}
   
  function setEvents(array $actEvents):void
  {
 	 $this->events=$actEvents;
  }
 
  function getEvents():array
  {
 	 return $this->events;
  } 
  
 function getToolTip():string
 {
 	return $this->toolTip;
 }  
 
  function setToolTip(string $actToolTip):void
 {
 	$this->toolTip=$actToolTip;
 }
  	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue);
	}
		
	function exec():void
	{
		$name = $this->getName();
		$value = $this->getValue();
		$value = (is_array($value)? current($value) : $value);
		$events = $this->getEvents();
		$style = $this->getStyle();
		$toolTip = $this->getToolTip();
		$onChange = (isset($events["onChange"])?($events["onChange"]):(isset($events[0])?$events[0]:STRING_NULL));
		$onClick = (isset($events["onClick"])?($events["onClick"]):(isset($events[1])?$events[1]:STRING_NULL));		
		$htmlWriter = $this->getHtmlWriter();
    if((($value != 0)||($value != "0"))&&($value != STRING_NULL))
    {
     $htmlWriter->putDojoCheckBox($name,$name,$style,true,
     $value,$toolTip,$onChange,$onClick);  
    }
    else 
     $htmlWriter->putDojoCheckBox($name,$name,$style,false,
     $value,$toolTip,$onChange,$onClick); 	 
  }
}

class putDojoInputCtrl_none extends putDojoInputCtrl_base
{
  	
	function __construct(Html_writer $actHtmlWriter,string $actName,array|string|int|bool $actValue)
	{
	 parent::__construct($actHtmlWriter,$actName,$actValue);
	}
		
	function exec():void
	{
		$htmlWriter = $this->getHtmlWriter();
    $htmlWriter->putGenericHtmlString(STRING_NULL); 
  }
}


class putDojoInputCtrl_factory implements Factory_6
{
 const ERROR_0="PutDojoInputCtrl_factory:Incongruenza fra tipo di dati e dominio."; 

 private $name=STRING_NULL;
 private $value;
 private $type=STRING_NULL;
 private $style=STRING_NULL;
 private $length;
 private $stop;
 private $hint=STRING_NULL;
 private $toolTip=STRING_NULL;
 private $events=array();
 private $regexp=STRING_NULL;
 private $defaultValue;
 private $isMandatory;
 private $labels;
 private $direction=STRING_NULL;
 
 function __construct(string $actName,array|string|int|bool $actValue,
 string $actType,string $actStyle,int|string $actLength,int|string $actStop,
 string $actHint,
 string $actToolTip,array $actEvents,
 string $actRegexp,string|int $actDefaultValue,bool $actIsMandatory,
 array|string $actLabels,string $actDirection)
 {
 	$this->setName($actName);
 	$this->setValue($actValue);
 	$this->setType($actType);
 	$this->setStyle($actStyle);
 	$this->setLength($actLength);
 	$this->setStop($actStop);
 	$this->setHint($actHint);
 	$this->setToolTip($actToolTip);
 	$this->setEvents($actEvents);
 	$this->setRegexp($actRegexp);
 	$this->setDefaultValue($actDefaultValue);
 	$this->setIsMandatory($actIsMandatory);
 	$this->setLabels($actLabels);
 	$this->setDirection($actDirection);
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
 
 function setStyle(string $actStyle):void
 {
 	$this->style=$actStyle;
 }
 
 function getStyle():string
 {
 	return $this->style;
 } 
 
 function setLength(int|string $actLength):void
 {
 	$this->length=$actLength;
 }
 
 function getLength():string|int
 {
 	return $this->length;
 } 

 function setStop(int|string $actStop):void
 {
 	$this->stop=$actStop;
 }
 
 function getStop():string|int
 {
 	return $this->stop;
 } 

 function setHint(string $actHint):void
 {
 	$this->hint=$actHint;
 }
 
 function getHint():string
 {
 	return $this->hint;
 }
 
 function setToolTip(string $actToolTip):void
 {
 	$this->toolTip=$actToolTip;
 }
 
 function getToolTip():string
 {
 	return $this->toolTip;
 } 
 
 function setEvents(array $actEvents):void
 {
 	$this->events=$actEvents;
 }
 
 function getEvents():array
 {
 	return $this->events;
 } 
 
 function setRegexp(string $actRegexp):void
 {
 	$this->regexp=$actRegexp;
 }
 
 function getRegexp():string
 {
 	return $this->regexp;
 } 
 
 function setDefaultValue(string|int $actDefaultValue):void
 {
 	$this->defaultValue=$actDefaultValue;
 }
 
 function getDefaultValue():string|int
 {
 	return $this->defaultValue;
 } 
 
 function setIsMandatory(bool $actIsMandatory):void
 {
 	$this->isMandatory=$actIsMandatory;
 }
 
 function getIsMandatory():bool
 {
 	return $this->isMandatory;
 } 
 
 function setDirection(string $actDirection):void
 {
 	$this->direction=$actDirection;
 }
 
 function getDirection():string
 {
 	return $this->direction;
 } 
 
 function setLabels(array|string $actLabels):void
 {
 	$this->labels=$actLabels;
 }
 
 function getLabels():array|string
 {
 	return $this->labels;
 } 
 
 function create(string $actDomain,Html_writer $actHtmlWriter):object
 {
 	$name=$this->getName();
 	$value=$this->getValue();
 	$type=$this->getType();
 	$style=$this->getStyle();
 	$length=$this->getLength();
 	$stop=$this->getStop();
 	$hint=$this->getHint();
 	$toolTip=$this->getToolTip();
 	$events=$this->getEvents();
 	$regexp=$this->getRegexp();
 	$defaultValue=$this->getDefaultValue();
 	$isMandatory=$this->getIsMandatory();
 	$labels=$this->getLabels();
 	$direction=$this->getDirection();

 	if($actDomain==Int_domain::FIELD_DOMAIN_ATOMIC)
 	{
 		$obj = Creator::create("PutDojoInputCtrl_atomic",STRING_NULL,
 		$actHtmlWriter,$name,
 		$value);
 		$obj->setType($type);
 		$obj->setStyle($style);
 		$obj->setLength($length);
 		$obj->setStop($stop);
 		$obj->setHint($hint);
 		$obj->setToolTip($toolTip);
 		$obj->setEvents($events);
 		$obj->setRegexp($regexp);
 		$obj->setDefaultValue($defaultValue);
 		$obj->setIsMandatory($isMandatory);
 	}
 	elseif($actDomain==Int_domain::FIELD_DOMAIN_RADIO)
 	{
 		$obj = Creator::create("PutDojoInputCtrl_radio",STRING_NULL,
 		$actHtmlWriter,$name,
 		$value);
 		$obj->setStyle($style);
 		$obj->setEvents($events);
 		$obj->setDefaultValue($defaultValue);
 		$obj->setLabels($labels);
 		$obj->setToolTip($toolTip);
 		$obj->setDirection($direction);
 	}
 	elseif($actDomain==Int_domain::FIELD_DOMAIN_ATOMIC_STATIC)
 	{
 		$obj = Creator::create("PutDojoInputCtrl_atomic_static",STRING_NULL,
    $actHtmlWriter,$name,
 		$value);
 		$obj->setStyle($style);
 		$obj->setEvents($events);
 		$obj->setType($type);
 		$obj->setToolTip($toolTip);
 	}
 	elseif($actDomain==Int_domain::FIELD_DOMAIN_PASSWORD)
 	{
 		$obj = Creator::create("PutDojoInputCtrl_password",STRING_NULL,
 		$actHtmlWriter,$name,$value);
 		$obj->setStyle($style);
 		$obj->setLength($length);
 		$obj->setStop($stop);
 		$obj->setToolTip($toolTip);
 		$obj->setEvents($events);
 		$obj->setIsMandatory($isMandatory);
 	}
 	elseif($actDomain==Int_domain::FIELD_DOMAIN_FILE)
 	{
 		$obj = Creator::create("PutDojoInputCtrl_file",STRING_NULL,
 		$actHtmlWriter,$name,
 		$value);
 		$obj->setStyle($style);
 		$obj->setLength($length);
 		$obj->setStop($stop);
 		$obj->setToolTip($toolTip);
 		$obj->setEvents($events);
 		$obj->setIsMandatory($isMandatory);
 	}
 	elseif($actDomain==Int_domain::FIELD_DOMAIN_HIDDEN)
 	{
 		$obj = Creator::create("PutDojoInputCtrl_hidden",STRING_NULL,
 		$actHtmlWriter,$name,
 		$value);
 	}
  elseif(($actDomain==Int_domain::FIELD_DOMAIN_SET)||
  ($actDomain==Int_domain::FIELD_DOMAIN_TABLE)||
  ($actDomain==Int_domain::FIELD_DOMAIN_TABLE_NO_LOOKUP))
 	{
 		$obj = Creator::create("PutDojoInputCtrl_set",STRING_NULL,
 		$actHtmlWriter,$name,
 		$value);
 		$obj->setStyle($style);
 		$obj->setEvents($events);
 		$obj->setDefaultValue($defaultValue);
 		$obj->setStop($stop);
 		$obj->setHint($hint);
 		$obj->setToolTip($toolTip);
 		$obj->setRegexp($regexp);
 		$obj->setIsMandatory($isMandatory);
 	}
  elseif ($actDomain==Int_domain::FIELD_DOMAIN_MULTIPLE) 	
  {
  	$obj = Creator::create("PutDojoInputCtrl_multiple",STRING_NULL,
  	$actHtmlWriter,$name,
 		$value);
 		$obj->setStyle($style);
 		$obj->setLength($length);
 		$obj->setToolTip($toolTip);
 		$obj->setEvents($events);
 		$obj->setDefaultValue($defaultValue);
 	}
  elseif ($actDomain==Int_domain::FIELD_DOMAIN_CHECK) 	
  {
  	$obj = Creator::create("PutDojoInputCtrl_check",STRING_NULL,
  	$actHtmlWriter,$name,$value);
 		$obj->setStyle($style);
 		$obj->setLength($length);
 		$obj->setEvents($events);
 		$obj->setToolTip($toolTip);
 	}
  elseif ($actDomain==Int_domain::FIELD_DOMAIN_NONE) 	
  {
  	$obj = Creator::create("PutDojoInputCtrl_none",STRING_NULL,
  	$actHtmlWriter,$name,$value);
 	}
 	else
 	 die(self::ERROR_0);
 	return $obj;
 }
}

?>