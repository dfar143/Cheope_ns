<?
namespace Cheope_ns\fw;
require_once("generic.const.php");

class Token
{
// 
// Vengono usate in altri contesti
//	
	
 const TYPE_RESERVED_WORD="Reserved_word";
 const TYPE_LEXICAL_ELEMENT="Lexical_element";
 const TYPE_SPECIAL_ITEM="Special_item";
 const TYPE_DELIM="Delim";
 const VAL_SUFFIX="VAL";
 const TYPE_SUFFIX="TYPE";

 private $type=STRING_NULL;
 private $val;
 private $attribute=STRING_NULL;
 private $lexema=STRING_NULL;
 
 function __construct(string $actType=STRING_NULL,$actVal=STRING_NULL)
 {
 	$this->type = $actType;
 	$this->val = $actVal;
 }
 
 function setLexema(string $actLexema):void
 {
 	$this->lexema = $actLexema;
 }
 
 function getLexema():string
 {
 	return $this->lexema;
 }
 
 function setType(string $actType):void
 {
 	$this->type = $actType;
 }
 
 function getType():string
 {
 	return $this->type;
 }
 
 function setVal(string $actVal):void
 {
 	$this->val = $actVal;
 }
 
 function getVal():string
 {
 	return $this->val;
 }
 
 function setAttribute(string $actAttr):void
 {
 	$this->attribute = $actAttr;
 }
 
 function getAttribute():string
 {
 	return $this->attribute;
 }
 
}

?>