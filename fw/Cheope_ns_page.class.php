<?
namespace Cheope_ns\fw;
require_once("cheope_ns.fun.php");
require_once("cheope_ns_reg.def.php");
require_once("Html_page.class.php");
require_once("javascript.fun.php");

abstract class Cheope_ns_page extends Html_page
{
 
 function __construct(string $actName,string $actOp=OP_NONE,$actNum=0)
 {
  parent::__construct($actName,$actOp,$actNum);
 }
 
 function autoload(string $actClassName):void
 { 
 	if($this->isASessionPage())
  {
   $appDir = $_SESSION[SESSION_VAR_ACTIVE_APP];
 	 $appInterfacesDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
   FRAMEWORK_DIR;
   if (file_exists($appInterfacesDir . DIR_SEP . $actClassName . 
  	FILE_NAME_ELEMENTS_SEP . "class" . 
  	FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE))
 	 require_once($appInterfacesDir . DIR_SEP . $actClassName . 
  	FILE_NAME_ELEMENTS_SEP . "class" . 
  	FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE);
  }
  else
  {
   $appDir = APPLICATION_NAME;
 	 $appInterfacesDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
   FRAMEWORK_DIR;
   if (file_exists($appInterfacesDir . DIR_SEP . $actClassName . 
   	FILE_NAME_ELEMENTS_SEP . "class" . 
  	FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE))
 	 require_once($appInterfacesDir . DIR_SEP . $actClassName . 
 	  FILE_NAME_ELEMENTS_SEP . "class" . 
 	  FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE); 	
  } 
 }	

 
 function enableBootstrap():void
 {
	$bootstrapEnabled = $this->getBootstrapEnabled();
 	if ($bootstrapEnabled)
 	{
 		if(isset($this->interfacesContainer))
 		{
 		 $intContainer = $this->getInterfacesContainer();
 		 $iterator = $intContainer->create();
 	   $iterator->reset();
 	   while($iterator->hasMore())
 	   {
 		  $int = $iterator->current();
 		  if(isset($int->bootstrapEnabled))
 		  {
 		   $int->setBootstrapEnabled(true);
 		   $int->enableBootstrap();
 		  } 
 		  $iterator->next();
 	   }
 	   $iterator->reset();
 	  }
 	}  	
 }
 
 function isStandard():bool
 {
 	return false;
 }
 
 function putAutoCssInitializationCode():void
 {
	$htmlWriter = $this->getHtmlWriter();
  $containedIntTypes = $this->getCssContainedTypes();
  $modules=array();
  $i=0;
  foreach($containedIntTypes as $containedType)
  {
  	$containedObjs = $this->getAllContainedObjs($containedType);
  	if(count($containedObjs)>0)
  	{
  		$containedObj = $containedObjs[0];
  		$module = $containedObj->getCssModule();
  		if($module!=STRING_NULL)
  		 if(is_array($module))
  	   {
  		  foreach($module as $mod)
  		   if(! in_array($mod,$modules))
  		   {
  		    $modules[$i++] = $mod;
  		   // if($containedObj->hasCssManagement())
  		    //{
  		    // if($this->getJQueryEnabled())
  		      $htmlWriter->putLinkTag(STRING_NULL,$mod);
  	      //}
  	      //else
  	      // $htmlWriter->putLinkTag(STRING_NULL,$mod);
  	     }
	   }   
  	   else
  	    if(! in_array($module,$modules))
  	    {
  	   	 $modules[$i++]=$module;
  		  // if($containedObj->hasCssManagement())
  		  // {
  		   // if($this->getJQueryEnabled())
  		     $htmlWriter->putLinkTag(STRING_NULL,$module);
  	     //}
  	     //else
  	     // $htmlWriter->putLinkTag(STRING_NULL,$module);
  	    }
  	}
  }
 } 
 
