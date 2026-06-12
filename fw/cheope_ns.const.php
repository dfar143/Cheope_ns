<?
namespace Cheope_ns\fw;
//if(! defined('AJAX_HANDLER_PAGE'))
//{
require_once("cheope_ns_generic.const.php");
require_once("cheope_ns_filesystem.const.php");
require_once("cheope_ns_http.const.php");
require_once("class.const.php");

define(__NAMESPACE__ . '\PAGE_START',"startt.php");
define(__NAMESPACE__ . '\PAGE_LOGIN',"login.php");
define(__NAMESPACE__ . '\PAGE_ANALISI_MODULI',"modules_analysis.php");
define(__NAMESPACE__ . '\PAGE_ANALISI_MODULI_2',"modules_analysis_2.php");
define(__NAMESPACE__ . '\PAGE_CREA_ISTANZE',"crea_istanze.php");
define(__NAMESPACE__ . '\PAGE_VIEW_MODULE',"view_module.php");

define(__NAMESPACE__ . '\INDENT_SEP_2' , "__");
define(__NAMESPACE__ . '\INDENT_SEP_3' , "___");
define(__NAMESPACE__ . '\PRIV_SEP',"-");
define(__NAMESPACE__ . '\FIELD_SEP'," ");
define(__NAMESPACE__ . '\HEAD_SEP'," ");

define(__NAMESPACE__ . '\OBJ_PROVA',"Prova");
define(__NAMESPACE__ . '\OBJ_PROVA_2',"Prova_2");
define(__NAMESPACE__ . '\OBJ_PROVA_3',"Prova_3");
require_once("cheope_ns_obj.const.php");

define(__NAMESPACE__ . '\TOT_NUM',45);
require_once('cheope_ns_num.def.php');

require_once("cheope_ns_tables.const.php");
require_once("cheope_ns_fields.def.php");
require_once("cheope_ns_log.const.php");

