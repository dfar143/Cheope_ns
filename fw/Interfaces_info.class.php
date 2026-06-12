<?
namespace Cheope_ns\fw;
require_once("filesystem.const.php"); 
require_once("Creator.tra.php");

class Interfaces_info
{
  const ERROR_0="Interfaces_info.getInterfaceNameFromArray:Errore array elementi.";
	
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
  const INT_AJAX_HANDLER = "ajax_handler"; 
  const INT_CSV_TABLE = "csv_table"; 
  const INT_BARGRADEX = "barGradex"; 
  const INT_HTML_FORM_TAG = "html_form_tag";
  const INT_HTML_FRAGMENT = "html_fragment"; 
  const INT_HTML_FILE_FRAGMENT = "html_file_fragment"; 
  const INT_HTML_DATA_TEMPLATE = "html_data_template";
  const INT_XML_DATA_TEMPLATE = "xml_data_template";
  const INT_XML_DOCUMENT = "xml_document";  
  const INT_HTML_INPUT_CTRL = "html_input_ctrl"; 
  const INT_HTML_DIV_TAG="html_div_tag";
  const INT_HTML_A_TAG="html_a_tag";
  const INT_HTML_B_TAG="html_b_tag";
  const INT_HTML_BR_TAG="html_br_tag";
  const INT_HTML_BUTTON_TAG="html_button_tag";
  const INT_HTML_HR_TAG="html_hr_tag";
  const INT_HTML_IMG_TAG="html_img_tag";
  const INT_HTML_LABEL_TAG="html_label_tag";
  const INT_HTML_LI_TAG="html_li_tag";
  const INT_HTML_OL_TAG="html_ol_tag";
  const INT_HTML_OPTION_TAG="html_option_tag";
  const INT_HTML_P_TAG="html_p_tag";
  const INT_HTML_SPAN_TAG="html_span_tag";
  const INT_HTML_SELECT_TAG="html_select_tag";
  const INT_HTML_TEXTAREA_TAG="html_textarea_tag";
  const INT_HTML_UL_TAG="html_ul_tag";
  const INT_HTML_SCRIPT_TAG="html_script_tag"; 
  const INT_HTML_INPUT_TAG="html_input_tag"; 
  const INT_UPLOADED_FILE_MAMAGER = "uploaded_file_manager"; 
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
  const INT_BOOTSTRAP = "bootstrap";
  const INT_JQUERY = "jquery";
  const INT_DOJO = "dojo";
  const INT_CSS = "css";  
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
  const INT_FORM_SECTION = "form_section";
  const INT_FPDF_FIELD_H = "fpdf_field_h";
  const INT_FPDF_FIELD_V = "fpdf_field_v";
  const INT_FPDF_TEMPLATE = "fpdf_template";
  const INT_FPDF_FIELD_TEMPLATE = "fpdf_field_template";
  const INT_FPDF_TXT = "fpdf_txt";
  const INT_FPDF_IMG = "fpdf_img";
 const INT_SIDENAV = "sidenav";
 const INT_ICON_BAR_HOR = "icon_bar_hor";
 const INT_HOR_SCROLL_MENU = "hor_scroll_menu";
 const INT_FULLSCREEN_SLIDE_NAV = "fullscreen_slide_nav";
 const INT_VERT_LOCAL_TABS = "vert_local_tabs";
 const INT_TAB_HEADERS = "tab_headers";
 const INT_SUBNAV = "subnav";
 const INT_ICON_BAR_VERT = "icon_bar_vert";
 const INT_ICON_NAV_BAR = "icon_navbar";
 const INT_SPLITNAV = "splitnav";
 const INT_SEARCH_BAR = "search_bar";
 const INT_FIXED_SIDEBAR = "fixed_sidebar";
 const INT_RESP_BOTTOM_NAV_BAR = "resp_bottom_navbar";
 const INT_SIDEBAR = "sidebar";
 const INT_BOTTOM_NAV_BAR = "bottom_navbar";
 const INT_SLIDE_DOWN = "slide_down";
 const INT_OFFCANVAS_MENU = "offCanvas_menu";
 const INT_EQUAL_WIDTH_NAV_BAR = "equal_width_navbar";
 const INT_FIXED_TOP_MENU = "fixed_top_menu";
 const INT_IMAGE_NAV_BAR = "image_navbar";
 const INT_STICKY_NAV_BAR = "sticky_navbar";
 const INT_SHRINK_NAV_BAR = "shrink_navbar";
 const INT_HIDE_NAV_BAR = "hide_navbar";
 const INT_DROPDOWN_SIDEBAR = "dropdown_sidebar";
 const INT_DROPDOWN_TOPNAV = "dropdown_topnav";
 const INT_RESP_TOPNAV_DROPDOWN = "resp_topnav_dropdown";
 const INT_SIMPLE_LOCAL_TABS = "simple_local_tabs";
 const INT_PHP_FRAGMENT_FREE = "php_fragment_free";
 const INT_JAVASCRIPT_CODE = "javascript_code";
 const INT_HTML_GENERIC_DATA_TEMPLATE = "html_generic_data_template";
 const INT_JAVASCRIPT_CODE_DATA_TEMPLATE = "javascript_code_data_template";

 
  const INTERFACE_ID_CHAR_SEP = STRING_UNDERSCORE;
  const INTERFACE_INSTANCE_CHAR_SEP = STRING_EXCLAMATION_MARK;
  
