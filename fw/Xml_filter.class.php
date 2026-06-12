<?
namespace Cheope_ns\fw;
require_once("Filter.class.php");
require_once("Xml_tag_builder.class.php");
require_once("Creator.tra.php");

//
// Trasforma un oggetto php 
// (array , scalare o istanza di Stringable) in codice xml. 
//

class Xml_filter extends Filter implements Factory_8
{
	Use Creator;
	
	const DEFAULT_FILTER_ROOT = "records";
	const DEFAULT_FILTER_RECORD = "record";
	const DEFAULT_ROW_SEP_STRING = STRING_NULL;
	const DEFAULT_TAGS_SUFFIX = "ind" . VAR_SEP;
	
	private $xmlBuilder = null;
	private $tagsSuffix = Xml_filter::DEFAULT_TAGS_SUFFIX;
	private $rowSepString = Xml_filter::DEFAULT_ROW_SEP_STRING;
	private $filter_root = Xml_filter::DEFAULT_FILTER_ROOT;
	private $filter_record = Xml_filter::DEFAULT_FILTER_RECORD;
	
	function __construct()
	{
		parent::__construct();
	  $xmlBuilder = $this->create("Xml_tag_builder");
	  $this->setXmlBuilder($xmlBuilder);
	}
	
	function setXmlBuilder(Xml_tag_builder $actXmlBuilder):void
	{
		$this->xmlBuilder = $actXmlBuilder;
	}
	
	function getXmlBuilder():Xml_tag_builder
	{
		return $this->xmlBuilder;
	}

	function setTagsSuffix(string $actTagsSuffix):void
	{
		$this->tagsSuffix = $actTagsSuffix;
	}
	
	function getTagsSuffix():string
	{
	 return $this->tagsSuffix;
	}
	
	function setRowSepString(string $actRowSep):void
	{
		$this->rowSepString = $actRowSep;
	}
	
	function getRowSepString():string
	{
	 return $this->rowSepString;
	}
	
	function create(string $actClass):object
	{
		return Creator::create($actClass,STRING_NULL);
	}
	
	function getFilterRoot():string
	{
		return $this->filter_root;
	}
	
	function setFilterRoot(string $actFilterRoot):void
	{
		$this->filter_root = $actFilterRoot;
	}
	
	function getFilterRecord():string
	{
		return $this->filter_record;
	}
	
	function setFilterRecord(string $actFilterRecord):void
	{
		$this->filter_record = $actFilterRecord;
	}	
	
	function exec_recurse($actItem,string $actInd):string
	{
	 $filter_root = $this->getFilterRoot();
	 $retStr = STRING_NULL;
	 $innerItemTags = STRING_NULL;
	 $sepString = $this->getRowSepString();
	 $tagsSuffix = $this->getTagsSuffix();
	 $xmlBuilder = $this->getXmlBuilder();
   if(is_array($actItem))
   {
   	$ind = $actInd;
		$actInd = $tagsSuffix . $actInd; 
   	
	  $xmlBuilder->setTag(trim($actInd));
   	if($actInd != $filter_root)
   	{      
     $recordOpenTag1 = $xmlBuilder->tag_open_build(array("type"=>"array","id"=>$ind));
    }
    else
    {
     $recordOpenTag1 = $xmlBuilder->tag_open_build();
    }
	  $recordCloseTag1 = $xmlBuilder->tag_close_build();
	  $newRetStr = STRING_NULL;
    foreach($actItem as $ind=>$val)
    {
   	 $retStr = $this->exec_recurse($val,$ind);	    
     $newRetStr .= $retStr;     
    } 
    $innerItemTag = $recordOpenTag1 . $sepString . 
    $newRetStr . $sepString . $recordCloseTag1; 
    $innerItemTags .= $innerItemTag; 
   }
   else
   {
   	$firstChar = substr($actInd,0,1);
   	if(($firstChar==STRING_AT)||($firstChar==STRING_STAR)||($firstChar==STRING_PERCENT)||($firstChar==STRING_DOLLAR))
   	{ 
   	 $actInd1 = substr($actInd,1,strlen($actInd)-1);
   	 $ind = $actInd1;
   	 $actInd = $ind;
   	}
   	else
   	 $ind = $actInd;
		$actInd = $tagsSuffix . $actInd; 
	  $xmlBuilder->setTag(trim($actInd));
	  $openTag = $xmlBuilder->tag_open_build(array("type"=>"scalar","id"=>$ind));
	  $closeTag = $xmlBuilder->tag_close_build();
	  $cDataOpenTag = $xmlBuilder->cData_open_build();
	  $cDataCloseTag = $xmlBuilder->cData_close_build();
    $innerItemTags = $openTag . $cDataOpenTag . $sepString . $actItem . 
	  $sepString . $cDataCloseTag . $closeTag;
   }
   return $innerItemTags;		
	}
	
	function exec():string|array
	{
		$sepString = $this->getRowSepString();
		$xmlBuilder = $this->getXmlBuilder();
		$item = $this->getItem();
		if($item instanceof Stringable)
		{
	   $xmlBuilder->setTag(self::DEFAULT_FILTER_RECORD);
     $recordOpenTag = $xmlBuilder->tag_open_build();
	   $recordCloseTag = $xmlBuilder->tag_close_build();	
		 $retStr = $recordOpenTag . $item->toString() . $recordCloseTag;
		}
		else
		{
   	 $filter_root = $this->getFilterRoot();
     $retStr = $this->exec_recurse($item,$filter_root);		  
		}
	  $prolog = $xmlBuilder->getProlog();
	 return $prolog . $sepString . $retStr;
  }
}



?>