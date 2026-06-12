<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_accordion.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_barGradex.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_bootstrap_carousel.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_bootstrap_jumbotron.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_bootstrap_navbar.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_bootstrap_table.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_bootstrap_tabs.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_csv_table.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_curtain_menu.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_db_navigator.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_div_frame.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_form.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_form_2.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_form_section.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_fpdf_field_h.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_fpdf_field_v.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_fpdf_template.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_fpdf_field_template.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_fpdf_txt.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_fpdf_img.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_frame.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_level_menu.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_level_menu_2.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_local_tabs.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_local_tabs_2.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_menuBar.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_menuBar_2.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_nLevels_forest_ctrl.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_nLevels_menu.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_nLevels_tree_ctrl.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_scrolling_table.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_sendMail.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_sheet.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_simple_layout.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_simple_table.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_tabs.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_tb_layout.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_tb_simple_layout.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_temp_msg.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_three_columns_layout.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_tree_ctrl.class.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_two_columns_layout.class.php");
require_once(FRAMEWORK_PATH . "Html_data_template.class.php");
require_once(FRAMEWORK_PATH . "Html_data_file_template.class.php");
require_once(FRAMEWORK_PATH . "Html_file_fragment.class.php");
require_once(FRAMEWORK_PATH . "Html_fragment.class.php");
require_once(FRAMEWORK_PATH . "Html_frameset_page.class.php");
require_once(FRAMEWORK_PATH . "Html_input_ctrl.class.php");
require_once(FRAMEWORK_PATH . "Html_interface_decorator.class.php");
require_once(FRAMEWORK_PATH . "Html_tags.class.php");
require_once(FRAMEWORK_PATH . "Javascript_data_ace_txtEditor.class.php");
require_once(FRAMEWORK_PATH . "Javascript_data_fragment.class.php");
require_once(FRAMEWORK_PATH . "Javascript_data_template.class.php");
require_once(FRAMEWORK_PATH . "Javascript_data_txtEditor.class.php");
require_once(FRAMEWORK_PATH . "Javascript_fragment.class.php");
require_once(FRAMEWORK_PATH . "Php_data_fragment.class.php");
require_once(FRAMEWORK_PATH . "Php_fragment.class.php");
require_once(FRAMEWORK_PATH . "Php_switch_struct.class.php");

$st = new Cheope_ns_accordion("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_barGradex("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_bootstrap_carousel("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_bootstrap_jumbotron("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_bootstrap_navbar("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_bootstrap_table("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_bootstrap_tabs("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_csv_table("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_curtain_menu("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_db_navigator("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_div_frame("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_form("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_form_2("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_form_section("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_fpdf_field_h("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_fpdf_field_v("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_fpdf_template("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_fpdf_field_template("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_fpdf_txt("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_fpdf_img("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_fpdf_field_h("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_frame("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_level_menu("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_level_menu_2("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_local_tabs("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_local_tabs_2("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_level_menu("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_menuBar("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_menuBar_2("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_nLevels_forest_ctrl("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_nLevels_menu("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_nLevels_tree_ctrl("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_scrolling_table("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_sendMail("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_sheet("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_simple_layout("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_simple_table("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_tabs("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_tb_layout("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_tb_simple_layout("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_temp_msg("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Cheope_ns_three_columns_layout("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

/*$st = new Cheope_ns_tree_ctrl("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");*/

$st = new Cheope_ns_two_columns_layout("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Html_data_template("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Html_data_file_template("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Html_file_fragment("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Html_fragment("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

/*$st = new Html_frameset_page("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");*/

$st = new Html_input_ctrl("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

/*$st = new Html_interface_decorator("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");*/

$st = new Html_tags("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Javascript_data_ace_txtEditor("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Javascript_data_fragment("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Javascript_data_template("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Javascript_data_txtEditor("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Javascript_fragment("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Php_data_fragment("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Php_fragment("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");

$st = new Php_switch_struct("","0");
$st->serialize();
$serializer = $st->getSerializer();
$st->serializer_saveData("Test");


echo "Done!";


?>