if(! defined(__NAMESPACE__ . '\FIELD_PAGE'))
define(__NAMESPACE__ . '\FIELD_PAGE',"Page");
if(! defined(__NAMESPACE__ . '\FIELD_LABEL'))
define(__NAMESPACE__ . '\FIELD_LABEL',"Label");
if(! defined(__NAMESPACE__ . '\FIELD_ID'))
define(__NAMESPACE__ . '\FIELD_ID',"Id");
if(! defined(__NAMESPACE__ . '\FIELD_NOME_APPLICAZIONE'))
define(__NAMESPACE__ . '\FIELD_NOME_APPLICAZIONE',"Nome_applicazione");
if(! defined(__NAMESPACE__ . '\FIELD_APPLICAZIONI'))
define(__NAMESPACE__ . '\FIELD_APPLICAZIONI',"Applicazioni");
if(! defined(__NAMESPACE__ . '\FIELD_NOME_PAGINA'))
define(__NAMESPACE__ . '\FIELD_NOME_PAGINA',"Nome_pagina");
if(! defined(__NAMESPACE__ . '\FIELD_MENU_VOICES'))
define(__NAMESPACE__ . '\FIELD_MENU_VOICES',"Menu_voices");
if(! defined(__NAMESPACE__ . '\FIELD_MENU_PAGES'))
define(__NAMESPACE__ . '\FIELD_MENU_PAGES',"Menu_pages");
if(! defined(__NAMESPACE__ . '\FIELD_MENU_IDS'))
define(__NAMESPACE__ . '\FIELD_MENU_IDS',"Menu_ids");
if(! defined(__NAMESPACE__ . '\FIELD_TEMP_1'))
define(__NAMESPACE__ . '\FIELD_TEMP_1',"Temp_1");
if(! defined(__NAMESPACE__ . '\FIELD_TEMP_2'))
define(__NAMESPACE__ . '\FIELD_TEMP_2',"Temp_2");
if(! defined(__NAMESPACE__ . '\FIELD_TEMP_3'))
define(__NAMESPACE__ . '\FIELD_TEMP_3',"Temp_3");
if(! defined(__NAMESPACE__ . '\FIELD_LISTA_TABELLE'))
define(__NAMESPACE__ . '\FIELD_LISTA_TABELLE',"Lista_tabelle");
if(! defined(__NAMESPACE__ . '\FIELD_NUOVA_TABELLA'))
define(__NAMESPACE__ . '\FIELD_NUOVA_TABELLA',"Nuova_tabella");
if(! defined(__NAMESPACE__ . '\FIELD_LISTA_CAMPI'))
define(__NAMESPACE__ . '\FIELD_LISTA_CAMPI',"Lista_campi");
if(! defined(__NAMESPACE__ . '\FIELD_NUOVO_CAMPO'))
define(__NAMESPACE__ . '\FIELD_NUOVO_CAMPO',"Nuovo_campo");
if(! defined(__NAMESPACE__ . '\FIELD_TIPI_CAMPO'))
define(__NAMESPACE__ . '\FIELD_TIPI_CAMPO',"Tipi_campo");
if(! defined(__NAMESPACE__ . '\FIELD_NUOVA_CHIAVE'))
define(__NAMESPACE__ . '\FIELD_NUOVA_CHIAVE',"Nuova_chiave");
if(! defined(__NAMESPACE__ . '\FIELD_BUTTON'))
define(__NAMESPACE__ . '\FIELD_BUTTON',"Button");
if(! defined(__NAMESPACE__ . '\FIELD_GROUP_CONTAINER_0'))
define(__NAMESPACE__ . '\FIELD_GROUP_CONTAINER_0',"Group_container_0");
if(! defined(__NAMESPACE__ . '\FIELD_GROUP_CONTAINER_1'))
define(__NAMESPACE__ . '\FIELD_GROUP_CONTAINER_1',"Group_container_1");
if(! defined(__NAMESPACE__ . '\FIELD_SHEET_1'))
define(__NAMESPACE__ . '\FIELD_SHEET_1',"Sheet_1");
if(! defined(__NAMESPACE__ . '\FIELD_SCROLL_1'))
define(__NAMESPACE__ . '\FIELD_SCROLL_1',"Scroll_1");
if(! defined(__NAMESPACE__ . '\FIELD_BUTTON_1'))
define(__NAMESPACE__ . '\FIELD_BUTTON_1',"Button_1");
if(! defined(__NAMESPACE__ . '\FIELD_FRAGMENT_1'))
define(__NAMESPACE__ . '\FIELD_FRAGMENT_1',"Fragment_1");
if(! defined(__NAMESPACE__ . '\FIELD_FRAGMENT_3'))
define(__NAMESPACE__ . '\FIELD_FRAGMENT_3',"Fragment_3");
if(! defined(__NAMESPACE__ . '\FIELD_FRAGMENT_4'))
define(__NAMESPACE__ . '\FIELD_FRAGMENT_4',"Fragment_4");
if(! defined(__NAMESPACE__ . '\FIELD_TEMPLATE_1'))
define(__NAMESPACE__ . '\FIELD_TEMPLATE_1',"Template_1");
if(! defined(__NAMESPACE__ . '\FIELD_CHECKED_1'))
define(__NAMESPACE__ . '\FIELD_CHECKED_1',"Checked_1");
if(! defined(__NAMESPACE__ . '\FIELD_CHECKED_2'))
define(__NAMESPACE__ . '\FIELD_CHECKED_2',"Checked_2");
if(! defined(__NAMESPACE__ . '\FIELD_CHECKED_3'))
define(__NAMESPACE__ . '\FIELD_CHECKED_3',"Checked_3");
if(! defined(__NAMESPACE__ . '\FIELD_CHECKED_4'))
define(__NAMESPACE__ . '\FIELD_CHECKED_4',"Checked_4");
if(! defined(__NAMESPACE__ . '\FIELD_CHECKED_5'))
define(__NAMESPACE__ . '\FIELD_CHECKED_5',"Checked_5");
if(! defined(__NAMESPACE__ . '\FIELD_CHECKED_6'))
define(__NAMESPACE__ . '\FIELD_CHECKED_6',"Checked_6");
if(! defined(__NAMESPACE__ . '\FIELD_CHECKED_7'))
define(__NAMESPACE__ . '\FIELD_CHECKED_7',"Checked_7");
if(! defined(__NAMESPACE__ . '\FIELD_CHECKED_8'))
define(__NAMESPACE__ . '\FIELD_CHECKED_8',"Checked_8");
if(! defined(__NAMESPACE__ . '\FIELD_CHECKED_9'))
define(__NAMESPACE__ . '\FIELD_CHECKED_9',"Checked_9");
if(! defined(__NAMESPACE__ . '\FIELD_DB_NAV_1'))
define(__NAMESPACE__ . '\FIELD_DB_NAV_1',"Db_nav_1");
if(! defined(__NAMESPACE__ . '\FIELD_USER'))
define(__NAMESPACE__ . '\FIELD_USER',"User");
if(! defined(__NAMESPACE__ . '\FIELD_PASSWORD'))
define(__NAMESPACE__ . '\FIELD_PASSWORD',"Password");
if(! defined(__NAMESPACE__ . '\FIELD_FORM'))
define(__NAMESPACE__ . '\FIELD_FORM',"Form");
if(! defined(__NAMESPACE__ . '\FIELD_LISTA_INTERFACCE'))
define(__NAMESPACE__ . '\FIELD_LISTA_INTERFACCE',"Lista_interfacce");
if(! defined(__NAMESPACE__ . '\FIELD_INTERFACCIA_RADICE'))
define(__NAMESPACE__ . '\FIELD_INTERFACCIA_RADICE',"Interfaccia_radice");
if(! defined(__NAMESPACE__ . '\FIELD_CHECKBOX_1'))
define(__NAMESPACE__ . '\FIELD_CHECKBOX_1',"CheckBox_1");
if(! defined(__NAMESPACE__ . '\FIELD_CHECKBOX_2'))
define(__NAMESPACE__ . '\FIELD_CHECKBOX_2',"CheckBox_2");
if(! defined(__NAMESPACE__ . '\FIELD_CR_ENABLED'))
define(__NAMESPACE__ . '\FIELD_CR_ENABLED',"CREnabled");
if(! defined(__NAMESPACE__ . '\FIELD_DOJO_ENABLED'))
define(__NAMESPACE__ . '\FIELD_DOJO_ENABLED',"DojoEnabled");
if(! defined(__NAMESPACE__ . '\FIELD_JQUERY_ENABLED'))
define(__NAMESPACE__ . '\FIELD_JQUERY_ENABLED',"JQueryEnabled");
if(! defined(__NAMESPACE__ . '\FIELD_SPAZIATORE_1'))
define(__NAMESPACE__ . '\FIELD_SPAZIATORE_1',"Spaziatore_1");
if(! defined(__NAMESPACE__ . '\FIELD_SPAZIATORE_2'))
define(__NAMESPACE__ . '\FIELD_SPAZIATORE_2',"Spaziatore_2");
if(! defined(__NAMESPACE__ . '\FIELD_CHECKBOX_3'))
define(__NAMESPACE__ . '\FIELD_CHECKBOX_3',"CheckBox_3");
if(! defined(__NAMESPACE__ . '\FIELD_LISTA_QUERIES'))
define(__NAMESPACE__ . '\FIELD_LISTA_QUERIES',"Lista_queries");
if(! defined(__NAMESPACE__ . '\FIELD_NUOVA_QUERY'))
define(__NAMESPACE__ . '\FIELD_NUOVA_QUERY',"Nuova_query");
if(! defined(__NAMESPACE__ . '\FIELD_QUERY_BODY'))
define(__NAMESPACE__ . '\FIELD_QUERY_BODY',"Query_body");
if(! defined(__NAMESPACE__ . '\FIELD_GENITORI'))
define(__NAMESPACE__ . '\FIELD_GENITORI',"Genitori");
if(! defined(__NAMESPACE__ . '\FIELD_CREA_XPAGINA'))
define(__NAMESPACE__ . '\FIELD_CREA_XPAGINA',"Crea_xpagina");
if(! defined(__NAMESPACE__ . '\FIELD_FUNC_1'))
define(__NAMESPACE__ . '\FIELD_FUNC_1',"Func");
if(! defined(__NAMESPACE__ . '\FIELD_OBJ_1'))
define(__NAMESPACE__ . '\FIELD_OBJ_1',"Obj_1");
if(! defined(__NAMESPACE__ . '\FIELD_OBJ_2'))
define(__NAMESPACE__ . '\FIELD_OBJ_2',"Obj_2");
if(! defined(__NAMESPACE__ . '\FIELD_VAL_1'))
define(__NAMESPACE__ . '\FIELD_VAL_1',"Val_1");
if(! defined(__NAMESPACE__ . '\FIELD_VAL_2'))
define(__NAMESPACE__ . '\FIELD_VAL_2',"Val_2");
if(! defined(__NAMESPACE__ . '\FIELD_FIELD'))
define(__NAMESPACE__ . '\FIELD_FIELD',"Field");
if(! defined(__NAMESPACE__ . '\FIELD_TYPE'))
define(__NAMESPACE__ . '\FIELD_TYPE',"Type");
if(! defined(__NAMESPACE__ . '\FIELD_PK'))
define(__NAMESPACE__ . '\FIELD_PK',"Pk");
if(! defined(__NAMESPACE__ . '\FIELD_DEL_IMG'))
define(__NAMESPACE__ . '\FIELD_DEL_IMG',"Del_img");
if(! defined(__NAMESPACE__ . '\FIELD_COUNT'))
define(__NAMESPACE__ . '\FIELD_COUNT',"Count");
if(! defined(__NAMESPACE__ . '\FIELD_TABLE'))
define(__NAMESPACE__ . '\FIELD_TABLE',"Table");
if(! defined(__NAMESPACE__ . '\FIELD_FATHER'))
define(__NAMESPACE__ . '\FIELD_FATHER',"Father");
if(! defined(__NAMESPACE__ . '\FIELD_SON'))
define(__NAMESPACE__ . '\FIELD_SON',"Son");
if(! defined(__NAMESPACE__ . '\FIELD_QUERYNAME'))
define(__NAMESPACE__ . '\FIELD_QUERYNAME',"queryName");
if(! defined(__NAMESPACE__ . '\FIELD_QUERYBODY'))
define(__NAMESPACE__ . '\FIELD_QUERYBODY',"queryBody");
if(! defined(__NAMESPACE__ . '\FIELD_DATASOURCE'))
define(__NAMESPACE__ . '\FIELD_DATASOURCE',"dataSource");
if(! defined(__NAMESPACE__ . '\FIELD_LISTA_CONNECTIONS'))
define(__NAMESPACE__ . '\FIELD_LISTA_CONNECTIONS',"Lista_connections");
if(! defined(__NAMESPACE__ . '\FIELD_NUOVA_CONNECTION'))
define(__NAMESPACE__ . '\FIELD_NUOVA_CONNECTION',"Nuova_connection");
if(! defined(__NAMESPACE__ . '\FIELD_CONNECTION_BODY'))
define(__NAMESPACE__ . '\FIELD_CONNECTION_BODY',"Connection_body");
if(! defined(__NAMESPACE__ . '\FIELD_AVAILABLE_DBS'))
define(__NAMESPACE__ . '\FIELD_AVAILABLE_DBS',"Available_dbs");
if(! defined(__NAMESPACE__ . '\FIELD_NOME'))
define(__NAMESPACE__ . '\FIELD_NOME',"Nome");
if(! defined(__NAMESPACE__ . '\FIELD_PARAMETRI'))
define(__NAMESPACE__ . '\FIELD_PARAMETRI',"Parametri");
if(! defined(__NAMESPACE__ . '\FIELD_HOST'))
define(__NAMESPACE__ . '\FIELD_HOST',"Host");
if(! defined(__NAMESPACE__ . '\FIELD_DB'))
define(__NAMESPACE__ . '\FIELD_DB',"Db");
if(! defined(__NAMESPACE__ . '\FIELD_DSN'))
define(__NAMESPACE__ . '\FIELD_DSN',"Dsn");
if(! defined(__NAMESPACE__ . '\FIELD_CONNECTION_STRING'))
define(__NAMESPACE__ . '\FIELD_CONNECTION_STRING',"Connection_string");
if(! defined(__NAMESPACE__ . '\FIELD_CONNECTION_NAME'))
define(__NAMESPACE__ . '\FIELD_CONNECTION_NAME',"Connection_name");
if(! defined(__NAMESPACE__ . '\FIELD_ALIAS'))
define(__NAMESPACE__ . '\FIELD_ALIAS',"Alias");
if(! defined(__NAMESPACE__ . '\FIELD_TABLES_QUERIES'))
define(__NAMESPACE__ . '\FIELD_TABLES_QUERIES',"Tables_queries");
if(! defined(__NAMESPACE__ . '\FIELD_CONNECTIONS'))
define(__NAMESPACE__ . '\FIELD_CONNECTIONS',"Connections");
if(! defined(__NAMESPACE__ . '\FIELD_INTERFACCE'))
define(__NAMESPACE__ . '\FIELD_INTERFACCE',"Interfacce");
if(! defined(__NAMESPACE__ . '\FIELD_INTERFACCIA'))
define(__NAMESPACE__ . '\FIELD_INTERFACCIA',"Interfaccia");
if(! defined(__NAMESPACE__ . '\FIELD_PAGINE'))
define(__NAMESPACE__ . '\FIELD_PAGINE',"Pagine");
if(! defined(__NAMESPACE__ . '\FIELD_LAYOUTS'))
define(__NAMESPACE__ . '\FIELD_LAYOUTS',"Layouts");
if(! defined(__NAMESPACE__ . '\FIELD_LAYOUT'))
define(__NAMESPACE__ . '\FIELD_LAYOUT',"Layout");
if(! defined(__NAMESPACE__ . '\FIELD_POS'))
define(__NAMESPACE__ . '\FIELD_POS',"Pos");
if(! defined(__NAMESPACE__ . '\FIELD_WIDTH'))
define(__NAMESPACE__ . '\FIELD_WIDTH',"Width");
if(! defined(__NAMESPACE__ . '\FIELD_HEIGHT'))
define(__NAMESPACE__ . '\FIELD_HEIGHT',"Height");
if(! defined(__NAMESPACE__ . '\FIELD_INLINETEXTBOX_STYLE'))
define(__NAMESPACE__ . '\FIELD_INLINETEXTBOX_STYLE',"InlineTextBox_style");
if(! defined(__NAMESPACE__ . '\FIELD_CONTAINER_NAME'))
define(__NAMESPACE__ . '\FIELD_CONTAINER_NAME',"Container_name");
if(! defined(__NAMESPACE__ . '\FIELD_DOMAIN'))
define(__NAMESPACE__ . '\FIELD_DOMAIN',"Domain");
if(! defined(__NAMESPACE__ . '\FIELD_DOMAIN_VALUE'))
define(__NAMESPACE__ . '\FIELD_DOMAIN_VALUE',"Domain_value");
if(! defined(__NAMESPACE__ . '\FIELD_DIR'))
define(__NAMESPACE__ . '\FIELD_DIR',"Dir");
if(! defined(__NAMESPACE__ . '\FIELD_CHECK'))
define(__NAMESPACE__ . '\FIELD_CHECK',"Check");
if(! defined(__NAMESPACE__ . '\FIELD_NAME'))
define(__NAMESPACE__ . '\FIELD_NAME',"Name");
if(! defined(__NAMESPACE__ . '\FIELD_EXEC'))
define(__NAMESPACE__ . '\FIELD_EXEC',"Exec");
if(! defined(__NAMESPACE__ . '\FIELD_SINGLE_MENUS'))
define(__NAMESPACE__ . '\FIELD_SINGLE_MENUS',"Single_menus");
if(! defined(__NAMESPACE__ . '\FIELD_MULTI_MENUS'))
define(__NAMESPACE__ . '\FIELD_MULTI_MENUS',"Multi_menus");
if(! defined(__NAMESPACE__ . '\FIELD_VOICE'))
define(__NAMESPACE__ . '\FIELD_VOICE',"Voice");
if(! defined(__NAMESPACE__ . '\FIELD_TIPO_MENU'))
define(__NAMESPACE__ . '\FIELD_TIPO_MENU',"Tipo_menu");
if(! defined(__NAMESPACE__ . '\FIELD_MULTI_PAGINE'))
define(__NAMESPACE__ . '\FIELD_MULTI_PAGINE',"Multi_pagine");
if(! defined(__NAMESPACE__ . '\FIELD_SUBMENU'))
define(__NAMESPACE__ . '\FIELD_SUBMENU',"Submenu");
if(! defined(__NAMESPACE__ . '\FIELD_CHOOSE_SUBMENU'))
define(__NAMESPACE__ . '\FIELD_CHOOSE_SUBMENU',"Choose_submenu");
if(! defined(__NAMESPACE__ . '\FIELD_ARRAY_SUBMENU'))
define(__NAMESPACE__ . '\FIELD_ARRAY_SUBMENU',"Array_submenu");
if(! defined(__NAMESPACE__ . '\FIELD_IMG_TRASF'))
define(__NAMESPACE__ . '\FIELD_IMG_TRASF',"Img_trasf");
if(! defined(__NAMESPACE__ . '\FIELD_INTERFACE_CANONICAL_NAME'))
define(__NAMESPACE__ . '\FIELD_INTERFACE_CANONICAL_NAME',"Interface_canonical_name");
if(! defined(__NAMESPACE__ . '\FIELD_BIND_NAME'))
define(__NAMESPACE__ . '\FIELD_BIND_NAME',"Bind_name");
if(! defined(__NAMESPACE__ . '\FIELD_NODES'))
define(__NAMESPACE__ . '\FIELD_NODES',"Nodes");
if(! defined(__NAMESPACE__ . '\FIELD_NODE_NAME'))
define(__NAMESPACE__ . '\FIELD_NODE_NAME',"Node_name");
if(! defined(__NAMESPACE__ . '\FIELD_NOME_CONNESSIONE'))
define(__NAMESPACE__ . '\FIELD_NOME_CONNESSIONE',"Connection_name");
if(! defined(__NAMESPACE__ . '\FIELD_NOME_INTERFACCIA'))
define(__NAMESPACE__ . '\FIELD_NOME_INTERFACCIA',"Nome_interfaccia");
if(! defined(__NAMESPACE__ . '\FIELD_INTERFACE_NAME'))
define(__NAMESPACE__ . '\FIELD_INTERFACE_NAME',"Interface_name");
if(! defined(__NAMESPACE__ . '\FIELD_TABLES'))
define(__NAMESPACE__ . '\FIELD_TABLES',"Tables");
if(! defined(__NAMESPACE__ . '\FIELD_TABLE_NAME'))
define(__NAMESPACE__ . '\FIELD_TABLE_NAME',"Table_name");
if(! defined(__NAMESPACE__ . '\FIELD_NODO'))
define(__NAMESPACE__ . '\FIELD_NODO',"Nodo");
if(! defined(__NAMESPACE__ . '\FIELD_NODI'))
define(__NAMESPACE__ . '\FIELD_NODI',"Nodi");
if(! defined(__NAMESPACE__ . '\FIELD_EXPORT_CHANGES'))
define(__NAMESPACE__ . '\FIELD_EXPORT_CHANGES',"Export_changes");
if(! defined(__NAMESPACE__ . '\FIELD_DATE_MODIFIED'))
define(__NAMESPACE__ . '\FIELD_DATE_MODIFIED',"Date_modified");
if(! defined(__NAMESPACE__ . '\FIELD_VOICES'))
define(__NAMESPACE__ . '\FIELD_VOICES',"Voices");
if(! defined(__NAMESPACE__ . '\FIELD_LOCATIONS'))
define(__NAMESPACE__ . '\FIELD_LOCATIONS',"Locations");
if(! defined(__NAMESPACE__ . '\FIELD_AJAXOPS'))
define(__NAMESPACE__ . '\FIELD_AJAXOPS',"AjaxOps");
if(! defined(__NAMESPACE__ . '\FIELD_AJAXOPS_CLASSES'))
define(__NAMESPACE__ . '\FIELD_AJAXOPS_CLASSES',"AjaxOps_classes");
if(! defined(__NAMESPACE__ . '\FIELD_CHECKED'))
define(__NAMESPACE__ . '\FIELD_CHECKED',"Checked");
if(! defined(__NAMESPACE__ . '\FIELD_FORMS'))
define(__NAMESPACE__ . '\FIELD_FORMS',"Forms");
if(! defined(__NAMESPACE__ . '\FIELD_ROW'))
define(__NAMESPACE__ . '\FIELD_ROW',"Row");
if(! defined(__NAMESPACE__ . '\FIELD_TEMPLATES'))
define(__NAMESPACE__ . '\FIELD_TEMPLATES',"Templates");
if(! defined(__NAMESPACE__ . '\FIELD_OPTIONS'))
define(__NAMESPACE__ . '\FIELD_OPTIONS',"Options");
if(! defined(__NAMESPACE__ . '\FIELD_NONE'))
define(__NAMESPACE__ . '\FIELD_NONE',"None");
if(! defined(__NAMESPACE__ . '\FIELD_INT'))
define(__NAMESPACE__ . '\FIELD_INT',"Int");
if(! defined(__NAMESPACE__ . '\FIELD_COL'))
define(__NAMESPACE__ . '\FIELD_COL',"Col");
if(! defined(__NAMESPACE__ . '\FIELD_PATH'))
define(__NAMESPACE__ . '\FIELD_PATH',"Path");
if(! defined(__NAMESPACE__ . '\FIELD_ID_UTENTE'))
define(__NAMESPACE__ . '\FIELD_ID_UTENTE',"Id_utente");
if(! defined(__NAMESPACE__ . '\FIELD_ID_PROFILO'))
define(__NAMESPACE__ . '\FIELD_ID_PROFILO',"Id_profilo");
if(! defined(__NAMESPACE__ . '\FIELD_PAR'))
define(__NAMESPACE__ . '\FIELD_PAR',"Par");

