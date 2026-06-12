<?
namespace Cheope_ns\fw;
require_once("cheope_ns.const.php");
require_once("class.const.php");
require_once("db.const.php");
require_once("dyn_page_loader.def.php");
require_once("Parser.class.php");
require_once("Dyn_page_comp_handler.class.php");
require_once("Xml_interface_serializer.class.php");
require_once("cheope_ns_interfaces_requires.def.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("Creator.tra.php");

define('CHEOPE_NS_DYN_PAGE_LOADER_ERROR_1',"Impostare il nome del file.");

class Cheope_ns_dyn_page_loader extends Html_formatted_interface
{
	use Creator;
	
	const CHEOPE_NS_DYN_PAGE_LOADER_ERROR_1="dyn_page_loader:Errore impostare il nome del file.";
	
	private $fileName=STRING_NULL;
	private $parser=null;
	private $grRules=null;
	private $rules=null;
	
	function __construct(string $actOp=STRING_NULL,$actNum=STRING_NULL)
	{
		global $dynPageLoaderDefGrRules;
		global $dynPageLoaderDefRules;
		
		parent::__construct($actOp,self::INT_DYN_PAGE_LOADER,$actNum=0);
    $this->setGrRules($dynPageLoaderDefGrRules);
    $this->setRules($dynPageLoaderDefRules);
	}
	
 static function createXmlInterfaceSerializer():Xml_interface_serializer
 {
 	 return Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,STRING_NULL);
 }
	
 function isStandard():bool
 {
 	return false;
 }
 
  function enableBootstrap():void
  {
  }
	
	function setFileName(string $actFileName):void
	{
		$this->fileName = $actFileName;
	}
	
	function getFileName():string
	{
		return $this->fileName;
	}
	
	function setGrRules(Parser_grammar_rules_container $actGrRules):void
	{
		$this->grRules = $actGrRules;
	}
	
	function getGrRules():Parser_grammar_rules_container
	{
		return $this->grRules;
	}
	
	function setRules(Lex_rules_container $actRules):void
	{
		$this->rules = $actRules;
	}
	
	function getRules():Lex_rules_container
	{
		return $this->rules;
	}
	
	function setParser(Parser $actParser):void
	{
		$this->parser = $actParser;
	}
	
	function getParser():Parser
	{
		return $this->parser;
	}
	
	static function createDynPageCompHandler(string $actStr):Dyn_page_comp_handler
	{
		return Creator::create(getClassNameForCreate(Classes_info::DYN_PAGE_COMP_HANDLER_CLASS),STRING_NULL,$actStr);
	}
	
	//
	//Factory method
	function createParser(Lexer_3 $actLex):Parser
	{
		return Creator::create(getClassNameForCreate(Classes_info::PARSER_CLASS),STRING_NULL,$actLex);
	}

	//
	//Factory method	
	function createLexer(string $actFileName):Lexer_3
	{
		return Creator::create(getClassNameForCreate(Classes_info::LEXER_3_CLASS),STRING_NULL,$actFileName);
	}
	
  function isContainer():bool
  {
   return false;
  }
  
  function isDecorator():bool
  {
   return false;
  }
	
	function exec():void
	{
	 $grRules = $this->getGrRules();
	 $rules = $this->getRules();
	 $fileName = $this->getFileName();
   // die($fileName);	
	if($fileName != STRING_NULL)
	 {
    $lex = $this->createLexer($fileName);
    //$lex->setLogFileName("log.txt");
    $lex->init();
    $lex->setRules($rules);
    $parser = $this->createParser($lex);
    //$parser->setLogFileName("log.txt");
    $this->setParser($parser);
    $parser->setGrammarRulesContainer($grRules);
    $grRule = $grRules->getElement(0);
    $grRule->init();
    if(! $parser->exec())
	   echo $parser->getCurrentError();	   
   }
   else
    die(self::CHEOPE_NS_DYN_PAGE_LOADER_ERROR_1);
  }
 
 function putData():void
 {
 	global $interfacesContainer;
 	global $dbStructTree;
 	global $dbQueriesContainer;
 	
 	$this->exec();
 	
 	$dir = STRING_POINT . DIR_SEP . XML_SUFFIX;
 	$interfacesDir = STRING_POINT . DIR_SEP . INTERFACES_DIR;
  $appName = ucFirst(APPLICATION_NAME); 
 	$fileName = $this->getFileName();
 	$pageNames = explode(FILE_NAME_ELEMENTS_SEP,$fileName);
 	$pageName = $pageNames[0];
 	$parser = $this->getParser();
	$grRules = $parser->getGrammarRulesContainer();
	$grRule = $grRules->getElement(0);
  $texts = $grRule->getTexts();
  $execString = "namespace " . APPLICATION_NAME . STRING_BACKSLASH . FRAMEWORK_ACRONYM . STRING_SEMICOLON;
  //$execString .= "require_once('./fw/Html_button_tag.class.php');";
  $execString .= "\$htmlWriter=\$this->getHtmlWriter();";
  //die($execString);
  $dynPageCompHandler = self::createDynPageCompHandler(STRING_NULL);
  foreach($texts as $text)
  {
   $attr = $text->getAttribute();
   if($attr==DYN_PAGE_LOADER_TOKEN_ATTR_HTML_TEXT)
	   $execString = $execString . 
	   STRING_RETURN . STRING_LINE_FEED . "\$htmlWriter->putGenericHtmlString('" . $text->getLexema() . "');";
	 elseif($attr==DYN_PAGE_LOADER_TOKEN_ATTR_PHP_CODE)
	   $execString = $execString . 
	   STRING_RETURN . STRING_LINE_FEED . $text->getLexema();
	 elseif($attr==DYN_PAGE_LOADER_TOKEN_ATTR_HTML_TAG)
	   $execString = $execString . 
	   STRING_RETURN . STRING_LINE_FEED . "\$htmlWriter->putGenericHtmlString('" . $text->getLexema() . "');";
   elseif($attr==DYN_PAGE_LOADER_TOKEN_ATTR_COMP_CODE)
   {
   	 $dynPageCompHandler->setItemStr($text->getLexema());
   	 $dynPageCompHandler->setAppName($appName);
   	 $dynPageCompHandler->setPageName($pageName);
   	 $dynPageCompHandler->setDir($dir);
   	 $dynPageCompHandler->setInterfacesDir($interfacesDir);
   	 $dynPageCompHandler->setInterpolateConsts(true);
   	 $str = $dynPageCompHandler->exec();
   	 $xmlEmbeds = $dynPageCompHandler->getXmlEmbeds();
	   $execString = $execString . 
	   STRING_RETURN . STRING_LINE_FEED . $str ;
   }
  }
  unset($dir);
  unset($appName);
  unset($fileName);
  unset($pageNames);
  unset($pageName);
  unset($parser);
  unset($grRules);
  unset($grRule);
  unset($texts);
  unset($text);
  unset($attr);
  unset($str);
  eval($execString);

 }  
}


?>