 function putLinkTags():void
 {
 	$htmlWriter = $this->getHtmlWriter();

    if($this->getUiMaterialEnabled())
	{
	 $htmlWriter->putGenericArrayOpenTag("link",array("rel"=>"preconnect","href"=>"https://fonts.googleapis.com",STRING_NULL=>STRING_SLASH));
	 $htmlWriter->putGenericArrayOpenTag("link",array("rel"=>"preconnect",
	 "href"=>"https://fonts.gstatic.com",STRING_NULL=>"crossorigin",STRING_NULL=>STRING_SLASH));
	 $htmlWriter->putGenericArrayOpenTag("link",array("rel"=>"stylesheet",
	 "href"=>"https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap",STRING_NULL=>"crossorigin",STRING_NULL=>STRING_SLASH));
	 $htmlWriter->putGenericArrayOpenTag("link",array("rel"=>"stylesheet","href"=>"https://fonts.googleapis.com/icon?family=Material+Icons",
	 STRING_NULL=>"crossorigin",STRING_NULL=>STRING_SLASH));
	}
 	
 	if ($this->getBootstrapEnabled())
 	{
 	 $htmlWriter->putLinkTag(STRING_NULL,
 	 CLIENT_BOOTSTRAP_STYLE_SHEET_PATH . DIR_SEP . BOOTSTRAP . STRING_POINT . 
 	 "min" . STYLE_SHEET_FILE_POSTFIX);	
  }  	
 	
 	$htmlWriter->putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . 
 	DIR_SEP . CSS_COMMON_FILE . STYLE_SHEET_FILE_POSTFIX);	
  
	$cssExtModule = $this->getCssExtModule();

  if($this->getJQueryEnabled())
  $htmlWriter->putLinkTag(STRING_NULL,
  CLIENT_JQUERY_UI_CSS_PATH . DIR_SEP . JQUERY_UI_VER .
   STYLE_SHEET_FILE_POSTFIX);
 
  $this->putAutoCssInitializationCode();

	if($cssExtModule == STRING_NULL)
	 $cssExtModule=lcFirst(APPLICATION_NAME) . VAR_SEP . DEFAULT_PAGE_NAME . 
	 STYLE_SHEET_FILE_POSTFIX;
  else
   $cssExtModule=$cssExtModule . STYLE_SHEET_FILE_POSTFIX;
   
