<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("Cheope_ns_interfaces_op_page_putBodyClasses.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("http.const.php");
require_once("filesystem.fun.php");
require_once("javascript.fun.php");
require_once("Creator.tra.php");


date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"interfaces");
define('THIS_PAGE',"interfaces.php");

class Cheope_ns_interfaces_op_page extends Cheope_ns_page
{
 Use Creator;
 
 const INTERFACE_NAME_SEP = Xml_interface_serializer::INTERFACE_NAME_SEP;
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }
 
 function putLinkTags():void
 {
 	parent::putLinkTags();
 	$htmlWriter = $this->getHtmlWriter();
 //	$htmlWriter->put("<style>.form_no_label_rows{margin:0px -10px 0px 0px;}" .
 //	".local_tabs_2{width:95%;}</style>");
  $htmlWriter->putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  "subModal" . STYLE_SHEET_FILE_POSTFIX);
  $htmlWriter->putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
 }

 function putClientScriptIncludeCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
  $interfaces = $this->getInterfacesContainer();

  if(! isset($_SESSION[SESSION_VAR_ACTIVE_APP])||(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)))
  {
   $interfaces->deleteByStringInType("javascript");
  }
  elseif(isset($_GET["Interfaccia"]))
  {
	 $interfaccia = $_GET["Interfaccia"]; 	  	 
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;  
   $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR; 
   $serializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$interfaccia);  
   $serializer->setXmlDir(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR);
   $serializer->setInterfacesDir($appXmlDir);
   $serializer->setDbStruct($GLOBALS["dbStructTreeLocal"]);
   $serializer->setDbQueries($GLOBALS["dbQueriesContainerLocal"]);
   $intContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   $serializer->setInterfacesContainer($intContainer);
   $serializer->setAppName($appName);
   $filesItems = Xml_interface_file_analyzer::getInterfaceItems(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . INTERFACES_DIR . DIR_SEP . $interfaccia);
   $nomePagina = $filesItems[1];
   $serializer->setPageName($nomePagina);  
   $scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;   
   $serializer->setScope($scope);     

   //
   // Carico le interfacce come stringhe, col loro nome completo.
   // 
   $serializer->setLoadInterfaceAsString(true);
   $serializer->setInterpolateConsts(false);
   $serializer->setLoadSpecialChars(true);
   $serializer->loadData();
   $items = $serializer->getItems();

//
// Visualizza lo stampino per i campi da aggiungere.
//   
   $fieldsArray = $this->getFieldsArray($items,$appXmlDir . DIR_SEP . $interfaccia,true);
//   print_r($fieldsArray);
//   echo "---------";
   $fieldsProfile = $this->getFieldsProfile($fieldsArray);
//   print_r($fieldsProfile);
//   echo "---------";
   $fieldsModel = $this->getFieldsModel($fieldsArray);
//   print_r($fieldsModel);
   $intJavascript1 = $interfaces->getInterface(OBJ_NONE,"Op4",Interfaces_info::INT_JAVASCRIPT_FRAGMENT,NUM_4);
   $intJavascript1->setHookId("fields_template");
   $javascriptTemplate = "var htmlWriter = this.getHtmlWriter();";
   $i2=0;
   foreach($fieldsModel as $fieldM) 
   {
   	$profile = matrix_lookup_value($fieldsProfile,$fieldM);
   	$javascriptTemplate = $javascriptTemplate . 
   	"var profile = '" . $profile . "';" .
   	"var model = util.ucFirst('" . $fieldM . "');" . 
   	"if(profile=='scalar')" .
    "{" .	
    "htmlWriter.put('<label>' + model + '</label><span>&nbsp;&nbsp;</span>' + " .
    "'<input id=\"' + model + '_new' + '\" type=\"text\" ' + " . 
    "' value=\"\"' + " .
    "'\"></input><span>&nbsp;&nbsp;</span>');" .	
    "}" .
    "else if(profile=='bool')" .
    "{" .
    "checked = model;" .
    "if(checked=='1')checkedStr='checked'; else checkedStr='';" .
    "htmlWriter.put('<label>' + model + '</label>' + " .
    "'<span>&nbsp;&nbsp;</span><input id=\"' + model + '_' + " . 
    "'new\"' + ' type=\"checkbox\" ' + checkedStr + ' ></input><span>&nbsp;&nbsp;</span>');" .  	
    "}" .
    "else if(profile=='array')" .
    "{" .
    "htmlWriter.put('<label>' + model + '</label><span>&nbsp;&nbsp;</span><textarea " .
    "id=\"' + model + '_new' + '\">');" .
    "htmlWriter.put('</textarea><span>&nbsp;&nbsp;</span>');" .	
    "}";
    $i2++;
    if(($i2 % 2)==0)
    {
     $i2 = 0;
     $javascriptTemplate = $javascriptTemplate . 
     "htmlWriter.put('<br/><br/>');";   	
    }
   } 
   $javascriptTemplate = $javascriptTemplate . "htmlWriter.put('<button type=\"button\" onclick=\"button_3_onclick()\">' + '" . 
   "+" . "' + '</button>');";
   $intJavascript1->setJavascriptFragment($javascriptTemplate); 

