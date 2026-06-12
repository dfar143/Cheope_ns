<?
namespace Cheope_ns\fw;
require_once("Dumper.class.php");

class File_dumper extends Dumper
{
 const ERROR_1 = "File_dumper:Errore in file open type settings.";
 const OPEN_FILE_FOR_APPEND = "a";
 const OPEN_FILE_FOR_OVERWRITE = "w";
 const DEFAULT_ENVELOPE = "Php_file";
 const DEFAULT_FILE_BUFFER_NAME = "Buffer.txt";
 const DEFAULT_FILE_OPEN_TYPE = self::OPEN_FILE_FOR_OVERWRITE;
	
 private $fileName = self::DEFAULT_FILE_BUFFER_NAME;
 private $fileOpenType = self::DEFAULT_FILE_OPEN_TYPE;
 private $envelope = self::DEFAULT_ENVELOPE;
 private $openingChar = PHP_OPEN_TAG . STRING_RETURN . STRING_LINE_FEED;
 private $closingChar = PHP_CLOSE_TAG;
 
 function __construct(Stringable $actObj)
 {
  parent::__construct($actObj);
 }
 
 function setOpeningChar(string $actOpeningChar):void
 {
 	$this->openingChar = $actOpeningChar;
 }
 
 function getOpeningChar():string
 {
 	return $this->openingChar;
 }
 
 function setClosingChar(string $actClosingChar):void
 {
 	$this->closingChar = $actClosingChar;
 }
 
 function getClosingChar():string
 {
 	return $this->closingChar;
 }
 
 function setFileName(string $actFileName):void
 {
 	$this->fileName = $actFileName;
 }
 
 function getFileName():string
 {
 	return $this->fileName;
 }
 
 function getFileOpenType():string
 {
 	return $this->fileOpenType;
 }
 
 function setFileOpenType(string $actFileOpenType):void
 {
 	if (in_array($actFileOpenType,array(self::OPEN_FILE_FOR_OVERWRITE,
 	self::OPEN_FILE_FOR_APPEND))) 
 	 $this->fileOpenType = $actFileOpenType;
  else
   die(self::ERROR_1);
 }
 
 function setEnvelope(string $actEnvelope):void
 {
 	$this->envelope = $actEnvelope;
 	$openingChar = $this->getOpeningChar();
 	$closingChar = $this->getClosingChar();
  switch ($this->$envelope)
  {
  	case self::DEFAULT_ENVELOPE:
  	{
  	 $openingChar = PHP_OPEN_TAG . STRING_RETURN . STRING_LINE_FEED;
  	 $closingChar = PHP_CLOSE_TAG;
  	} 
  } 
  $this->setOpeningChar($openingChar);
  $this->setClosingChar($closingChar);
 }
 
 function getEnvelope():string
 {
 	return $this->envelope;
 }
 
 function dump():string
 {
 	$fileName = $this->getFileName();
  $obj = $this->getObj();
  $fileOpenType = $this->getFileOpenType();
  $handle = fopen($fileName,$fileOpenType);
  $openingChar = $this->getOpeningChar();
  $closingChar = $this->getClosingChar();
  $str = $obj->toString();
  fwrite($handle,$openingChar);
  fwrite($handle,$str);
  fwrite($handle,$closingChar);
  fclose($handle);
  return STRING_NULL;
 }

}

?>