<?
namespace Cheope_ns\fw;
require_once("Html_formatted_interface.class.php");
require_once("html.fun.php");
require_once("Html_template.int.php");

abstract class Html_page extends Html_formatted_interface implements Html_template
{
// const ERROR_1="Html_page:Errore nell'inserimento dell'interface container.";
 const DEFAULT_PAGE_CHARSET=CHARSET_UTF8;
 const DEFAULT_PAGE_CONTENT_TYPE=MIME_4;
 const DEFAULT_HTML_PAGE_CSS_CLASS="mainContainer";
 const DEFAULT_DOCTYPE_STRING=DOCTYPE_XHTML_10_TRANSITIONAL;
 const DEFAULT_XML_PROLOG_VERSION=XML_VERSION;
 const DEFAULT_XML_PROLOG_ENCTYPE=CHARSET_UTF8;
 const DEFAULT_HTML_NAMESPACE=HTML_NAMESPACE;
 const DEFAULT_LANG=LANG_ITALIAN;
 const NOT_IMPLEMENTED_CHARS_TOP=200;
 const NOT_IMPLEMENTED_CHARS_LEFT=200;
 const NOT_IMPLEMENTED_CHARS_WIDTH=400;
 const NOT_IMPLEMENTED_CHARS_COLOR="#FF0000";
 const DEFAULT_LOCALE="IT";
 const DEFAULT_LOCALE_FILE_NAME="locale";
 const DEFAULT_ALL_IE_CSS_PATCH_ENABLED = false;
 const DEFAULT_OTHER_NOT_IE_CSS_PATCH_ENABLED = false;
 const DEFAULT_ALL_IE_CSS_PATCH_MODULE = "all_ie_css_patch" . FILE_NAME_ELEMENTS_SEP . CSS_ACRONYM;
 const DEFAULT_OTHER_NOT_IE_CSS_PATCH_MODULE = "not_ie_css_patch" . FILE_NAME_ELEMENTS_SEP . CSS_ACRONYM;

 private $dojoEnabled = false;
 private $jQueryEnabled = false;
 private $uiMaterialEnabled = false;
 private $localizationEnabled = true;
 private $javascriptInjectionEnabled = true;
 private $locale = self::DEFAULT_LOCALE;
 private $localeFileName = self::DEFAULT_LOCALE_FILE_NAME;
 protected $isASessionPage = true;
 private $name = STRING_NULL;
// protected $interfacesContainer = null;
 private $ajaxOps = array();
 private $lang = STRING_NULL;
 private $docTypeString = self::DEFAULT_DOCTYPE_STRING;
 private $xmlPrologVersion = self::DEFAULT_XML_PROLOG_VERSION;
 private $xmlPrologEncType = self::DEFAULT_XML_PROLOG_ENCTYPE;
 private $pageMetaCharset = self::DEFAULT_PAGE_CHARSET;
 private $htmlNameSpace = self::DEFAULT_HTML_NAMESPACE;
 protected $cssExtModule = STRING_NULL;
 protected $jsExtModule = STRING_NULL;
 private $bodyOnLoad = STRING_NULL;
 private $bodyOnUnLoad = STRING_NULL;
 private $allIeCssPatchEnabled = self::DEFAULT_ALL_IE_CSS_PATCH_ENABLED;
 private $otherNotIeCssPatchEnabled = self::DEFAULT_OTHER_NOT_IE_CSS_PATCH_ENABLED;
 private $allIeCssPatchModule = self::DEFAULT_ALL_IE_CSS_PATCH_MODULE;
 private $otherNotIeCssPatchModule = self::DEFAULT_OTHER_NOT_IE_CSS_PATCH_MODULE; 
 private $bodyStructTemplate = null; 
 private $codeBeforeBodyClose = null;
  
 function __construct(string $actName,string $actOp=OP_NONE,$actNum=0)
 {
  self::$useDojo = true;
  self::$useJQuery = true;
  self::$hasJavascriptManagement=true;
  parent::__construct($actOp,self::INT_HTML_PAGE,$actNum);
	$this->setName($actName);
 }
 