	if(! is_file_void(CLIENT_STYLE_SHEET_PATH . DIR_SEP .
	 $cssExtModule))
	{
	 $htmlWriter->putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP .
	 $cssExtModule);	
	}
	elseif (! is_file_void(CLIENT_STYLE_SHEET_PATH . DIR_SEP .
	 $cssExtModule . STYLE_SHEET_FILE_POSTFIX)) 
	{
	 $htmlWriter->putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP .
	 $cssExtModule);	 	
	}    
	
  /*if($this->getJQueryEnabled())
  $htmlWriter->putLinkTag(STRING_NULL,
  CLIENT_JQUERY_UI_CSS_PATH . DIR_SEP . JQUERY_UI_VER .
   STYLE_SHEET_FILE_POSTFIX);*/
 
  if(parent::getAllIeCssPatchEnabled())
  {
   $ieCssPatchModule = parent::getAllIeCssPatchModule();
   $htmlWriter->putGenericHtmlString("<!--[if IE]>" .
	"<link rel=\"stylesheet\" type=\"text/css\" href=\"" .  $ieCssPatchModule . "\" />" .
    "<![endif]-->");
  }
  
  if(parent::getOtherNotIeCssPatchEnabled())
  {
   $otherNotIeCssPatchModule = parent::getOtherNotIeCssPatchModule();
   $htmlWriter->putGenericHtmlString("<!--[if IE]>" .
	"<link rel=\"stylesheet\" type=\"text/css\" href=\"" .  $otherNotIeCssPatchModule . "\" />" .
    "<!--<![endif]-->");
  }
 // $this->putAutoCssInitializationCode();
 }
 
 function putAjaxOpsPars():void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$htmlWriter->putScriptOpenTag();
 	$ajaxOps = $this->getAjaxOps();
 	$htmlWriter->putGenericHtmlString("ajaxHandler.setOpContainer(new Array(0));");
 	$i=0;
 	foreach($ajaxOps as $ajaxOp)
 	{
 	   $htmlWriter->putGenericHtmlString("ajaxHandler.OP_" . $i . "='" . $ajaxOp . "';");
 	   $op = ucFirst($ajaxOp);
 	   $opFunction = "Op" . $op;
 	   $htmlWriter->putGenericHtmlString("ajaxHandler.addOp(new " . $opFunction . "(ajaxHandler.OP" . VAR_SEP . ($i) . "))" . ";");
 	   $i++;
 	}
 	$htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
 }
  
 function initJavascriptLocalization():void
 {
   $htmlWriter = $this->getHtmlWriter();
 	 $htmlWriter->putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_OP_LOCALIZATION);
 	 $loc = $this->getLocale();
 	 $localeFileName = $this->getLocaleFileName();
 	 $htmlWriter->putScriptOpenTag();
 	 $htmlWriter->putGenericHtmlString("var loc = new OpLocalization();");
 	 $htmlWriter->putGenericHtmlString("loc.setLocale('" . $loc . "');");
 	 $htmlWriter->putGenericHtmlString("loc.setFileName('" . $localeFileName . "');");
 	 $htmlWriter->putGenericHtmlString("if(ajaxHandler.getOpContainer()===null)ajaxHandler.setOpContainer(new Array(0));");
 	 $htmlWriter->putGenericHtmlString("ajaxHandler.addOp(loc);");
     $htmlWriter->putGenericHtmlString("var pattern = /[\.%&\*!':,\"\?\-_><\[\]#@\(\)\$\s\w\/ A-Za-z0-9]*[aA]*[jax error]*[\[\]]*[}{]*[\.%&\*!':,\"\?\-_><\[\]#@\(\)\$\s\w\/ A-Za-z0-9]*/;");
 	 $htmlWriter->putGenericHtmlString("var funLocLoad = function(){ajaxHandler.synServerCall('" . 
 	 AJAX_HANDLER_PAGE . "','localization',loc.getLocale() + '" . 
 	 STRING_SEMICOLON . "' + loc.getFileName(),'json',pattern)};"); 
 	 $htmlWriter->putGenericHtmlString("funLocLoad();");
 	 $htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
  }
  
  function initJavascriptInjection():void
  {
  $htmlWriter = $this->getHtmlWriter();
 	 $htmlWriter->putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_OP_JAVASCRIPT_INJECTION);
 //	 $loc = $this->getLocale();
 //	 $localeFileName = $this->getLocaleFileName();
 	 $htmlWriter->putScriptOpenTag();
 	 $htmlWriter->putGenericHtmlString("var jInObj = new OpJavascriptInjection();");
 	 $htmlWriter->putGenericHtmlString("if(ajaxHandler.getOpContainer()===null)ajaxHandler.setOpContainer(new Array(0));");
 	 $htmlWriter->putGenericHtmlString("ajaxHandler.addOp(jInObj);");
     $htmlWriter->putGenericHtmlString("var pattern = /[.\s\w\/\.\"\'\(\); A-Za-z0-9\=\?<>_-]*/;");