  private function __construct()
  {
  }
  
  static function createInterface(string $actDir,string $actName,string|object|null $actObj,
  string $actOp,int $actNum):object
  {
 //  if (! class_exists($actName,false))
     require_once($actDir . DIR_SEP . $actName . FILE_NAME_ELEMENTS_SEP . CLASS_SUFFIX . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE);
 	      
 	 $intNameItems = explode(VAR_SEP,$actName);
 	 $lastItem = $intNameItems[count($intNameItems)-1];
 	  
 	 $actName = $actName;  
 	  
 	 if($lastItem==DECORATOR_SUFFIX)
 	  $int = Creator::create($actName,STRING_NULL,null,$actOp,$actNum);
 	 else
 	 { 	      
 	  if (! is_null($actObj)) 
 	   $int = Creator::create($actName,STRING_NULL,$actObj,$actOp,$actNum);   
 	  else
 	   $int = Creator::create($actName,STRING_NULL,$actOp,$actNum);
 	  }
 	  
 	  return $int;
  }
  
  static function decodeInterfaceId(string $actIntId,string $actSepChar):array
  {
 	 $items=array();
 	 $items = explode($actSepChar,$actIntId);
 	 return $items;
  }
  
 static function getInterfaceId(Generic_interface $actObj,string $actSepChar=self::INTERFACE_ID_CHAR_SEP):string
 {
 	$num = $actObj->getNum();
 	$op = $actObj->getOp();
 	$type = $actObj->getType();
 	return $type . $actSepChar . $op . $actSepChar. $num;
 }
 
 static function getCompleteInterfaceId(Generic_interface $actObj,string $actSepChar=self::INTERFACE_ID_CHAR_SEP):string
 {
 	$obj = $actObj->getObj();
 	if($obj==OBJ_NONE)
 	{
 		$interfaceId = $actObj->getInterfaceId($actSepChar);
 	}
 	else
 	{
 		$interfaceId = $obj->getName() . $actSepChar . $actObj->getInterfaceId($actSepChar);
 	}
 	return $interfaceId;
 }
 
 static function getInterfaceNameFromArray(array $actIntArray,string $actSepChar):string
 {
 	$num = count($actIntArray);
 	if($num==5)
 	 $intName = $actIntArray[0] . $actSepChar . $actIntArray[1] . 
 	 $actSepChar . $actIntArray[2] . $actSepChar  . $actIntArray[3] . 
 	 $actSepChar . $actIntArray[4];
 	elseif($num=6)
 	 $intName = $actIntArray[0] . $actSepChar . $actIntArray[1] . 
 	 $actSepChar . $actIntArray[2] . $actSepChar  . $actIntArray[3] . 
 	 $actSepChar . $actIntArray[4] . $actSepChar . $actIntArray[5];
 	else
 	 die(self::ERROR_0);
 	return $intName;
 }
  
}

?>