 function serialize():void
 {
 	parent::serialize();
 	$serializer = $this->getSerializer();
 	$isASessionPage = $this->getIsASessionPage();
 	$item1 = array("isASessionPage"=>$isASessionPage);
 	$serializer->loadItems($item1);	
 	$name = $this->getName();
 	$item2 = array("name"=>$name);
 	$serializer->loadItems($item2);	
// 	$interfacesContainer = $this->getInterfacesContainer();
// 	$item3 = array("interfacesContainer"=>$interfacesContainer);
// 	$serializer->loadItems($item3,"Container");	
 	$ajaxOps = $this->getAjaxOps();
 	$item4 = array("ajaxOps"=>$ajaxOps);
 	$serializer->loadItems($item4);
 	$docTypeString = $this->getDocTypeString();
 	$item5 = array("docTypeString"=>$docTypeString);
 	$serializer->loadItems($item5);
 	$xmlPrologVersion = $this->getXmlPrologVersion();
 	$item6 = array("xmlPrologVersion"=>$xmlPrologVersion);
 	$serializer->loadItems($item6);
 	$xmlPrologEnctype = $this->getXmlPrologEncType();
 	$item7 = array("xmlPrologEncType"=>$xmlPrologEncType);
 	$serializer->loadItems($item7);	
 	$htmlNameSpace = $this->getHtmlNameSpace();
 	$item8 = array("htmlNameSpace"=>$htmlNameSpace);
 	$serializer->loadItems($item8);	
 	$lang = $this->getLang();
 	$item9 = array("lang"=>$lang);
 	$serializer->loadItems($item9);	
 	$pageMetaCharset = $this->getPageMetaCharset();
 	$item10 = array("pageMetaCharset"=>$pageMetaCharset);
 	$serializer->loadItems($item10);
 	$uiMaterialEnabled = $this->getUiMaterialEnabled();
 	$item11 = array("uiMaterialEnabled"=>$uiMaterialEnabled);
 	$serializer->loadItems($item11);	
 	$dojoEnabled = $this->getDojoEnabled();
 	$item12 = array("dojoEnabled"=>$dojoEnabled);
 	$serializer->loadItems($item12);
 	$jQueryEnabled = $this->getJQueryEnabled();
 	$item13 = array("jQueryEnabled"=>$jQueryEnabled);
 	$serializer->loadItems($item13);
 	$localizationEnabled = $this->getLocalizationEnabled();
 	$item14 = array("localizationEnabled"=>$localizationEnabled);
 	$serializer->loadItems($item14);
 	$locale = $this->getLocale();
 	$item15 = array("locale"=>$locale);
 	$serializer->loadItems($item15);
 	$localeFileName = $this->getLocaleFileName();
 	$item16 = array("localeFileName"=>$localeFileName);
 	$serializer->loadItems($item16);
 	$cssExtModule = $this->getCssExtModule();
 	$item17 = array("cssExtModule"=>$cssExtModule);
 	$serializer->loadItems($item17);
 	$jsExtModule = $this->getJsExtModule();
 	$item18 = array("jsExtModule"=>$jsExtModule);
 	$serializer->loadItems($item18);
 	$item19 = array("bodyOnLoad"=>$bodyOnLoad);
 	$serializer->loadItems($item19);
 	$item20 = array("bodyOnUnLoad"=>$bodyOnUnload);
 	$serializer->loadItems($item20);
	$bodyStructTemplate = $this->getBodyStructTemplate();
	$item21 = array("bodyStructTemplate"=>$bodyStructTemplate);
	$serializer->loadItems($item21);
	$codeBeforeBodyClose = $this->getCodeBeforeBodyClose();
	$item22 = array("codeBeforeBodyClose"=>$codeBeforeBodyClose);
	$serializer->loadItems($item22);
	$javascriptInjectionEnabled = $this->getJavascriptInjectionEnabled();
	$item23 = array("javascriptInjectionEnabled"=>$javascriptInjectionEnabled);
	$serializer->loadItems($item23);
 }
 
