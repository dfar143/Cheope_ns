<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("cheope_ns.fun.php");
require_once("generic.fun.php");


class Cheope_ns_simple_table extends Html_data_interface
{
 //use Serialize_props;
 
 const DEFAULT_CSS_CLASS="simple_table";
 const THEAD_CLASS="simple_table_thead";
 const TFOOT_CLASS="simple_table_tfoot";
 const COLUMNS_FOOTER_CSS_CLASS = "simple_table_columns_footer";
 const COLUMNS_HEADER_CSS_CLASS = "simple_table_columns_header";
 const INNER_TABLE_CLASS="simple_table_inner_table";
 const ROWS_CSS_CLASS_ID_PREFIX="simple_table_row";
 const COLUMNS_CSS_CLASS_ID_PREFIX="simple_table_column";
 const FIELD_ID_SUFFIX="field_id";
 const TABLE_TBODY_ID_SUFFIX="tbody_id";
 const TABLE_THEAD_ID_SUFFIX="thead_id";
 const TABLE_TFOOT_ID_SUFFIX="tfoot_id";
 const DEFAULT_WIDTH="100%";
 const DEFAULT_HEIGHT="100%";
 const DEFAULT_BORDER="0";
 const DEFAULT_SUMMARY=STRING_NULL; 
 const DEFAULT_JAVASCRIPT_MODULE=JS_DATA_TABLES; 
 const DEFAULT_CSS_MODULE="jquery.dataTables.min";
 const DEFAULT_SCROLLY = "100%";
 const DEFAULT_PAGINATE = false;
 const DEFAULT_LENGTH_CHANGE = false;
 const DEFAULT_FILTER = false;
 const DEFAULT_SORT = true;
 const DEFAULT_INFO = true;
 const DEFAULT_AUTO_WIDTH = false;
 const DEFAULT_SCROLLX = false;
 const DEFAULT_IS_REFRESH_ENABLED = false;
 const DEFAULT_DISPLAY_LOAD_TIME = false;
 const DEFAULT_LOAD_TIME = 0;
 const DEFAULT_IS_THERE_TABLE_HEADER = true;
 const DEFAULT_IS_THERE_TABLE_FOOTER = false;
  
