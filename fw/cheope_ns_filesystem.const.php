<?
namespace Cheope_ns\fw;

require_once("cheope_ns_generic.const.php");
require_once("cheope_ns_filesystem.def.php");

define(__NAMESPACE__ . '\JQUERY',"jquery");
define(__NAMESPACE__ . '\JQUERY_UI',"jquery-ui");
define(__NAMESPACE__ . '\BOOTSTRAP',"bootstrap");

define(__NAMESPACE__ . '\FPDF_DIR',"fpdf");
define(__NAMESPACE__ . '\PDF_DIR',"pdf");
define(__NAMESPACE__ . '\CSS_DIR',namespace\CSS_ACRONYM);
define(__NAMESPACE__ . '\CSV_DIR',namespace\CSV_ACRONYM);
define(__NAMESPACE__ . '\JAVASCRIPT_DIR',namespace\JAVASCRIPT_ACRONYM);
define(__NAMESPACE__ . '\IMAGES_DIR',namespace\IMAGES_ACRONYM);
define(__NAMESPACE__ . '\XML_DIR',namespace\XML_ACRONYM);
define(__NAMESPACE__ . '\JSON_DIR',namespace\JSON_ACRONYM);
define(__NAMESPACE__ . '\INTERFACES_DIR',"interfaces");
define(__NAMESPACE__ . '\AJAXOPS_DIR',"ajaxOps");
define(__NAMESPACE__ . '\FW_DIR',namespace\FRAMEWORK_ACRONYM);
define(__NAMESPACE__ . '\EDITOR_DIR',"FCKeditor");
define(__NAMESPACE__ . '\JQUERY_DIR',namespace\JQUERY);
define(__NAMESPACE__ . '\DATA_TABLES_DIR',"dataTables");
define(__NAMESPACE__ . '\ACE_DIR',"ace");
define(__NAMESPACE__ . '\SPIN_DIR',"spin");
define(__NAMESPACE__ . '\JMENU_DIR',"jMenu");
define(__NAMESPACE__ . '\BUTTONS_DIR',"buttons");
define(__NAMESPACE__ . '\JQUERY_UI_DIR',namespace\JQUERY_UI);
define(__NAMESPACE__ . '\JQUERY_INFINITE_SCROLL_DIR',namespace\JQUERY . "_infinite_scroll");
define(__NAMESPACE__ . '\DOJO_DIR',"dojo");
define(__NAMESPACE__ . '\BOOTSTRAP_DIR',namespace\BOOTSTRAP);
define(__NAMESPACE__ . '\DIST_DIR',"dist");
define(__NAMESPACE__ . '\ZIP_DIR',"zip");
define(__NAMESPACE__ . '\SIDENAV_DIR',namespace\JAVASCRIPT_ACRONYM);
define(__NAMESPACE__ . '\OFFCANVAS_DIR',namespace\JAVASCRIPT_ACRONYM);
define(__NAMESPACE__ . '\SLIDENAV_DIR',namespace\JAVASCRIPT_ACRONYM);
define(__NAMESPACE__ . '\SLIDE_DOWN_DIR',namespace\JAVASCRIPT_ACRONYM);
define(__NAMESPACE__ . '\HIDE_NAVBAR_DIR',namespace\JAVASCRIPT_ACRONYM);
define(__NAMESPACE__ . '\STICKY_NAVBAR_DIR',namespace\JAVASCRIPT_ACRONYM);
define(__NAMESPACE__ . '\SHRINK_NAVBAR_DIR',namespace\JAVASCRIPT_ACRONYM);
define(__NAMESPACE__ . '\SIMPLE_LOCAL_TABS_CODE_DIR',namespace\JAVASCRIPT_ACRONYM);
define(__NAMESPACE__ . '\VERT_LOCAL_TABS_CODE_DIR',namespace\JAVASCRIPT_ACRONYM);
define(__NAMESPACE__ . '\TAB_HEADERS_DIR',namespace\JAVASCRIPT_ACRONYM);
define(__NAMESPACE__ . '\DROPDOWN_SIDEBAR_DIR',namespace\JAVASCRIPT_ACRONYM);
define(__NAMESPACE__ . '\RESP_TOPNAV_DROPDOWN_DIR',namespace\JAVASCRIPT_ACRONYM);