 static function createInterfacesContainer(string $actName=STRING_NULL):Interfaces_container
 {
 	return Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,$actName);
 }
 
 function initPutData():array
 {
 }
 
 function add(Html_formatted_interface $actInt):void
 {
 	 $intContainer = $this->getInterfacesContainer();
 	 if(is_null($intContainer))
 	  $intContainer = self::createInterfacesContainer();
 	 $intContainer->add($actInt);
 }
 
 function setElement(Html_formatted_interface $actInt,int $actPos):void
 {
 	 $intContainer = $this->getInterfacesContainer();
 	 if(is_null($intContainer))
 	  $intContainer = self::createInterfacesContainer();
 	 $intContainer->setElement($actInt,$actPos);
 }
 
 function setName(string $actName):void
 {
  $this->name = $actName;
 }
 
 function getName():string
 {
  return $this->name;
 }
 
 function setAllIeCssPatchEnabled(bool $actSet):void
 {
  $this->allIeCssPatchEnabled = $actSet;
 }
 
 function getAllIeCssPatchEnabled():bool
 {
  return $this->allIeCssPatchEnabled;
 } 
 
  function setOtherNotIeCssPatchEnabled(bool $actSet):void
 {
  $this->otherNotIeCssPatchEnabled = $actSet;
 }
 
 function getOtherNotIeCssPatchEnabled():bool
 {
  return $this->otherNotIeCssPatchEnabled;
 }
 
 function getAllIeCssPatchModule():string
 {
  return $this->allIeCssPatchModule;
 }
 
 function setAllIeCssPatchModule(string $actAllIeCssPatchModule):void
 {
  $this->allIeCssPatchModule = $actAllIeCssPatchModule;
 }
 
 function getOtherNotIeCssPatchModule():string
 {
  return $this->otherNotIECssPatch;
 }
 
 function setIeCssPatchModule(string $actOtherNotIeCssPatchModule):void
 {
  $this->otherNotIeCssPatch = $actOtherNotIeCssPatch;
 }
 
 function getCssExtModule():string
 {
 	return $this->cssExtModule;
 }
 
 function setCssExtModule(string $actCssExtModule):void
 {
 	$this->cssExtModule = $actCssExtModule;
 }
 
 function getJsExtModule():string
 {
 	return $this->jsExtModule;
 }
 
 function setJsExtModule(string $actJsExtModule):void
 {
 	$this->jsExtModule = $actJsExtModule;
 } 
 
 function getLocaleFileName():string
 {
  if ($this->localeFileName==STRING_NULL)
	 return self::DEFAULT_LOCALE_FILE_NAME;
	else
   return $this->localeFileName;
 }
 
 function setLocaleFileName(string $actLocaleFileName):void
 {
 	$this->localeFileName = $actLocaleFileName;
 } 
 
 function getLocale():string
 {
  if ($this->locale==STRING_NULL)
	 return self::DEFAULT_LOCALE;
	else
   return $this->locale;
 }
 
 function setLocale(string $actLocale):void
 {
 	$this->locale = $actLocale;
 }

 function getLocalizationEnabled():bool
 {
 	return $this->localizationEnabled;
 }
 
 function setLocalizationEnabled(bool $actLocalizationEnabled):void
 {
 	$this->localizationEnabled = $actLocalizationEnabled;
 }
 
 function getJavascriptInjectionEnabled():bool
 {
 	return $this->javascriptInjectionEnabled;
 }
 
 function setJavascriptInjectionEnabled(bool $actJavascriptInjectionEnabled):void
 {
 	$this->javascriptInjectionEnabled = $actJavascriptInijectionEnabled;
 }