	private $paginate = self::DEFAULT_PAGINATE;
	private $lengthChange = self::DEFAULT_LENGTH_CHANGE;
	private $filter = self::DEFAULT_FILTER;
	private $sort = self::DEFAULT_SORT;
	private $info = self::DEFAULT_INFO;
	private $autoWidth = self::DEFAULT_AUTO_WIDTH;
	private $scrollX = self::DEFAULT_SCROLLX;
	private $scrollY = self::DEFAULT_SCROLLY;
	private $isRefreshEnabled = self::DEFAULT_IS_REFRESH_ENABLED;  
  private $width=self::DEFAULT_WIDTH;	
  private $height=self::DEFAULT_HEIGHT;
  private $border=self::DEFAULT_BORDER;
  private $summary=self::DEFAULT_SUMMARY;
  private $fieldsCssClasses = array();
  private $columnsDims = array();
  private $columnsHeaderAlignes = array();
  private $columnsFooterAlignes = array();  
  private $columnsAlignes = array();
  private $tableHeaders = array();
  private $tableFooters = array();
  private $isThereTableHeader = self::DEFAULT_IS_THERE_TABLE_HEADER;
  private $isThereTableFooter = self::DEFAULT_IS_THERE_TABLE_FOOTER;
  private $searchableColumns = array();
  private $displayLoadTime = self::DEFAULT_DISPLAY_LOAD_TIME;
  private $loadTime = self::DEFAULT_LOAD_TIME;
  static private $tablesTotNum=0;
  static $useJQuery = true;
  static $useDojo = false;
  static $hasJavascriptEnabledSwitch = true;
  static $hasJavascriptManagement = true;
  static $hasCssManagement = true;

     
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$tablesTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$tablesTotNum - 1;
  parent::__construct($actObj,$actOp,self::INT_SIMPLE_TABLE,$actNum);
  $this->setJavascriptModule(array(CLIENT_DATA_TABLES_CODE_PATH . DIR_SEP . 
  self::DEFAULT_JAVASCRIPT_MODULE,'https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js'));
  $this->setCssModule(array(CLIENT_DATA_TABLES_STYLE_SHEET_PATH . DIR_SEP . 
  self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX,CLIENT_STYLE_SHEET_PATH . DIR_SEP .
  CSS_SIMPLE_TABLE  . STYLE_SHEET_FILE_POSTFIX));
 }
 
 	function useJQuery():bool
	{
		return self::$useJQuery;
	}
	
	function hasJavascriptEnabledSwitch():bool
	{
		return self::$hasJavascriptEnabledSwitch;
	}
	
	function hasJavascriptManagement():bool
	{
		return self::$hasJavascriptManagement;
	}
	
	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
	}
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 	$htmlWriter = $this->getHtmlWriter();
  $simpleTableObjId = $this->getInterfaceId();
  $paginate = $this->getPaginate();
  $lengthChange = $this->getLengthChange();
  $filter = $this->getFilter();
  $sort = $this->getSort();
  $info = $this->getInfo();
  $autoWidth = $this->getAutoWidth();
  $scrollX = $this->getScrollX();
  $scrollY = $this->getScrollY();
  $searchableColumns = $this->getSearchableColumns();
  
  $dataFields = $this->getDataFields();
  
  $str = STRING_NULL;
  
  if(isset($dataFields[0]) && isset($searchableColumns[0]) && ($searchableColumns[0]=='true'))
   $str = "{\"searchable\":true}";
  elseif(isset($dataFields[0]) && isset($searchableColumns[0]) && ($searchableColumns[0]=='false'))
   $str = "{\"searchable\":false}";
  else
   $str = "null";
   
  $num = count($dataFields);
  
  for($i=1;$i<=$num-1;$i++)
  {
   if(isset($dataFields[$i]) && isset($searchableColumns[$i]) && ($searchableColumns[$i]=='true'))
    $str1 = "{\"searchable\":true}";
   elseif(isset($dataFields[$i]) && isset($searchableColumns[$i]) && ($searchableColumns[$i]=='false'))
    $str1 = "{\"searchable\":false}";
   else
    $str1 = "null";
  	 
  	$str = $str . "," . $str1;
  }
  
  $searchColStr = (($str !== "null") ? ("\"columns\" : [ " . $str . " ]"):(STRING_NULL)); 
  
  $htmlWriter->putGenericHtmlString("\$(document).ready(function() {"  .
	    "\$('#" .  $simpleTableObjId . "').dataTable" .
	    "({" .
	    "\"autoWidth\": " . boolToString($autoWidth) . "," .
	    "\"paging\": " . boolToString($paginate) . "," .
	    "\"scrollX\": " . boolToString($scrollX) . "," .
	    (($scrollY!=0)?("\"scrollY\": \"" . $scrollY . "\","):STRING_NULL) .  
	    "\"scrollCollapse\": true ," .
	    "\"lengthChange\": " . boolToString($lengthChange) . "," .
	    "\"searching\": " . boolToString($filter) . "," .
	    "\"ordering\": " . boolToString($sort) . "," .
	    "\"info\": " . boolToString($info) . 
	    (($searchColStr !== STRING_NULL) ? ("," . $searchColStr):(STRING_NULL)) .
	    "});"  .
		  "if(\$('#" .  $simpleTableObjId . "').length>0)\$.fn.dataTableSettings[0].oScroll.iBarWidth=0;" .
	    "var table = \$('#" .  $simpleTableObjId . "').DataTable();" .
	    "table.draw(false);});");
	    

 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$tablesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$tablesTotNum=$actIntNum + 0;
 }
 
 function enableBootstrap():void
 {
 }
 
 function isStandard():bool
 {
 	return false;
 }
 
 function serialize():void
 {
	//$serializer = $this->getSerializer();
	//$booleanPropsArray=array("isRefreshEnabled","isThereTableHeader","isThereTableFooter",
	//"paginate","lengthChange","filter","sort","info","autoWidth","scrollX","javascriptEnabled");
	//$arrayPropsArray = array("columnsHeaderAlignes","columnsFooterAlignes","tableHeaders","tableFooters","searchableColumns");
	parent::serialize();
	//$this->serialize_props_exec($booleanPropsArray,$arrayPropsArray);
 	$serializer = $this->getSerializer();
 	$isRefreshEnabled = $this->getIsRefreshEnabled();
 	$item0 = array("*isRefreshEnabled"=>$isRefreshEnabled);
 	$serializer->loadItems($item0);
 	$width = $this->getWidth();
 	$item1 = array("width"=>$width);
 	$serializer->loadItems($item1);	
 	$height = $this->getHeight();
 	$item2 = array("height"=>$height);
 	$serializer->loadItems($item2);	
 	$border = $this->getBorder();
 	$item3 = array("border"=>$border);
 	$serializer->loadItems($item3);
 	$summary = $this->getSummary();
 	$item4 = array("summary"=>$summary);
 	$serializer->loadItems($item4);
 	$fieldsCssClasses = $this->getFieldsCssClasses();
 	$item5 = array("\$fieldsCssClasses"=>$fieldsCssClasses);
 	$serializer->loadItems($item5);
 	$columnsDims = $this->getColumnsDims();
 	$item6 = array("\$columnsDims"=>$columnsDims);
 	$serializer->loadItems($item6);
 	$isThereTableHeader = $this->getIsThereTableHeader();
 	$item7 = array("*isThereTableHeader"=>$isThereTableHeader);
 	$serializer->loadItems($item7);
 	$isThereTableFooter = $this->getIsThereTableFooter();
 	$item8 = array("*isThereTableFooter"=>$isThereTableFooter);
 	$serializer->loadItems($item8);	
 	$columnsHeaderAlignes = $this->getColumnsHeaderAlignes();
 	$item9 = array("\$columnsHeaderAlignes"=>$columnsHeaderAlignes);
 	$serializer->loadItems($item9);
 	$columnsFooterAlignes = $this->getColumnsFooterAlignes();
 	$item10 = array("\$columnsFooterAlignes"=>$columnsFooterAlignes);
 	$serializer->loadItems($item10);
 	$columnsAlignes = $this->getColumnsAlignes();
 	$item11 = array("\$columnsAlignes"=>$columnsAlignes);
 	$serializer->loadItems($item11);
 	$tableHeaders = $this->getTableHeaders();
 	$item12 = array("\$tableHeaders"=>$tableHeaders);
 	$serializer->loadItems($item12);
 	$tableFooters = $this->getTableFooters();
 	$item13 = array("\$tableFooters"=>$tableFooters);
 	$serializer->loadItems($item13);
 	//$javascriptEnabled = $this->getJavascriptEnabled();
 	//$item14 = array("*javascriptEnabled"=>$javascriptEnabled);
 	//$serializer->loadItems($item14);
 	$paginate = $this->getPaginate();
 	$item15 = array("*paginate"=>$paginate);
 	$serializer->loadItems($item15);
 	$lengthChange = $this->getLengthChange();
 	$item16 = array("*lengthChange"=>$lengthChange);
 	$serializer->loadItems($item16);
 	$filter = $this->getFilter();
 	$item17 = array("*filter"=>$filter);
 	$serializer->loadItems($item17);
 	$sort = $this->getSort();
 	$item18 = array("*sort"=>$sort);
 	$serializer->loadItems($item18);
 	$info = $this->getInfo();
 	$item19 = array("*info"=>$info);
 	$serializer->loadItems($item19);
 	$autoWidth = $this->getAutoWidth();
 	$item20 = array("*autoWidth"=>$autoWidth);
 	$serializer->loadItems($item20);
 	$scrollX = $this->getScrollX();
 	$item21 = array("*scrollX"=>$scrollX);
 	$serializer->loadItems($item21);
 	$scrollY = $this->getScrollY();
 	$item22 = array("scrollY"=>$scrollY);
 	$serializer->loadItems($item22); 	
 	$searchableColumns = $this->getSearchableColumns();
 	$item23 = array("\$searchableColumns"=>$searchableColumns);
 	$serializer->loadItems($item23); 	
 }
 
 function getCssClass():string
 {
  if($this->cssClass == STRING_NULL)
   return self::DEFAULT_CSS_CLASS;
  else
   return $this->cssClass;
 }
 
  function getSearchableColumns():array
 {
 	if(count($this->searchableColumns) == 0)
 	{
 		$fields = $this->getDataFields();
 		foreach($fields as $ind=>$val)
 		{
 			$this->searchableColumns[$ind]=true;
 		}
 	}
 	return $this->searchableColumns;
 }
 
 function setSearchableColumns(array $actSearchableColumns):void
 {
 	$searchableColumns = $this->convertToKeysNumeric($actSearchableColumns);
 	$this->searchableColumns = $actSearchableColumns;
 }
 
  function getPaginate():bool
  {
  if($this->paginate == STRING_NULL)
   return self::DEFAULT_PAGINATE;
  else
   return $this->paginate;
  }
  
  function setPaginate(bool $actPaginate):void
  {
  	$this->paginate = $actPaginate;
  }
  
  function getLengthChange():bool
  {
  if($this->paginate == STRING_NULL)
   return self::DEFAULT_LENGTH_CHANGE;
  else
   return $this->paginate;
  }
  
  function setLengthChange(bool $actLengthChange):void
  {
  	$this->lengthChange = $actLengthChange;
  }
  
  function getFilter():bool
  {
  if($this->filter == STRING_NULL)
   return self::DEFAULT_FILTER;
  else
   return $this->filter;
  }
  
  function setFilter(bool $actFilter):void
  {
  	$this->filter = $actFilter;
  }
  
  function getSort():bool
  {
   if($this->sort == STRING_NULL)
    return self::DEFAULT_SORT;
   else
    return $this->sort;
  }
  
  function setSort(bool $actSort):void
  {
  	$this->sort = $actSort;
  }
  
  function getInfo():bool
  {
  if($this->sort == STRING_NULL)
    return self::DEFAULT_INFO;
   else
    return $this->sort;
  }
  
  function setInfo(bool $actInfo):void
  {
  	$this->info = $actInfo;
  }
  
  function getAutoWidth():bool
  {
   if($this->autoWidth == STRING_NULL)
    return self::DEFAULT_AUTO_WIDTH;
   else
    return $this->autoWidth;
  }
  
  function setAutoWidth(bool $actAutoWidth):void
  {
  	$this->autoWidth = $actAutoWidth;
  }
  
  function getScrollX():bool
  {
   if($this->scrollX == STRING_NULL)
    return self::DEFAULT_SCROLLX;
   else
    return $this->scrollX;
  }
  
  function setScrollX(bool $actScrollX):void
  {
  	$this->scrollX = $actScrollX;
  } 
  
  function getScrollY():string
  {
  	if($this->scrollY == STRING_NULL)
  	 return self::DEFAULT_SCROLLY;
  	else
     return $this->scrollY; 
  }
  
  function setScrollY(string $actScrollY):void
  {
  	$this->scrollY = $actScrollY;
  }   
  
  function setIsRefreshEnabled(bool $actRefresh):void
 {
  $this->isRefreshEnabled = $actRefresh;
 }
 
 function getIsRefreshEnabled():bool
 {
   return $this->isRefreshEnabled;
 }
 
 function setColumnsDims(array $actColDims):void
 {
 	$columnsDims = $this->convertToKeysNumeric($actColDims);
  $this->columnsDims = $columnsDims;
 }
 
 function getColumnsDims():array
 {
  return $this->columnsDims;
 }
 
 function getColumnsHeaderAlignes():array
 {
 	return $this->columnsHeaderAlignes;
 }
 
 function setColumnsHeaderAlignes(array $actColumnsHeaderAlignes):void
 {
 	$columnsHeaderAlignes = $this->convertToKeysNumeric($actColumnsHeaderAlignes);
 	$this->columnsHeaderAlignes = $columnsHeaderAlignes;
 }
 
 function getColumnsFooterAlignes():array
 {
 	return $this->columnsFooterAlignes;
 }
 
 function setColumnsFooterAlignes(array $actColumnsFooterAlignes):void
 {
 	$columnsFooterAlignes = $this->convertToKeysNumeric($actColumnsFooterAlignes);
 	$this->columnsFooterAlignes = $columnsFooterAlignes;
 }
 
  function getColumnsAlignes():array
 {
 	return $this->columnsAlignes;
 }
 
 function setColumnsAlignes(array $actColumnsAlignes):void
 {
 	$columnsAlignes = $this->convertToKeysNumeric($actColumnsAlignes);
 	$this->columnsAlignes = $columnsAlignes;
 }

 function setTableHeaders(array $actTableHeaders):void
 {
 	$tableHeaders = $this->convertToKeysNumeric($actTableHeaders);
  $this->tableHeaders = $tableHeaders;
 }
 
 function getTableHeaders():array
 {
  return $this->tableHeaders;
 }
 
 function setTableFooters(array $actTableFooters):void
 {
 	$tableFooters = $this->convertToKeysNumeric($actTableFooters);
  $this->tableFooters = $tableFooters;
 }
 
 function getTableFooters():array
 {
  return $this->tableFooters;
 }
 
 function getIsThereTableFooter():bool
 {
   return $this->isThereTableFooter;
 }
 
 function setIsThereTableFooter(bool $actIsThereTableFooter):void
 {
 	$this->isThereTableFooter = $actIsThereTableFooter; 
 }
 
 function getIsThereTableHeader():bool
 {
  return $this->isThereTableHeader;
 }
 
 function setIsThereTableHeader(bool $actIsThereTableHeader):void
 {
 	$this->isThereTableHeader = $actIsThereTableHeader; 
 }
 
 function getWidth():string|int
 {
  if($this->width == STRING_NULL)
   return self::DEFAULT_WIDTH;
  else
   return $this->width; 	
 }
 
 function setWidth(string|int $actWidth):void
 {
 	$this->width = $actWidth;
 }
 
 function getHeight():string|int
 {
  if($this->height == STRING_NULL)
   return self::DEFAULT_HEIGHT;
  else
   return $this->height; 	
 }
 
 function setHeight(string|int $actHeight):void
 {
 	$this->height = $actHeight;
 }
 
 function getBorder():string|int
 {
  if($this->border ==STRING_NULL)
   return self::DEFAULT_BORDER;
  else
   return $this->border; 	
 }
 
 function setBorder(string|int $actBorder):void
 {
 	$this->border = $actBorder;
 }
 
 function getSummary():string
 {
  if($this->summary == STRING_NULL)
   return self::DEFAULT_SUMMARY;
  else
   return $this->summary; 	 	
 }
 
 function setSummary(string $actSummary):void
 {
 	$this->summary = $actSummary;
 } 
 
 function getFieldsCssClasses():array
 {
 	return $this->fieldsCssClasses;
 }
 
 function setFieldsCssClasses(array $actFieldsCssClasses):void
 {
 	$fieldsCssClasses = $this->convertToKeysNumeric($actFieldsCssClasses);
  $this->fieldsCssClasses=$fieldsCssClasses;
 }

 function isContainer():bool
 {
  return false;
 }
 
