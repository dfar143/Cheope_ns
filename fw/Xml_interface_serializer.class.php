<?
namespace Cheope_ns\fw;
require_once("filesystem.const.php");
require_once("Serializer.class.php");
require_once("Interfaces_container.class.php");
require_once("Generic_interface.class.php");
require_once("Xml_interface_serializer_loadDataClasses.class.php");
require_once("Xml_interface_serializer_createInterfaceFromStringClasses.class.php");
require_once("Xml_interface_serializer_loadItemsClasses.class.php");
require_once("Xml_interface_file_analyzer.class.php");
require_once("Creator.tra.php");

class Xml_interface_serializer extends Serializer implements \IteratorAggregate
{
 Use Creator;
 
 //const ERROR_1 = "Xml_interface_serializer:Oggetto SimpleXML non valido.";
 const ERROR_2 = "Xml_interface_serializer:La struttura php deve essere un array.";
 const ERROR_3 = "Xml_interface_serializer:Non esiste.";

 const INTERFACE_NAME_SEP = STRING_EXCLAMATION_MARK;
 const INTERFACES_DIR = "interfaces";
 const FW_DIR = "fw";
 const ROOT_TAG = "Items";

	private $appName=STRING_NULL;
//
// Directory repository delle sorgenti dati xml.
//
  private $xmlDir = THIS_DIR . DIR_SEP . XML_ACRONYM;
//
// Directory repository delle sorgenti dati json.
//
  private $jsonDir = THIS_DIR . DIR_SEP . JSON_ACRONYM;
//
// Directory repository dei files di interfacce (xml).
//
	private $interfacesDir = THIS_DIR . DIR_SEP . self::INTERFACES_DIR;
//
// Directory dei moduli php delle classi.
//
	private $codeDir = THIS_DIR . DIR_SEP . self::FW_DIR;
	private $pageName = STRING_NULL;
	private $doc = null;
	private $root = null;
	private $loadInterfaceAsString = false;
	private $interpolateConsts = true;
	private $interpolatePars = true;
	private $interfacesContainer = null;
	private $dbStruct = null;
	private $dbQueries = null;
	private $loadSpecialChars = false;
//
// Per ipotesi tutte le nuove classi istanziate. 
//
	private $scope = __NAMESPACE__;
	
	function __construct(string $actFileName=STRING_NULL)
	{
		parent::__construct($actFileName);
		$this->resetDOM();
    $this->resetInterfacesContainer(); 
	}
	
  public function getIterator():ArrayIterator 
  {
 	 return new ArrayIterator($this);
  }
	
	function resetDOM():void
	{
		$doc = Creator::create("DOMDocument",STRING_BACKSLASH,"1.0");
		$this->setDoc($doc);
	  $root = $doc->createElement(self::ROOT_TAG);
	  $doc->appendChild($root);
    $this->setRoot($root);
	}
	
	function setScope(string $actScope):void
	{
		$this->scope = $actScope;
	}
	
	function getScope():string
	{
		return $this->scope;
	}
	
	function resetInterfacesContainer():void
	{
		$intCont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $this->setInterfacesContainer($intCont);	
	}
	
	function getInterpolateConsts():bool
	{
		return $this->interpolateConsts;
  }
  
  function setInterpolateConsts(bool $actInt):void
  {
  	$this->interpolateConsts = $actInt;
  }
  
	function getInterpolatePars():bool
	{
		return $this->interpolatePars;
  }
  
