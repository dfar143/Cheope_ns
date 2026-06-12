<?
namespace Cheope_ns\fw;
require_once ("Html_formatted_interface.class.php");
require_once ("cheope_ns.fun.php");


define ( 'HTML_FRAGMENT_BODY_ID_SUFFIX', "body" );

class Html_file_fragment extends Html_formatted_interface 
{
 
	const HTML_FRAGMENT_BODY_ID_SUFFIX = "body";
	private $fileName=STRING_NULL;
	private static $fileFragmentsTotNum = 0;
	
	function __construct(string $actOp = OP_NONE, $actNum = 0) 
	{
		self::$fileFragmentsTotNum ++;
		if ($actNum === STRING_NULL)
			$actNum = self::$fileFragmentsTotNum - 1;
		parent::__construct ( $actOp, Interfaces_info::INT_HTML_FILE_FRAGMENT, $actNum );
	}
	
	static function getInterfacesTotNum():string|int
	{
		return self::$fileFragmentsTotNum;
	}
	
	static function setInterfacesTotNum(int|string $actIntNum):void 
	{
			self::$fileFragmentsTotNum = $actIntNum + 0;
	}
	
 function enableBootstrap():void
 {
 }
 	
	function isStandard():bool 
	{
		return true;
	}
	
	function serialize():void 
	{
	  parent::serialize();
		$serializer = $this->getSerializer ();
		$fileName = $this->getFileName ();
		$item1 = array (
				"fileName" => $fileName 
		);
		$serializer->loadItems ( $item1 );
	}
	
	function getFileName():string
	{
		return $this->fileName;
	}
	
	function setFileName(string $actFileName):void
	{
		$this->fileName = $actFileName;
	}
	
	function isDecorator():bool 
	{
		return false;
	}
	
	function isContainer():bool
	{
		return false;
	}
	
	function loadFragment():string
	{
		$fileName = $this->getFileName ();
		$handle = fopen ( $fileName, "rb" );
		$fragment = fread ( $handle, filesize ( $fileName ) );
		fclose ( $handle );
		return $fragment;
	}
	
	function putData():void 
	{
		$htmlWriter = $this->getHtmlWriter ();
		$cssClass = $this->getCssClass ();
		$htmlFragment = $this->loadFragment ();
		$id = $this->getInterfaceId ();
		$htmlWriter->putDivOpenTag ( $id, STRING_NULL, $cssClass );
		$htmlWriter->putGenericHtmlString ( $htmlFragment );
		$htmlWriter->putGenericHtmlString ( DIV_CLOSE_TAG );
	}
}

?>