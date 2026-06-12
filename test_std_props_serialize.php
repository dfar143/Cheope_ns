<?
namespace Std\fw;

define(__NAMESPACE__  . '\FRAMEWORK_DIR',"fw");
define(__NAMESPACE__  . '\FRAMEWORK_PATH','./' . 
namespace\FRAMEWORK_DIR . '/');

require_once(FRAMEWORK_PATH . "Std_accordion.class.php");
require_once(FRAMEWORK_PATH . "Std_barGradex.class.php");
require_once(FRAMEWORK_PATH . "Std_bootstrap_carousel.class.php");
require_once(FRAMEWORK_PATH . "Std_bootstrap_jumbotron.class.php");
require_once(FRAMEWORK_PATH . "Std_bootstrap_navbar.class.php");
require_once(FRAMEWORK_PATH . "Std_bootstrap_table.class.php");
require_once(FRAMEWORK_PATH . "Std_bootstrap_tabs.class.php");
require_once(FRAMEWORK_PATH . "Std_csv_table.class.php");
require_once(FRAMEWORK_PATH . "Std_curtain_menu.class.php");
require_once(FRAMEWORK_PATH . "Std_db_navigator.class.php");
require_once(FRAMEWORK_PATH . "Std_div_frame.class.php");
require_once(FRAMEWORK_PATH . "Std_form.class.php");
require_once(FRAMEWORK_PATH . "Std_form_2.class.php");
require_once(FRAMEWORK_PATH . "Std_form_section.class.php");
require_once(FRAMEWORK_PATH . "Std_fpdf_field_h.class.php");
require_once(FRAMEWORK_PATH . "Std_fpdf_field_v.class.php");
require_once(FRAMEWORK_PATH . "Std_fpdf_template.class.php");
require_once(FRAMEWORK_PATH . "Std_fpdf_field_template.class.php");
require_once(FRAMEWORK_PATH . "Std_fpdf_txt.class.php");
require_once(FRAMEWORK_PATH . "Std_fpdf_img.class.php");
require_once(FRAMEWORK_PATH . "Std_frame.class.php");
require_once(FRAMEWORK_PATH . "Std_level_menu.class.php");
require_once(FRAMEWORK_PATH . "Std_level_menu_2.class.php");
require_once(FRAMEWORK_PATH . "Std_local_tabs.class.php");
require_once(FRAMEWORK_PATH . "Std_local_tabs_2.class.php");
require_once(FRAMEWORK_PATH . "Std_menuBar.class.php");
require_once(FRAMEWORK_PATH . "Std_menuBar_2.class.php");
require_once(FRAMEWORK_PATH . "Std_nLevels_forest_ctrl.class.php");
require_once(FRAMEWORK_PATH . "Std_nLevels_menu.class.php");
require_once(FRAMEWORK_PATH . "Std_nLevels_tree_ctrl.class.php");
require_once(FRAMEWORK_PATH . "Std_scrolling_table.class.php");
require_once(FRAMEWORK_PATH . "Std_sendMail.class.php");
require_once(FRAMEWORK_PATH . "Std_sheet.class.php");
require_once(FRAMEWORK_PATH . "Std_simple_layout.class.php");
require_once(FRAMEWORK_PATH . "Std_simple_table.class.php");
require_once(FRAMEWORK_PATH . "Std_tabs.class.php");
require_once(FRAMEWORK_PATH . "Std_tb_layout.class.php");
require_once(FRAMEWORK_PATH . "Std_tb_simple_layout.class.php");
require_once(FRAMEWORK_PATH . "Std_temp_msg.class.php");
require_once(FRAMEWORK_PATH . "Std_three_columns_layout.class.php");
require_once(FRAMEWORK_PATH . "Std_tree_ctrl.class.php");
require_once(FRAMEWORK_PATH . "Std_two_columns_layout.class.php");

$st = new Std_accordion("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_barGradex("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_bootstrap_carousel("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_bootstrap_jumbotron("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_bootstrap_navbar("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_bootstrap_table("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_bootstrap_tabs("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_csv_table("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_curtain_menu("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_db_navigator("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_div_frame("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_form("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_form_2("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_form_section("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_fpdf_field_h("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_fpdf_field_v("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_fpdf_template("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_fpdf_field_template("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_fpdf_txt("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_fpdf_img("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_fpdf_field_h("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_frame("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_level_menu("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_level_menu_2("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_local_tabs("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_local_tabs_2("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_level_menu("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_menuBar("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_menuBar_2("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_nLevels_forest_ctrl("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_nLevels_menu("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_nLevels_tree_ctrl("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_scrolling_table("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_sendMail("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_sheet("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_simple_layout("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_simple_table("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_tabs("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_tb_layout("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_tb_simple_layout("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_temp_msg("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

$st = new Std_three_columns_layout("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");

/*$st = new Std_tree_ctrl("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");*/

$st = new Std_two_columns_layout("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test_std");



echo "Done!";


?>