<?
namespace Cheope_ns\fw;
require_once("generic.const.php"); 
require_once("class.const.php"); 
require_once("Item_stack.class.php"); 
require_once("Xml_interface_serializer.class.php");
require_once("Interfaces_container.class.php");
require_once("Output.int.php");
require_once("Executable.int.php");
require_once("Stringable.int.php"); 
require_once("Container.int.php");
require_once("Standard.int.php");
require_once("Dyn_page.int.php");
require_once("Autoload.int.php");
require_once("Decorator.int.php");
require_once("Creator.tra.php");
require_once("Classes_info.class.php"); 
require_once("Interfaces_info.class.php"); 

abstract class Generic_interface implements Output,
Stringable,Container,Standard,Dyn_page,Autoload,Decorator
{
 use Creator/*,Serialize_props*/; 
 
 const ERROR_1 = "Generic_interface:Errore nell'inserimento del dumper.";
// const ERROR_2 = "Generic_interface:Errore nell'inserimento del serializer.";
 
 const INTERFACE_ID_CHAR_SEP = STRING_UNDERSCORE;
 const INTERFACE_INSTANCE_CHAR_SEP = STRING_EXCLAMATION_MARK;
 const INTERFACE_NAME_SEP = STRING_EXCLAMATION_MARK;
 
 const INT_AJAX_HANDLER = "ajax_handler"; 
 const INT_NLEVELS_MENU = "nLevels_menu";
 const INT_LEVEL_MENU = "level_menu";
 const INT_LEVEL_MENU_2 = "level_menu_2";
 const INT_TREE_CTRL = "tree_ctrl"; 
 const INT_FOREST_CTRL = "forest_ctrl"; 
 const INT_DB_NAVIGATOR = "db_navigator"; 
 const INT_NLEVELSMENU = "nLevels_menu"; 
 const INT_NLEVELS_TREE_CTRL = "nLevels_tree_ctrl"; 
 const INT_NLEVELS_FOREST_CTRL = "nLevels_forest_ctrl"; 
 const INT_CURTAIN_MENU = "curtain_menu"; 
 const INT_MENUBAR = "menuBar"; 
 const INT_MENUBAR_2 = "menuBar_2"; 
 const INT_SHEET = "sheet"; 
 const INT_FORM = "form"; 
 const INT_FORM_2 = "form_2"; 
 const INT_TABS = "tabs"; 
 const INT_SCROLL_TABLE = "scrolling_table"; 
 const INT_FRAME = "frame"; 
 const INT_TEMP_MSG = "temp_msg"; 
 const INT_HTML_PAGE = "html_page"; 
 const INT_HTML_FRAMESET_PAGE = "html_frameset_page"; 
 const INT_CSV_TABLE = "csv_table"; 
 const INT_BARGRADEX = "barGradex"; 
 const INT_HTML_FRAGMENT = "html_fragment"; 
 const INT_HTML_FILE_FRAGMENT = "html_file_fragment"; 
 const INT_HTML_DATA_TEMPLATE = "html_data_template";
 const INT_XML_DATA_TEMPLATE = "xml_data_template"; 
 const INT_HTML_INPUT_CTRL = "html_input_ctrl"; 
 const INT_HTML_DIV_TAG = "html_div_tag"; 
 const INT_HTML_A_TAG = "html_a_tag"; 
 const INT_HTML_B_TAG = "html_b_tag"; 
 const INT_HTML_BR_TAG = "html_br_tag"; 
 const INT_HTML_BUTTON_TAG = "html_button_tag"; 
 const INT_HTML_HR_TAG = "html_hr_tag"; 
 const INT_HTML_IMG_TAG = "html_img_tag"; 
 const INT_HTML_LABEL_TAG = "html_label_tag"; 
 const INT_HTML_LI_TAG = "html_li_tag"; 
 const INT_HTML_OL_TAG = "html_ol_tag"; 
 const INT_HTML_OPTION_TAG = "html_option_tag"; 
 const INT_HTML_P_TAG = "html_p_tag"; 
 const INT_HTML_SPAN_TAG = "html_span_tag"; 
 const INT_HTML_SELECT_TAG = "html_select_tag"; 
 const INT_HTML_TEXTAREA_TAG = "html_textarea_tag"; 
 const INT_HTML_UL_TAG = "html_ul_tag"; 
 const INT_HTML_SCRIPT_TAG = "html_script_tag"; 
 const INT_UPLOADED_FILE_MANAGER = "uploaded_file_manager"; 
 const INT_HTML_TAGS = "html_tags"; 
 const INT_HTML_TAG = "html_tag"; 
 const INT_PHP_CLASS_GEN = "class_gen"; 
 const INT_GRAMMAR_RULE_GEN = "grammar_rule_gen"; 
 const INT_GRAMMAR_RULES_GEN = "grammar_rules_gen"; 
 const INT_GRAMMAR_DEFS_XML_READER = "grammar_defs_xml_reader"; 
 const INT_DYN_PAGE_LOADER = "dyn_page_loader"; 
 const INT_PHP_FRAGMENT = "php_fragment"; 
 const INT_PHP_DATA_FRAGMENT = "php_data_fragment"; 
 const INT_JAVASCRIPT_DATA_TEMPLATE = "javascript_data_template"; 
 const INT_JAVASCRIPT_DATA_FRAGMENT = "javascript_data_fragment"; 
 const INT_JAVASCRIPT_FRAGMENT = "javascript_fragment"; 
 const INT_SIMPLE_TABLE = "simple_table"; 
 const INT_DIV_FRAME = "div_frame"; 
 const INT_LOCAL_TABS = "local_tabs"; 
 const INT_SENDMAIL = "sendMail"; 
 const INT_HTML_FORMATTED_INTERFACE = "html_formatted_interface";
 const INT_HTML_DATA_INTERFACE = "html_data_interface";
 const INT_XML_DATA_INTERFACE = "Xml_data_interface";  
 const INT_XML_FORMATTED_INTERFACE = "xml_formatted_interface";
 const INT_FCKEDITOR = "FCKEditor"; 
 const INT_JAVASCRIPT_DATA_TXTEDITOR = "javascript_data_txteditor"; 
 const INT_JAVASCRIPT_DATA_ACE_TXTEDITOR = "javascript_data_ace_txteditor"; 
 const INT_ACCORDION = "accordion"; 
 const INT_LOCAL_TABS_2 = "local_tabs_2"; 
 const INT_HTML_DATA_FILE_TEMPLATE = "html_data_file_template"; 
 const INT_SPIN = "spin"; 
 const INT_SIMPLE_LAYOUT = "simple_layout"; 
 const INT_TWO_COLUMNS_LAYOUT = "two_columns_layout"; 
 const INT_THREE_COLUMNS_LAYOUT = "three_columns_layout"; 
 const INT_TB_LAYOUT = "tb_layout"; 
 const INT_TB_SIMPLE_LAYOUT = "tb_simple_layout"; 
 const INT_TB_TWO_COLUMNS_LAYOUT = "tb_two_columns_layout"; 
 const INT_HTML_FIELDSET_DECORATOR = "html_fieldset_decorator"; 
 const INT_PHP_SWITCH_STRUCT = "php_switch_struct"; 
 const INT_FORM_SECTION = "form_section"; 
 const INT_FPDF_TEMPLATE = "fpdf_template"; 
 const INT_FPDF_FIELD_H = "fpdf_field_h"; 
 const INT_FPDF_FIELD_V = "fpdf_field_v"; 
 const INT_FPDF_IMG = "fpdf_img"; 
 const INT_FPDF_TXT = "fpdf_txt"; 
 const INT_FPDF_FIELD_TEMPLATE = "fpdf_field_template"; 
 const INT_BOOTSTRAP_TABLE = "bootstrap_table"; 
 const INT_BOOTSTRAP_JUMBOTRON = "bootstrap_jumbotron"; 
 const INT_BOOTSTRAP_TABS = "bootstrap_tabs"; 
 const INT_BOOTSTRAP_CAROUSEL = "bootstrap_carousel"; 
 const INT_BOOTSTRAP_NAVBAR = "bootstrap_navbar"; 
 const INT_BOOTSTRAP_BUTTON_DROPDOWN = "bootstrap_button_dropdown";
 const INT_POP3MAIL = "pop3Mail";
 const INT_SUBNAV = "subnav";
 const INT_ICON_BAR_VERT = "icon_bar_vert";
 const INT_ICON_BAR_HOR = "icon_bar_hor";
 const INT_SPLITNAV = "splitnav";
 const INT_ICON_NAVBAR = "icon_navbar";
 const INT_SEARCH_BAR = "search_bar";
 const INT_FIXED_SIDEBAR = "fixed_sidebar";
 const INT_SIDENAV = "sidenav";
 const INT_SIDEBAR = "sidebar";
 const INT_HOR_SCROLL_MENU = "hor_scroll_menu";
 const INT_BOTTOM_NAVBAR = "bottom_navbar";
 const INT_RESP_BOTTOM_NAVBAR = "resp_bottom_navbar";
 const INT_SIMPLE_LOCAL_TABS = "simple_local_tabs";
 const INT_VERT_LOCAL_TABS = "vert_local_tabs";
 const INT_TAB_HEADERS = "tab_headers";
 const INT_FULLSCREEN_SLIDE_NAV = "fullscreen_slide_nav";
 const INT_OFFCANVAS_MENU = "offCanvas_menu";
 const INT_EQUAL_WIDTH_NAVBAR = "equal_width_navbar";
 const INT_FIXED_TOP_MENU = "fixed_top_menu";
 const INT_SLIDE_DOWN = "slide_down";
 const INT_HIDE_NAVBAR = "hide_navbar";
 const INT_SHRINK_NAVBAR = "shrink_navbar";
 const INT_STICKY_NAVBAR = "sticky_navbar";
 const INT_IMAGE_NAVBAR = "image_navbar";
 const INT_DROPDOWN_TOPNAV = "dropdown_topnav";
 const INT_DROPDOWN_SIDEBAR = "dropdown_sidebar";
 const INT_RESP_TOPNAV_DROPDOWN = "resp_topnav_dropdown";
 const INT_PHP_FRAGMENT_FREE = "php_fragment_free";
 const INT_XML_DOCUMENT = "xml_document";
 const INT_JAVASCRIPT_CODE = "javascript_code";
 const INT_HTML_GENERIC_DATA_TEMPLATE = "html_generic_data_template";
 const INT_JAVASCRIPT_CODE_DATA_TEMPLATE = "javascript_code_data_template";
 
 // Ogni istanza della classe è individuata 
 // da un'operazione, da un numero progressivo e
 // da una denominazione di tipo di interfaccia.
 //
 
 private $op=STRING_NULL; 
 private $num=STRING_NULL;
 static private $genericInterfacesTotNum = 0;
 private $type=STRING_NULL;
 private $itemStack=null;
 private $serializer=null;
 private $interfacesContainer=null;
 protected $shortName=STRING_NULL;
 private $dir=STRING_NULL;
 protected $appName=STRING_NULL;
 protected $pageName=STRING_NULL;
 private $flushEnabled=true;
 
 
 function __construct(string $actOp,string $actType,
 $actNum=STRING_NULL,string $actShortName=STRING_NULL)
 {
	spl_autoload_register(array($this,'autoload')); 	
 	self::$genericInterfacesTotNum++;
 	if($actNum === STRING_NULL)
 	  $actNum = self::$genericInterfacesTotNum-1;
	$this->setOp($actOp);
	$this->setNum($actNum);
	$this->setType($actType);
	$itemStack = self::createItemStack();
	$echoDump = self::createEchoDumper($itemStack);
	$xmlSerializer = self::createXmlInterfaceSerializer();
	$itemStack->setDumper($echoDump);
	$this->setItemStack($itemStack);
	$this->setSerializer($xmlSerializer);
	$this->setShortName($actShortName);
	if($this->isContainer())
	{ 
	 $interfacesContainer = self::createInterfacesContainer();
	 $this->setInterfacesContainer($interfacesContainer);
	}
 }
 
  public function autoload(string $actClassName):void
  { 	
   $appDir = THIS_DIR . DIR_SEP . FRAMEWORK_DIR; 	
  	
   if (file_exists($appDir . DIR_SEP . $actClassName . 
   FILE_NAME_ELEMENTS_SEP . "class" . 
 	 FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE))
 	 require_once ($actClassName . 
 	 FILE_NAME_ELEMENTS_SEP . "class" . 
 	 FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE); 
 	 
   $appDir1 = APPLICATION_NAME;	
  	
 	 $appFwDir1  = PREVIOUS_DIR . DIR_SEP . $appDir1 . DIR_SEP . 
   FRAMEWORK_DIR;
   $actClassName1 = str_replace(__NAMESPACE__,STRING_NULL,$actClassName);
   $actClassName2 = str_replace(STRING_BACKSLASH,STRING_NULL,$actClassName1);
  
   if(file_exists($appFwDir1  . DIR_SEP . $actClassName2 . 
 	 FILE_NAME_ELEMENTS_SEP . "class" . 
 	 FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE))
 	 require_once($appFwDir1  . DIR_SEP . $actClassName2 . 
 	 FILE_NAME_ELEMENTS_SEP . "class" . 
 	 FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE); 	 
  }

 
 function getAppName():string
 {
 	return $this->appName;
 }
 
 function setAppName(string $actAppName):void
 {
 	$this->appName = $actAppName;
 }
 
 function getPageName():string
 {
 	return $this->pageName;
 }
 
 function setPageName(string $actPageName):void
 {
 	$this->pageName = $actPageName;
 } 

 function setInterfacesContainer(?Interfaces_container $actInterfacesContainer):void
 {
 	$this->interfacesContainer = $actInterfacesContainer;
 }
 
 function getInterfacesContainer():?Interfaces_container
 {
 	return $this->interfacesContainer;
 } 
 
 function setDir(string $actDir):void
 {
 	$this->dir = $actDir;
 	$serializer = $this->getSerializer();
 	if(! is_null($serializer))
 	 $serializer->setInterfacesDir($actDir);
 }
 
 function getDir():string
 {
 	return $this->dir;
 }
 
 function setShortName(string $actShortName):void
 {
 	$this->shortName = $actShortName;
 }
 
 function getShortName():string
 {
 	return $this->shortName;
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$genericInterfacesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
  self::$genericInterfacesTotNum=$actIntNum;
 }
 
 function setSerializer(Serializer $actSerializer):void
 {
  $appName = $this->getAppName();
  $pageName = $this->getPageName();
  if($this->getAppName()!=STRING_NULL)
  $actSerializer->setAppName($appName); 
  if($this->getPageName()!=STRING_NULL)
  $actSerializer->setPageName($pageName);
 	$this->serializer = $actSerializer;
 }
 
 static function createXmlInterfaceSerializer():Xml_interface_serializer
 {
 	 $intSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,STRING_NULL);
 	 return $intSerializer;
 }
 
 static function createInterfacesContainer():Interfaces_container
 {
 	$interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
 	return $interfacesContainer;
 }
 
 function getSerializer():?Serializer
 {
  return $this->serializer;
 }
 
 function serialize():void
 {
 	$serializer = $this->getSerializer(); 	
 	$appName = $this->getAppName();
 	$pageName = $this->getPageName();
 	$op = $this->getOp();
 	$type = $this->getType();
 	$num = $this->getNum();
 	$shortName = $this->getShortName();
	$interfacesContainer = $this->getInterfacesContainer();
 	$item1 = array("appName"=>$appName);
 	$serializer->loadItems($item1);
 	$item2 = array("pageName"=>$appName);
 	$serializer->loadItems($item2); 	
 	$item3 = array("op"=>$op);
 	$serializer->loadItems($item3);
 	$item4 = array("type"=>$type);
 	$serializer->loadItems($item4);
 	$item5 = array("num"=>$num);
 	$serializer->loadItems($item5);
 	$item6 = array("shortName"=>$shortName);
 	$serializer->loadItems($item6);  
	if($this->isContainer())
    { 
	 $item7 = array("interfacesContainer"=>$interfacesContainer);
	 $serializer->loadItems($item7);
    }
 }
 
 function unserialize():void
 {
 	$serializer = $this->getSerializer();
 	$items = $serializer->getItems();
 	foreach($items as $ind=>$item)
 	{
   if(is_string($item))
    $item = trim($item);
   if($item==="true")
    $item = 1;
   elseif($item === "false")
    $item = 0;
   $preInd = substr($ind,0,1);
   $ind=preg_replace("/\\" . STRING_STAR . "/i",STRING_NULL,$ind);
   $ind=preg_replace("/" . STRING_AT . "/i",STRING_NULL,$ind);
   $ind=preg_replace("/" . STRING_PERCENT . "/i",STRING_NULL,$ind);
   $ind=preg_replace("/\\$/i",STRING_NULL,$ind);

//
// Le proprietà con il percento come suffisso prendono il valore di default dalla classe in cui
// sono definite.
//

 	 if (! (($preInd==STRING_PERCENT)&&($item==STRING_NULL)))
 	 {
	 	$setMethod = 'set' . ucFirst($ind);
		if(is_a($item,Classes_info::INTERFACE_AS_STRING_CLASS))
		{
		 $itemv = $item->getItemName();
		 if($itemv==STRING_NULL)
			$itemv=null;
	    }
		else
		 $itemv = $item;
 	 	$this->$setMethod($itemv);
   }
 	} 		
 }
 
 function serializer_setFileName(string $actSuffix=STRING_NULL):void
 {
  $serializer = $this->getSerializer();
 	$op = $this->getOp();
 	$type = $this->getType();
 	$shortName = $this->getShortName();
 	$extType = get_class($this);
 	
 	$extType = preg_split('/[\\\]/',$extType,-1,PREG_SPLIT_NO_EMPTY)[2]; 	
 	
 	if(($type==Interfaces_info::INT_HTML_TAGS)&&($extType!=ucFirst($type)))
 	 $type = lcFirst($extType);
 	if(($type==Interfaces_info::INT_HTML_TAG)&&($extType!=ucFirst($type)))
 	 $type = lcFirst($extType);
 	  	
 	$num = $this->getNum();
 	$pageName = $serializer->getPageName();
 	if($actSuffix != STRING_NULL)
 	{
 	 $serializer->setAppName($actSuffix);
 	 if($shortName === STRING_NULL)
 	 {
 	  $serializer->setFileName($actSuffix . Xml_interface_serializer::INTERFACE_NAME_SEP . 
 	  $pageName . Xml_interface_serializer::INTERFACE_NAME_SEP .
 	  $type . Xml_interface_serializer::INTERFACE_NAME_SEP . $op . 
 	  Xml_interface_serializer::INTERFACE_NAME_SEP . $num );	
   }
   else
   {
    $serializer->setFileName($shortName);
   }
  }
  else
  {
   $appName = $serializer->getAppName();
   if($shortName === STRING_NULL)
   {
    if($appName != STRING_NULL)
    {
     $serializer->setFileName($appName . Xml_interface_serializer::INTERFACE_NAME_SEP .
     $pageName . Xml_interface_serializer::INTERFACE_NAME_SEP .
     $type . Xml_interface_serializer::INTERFACE_NAME_SEP 
     . $op . Xml_interface_serializer::INTERFACE_NAME_SEP . $num );
    }
    else
     $serializer->setFileName($pageName . Xml_interface_serializer::INTERFACE_NAME_SEP .
     $type . Xml_interface_serializer::INTERFACE_NAME_SEP 
     . $op . Xml_interface_serializer::INTERFACE_NAME_SEP . $num );    
   }
   else
    $serializer->setFileName($shortName);    
  }   
 }
 
 function serializer_saveData(string $actSuffix=STRING_NULL):void
 {
 	$serializer = $this->getSerializer();
 	$this->serializer_setFileName($actSuffix);
 	$serializer->saveData();
 }
 
 function serializer_loadData(string $actSuffix=STRING_NULL):void
 {
 	$serializer = $this->getSerializer();
	//	 echo "RRRRRRRRRRRRRR";
 	$this->serializer_setFileName($actSuffix);
	//echo $this->getSerializer()->getFileName() . " W " ;
 	$serializer->loadData();
 }
 
 function getNum():string|int
 {
  return $this->num;
 }
 
 function setNum(string|int $actNum):void
 {
  $this->num = $actNum; 
 }
 
 function getType():string
 {
  return $this->type;
 }
 
 function setType(string $actType):void
 {
  $this->type = $actType;
 }
 
 function getOp():string
 {
  return $this->op;
 }
 
 function setOp(string $actOp):void
 {
  $this->op = $actOp;
 }
 
 static function decodeInterfaceId(string $actIntId,
 string $actSepChar=self::INTERFACE_ID_CHAR_SEP):array
 {
 	$items=array();
 	$items = explode($actSepChar,$actIntId);
 	
 	return $items;
 } 
 
 function getInterfaceId(string $actSepChar=self::INTERFACE_ID_CHAR_SEP):string
 {
 	$num = $this->getNum();
 	$op = $this->getOp();
 	$type = $this->getType();
 	return $type . $actSepChar . $op . $actSepChar. $num;
 }
 
 function getCompleteInterfaceId(string $actSepChar=self::INTERFACE_ID_CHAR_SEP):string
 {
  $interfaceId = $this->getInterfaceId($actSepChar);
 	return $interfaceId;
 }
 
 function getStandardInterfaceId(string $actSepChar=self::INTERFACE_ID_CHAR_SEP):string
 {
 	$appName = $this->getAppName;
 	$pageName = $this->getPageName();
 	$num = $this->getNum();
 	$op = $this->getOp();
 	$type = $this->getType(); 	
 	return $appName . $actSepChar . $pageName . $actSepChar . 
 	$this->getCompleteInterfaceId($actSepChar);
 }
 
 function getObj()
 {
 	$retObj = OBJ_NONE;
  return $retObj;
 }
 
 static function createMemoryDumper(Stringable $actItem):Memory_dumper
 {
 	$dumper = Creator::create(getClassNameForCreate(Classes_info::MEMORY_DUMPER_CLASS),STRING_NULL,$actItem);
 	return $dumper;
 }
 
 static function createEchoDumper(Stringable $actItem):Echo_dumper
 {
 	$dumper = Creator::create(getClassNameForCreate(Classes_info::ECHO_DUMPER_CLASS),STRING_NULL,$actItem);
 	return $dumper;
 }
 
 static function createFileDumper(Stringable $actItem):File_dumper
 {
 	$dumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$actItem);
 	return $dumper;
 }
 
 static function createItemStack():Item_stack
 {
 	$itemStack = Creator::create(getClassNameForCreate(Classes_info::ITEM_STACK_CLASS));
 	return $itemStack;
 }
 
 function setItemStack(?Item_stack $actItemStack):void
 {
 	$this->itemStack = $actItemStack;
 }
 
 function getItemStack():?Item_stack
 {
 	return $this->itemStack;
 }
 
 function setFlushEnabled(bool $actEnable):void
 {
 	$this->flushEnabled = $actEnabled;
 }
 
 function getFlushEnabled():bool
 {
 	return $this->flushEnabled;
 }

 function toString():string
 {
 	$itemStack = $this->getItemStack();
 	$oldItemStack2 = clone $itemStack;
 	$oldDumper = $itemStack->getDumper();
 	$oldDumper2 = clone $oldDumper;
 	$oldDumper2->setObj($itemStack2);
 	$oldItemStack2->setDumper($oldDumper2); 	
 	$dumper = self::createMemoryDumper($itemStack);
 	$itemStack->setDumper($dumper);
 	$itemStack->erase();
 	$this->putData();
  $str = $itemStack->dump();  
  $this->setItemStack($oldItemStack2);
  return $str;
 }
 
 function dump():string
 {
 	 $itemStack = $this->getItemStack();
 	 $str = $itemStack->dump();
   return $str;
 }
 
 function flush():string
 {
 	 $itemStack = $this->getItemStack();
 	 $str = $itemStack->dump();
 	 $itemStack->erase();
   return $str;
 }
 
 function setMemoryDumper():void
 {
 	$itemStack = $this->getItemStack();
 	$dumper = self::createMemoryDumper($itemStack);
 	$itemStack->setDumper($dumper);
 }
 
 function setEchoDumper():void
 {
 	$itemStack = $this->getItemStack();
 	$dumper = self::createEchoDumper($itemStack);
 	$itemStack->setDumper($dumper);
 }
 
 function setFileDumper(string $actFileName):void
 {
 	$itemStack = $this->getItemStack();
 	$dumper = self::createFileDumper($itemStack);
 	$dumper->setFileName($actFileName);
 	$itemStack->setDumper($dumper);
 }
 
 function getDumper():?Dumper
 {
 	$itemStack = $this->getItemStack();
 	$dumper = $itemStack->getDumper();
 	return $dumper;
 }
 
 function setDumper(?Dumper $actDumper):void
 {
 	$itemStack = $this->getItemStack();
 	$itemStack->setDumper($actDumper);
 }
 
 function action(string $actStr,Interfaces_container $actInterfacesContainer):void
 {
 //	$this->putData();
 }
 
}

?>