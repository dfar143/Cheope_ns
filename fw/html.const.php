<?
namespace Cheope_ns\fw;
require_once("generic.const.php");

define(__NAMESPACE__ . '\ATTRIBUTE_ID',"id");
define(__NAMESPACE__ . '\ATTRIBUTE_HREF',"href");
define(__NAMESPACE__ . '\ATTRIBUTE_TARGET',"target");
define(__NAMESPACE__ . '\ATTRIBUTE_CLASS',"class");

define(__NAMESPACE__ . '\LANG_ITALIAN',"it");
define(__NAMESPACE__ . '\LANG_ENGLISH',"en");

define(__NAMESPACE__ . '\HTML_TAG_INIT_CHAR',STRING_OPEN_ANGLE_BRACKET);
define(__NAMESPACE__ . '\HTML_TAG_END_CHAR',STRING_CLOSE_ANGLE_BRACKET);

define(__NAMESPACE__ . '\CLOSE_TAG',STRING_SLASH . namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\AREA_TAG',"Area");
define(__NAMESPACE__ . '\NAV_TAG',"nav");
define(__NAMESPACE__ . '\AREA_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\AREA_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\DD_TAG',"dd");
define(__NAMESPACE__ . '\DD_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\DD_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\DL_TAG',"dl");
define(__NAMESPACE__ . '\DL_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\DL_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\DT_TAG',"dt");
define(__NAMESPACE__ . '\DT_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\DT_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\H1_TAG',"h1");
define(__NAMESPACE__ . '\H1_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\H1_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\H2_TAG',"h2");
define(__NAMESPACE__ . '\H2_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\H2_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\H3_TAG',"h3");
define(__NAMESPACE__ . '\H3_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\H3_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\INPUT_TAG',"input");
define(__NAMESPACE__ . '\INPUT_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\INPUT_TAG . namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\OL_TAG',"ol");
define(__NAMESPACE__ . '\OL_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\OL_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\UL_TAG',"ul");
define(__NAMESPACE__ . '\UL_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\UL_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\LI_TAG',"li");
define(__NAMESPACE__ . '\LI_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\LI_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\FRAME_TAG', "frame");
define(__NAMESPACE__ . '\FRAMESET_TAG',"frameset");
define(__NAMESPACE__ . '\FRAMESET_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\FRAMESET_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\OPTION_TAG',"option");
define(__NAMESPACE__ . '\OPTION_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\OPTION_TAG . namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\SELECT_TAG',"select");
define(__NAMESPACE__ . '\SELECT_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\SELECT_TAG . namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TEXTAREA_TAG',"textarea");
define(__NAMESPACE__ . '\TEXTAREA_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\TEXTAREA_TAG . namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\BUTTON_TAG',"button");
define(__NAMESPACE__ . '\BUTTON_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\BUTTON_TAG . namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\LINK_TAG',"link");
define(__NAMESPACE__ . '\IMG_TAG',"img");
define(__NAMESPACE__ . '\PHP_OPEN_TAG',namespace\HTML_TAG_INIT_CHAR . namespace\STRING_QUESTION_MARK);
define(__NAMESPACE__ . '\PHP_CLOSE_TAG',namespace\STRING_QUESTION_MARK . namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\ANCHOR_TAG',"a");
define(__NAMESPACE__ . '\ANCHOR_OPEN_TAG',namespace\HTML_TAG_INIT_CHAR  . namespace\ANCHOR_TAG . 
namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\ANCHOR_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\ANCHOR_TAG . namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\PARAGRAPH_TAG',"p");
define(__NAMESPACE__ . '\PARAGRAPH_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\PARAGRAPH_TAG . namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\LEVEL_TAG',"div");
define(__NAMESPACE__ . '\SEP_TAG',"br");
define(__NAMESPACE__ . '\SEP_OPEN_TAG',namespace\HTML_TAG_INIT_CHAR  . namespace\SEP_TAG . 
STRING_SLASH . namespace\HTML_TAG_END_CHAR );
define(__NAMESPACE__ . '\LINE_TAG',"hr");
define(__NAMESPACE__ . '\LINE_OPEN_TAG',namespace\HTML_TAG_INIT_CHAR  . namespace\LINE_TAG . 
namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\EMBOLD_TAG',"b");
define(__NAMESPACE__ . '\EMBOLD_OPEN_TAG',namespace\HTML_TAG_INIT_CHAR  . namespace\EMBOLD_TAG . 
namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\EMBOLD_CLOSE_TAG',namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\EMBOLD_TAG . namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\LABEL_TAG',"label");
define(__NAMESPACE__ . '\LABEL_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\LABEL_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\LABEL_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\LABEL_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_TAG',"table");
define(__NAMESPACE__ . '\TABLE_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\TABLE_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . STRING_SLASH . 
namespace\TABLE_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_ROW_TAG',"tr");
define(__NAMESPACE__ . '\TABLE_ROW_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\TABLE_ROW_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_ROW_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\TABLE_ROW_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_COLUMN_TAG',"td");
define(__NAMESPACE__ . '\TABLE_COLUMN_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . 
namespace\TABLE_COLUMN_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_COLUMN_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\TABLE_COLUMN_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_H_TAG',"th");
define(__NAMESPACE__ . '\TABLE_H_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\TABLE_H_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_H_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\TABLE_H_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_THEAD_TAG',"thead");
define(__NAMESPACE__ . '\TABLE_THEAD_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . 
namespace\TABLE_THEAD_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_THEAD_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\TABLE_THEAD_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_TBODY_TAG',"tbody");
define(__NAMESPACE__ . '\TABLE_TBODY_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\TABLE_TBODY_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_TBODY_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\TABLE_TBODY_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_TFOOT_TAG',"tfoot");
define(__NAMESPACE__ . '\TABLE_TFOOT_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\TABLE_TFOOT_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TABLE_TFOOT_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\TABLE_TFOOT_TAG .  namespace\HTML_TAG_END_CHAR);

define(__NAMESPACE__ . '\FIELDSET_TAG',"fieldset");
define(__NAMESPACE__ . '\FIELDSET_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\FIELDSET_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\FIELDSET_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\FIELDSET_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\LEGEND_TAG',"legend");
define(__NAMESPACE__ . '\LEGEND_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\LEGEND_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\LEGEND_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . namespace\STRING_SLASH . LEGEND_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\FORM_TAG',"form");
define(__NAMESPACE__ . '\FORM_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\FORM_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\FORM_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\FORM_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\NO_SCRIPT_TAG',"noscript");
define(__NAMESPACE__ . '\NO_SCRIPT_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\NO_SCRIPT_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\NO_SCRIPT_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\NO_SCRIPT_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\SCRIPT_TAG',"script");
define(__NAMESPACE__ . '\SCRIPT_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . 
namespace\SCRIPT_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\SCRIPT_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\SCRIPT_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\DIV_TAG',"div");
define(__NAMESPACE__ . '\DIV_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\DIV_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\DIV_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\DIV_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\SPAN_TAG',"span");
define(__NAMESPACE__ . '\SPAN_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\SPAN_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\SPAN_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\SPAN_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\HTML_TAG',"html");
define(__NAMESPACE__ . '\HTML_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\HTML_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\HTML_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\HTML_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\HEAD_TAG',"head");
define(__NAMESPACE__ . '\HEAD_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\HEAD_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\HEAD_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\HEAD_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TITLE_TAG',"title");
define(__NAMESPACE__ . '\TITLE_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\TITLE_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\TITLE_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\TITLE_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\BODY_TAG',"body");
define(__NAMESPACE__ . '\BODY_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\BODY_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\BODY_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\BODY_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\NOFRAMES_TAG',"noframes");
define(__NAMESPACE__ . '\NOFRAMES_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR  . namespace\NOFRAMES_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\NOFRAMES_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\NOFRAMES_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\NAV_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR . namespace\NAV_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\NAV_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\NAV_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\I_TAG',"i");
define(__NAMESPACE__ . '\I_OPEN_TAG', namespace\HTML_TAG_INIT_CHAR . namespace\I_TAG .  namespace\HTML_TAG_END_CHAR);
define(__NAMESPACE__ . '\I_CLOSE_TAG', namespace\HTML_TAG_INIT_CHAR . 
STRING_SLASH . namespace\I_TAG .  namespace\HTML_TAG_END_CHAR);

define(__NAMESPACE__ . '\BUTTON_TYPE_SUBMIT',"submit");
define(__NAMESPACE__ . '\BUTTON_TYPE_RESET',"reset");
define(__NAMESPACE__ . '\BUTTON_TYPE_ANNULLA',"Annulla");
define(__NAMESPACE__ . '\BUTTON_TYPE_BUTTON',"button");

define(__NAMESPACE__ . '\INPUT_TYPE_CHECKBOX',"checkbox");
define(__NAMESPACE__ . '\INPUT_TYPE_RADIO',"radio");
define(__NAMESPACE__ . '\INPUT_TYPE_PASSWORD',"password");
define(__NAMESPACE__ . '\INPUT_TYPE_FILE',"file");
define(__NAMESPACE__ . '\INPUT_TYPE_HIDDEN',"hidden");
define(__NAMESPACE__ . '\INPUT_TYPE_TEXT',"text");

define(__NAMESPACE__ . '\ENTITY_SPACE',"&nbsp;");
define(__NAMESPACE__ . '\ENTITY_AMP',"&amp;");
define(__NAMESPACE__ . '\ENTITY_COPY',"&copy;");
define(__NAMESPACE__ . '\ENTITY_ACCENTO',"&agrave;");

define(__NAMESPACE__ . '\METHOD_POST',"post");
define(__NAMESPACE__ . '\METHOD_GET',"get");

define(__NAMESPACE__ . '\MIME_0',"text/css");
define(__NAMESPACE__ . '\MIME_1',"application/x-www-form-urlencoded");
define(__NAMESPACE__ . '\MIME_2',"multipart/form-data");
define(__NAMESPACE__ . '\MIME_3',"text/javascript");
define(__NAMESPACE__ . '\MIME_4',"text/html");
define(__NAMESPACE__ . '\MIME_5',"text/label");

define(__NAMESPACE__ . '\CHARSET_UTF8',"UTF-8");
define(__NAMESPACE__ . '\CHARSET_ISO88591',"iso-8859-1");

define(__NAMESPACE__ . '\VOID_URL',STRING_CANCELLETTO);

define(__NAMESPACE__ . '\NO_ID',STRING_NULL);

define(__NAMESPACE__ . '\TARGET_NEW',STRING_UNDERSCORE . "new");
define(__NAMESPACE__ . '\TARGET_BLANK',STRING_UNDERSCORE . "blank");

define(__NAMESPACE__ . '\DOCTYPE_HTML_401_TRANSITIONAL',"html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" 
\"http://www.w3.org/TR/html4/loose.dtd\"");
define(__NAMESPACE__ . '\DOCTYPE_HTML_401_STRICT',"html PUBLIC \"-//W3C//DTD HTML 4.01//EN\" 
\"http://www.w3.org/TR/html4/strict.dtd\"");
define(__NAMESPACE__ . '\DOCTYPE_HTML_401_FRAMESET',"html PUBLIC \"-//W3C//DTD HTML 4.01 Frameset//EN\" 
\"http://www.w3.org/TR/html4/frameset.dtd\"");
define(__NAMESPACE__ . '\DOCTYPE_XHTML_10_STRICT',"html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" 
\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\"");
define(__NAMESPACE__ . '\DOCTYPE_XHTML_10_TRANSITIONAL',"html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" 
\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"");
define(__NAMESPACE__ . '\DOCTYPE_XHTML_10_FRAMESET',"html PUBLIC \"-//W3C//DTD XHTML 1.0 Frameset//EN\" 
\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd\"");
define(__NAMESPACE__ . '\DOCTYPE_XHTML_11',"html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" 
\"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\"");
define(__NAMESPACE__ . '\NO_DOCTYPE',"noDocType");
define(__NAMESPACE__ . '\XML_VERSION',"1.0");

define(__NAMESPACE__ . '\HTML_NAMESPACE',"http://www.w3.org/1999/xhtml");

define(__NAMESPACE__ . '\ALIGN_CENTER',"center");
define(__NAMESPACE__ . '\ALIGN_LEFT',"left");
define(__NAMESPACE__ . '\ALIGN_RIGHT',"right");
define(__NAMESPACE__ . '\TEXTAREA_NUM_COLS',20);

?>