function getUiMaterialEnabled():bool
 {
 	return $this->uiMaterialEnabled;
 }
 
 function setUiMaterialEnabled(bool $actUiMaterialEnabled):void
 {
 	$this->uiMaterialEnabled = $actUiMaterialEnabled;
 }
 
 function getDojoEnabled():bool
 {
 	return $this->dojoEnabled;
 }
 
 function setDojoEnabled(bool $actDojoEnabled):void
 {
 	$this->dojoEnabled = $actDojoEnabled;
 }
 
 function getJQueryEnabled():bool
 {
 	return $this->jQueryEnabled;
 }
 
 function setJQueryEnabled(bool $actJQueryEnabled):void
 {
 	$this->jQueryEnabled = $actJQueryEnabled;
 }
 
 function getBodyOnLoad():string
 {
 	return $this->bodyOnLoad;
 }
 
 function setBodyOnLoad(string $actBodyOnLoad):void
 {
 	$this->bodyOnLoad = $actBodyOnLoad;
 }
 
 function getBodyOnUnLoad():string
 {
 	return $this->bodyOnUnLoad;
 }
 
 function setBodyOnUnLoad(string $actBodyOnUnLoad):void
 {
 	$this->bodyOnUnLoad = $actBodyOnUnLoad;
 }
 
 function getHtmlNameSpace():string
 {
  if ($this->htmlNameSpace==STRING_NULL)
	 return self::DEFAULT_HTML_NAMESPACE;
	else
   return $this->htmlNameSpace;
 }
 
 function setHtmlNameSpace(string $actHtmlNameSpace):void
 {
  $this->htmlNameSpace = $actHtmlNameSpace;
 }
 
 function getXmlPrologVersion():string
 {
  if ($this->xmlPrologVersion==STRING_NULL)
	 return self::DEFAULT_XML_PROLOG_VERSION;
	else
   return $this->xmlPrologVersion;
 }
 
 function setXmlPrologVersion(string $actXmlPrologVersion):void
 {
  $this->xmlPrologVersion = $actXmlPrologVersion;
 }
 
 function getXmlPrologEncType():string
 {
  if ($this->xmlPrologEncType==STRING_NULL)
	 return self::DEFAULT_XML_PROLOG_ENCTYPE;
	else
   return $this->xmlPrologEncType;
 }
 
 function setXmlPrologEncType(string $actXmlPrologEncType):void
 {
  $this->xmlPrologEncType = $actXmlPrologEncType;
 }
 
 function putXmlPrologString():void
 {
 	$htmlWriter = $this->getHtmlWriter();
	$xmlPrologVersion = $this->getXmlPrologVersion();
	$xmlPrologEnctype = $this->getXmlPrologEnctype();
	$htmlWriter->putXmlPrologString($xmlPrologVersion,$xmlPrologEnctype);
 }
 
 function putDocTypeString():void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$docTypeString = $this->getDocTypeString();
	if($docTypeString != NO_DOCTYPE)
	 $htmlWriter->putDocTypeTag($docTypeString);
 }
 
 function putHtmlOpenTag():void
 {
  $htmlWriter = $this->getHtmlWriter();
 	$htmlNameSpace = $this->getHtmlNameSpace();
	$lang = $this->getLang();
	$htmlWriter->putHtmlOpenTag($lang,$htmlNameSpace);
 }
 
 function putTitleTag():void
 {
  $htmlWriter = $this->getHtmlWriter();
 	$htmlWriter->putGenericHtmlString(TITLE_OPEN_TAG);
	$htmlWriter->putGenericHtmlString($this->getName());
	$htmlWriter->putGenericHtmlString(TITLE_CLOSE_TAG);
 }
 
 function putBodyOpenTag():void
 {
	$cssClass = $this->getCssClass();
 	$htmlWriter = $this->getHtmlWriter();
 	$bodyOnLoad = $this->getBodyOnLoad();
 	$bodyOnUnload = $this->getBodyOnUnLoad();
  $htmlWriter->putBodyOpenTag($cssClass,STRING_NULL,STRING_NULL,
  STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
  STRING_NULL,$bodyOnLoad,$bodyOnUnload);
}
 
 function getPageMetaCharset():string
 {
  if ($this->pageMetaCharset==STRING_NULL)
	 return self::DEFAULT_PAGE_CHARSET;
	else
   return $this->pageMetaCharset;
 }
 
 function setPageMetaCharset(string $actPageMetaCharset):void
 {
  $this->pageMetaCharset = $actPageMetaCharset;
 }
 
 function getDocTypeString():string
 {
  if ($this->docTypeString==STRING_NULL)
	 return self::DEFAULT_DOCTYPE_STRING;
	else
   return $this->docTypeString;
 }
 
 function setDocTypeString(string $actDocTypeString):void
 {
  $this->docTypeString = $actDocTypeString;
 }
 
 function isASessionPage():bool
 {
  return $this->isASessionPage;
 }
 
 function setIsASessionPage(bool $actFlag):void
 {
 	$this->isASessionPage = $actFlag;
 }
 
 function setAjaxOps(array $actOps):void
 {
 	$this->ajaxOps = $actOps; 
 }
 
 function getAjaxOps():array
 {
 	return $this->ajaxOps;
 }
 
 function setLang(string $actLang):void
 {
 	$this->lang =$actLang;
 }
 
 function getLang():string
 {
  if ($this->lang==STRING_NULL)
	 return self::DEFAULT_LANG;
	else
   return $this->lang;
 }
 
 function getBodyStructTemplate():?Php_fragment_free
 {
	return $this->bodyStructTemplate;
 }
 
 function setBodyStructTemplate(?Php_fragment_free $actBodyStructTemplate):void
 {
   $this->bodyStructTemplate = $actBodyStructTemplate;
 }
 
 function getCodeBeforeBodyClose():?Interfaces_container
 {
	return $this->codeBeforeBodyClose;
 }
 
 function setCodeBeforeBodyClose(?Interfaces_container $actCodeBeforeBodyClose):void
 {
   $this->codeBeforeBodyClose = $actCodeBeforeBodyClose;
 }
 
 function setAllHtmlWriters():void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$intContainer = $this->getInterfacesContainer();
 	$iterator = $intContainer->create();
 	$iterator->reset();
 	while($iterator->hasMore())
 	{
 	 $int = $iterator->current();
 	 if(is_a($int,Classes_info::HTML_FORMATTED_INTERFACE_CLASS))
 	 {
    $int->setHtmlWriter($htmlWriter);
   }
   $iterator->next();
  }
 }

 function getContainedTypes():array
 {
 	$intContainer = $this->getInterfacesContainer();
 	$iterator = $intContainer->create();
 	$iterator->reset();
 	$containedTypes = array();
 	$i=0;
 	while($iterator->hasMore())
 	{
 		$int = $iterator->current();
 		$intType = $int->getType(); 
    if(! in_array($intType,$containedTypes))
     $containedTypes[$i++]=$intType;
 		$iterator->next();
  }
 	return $containedTypes;
 }

 function getJavascriptContainedTypes():array
 {
 	$intContainer = $this->getInterfacesContainer();
 	$iterator = $intContainer->create();
 	$iterator->reset();
 	$containedTypes = array();
 	$i=0;
 	while($iterator->hasMore())
 	{
 		$int = $iterator->current();
 		$intType = $int->getType();			
    if(is_a($int,Classes_info::HTML_FORMATTED_INTERFACE_CLASS) && $int->hasJavascriptManagement())
     if(! in_array($intType,$containedTypes))
	 {
      $containedTypes[$i++]=$intType;
     } 
  
     $iterator->next();
  
  }
 	return $containedTypes;
 }
 
 function getCssContainedTypes():array
 {
 	$intContainer = $this->getInterfacesContainer();
 	$iterator = $intContainer->create();
 	$iterator->reset();
 	$containedTypes = array();
 	$i=0;
 	while($iterator->hasMore())
 	{
 		$int = $iterator->current();
 		$intType = $int->getType();		
    if(is_a($int,Classes_info::HTML_FORMATTED_INTERFACE_CLASS) && $int->hasCssManagement())
     if(! in_array($intType,$containedTypes))
      $containedTypes[$i++]=$intType;
 		$iterator->next();
  }
 	return $containedTypes;
 }
 
 function getAllContainedObjs(string $actIntType):array
 {
 	$objs = array();
 	$intContainer = $this->getInterfacesContainer();
 	$iterator = $intContainer->create();
 	$iterator->reset();
 	$i=0;
 	while($iterator->hasMore())
 	{
 	 $int = $iterator->current();
 	 $intType = $int->getType();
 	 if($intType==$actIntType)
 	   $objs[$i++] = $int;
 	 $iterator->next();
  }
  return $objs;
 }
 
 function getAllDelayedModules():array
 {
    $delayedModules = array();
 	$intContainer = $this->getInterfacesContainer();
 	$iterator = $intContainer->create();
 	$iterator->reset();
 	while($iterator->hasMore())
 	{
	 $int = $iterator->current();
	 if(is_a($int,Classes_info::HTML_FORMATTED_INTERFACE_CLASS) && $int->hasJavascriptManagement() && $int->getDelayedModule())
	 {
	  $modules = $int->getJavascriptModule();
	  if(is_array($modules))
	  {
	   foreach($modules as $mod)
	   {
		if(! in_array($mod,$delayedModules))
		 $delayedModules[] = $mod;
	   }
	  }
	  elseif ($modules !== STRING_NULL)
	  {
		$mod = $modules;
		if(! in_array($mod,$delayedModules))
		 $delayedModules[]= $mod;
	  }
	 }
     $iterator->next();
	}
   return $delayedModules;	
 }

 function getAllJavascriptContainedEnabledObjs(string $actIntType):array
 {
 	$objs = array();
 	$intContainer = $this->getInterfacesContainer();
 	$iterator = $intContainer->create();
 	$iterator->reset();
 	$interfaceIds = array();
 	while($iterator->hasMore())
 	{
 	 $int = $iterator->current();
 	 $intType = $int->getType();
 	 if($intType==$actIntType)
 	  if($int->hasJavascriptManagement())
 	   if($int->hasJavascriptEnabledSwitch())
 	   {
 	 	  if($int->getJavascriptEnabled())
 	 	  {
 	 	    $interfaceId = $int->getCompleteInterfaceId();
        if(! in_array($interfaceId,$interfaceIds))
        {
         $objs[] = $int;
         $interfaceIds[] = $interfaceId;          
 	      }
 	    }
 	   }
 	   else
 	   {
 	    $interfaceId = $int->getCompleteInterfaceId();
     if(! in_array($interfaceId,$interfaceIds))
      {
       $objs[] = $int;
       $interfaceIds[] = $interfaceId;	    
 	    }
 	   }
 	 $iterator->next();
  }
  return $objs;
 }
 
  function getJavascriptInterfacesNum():int
 {
 	$intContainer = $this->getInterfacesContainer();
 	$iterator = $intContainer->create();
 	$iterator->reset();
 	$num=0;
 	while($iterator->hasMore())
 	{
 		$int = $iterator->current();
 		if(strpos(get_class($int),"Javascript")!== false)
 		 $num++;
 		$iterator->next();
 	}
 	$iterator->reset();
 	return $num;
 }
 
 function getJavascriptDataInterfacesNum():int
 {
 	$intContainer = $this->getInterfacesContainer();
 	$iterator = $intContainer->create();
 	$iterator->reset();
 	$num=0;
 	while($iterator->hasMore())
 	{
 		$int = $iterator->current();
 		if(strpos(get_class($int),"Javascript_data")!== false)
 		 $num++;
 		$iterator->next();
 	}
 	$iterator->reset();
 	return $num;
 }
  
 function getCssClass():string
 {
  if($this->cssClass != STRING_NULL)
	 return $this->cssClass;
  else
	 return self::DEFAULT_HTML_PAGE_CSS_CLASS;
 }
 
 function isContainer():bool
 {
  return true;
 }
 
  function isDecorator():bool
	{
		return false;
	}
 
 // 
 // Funzione su cui effettuare override
 // a seconda dell'applicazione.
 //
 function getRefreshPage():string
 {
 	return NO_PAGE;
 }
 
