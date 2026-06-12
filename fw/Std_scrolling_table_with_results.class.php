<?
namespace Std\fw;
require_once("Std_scrolling_table.class.php");

class Std_scrolling_table_with_results extends Std_scrolling_table
{ 
 const RESULTS_CSS_CLASS="scrolling_table_results";
 const NEGATIVE_IMPORT_ROWS_CSS_CLASS="scrolling_table_neg_import_rows";

 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  parent::__construct($actObj,$actOp,$actNum);
 }
  
 // Eventualmente per override.
 function putFooter():void
 {
 	$htmlWriter = $this->getHtmlWriter();
	$htmlWriter->putTableOpenTag(STRING_NULL,self::RESULTS_CSS_CLASS,"100%");
	$htmlWriter->putTableRowOpenTag(STRING_NULL);
	$htmlWriter->putTableColumnOpenTag(STRING_NULL,STRING_NULL);
	$dataSource = $this->getDataSource();
	$totRows = count($dataSource);
	$htmlWriter->putGenericHtmlString("Tot:" . $totRows);
	$htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG);
	$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG);
	$htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG);  
 }
 

}


?>