define(__NAMESPACE__ . '\JAVASCRIPT_SOURCE_FILE_POSTFIX',namespace\FILE_NAME_ELEMENTS_SEP . namespace\JAVASCRIPT_ACRONYM);
define(__NAMESPACE__ . '\STYLE_SHEET_FILE_POSTFIX',namespace\FILE_NAME_ELEMENTS_SEP . namespace\CSS_ACRONYM);
define(__NAMESPACE__ . '\XML_PAR_FILE_POSTFIX',namespace\FILE_NAME_ELEMENTS_SEP . namespace\XML_ACRONYM);

define(__NAMESPACE__ . '\JQUERY_VER',namespace\JQUERY . STRING_MINUS . "1.12.1");
define(__NAMESPACE__ . '\JQUERY_MIGRATE',namespace\JQUERY . STRING_MINUS . "migrate" . 
STRING_MINUS . "1.2.1");
define(__NAMESPACE__ . '\JQUERY_UI_VER',namespace\JQUERY_UI);
define(__NAMESPACE__ . '\DOJO_VER',"dojo-release-1.5.0");
define(__NAMESPACE__ . '\DATA_TABLES_VER',"dataTables-1.6");
define(__NAMESPACE__ . '\BOOTSTRAP_VER',namespace\BOOTSTRAP . STRING_MINUS . "4.0.0");