abstract function putMetaInfo():void;
 
abstract function testDisableOpt():void;

abstract function putLinkTags():void;
 
 // Metodo virtuale per l'esecuzione dell'istruzione
 // di require dei moduli php
 // 
abstract function putRequirePhpModulesCode():void;

// Metodo virtuale per abilitare bootstrap, jquery e dojo in base alle interfacce
// contenute in InterfacesContainer;
//
abstract function enableModules():void;
  
 // Metodo virtuale per l'output del codice di inclusione dei moduli javascript
 // esterni.
abstract function putClientScriptIncludeCode():void;
 
 // Metodo virtuale per l'output del codice di visualizzazione nel caso 
 // di noscript
abstract function putNoScriptSection():void;
 
 // Metodo virtuale per output struttura body.
 // E' previsto implementazione nelle classi figlie 
 // a seconda dell'applicativo.
 //
abstract function putBodyStruct():void;
 
 // Metodo virtuale per output di codice prima della chiusura del body
 // E' previsto implementazione nelle classi figlie 
 // a seconda dell'applicativo.
abstract function putCodeBeforeBodyClose():void;
 
 // Implementazione di Generic_interface::putData()
 //
 function putData():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  $isASessionPage = $this->isASessionPage();
	if($isASessionPage)
	 session_start();

	$this->putRequirePhpModulesCode();

	$this->enableModules();
	$this->putXmlPrologString();
	$this->putDocTypeString();
	$this->putHtmlOpenTag();
	$htmlWriter->putGenericHtmlString(HEAD_OPEN_TAG);
  $this->putMetaInfo();
  $this->testDisableOpt();
  $this->putTitleTag();
	$this->putLinkTags();
	$this->putClientScriptIncludeCode(null);
	$this->setAllHtmlWriters();
	$htmlWriter->putGenericHtmlString(HEAD_CLOSE_TAG);
    $this->putBodyOpenTag();
	$this->putNoScriptSection();	
	$this->putBodyStruct();
	$this->putCodeBeforeBodyClose();
	$htmlWriter->putGenericHtmlString(BODY_CLOSE_TAG);
	$htmlWriter->putGenericHtmlString(HTML_CLOSE_TAG);
 }

}


?>