// Effettua un' elaborazione sul nome del campo
// così come è definito nei $dataFields ai fini di
// visualizzarlo come etichetta
 function adjustField(string $actFieldName):string
 {
  $actFieldName = str_replace(STRING_OPEN_SQUARE_BRACKET,STRING_NULL,$actFieldName);
	$actFieldName = str_replace(STRING_CLOSE_SQUARE_BRACKET,STRING_NULL,$actFieldName);
	return $actFieldName;
 }
 
 function putTableHeader():void
 {
 	$columnsDims = $this->getColumnsDims();
 	$columnsHeaderAlignes = $this->getColumnsHeaderAlignes();
  $htmlWriter = $this->getHtmlWriter();
  $dataFields = $this->getDataFields();
	$tableHeaders = $this->getTableHeaders();
	$headerCssClass = self::COLUMNS_HEADER_CSS_CLASS;	
  $intCode = $this->getInterfaceId();
  $htmlWriter->putTableTHeadOpenTag($intCode . VAR_SEP . 
  self::TABLE_THEAD_ID_SUFFIX,self::THEAD_CLASS); 
	$htmlWriter->putTableRowOpenTag(STRING_NULL,self::THEAD_CLASS);
	$k=0;
	$k1=0;
	$i=0;
	if (count($tableHeaders)>0)
	{
	 foreach($tableHeaders as $theader)
	 { 
	  $field = $dataFields[$i++];
	  $domain = $this->getDataFieldDomainByName($field);
	  if($domain !== Int_domain::FIELD_DOMAIN_NONE)
	  {
	  if(isset($columnsDims[$k1]))
	  {
		 $colDim = $columnsDims[$k1];
	  }
	  else
	  {
		 $colDim = 0;
		}
		
	  if(isset($columnsHeaderAlignes[$k1]))
	    $colHeaderAlign = $columnsHeaderAlignes[$k1];
	  else
	    $colHeaderAlign = ALIGN_CENTER; 
	 
	  $htmlWriter->putTableHOpenTag("table_header" . VAR_SEP . $k1,$headerCssClass,$colDim,
	  STRING_NULL,STRING_NULL,STRING_NULL,$colHeaderAlign);
	  $k1++;
    $htmlWriter->putGenericHtmlString($theader,0); 	  
	  $htmlWriter->putGenericHtmlString(TABLE_H_CLOSE_TAG,0);
	  }
	 }
	}
	else
	{
	 foreach($dataFields as $field)
	 { 
	  $domain = $this->getDataFieldDomainByName($field);
	  if($domain !== Int_domain::FIELD_DOMAIN_NONE)
	  {
	  if(isset($columnsDims[$k]))
    {
		 $colDim = $columnsDims[$k];
    }
	  else
		 $colDim = 0; 
	 
    if(isset($columnsHeaderAlignes[$k]))
	    $colHeaderAlign = $columnsHeaderAlignes[$k];
	  else
	    $colHeaderAlign = ALIGN_CENTER;	 
	 
	  $htmlWriter->putTableHOpenTag("table_header" . VAR_SEP . $k,$headerCssClass,$colDim,
	  STRING_NULL,STRING_NULL,STRING_NULL,$colHeaderAlign);
	  $k++;
    $htmlWriter->putGenericHtmlString($field,0); 	  
	  $htmlWriter->putGenericHtmlString(TABLE_H_CLOSE_TAG,0);
	 }
	}
	}
	$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_THEAD_CLOSE_TAG,0);
 }
 
 function putTableFooter():void
 {
 	$columnsDims = $this->getColumnsDims();
 	$columnsFooterAlignes = $this->getColumnsFooterAlignes();
  $htmlWriter = $this->getHtmlWriter();
  $dataFields = $this->getDataFields();
	$tableFooters = $this->getTableFooters();
	$footerCssClass = self::COLUMNS_FOOTER_CSS_CLASS;	
  $intCode = $this->getInterfaceId();
  $htmlWriter->putTableTFootOpenTag($intCode . VAR_SEP . 
  self::TABLE_TFOOT_ID_SUFFIX,self::TFOOT_CLASS); 
	$htmlWriter->putTableRowOpenTag(STRING_NULL,self::THEAD_CLASS);
	$k=0;
	$k1=0;
	$displayLoadTimeFlag = $this->getDisplayLoadTime();
	if($displayLoadTimeFlag)
	{
		$loadTime = $this->getLoadTime();
	  $htmlWriter->putTableHOpenTag("table_footer",$footerCssClass,STRING_NULL,
	  STRING_NULL,STRING_NULL,STRING_NULL);
		$htmlWriter->putGenericHtmlString($loadTime . ".sec");
		$htmlWriter->putGenericHtmlString(TABLE_H_CLOSE_TAG,0);	
	}
	else
	{
	 if (count($tableFooters)>0)
	 {
	 foreach($tableFooters as $tFooter)
	 { 
	  if(isset($columnsDims[$k1]))
	  {
		 $colDim = $columnsDims[$k1];
	  }
	  else
	  {
		 $colDim = 0;
		}
		
	  if(isset($columnsFooterAlignes[$k1]))
	    $colFooterAlign = $columnsFooterAlignes[$k1];
	  else
	    $colFooterAlign = ALIGN_CENTER; 
	 
	  $htmlWriter->putTableHOpenTag("table_footer" . VAR_SEP . $k1,$footerCssClass,$colDim,
	  STRING_NULL,STRING_NULL,STRING_NULL,$colFooterAlign);
	  $k1++;
    $htmlWriter->putGenericHtmlString($tFooter,0); 	  
	  $htmlWriter->putGenericHtmlString(TABLE_H_CLOSE_TAG,0);
	 }
	 }
	 else
	 {
	 foreach($dataFields as $field)
	 { 
	  if(isset($columnsDims[$k]))
    {
		 $colDim = $columnsDims[$k];
    }
	  else
		 $colDim = 0; 
	 
    if(isset($columnsFooterAlignes[$k]))
	    $colFooterAlign = $columnsFooterAlignes[$k];
	  else
	    $colFooterAlign = ALIGN_CENTER;	 
	 
	  $htmlWriter->putTableHOpenTag("table_footer" . VAR_SEP . $k,$footerCssClass,$colDim,
	  STRING_NULL,STRING_NULL,STRING_NULL,$colFooterAlign);
	  $k++;
    $htmlWriter->putGenericHtmlString($field,0); 	  
	  $htmlWriter->putGenericHtmlString(TABLE_H_CLOSE_TAG,0);
	 }
	 }
	}
	$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_TFOOT_CLOSE_TAG,0);
 }
 
 function getLoadTime():float
 {
 	if($this->loadTime == NO_VALUE)
 	 return self::DEFAULT_LOAD_TIME;
 	else
 	 return $this->loadTime;
 }
 
 function setLoadTime(float $actLoadTime):void
 {
 	$this->loadTime = $actLoadTime;
 }
 
 function setDisplayLoadTime(bool $actDisplayLoadTime):void
 {
 	$this->displayLoadTime = $actDisplayLoadTime;
 }
 
 function getDisplayLoadTime():bool
 {
 	if($this->loadTime == STRING_NULL)
 	 return self::DEFAULT_LOAD_TIME;
 	else
 	 return $this->loadTime;
 }
 
 function initPutData():array
 {
 }
  
 function putData():void
 { 
  $htmlWriter = $this->getHtmlWriter();
  $startTime = getMicroTime();
  $rows = $this->getDataSource();
  $this->fieldsFromDataSource();
  $dataFields = $this->getDataFields();
  $class = $this->getCssClass();
  $intCode = $this->getInterfaceId();
  $width = $this->getWidth();
  $height = $this->getHeight();
  $border = $this->getBorder();
  $summary = $this->getSummary();
  $type = $this->getType();
  $columnsDims = $this->getColumnsDims();
  $columnsAlignes = $this->getColumnsAlignes();  
  $fieldsCssClasses = $this->getFieldsCssClasses();
  $rows = $this->initDataSource($rows);
  $style = $this->getStyle();
  $num = $this->getNum();
  
 	$htmlWriter->putDivOpenTag(STRING_NULL,$style,$class);
  $htmlWriter->putTableOpenTag($intCode,self::INNER_TABLE_CLASS,$width,
   $height,$border,STRING_NULL,STRING_NULL,$summary);
	if($this->getIsThereTableHeader())
    $this->putTableHeader();
  $htmlWriter->putTableTBodyOpenTag($intCode . VAR_SEP . 
  self::TABLE_TBODY_ID_SUFFIX);
  $i=0;

  foreach($rows as $rowVal)
  {
   $htmlWriter->putTableRowOpenTag(STRING_NULL,self::ROWS_CSS_CLASS_ID_PREFIX . VAR_SEP . $i);
	 $k=0;
   foreach($dataFields as $field)
	 {
		$fieldDom = $this->getDataFieldDomainByName($field);
		if($fieldDom !== Int_domain::FIELD_DOMAIN_NONE)
		{		
	  if(isset($columnsDims[$k]))
		 $colDim = $columnsDims[$k];
		else
		 $colDim = 0;
		 
	   if(isset($columnsAlignes[$k]))
	    $colAlign = $columnsAlignes[$k];
	   else
	    $colAlign = ALIGN_CENTER;
		   
	   if(array_key_exists($field,$rowVal))
	    $fieldValue = $rowVal[$field];
	   else
	    $fieldValue = NO_VALUE;	
	     	   
	   if (isset($fieldsCssClasses[$k]))
	    $fieldCssClass = $fieldsCssClasses[$k];
	   else
	    $fieldCssClass = self::COLUMNS_CSS_CLASS_ID_PREFIX . VAR_SEP . $field;	 
	
	   $fieldValues = $this->getDataFieldAllValues($field,$fieldValue);

     if(is_array($fieldValues) && isset($fieldValues[$field]))
     {
    	$fieldValue = $fieldValues[$field];
     }
     elseif(is_array($fieldValues))
	   {
	    $fieldValue = current($fieldValues);
	    next($fieldValues);
	   }
	   else
		  $fieldValue = $fieldValues;
	
	   $htmlWriter->putTableColumnOpenTag(STRING_NULL,$fieldCssClass,$colDim,STRING_NULL,
	    STRING_NULL,STRING_NULL,STRING_NULL,$colAlign);
		 $htmlWriter->putDivOpenTag($intCode . VAR_SEP . self::FIELD_ID_SUFFIX . 
		  VAR_SEP . $field . VAR_SEP . $i);
		 if(($fieldDom != Int_domain::FIELD_DOMAIN_OBJ)&&($fieldDom != Int_domain::FIELD_DOMAIN_FUNCTION))
       $htmlWriter->putGenericHtmlString($fieldValue,0);
     elseif($fieldDom == Int_domain::FIELD_DOMAIN_FUNCTION)
     {
       $htmlWriter->putGenericHtmlString($fieldValue(),0);
		 } 
		 else
		 {			 	
 	   	if(is_a($fieldValue,Classes_info::HTML_DATA_INTERFACE_CLASS))
 	   	{
 	   	 if(is_a($fieldValue,Classes_info::HTML_INPUT_CTRL_CLASS))
 	   	   $fieldValue->setPrefixBeforeName(true);
 	   	 $fieldValueObj = $fieldValue->getObj();
		   if((! is_object($fieldValueObj)) && $this->getInheritData())
			   $fieldValue->setDataSource($rowVal);
			 $fieldValue->setHtmlWriter($htmlWriter);
 	   	}	
 	   	elseif(is_a($fieldValue,Classes_info::DATA_INTERFACE_CLASS))
 	   	{
 	   	// if(is_a($fieldValue,Classes_info::HTML_INPUT_CTRL_CLASS))
 	   	//   $fieldValue->setPrefixBeforeName(true);
 	   	 $fieldValueObj = $fieldValue->getObj();
		   if((! is_object($fieldValueObj)) && $this->getInheritData())
			   $fieldValue->setDataSource($rowVal);
 	   	}
 	    if ($this->getInheritDataFieldName())
		      $fieldValue->setNum($num . VAR_SEP . $i . VAR_SEP . $field);
		 	
			$fieldValue->putData();
		 }
		 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
		 $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
		}
		$k++;
	  } 
	  $i++;
	  $htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
	 }
	 $htmlWriter->putGenericHtmlString(TABLE_TBODY_CLOSE_TAG);
   $endTime = getMicroTime();
   $loadTime = sprintf("%.2f",0.0 + $endTime - $startTime);
   $this->setLoadTime($loadTime);
	 if($this->getIsThereTableFooter())
    $this->putTableFooter();
	 $htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG);
   $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
  }
}


?>