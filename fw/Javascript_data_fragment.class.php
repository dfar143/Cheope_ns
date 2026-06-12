<?
namespace Cheope_ns\fw;
require_once("html.fun.php");
require_once("Html_data_interface.class.php");


//
// Frammento javascript parametrico sui dati
// Implementato tramite le interfacce javascript
//


class Javascript_data_fragment extends Html_data_interface
{
 
 const DUAL_JAVASCRIPT_INTERFACE_NAME = "JavascriptDataFragment";
 const DEFAULT_DATA_EXCHANGE_TYPE="text";
 const DEFAULT_ENABLE_INSERT_IN_CLIENT_CONTAINER = true;
 const DEFAULT_ENABLE_EXECUTE_ONLOAD = true;
 const DEFAULT_ADD_SLASH_TO_FIELD_VALUE = true;
 const DEFAULT_ENABLE_DATA_FROM_REMOTE = true;
 const DEFAULT_JAVASCRIPT_MODULE=JS_INTERFACES;
 
 private $hookId = STRING_NULL;
 private $javascriptFragment = STRING_NULL;
 private $dataExchangeType = self::DEFAULT_DATA_EXCHANGE_TYPE;
 private $enableInsertInClientContainer = self::DEFAULT_ENABLE_INSERT_IN_CLIENT_CONTAINER;
 private $enableExecuteOnLoad = self::DEFAULT_ENABLE_EXECUTE_ONLOAD;
 private $addSlashToFieldValue = self::DEFAULT_ADD_SLASH_TO_FIELD_VALUE;
 private $enableDataFromRemote = self::DEFAULT_ENABLE_DATA_FROM_REMOTE;
 private $ajaxOpPar=STRING_NULL;
 private $callBackFunPattern=STRING_NULL;
 static private $javascriptDataFragmentsTotNum=0;
 static $useJQuery = true;
 static $useDojo = true;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;  
 
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$javascriptDataFragmentsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$javascriptDataFragmentsTotNum - 1; 
 	parent::__construct(OBJ_NONE,$actOp,self::INT_JAVASCRIPT_DATA_FRAGMENT,$actNum);
  $this->setJavascriptModule(CLIENT_CODE_PATH . DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE);
 }
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$htmlWriter->putGenericHtmlString("//<!--" . chr(13));
 	$htmlWriter->putGenericHtmlString("if(interfacesContainer===undefined) interfacesContainer = interfaces.createInterfacesContainer();");	   
  if(($this->getEnableExecuteOnLoad())&&
 		($this->getEnableDataFromRemote()))
 	{
 	 $ajaxOp = $this->getOp();
 	 $htmlWriter->putGenericHtmlString("ajaxHandler.JAVASCRIPT_OP = '" . $ajaxOp . "';");
   $op = ucFirst($ajaxOp);
 	 $opFunction = "Op" . $op;
 	 $htmlWriter->putGenericHtmlString("ajaxHandler.addOp(new " . 
 	 $opFunction . "(ajaxHandler.JAVASCRIPT_OP));");
 	} 
 	$this->putData();
 	$htmlWriter->putGenericHtmlString("//-->");
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$javascriptDataFragmentsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$javascriptDataFragmentsTotNum=$actIntNum + 0;
 }
 
 function enableBootstrap():void
 {
 }
 
 function isStandard():bool
 {
 	return true;
 }
 
 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
 	$hookId = $this->getHookId();
 	$item1 = array("hookId"=>$hookId);
 	$serializer->loadItems($item1);	
 	$javascriptFragment = $this->getJavascriptFragment();
 	$item2 = array("javascriptFragment"=>$javascriptFragment);
 	$serializer->loadItems($item2);	
 	$dataExchangeType = $this->getDataExchangeType();
 	$item3 = array("dataExchangeType"=>$dataExchangeType);
 	$serializer->loadItems($item3);
 	$enableInsertInClientContainer = $this->getEnableInsertInClientContainer();
 	$item4 = array("enableInsertInClientContainer"=>$enableInsertInClientContainer);
 	$serializer->loadItems($item4);
 	$enableExecuteOnLoad = $this->getEnableExecuteOnLoad();
 	$item5 = array("enableExecuteOnLoad"=>$enableExecuteOnLoad);
 	$serializer->loadItems($item5);	
	$addSlashToFieldValue = $this->getAddSlashToFieldValue();
 	$item6 = array("addSlashToFieldValue"=>$addSlashToFieldValue);
 	$serializer->loadItems($item6);	
 	$enableDataFromRemote = $this->getEnableDataFromRemote();
 	$item7 = array("enableDataFromRemote"=>$enableDataFromRemote);
 	$serializer->loadItems($item7); 
 	$ajaxOpPar = $this->getAjaxOpPar();
 	$item8 = array("ajaxOpPar"=>$ajaxOpPar);
 	$serializer->loadItems($item8); 						
 }
 
 function setAjaxOpPar(string $actAjaxOpPar):void
 {
 	$this->ajaxOpPar = $actAjaxOpPar;
 }
 
 function getAjaxOpPar():string
 {
 	return $this->ajaxOpPar;
 }
 
 function getEnableDataFromRemote():bool
 {
 	if($this->enableDataFromRemote === STRING_NULL)
 	 return self::DEFAULT_ENABLE_DATA_FROM_REMOTE;
 	else
 	 return $this->enableDataFromRemote;
 }
 
 function setEnableDataFromRemote(bool $actEnableDatafromRemote):void
 {
 	$this->enableDataFromRemote = $actEnableDatafromRemote;
 }
 
 function getDataExchangeType():string
 {
 	if($this->dataExchangeType==STRING_NULL)
 	 return self::DEFAULT_DATA_EXCHANGE_TYPE;
 	else
 	 return $this->dataExchangeType;
 }
 
 function setDataExchangeType(string $actDataExchangeType):void
 {
 	$this->dataExchangeType = $actDataExchangeType;
 }
 
 function setHookId(string $actHookId):void
 {
 	$this->hookId = $actHookId;
 }
 
 function getHookId():string
 {
 	return $this->hookId;
 }
 
 function loadFragmentFromFile(string $actFileName):string
 {
 	$fileRows = file($actFileName);
 	$javascriptFragment = STRING_NULL;
 	foreach($fileRows as $fileRow)
 	{
 	 $javascriptFragment = $javascriptFragment . $fileRow;
 	}
 	$this->setJavascriptFragment($javascriptFragment);
 }
 
 function setJavascriptFragment(string $actJavascriptFragment):void
 {
 	$actJavascriptFragment = preg_replace("/[']/","\'",$actJavascriptFragment);
 	$this->javascriptFragment = $actJavascriptFragment;
 }
 
 function getJavascriptFragment():string
 {
 	return $this->javascriptFragment;
 }
 
 function setEnableInsertInClientContainer(bool $actEnableInsertInClientContainer):void
 {
 	$this->enableInsertInClientContainer = $actEnableInsertInClientContainer;
 }
 
 function getEnableInsertInClientContainer():bool
 {
 	if($this->enableInsertInClientContainer === STRING_NULL)
 	 return self::DEFAULT_ENABLE_INSERT_IN_CLIENT_CONTAINER;
 	else
 	 return $this->enableInsertInClientContainer;
 }
 
 function setEnableExecuteOnLoad(bool $actEnableExecuteOnLoad):void
 {
 	$this->enableExecuteOnLoad = $actEnableExecuteOnLoad;
 }
 
 function getEnableExecuteOnLoad():bool
 {
 	if($this->enableExecuteOnLoad === STRING_NULL)
 	 return self::DEFAULT_ENABLE_EXECUTE_ONLOAD;
 	else
 	 return $this->enableExecuteOnLoad;
 }
 
 function setAddSlashToFieldValue(bool $actAddSlash):void
 {
 	$this->addSlashToFieldValue = $actAddSlash;
 }
 
 function getAddSlashToFieldValue():bool
 {
 	if($this->addSlashToFieldValue == STRING_NULL)
 	 return self::DEFAULT_ADD_SLASH_TO_FIELD_VALUE;
 	else
 	 return $this->addSlashToFieldValue;
 } 
 
 function getDualInterfaceName():string
 {
  $op = $this->getOp();
  $javascriptIntefaceName = self::DUAL_JAVASCRIPT_INTERFACE_NAME . $op;
  return $javascriptIntefaceName;
 }
 
 function setCallBackFunPattern(string $actCallBackFunPattern):void
 {
 	$this->callBackFunPattern = $actCallBackFunPattern;
 }
 
 function getCallBackFunPattern():string
 {
 	return $this->callBackFunPattern;
 }
 
 function isContainer():bool
 {
  return false;
 }
 
 function getJavascriptInterfaceInstantationStr():string
 {
 	$fragment = $this->getJavascriptFragment();
 	$hookId = $this->getHookId();
 	$op = $this->getOp();
 	$num = $this->getNum();
 	$enableDataFromRemote = $this->getEnableDataFromRemote();
  $javascriptInterfaceName = $this->getDualInterfaceName();  
  $str1 = "var " . $javascriptInterfaceName . " = interfaces.createJavascriptDataFragment('" . 
  $op . "','" . $num . "');" . STRING_ESC_RETURN;
  $dataFields = $this->getDataFields();
  $str2Header = "new Array(";
  $str2Body = STRING_NULL;
  $num1 = count($dataFields);
  for($i=0;$i<=$num1-1;$i++)
  {
  	if($i==0)
  	 $str2Body .= "\"" . $dataFields[$i] . "\"";
    else
     $str2Body .= ",\"" . $dataFields[$i] . "\"";
  }
  $str2Footer = ")";
  $str2 = $str2Header . $str2Body . $str2Footer;
  
  //$str21 = "console.log('---------------1');console.log(" . $javascriptInterfaceName . STRING_POINT . "getDataFields($str2));console.log('---------------2');";
  
  $str3 = $javascriptInterfaceName . STRING_POINT . "setDataFields($str2);" . STRING_ESC_RETURN ;
  
  //$str31 = "console.log('---------------3');console.log(" . $javascriptInterfaceName . STRING_POINT . "getDataFields($str2));console.log('---------------4');";
  
  $str2 = STRING_NULL;
  
  $dataFieldsDomains = $this->getDataFieldsDomains();
  $str4Header = "new Array(";
  $str4Body = STRING_NULL;
  $num1 = count($dataFieldsDomains);
  for($i=0;$i<=$num1-1;$i++)
  {
  	if($i==0)
  	 $str4Body .= "\"" . $dataFieldsDomains[$i] . "\"";
    else
     $str4Body .= ",\"" . $dataFieldsDomains[$i] . "\"";
  }
  $str4Footer = ")";
  $str4 = $str4Header . $str4Body . $str4Footer;
  
  $str5 = $javascriptInterfaceName . STRING_POINT . "setDataFieldsDomains($str4);" . STRING_ESC_RETURN;
  $str4 = STRING_NULL;
  
  $dataFieldsDomainsValues = $this->getDataFieldsDomainsValues();
  $str6Header = "new Array(";
  $str6Body = STRING_NULL;
  $num1 = count($dataFieldsDomainsValues);
  for($i=0;$i<=$num1-1;$i++)
  {
  	if(is_array($dataFieldsDomainsValues[$i]))
  	{
  		$j=0;
  		$arrayStr = "new Array(";
  		foreach($dataFieldsDomainsValues[$i] as $ind=>$val)
  		{
  			if($j==0)
  			{
  			 if (is_string($val))
  			  $arrayStr .= "\"" . $val . "\"";
  			 elseif (is_numeric($val))
  			  $arrayStr .= $val;
  			}
  			else
  			{
  			 if (is_string($val))
  			  $arrayStr .= STRING_COMMA . "\"" . $val . "\",";
  			 elseif (is_numeric($val))
  			  $arrayStr .= STRING_COMMA . $val;
  			} 
  		}
  		$arrayStr .= ")";
  		$dataFieldsDomainsValuesStr = $arrayStr;
  	  if($i==0)
  	  {
  	   $str6Body .=  $dataFieldsDomainsValuesStr ;
      }
      else
      {
      $str6Body .= "," . $dataFieldsDomainsValuesStr;
      }  		
  	}
  	elseif($dataFieldsDomains[$i]==Int_domain::FIELD_DOMAIN_OBJ)
  	{
  		$dataFieldsDomainsValuesStr = $dataFieldsDomainsValues[$i]->getDualInterfaceName();
  	  if($i==0)
  	  {
  	   $str6Body .=  $dataFieldsDomainsValuesStr ;
      }
      else
      {
      $str6Body .= "," . $dataFieldsDomainsValuesStr;
      } 
  	}
  	elseif($dataFieldsDomains[$i]==Int_domain::FIELD_DOMAIN_FUNCTION)
  	{
  		$dataFieldsDomainsValuesStr = "\"" . $dataFieldsDomainsValues[$i]($dataFields[$i]) . "\"";
  	  if($i==0)
  	  {
  	   $str6Body .=  $dataFieldsDomainsValuesStr ;
      }
      else
      {
      $str6Body .= "," . $dataFieldsDomainsValuesStr;
      } 
  	}
  	else
  	{
  	 $dataFieldsDomainsValuesStr = $dataFieldsDomainsValues[$i];
     if($i==0)
  	 {
  	  $str6Body .= "\"" . $dataFieldsDomainsValuesStr . "\"";
     }
     else
     {
      $str6Body .= ",\"" . $dataFieldsDomainsValuesStr . "\"";
     }
    }
  }
  $str6Footer = ")";
  $str6 = $str6Header . $str6Body . $str6Footer;  
  
  $str7 = $javascriptInterfaceName . STRING_POINT . "setDataFieldsDomainsValues($str6);" . STRING_ESC_RETURN;
  $str71 = "console.log(" . $javascriptInterfaceName . ");" . STRING_ESC_RETURN;
  $str6=STRING_NULL;  
  $str8 = $javascriptInterfaceName . STRING_POINT . "setHookId('" . $hookId . "');" . STRING_ESC_RETURN;
  $str9 = $javascriptInterfaceName . STRING_POINT . "setJavascriptFragment('" . $fragment . "');" . STRING_ESC_RETURN;
  
  $addSlashToFieldValue = $this->getAddSlashToFieldValue();
  $addSlashToFieldValue = ($addSlashToFieldValue==true)?'true':'false'; 
  $str10 = $javascriptInterfaceName . STRING_POINT . "setAddSlashToFieldValue(" . $addSlashToFieldValue . ");" . STRING_ESC_RETURN;
  
  $str11 = "interfacesContainer.add(" .  $javascriptInterfaceName . ");" . STRING_ESC_RETURN;

  $dataExchangeType = $this->getDataExchangeType();
  $ajaxOpPar = ((($par=$this->getAjaxOpPar())==STRING_NULL)?STRING_NULL:$par);
  
  $callBackFunPattern = $this->getCallBackFunPattern();
  
  if($callBackFunPattern != STRING_NULL)
   $callBackFun1 = "function(){" .
   "ajaxHandler.synServerCall('" . AJAX_HANDLER_PAGE ."','" . $op . 
   "','" . $ajaxOpPar . "','" . $dataExchangeType . "',$callBackFunPattern);}";
  else
   $callBackFun1 = "function(){" .
   "ajaxHandler.synServerCall('" . AJAX_HANDLER_PAGE ."','" . $op . 
   "','" . $ajaxOpPar . "','" . $dataExchangeType . "');}";  
  
   $callBackFun2 = "function(){var int = interfacesContainer.getInterface('$op');" .
  "int.putData();}";
  
  $callBackFun = (($enableDataFromRemote==true)?($callBackFun1):($callBackFun2));  

  $str12 = "common.getEventStack().push($callBackFun);";
  $str = $str1 . $str2 . /*$str21 .*/ $str3 . /*$str31 .*/ $str4 . $str5 . $str6 . 
  $str7 . /*$str71 . */ $str8 . $str9 . $str10 . (($this->getEnableInsertInClientContainer())?$str11:STRING_NULL) .   
  (($this->getEnableExecuteOnLoad())?($str12):STRING_NULL); 

  return $str;
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 {
 	$htmlWriter = $this->getHtmlWriter();  
  $str = $this->getJavascriptInterfaceInstantationStr();
 	$htmlWriter->putGenericHtmlString($str);
 }
     
}

?>