//     $htmlWriter->putGenericHtmlString("var pattern = /[\s\._\:A-Za-z0-9;\-\[\]]*/;");
 	 $htmlWriter->putGenericHtmlString("var jInObjFun = function(){ajaxHandler.serverCall('" . 
 	 AJAX_HANDLER_PAGE . "','javascriptInjection',jInObj.getPar(),'script',pattern)};"); 
 //	 $htmlWriter->putGenericHtmlString("funLocLoad2();");
 	 $htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
  }
  
 function putAutoJavascriptInitializationCode():void
 {
	$htmlWriter = $this->getHtmlWriter();
  $containedIntTypes = $this->getJavascriptContainedTypes();
  $delayedModules = $this->getAllDelayedModules();
  $modules=$delayedModules;
  $i=0;
 
  foreach($containedIntTypes as $containedType)
  { 
  	$containedObjs = $this->getAllJavascriptContainedEnabledObjs($containedType);
  	if(count($containedObjs)>0)
  	{
  		$containedObj = $containedObjs[0];
  		$module = $containedObj->getJavascriptModule();
  		if($module!=STRING_NULL)
  		 if(is_array($module))
  	   {
  		  foreach($module as $mod)
  		   if(! in_array($mod,$modules))
  		   {
  		    $modules[$i++] = $mod;
  		    $htmlWriter->putScriptIncludeTag($mod);
  	     }
  	   }
  	   else
  	    if(! in_array($module,$modules))
  	    {
  	   	 $modules[$i++]=$module;
  	   	 $htmlWriter->putScriptIncludeTag($module);
  	    }
  	}
  	$i=0;
  	$htmlWriter->putScriptOpenTag();
  	foreach($containedObjs as $containedObj)
  	{
  		if($containedObj->useJQuery())
  		{
  		 if($this->getJQueryEnabled())
  		  $containedObj->putJavascriptInitializationCode($i++);
  		}
  		elseif($containedObj->useDojo())
  		{
  		 if($this->getDojoEnabled())
  		  $containedObj->putJavascriptInitializationCode($i++);
  		}
  		else
	    {
  		 $containedObj->putJavascriptInitializationCode($i++);
		 //echo get_class($containedObj);
		}
  	}
  	$htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
  } 
 }
 
 function putJavascriptInitializationCode(string $actPar=STRING_NULL):void
 {
	$htmlWriter = $this->getHtmlWriter();

    if($this->getUiMaterialEnabled())
	{
	 $htmlWriter->putGenericArrayOpenTag("script",array("src"=>"https://unpkg.com/react@latest/umd/react.development.js","crossorigin"=>"anonymous"));
	 $htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
	 $htmlWriter->putGenericArrayOpenTag("script",array("src"=>"https://unpkg.com/react-dom@latest/umd/react-dom.development.js"));
	 $htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
	 $htmlWriter->putGenericArrayOpenTag("script",array("src"=>"https://unpkg.com/@mui/material@latest/umd/material-ui.development.js","crossorigin"=>"anonymous"));
	 $htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
	 $htmlWriter->putGenericArrayOpenTag("script",array("src"=>"https://unpkg.com/@babel/standalone@latest/babel.min.js","crossorigin"=>"anonymous"));
	 $htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
	}
 	 
 	if($this->getJQueryEnabled())
 	{
 	 $htmlWriter->putScriptIncludeTag(CLIENT_JQUERY_CODE_PATH . DIR_SEP . JS_JQUERY_MAIN);
 	 $htmlWriter->putScriptIncludeTag(CLIENT_JQUERY_CODE_PATH . DIR_SEP . JS_JQUERY_MIGRATE);
   $htmlWriter->putScriptIncludeTag(CLIENT_JQUERY_UI_CODE_PATH . DIR_SEP . JS_JQUERY_UI);
  }
  if($this->getDojoEnabled())
  {
 	 $htmlWriter->putScriptIncludeTag(CLIENT_DOJO_CODE_PATH . DIR_SEP . JS_DOJO);
   $htmlWriter->putScriptIncludeTag(CLIENT_DIJIT_CODE_PATH . DIR_SEP . JS_DIJIT);
 //  $htmlWriter->putScriptIncludeTag(CLIENT_DOJOX_CODE_PATH . DIR_SEP . JS_DOJOX);
  }
  
	$jsExtModule = $this->getJsExtModule();	
	if($jsExtModule == STRING_NULL)
	 $jsExtModule = lcFirst(APPLICATION_NAME) . VAR_SEP . DEFAULT_PAGE_NAME;
 	$htmlWriter->putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . $jsExtModule . JAVASCRIPT_SOURCE_FILE_POSTFIX);

  $htmlWriter->putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_UTIL);
  $htmlWriter->putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_COMMON);
  //putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
  
 	$ajaxOps = $this->getAjaxOps();
  $dim = count($ajaxOps);
 	$num = $this->getJavascriptDataInterfacesNum();
 	if(($dim>0)||($num>0)||($this->getLocalizationEnabled()))
 	{
 	 $htmlWriter->putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . 
    AJAX_HANDLER_JQUERY . JAVASCRIPT_SOURCE_FILE_POSTFIX);
   $htmlWriter->putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . lcFirst(APPLICATION_NAME) . VAR_SEP .
    DEFAULT_PAGE_NAME . 
    VAR_SEP . AJAX_HANDLER . JAVASCRIPT_SOURCE_FILE_POSTFIX);
  }

  if($dim>0)
   $this->putAjaxOpsPars();
  elseif($num>0)
  {
   $htmlWriter->putScriptOpenTag();
   $htmlWriter->putGenericHtmlString("ajaxHandler.setOpContainer(new Array(0));");
   $htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
  }
  
  $htmlWriter->putScriptOpenTag();
  $htmlWriter->putGenericHtmlString("var interfacesContainer;");
  $htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);

  $this->putAutoJavascriptInitializationCode(); 	

  $htmlWriter->putScriptOpenTag(); 	 
 	$htmlWriter->putGenericHtmlString("common.addEventStack();");
 	$htmlWriter->putGenericHtmlString("common.getEventStack().erase();");
  $htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG); 
 	  
 	if($this->getLocalizationEnabled())
   $this->initJavascriptLocalization();
  else
  {
  	$htmlWriter->putScriptOpenTag();
  	$htmlWriter->putGenericHtmlString("var loc;");
  	$htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
  }
  
  if($this->getJavascriptInjectionEnabled())
   $this->initJavascriptInjection();
  else
  {
  	$htmlWriter->putScriptOpenTag();
  	$htmlWriter->putGenericHtmlString("var jInObj;");
  	$htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
  } 
  
 }
 