if(! defined(__NAMESPACE__ . '\FIELD_LABELS'))
define(__NAMESPACE__ . '\FIELD_LABELS',"Labels");
if(! defined(__NAMESPACE__ . '\FIELD_PAGES'))
define(__NAMESPACE__ . '\FIELD_PAGES',"Pages");
if(! defined(__NAMESPACE__ . '\FIELD_IDS'))
define(__NAMESPACE__ . '\FIELD_IDS',"Ids");

if(! defined(__NAMESPACE__ . '\FIELD_ID_NO_VALUE'))
define(__NAMESPACE__ . '\FIELD_ID_NO_VALUE',STRING_NULL);
if(! defined(__NAMESPACE__ . '\FIELD_NO_VALUE'))
define(__NAMESPACE__ . '\FIELD_NO_VALUE',STRING_NULL);
define(__NAMESPACE__ . '\NO_DATA_SOURCE',STRING_NULL);
define(__NAMESPACE__ . '\NO_DESC_LABEL',STRING_NULL);
define(__NAMESPACE__ . '\NO_FIELD_LABEL',STRING_NULL);

define(__NAMESPACE__ . '\AJAX_HANDLER_PAGE',"ajax_handler.php");
require_once("cheope_ns_ajaxOps.const.php");

define(__NAMESPACE__ . '\PAGE_PROVA',"Prova.php");
define(__NAMESPACE__ . '\PAGE_PROVA_2',"Prova_2.php");
define(__NAMESPACE__ . '\PAGE_PROVA_3',"Prova_3.php");
define(__NAMESPACE__ . '\PAGE_PROVA_4',"Prova_4.php");
define(__NAMESPACE__ . '\PAGE_PROVA_5',"Prova_5.php");
define(__NAMESPACE__ . '\PAGE_PROVA_6',"Prova_6.php");
define(__NAMESPACE__ . '\PAGE_PROVA_7',"Prova_7.php");
define(__NAMESPACE__ . '\PAGE_PROVA_8',"Prova_8.php");
define(__NAMESPACE__ . '\PAGE_PROVA_9',"Prova_9.php");
define(__NAMESPACE__ . '\PAGE_PROVA_10',"Prova_10.php");
define(__NAMESPACE__ . '\PAGE_PROVA_11',"Prova_11.php");
define(__NAMESPACE__ . '\PAGE_PROVA_12',"Prova_12.php");
define(__NAMESPACE__ . '\PAGE_PROVA_13',"Prova_13.php");
define(__NAMESPACE__ . '\PAGE_PROVA_14',"Prova_14.php");
define(__NAMESPACE__ . '\PAGE_PROVA_15',"Prova_15.php");
define(__NAMESPACE__ . '\PAGE_PROVA_16',"Prova_16.php");
define(__NAMESPACE__ . '\PAGE_PROVA_17',"Prova_17.php");
define(__NAMESPACE__ . '\PAGE_PROVA_18',"Prova_18.php");
define(__NAMESPACE__ . '\PAGE_PROVA_19',"Prova_19.php");
define(__NAMESPACE__ . '\PAGE_PROVA_20',"Prova_20.php");
define(__NAMESPACE__ . '\PAGE_PROVA_21',"Prova_21.php");
define(__NAMESPACE__ . '\PAGE_PROVA_22',"Prova_22.php");
define(__NAMESPACE__ . '\PAGE_PROVA_22_2',"Prova_22_2.php");
define(__NAMESPACE__ . '\PAGE_PROVA_23',"Prova_23.php");
define(__NAMESPACE__ . '\PAGE_PROVA_24',"Prova_24.php");
define(__NAMESPACE__ . '\PAGE_PROVA_25',"Prova_25.php");
define(__NAMESPACE__ . '\PAGE_PROVA_26',"Prova_26.php");
define(__NAMESPACE__ . '\PAGE_PROVA_26_2',"Prova_26_2.php");
define(__NAMESPACE__ . '\PAGE_PROVA_27',"Prova_27.php");
define(__NAMESPACE__ . '\PAGE_PROVA_28',"Prova_28.php");
define(__NAMESPACE__ . '\PAGE_PROVA_29',"Prova_29.php");
define(__NAMESPACE__ . '\PAGE_PROVA_30',"Prova_30.php");
define(__NAMESPACE__ . '\PAGE_PROVA_31',"Prova_31.php");
define(__NAMESPACE__ . '\PAGE_PROVA_32',"Prova_32.php");
define(__NAMESPACE__ . '\PAGE_PROVA_33',"Prova_33.php");
define(__NAMESPACE__ . '\PAGE_PROVA_34',"Prova_34.php");
define(__NAMESPACE__ . '\PAGE_PROVA_35',"Prova_35.php");
define(__NAMESPACE__ . '\PAGE_PROVA_36',"Prova_36.php");
define(__NAMESPACE__ . '\PAGE_PROVA_37',"Prova_37.php");
define(__NAMESPACE__ . '\PAGE_PROVA_38',"Prova_38.php");
define(__NAMESPACE__ . '\PAGE_PROVA_38_2',"Prova_38_2.php");
define(__NAMESPACE__ . '\PAGE_PROVA_39',"Prova_39.php");
define(__NAMESPACE__ . '\PAGE_PROVA_40',"Prova_40.php");
define(__NAMESPACE__ . '\PAGE_PROVA_41',"Prova_41.php");
define(__NAMESPACE__ . '\PAGE_PROVA_42',"Prova_42.php");
define(__NAMESPACE__ . '\PAGE_PROVA_42_2',"Prova_42_2.php");
define(__NAMESPACE__ . '\PAGE_PROVA_43',"Prova_43.php");
define(__NAMESPACE__ . '\PAGE_PROVA_44',"Prova_44.php");
define(__NAMESPACE__ . '\PAGE_PROVA_45',"Prova_45.php");
define(__NAMESPACE__ . '\PAGE_PROVA_46',"Prova_46.php");
define(__NAMESPACE__ . '\PAGE_PROVA_47',"Prova_47.php");
define(__NAMESPACE__ . '\PAGE_PROVA_48',"Prova_48.php");
define(__NAMESPACE__ . '\PAGE_PROVA_49',"Prova_49.php");
define(__NAMESPACE__ . '\PAGE_PROVA_50',"Prova_50.php");
define(__NAMESPACE__ . '\PAGE_PROVA_51',"Prova_51.php");
define(__NAMESPACE__ . '\PAGE_PROVA_52',"Prova_52.php");
define(__NAMESPACE__ . '\PAGE_PROVA_53',"Prova_53.php");
define(__NAMESPACE__ . '\PAGE_PROVA_54',"Prova_54.php");
define(__NAMESPACE__ . '\PAGE_PROVA_55',"Prova_55.php");
define(__NAMESPACE__ . '\PAGE_PROVA_56',"Prova_56.php");
define(__NAMESPACE__ . '\PAGE_PROVA_57',"Prova_57.php");
define(__NAMESPACE__ . '\PAGE_PROVA_58',"Prova_58.php");
define(__NAMESPACE__ . '\PAGE_PROVA_59',"Prova_59.php");
define(__NAMESPACE__ . '\PAGE_PROVA_60',"Prova_60.php");
define(__NAMESPACE__ . '\PAGE_PROVA_61',"Prova_61.php");
define(__NAMESPACE__ . '\PAGE_PROVA_62',"Prova_62.php");
define(__NAMESPACE__ . '\PAGE_PROVA_63',"Prova_63.php");
define(__NAMESPACE__ . '\PAGE_PROVA_64',"Prova_64.php");
define(__NAMESPACE__ . '\PAGE_PROVA_65',"Prova_65.php");
define(__NAMESPACE__ . '\PAGE_PROVA_66',"Prova_66.php");
define(__NAMESPACE__ . '\PAGE_PROVA_67',"Prova_67.php");
define(__NAMESPACE__ . '\PAGE_PROVA_68',"Prova_68.php");
define(__NAMESPACE__ . '\PAGE_PROVA_69',"Prova_69.php");
define(__NAMESPACE__ . '\PAGE_PROVA_70',"Prova_70.php");
define(__NAMESPACE__ . '\PAGE_PROVA_71',"Prova_71.php");
define(__NAMESPACE__ . '\PAGE_STARTT',"startt.php");
define(__NAMESPACE__ . '\PAGE_PARAMETRI_DB',"db_parameters.php");

