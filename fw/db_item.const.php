<?
namespace Cheope_ns\fw;
require_once("generic.const.php");

define(__NAMESPACE__ . '\FIELD_TYPE_NONE',STRING_NULL);
define(__NAMESPACE__ . '\FIELD_TYPE_INTEGER',"Integer");
define(__NAMESPACE__ . '\FIELD_TYPE_FLOAT',"Float");
define(__NAMESPACE__ . '\FIELD_TYPE_STRING',"String");
define(__NAMESPACE__ . '\FIELD_TYPE_DATE',"Date");
define(__NAMESPACE__ . '\FIELD_TYPE_BIG_STRING',"Big_string");
define(__NAMESPACE__ . '\FIELD_TYPE_BOOLEAN',"Boolean");
define(__NAMESPACE__ . '\FIELD_TYPE_IP',"Ip");

// Definizione delle operazioni
define(__NAMESPACE__ . '\OP_NONE',STRING_NULL);
define(__NAMESPACE__ . '\OP_MODIFICA',"Modifica");
define(__NAMESPACE__ . '\OP_INSERIMENTO',"Inserimento");
define(__NAMESPACE__ . '\OP_CONSULTAZIONE',"Consultazione");
define(__NAMESPACE__ . '\OP_FAILED',"Failed");
define(__NAMESPACE__ . '\OP_SUCCESS',"Success");

?>