  function setInterpolatePars(bool $actIntPar):void
  {
  	$this->interpolatePars = $actIntPar;
  }
  
  
  // Rimpiazza il vecchio nome applicazione con il nuovo solo nel file caricato.
  // Non rimpiazza il nome all'interno delle interfacce contenute. 
  //
  function replaceAppName(string $actOldAppName,string $actAppName):void
  {
  	$this->loadData();
  	$items = $this->getItems();
  	if(isset($items["appName"]))
  	 $items["appName"]=$actAppName;
  	if(isset($items["dataFieldsDomains"]))
  	{
  	 //$i=0;
  	 foreach($items["dataFieldsDomains"] as $ind=>$intDomainVal)
  	 {
  	  if($intDomainVal=="object")
  	  {
	   $fileName = $items["dataFieldsDomainsValues"][$ind]->getItemName();
       $itemsEls = Generic_interface::decodeInterfaceId($fileName,
  		  Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
       if((count($itemsEl)==5)||(count($itemsEls)==6))
	   {
	    if($itemsEls[0]==$actOldAppName)
		{
  		 $itemsEls[0] = $actAppName;
	     $newItemVal = implode(Generic_interface::INTERFACE_INSTANCE_CHAR_SEP,$itemsEls);
    	 $items["dataFieldsDomainsValues"][$ind]->setItemName($newItemVal);
		} 			 
  	   }
	  }
  	  //$i++;
	 }
  	}
  	if(isset($items["interfacesContainer"]))
  	{
  	 $intCont = $items["interfacesContainer"];
  	 $intContValues = $intCont->getInterfaces();
  	 foreach($intContValues as $ind=>$intVal)
  	 {
      $itemsEls1 = Generic_interface::decodeInterfaceId($intVal->getItemName(),Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
      if((count($itemsEl1)==5)||(count($itemsEls1)==6))
	   {
	    if($itemsEls1[0]==$actOldAppName)
		{	  	  
  		 $itemsEls1[0] = $actAppName;
  		 $newItemVal = implode(Generic_interface::INTERFACE_INSTANCE_CHAR_SEP,$itemsEls1);
  	     $intContValues[$ind]->setItemName($newItemVal);
		}
	   }
  	 }
  	 $intCont->setInterfaces($intContValues);
  	 $items["interfacesContainer"]=$intCont;
  	}
  	if(isset($items["interfacesContainerBottom"]))
  	{
  	 $intCont = $items["interfacesContainerBottom"];
  	 $intContValues = $intCont->getInterfaces();
  	 foreach($intContValues as $ind=>$intVal)
  	 {
      $itemsEls1 = Generic_interface::decodeInterfaceId($intVal->getItemName(),Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
      if((count($itemsEl1)==5)||(count($itemsEls1)==6))
	   {
	    if($itemsEls1[0]==$actOldAppName)
		{	  	  
  		 $itemsEls1[0] = $actAppName;
  		 $newItemVal = implode(Generic_interface::INTERFACE_INSTANCE_CHAR_SEP,$itemsEls1);
  	     $intContValues[$ind]->setItemName($newItemVal);
		}
	   }
  	 }
  	 $intCont->setInterfaces($intContValues);
  	 $items["interfacesContainerBottom"]=$intCont;
  	}
  	if(isset($items["interfacesContainerTop"]))
  	{
  	 $intCont = $items["interfacesContainerTop"];
  	 $intContValues = $intCont->getInterfaces();
  	 foreach($intContValues as $ind=>$intVal)
  	 {
      $itemsEls1 = Generic_interface::decodeInterfaceId($intVal->getItemName(),Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
      if((count($itemsEl1)==5)||(count($itemsEls1)==6))
	   {
	    if($itemsEls1[0]==$actOldAppName)
		{	  	  
  		 $itemsEls1[0] = $actAppName;
  		 $newItemVal = implode(Generic_interface::INTERFACE_INSTANCE_CHAR_SEP,$itemsEls1);
  	     $intContValues[$ind]->setItemName($newItemVal);
		}
	   }
  	 }
  	 $intCont->setInterfaces($intContValues);
  	 $items["interfacesContainerTop"]=$intCont;
  	}
  	if(isset($items["interfacesContainerCenter"]))
  	{
  	 $intCont = $items["interfacesContainerCenter"];
  	 $intContValues = $intCont->getInterfaces();
  	 foreach($intContValues as $ind=>$intVal)
  	 {
      $itemsEls1 = Generic_interface::decodeInterfaceId($intVal->getItemName(),Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
      if((count($itemsEl1)==5)||(count($itemsEls1)==6))
	   {
	    if($itemsEls1[0]==$actOldAppName)
		{	  	  
  		 $itemsEls1[0] = $actAppName;
  		 $newItemVal = implode(Generic_interface::INTERFACE_INSTANCE_CHAR_SEP,$itemsEls1);
  	     $intContValues[$ind]->setItemName($newItemVal);
		}
	   }
  	 }
  	 $intCont->setInterfaces($intContValues);
  	 $items["interfacesContainerCenter"]=$intCont;
  	}
  	if(isset($items["decoratedObj"]))
  	{
  	 $intDecObj = $items["decoratedObj"];
     $itemsEls1 = Generic_interface::decodeInterfaceId($intDecObj->getItemName(),Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
     if((count($itemsEl1)==5)||(count($itemsEls1)==6))
	 {
  	  if($itemsEls1[0]==$actOldAppName)
	  {
  	   $itemsEls1[0] = $actAppName;
  	   $newItemVal = implode(Generic_interface::INTERFACE_INSTANCE_CHAR_SEP,$itemsEls1);
  	   $items["decoratedObj"]->setItemName($newItemVal);
	  }
	 }
  	}
	if(isset($items["bodyStructTemplate"]))
	{
	 $intBodyStructObj = $items["bodyStructTemplate"];
     $itemsEls1 = Generic_interface::decodeInterfaceId($intBodyStructObj->getItemName(),Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
     if((count($itemsEl1)==5)||(count($itemsEls1)==6))
	 {
  	  if($itemsEls1[0]==$actOldAppName)
	  {
  	   $itemsEls1[0] = $actAppName;
  	   $newItemVal = implode(Generic_interface::INTERFACE_INSTANCE_CHAR_SEP,$itemsEls1);
  	   $items["bodyStructTemplate"]->setItemName($newItemVal);
	  }
	 }    	 
	}
  	$this->loadItems($items);
  	$this->saveData();
  }
  
 static function getInterfacesContainerSons(string $actAppName,string $actIntStr):array
 {
   $appName = $actAppName;
   $appDir = $appName;
   $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;
   $appInterfacesDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
   $files = scandir($appInterfacesDir);
   $sons = array();
   $i=0;   
   $serializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$actIntStr);
   $serializer->setXmlDir($appXmlDir);
   $serializer->setInterfacesDir($appInterfacesDir);
   $nodesContainer = Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   $serializer->setDbStruct($nodesContainer);
   $queriesContainer = Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   $serializer->setDbQueries($queriesContainer);
   $intContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   $serializer->setInterfacesContainer($intContainer);
   $serializer->setAppName($appName);
   $filesItems = preg_split(STRING_SLASH . Xml_interface_serializer::INTERFACE_NAME_SEP . 
     STRING_SLASH,$actIntStr);
   if(count($filesItems)==1)
    $nomePagina = Xml_interface_file_analyzer::getScalarProperty(
      $appInterfacesDir . DIR_SEP . $actIntStr,"pageName");
   else
    $nomePagina = $filesItems[1];
   $serializer->setPageName($nomePagina);
   $serializer->setLoadInterfaceAsString(true);
   $serializer->loadData();
   $items = $serializer->getItems();
   foreach($items as $ind=>$item)
   {
    //if(($ind)&&(strpos($ind,"interfacesContainer")!==false)&&($ind !== "ind_interfacesContainer"))
	if(strpos($ind,"interfacesContainer")!==false)
    {
     $int_iter = $item->create();
     while($int_iter->hasMore())
     {
	  //if(is_a($contItem,Classes_info::INTERFACE_AS_STRING_CLASS))
	  //	$contItem=$contItem->getItemName();
      $contItem = $int_iter->current()->getItemName();
      $sons[$i++]=$contItem;
      $newSons = array();
     	$newSons = self::getInterfacesContainerSons($appName,$contItem);
     	if(count($newSons)>0)
      {
     	 foreach($newSons as $item2)
     	 {
     	 	if(! in_array($item2,$sons))
     	  $sons[$i++] = $item2;
       }     	 
     	}
      $newSons = self::getFamilySons($appName,$contItem);
      if(count($newSons)>0)
      {
       foreach($newSons as $item2)
       {
     	 	if(! in_array($item2,$sons))
     	  $sons[$i++] = $item2;
     	 }
      }
     	$int_iter->next();
     }
    }
   }
 	return $sons;
 }

 static function getFamilySons(string $actAppName,string $actInt):array
 {
  $appName=$actAppName;
  $appDir=$appName;
  $appXmlDir=PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;
  $appInterfacesDir=PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
  $sons=array();
  $i=0;
  $file=$actInt;
  if(file_exists($file))
  {
  	$serializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$file);
    $serializer->setXmlDir($appXmlDir);
    $serializer->setInterfacesDir($appInterfacesDir);
    $dbNodesContainer = Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $serializer->setDbStruct($dbNodesContainer);
    $dbQueriesContainer = Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $serializer->setDbQueries($dbQueriesContainer);
    $intContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $serializer->setInterfacesContainer($intContainer);
    $serializer->setAppName($appName);
    $filesItems=preg_split(STRING_SLASH . Xml_interface_serializer::INTERFACE_NAME_SEP . 
     STRING_SLASH,$file);
    if(count($filesItems)==1)
      $nomePagina = Xml_interface_file_analyzer::getScalarProperty(
      $appInterfacesDir . DIR_SEP . $file,"pageName");     
    else
      $nomePagina = $filesItems[1];
    $serializer->setPageName($nomePagina);
    $serializer->setLoadInterfaceAsString(true);
    $serializer->loadData();
    $items = $serializer->getItems();
    if(isset($items["dataFieldsDomains"]))
    {
     $domains = $items["dataFieldsDomains"];
     $domainsValues = $items["dataFieldsDomainsValues"];
    }
    else
     $domains=array();
    foreach($domains as $ind=>$domain)
    {
     if($domain=="object")
     {
     $intObj = $domainsValues[$ind]->getItemName();
	 //if(is_a($intObj,Classes_info::INTERFACE_AS_STRING_CLASS))
	//	$intObj=$intObj->getItemName();
     $sons[$i++]=$intObj;
     $newSons = self::getFamilySons($appName,$intObj);
     if(count($newSons)>0)
     {
      foreach($newSons as $item2)
      {
     	 if(! in_array($item2,$sons))
     	 $sons[$i++] = $item2;
     	}
     }
     $newSons = self::getInterfacesContainerSons($appName,$intObj);
     if(count($newSons)>0)
     {
     	foreach($newSons as $item2)
     	{
     	 if(! in_array($item2,$sons))
     	 $sons[$i++] = $item2;
      }     	 
     }
    }
   } 
  }  
 	return $sons;
 }

 static function getFamilyParents(string $actApp,string $actInt):array
 {
   $appName = $actApp;
   $appDir = $appName;
   $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;
   $appInterfacesDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
   $files = scandir($appInterfacesDir);
   $parents= array();
   $i=0;
   foreach($files as $ind=>$file)
   {
    $fileItems = explode(FILE_NAME_ELEMENTS_SEP,$file);
    $num = count($fileItems);
    if((($file != $actInt)&&(! is_dir($file))&&($num==1))||
    ((! is_dir($file))&&($file != $actInt)&&($num==2)&&($fileItems[1]==XML_SUFFIX)))
    {
  	 $serializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$file);
     $serializer->setXmlDir($appXmlDir);
     $serializer->setInterfacesDir($appInterfacesDir);
     $dbNodesContainer = Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
     $serializer->setDbStruct($dbNodesContainer);
     $dbQueriesContainer = Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
     $serializer->setDbQueries($dbQueriesContainer);
     $intContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
     $serializer->setInterfacesContainer($intContainer);
     $serializer->setAppName($appName);
     $filesItems = preg_split(STRING_SLASH . self::INTERFACE_NAME_SEP . 
     STRING_SLASH,$file);
     if(count($filesItems)==1)
      $nomePagina = Xml_interface_file_analyzer::getScalarProperty(
      $appInterfacesDir . DIR_SEP . $file,"pageName");     
     else
      $nomePagina = $filesItems[1];
     $serializer->setPageName($nomePagina);
     $serializer->setLoadInterfaceAsString(true);
     $serializer->loadData();
     $items = $serializer->getItems();
     if(isset($items["dataFieldsDomains"]))
     {
      $domains = $items["dataFieldsDomains"];
      $domainsValues = $items["dataFieldsDomainsValues"];
     }
     else
      $domains=array();
     foreach($domains as $ind=>$domain)
     {
     	if($domain=="object")
     	{
     	 $intObj = $domainsValues[$ind]->getItemName();
	    // if(is_a($intObj,Classes_info::INTERFACE_AS_STRING_CLASS))
		//  $intObj=$intObj->getItemName();
     	 if($intObj==$actInt)
     	 {
     		$parents[$i++]=$file;
     		$newParents = self::getFamilyParents($appName,$file);
     		if(count($newParents)>0)
     		{
     		 foreach($newParents as $item2)
     		 {
     	 	  if(! in_array($item2,$parents))
     		  $parents[$i++] = $item2;
     		 }
     		}
     		$intItems = Xml_interface_file_analyzer::getInterfaceItems($appInterfacesDir . DIR_SEP . $file);
     		if(((count($intItems)==5) &&
     		   (($intItems[2]==Interfaces_info::INT_MENUBAR)||($intItems[2]==Interfaces_info::INT_ACCORDION)||
     		   ($intItems[2]==Interfaces_info::INT_MENUBAR_2)||($intItems[2]==Interfaces_info::INT_LOCAL_TABS)||
     		   ($intItems[2]==Interfaces_info::INT_LOCAL_TABS_2)))
     		   ||((count($intItems)==6) &&
     		   (($intItems[3]==Interfaces_info::INT_MENUBAR)||($intItems[3]==Interfaces_info::INT_ACCORDION)||
     		   ($intItems[3]==Interfaces_info::INT_MENUBAR_2)||($intItems[3]==Interfaces_info::INT_LOCAL_TABS)||
     		   ($intItems[3]==Interfaces_info::INT_LOCAL_TABS_2))))
     		{
     		 $newParents1 = self::getInterfacesContainerParents($appName,$file);
     		 if(count($newParents1)>0)
     		 {
     		  foreach($newParents1 as $item2)
     		  {
           if(! in_array($item2,$parents))
     		   $parents[$i++] = $item2;
     		  }
     		 }
     		}     		
     	 }
     	}
     }
    }   
   } 	
 	return $parents;
 }

 static function getDecoratedInterface(string $actAppName,string $actInt):?string
 {
   $appName = $actAppName;
   $appDir = $appName;
   $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;
   $appInterfacesDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
   $decoratedObjName = null;
   $file = $actInt;
   if(file_exists($file))
   {
  	$serializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$file);
    $serializer->setXmlDir($appXmlDir);
    $serializer->setInterfacesDir($appInterfacesDir);
    $dbNodesContainer = Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $serializer->setDbStruct($dbNodesContainer);
    $dbQueriesContainer = Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $serializer->setDbQueries($dbQueriesContainer);
    $intContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $serializer->setInterfacesContainer($intContainer);
    $serializer->setAppName($appName);
    $filesItems = preg_split(STRING_SLASH . self::INTERFACE_NAME_SEP . 
     STRING_SLASH,$file);
    if(count($filesItems)==1)
      $nomePagina = Xml_interface_file_analyzer::getScalarProperty(
      $appInterfacesDir . DIR_SEP . $file,"pageName");     
    else
      $nomePagina = $filesItems[1];
    $serializer->setPageName($nomePagina);
    $serializer->setLoadInterfaceAsString(true);
    $serializer->loadData();
    $items = $serializer->getItems();
    if(isset($items["decoratedObj"]))
     $decoratedObjName = $items["decoratedObj"]->getItemName();
   }
   return $decoratedObjName;
 } 
  
 static function getInterfacesContainerParents(string $actAppName,string $actIntStr):array
 {
   $appName = $actAppName;
   $appDir = $appName;
   $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;
   $appInterfacesDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
   $files = scandir($appInterfacesDir);
   $parents = array();
   $i=0;
   foreach($files as $ind=>$file)
   {
    $fileItems = explode(FILE_NAME_ELEMENTS_SEP,$file);
    $num = count($fileItems);
    if(((! is_dir($file))&&($num==1)&&
    ($file != $actIntStr))||
    ((! is_dir($file))&&($num==2)&&(
    $file != $actIntStr)&&($fileItems[1]==XML_SUFFIX)))
    {
     $serializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$file);
	 //echo $file;
     $serializer->setXmlDir($appXmlDir);
     $serializer->setInterfacesDir($appInterfacesDir);
     $dbNodesContainer = Creator::create(getClassNameForCreate(Classes_info::DB_NODES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
     $serializer->setDbStruct($dbNodesContainer);
     $queriesContainer = Creator::create(getClassNameForCreate(Classes_info::QUERIES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
     $serializer->setDbQueries($queriesContainer);
     $intContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
     $serializer->setInterfacesContainer($intContainer);
     $serializer->setAppName($appName);
     $filesItems = preg_split(STRING_SLASH . self::INTERFACE_NAME_SEP . 
     STRING_SLASH,$file);
     if(count($filesItems)==1)
      $nomePagina = Xml_interface_file_analyzer::getScalarProperty(
      $appInterfacesDir . DIR_SEP . $file,"pageName");
     else
      $nomePagina = $filesItems[1];
     $serializer->setPageName($nomePagina);
     $serializer->setLoadInterfaceAsString(true);
     $serializer->loadData();
     $items = $serializer->getItems();
     foreach($items as $ind=>$item)
     {
     	//if(($ind)&&(strpos($ind,"interfacesContainer")!==false)&&($ind !== "ind_interfacesContainer")&&(! is_null($item)))
		if(strpos($ind,"interfacesContainer")!==false)
     	{
		/* echo $ind;
	     var_dump($item); */
     	 $int_iter = $item->create();
     	 while($int_iter->hasMore())
     	 {
     		 $contItem = $int_iter->current()->getItemName();
     		 if($contItem==$actIntStr)
     		 {
     		  $parents[$i++]=$file;
     		  $newParents = self::getInterfacesContainerParents($appName,$file);
     		  if(count($newParents)>0)
     		  {
     			 foreach($newParents as $item2)
     			 {
            if(! in_array($item2,$parents))
     				$parents[$i++] = $item2;
     			 }
     		  }
     		  $intItems = Xml_interface_file_analyzer::getInterfaceItems($appInterfacesDir . DIR_SEP . $file);
     		  if(((count($intItems)==5) &&
     		   (($intItems[2]==Interfaces_info::INT_MENUBAR)||($intItems[2]==Interfaces_info::INT_ACCORDION)||
     		   ($intItems[2]==Interfaces_info::INT_MENUBAR_2)||($intItems[2]==Interfaces_info::INT_LOCAL_TABS)||
     		   ($intItems[2]==Interfaces_info::INT_LOCAL_TABS_2)))
     		   ||((count($intItems)==6) &&
     		   (($intItems[2]==Interfaces_info::INT_MENUBAR)||($intItems[2]==Interfaces_info::INT_ACCORDION)||
     		   ($intItems[2]==Interfaces_info::INT_MENUBAR_2)||($intItems[2]==Interfaces_info::INT_LOCAL_TABS)||
     		   ($intItems[2]==Interfaces_info::INT_LOCAL_TABS_2))))
     		  {
     		   $newParents1 = self::getFamilyParents($appName,$file);
     		   if(count($newParents1)>0)
     		   {
     		    foreach($newParents1 as $item2)
     		    {
             if(! in_array($item2,$parents))
     		     $parents[$i++] = $item2;
     		    }
     		   }
     		  } 
     		 }
     		 $int_iter->next();
     	 }
     	}
     }
    }   
   } 	
 	return $parents;
 }

	
	static function substituteParsInString(string $actStr):string
	{
		$item = $actStr;
 	 	 if(preg_match_all('/\$_GET\["([A-Za-z0-9_]+)"\]/',$item,$matches)>0)
 	 	 {
 	 	  foreach($matches[1] as $strMatch)
 	 	  {
        if(isset($_GET[$strMatch]))
 	 	  	$item=str_replace('$_GET["' . $strMatch . '"]',$_GET[$strMatch],$item);
 	 	  }
 	   }
 	  return $item;
	}
	
  static function substituteConstantInString(string $actStr):string
  {
   $els = preg_split("/@@/",$actStr);
   $str = $actStr;
   if(count($els)>=3)
   foreach($els as $ind=>$val)
   {
	  if(preg_match("/^[A-Z_]+$/",$val,$matches))
	  {
	   if(defined($matches[0]))
	   {
	    eval('$sost = ' . $matches[0] . STRING_SEMICOLON);
      $str = preg_replace("/@@$matches[0]@@/",$sost,$str);
     }
     else
      return $str;
    }
   }
   return $str;
  }
  
  static function isInterfaceNameNormalized(string $actIntId,
  $actSepChar=self::INTERFACE_NAME_SEP):bool
  {
   $items = array();
 	 $items = explode($actSepChar,$actIntId);
 	 $num = count($items); 	
 	 if(($num==5)||($num==6))
 	  return true;
 	 else
 	  return false;
  }
  
  function getInterfacesDir():string
  {
  	return $this->interfacesDir;
  }
  
  function setInterfacesDir(string $actInterfacesDir):void
  {
  	$this->interfacesDir = $actInterfacesDir;
  }
  
  function getDir():string
  {
  	return $this->interfacesDir;
  }
  
  function setDir(string $actDir):void
  {
  	$this->interfacesDir = $actDir;
  }
  
  function getCodeDir():string
  {
  	return $this->codeDir;
  }
  
  function setCodeDir(string $actCodeDir):void
  {
  	$this->codeDir = $actCodeDir;
  }

	
	// 
	// Inizializza l'interfaccia solo con l'oggetto tabella o query.
	// per gli oggetti dati 'Serializable' inizializza a OBJ_DATA_SOURCE
	//
	function createInterfaceFromString(string $actIntStr):?object
	{
		$appName = $this->getAppName();
		$interfacesDir = $this->getInterfacesDir();
    $interfacesCodeDir = $this->getCodeDir();
		$dbStruct = $this->getDbStruct();
		$dbQueries = $this->getDbQueries();
		$completeIntFileName = $interfacesDir . DIR_SEP . $actIntStr;
		
		if(Xml_interface_file_analyzer::is_free_interface_file($completeIntFileName))
		{ 
		 $intIds1 = Xml_interface_file_analyzer::getCanonicalName($completeIntFileName,
		 Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
		 $intIds = Generic_interface::decodeInterfaceId($intIds1,
		 Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
		}
		else
		{
	     //echo PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . FRAMEWORK_DIR . DIR_SEP . "Generic_interface.class.php";
	     //require_once(PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . FRAMEWORK_DIR . DIR_SEP . "Generic_interface.class.php");
		 $intIds = Generic_interface::decodeInterfaceId($actIntStr,
		 Generic_interface::INTERFACE_INSTANCE_CHAR_SEP);
	 	}
		
	 	$scope = $this->getScope();
	 	
	 	$factory = Creator::create(getClassNameForCreate(Classes_info::CREATEINTERFACEFROMSTRING_FACTORY_CLASS),STRING_NULL,$intIds,$appName);
	  $factory->setAppName($appName);
	  $factory->setScope($scope);
	 	$branchObj = $factory->create($dbStruct,$dbQueries);
	 	$branchObj->setInterfacesCodeDir($interfacesCodeDir);
	 	$newInterface = $branchObj->exec();	 	
    return $newInterface;  
	}
	
	function setAppName(string $actAppName):void
	{
		$this->appName = $actAppName;
	}
	
	function getAppName():string
	{
		return $this->appName;
	}
	  
  function setXmlDir(string $actXmlDir):void
  {
  	$this->xmlDir = $actXmlDir;
  }
  
  function getXmlDir():string
  {
  	return $this->xmlDir;
  }
  
  function setJsonDir(string $actJsonDir):void
  {
  	$this->jsonDir = $actJsonDir;
  }
  
  function getJsonDir():string
  {
  	return $this->jsonDir;
  }
  
  function setPageName(string $actPageName):void
  {
  	$this->pageName = $actPageName;
  }
  
  function getPageName():string
  {
  	return $this->pageName;
  }
	
	function setDoc(\DOMDocument $actDoc):void
	{
		$this->doc = $actDoc;
	}
	
	function getDoc():\DOMDocument
	{
		return $this->doc;
	}
	
	function setRoot(\DOMElement $actRoot):void
	{
		$this->root = $actRoot;
	}
	
	function getRoot():\DOMElement
	{
		return $this->root;
	}
	
	function setLoadInterfaceAsString(string $actLoadInterfaceAsString):void
	{
		$this->loadInterfaceAsString = $actLoadInterfaceAsString;
	}
	
	function getLoadInterfaceAsString():string
	{
		return $this->loadInterfaceAsString;
	}
	
	function getInterfacesContainer():Interfaces_container
	{
		return $this->interfacesContainer;
	}
	
	function setInterfacesContainer(Interfaces_container $actIntContainer):void
	{
		$this->interfacesContainer = $actIntContainer;
  }
  
  function setDbStruct(?object $actDbStruct):void
  {
  	$this->dbStruct = $actDbStruct;
  }
  
  function getDbStruct():?object
  {
  	return $this->dbStruct;
  }
  
  function setDbQueries(?object $actDbQueries)
  {
  	$this->dbQueries = $actDbQueries;
  }
  
  function getDbQueries():?object
  {
  	return $this->dbQueries;
  }
  
  function getLoadSpecialChars():bool
  {
    return $this->loadSpecialChars;
  }
  
  function setLoadSpecialChars(bool $actLoadSpecialChars):void
  {
	//var_dump($actLoadSpecialChars);
	//die('jjjjj');
	$this->loadSpecialChars = $actLoadSpecialChars;
  }
  
	
	// metodo richiamato da loadItems
	function loadItemsRecurse(\DOMElement $actFatherNode,string $actItemName,
	$actItems):void
	{
	 $doc = $this->getDoc();
   $appName = $this->getAppName();
   $pageName = $this->getPageName();
   $scope = $this->getScope();
   $factory = Creator::create(getClassNameForCreate(Classes_info::LOADITEMS_FACTORY_CLASS),STRING_NULL,
   $actItems,$actItemName,$doc,$actFatherNode,$scope);
	 $branchObj = $factory->create($this,$appName,$pageName);
	 $branchObj->exec();	 	  
	}
	
	// carica gli items nel documento DOM
	function loadItems(array|string $actItems=STRING_NULL):void
	{
		$doc = $this->getDoc();
		$root = $this->getRoot();
		if($actItems == STRING_NULL)
		{
		 $items = $this->getItems();
	  }
	  else
	   $items = $actItems;
	   	   
	  if(is_array($items))
	  {
	   foreach($items as $itemName=>$itemVal)
	   {	 	   
	   	//echo STRING_MINUS . $itemName . STRING_MINUS;	
	    $this->loadItemsRecurse($root,$itemName,$itemVal);	   
	   }
	  }
	  else
	   die(self::ERROR_2);
	}
	
	// salva il documento DOM su disco
	function saveData():void
	{
		$doc = $this->getDoc();
		$fileName = $this->getFileName();
		$interfacesDir = $this->getInterfacesDir();
    $path1 = ((($interfacesDir !== STRING_NULL)&&
    (strpos($fileName,DIR_SEP)===false))?
    ($interfacesDir . DIR_SEP . $fileName):($fileName));
		$doc->formatOutput = true;
		$doc->save($path1);
	}
	
	
	// metodo privato richiamato da loadData
	function loadDataRecurse(\SimpleXMLElement $actItem,string &$actInd,array $actSwapInt=array()):mixed
	{
	 $interfacesContainer = $this->getInterfacesContainer();
	 $dbStruct = $this->getDbStruct();
	 $dbQueries = $this->getDbQueries();	
	 $factory = Creator::create(getClassNameForCreate(Classes_info::LOADDATA_FACTORY_CLASS),STRING_NULL,$actItem);
	 $loadSpecialChars = $this->getLoadSpecialChars();
	 //var_dump($loadSpecialChars);
	 //die('mmm');
	 $factory->setLoadSpecialChars($loadSpecialChars);
	 $branchObj = $factory->create($this,$interfacesContainer,$dbStruct,$dbQueries);
	 if(! is_null($branchObj) && ! is_string($branchObj)) 
		$branchObj->setSwapInt($actSwapInt);

	 if(is_object($branchObj))
	 {
	  $loadedValues = $branchObj->exec_1($actInd);
     }	  
   else
   {  
    $loadedValues = null; 
	$actInd = (string)$actItem['id'];
   }
   return $loadedValues;  	 
	}
	
	// Carica i dati da disco (file xml di interfaccia) nel buffer interno.
	// L'array parametro serve per scambiare il nome dell'interfaccia contenuta
	// nel primo elemento con il nome dell'interfaccia contenuta nel secondo elemento.
	//
	function loadData(array $actSwapInt=array()):void
	{
	 $loadedValues = array();
	 $values = array();
	 $fileName = $this->getFileName();
	 $interfacesDir = $this->getInterfacesDir();
	 //$dir = $this->getDir();
	 //
	 // $dir è riservata per caricare oggetti xml
	 //
   $ind = STRING_NULL;

   $path1 = ((($interfacesDir !== STRING_NULL)&&
   (strpos($fileName,DIR_SEP)===false))?($interfacesDir . DIR_SEP . $fileName):($fileName));
   if(file_exists($path1))
   {
	  $xml = simplexml_load_file($path1);
	  //echo $path1;
	  //echo "<br>";
	  foreach($xml->children() as $ind=>$item)
	  {
	 	 $values = $this->loadDataRecurse($item,$ind,$actSwapInt);
		 //print_r($values);
	   $loadedValues[$ind] = $values;
	  }
	  $this->setItems($loadedValues);
	 }
	 else
	  die($path1 . STRING_SPACE . self::ERROR_3);
	}
	
		// Carica i dati da disco (tramite un oggetto SimpleXml) nel buffer interno.
	function loadDataFromSimpleXml(\SimpleXMLElement $actXml):void
	{
	 $loadedValues = array();
	 $values = array();
   $ind = STRING_NULL;
	 $xml = $actXml;
	 foreach($xml->children() as $item)
	 {
	 	$values = $this->loadDataRecurse($item,$ind);
	  $loadedValues[$ind] = $values;
	 }
	 $this->setItems($loadedValues);
	}
	
}	
	
?>