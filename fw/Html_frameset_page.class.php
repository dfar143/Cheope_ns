<?
namespace Cheope_ns\fw;
require_once("Html_formatted_interface.class.php");
require_once("Interfaces_container.class.php");
require_once("html.fun.php");


abstract class Html_frameset_page extends Html_formatted_interface
{
 
 const ERROR_1="Html_frameset_page:Errore nell'inserimento dell'interface container.";
// const ERROR_2="Html_frameset_page:Errore nell'inserimento degli eventi.";
 const DEFAULT_PAGE_CHARSET=CHARSET_ISO88591;
 const DEFAULT_PAGE_CONTENT_TYPE=MIME_4;
 const DEFAULT_HTML_PAGE_CSS_CLASS="mainContainer";
 const DEFAULT_DOCTYPE_STRING=DOCTYPE_XHTML_10_FRAMESET;
 const DEFAULT_XML_PROLOG_VERSION=XML_VERSION;
 const DEFAULT_XML_PROLOG_ENCTYPE=CHARSET_ISO88591;
 const DEFAULT_HTML_NAMESPACE=HTML_NAMESPACE;
 const DEFAULT_FRAME_BORDER = "no";
 const DEFAULT_FRAME_SPACING = 0;
 const DEFAULT_ROWS_NUM = 0;
 const DEFAULT_COLS_NUM = 0;
 const DEFAULT_BORDER = 0;