define(__NAMESPACE__ . '\ACCESS_OBB',"Obb");
define(__NAMESPACE__ . '\ACCESS_OPT',"Opt");

define(__NAMESPACE__ . '\TEMP_MSG_DELAY',1000);

define(__NAMESPACE__ . '\PAR',"Par");
define(__NAMESPACE__ . '\PAR1',"Par1");
define(__NAMESPACE__ . '\PAR_KEY_1',"ParKey1");
define(__NAMESPACE__ . '\PAR2',"Par2");
define(__NAMESPACE__ . '\PAR_KEY_2',"ParKey2");
define(__NAMESPACE__ . '\PAR3',"Par3");
define(__NAMESPACE__ . '\PAR_KEY_3',"ParKey3");
define(__NAMESPACE__ . '\PAR4',"Par4");
define(__NAMESPACE__ . '\PAR_INT',"Int");
define(__NAMESPACE__ . '\PAR_NUM',"Num");
define(__NAMESPACE__ . '\PAR_PAGE',"Page");
define(__NAMESPACE__ . '\PAR_FUNCTIONS_LIBS',"fun");
define(__NAMESPACE__ . '\PAR_CONSTS_LIBS',"const");
define(__NAMESPACE__ . '\PAR_CLASSES_MODULES',"class");
define(__NAMESPACE__ . '\PAR_APPLICATIONS_MODULES',"applications");
define(__NAMESPACE__ . '\PAR_DEFINITIONS_MODULES',"definitions");

