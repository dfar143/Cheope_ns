<?
namespace Cheope_ns\fw;
require_once("generic.fun.php");

define(__NAMESPACE__ . '\UPLOADED_FILE_ERROR_1','Il file ha dimensione nulla.');
define(__NAMESPACE__ . '\UPLOADED_FILE_ERROR_2','Il file non è del tipo richiesto.');
define(__NAMESPACE__ . '\UPLOADED_FILE_ERROR_3','La lunghezza del file è superiore a quella massima.');

define(__NAMESPACE__ . '\MIME_TYPE_TEXT_PLAIN',"text/plain");
define(__NAMESPACE__ . '\MIME_TYPE_EXCEL_CSV', "application/vnd.ms-excel");
define(__NAMESPACE__ . '\MIME_TYPE_OCTET_STREAM',"application/octet-stream");

class Uploaded_file_manager 
{
 const ERROR_1 = UPLOADED_FILE_ERROR_1;
 const ERROR_2 = UPLOADED_FILE_ERROR_2;
 const ERROR_3 = UPLOADED_FILE_ERROR_3;
 const DEFAULT_FIELD = "File";	
	
 var $fileInfo = array();
 var $fileDest = STRING_NULL;
 var $fieldName = self::DEFAULT_FIELD;
	
	function __construct(array $fileInfo)
	{
		$this->setFileInfo($fileInfo);
	}
	
	function setFieldName(string $actFieldName):void
	{
		$this->fieldName = $actFieldName;
	}
	
	function getFieldName():string
	{
		return $this->fieldName;
	}
	
	function setFileInfo(array $actFileInfo):void
	{
		$this->fileInfo = $actFileInfo;
	}
	
	function getFileInfo():array
	{
		return $this->fileInfo;
	}
	
	function getFileError():string|int
	{
		$fileInfo = $this->getFileInfo();
		$fieldName = $this->getFieldName();
		if(isset($fileInfo[$fieldName]))
		 return $fileInfo[$fieldName]['error'];
		else
		 return 0;
	}
	
	function getFileSize():string|int
	{
		$fileInfo = $this->getFileInfo();
		$fieldName = $this->getFieldName();
		if(isset($fileInfo[$fieldName]))
		 return $fileInfo[$fieldName]['size'];
		else
		 return 0;
	}
	
	function getFileType():string
	{
		$fileInfo = $this->getFileInfo();
		$fieldName = $this->getFieldName();
		if(isset($fileInfo[$fieldName]))
		 return $fileInfo[$fieldName]['type'];
		else
		 return STRING_NULL;
	}
	
	function getFileName():string
	{
		$fileInfo = $this->getFileInfo();
		$fieldName = $this->getFieldName();
		if(isset($fileInfo[$fieldName]['name']))
		 return $fileInfo[$fieldName]['name'];
    else
     return STRING_NULL;
  }
  
  function getTmpFileName():string
  {
		$fileInfo = $this->getFileInfo();
		$fieldName = $this->getFieldName();
		if(isset($fileInfo[$fieldName]['tmp_name']))
		 return $fileInfo[$fieldName]['tmp_name'];
    else
     return STRING_NULL;
  }
	
	function setFileDest(string $actFileDest):void
	{
		$this->fileDest = $actFileDest;
	}
	
	function getFileDest():string
	{
		return $this->fileDest;
	}
	
	function testGoodUpload(string $actFileType,
	int $actMaxFileSize,string &$actError):bool
	{
		$fileError = $this->getFileError();
		$fileSize = $this->getFileSize();
		$fileType = $this->getFileType();

		if($fileError !== 0)
		{
			$actError="Errore:" . $fileError;
			return false;
		}
		if($fileSize == 0)
		{
			$actError="Errore:" . self::ERROR_1;
			return false;			
	  }
	  if($fileSize > $actMaxFileSize)
	  {
	  	$actError = "Errore:" . self::ERROR_3;
	  	return false;
	  }
	  if(($fileType !== $actFileType)&&($actFileType !== MIME_TYPE_OCTET_STREAM))
	  {
	  	$actError = "Errore:" . self::ERROR_2;
	  	return false;
	  }
	  return true;
	}
	
	
}


?>