// 
// Imposta la sorgente del Drag and drop per la lista dei campi
//   
   $intJavascript2 = $interfaces->getInterface(OBJ_NONE,"Op5",Interfaces_info::INT_JAVASCRIPT_FRAGMENT,NUM_5);
   $intJavascript2->setHookId(STRING_NULL); 
   $javascriptTemplate = "var mainUl = \$('#main_list').get(0);" .
   "if(mainUl !== undefined){" . 
   "dndSource = " .
   "new dojo.dnd.Source('main_list',{skipForm:true," .
   "creator:function(actItem,actHint){" . 
   "var num = \$(\"#main_list > li\").size();" .   
   "var li = document.createElement('li');" .
   "li.id = 'Field_' + num;" .
   "var div = document.createElement('div');" . 
   "div.style.lineHeight='25px';";
   $i2=0;
   $i3=0;
   
   //echo "WWWWWWWWWWWWWWW";
   //print_r($fieldsModel);
   //echo "WWWWWWWWWWWWWWW";
   
   foreach($fieldsModel as $fieldM) 
   {
   	$profile = matrix_lookup_value($fieldsProfile,$fieldM);
   	//echo $profile;
   	//echo 'AAAAA';
   	//echo $fieldM;
   	//echo "BBBBB";
   	$javascriptTemplate = $javascriptTemplate . 
   	"var profile = '" . $profile . "';" .
   	"var model1 = '" . $fieldM . "';" .
   	"var model = util.ucFirst('" . $fieldM . "');" . 
   	"if(profile == 'scalar')" .
    "{" .	
    "var span0 = document.createElement('span');" .
    "span0.id = 'item' + '_' + num + '_' + '" . $i3 . "';" .
    "var label = document.createElement('label');" .
    "label.innerHTML = model;" .
    "var span1 = document.createElement('span');" .
    "span1.innerHTML = '&nbsp;&nbsp;';" .
    "var input = document.createElement('input');" .
    "input.id = model + '_' + num;" . 
    "input.type = 'text';" .
    "input.value = actItem[model];" .
    "\$(input).attr('role',model1);" .
    "var span2 = document.createElement('span');" .
    "span2.innerHTML = '&nbsp;&nbsp;';" .
    "span0.appendChild(label);" .
    "span0.appendChild(span1);" .
    "span0.appendChild(input);" .
    "span0.appendChild(span2);" .
    "div.appendChild(span0);" .
    "}" .
    "else if(profile=='bool')" .
    "{" .
    "checked = model;" .
    "var span0 = document.createElement('span');" .
    "span0.id = 'item' + '_' + num + '_' + '" . $i3 . "';" .
    "var label = document.createElement(model);" .
    "var span = document.createElement('span');" .
    "span.innerHTML = '&nbsp;&nbsp;';" .
    "var input = document.createElement(model + '_new');" .
    "input = document.createElement('input');" .
    "input.id = model + '_' + num;" .
    "input.type='checkbox';" .
    "input.checked = actItem[model];" . 
    "var label = document.createElement('label');" .
    "label.innerHTML = model;" .
    "span0.appendChild(label);" .
    "span0.appendChild(span);" .	
    "span0.appendChild(input);" .
    "div.appendChild(span0);" .
    "}" .
    "else if(profile=='array')" .
    "{" .
    "var span0 = document.createElement('span');" .
    "span0.id = 'item' + '_' + num + '_' + '" . $i3 . "';" .
    "var label = document.createElement('label');" .
    "var span = document.createElement('span');" .
    "span.innerHTML = '&nbsp;&nbsp;';" .
    "var textarea = document.createElement('textarea');" .
    "textarea.id = model + '_' + num;" .
    "\$(textarea).attr('role',model1);" .
    "textarea.innerHTML = actItem[model];" .
    "label.innerHTML = model;" .
    "span0.appendChild(label);" .
    "span0.appendChild(span);" .
    "span0.appendChild(textarea);" .
    "div.appendChild(span0);" .
    "} ";
    $i2++;
    $i3++;
    if(($i2 % 2)==0)
    {
     $i2 = 0;
     $javascriptTemplate = $javascriptTemplate . 
     "var br1 = document.createElement('br');" .
     "div.appendChild(br1);" .
     "li.appendChild(div);" .
     "var div = document.createElement('div');" .
     "div.style.lineHeight='25px';";
    }
   }
   $javascriptTemplate = $javascriptTemplate . "li.appendChild(div);";
   $javascriptTemplate = $javascriptTemplate . "var img = document.createElement('img');" .
   "img.src=\"./img/close.gif\";" .
   "img.onclick=function(){var parentObj=\$(this).parent();parentObj.remove();" .
   "var parentObj=\$(this).parent().remove();var i=0;" .
   "\$('#main_list li').each(function(){this.id = 'Field_' + i;var j=0;" .
   "\$(this).find('div > span').each(function(){this.id = 'item' + '_' " .
   " + i + '_' + (j++)});i++;j=0});" .  
   "};" .
   "li.appendChild(img);" .
   "var hr = document.createElement('hr');" .
   "li.appendChild(hr);";
   $javascriptTemplate = $javascriptTemplate . "return {node: li, data: actItem, type: \"text\"};" .
   "}})};";
   $intJavascript2->setJavascriptFragment($javascriptTemplate);   
  }
  parent::putClientScriptIncludeCode();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
  {
   putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
   $htmlWriter->putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SELECTION);
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>");
 	 $htmlWriter->put("<script>dojo.require(\"dojo.dnd.Source\");</script>"); 
   $htmlWriter->putGenericHtmlString("<script>" .
	 "dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>");
  }
 }
 
 function putActiveApp():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  putActiveApp($htmlWriter);
 }
 
 //
 // Estrae per ogni campo 
 // il valore della proprietà associata
 // per tutte le proprietà dell'interfaccia che iniziano per '$'
 //
 function getFieldsArray(array $actItems,string $actInterfaccia,bool $actInit=false):array
 {
 	$interfaces = $this->getInterfacesContainer();
  $fieldsArray=array(array());	
  if(Xml_interface_file_analyzer::is_a_data_interface($actInterfaccia))
  {   
    //print_r($actItems);
    $fields = $actItems["dataFields"];
    //print_r($fields);
	//die('mmmm');    
    foreach($actItems as $ind=>$item)
    {
    	if(($ind=="dataFields")||($ind=="dataFieldsDomains")||
    	($ind=="dataFieldsDomainsValues"))
    	{
    		if($actInit)
    		$fieldsArray[0][$ind] = STRING_NULL;
    		$ct=0;
    		foreach($item as $ind2=>$propVal)
    		{
    			if((is_numeric($ind2))&&(! is_array($propVal)))
    			{
				 if(is_object($propVal))
				  $propVal=$propVal->getItemName();
    			 $propVal = str_replace(STRING_DOUBLE_QUOTE,'\\\"',$propVal);
    			 $fieldsArray[$ct][$ind] = $propVal;
    			}
    			else
    			 $fieldsArray[$ct][$ind] = STRING_SINGLE_QUOTE . $ind2 . "' => " . 
    			 str_replace(STRING_DOUBLE_QUOTE,'\\\"',var_export($propVal,true));
    			 //echo $fieldsArray[$ct][$ind];
           //$fieldsArray[$ct][$ind] = "\"" . $ind2 . "\" => " . 
    			 //var_export($propVal,true);
    		  $ct++;
    		}
    	}
    	elseif(is_array($item))
    	{
    		$fcInd = substr($ind,0,1);
    		//
    		// Testa se è una proprietà con valore array contenente nomi di campi 
    		// che quindi sono proprietà booleane degli stessi.
    		//
    		/*if((array_is_numeric($item))&& Html_data_interface::isAPropFieldBool($item,$fields)
    		&&($fcInd==STRING_DOLLAR))
    		{
    		  $ind = substr($ind,1,strlen($ind)-1);
    		  foreach($fields as $ind3=>$field)
    		  {
    		 	 if(in_array($field,$item,true))
    		 	 {
    		 	   $fieldsArray[$ind3][$ind] = true;
    		 	 }
    		 	 else
    		 	  $fieldsArray[$ind3][$ind] = false;
    		  }
    		}*/
    		if((Html_data_interface::sIsAFieldSuitableArray($item,$fields) 
    		&&($fcInd==STRING_DOLLAR)))   		
    		{
			 //die('GGGGGG');
    		 $ind = substr($ind,1,strlen($ind)-1);
    		 $newItemArray = Html_data_interface::sConvertToKeysNumeric($item,$fields);
    		 if($actInit)
    		  $fieldsArray[0][$ind] = STRING_NULL;
    		 foreach($fields as $ind3=>$field)
    		 {
    		 	 $propVal=STRING_NULL;
           if(isset($newItemArray[$ind3]))
           {
           	$propVal = $newItemArray[$ind3];
           } 
           //$fieldsArray[$ind3][$ind] = $propVal;
    		   $fieldsArray[$ind3][$ind] = str_replace(STRING_DOUBLE_QUOTE,'\\\"',$propVal);
    	   }
    	  }
     	}	
    }
  }
  return $fieldsArray; 	
 }
 
 