 private $dojoEnabled = false;
 private $jQueryEnabled = false;
 private $localizationEnabled = true;
 private $locale = STRING_NULL;
 private $localeFileName = STRING_NULL;
 protected $isASessionPage = false;
 private $name = STRING_NULL;
// protected $interfacesContainer = null;
 private $ajaxOps = array();
 private $docTypeString = self::DEFAULT_DOCTYPE_STRING;
 private $xmlPrologVersion = self::DEFAULT_XML_PROLOG_VERSION;
 private $xmlPrologEncType = self::DEFAULT_XML_PROLOG_ENCTYPE;
 private $htmlNameSpace = self::DEFAULT_HTML_NAMESPACE;
 private $noFramesInterface = null;
 private $rows = self::DEFAULT_ROWS_NUM;
 private $cols = self::DEFAULT_COLS_NUM;
 private $border = self::DEFAULT_BORDER;
 private $frameBorder = self::DEFAULT_FRAME_BORDER;
 private $frameSpacing = self::DEFAULT_FRAME_SPACING;
 private $events = array();
 
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL,string $actName=STRING_NULL)
 {
  parent::__construct($actOp,self::INT_HTML_FRAMESET_PAGE,$actNum);
	$this->setName($actName);
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
	
 	//parent::serialize();
 	$serializer = $this->getSerializer();
 	$isASessionPage = $this->getIsASessionPage();
 	$item1 = array("isASessionPage"=>$isASessionPage);
 	$serializer->loadItems($item1);	
 	$name = $this->getName();
 	$item2 = array("name"=>$name);
 	$serializer->loadItems($item2);	
 	$interfacesContainer = $this->getInterfacesContainer();
 	$item3 = array("interfacesContainer"=>$interfacesContainer);
 	$serializer->loadItems($item3,"Container");	
 	$docTypeString = $this->getDocTypeString();
 	$item4 = array("docTypeString"=>$target);
 	$serializer->loadItems($item4);
 	$xmlPrologVersion = $this->getXmlPrologVersion();
 	$item5 = array("xmlPrologVersion"=>$xmlPrologVersion);
 	$serializer->loadItems($item5);
 	$xmlPrologEncType = $this->getXmlPrologEncType();
 	$item6 = array("xmlPrologEncType"=>$xmlPrologEncType);
 	$serializer->loadItems($item6);	
 	$htmlNameSpace = $this->getHtmlNameSpace();
 	$item7 = array("htmlNameSpace"=>$htmlNameSpace);
 	$serializer->loadItems($item7);	
 	$noFramesInterface = $this->getNoFramesInterface();
 	$item8 = array("noFramesInterface"=>$noFramesInterface);
 	$serializer->loadItems($item8);
 	$rows = $this->getRows();
 	$item9 = array("rows"=>$rows);
 	$serializer->loadItems($item9);
 	$cols = $this->getCols();
 	$item10 = array("cols"=>$cols);
 	$serializer->loadItems($item10);
 	$events = $this->getEvents();
 	$item11 = array("events"=>$events);
 	$serializer->loadItems($item11);
 	$frameBorder = $this->getFrameBorder();
 	$item12 = array("frameBorder"=>$frameBorder);
 	$serializer->loadItems($item12);
 	$frameSpacing = $this->getFrameSpacing();
 	$item13 = array("frameSpacing"=>$frameSpacing);
  $serializer->loadItems($item13);		
  $dojoEnabled = $this->getDojoEnabled();
  $item14 = array("dojoEnabled"=>$dojoEnabled);
  $serializer->loadItems($item14);
  $jQueryEnabled = $this->jQueryEnabled();
  $item15 = array("jQueryEnabled"=>$jQueryEnabled);
  $serializer->loadItems($item15);
  $localizationEnabled = $this->getLocalizationEnabled();
  $item16 = array("localizationEnabled"=>$localizationEnabled);
  $serializer->loadItems($item16);
  $locale = $this->getLocaleEnabled();
  $item17 = array("locale"=>$locale);
  $serializer->loadItems($item17);
  $localeFileName = $this->getLocaleFileName();
  $item18 = array("localeFileName"=>$localeFileName);
  $serializer->loadItems($item18);	
 	$ajaxOps = $this->getAjaxOps();
 	$item19 = array("ajaxOps"=>$ajaxOps);
 	$serializer->loadItems($item19);
 }
 
 function setName(string $actName):void
 {
  $this->name = $actName;
 }
 
 function getName():string
 {
  return $this->name;
 }
 
 function setNoFramesInterface(Html_formatted_interface $actNoFramesInterface):void
 {
 	$this->noFramesInterface = $actNoFramesInterface;
 }
 
 function getNoFramesInterface():Html_formatted_interface
 {
 	return $this->noFramesInterface;
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
 
 
 function getBorder():int
 {
 	if($this->border==NO_VALUE)
 	 return self::DEFAULT_BORDER;
 	else
 	 return $this->border;
 }
 
 function setBorder(int $actBorder):void
 {
 	$this->border = $actBorder;
 }
 
 function getFrameBorder():string
 {
  if ($this->frameBorder==STRING_NULL)
	 return self::DEFAULT_FRAME_BORDER;
	else
   return $this->frameBorder; 	
 }
 
 function setFrameBorder(string $actFrameBorder):void
 {
 	$this->frameBorder = $actFrameBorder;
 }
 
 function getFrameSpacing():string
 {
 	if ($this->frameSpacing==STRING_NULL)
 	 return self::DEFAULT_FRAME_SPACING;
 	else
 	 return $this->frameSpacing;
 }
 
 function setFrameSpacing(string $actFrameSpacing):void
 {
 	$this->frameSpacing = $actFrameSpacing;
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

 function getRows():int
 {
 	if($this->rows==NO_VALUE)
 	 return self::DEFAULT_ROWS_NUM;
 	else
 	 return $this->rows;
 }
 
 function setRows(int $actRows):void
 {
 	$this->rows = $actRows;
 }
 
 function getCols():int
 {
 	if($this->cols==NO_VALUE)
 	 return self::DEFAULT_COLS_NUM;
 	else
 	 return $this->cols;
 }
 
 function setCols(int $actCols):void
 {
 	$this->cols = $actCols;
 }
 
 function getEvents():array
 {
 	return $this->events;
 }
 
 function setEvents(array $actEvents):void
 {
 	 $this->events = $actEvents;
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
 
 function isContainer():bool
 {
  return true;
 }
 
 function putContainer():void
 {
 	$intContainer = $this->getInterfacesContainer();
 	$iterator = $intContainer->create();
 	$iterator->reset();
 	while($iterator->hasMore())
 	{
 		$int = $iterator->current();
 		$int->putData();
 		$iterator->next();
 	}
 }
 
abstract function putMetaInfo():void;
 
abstract function putLinkTags():void;
 
 
 // Metodo virtuale per l'esecuzione dell'istruzione
 // di require dei moduli php
 // 
abstract function putRequirePhpModulesCode():void;
 
 
 // Metodo virtuale per l'output del codice di inclusione dei moduli javascript
 // esterni.
abstract function putClientScriptIncludeCode():void;
 
 
 // Override di Generic_interface::putData()
 //
 function putData():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  $isASessionPage = $this->isASessionPage();
	if($isASessionPage)
	 session_start();
	$xmlPrologVersion = $this->getXmlPrologVersion();
	$xmlPrologEncType = $this->getXmlPrologEncType();
	$htmlWriter->putXmlPrologString($xmlPrologVersion,$xmlPrologEncType);
	$docTypeString = $this->getDocTypeString();
	if($docTypeString != NO_DOCTYPE)
	 $htmlWriter->putDocTypeTag($docTypeString);
	$htmlWriter->putGenericHtmlString(HTML_OPEN_TAG);
	$htmlWriter->putGenericHtmlString(HEAD_OPEN_TAG);
	$htmlWriter->putGenericHtmlString(STRING_NULL);
  $this->putMetaInfo();
	$htmlWriter->putGenericHtmlString(TITLE_OPEN_TAG);
	$htmlWriter->putGenericHtmlString($this->getName());
	$htmlWriter->putGenericHtmlString(TITLE_CLOSE_TAG);
	$htmlWriter->putGenericHtmlString(STRING_NULL);
	$this->putLinkTags();	
	$htmlWriter->putGenericHtmlString(STRING_NULL);
	$this->putRequirePhpModulesCode();
	$this->putClientScriptIncludeCode();
	$htmlWriter->putGenericHtmlString(STRING_NULL);
	$htmlWriter->putGenericHtmlString(HEAD_CLOSE_TAG);
	$rows = $this->getRows();
	$cols = $this->getCols();
	$border = $this->getBorder();
	$events = $this->getEvents();
	if (isset($events[0]))
	 $onLoad = $events[0];
	else $onLoad = STRING_NULL;
	if(isset($events[1]))
	 $onUnload = $events[1];
	else
	 $onUnload = STRING_NULL;
	$htmlWriter->putFramesetOpenTag($rows,$cols,$border,
	$frameBorder,$frameSpacing,$onLoad,$onUnload);
	$this->putContainer();
	$htmlWriter->putGenericHtmlString(NOFRAMES_OPEN_TAG);
  $noFramesInterface = $this->getNoFramesInterface();
  if(is_object($noFramesInterface) && 
  is_a($noFramesInterface,Interfaces_info::INT_HTML_FORMATTED_INTERFACE))
   $noFramesInterface->putData();
	$htmlWriter->putGenericHtmlString(NOFRAMES_CLOSE_TAG);
	$htmlWriter->putGenericHtmlString(FRAMESET_CLOSE_TAG);
	$htmlWriter->putGenericHtmlString(HTML_CLOSE_TAG);
 }
}

?>