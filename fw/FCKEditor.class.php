<?
namespace Cheope_ns\fw;
require_once("fckeditor.fun.php");
require_once("Html_formatted_interface.class.php");

class FCKEditor extends Html_formatted_interface
{
 const DEFAULT_BASEPATH="../FCKEditor/editor";
 const DEFAULT_WIDTH="100%";
 const DEFAULT_HEIGHT="200";
 const DEFAULT_TOOLBARSET="Default";
 const ERROR_1="FCKEditor:Errore creando htmlWriter object";

 private $basePath=STRING_NULL;
 private $width=STRING_NULL;
 private $height=STRING_NULL;
 private $toolbarSet=STRING_NULL;
 private $value=STRING_NULL;
 private $config = array();
 static private $fckEditorsTotNum=0;

 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$fckEditorsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$fckEditorsTotNum - 1; 
  parent::__construct($actOp,Interfaces_info::INT_FCKEDITOR,$actNum);
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$fckEditorsTotNum;
 }
 
 function isStandard():bool
 {
 	return false;
 }
 
 function enableBootstrap():void
 {
 }
 
 function getBasePath():string
 {
 	if($this->basePath==STRING_NULL)
 	 return self::DEFAULT_BASEPATH;
 	else
 	 return $this->basePath;
 }

 function setBasePath(string $actBasePath):void
 {
 	$this->basePath = $actBasePath;
 }
 
 function setWidth(string $actWidth):void
 {
 	$this->width = $actWidth;
 }
 
 function getWidth():string
 {
 	if($this->width==STRING_NULL)
 	 return self::DEFAULT_WIDTH;
 	else
 	 return $this->width;
 }
 
 function setHeight(string $actHeight):void
 {
 	$this->height = $actHeight;
 }
 
 function getHeight():string
 {
 	if($this->height==STRING_NULL)
 	 return self::DEFAULT_HEIGHT;
 	else
 	 return $this->height;
 }
 
 function getToolbarSet():string
 {
 	if($this->toolbarSet==STRING_NULL)
 	 return self::DEFAULT_TOOLBARSET;
 	else
 	 return $this->toolbarSet;
 }
 
 function setToolbarSet(string $actToolbarSet):void
 {
 	$this->toolbarSet = $actToolbarSet;
 }
 
 function getValue():string
 {
 	return $this->value;
 }
 
 function setValue(string $actValue):void
 {
 	$this->value = $actValue;
 }
 
 function setConfig(array $actConfig):void
 {
 	$this->config = $actConfig;
 }
 
 function getConfig():array
 {
 	return $this->config;
 }
 
	function isDecorator():bool
	{
		return false;
	}
	
 	function isContainer():bool
	{
		return false;
	}
 
 	function putData():void
	{
		$htmlWriter = $this->getHtmlWriter();
		$htmlWriter->putGenericHtmlString($this->createHtml());
	} 
 
	function createHtml():string
	{
		$value = $this->getValue();
		$basePath = $this->getBasePath();
		$instanceName = $this->getInterfaceId();
		$width = $this->getWidth();
		$height = $this->getHeight();
		$toolbarSet = $this->getToolbarSet();
		
		$htmlValue = htmlspecialchars( $value ) ;
     
		$html = STRING_NULL ;

		if ( !isset( $_GET ) ) {
			global $HTTP_GET_VARS ;
			$_GET = $HTTP_GET_VARS ;
		}

		if ( $this->IsCompatible() )
		{
			if ( isset( $_GET['fcksource'] ) && $_GET['fcksource'] == "true" )
				$file = 'fckeditor.original.html' ;
			else
				$file = 'fckeditor.html' ;

       
//       $link = "/php/Scripts/Cheope/editor" . STRING_SLASH . "{$file}?InstanceName={$instanceName}" ;
			 $link = "{$basePath}" . STRING_SLASH . "{$file}?InstanceName={$instanceName}" ;
		//	 die($link);

			if ( $toolbarSet != '' )
				$link .= "&amp;Toolbar={$toolbarSet}" ;

			// Render the linked hidden field.
			$html .= "<input type=\"hidden\" id=\"{$instanceName}\" name=\"{$instanceName}\" value=\"{$htmlValue}\" style=\"display:none\" />" ;

			// Render the configurations hidden field.
			$html .= "<input type=\"hidden\" id=\"{$instanceName}___Config\" value=\"" . $this->GetConfigFieldString() . "\" style=\"display:none\" />" ;

			// Render the editor IFRAME.
			$html .= "<iframe id=\"{$instanceName}___Frame\" src=\"{$link}\" width=\"{$width}\" height=\"{$height}\" frameborder=\"0\" scrolling=\"no\"></iframe>" ;
		}
		else
		{
			if ( strpos( $w, STRING_PERCENT ) === false )
				$widthCSS = $width . 'px' ;
			else
				$widthCSS = $width ;

			if ( strpos( $height, STRING_PERCENT ) === false )
				$heightCSS = $height . 'px' ;
			else
				$heightCSS = $height ;

			$html .= "<textarea name=\"{$instanceName}\" rows=\"4\" cols=\"40\" style=\"width: {$widthCSS}; height: {$heightCSS}\">{$htmlValue}</textarea>" ;
		}
		return $html ;
	}

	function IsCompatible():bool
	{
	if ( isset( $_SERVER ) ) {
		$sAgent = $_SERVER['HTTP_USER_AGENT'] ;
	}
	else {
		global $HTTP_SERVER_VARS ;
		if ( isset( $HTTP_SERVER_VARS ) ) {
			$sAgent = $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ;
		}
		else {
			global $HTTP_USER_AGENT ;
			$sAgent = $HTTP_USER_AGENT ;
		}
	}

	if ( strpos($sAgent, 'MSIE') !== false && strpos($sAgent, 'mac') === false && strpos($sAgent, 'Opera') === false )
	{
		$iVersion = (float)substr($sAgent, strpos($sAgent, 'MSIE') + 5, 3) ;
		return ($iVersion >= 5.5) ;
	}
	else if ( strpos($sAgent, 'Gecko/') !== false )
	{
		$iVersion = (int)substr($sAgent, strpos($sAgent, 'Gecko/') + 6, 8) ;
		return ($iVersion >= 20030210) ;
	}
	else if ( strpos($sAgent, 'Opera/') !== false )
	{
		$fVersion = (float)substr($sAgent, strpos($sAgent, 'Opera/') + 6, 4) ;
		return ($fVersion >= 9.5) ;
	}
	else if ( preg_match( "|AppleWebKit/(\d+)|i", $sAgent, $matches ) )
	{
		$iVersion = $matches[1] ;
		return ( $matches[1] >= 522 ) ;
	}
	else
		return false ;
 }

	function GetConfigFieldString():string
	{
		$sParams = STRING_NULL ;
		$bFirst = true ;
    $config = $this->getConfig();
    
		foreach ( $config as $sKey => $sValue )
		{
			if ( $bFirst == false )
				$sParams .= '&amp;' ;
			else
				$bFirst = false ;

			if ( $sValue === true )
				$sParams .= $this->EncodeConfig( $sKey ) . '=true' ;
			else if ( $sValue === false )
				$sParams .= $this->EncodeConfig( $sKey ) . '=false' ;
			else
				$sParams .= $this->EncodeConfig( $sKey ) . '=' . $this->EncodeConfig( $sValue ) ;
		}

		return $sParams ;
	}
	
	function EncodeConfig( string $valueToEncode ):string
	{
		$chars = array(
			STRING_AMPERSEND => '%26',
			STRING_EQUAL => '%3D',
			STRING_DOUBLE_QUOTE => '%22' ) ;

		return strtr( $valueToEncode,  $chars ) ;
	}

}

?>