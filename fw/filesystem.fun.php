<?
namespace Cheope_ns\fw;
require_once("filesystem.const.php");
require_once("filesystem.def.php");
require_once("generic.fun.php");

 function isXml(string $actFile):bool
 {
 	if(file_exists($actFile))
 	{
 		$fileContent = file_get_contents($actFile);
 		if(preg_match("/\<\?xml version\=\"1.0\"\?\>/",$fileContent))
 		 return true;
 		else
 		 return false;
 	}
 	else
 	 return false;
 }

 function scanForItem(string $actPath,$actItem):bool
 {
 	try
  {
  	$content = file_get_contents($actPath);
  	if(! strpos($content,$actItem))
  	 return false;
  	return true;
  }
  catch(\Exception $e)
  {
  	throw $e;
  }
 }

function getOnlyFilesNames(string $actDir,array $dirContents):array
{
	$fileNames = array();
	$i=0;
	foreach($dirContents as $dirContent)
	 if ((file_exists($actDir . DIR_SEP . $dirContent))&&
	 (! is_dir($actDir . DIR_SEP . $dirContent)))
	 {
	 	$fileNames[$i++] = $dirContent;
	 } 
	return $fileNames;
}

function getPath(string $actFileName):string
{
 $fileNameItems = explode(DIR_SEP,$actFileName);
 $actPath = $fileNameItems[0];
 $num = count($fileNameItems);
 for($i=1;$i<=$num-2;$i++)
  $actPath = $actPath . DIR_SEP . $fileNameItems[$i];
 return $actPath;
}

function replace_words_in_file_name_of_dir(string $actDir,
array $actWords,array $actReplacingStrs):bool
{
 $files = getOnlyFilesNames($actDir,scandir($actDir));
 $num = count($actWords);
 $words=$actWords;
 /*for($i=0;$i<=$num-1;$i++)
 {
  $words[$i] = array($actWords[$i]);
 }*/
 foreach($files as $fileName)
 {
 	$res = true;
  $completeFileName = $actDir . DIR_SEP . $fileName;
  for($i=0;$i<=$num-1;$i++)
  {
   if(file_exists($completeFileName))
    $res = $res && replace_in_file_name($completeFileName,
    $words[$i],$actReplacingStrs[$i]); 
 	}
 	if (! $res)
 	{	
 	//	 echo "-XXX-";
 	 return false;
  }
 }
 return true;
}

function replace_words_in_files_of_dir(string $actDir,
array $actWords,array $actReplacingStrs):bool
{
 $files = getOnlyFilesNames($actDir,scandir($actDir));
 $num = count($actWords);
 $words = $actWords;
 /*for($i=0;$i<=$num-1;$i++)
 {
  $words[$i] = array($actWords[$i]);
 }*/
 foreach($files as $fileName)
 {
 	$res = true;
	$fileNameItems = explode(FILE_NAME_ELEMENTS_SEP,$fileName);
	if(($fileNameItems[count($fileNameItems)-1] == PHP_ACRONYM)||($fileNameItems[count($fileNameItems)-1] == XML_ACRONYM))
  for($i=0;$i<=$num-1;$i++)
   $res = $res && replace_in_file_content($actDir . DIR_SEP . $fileName,
   $words[$i],$actReplacingStrs[$i]); 
 	if (! $res)
 	{
 		return false;
 	}
 }
 return true;
}

function replace_in_file_name(string $actFileName,
string $actItems,string $actReplacingStr):bool
{
	$filePathItems = explode(DIR_SEP,$actFileName);
	$filePath = getPath($actFileName);
	$fileName = $filePathItems[count($filePathItems)-1];
	$newFileName = str_replace($actItems,$actReplacingStr,$fileName);
	$oldFileName = $actFileName;
	$actFileName = $filePath . DIR_SEP . $newFileName;
	try
	{
		if($oldFileName !== ($filePath . DIR_SEP . $newFileName))
		{
	   $res = rename($oldFileName,$filePath . DIR_SEP . $newFileName);
	  // echo "-";
	  }
	  else
	  {
	  // echo "*";
	  // echo $newFileName;
	   $res = true;
	  }
	  return $res;
  }
  catch(\Exception $e)
  {
  	// echo "ERROR";
  	throw $e;
  }
}

function replace_in_file_content(string $actFileName,
string $actItem,string $actReplacingStr):bool
{	
 $fileContents = array();
 try
 {
  if(!($fileContents = file($actFileName)))
   return false;
  if(!($dataFileHandle = fopen($actFileName,"wb")))
   return false;
  $fileContents = str_replace($actItem,$actReplacingStr,$fileContents);
  foreach($fileContents as $fileLine)
   fwrite($dataFileHandle,$fileLine);
  fclose($dataFileHandle);
  return true;
 }
 catch(\Exception $e)
 {
 	throw $e;
 }
}

function array_replace_in_file_content(string $actFileName,
array $actItems,string|array $actReplacingStrs):bool
{	
 $fileContents = array();
 try
 {
  if(!($fileContents = file($actFileName)))
   return false;
  if(!($dataFileHandle = fopen($actFileName,"wb")))
   return false;
  $fileContents = str_replace($actItems,$actReplacingStrs,$fileContents);
  foreach($fileContents as $fileLine)
   fwrite($dataFileHandle,$fileLine);
  fclose($dataFileHandle);
  return true;
 }
 catch(\Exception $e)
 {
 	throw $e;
 }
}


function copy_all_files_to_dir(string $actSourceDir,string $actDestDir,array $actFiles):bool
{
	try
	{
	if($actFiles==STRING_STAR)
	{
   $actFiles = scandir($actSourceDir);	
   $actFiles = array_deleteItem($actFiles,THIS_DIR);
   $actFiles = array_deleteItem($actFiles,PREVIOUS_DIR);
	}
	foreach($actFiles as $file)
	{
	 $completeSourceFileName = $actSourceDir . DIR_SEP . $file;
	 if((file_exists($completeSourceFileName)) && (! is_dir($completeSourceFileName)))
	 {
	   if(! copy($completeSourceFileName,$actDestDir . DIR_SEP . $file))
     {
   	  echo $actSourceDir . DIR_SEP . $file;
   	  return false;
     }
   }
   else
   {
   	$sourceDirName = $actSourceDir . DIR_SEP . $file;
   	$destDirName = $actDestDir . DIR_SEP . $file;
   	if(make_dir($destDirName))
   	{
   		$subDirFiles = scandir($sourceDirName,1);
   		//Elimina . e ..
   		//
   		array_pop($subDirFiles);
   		array_pop($subDirFiles);
   		copy_all_files_to_dir($sourceDirName,$destDirName,$subDirFiles);
   	}
   	else
   	 return false; 
   } 
  }
  return true;
 }
 catch(\Exception $e)
 {
 	throw $e;
 }
}


function make_dir(string $actDir):bool
{
 try
 {
  if(! is_dir($actDir))
   return mkdir($actDir);
  return true;
 }
 catch(\Exception $e)
 {
 	throw $e;  
 }
}


function is_file_void(string $actFileName):bool
{
	try
	{
	if(is_file($actFileName))
	{
	 $content = file_get_contents($actFileName, FILE_USE_INCLUDE_PATH);
	 $newContent = preg_replace("/\s*/",STRING_NULL,$content);
	 if(strlen($newContent)==0)
	  return true;
	 else
	  return false;
  }
  return false;
 }
 catch(\Exception $e)
 {
 	throw $e;
 }

}

?>