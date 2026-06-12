<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("Xml_serializer.class.php");
require_once("filesystem.fun.php");


date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"export");
define('THIS_PAGE',"export.php");


class Cheope_ns_export_op_page extends Cheope_ns_page
{
 
 const NOME_FILE_XML_ANALISI = "analisi_composizione_applicazione" . FILE_NAME_ELEMENTS_SEP . XML_ACRONYM;
 const NOME_FILE_ZIP = "application_archive" . FILE_NAME_ELEMENTS_SEP . ZIP_ACRONYM;
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }
 
 function putLinkTags():void
 {
  $htmlWriter = $this->getHtmlWriter();
  parent::setAllIeCssPatchEnabled(true);
  parent::setAllIeCssPatchModule(THIS_DIR . DIR_SEP . CSS_DIR . DIR_SEP . "cheope_ns_export_all_ie_css_patch_module.css");
  parent::putLinkTags();
  $htmlWriter->putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
  $htmlWriter->putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  "subModal" . STYLE_SHEET_FILE_POSTFIX);
 }

 function putClientScriptIncludeCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
  parent::putClientScriptIncludeCode();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP] !== STRING_NULL))
  {
   putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
   //$htmlWriter->putGenericHtmlString(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>");
   $htmlWriter->putGenericHtmlString("<script>" .
	 "dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>"); 
  }
 }

 
 function putActiveApp():void
 {
  $htmlWriter = $this->getHtmlWriter();
  putActiveApp($htmlWriter);
 }
 
 function calcolaNum(array $actExptList,string $actType):int
 {
   $i=0;
   foreach($actExptList as $ind=>$val)
   {
	if($val[FIELD_TYPE]==$actType)
     $i++;		
   }
   return $i;
 }
 
 function calcolaDimTot(array $actExptList,string $actType):int
 {
  $dimTot = 0;
  foreach($actExptList as $ind=>$val)
  {
	if(($val[FIELD_DIR]==STRING_POINT)&&($val[FIELD_TYPE]==$actType))
     $dimTot += @filesize(THIS_DIR . DIR_SEP . $val[FIELD_NAME]);
    elseif(($val[FIELD_DIR]==FW_DIR)&&($val[FIELD_TYPE]==$actType)) 
	 $dimTot += @filesize(THIS_DIR . DIR_SEP . FW_DIR . DIR_SEP . $val[FIELD_NAME]);
  }
  return $dimTot;  
 }

 function estraiLista(array $actExptList,string $actType):array
 {
  $list = array();
  foreach($actExptList as $ind=>$val)
  {
	if($val[FIELD_TYPE]==$actType)
	$list[] = THIS_DIR . DIR_SEP . $val[FIELD_NAME];	 
  }
  return $list;
 }

 function putBody():void
 { 	
  $stdAppFiles = array("ajax_handler.php","model_ajax_handler.php","preview.php",
  "loader.php");	
  $interfaces = $this->getInterfacesContainer();
 	
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL)
  {
   $intSimpleTable = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_SIMPLE_TABLE,NUM_1);
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $dir = PREVIOUS_DIR . DIR_SEP . $appName;
   $files = scandir($dir);
   $exportingFiles = array();
   $intHtmlDataTemplate1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_DATA_TEMPLATE,NUM_1);
   foreach($files as $ind=>$file)
   {
    $fileItems = explode(STRING_POINT,$file);
	$dir1 = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . $file;
    $suffix = $fileItems[count($fileItems)-1];
    if((count($fileItems)-2)>0)
     $tipo = $fileItems[count($fileItems)-2];
    else
     $tipo=APPLICATION_ACRONYM;
    if((! is_dir($file))&&($suffix == APP_LANGUAGE)&&(! in_array($file,$stdAppFiles)))
    {
     $exportingFiles[] = array(FIELD_NAME=>$file,
     FIELD_DIR=>STRING_POINT,FIELD_TYPE=>$tipo,FIELD_PATH=>$dir1);
    }
   }
   $dir = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . FW_DIR;
   $files = scandir($dir);
   foreach($files as $ind=>$file)
   {
    $fileItems = explode(STRING_POINT,$file);
	$dir1 = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . FW_DIR . DIR_SEP . $file;
    $suffix = $fileItems[count($fileItems)-1];
    if((count($fileItems)-2)>0)
     $tipo = $fileItems[count($fileItems)-2];
    else
     $tipo=APPLICATION_ACRONYM;
    if((! is_dir($file))&&($suffix == APP_LANGUAGE))
    {
     $exportingFiles[] = array(FIELD_NAME=>$file,
     FIELD_DIR=>FW_DIR,FIELD_TYPE=>$tipo,FIELD_PATH=>$dir1);
    }
   }
   $intSimpleTable->setDataSource($exportingFiles);
     
   $numAppl = $this->calcolaNum($exportingFiles,APPLICATION_ACRONYM);
   $dimTotAppl = $this->calcolaDimTot($exportingFiles,APPLICATION_ACRONYM);
   $listaAppl = $this->estraiLista($exportingFiles,APPLICATION_ACRONYM);
   $numClass = $this->calcolaNum($exportingFiles,CLASS_ACRONYM);
   $dimTotClass = $this->calcolaDimTot($exportingFiles,CLASS_ACRONYM);
   $listaClass = $this->estraiLista($exportingFiles,CLASS_ACRONYM);
   $numFun = $this->calcolaNum($exportingFiles,FUNCTION_ACRONYM);
   $dimTotFun = $this->calcolaDimTot($exportingFiles,FUNCTION_ACRONYM);
   $listaFun = $this->estraiLista($exportingFiles,FUNCTION_ACRONYM);
   $numInt = $this->calcolaNum($exportingFiles,INTERFACE_ACRONYM);
   $dimTotInt = $this->calcolaDimTot($exportingFiles,INTERFACE_ACRONYM);
   $listaInt = $this->estraiLista($exportingFiles,INTERFACE_ACRONYM);   
   $numTraits = $this->calcolaNum($exportingFiles,TRAITS_ACRONYM);
   $dimTotTraits = $this->calcolaDimTot($exportingFiles,TRAITS_ACRONYM);
   $listaTraits = $this->estraiLista($exportingFiles,TRAITS_ACRONYM); 
   $numDef = $this->calcolaNum($exportingFiles,DEFINITION_ACRONYM);
   $dimTotDef = $this->calcolaDimTot($exportingFiles,DEFINITION_ACRONYM);
   $listaDef = $this->estraiLista($exportingFiles,DEFINITION_ACRONYM);
   $numConst = $this->calcolaNum($exportingFiles,CONST_ACRONYM);
   $dimTotConst = $this->calcolaDimTot($exportingFiles,CONST_ACRONYM);
   $listaConst = $this->estraiLista($exportingFiles,CONST_ACRONYM);
   
   $xmlFileName = THIS_DIR . DIR_SEP . XML_DIR . DIR_SEP . self::NOME_FILE_XML_ANALISI;
   $xmlSerializer = Creator::create(str_replace(__NAMESPACE__ . STRING_BACKSLASH,STRING_NULL,Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$xmlFileName);
   $items = array(APPLICATION_ACRONYM=>array("num"=>$numAppl,"dim_tot"=>$dimTotAppl,"lista"=>$listaAppl),
   CLASS_ACRONYM=>array("num"=>$numClass,"dim_tot"=>$dimTotClass,"lista"=>$listaClass),
   FUNCTION_ACRONYM=>array("num"=>$numFun,"dim_tot"=>$dimTotFun,"lista"=>$listaFun),
   INTERFACE_ACRONYM=>array("num"=>$numInt,"dim_tot"=>$dimTotInt,"lista"=>$listaInt),
   TRAITS_ACRONYM=>array("num"=>$numTraits,"dim_tot"=>$dimTotTraits,"lista"=>$listaTraits),
   DEFINITION_ACRONYM=>array("num"=>$numDef,"dim_tot"=>$dimTotDef,"lista"=>$listaDef),
   CONST_ACRONYM=>array("num"=>$numConst,"dim_tot"=>$dimTotConst,"lista"=>$listaConst));
   $xmlSerializer->loadItems($items);
   $xmlSerializer->saveData();
   
   $intA1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_6);
   $intA1->setTagBody(LABEL_FILE_ANALISI_APPLICAZIONE);
   $fileName = THIS_DIR . DIR_SEP . XML_DIR . DIR_SEP . self::NOME_FILE_XML_ANALISI;
   $intA1->setAttribs(array("id"=>"File_analisi_id","style"=>"text-decoration:underline","href"=>$fileName));
   
   $intA2 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_7);
   $intA2->setTagBody(LABEL_FILE_ZIP);
   chdir(PREVIOUS_DIR);
   $zipFilePrevDir = THIS_DIR . STRING_BACKSLASH . $_SESSION[SESSION_VAR_ACTIVE_APP];
   $zipDir = $zipFilePrevDir . STRING_BACKSLASH . $_SESSION[SESSION_VAR_ACTIVE_APP];  
   $zipFileDir = $zipFilePrevDir . STRING_BACKSLASH . ZIP_DIR;
   $zipFileName = $zipFileDir . STRING_BACKSLASH . self::NOME_FILE_ZIP;
   //die($zipFileName);
   $zip = Creator::create("\\ZipArchive",STRING_BACKSLASH);
   $zip->open($zipFileName,\ZIPARCHIVE::CREATE);

   //echo $zipFileDir;
   //echo $zipFileName;
   //die($zipFileDir);

   //die(getcwd());
   if(file_exists($zipFileDir) && ! file_exists($zipFileName))
   {
	//die('KKKKK');
    $this->addZipFilesFromDir($zipDir, $zip);
   }
   //die('JJJJ');
   $zip->close();
   $intA2->setAttribs(array("id"=>"File_zip_id","style"=>"text-decoration:underline","href"=>$zipFileName));
 
   $intDataTemplate1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_DATA_TEMPLATE,NUM_1);
      
   $intDataTemplate1->setHtmlTemplate("<a href=\"#\" id=\"File_names_id\" onClick=\"subModal.showPopWin('" . PAGE_ANALISI_MODULI_2 .
   "?Par={PATH}'" .
   ",700,400,function(actVar){},true);" .  "\">{NAME}</a>");
   
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();
  } 
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
  {
   $interfaces->getInterfaceByShortName("Frame_1")->getInterfacesContainer()->deleteItem(1);
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();
  }
  else
  {
	 $int = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_TEMP_MSG,NUM_0);
   $int->putData();
  }
 }
 
 function adjustFilePath(string $actFilePath):string
 {
  $items = explode(STRING_BACKSLASH,$actFilePath);
  $num = count($items);
  $nFilePath = $items[1];
  for($i=2;$i<=$num-1;$i++)
  {
   $nFilePath = $nFilePath . STRING_BACKSLASH . $items[$i];
  }	 
  return $nFilePath;  
 }
 
 function addZipFilesFromDir(string $actZipFileDir,object $actZipObj):void
 {
   //echo "WWWWW";
  //echo $actZipFileDir;
   //die('nnn');
   $handle = opendir($actZipFileDir);
   //echo $actZipFileDir;
   //echo "<br>";
  // die($this->adjustFilePath($actZipFileDir));
  // echo 'mmm';
  //die('NNNN');
   while (false !== ($f = readdir($handle))) 
   {
	  // echo $f;
      if ($f != THIS_DIR && $f != PREVIOUS_DIR) 
	  {
        $filePath1 = $actZipFileDir . STRING_BACKSLASH . $f;
		
		//$filePath = $f;
		//echo $filePath1;
		//echo "<br>";
        // Remove prefix from file path before add to zip.
        //$localPath = substr($filePath, $exclusiveLength);
        if (is_file($filePath1)) 
		{
			//echo $filePath1;
			//echo "<br>";
		  $relativeFilePath = $this->adjustFilePath($filePath1);
		  //die($relativeFilePath);
          $actZipObj->addFile($relativeFilePath);
        } 
		elseif (is_dir($filePath1)) 
		{
			//echo $filePath1;
			//echo "<br>";
          // Add sub-directory.
		  $relativeFilePath = $this->adjustFilePath($filePath1);
			//echo $filePath1;
			//echo "<br>";
          $actZipObj->addEmptyDir($relativeFilePath);
          $this->addZipFilesFromDir($filePath1, $actZipObj);
        }
      }
    }
    closedir($handle);	 
 }
 
}
?>