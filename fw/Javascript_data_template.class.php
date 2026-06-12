<?
namespace Cheope_ns\fw;
require_once("html.fun.php");
require_once("Html_data_interface.class.php");


//
// Frammento html parametrico sui dati
// Implementato tramite le interfacce javascript
//

class Javascript_data_template extends Html_data_interface
{
 
 const DUAL_JAVASCRIPT_INTERFACE_NAME = self::INT_HTML_DATA_TEMPLATE;   
 const DEFAULT_DATA_EXCHANGE_TYPE="text";
 const DEFAULT_INHERIT_COUNT_FIELD_NAME="Count";
 const DEFAULT_JAVASCRIPT_MODULE=JS_INTERFACES;
 const DEFAULT_ENABLE_INSERT_IN_CLIENT_CONTAINER = true;
 const DEFAULT_ENABLE_EXECUTE_ONLOAD = true;
 const DEFAULT_ENABLE_DATA_FROM_REMOTE = true;
 const DEFAULT_EXEC_ONLY_ON_FULL_DATA_SOURCE = true;
 const ERROR_1 = "Javascript_data_template:Errore il nome di campo COUNT è riservato.";
  
 private $hookId = STRING_NULL;
 private $inheritCountFieldName = self::DEFAULT_INHERIT_COUNT_FIELD_NAME;
 private $javascriptTemplate=STRING_NULL;
 private $dataExchangeType=self::DEFAULT_DATA_EXCHANGE_TYPE;
 private $enableInsertInClientContainer=self::DEFAULT_ENABLE_INSERT_IN_CLIENT_CONTAINER;
 private $enableExecuteOnLoad=self::DEFAULT_ENABLE_EXECUTE_ONLOAD;
 private $ajaxOpPar=STRING_NULL;
 private $callBackPost=STRING_NULL;
 private $callBackFunPattern=STRING_NULL;
 private $enableDataFromRemote=self::DEFAULT_ENABLE_DATA_FROM_REMOTE;
 private $execOnlyOnFullDataSource=self::DEFAULT_EXEC_ONLY_ON_FULL_DATA_SOURCE;
 static private $javascriptDataTemplatesTotNum=0;
 static $useJQuery = false;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$javascriptDataTemplatesTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$javascriptDataTemplatesTotNum - 1; 
 	//self::$hasJavascriptManagement=true;
 	parent::__construct(OBJ_NONE,$actOp,self::INT_JAVASCRIPT_DATA_TEMPLATE,$actNum);
  $this->setJavascriptModule(CLIENT_CODE_PATH . DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE);
 }
 
 	function useJQuery():bool
	{
		return self::$useJQuery;
	}
	
 	function useDojo():bool
	{
		return self::$useDojo;
	}
	
	function hasJavascriptEnabledSwitch():bool
	{
		return self::$hasJavascriptEnabledSwitch;
	}
	
	function hasJavascriptManagement():bool
	{
		return self::$hasJavascriptManagement;
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
 	return self::$javascriptDataTemplatesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$javascriptDataTemplatesTotNum=$actIntNum + 0;
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
 	$javascriptTemplate = $this->getJavascriptTemplate();
 	$item2 = array("@javascriptTemplate"=>$javascriptTemplate);
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
 	$inheritCountFieldName = $this->getInheritCountFieldName();
 	$item6 = array("inheritCountFieldName"=>$inheritCountFieldName);
 	$serializer->loadItems($item6);
 	$inheritDataFieldName = $this->getInheritDataFieldName();
 	$item7 = array("inheritDataFieldName"=>$inheritDataFieldName);
 	$serializer->loadItems($item7);
 	$inheritData= $this->getInheritData();
 	$item8 = array("inheritData"=>$inheritData);
 	$serializer->loadItems($item8);
 	$ajaxOpPar = $this->getAjaxOpPar();
 	$item9 = array("ajaxOpPar"=>$ajaxOpPar);
 	$serializer->loadItems($item9); 
 	$enableDataFromRemote = $this->getEnableDataFromRemote();
 	$item10 = array("enableDataFromRemote"=>$enableDataFromRemote);
 	$serializer->loadItems($item10);
 	$callBackPost = $this->getCallBackPost();
 	$item11 = array("callBackPost"=>$callBackPost);
 	$serializer->loadItems($item11); 	 							
 }
 
 function getEnableDataFromRemote():bool
 {
 	if($this->enableDataFromRemote === STRING_NULL)
 	 return self::DEFAULT_ENABLE_DATA_FROM_REMOTE;
 	else
 	 return $this->enableDataFromRemote;
 }
 
 function setEnableDataFromRemote(bool $actEnableDataFromRemote):void
 {
 	$this->enableDataFromRemote = $actEnableDataFromRemote;
 }
 
 function setExecOnlyOnFullDataSource(bool $actExecOnlyOnFullDataSource):void
 {
 	$this->execOnlyOnFullDataSource = $actExecOnlyOnFullDataSource;
 }
 
 function getExecOnlyOnFullDataSource():bool
 {
 	if($this->execOnlyOnFullDataSource === STRING_NULL)
 	 return self::DEFAULT_EXEC_ONLY_ON_FULL_DATA_SOURCE;
 	else
 	 return $this->execOnlyOnFullDataSource;
 }
 
 function setAjaxOpPar(string $actAjaxOpPar)
 {
 	$this->ajaxOpPar = $actAjaxOpPar;
 }
 
 function getAjaxOpPar():string
 {
 	return $this->ajaxOpPar;
 }
 
 function setCallBackPost(string $actCallBackPost):void
 {
 	$this->callBackPost = $actCallBackPost;
 }
 
 function getCallBackPost():string
 {
 	return $this->callBackPost;
 }
 
 function setCallBackFunPattern(string $actCallBackFunPattern):void
 {
 	$this->callBackFunPattern = $actCallBackFunPattern;
 }
 
 function getCallBackFunPattern():string
 {
 	return $this->callBackFunPattern;
 }
 
 function setInheritCountFieldName(string $actInheritCountFieldName):void
 {
 	$this->inheritCountFieldName = $actInheritCountFieldName;
 }
 
 function getInheritCountFieldName():string
 {
 	if($this->inheritCountFieldName === STRING_NULL)
 	 return self::DEFAULT_INHERIT_COUNT_FIELD_NAME;
 	else
 	 return $this->inheritCountFieldName;
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
 
 function loadTemplateFromFile(string $actFileName):void
 {
 	$fileRows = file($actFileName);
 	$htmlTemplate = STRING_NULL;
 	foreach($fileRows as $fileRow)
 	{
 	 $htmlTemplate = $htmlTemplate . $fileRow;
 	}
 	$this->setJavascriptTemplate($htmlTemplate);
 }
 
 function setJavascriptTemplate(string $actJavascriptTemplate):void
 {
 	$actJavascriptTemplate = preg_replace("/[']/","\'",$actJavascriptTemplate);
 	$this->javascriptTemplate = $actJavascriptTemplate;
 }
 
 function getJavascriptTemplate():string
 {
 	return $this->javascriptTemplate;
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
 
 function getDualInterfaceName():string
 {
  $op = $this->getOp();
  $javascriptIntefaceName = self::DUAL_JAVASCRIPT_INTERFACE_NAME . $op;
  return $javascriptIntefaceName;
 }
 
 function enableBootstrap():void
 {
 }
 
 function isContainer():bool
 {
  return false;
 }
 
 function getJavascriptInterfaceInstantationStr():string
 {
 	$template = $this->getJavascriptTemplate();
 	$hookId = $this->getHookId();
 	$inheritDataFieldName = $this->getInheritDataFieldName();
 	$inheritData = $this->getInheritData();
 	$inheritCountFieldName = $this->getInheritCountFieldName();
 	$op = $this->getOp();
 	$num = $this->getNum();
 	$enableDataFromRemote = $this->getEnableDataFromRemote();
  $javascriptInterfaceName = $this->getDualInterfaceName();
  $execOnlyOnFullDataSource = $this->getExecOnlyOnFullDataSource();  
  $str1 = "var " . $javascriptInterfaceName . " = interfaces.createHtmlDataTemplate('" . 
  $op . "','" . $num . "');" . STRING_ESC_RETURN;
  $dataFields = $this->getDataFields();
  $str2Header = "var dataFields = new Array(";
  $str2Body = STRING_NULL;
  $num1 = count($dataFields);
  for($i=0;$i<=$num1-1;$i++)
  {
  	if($dataFields[$i]=="COUNT")
  	 die(self::ERROR_1);
  	if($i==0)
  	 $str2Body .= "\"" . $dataFields[$i] . "\"";
    else
     $str2Body .= ",\"" . $dataFields[$i] . "\"";
  }
  $str2Footer = ")";
  $str2 = $str2Header . $str2Body . $str2Footer . STRING_ESC_RETURN;
  
  $str3 = $javascriptInterfaceName . STRING_POINT . "setDataFields(dataFields);" . STRING_ESC_RETURN;
  //$str2 = STRING_NULL;
  
  $dataFieldsDomains = $this->getDataFieldsDomains();
  $str4Header = "var dataFieldsDomains = new Array(";
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
  $str4 = $str4Header . $str4Body . $str4Footer . STRING_ESC_RETURN;
  
  $str5 = $javascriptInterfaceName . STRING_POINT . "setDataFieldsDomains(dataFieldsDomains);" . STRING_ESC_RETURN;
  //$str4 = STRING_NULL;
  
  $dataFieldsDomainsValues = $this->getDataFieldsDomainsValues();
  $str6Header = "var dataFieldsDomainsValues = new Array(";
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
  $str6 = $str6Header . $str6Body . $str6Footer . STRING_ESC_RETURN;  
  $str7 = $javascriptInterfaceName . STRING_POINT . "setDataFieldsDomainsValues(dataFieldsDomainsValues);" . STRING_ESC_RETURN;  
  //$str6 = STRING_NULL;  
  //$str70 = "console.log(" . $javascriptInterfaceName . STRING_POINT . "getDataFields()" . ");";
  $str8 = $javascriptInterfaceName . STRING_POINT . "setHookId('" . $hookId . "');" . STRING_ESC_RETURN;
  $str9 = $javascriptInterfaceName . STRING_POINT . "setHtmlTemplate('" . $template . "');" . STRING_ESC_RETURN;
  $str9_0 = $javascriptInterfaceName . STRING_POINT . "setInheritDataFieldName(" . 
  (($inheritDataFieldName===true)?("true"):("false")) . ");" . STRING_ESC_RETURN;
  $str9_1 = $javascriptInterfaceName . STRING_POINT . "setInheritData(" . 
  (($inheritData===true)?("true"):("false")) . ");" . STRING_ESC_RETURN;
  $str9_2 = $javascriptInterfaceName . STRING_POINT . "setInheritCountFieldName('" . 
  $inheritCountFieldName . "');" . STRING_ESC_RETURN;  
  $str10 = "interfacesContainer.add(" .  $javascriptInterfaceName . ");" . STRING_ESC_RETURN;
  
  $str10_1 = $javascriptInterfaceName . STRING_POINT . "setExecOnlyOnFullDataSource(" .
  (($execOnlyOnFullDataSource===true)?("true"):("false")) . ");" . STRING_ESC_RETURN;

  /*$str10_2 = "console.log(" . $javascriptInterfaceName . STRING_POINT . "getDataFields());" . STRING_ESC_RETURN;  
  $str10_3 = "console.log(" . $javascriptInterfaceName . STRING_POINT . "getDataFieldsDomains());" . STRING_ESC_RETURN;  
  $str10_4 = "console.log(" . $javascriptInterfaceName . STRING_POINT . "getDataFieldsDomainsValues());" . STRING_ESC_RETURN;
  $str10_5 = "console.log(" . $javascriptInterfaceName . STRING_POINT . "getDataSource());" . STRING_ESC_RETURN; */ 

  $dataExchangeType = $this->getDataExchangeType();
  $ajaxOpPar = ((($par=$this->getAjaxOpPar())==STRING_NULL)?STRING_NULL:$par);
  
  $callBackPost = $this->getCallBackPost();
  
  $callBackFunPattern = $this->getCallBackFunPattern();
  
   $str10_2 = STRING_NULL;  
  
  if($callBackPost==STRING_NULL)
  {
   if($callBackFunPattern != STRING_NULL)
   $callBackFun1 = "function(){" .
    "ajaxHandler.synServerCall('" . AJAX_HANDLER_PAGE ."','" . $op . 
    "','" . $ajaxOpPar . "','" . $dataExchangeType . "',$callBackFunPattern);}";
   else	   
    $callBackFun1 = "function(){" .
    "ajaxHandler.synServerCall('" . AJAX_HANDLER_PAGE ."','" . $op . 
    "','" . $ajaxOpPar . "','" . $dataExchangeType . "');}";
  }
  else
  {
   if($callBackFunPattern != STRING_NULL)
    $callBackFun1 = "function(){" .
    "ajaxHandler.synServerPostCall('" . AJAX_HANDLER_PAGE ."','" . $op . 
    "','" . $ajaxOpPar . "'," . $callBackPost . "(),'" . $dataExchangeType . "',$callBackFunPattern);}";
   else
    $callBackFun1 = "function(){" .
    "ajaxHandler.synServerPostCall('" . AJAX_HANDLER_PAGE ."','" . $op . 
    "','" . $ajaxOpPar . "'," . $callBackPost . "(),'" . $dataExchangeType . "');}";
  }   
  
  $callBackFun2 = "function(){var int = interfacesContainer.getInterface('$op');" .
  "int.setExecOnlyOnFullDataSource(false);" .
  "int.putData();}";
  
  $callBackFun = (($enableDataFromRemote==true)?($callBackFun1):($callBackFun2));
    
  $str11 = "common.getEventStack().push($callBackFun);";
  $str = $str1 . $str2 . $str3 . $str4 . $str5 . $str6 . 
  $str7 . $str8 . $str9 . $str9_0 . $str9_1 . $str9_2 . 
  (($this->getEnableInsertInClientContainer())?$str10:STRING_NULL) .
  $str10_1 . $str10_2 . /*$str10_2 . $str10_3 . $str10_4 . $str10_5 . */(($this->getEnableExecuteOnLoad())?$str11:STRING_NULL); 

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