define(__NAMESPACE__ . '\SESSION_VAR_ACTIVE_APP',"ActiveApp");
define(__NAMESPACE__ . '\SESSION_VAR_USER',"User");
define(__NAMESPACE__ . '\SESSION_VAR_PASSWORD',"Password");
define(__NAMESPACE__ . '\SESSION_VAR_DIR',"Dir");
define(__NAMESPACE__ . '\SESSION_TABLES',"Tables");

require_once("cheope_ns_consts_gen.def.php");

define(__NAMESPACE__ . '\DIALOG_WIDTH',700);
define(__NAMESPACE__ . '\DIALOG_HEIGHT',500);

require_once("cheope_ns_css.const.php");

define(__NAMESPACE__ . '\TAG_ID_MENU',"menu");
define(__NAMESPACE__ . '\TAG_ID_MENU_1',"menu1");

define(__NAMESPACE__ . '\CURTAIN_MENU_ID',"curtainMenuId");
define(__NAMESPACE__ . '\CURTAIN_MENU_ID_1',"curtainMenuId1");
define(__NAMESPACE__ . '\CURTAIN_MENU_ID_2',"curtainMenuId2");
define(__NAMESPACE__ . '\CURTAIN_MENU_ID_3',"curtainMenuId3");

//define(__NAMESPACE__ . '\LOG_ENABLED',true);
define(__NAMESPACE__ . '\IS_ALREADY_CONNECTED_TEST_ENABLED',false);
define(__NAMESPACE__ . '\DISABLE_START_TIME',"9:00");
define(__NAMESPACE__ . '\DISABLE_DURATE',3);
define(__NAMESPACE__ . '\DISABLE_MSG',"IL PROGRAMMA E' TEMPORANEAMENTE DISABILITATO. RIPARTIRA' TRA ");
define(__NAMESPACE__ . '\PAGE_REFRESH_ENABLED',false);
define(__NAMESPACE__ . '\PAGE_REFRESH_DELAY',20);

define(__NAMESPACE__ . '\CONTENITORE_GLOBALE_INTERFACCE',"GlobalIntCont");
//}
?>