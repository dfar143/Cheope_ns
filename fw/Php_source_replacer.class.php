<?
namespace Cheope_ns\fw;

 class Php_source_replacer
 { 
 	const DEFAULT_MODE_1 = "F";
 	const DEFAULT_MODE_2 = "S";
 	const REPLACE_TYPE_1 = "NotString";
 	const REPLACE_TYPE_2 = "String";
 	const DEFAULT_OUTPUT_FILE = "Output.php";
 	const ERROR_1 = "Php_source_replacer:Errore nell'assegnazione modo.";
 	const ERROR_2 = "Php_source_replacer:Errore nell'assegnazione tipo di replace.";
 	
 	private $fileName = STRING_NULL;
 	private $outPutFile = self::DEFAULT_OUTPUT_FILE;
 	private $sourceStr = STRING_NULL;
 	private $findStr = STRING_NULL;
 	private $replaceStr = STRING_NULL;
 	private $dir = STRING_NULL;
 	private $mode = self::DEFAULT_MODE_1;
 	private $replaceType = self::REPLACE_TYPE_1;
 	  	
 	function __construct(string $actStr=STRING_NULL,string $actMode=self::DEFAULT_MODE_1)
 	{
 		if($actMode == self::DEFAULT_MODE_1)
 		{
 		 $this->setFileName($actStr);	
 		}
 		elseif($actMode == self::DEFAULT_MODE_2)
 		{
 			$this->setSourceStr($actStr);
 		}
 		else
 		{
 			$this->setFileName($actStr);
 		}
 	}
 	
 	function setOutputFile(string $actOutputFile):void
 	{
 		$this->outputFile = $actOutputFile;
 	}
 	
 	function getOutputFile():string
 	{
 	 if($this->outPutFile == STRING_NULL)
 	  return self::DEFAULT_ENABLE_EXECUTE_AT_ONCE;
 	 else
 		return $this->outPutFile;
 	}
 	
 	function setReplaceType(string $actReplaceType):void
 	{
 		if(($actReplaceType !== self::REPLACE_TYPE_1) && 
 		($actReplaceType !== self::REPLACE_TYPE_2))
 		{
 		 $this->replaceType = $actReplaceType;
    }
    else
     die(self::ERROR_2);
 	}
 	
 	function getReplaceType():string
 	{
 		return $this->replaceType;
 	}
 	
 	function getDir():string
 	{
 		return $this->dir;
 	}
 	
 	function setDir(string $actDir):void
 	{
 		$this->dir = $actDir;
 	}
 	
 	function setFileName(string $actFileName):void
 	{
 		$this->fileName = $actFileName;
  }
  
  function getFileName():string
  {
  	return $this->fileName;
  }
  
	function setSourceStr(string $actSourceStr):void
 	{
 		$this->sourceStr = $actSourceStr;
  }
  
  function getSourceStr():string
  {
  	return $this->sourceStr;
  }  
 	
 	function setFindStr(string $actFindStr):void
 	{
 		$this->findStr = $actFindStr;
 	}
 	
 	function getFindStr():string
 	{
 		return $this->findStr;
 	}
 	
 	function setReplaceStr(string $actReplaceStr):void
 	{
 		$this->replaceStr = $actReplaceStr;
 	}
 	
 	function getReplaceStr():string
 	{
 		return $this->replaceStr;
 	}
 	
 	function setMode(string $actMode):void
 	{
 		if(($actMode !== self::DEFAULT_MODE_1) && ($actMode !== self::DEFAULT_MODE_2))
 		{
 		 $this->mode = $actMode;
    }
    else
     die(self::ERROR_1);
  }  
 	
 	function getMode():string
 	{
 		return $this->mode;
 	}
 		 	
 	function exec():bool|string
 	{
 	 $mode = $this->getMode();
 	 $findStr = $this->getFindStr();
 	 $replaceStr = $this->getReplaceStr();
 	 if($mode == self::DEFAULT_MODE_1)
 	 {
 	 	$fileName = $this->getFileName();
	  $outputFile = $this->getOutputFile();
    $dir = $this->getDir();
	  $path = (($dir != STRING_NULL)?($dir . DIR_SEP . $fileName):($fileName));
	  $sourceStr = file_get_contents($path);
 	 	$tokenArray = token_get_all($sourceStr);
 	 	$path2 = (($dir != STRING_NULL)?($dir . DIR_SEP . $outputFile):($outputFile));
 	 	$handle = fopen($path2,"w");
 	 	foreach($tokenArray as $ind=>$tokenVal)
 	 	{
 	 		$tokenName = token_name($tokenVal);
 	 		if(($tokenName !== T_STRING)&&($type == REPLACE_TYPE_1))
 	 		{
 	 		 $newTokenVal = str_replace($findStr,$replaceStr,$tokenVal);
 	 		}
 	 		else(($tokenName == T_STRING)&&($type == REPLACE_TYPE_2))
 	 		{
 	     $newTokenVal = str_replace($findStr,$replaceStr,$tokenVal);			
 	 		}
 	 		else
 	 		 $newTokenVal = $tokenVal;
 	 		fwrite($handle,$newTokenVal);
 	 	}
 	 	fclose($handle);
 	 	return true;
 	 }
 	 elseif($mode == self::DEFAULT_MODE_2)
 	 {
 	 	$sourceStr = $this->getSourceStr();
 	 	$outputFile = $this->getOutputFile();
    $dir = $this->getDir();
    $newToken = STRING_NULL;
	  $path = (($dir != STRING_NULL)?($dir . DIR_SEP . $outputFile):($outputFile));
    $tokenArray = token_get_all($sourceStr);
	 	foreach($tokenArray as $ind=>$tokenVal)
 	 	{
 	 		$tokenName = token_name($tokenVal);
 	 		if(($tokenName !== T_STRING)&&($type == REPLACE_TYPE_1))
 	 		{
 	 		 $newTokenVal = str_replace($findStr,$replaceStr,$tokenVal);
 	 		}
 	 		else(($tokenName == T_STRING)&&($type == REPLACE_TYPE_2))
 	 		{
 	     $newTokenVal = str_replace($findStr,$replaceStr,$tokenVal);			
 	 		}
 	 		else
 	 		 $newTokenVal = $tokenVal;
 	 		$newToken .= $newTokenVal;
 	 	} 
 	 	return $newToken;    	  	
 	 }
 	}
 }
 
?>