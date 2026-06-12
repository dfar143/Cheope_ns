<?
namespace Std\fw;
require_once("std_generic.const.php");
require_once("std_filesystem.const.php");
require_once("std_http.const.php");
require_once("class.const.php");

//Definizione costanti numeri interi.
if(! defined('TOT_NUM'))
define('TOT_NUM',45);
require_once("std_num.def.php");

//Definizione costanti oggetto.
//require_once("std_obj.const.php");

//Definizione nomi tabelle.
require_once("std_tables.const.php");

//Definizione costanti campi di tabelle.
require_once("std_fields.def.php");

//Definizione costanti labels.
require_once("std_consts_gen.def.php");

//Definizione costanti pagine.
require_once("std_pages.const.php");

// Definizione costanti ajaxops.
require_once("std_ajaxOps.const.php");

//Definizione costanti fogli di stile.
require_once("std_css.const.php");

//Definizione costanti di utilità.
define(__NAMESPACE__ . '\LOG_ENABLED',false);
define(__NAMESPACE__ . '\IS_ALREADY_CONNECTED_TEST_ENABLED',false);
define(__NAMESPACE__ . '\DISABLE_START_TIME',"9:00");
define(__NAMESPACE__ . '\DISABLE_DURATE',5);
define(__NAMESPACE__ . '\DISABLE_MSG',"IL PROGRAMMA E' TEMPORANEAMENTE DISABILITATO. RIPARTIRA' TRA ");
define(__NAMESPACE__ . '\PAGE_REFRESH_ENABLED',false);
define(__NAMESPACE__ . '\PAGE_REFRESH_DELAY',20);
define(__NAMESPACE__ . '\TEMP_MSG_DELAY',1000);
define(__NAMESPACE__ . '\CONTENITORE_GLOBALE_INTERFACCE',"GlobalIntCont");
define(__NAMESPACE__ . '\ACCESSORY_TABLE_SUFFIX',"ac" . VAR_SEP);
define(__NAMESPACE__ . '\BIG_STRING_LENGTH',60);
// Definizioni costanti generiche fields.
define(__NAMESPACE__ . '\FIELD_NONE',STRING_NULL);
define(__NAMESPACE__ . '\FIELD_ID_SUFFIX' , CONST_SEP . "ID");
define(__NAMESPACE__ . '\FIELD_ID_PREFIX' , "ID" . CONST_SEP);
define(__NAMESPACE__ . '\FIELD_ID_NO_VALUE',STRING_NULL);
define(__NAMESPACE__ . '\FIELD_NO_VALUE',STRING_NULL);
define(__NAMESPACE__ . '\FIELD_MENU_VOICES',"Menu_voices");
define(__NAMESPACE__ . '\FIELD_MENU_PAGES',"Menu_pages");
define(__NAMESPACE__ . '\FIELD_MENU_IDS',"Menu_ids");
define(__NAMESPACE__ . '\FIELD_USER',"User");
define(__NAMESPACE__ . '\FIELD_PASSWORD',"Password");
// Definizione costanti sessione.
define(__NAMESPACE__ . '\SESSION_VAR_ACTIVE_APP',"ActiveApp");
define(__NAMESPACE__ . '\SESSION_FIELD_NONE',STRING_NULL);
define(__NAMESPACE__ . '\SESSION_VAR_USER',"User");
define(__NAMESPACE__ . '\SESSION_VAR_PASSWORD',"Password");
// Definizione varie.
define(__NAMESPACE__ . '\INDENT_SEP_2' , "__");
define(__NAMESPACE__ . '\INDENT_SEP_3' , "___");
define(__NAMESPACE__ . '\PRIV_SEP',STRING_MINUS);
define(__NAMESPACE__ . '\FIELD_SEP',STRING_SPACE);
define(__NAMESPACE__ . '\HEAD_SEP',STRING_SPACE);
// Definizione costanti parametri urls.
define(__NAMESPACE__ . '\PAR',"Par");
define(__NAMESPACE__ . '\PAR1',"Par1");
define(__NAMESPACE__ . '\PAR_KEY_1',"ParKey1");
define(__NAMESPACE__ . '\PAR2',"Par2");
define(__NAMESPACE__ . '\PAR_KEY_2',"ParKey2");
define(__NAMESPACE__ . '\PAR3',"Par3");
define(__NAMESPACE__ . '\PAR_KEY_3',"ParKey3");
define(__NAMESPACE__ . '\PAR4',"Par4");
// Definizione tipi accesso a campi dei forms.
define(__NAMESPACE__ . '\ACCESS_OBB',"Obb");
define(__NAMESPACE__ . '\ACCESS_OPT',"Opt");
// Dimensioni standard dialoghi.
define(__NAMESPACE__ . '\DIALOG_WIDTH',700);
define(__NAMESPACE__ . '\DIALOG_HEIGHT',500);
// Massimo numero righe per query select.
define(__NAMESPACE__ . '\MAX_SQL_NUM_ROWS',300);
?>