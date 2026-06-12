<?
namespace Cheope_ns\fw;
require_once("Html_interface_decorator.class.php");

class Html_fieldset_decorator extends Html_interface_decorator
{
 const ERROR_1="Html_fieldset_decorator:Errore nell'inserimento dell'interfaccia.";

	function __construct(Html_formatted_interface $actObj=null,
	string $actOp=STRING_NULL,$actNum=STRING_NULL)
	{
	 parent::__construct($actObj,$actOp,$actNum);
	 $this->setDecoratorName("fieldset");
	}
	
 function putJavascriptInitializationCode(string $actPar):void
 {
 }
	
	function preDec():void
	{
 	 $htmlWriter = $this->getHtmlWriter();
	 $decObj = $this->getDecoratedObj();
	 $dispFields = $decObj->getDispFields();
	 $header=STRING_NULL;
	 if (isset($dispFields[0]))
	  $header = $dispFields[0];
	 $intCode = $this->getInterfaceId();
	 $class = $this->getCssClass();
	 $style = $this->getStyle();
	 $htmlWriter->putDivOpenTag($intCode,$style,$class);
	 $htmlWriter->putFieldsetOpenTag();
   $htmlWriter->putGenericHtmlString(LEGEND_OPEN_TAG,0);
   if ($header != STRING_NULL)
    $htmlWriter->putGenericHtmlString($header,0);
   $htmlWriter->putGenericHtmlString(LEGEND_CLOSE_TAG,0);
	}
	
	function postDec():void
	{
	 $htmlWriter = $this->getHtmlWriter();
	 $htmlWriter->putGenericHtmlString(FIELDSET_CLOSE_TAG,0);
	 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);			
	}
}


?>