define(__NAMESPACE__ . '\JS_FORM_VALIDATOR',"formValidator" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_UTIL',"util" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_MENU',"menu" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_TEMP_MSG_SEQUENCER',"tempMsgSequencer" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_FADE',"fade" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_TREE_CTRL',"treeCtrl" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_FOREST_CTRL',"forestCtrl" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_COMMON',"common" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_SUBMODAL',"subModal" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_DYN_TABLE',"dyn_table" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_DYN_SHEET',"dyn_sheet" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_DATA_TABLES',namespace\JQUERY . ".dataTables.min"  . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_BUTTONS',"dataTables.buttons.min" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_JMENU',"jMenu.jquery"  . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_DATEINPUT',"dateinput.min" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_RANGEINPUT',"rangeinput.min" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_VALIDATOR',"validator.min" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_JQUERY_MAIN',namespace\JQUERY_VER . ".min" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_JQUERY_MIGRATE',namespace\JQUERY_MIGRATE . ".min" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_JQUERY_UI',namespace\JQUERY_UI_VER . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX); 
define(__NAMESPACE__ . '\JS_JQUERY_INFINITE_SCROLL',namespace\JQUERY . ".infinitescroll.min" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_SPIN',namespace\JQUERY . ".spin" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_OP_LOCALIZATION',"opLocalization" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_SELECTION',"selection" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX); 
define(__NAMESPACE__ . '\JS_STACK',"stack" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_INTERFACES',"interfaces" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_ACE',"ace" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_ACE_STATUSBAR',"ext-statusbar" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_FORM_SECTION_VALIDATOR',"formSectionValidator" .namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_BOOTSTRAP',namespace\BOOTSTRAP . ".min" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_RESP_BOTTOM_NAVBAR',"resp_bottom_navbar" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_HIDE_NAVBAR',"hide_navbar" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_STICKY_NAVBAR',"sticky_navbar" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_SHRINK_NAVBAR',"shrink_navbar" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_SIDENAV_1',"sidenav_overlay" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_SIDENAV_2',"sidenav_push_content" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_SIDENAV_3',"sidenav_push_content_opacity" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_SIDENAV_4',"sidenav_full_width" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_OFFCANVAS',"offCanvas" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_SIMPLE_LOCAL_TABS',"simple_local_tabs" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_VERT_LOCAL_TABS',"vert_local_tabs" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_TAB_HEADERS',"tab_headers" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_SLIDENAV_1',"slide_from_side" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_SLIDENAV_2',"slide_down_from_top" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_SLIDENAV_3',"open_menu_without_animation" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_SLIDE_DOWN',"slide_down" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_DROPDOWN_SIDEBAR',"dropdown_sidebar" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_RESP_TOPNAV_DROPDOWN',"resp_topnav_dropdown" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_OP_JAVASCRIPT_INJECTION',"opJavascriptInjection" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_POPPER',"popper.min" . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX); 

define(__NAMESPACE__ . '\XML_FILE_USERS',"Users" . namespace\XML_PAR_FILE_POSTFIX);

define(__NAMESPACE__ . '\DOJO','dojo');
define(__NAMESPACE__ . '\DIJIT','dijit');
define(__NAMESPACE__ . '\DOJOX','dojox');

define(__NAMESPACE__ . '\JS_DOJO',namespace\DOJO . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_DIJIT',namespace\DIJIT . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
define(__NAMESPACE__ . '\JS_DOJOX',namespace\DOJOX . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);

define(__NAMESPACE__ . '\CLIENT_PAR_FILE_PATH',THIS_DIR);

define(__NAMESPACE__ . '\CLIENT_DOJO_CODE_PATH',THIS_DIR . DIR_SEP . namespace\DOJO_DIR .
 DIR_SEP . namespace\DOJO);
define(__NAMESPACE__ . '\CLIENT_DIJIT_CODE_PATH',THIS_DIR . DIR_SEP . namespace\DOJO_DIR . 
DIR_SEP . namespace\DIJIT);
define(__NAMESPACE__ . '\CLIENT_DOJOX_CODE_PATH',THIS_DIR . DIR_SEP . namespace\DOJO_DIR . 
DIR_SEP . namespace\DOJOX);
define(__NAMESPACE__ . '\CLIENT_JQUERY_CODE_PATH',THIS_DIR . DIR_SEP . namespace\JQUERY_DIR);
define(__NAMESPACE__ . '\CLIENT_JQUERY_UI_CODE_PATH',THIS_DIR . DIR_SEP . 
namespace\JQUERY_UI_DIR . DIR_SEP . "ui");
define(__NAMESPACE__ . '\CLIENT_JQUERY_INFINITE_SCROLL_CODE_PATH',THIS_DIR . DIR_SEP . 
namespace\JQUERY_INFINITE_SCROLL_DIR);
define(__NAMESPACE__ . '\CLIENT_DATA_TABLES_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\DATA_TABLES_DIR . DIR_SEP . "media" . DIR_SEP . namespace\JAVASCRIPT_DIR); 
define(__NAMESPACE__ . '\CLIENT_JMENU_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\JMENU_DIR);
define(__NAMESPACE__ . '\CLIENT_SIDENAV_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\SIDENAV_DIR);
define(__NAMESPACE__ . '\CLIENT_OFFCANVAS_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\OFFCANVAS_DIR);
define(__NAMESPACE__ . '\CLIENT_SLIDENAV_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\SLIDENAV_DIR);
define(__NAMESPACE__ . '\CLIENT_SLIDE_DOWN_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\SLIDE_DOWN_DIR);
define(__NAMESPACE__ . '\CLIENT_HIDE_NAVBAR_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\HIDE_NAVBAR_DIR);
define(__NAMESPACE__ . '\CLIENT_STICKY_NAVBAR_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\STICKY_NAVBAR_DIR);
define(__NAMESPACE__ . '\CLIENT_SHRINK_NAVBAR_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\SHRINK_NAVBAR_DIR);
define(__NAMESPACE__ . '\CLIENT_SIMPLE_LOCAL_TABS_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\SIMPLE_LOCAL_TABS_CODE_DIR);
define(__NAMESPACE__ . '\CLIENT_VERT_LOCAL_TABS_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\VERT_LOCAL_TABS_CODE_DIR);
define(__NAMESPACE__ . '\CLIENT_TAB_HEADERS_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\TAB_HEADERS_DIR);
define(__NAMESPACE__ . '\CLIENT_DROPDOWN_SIDEBAR_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\DROPDOWN_SIDEBAR_DIR);
define(__NAMESPACE__ . '\CLIENT_RESP_TOPNAV_DROPDOWN_CODE_PATH',THIS_DIR . 
DIR_SEP . namespace\RESP_TOPNAV_DROPDOWN_DIR);
define(__NAMESPACE__ . '\CLIENT_SPIN_CODE_PATH',THIS_DIR . DIR_SEP . 
namespace\SPIN_DIR . DIR_SEP . namespace\JAVASCRIPT_DIR); 
define(__NAMESPACE__ . '\CLIENT_CODE_PATH', THIS_DIR . DIR_SEP . namespace\JAVASCRIPT_DIR);
define(__NAMESPACE__ . '\CLIENT_JQUERY_UI_CSS_PATH',THIS_DIR . DIR_SEP . namespace\JQUERY_UI_DIR . 
DIR_SEP . 
"themes" . DIR_SEP . "base");
define(__NAMESPACE__ . '\CLIENT_DIJIT_CSS_PATH',THIS_DIR . DIR_SEP . namespace\DOJO_DIR . 
DIR_SEP . 
namespace\DIJIT . DIR_SEP . "themes" );
define(__NAMESPACE__ . '\CLIENT_DOJO_CSS_PATH',THIS_DIR . DIR_SEP . namespace\DOJO_DIR . 
DIR_SEP . 
namespace\DOJO . DIR_SEP . "resources" );
define(__NAMESPACE__ . '\CLIENT_STYLE_SHEET_PATH', THIS_DIR . DIR_SEP . namespace\CSS_DIR);
define(__NAMESPACE__ . '\CLIENT_DATA_TABLES_STYLE_SHEET_PATH',THIS_DIR . DIR_SEP . 
namespace\DATA_TABLES_DIR . DIR_SEP . "media" . DIR_SEP . namespace\CSS_DIR);
define(__NAMESPACE__ . '\CLIENT_DATA_TABLES_BUTTONS_STYLE_SHEET_PATH',namespace\THIS_DIR . DIR_SEP .  
namespace\BUTTONS_DIR . DIR_SEP . namespace\CSS_DIR); 
define(__NAMESPACE__ . '\CLIENT_SPIN_STYLE_SHEET_PATH',THIS_DIR . DIR_SEP . namespace\SPIN_DIR . 
DIR_SEP . namespace\CSS_DIR); 
define(__NAMESPACE__ . '\CLIENT_ACE_CODE_PATH',THIS_DIR . DIR_SEP . 
namespace\ACE_DIR . DIR_SEP . "src-noconflict");
define(__NAMESPACE__ . '\CLIENT_XML_PATH', THIS_DIR . DIR_SEP . namespace\XML_DIR);
define(__NAMESPACE__ . '\CLIENT_JSON_PATH', THIS_DIR . DIR_SEP . namespace\JSON_DIR);
define(__NAMESPACE__ . '\CLIENT_BOOTSTRAP_PATH' , THIS_DIR . DIR_SEP . namespace\BOOTSTRAP_DIR . 
DIR_SEP . namespace\DIST_DIR . DIR_SEP . 
namespace\JAVASCRIPT_DIR);
define(__NAMESPACE__ . '\CLIENT_BOOTSTRAP_STYLE_SHEET_PATH' , THIS_DIR . 
DIR_SEP . namespace\BOOTSTRAP_DIR . 
DIR_SEP . namespace\DIST_DIR . DIR_SEP . 
namespace\CSS_DIR);
define(__NAMESPACE__ . '\CLIENT_CDNJS_CLOUDFARE',THIS_DIR . DIR_SEP . namespace\CSS_DIR);
define(__NAMESPACE__ . '\FILES_ROOT', namespace\FILESYSTEM_FILES_ROOT . "temp");
define(__NAMESPACE__ . '\DOCUMENT_ROOT', THIS_DIR);
define(__NAMESPACE__ . '\UPLOADED_FILES_REPOSITORY',getcwd() . DIR_SEP . "files");

define(__NAMESPACE__ . '\JPGRAPH_IMG_CACHE', THIS_DIR . DIR_SEP . namespace\IMAGES_DIR);

define(__NAMESPACE__ . '\PHP_LOCALE_FILE',"php_locale");
define(__NAMESPACE__ . '\LOG_FILE',"log_const");

?>