// Estrae il profilo di tipo di dati per ogni campo 
// dall'array dei dati.
// Ritorna un array di array coi tipi di campo.
//
 function getFieldsProfile(array $actFields):array
 {
 	$profile = array();
	/*echo "WWWWWWWW";
	print_r($actFields);
	echo "EEEEEEEEE";*/
 	foreach($actFields as $ind=>$field)
 	{
 	 foreach($field as $ind2=>$prop)
 	 {
		/*if(gettype($prop)=='boolean')
		 echo 'BOOLEAN1';
	    if($prop=='false')
		 echo 'BOOLEAN2';*/
 	 	if(is_array($prop)||($ind2=="dataFieldsDomainsValues"))
 	 	 $profile[$ind][$ind2]="array";
 	 	elseif((is_string($prop)&&($prop!='false')&&($prop!='true')) || is_int($prop))
		 $profile[$ind][$ind2]="scalar";
 	 	else
		{
 	 	 $profile[$ind][$ind2]="bool";
		 //echo "WWWWW";
		}
		//echo($ind2);
 	 }
 	}
	//print_r($profile);
 	return $profile;
 }
 
// Estrae un array con tutte le propietà
//
 function getFieldsModel(array $actFieldsArray):array
 {
 	$fieldsModel = array();
 	foreach($actFieldsArray as $fieldArray)
 	{
 		foreach($fieldArray as $ind=>$field)
 		{
 			if(! in_array($ind,$fieldsModel))
 			 $fieldsModel[] = $ind;
 		}
 	}
 	return $fieldsModel;
 }
 
 function getPagesTemplate(array $actPages):Html_data_template
 {
 	 $interfaceHtmlDataTemplate1 = Creator::create(Interfaces_info::INT_HTML_DATA_TEMPLATE,STRING_NULL); 
   $interfaceHtmlDataTemplate1->setDataFields(array(FIELD_TEMP_1));
   $interfaceHtmlDataTemplate1->setDataFieldsDomains(
   array(Int_domain::FIELD_DOMAIN_ATOMIC_STATIC));
   $interfaceHtmlDataTemplate1->setHtmlTemplate("<div id=\"Pages_menu_id\" " .
   "dojoType=\"dijit.Menu\" targetNodeIds=\"Nome_pagina\" style=\"display:none\" >" .
   "{TEMP_1}</div>");
   $fieldDomainValue=STRING_NULL;  
   foreach($actPages as $page)
   {
   	$fieldDomainValue = $fieldDomainValue . 
   	"<div dojoType=\"dijit.MenuItem\">" . $page . 
   	"<script type=\"dojo/method\" event=\"onClick\" args=\"evt\">" .
    "\$(\"#Nome_pagina\").val(\"" . $page . "\");" .
    "</script></div>";
   } 
   $interfaceHtmlDataTemplate1->setDataFieldDomainValueByPos(0,$fieldDomainValue);
   return  $interfaceHtmlDataTemplate1;
 }
   
 function putBody():void
 {
 	$interfaces = $this->getInterfacesContainer();
 	
 	if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&
 	($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL)&&
 	(! isset($_GET["Interfaccia"])))
 	{
 	 $nomePagina = (isset($_GET["NomePagina"])?$_GET["NomePagina"]:STRING_NULL);
 	 $interfaceForm1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_FORM_2,NUM_1);
   $interfaceForm1->setDataFieldDomainValueByName(FIELD_NOME_PAGINA,$nomePagina);
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $interfacesFiles = Interfaces_model::getAllInterfacesByPage($appName,$nomePagina);
   $interfaceStdFiles = Interfaces_model::getAllStdInterfaces($appName);
   $interfacesFiles = array_merge($interfacesFiles,$interfaceStdFiles);
   $pages = Interfaces_model::getAllPages($appName); 
   $interfaceDivTag0 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_0);
   $interfaceDivTagContainer0 = $interfaceDivTag0->getInterfacesContainer(); 
   $intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);   
   $attribs = array("for" =>FIELD_LISTA_INTERFACCE);
   $intLabel1->setTagBody(LABEL_LISTA_INTERFACCE);
   $intLabel1->setAttribs($attribs); 
   $intHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_1);
   $intHtmlFragment1->setHtmlFragment(ENTITY_SPACE . ENTITY_SPACE); 
   $intHtmlFragment1->setDivEnvelope(false);   
   $interfaceSelectTag1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
   $attribs = array("name" => FIELD_LISTA_INTERFACCE,"id" => FIELD_LISTA_INTERFACCE,
   "onchange"=>"lista_interfacce_onChange(this);");
   $interfaceSelectTag1->setAttribs($attribs);
   Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   $interfacesSelectContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   $interfaceOptionTag = new Html_option_tag();
   $attribs2 = array();
   $interfaceOptionTag->setTagBody(STRING_NULL);
   $interfaceOptionTag->setAttribs($attribs2);
   $interfacesSelectContainer1->add($interfaceOptionTag);
   foreach($interfacesFiles as $ind=>$interfaceFile)
   {
   	$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
   	$attribs2 = array("value"=>$interfaceFile);
   	$interfaceOptionTag->setTagBody($ind);
   	$interfaceOptionTag->setAttribs($attribs2);
   	$interfacesSelectContainer1->add($interfaceOptionTag);
   }
   $interfaceSelectTag1->setInterfacesContainer($interfacesSelectContainer1);
   $interfaceHtmlDataTemplate1=$this->getPagesTemplate($pages);
   $interfaceDivTagContainer0->add($intLabel1);
   $interfaceDivTagContainer0->add($intHtmlFragment1);
   $interfaceDivTagContainer0->add($interfaceSelectTag1);
   $interfaceDivTagContainer0->add($interfaceHtmlDataTemplate1);
   $interfaceDivTag0->setInterfacesContainer($interfaceDivTagContainer0);
   
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();  
  }
 	elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&
 	($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL)&&
 	(isset($_GET["Interfaccia"])))
 	{
 	 $nomePagina =  $_GET["NomePagina"];
 	 $interfaccia = $_GET["Interfaccia"]; 	  	 
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;
   $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
   $interfacesFiles = array();
   $interfacesFiles = Interfaces_model::getAllInterfacesByPage($appName,$nomePagina,true);
   $interfaceStdFiles = Interfaces_model::getAllStdInterfaces($appName);
   $interfacesFiles = array_merge($interfacesFiles,$interfaceStdFiles);
   
   $interfaceForm1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_FORM_2,NUM_1);
   $interfaceForm1->setDataFieldDomainValueByName(FIELD_NOME_PAGINA,$nomePagina);

   $pages = Interfaces_model::getAllPages($appName); 

   $interfaceDivTag0 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_0); 
   $interfaceDivTagContainer0 = $interfaceDivTag0->getInterfacesContainer(); 
   
   $intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
   $attribs = array("for" =>FIELD_LISTA_INTERFACCE);
   $intLabel1->setTagBody(LABEL_LISTA_INTERFACCE);
   $intLabel1->setAttribs($attribs);
   //
   // Frammento che serve per la spaziatura e l'incolonnamento dei campi.
   //
   $intHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL);
   $intHtmlFragment1->setHtmlFragment(ENTITY_SPACE .  ENTITY_SPACE); 
   $intHtmlFragment1->setDivEnvelope(false); 
   $interfaceSelectTag1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
   $attribs = array("name" => FIELD_LISTA_INTERFACCE,"id" => FIELD_LISTA_INTERFACCE,
   "onchange" => "lista_interfacce_onChange(this)");
   $interfaceSelectTag1->setAttribs($attribs);
   $interfacesSelectContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   $interfacesSelectContainer4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   //
   // Determino l'array degli attributi per il combo delle interfacce
   //
   //  
   $j=0;
   $attribsAlt=array(); 
   foreach($interfacesFiles as $ind=>$interfaceFile)
   {
   	$fileItems = preg_split(STRING_SLASH . self::INTERFACE_NAME_SEP . STRING_SLASH,$interfaceFile);
   	if(($fileItems[0] != STANDARD_MOD_PREFIX)&&($interfaceFile != $interfaccia))
   	{
   	 $interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
     $attribsAlt = array("value"=>((is_string($interfaceFile))?($interfaceFile):
     ($interfaceFile->getCompleteInterfaceId())));
   	 $interfaceOptionTag->setTagBody($ind);
   	 $interfaceOptionTag->setAttribs($attribsAlt);
   	 $interfacesSelectContainer4->add($interfaceOptionTag);
   	 $j++;
    }
   }  
   
   //
   //      
   // Contatore tags
   //
   $j=0;
   foreach($interfacesFiles as $ind=>$interfaceFile)
   {
   	$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
   	if($interfaceFile==$interfaccia)
   	 $attribs2 = array("value"=>((is_string($interfaceFile))?($interfaceFile):
     ($interfaceFile->getCompleteInterfaceId())),"selected"=>STRING_NULL);
   	else
     $attribs2 = array("value"=>((is_string($interfaceFile))?($interfaceFile):
     ($interfaceFile->getCompleteInterfaceId())));
   	$interfaceOptionTag->setTagBody($ind);
   	$interfaceOptionTag->setAttribs($attribs2);
   	$interfacesSelectContainer1->add($interfaceOptionTag);
   	$j++;
   }
   $interfaceHtmlDataTemplate1=$this->getPagesTemplate($pages);
   $interfaceSelectTag1->setInterfacesContainer($interfacesSelectContainer1);
   $interfaceDivTagContainer0->add($intLabel1);
   $interfaceDivTagContainer0->add($intHtmlFragment1);
   $interfaceDivTagContainer0->add($interfaceSelectTag1);
   $interfaceDivTagContainer0->add($interfaceHtmlDataTemplate1);
   
   $serializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$interfaccia);
   $serializer->setXmlDir(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR);
   $serializer->setInterfacesDir(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . INTERFACES_DIR);
   $serializer->setDbStruct($GLOBALS["dbStructTreeLocal"]);
   $serializer->setDbQueries($GLOBALS["dbQueriesContainerLocal"]);
   $intContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   $serializer->setInterfacesContainer($intContainer);
   $serializer->setAppName($appName);

   $scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;    
   $serializer->setScope($scope);    

   $filesItems = preg_split(STRING_SLASH . self::INTERFACE_NAME_SEP . 
   STRING_SLASH,$interfaccia);
   if(count($filesItems)==1)
      $nomePagina = Xml_interface_file_analyzer::getScalarProperty(
      $appXmlDir . DIR_SEP . $interfaccia,"pageName");
   else
    $nomePagina = $filesItems[1];
   $serializer->setPageName($nomePagina);
         
   //
   // Carico le interfacce come stringhe, col loro nome completo.
   // 
   $serializer->setLoadInterfaceAsString(true);
   $serializer->setInterpolateConsts(false);
   $serializer->setLoadSpecialChars(true);
   $serializer->loadData();
   $items = $serializer->getItems();
   //print_r($items);
   $intBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
   $interfaceDivTagContainer0->add($intBr1);
   $intBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
   $interfaceDivTagContainer0->add($intBr2);
   $intHr1 = Creator::create(Interfaces_info::INT_HTML_HR_TAG,STRING_NULL);
   $interfaceDivTagContainer0->add($intHr1); 
   $intBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
   $interfaceDivTagContainer0->add($intBr3);

   // Caricamento tab #0

   $selectCounter=0;
   $objNodeFields=array();
   $objNodeFields1 =array();
   //print_r($items);
   //die();
   foreach($items as $ind=>$item)
   {
   /*	echo "<[";
   	var_dump($item);
   	echo "]>";*/
   	$factory = Creator::create(getClassNameForCreate(Classes_info::PUTBODY_FACTORY_CLASS),STRING_NULL,$item,$ind,$scope);
	  $factory->setDbStructTree($GLOBALS["dbStructTreeLocal"]);
	  $factory->setDbQueriesContainer($GLOBALS["dbQueriesContainerLocal"]);
	  $factory->setItems($items);
	  $factory->setAppDir($appDir);
	  $factory->setDivTagContainer( $interfaceDivTagContainer0);
	  $factory->setIntHtmlFragment( $intHtmlFragment1);
	  $factory->setInterfacesFiles($interfacesFiles);
	  $factory->setIntSelectContainer($interfacesSelectContainer4);
	  $factory->setNomePagina($nomePagina);
	  $factory->setIntSelectTag($interfaceSelectTag1);
	  $factory->setSelectCounter($selectCounter++);
	  $factory->setFields($objNodeFields1);
	 	$branchObj = $factory->create();
	 	if(! is_null($branchObj))
	 	{
	   $branchObj->exec();
	   //$selectCounter = $branchObj->getSelectCounter();
     $objNodeFields = $branchObj->getFields();
     if(count($objNodeFields)>0)
      $objNodeFields1 = $objNodeFields;
	  }
	 }  
  
   $interfaceDivTag1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_1); 
   $interfaceDivTagContainer1 = $interfaceDivTag1->getInterfacesContainer(); 

   //
   // Se interfaccia dati, caricamento tab #1
   //   
    $intTabs1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_LOCAL_TABS_2,NUM_0);
    $domainsValues = $intTabs1->getDataFieldsDomainsValues();
    $domainsValues[0][] = LABEL_CAMPI_RAGGRUPPATI;
    $domainsValues[1][] = "#id-1";
    $intTabs1->setDataFieldsDomainsValues($domainsValues);
	//print_r($items);
    $fieldsArray = $this->getFieldsArray($items,$appXmlDir . DIR_SEP . $interfaccia,false);   
    //print_r($fieldsArray);echo "<br><br>";
    $fieldsProfile = $this->getFieldsProfile($fieldsArray);
    //print_r($fieldsProfile);echo "<br><br>";
    $fieldsModel = $this->getFieldsModel($fieldsArray);
    //print_r($fieldsModel);
    $htmlDataTemp2 = Creator::create(Interfaces_info::INT_HTML_DATA_TEMPLATE,STRING_NULL,OBJ_NONE,OP_NONE,NUM_2);
    //$htmlDataTemp2 = new Html_data_template(OBJ_NONE,OP_NONE,NUM_2);
    $htmlDataTemp2->setDataFields($fieldsModel);
    $num = count($fieldsModel);
    $fieldsDomains = array();
    $fieldsDomainsValues = array();
    foreach($fieldsModel as $ind=>$model)
    {
    	$fieldsDomains[] = Int_domain::FIELD_DOMAIN_OBJ;
    }
    $htmlDataTemp2->setDataFieldsDomains($fieldsDomains);
    $template = STRING_NULL;
    $i1=0;
    $i2=0;
	
    foreach($fieldsModel as $ind=>$model)
    {
     if($i2==0)
      $template = $template . "<div style=\"line-height:25px;\">";
     $template = $template . "<span id=\"item_{COUNT}_" . $i1 . "\">{" . 
      strToUpper($model) . "}</span>";
     $phpDataFrag1 = Creator::create(Interfaces_info::INT_PHP_DATA_FRAGMENT,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
     $phpDataFrag1->setDataFields(array($model,"COUNT"));
     $phpDataFrag1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC));
     $phpDataFrag1->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE,
     Int_domain::FIELD_DOMAIN_VALUE_NONE));
     $phpDataFrag1->setExternalPar($fieldsProfile);
     $labelModel = ucFirst($model);
     $phpDataFragment = "\$extPar = \$thisObj->getExternalPar();" .     	
     "\$htmlWriter = \$thisObj->getHtmlWriter();" .
     "if(isset(\$extPar['#COUNT#']['" . $model . "'])) \$profile=\$extPar['#COUNT#']['" . $model . "'];" .
     "else \$profile='';" .
     "if(\$profile=='scalar')" .
      "{" .	
    	"\$htmlWriter->put(\"<label>" . $labelModel . "</label><span>&nbsp;&nbsp;</span>" .
    	"<input id=\\\"" . $labelModel . "_" . "#COUNT#\\\" type=\\\"text\\\" role=\\\"" . 
    	lcFirst($labelModel) . "\\\" " .
    	" value=\\\"#" . strToUpper($model) . 
    	"#\\\"></input><span>&nbsp;&nbsp;</span>\");" .	
      "}" .
      "elseif(\$profile=='bool')" .
      "{" .
      "\$checked=\"#" . strToUpper($model) . "#\";" .
      "if(\$checked=='1') \$checkedStr='checked'; else \$checkedStr='';" .
    	"\$htmlWriter->put(\"<label>" . $labelModel . "</label>" .
    	"<span>&nbsp;&nbsp;</span><input id=\\\"" . $labelModel . "_" . 
    	"#COUNT#\\\"" . " role=\\\"" . lcFirst($labelModel) .
    	"\\\"" . " type=\\\"checkbox\\\" \" . " . "\$checkedStr" . 
    	" . \" value=\\\"#" . strToUpper($model) . 
    	"#\\\"></input><span>&nbsp;&nbsp;</span>\");" .  	
      "}" .
      "elseif(\$profile=='array')" .
      "{" .
      "\$innerItems=\"#" . strToUpper($model) . "#\";" .
    	"\$htmlWriter->put(\"<label>" . $labelModel . "</label><span>&nbsp;&nbsp;</span><textarea " .
    	"role=\\\"" . lcFirst($labelModel) . "\\\" "  .
    	"id=\\\"" . $labelModel . "_" . "#COUNT#\\\">\");" .
    	"\$htmlWriter->put(\$innerItems);" .
    	"\$htmlWriter->put(\"</textarea><span>&nbsp;&nbsp;</span>\");" .
      "};";
      //echo "eval('\$innerItems=\\'#" . strToUpper($model) . "#\\';');";
      //echo $phpDataFragment;
      $phpDataFrag1->setPhpFragment($phpDataFragment);
      $fieldsDomainsValues[] = $phpDataFrag1;
      $i1++;
      $i2++;
      if(($i1 % 2)==0)
      {
       $i2=0;
       $template = $template . "</div>";
      }
    }
    
    if(($i1 % 2)!=0)
     $template = $template . "</div>";
    $template = $template . "<br/><img src=\"./img/close.gif\" " .
    "onclick=\"var parentObj=\$(this).parent().remove();var i=0;" .
    "\$('#main_list li').each(function(){this.id = 'Field_' + i;var j=0;" .
    "\$(this).find('div > span').each(function(){this.id = 'item' + '_' " .
    " + i + '_' + (j++)});i++;j=0});" .
    "\"/><hr/>";
    $template = "<li class=\"dojoDndItem\" id=\"Field_{COUNT}\">" . $template . "</li>";
   $htmlDataTemp2->setDataFieldsDomainsValues($fieldsDomainsValues);
   $htmlDataTemp2->setHtmlTemplate($template);
   //print_r($fieldsArray);
   $htmlDataTemp2->setDataSource($fieldsArray); 
   $htmlDataTemp2->setInheritData(true);
   $htmlDataTemp1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_DATA_TEMPLATE,NUM_1);
   $htmlDataTemp1->setDataFieldDomainValueByName(FIELD_OBJ_1,$htmlDataTemp2);
   $intHtmlLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
   $intHtmlLabel1->setTagBody(LABEL_SOVRASCRIVI_CAMPI_SEPARATI);
   $intHtmlLabel1->setAttribs(array("style"=>"font-weight:bold;"));
   $intHtmlInput1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
   $intHtmlInput1->setAttribs(array("id"=>"override_separated","type"=>"checkBox"));
   $interfaceDivTagContainer1->add($intHtmlLabel1);
   $interfaceDivTagContainer1->add($intHtmlInput1);   
   $interfaceDivTagContainer1->add($htmlDataTemp1); 
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();
  }
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
  {
   $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_5)->getInterfacesContainer()->deleteItem(1);
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();
  } 
  else
  {
	 $int = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_TEMP_MSG,NUM_0);
   $int->putData();
  }
 }
}
?>