/* function setAllCodeDirs():void
 {
  $interfaces = $this->getInterfacesContainer();
  $int_iter = $interfaces->create();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]))
  {
   $codeDir = THIS_DIR . DIR_SEP . $_SESSION[SESSION_VAR_ACTIVE_APP];
   while($int_iter->hasMore())
   {
  	$int = $int_iter->current(); 
  	$int->getSerializer()->setCodeDir($codeDir);
  	$int_iter->next();
   }
  }
 }*/

 // Metodo virtuale per l'output del codice di inclusione dei moduli javascript
 // esterni. 
 function putClientScriptIncludeCode():void
 {
   $this->putJavascriptInitializationCode();
 //  $this->setAllCodeDirs();
 }
  
 function getRefreshPage():string
 {
/* 	return PAGE_LOGIN;*/
 }
 
function putMetaInfo():void
 {
  $htmlWriter = $this->getHtmlWriter();
  $pageMetaCharset = $this->getPageMetaCharset();
 	$htmlWriter->putGenericHtmlString("<meta http-equiv=\"Content-Type\" content=\"" . 
 	Html_page::DEFAULT_PAGE_CONTENT_TYPE  . "; charset=\"" . $pageMetaCharset . "\">");
 	if ($this->getBootstrapEnabled())
 	{
 	$htmlWriter->putGenericHtmlString("<meta name=\"viewport\" " .
 	"content=\"width=device-width,initial-scale=1,shrink-to-fit=no\">");
  } 
  elseif ($this->getUiMaterialEnabled())
  {
   $htmlWriter->putGenericHtmlString("<meta name=\"viewport\" content=\"initial-scale=1, width=device-width\" />"); 	  
  }
 }
 
 function putNotImplementedChars():void
 {
 }
 
 function putRequirePhpModulesCode():void
 {
 }
 
 function enableModules():void
 {
  $intContainer = $this->getInterfacesContainer();
  $iter = $intContainer->create();
  $iter->reset();
  while($iter->hasMore())
  {
	$interface = $iter->current();
    if(is_a($interface,Interfaces_info::INT_DOJO) && $interface->useDojo())   
     $this->setDojoEnabled(true);
	if(is_a($interface,Interfaces_info::INT_JQUERY) && $interface->useJQuery())
	 $this->setJQueryEnabled(true);	 
    if(is_a($interface,Interfaces_info::INT_BOOTSTRAP) && $interface->getBootstrapEnabled())
	 $this->setBootstrapEnabled(true);
	$iter->next();
  }
  //if(is_a($interface,Interfaces_info::INT_BOOTSTRAP))
  //$this->enableBootstrap();
 }
 
 function putNoScriptSection():void
 {
 	$htmlWriter = $this->getHtmlWriter();
	$htmlWriter->putGenericHtmlString(NO_SCRIPT_OPEN_TAG);
  $htmlWriter->putGenericHtmlString(SEP_OPEN_TAG);
  $htmlWriter->putGenericHtmlString("****************************************************");
	$htmlWriter->putGenericHtmlString(SEP_OPEN_TAG);
  $htmlWriter->putGenericHtmlString("Attenzione! Javascript non è attivato sul vostro PC.");
	$htmlWriter->putGenericHtmlString(SEP_OPEN_TAG);
	$htmlWriter->putGenericHtmlString("L'applicativo potrebbe non funzionare correttamente.");
	$htmlWriter->putGenericHtmlString(SEP_OPEN_TAG);
	$htmlWriter->putGenericHtmlString("****************************************************");
	$htmlWriter->putGenericHtmlString(SEP_OPEN_TAG);
	$htmlWriter->putGenericHtmlString(NO_SCRIPT_CLOSE_TAG);
 }
 
 function testDisableOpt():void
 {
  $disableTimeVet = explode(STRING_COLON,DISABLE_START_TIME);
  $disableHour = $disableTimeVet[0];
  $disableMinutes = $disableTimeVet[1];
  $disableTime = ($disableHour * 60) + $disableMinutes;
  date_default_timezone_set('Europe/Rome');
  $date = getDate();
  $actualHour = $date['hours'];
  $actualMinutes = $date['minutes'];
  $actualTime = ($actualHour * 60) + $actualMinutes;

  if (($actualTime >= $disableTime)&&($actualTime <= $disableTime + DISABLE_DURATE))
  {
   $minutesToWait = $disableTime + DISABLE_DURATE - $actualTime; 
   die(DISABLE_MSG . $minutesToWait . " MINUTI.");
  }
 }

 
 // Metodo per visualizzazione intestazione pagina.
 function putHeader():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  $htmlWriter->putGenericHtmlString("<div class=\"header\">" . LABEL_NOME_APPLICAZIONE . "</div>");
 }
 
 // Metodo per visualizzazione piè di pagina.
 function putFooter():void
 {
 }
 
 // Metodo virtuale per visualizzazione body - override nelle classi figlie;
 abstract function putBody():void;
 
  // Metodo virtuale per visualizzazione applicazione attiva.
 abstract function putActiveApp():void;
 
 // Metodo per output struttura body.
 // Override di Html_page::putBodyStruct
 function putBodyStruct():void
 { 						
	$htmlWriter = $this->getHtmlWriter();
  $mainClass = $this->getCssClass();
  $bodyStructTemplate = $this->getBodyStructTemplate();
  if(! is_null($bodyStructTemplate) && (gettype($bodyStructTemplate) !== "string"))
  {
	$bodyStructTemplate->setGlobalHtmlWriter($htmlWriter);
	$bodyStructTemplate->setGlobalThis($this);
	$bodyStructTemplate->putData();
  }
  else
  {
	$htmlWriter->putDivOpenTag("main_1",STRING_NULL);
	$this->putHeader();
  $htmlWriter->putDivOpenTag("active_application_container_id",STRING_NULL);
	$this->putActiveApp();
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
  $htmlWriter->putDivOpenTag("main_2",STRING_NULL);
	$this->putBody();
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
	$htmlWriter->putDivOpenTag("footer",STRING_NULL);
	$this->putFooter();
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);	 
  }	
 }
 
 function putCodeBeforeBodyClose():void
 {
 	$htmlWriter = $this->getHtmlWriter();	
 	if ($this->getBootstrapEnabled())
 	 $htmlWriter->putScriptIncludeTag(CLIENT_BOOTSTRAP_PATH . DIR_SEP . JS_BOOTSTRAP);
    $delayedModules = $this->getAllDelayedModules();
    foreach($delayedModules as $mod)
    {
      $htmlWriter->putScriptIncludeTag($mod);
  	}
    $codeBeforeBodyClose = $this->getCodeBeforeBodyClose();
	if(! is_null($codeBeforeBodyClose))
	{
     $iter = $codeBeforeBodyClose->create();
	 $iter->reset();
     while($iter->hasMore())
     {		
	  $int = $iter->current();
	  if(is_a($int,Classes_info::JAVASCRIPT_CODE_CLASS) or is_a($int,Classes_info::JAVASCRIPT_CODE_TEMPLATE_CLASS)) 
	  {
       $htmlWriter->putScriptOpenTag("text/babel");
	   $int->putData();
	   $htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
	  }
	  $iter->next();
     }
    }	 
 }

}


?>