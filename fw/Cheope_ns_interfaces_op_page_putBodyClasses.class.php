<?
namespace Cheope_ns\fw;
require_once("class.const.php");
require_once("Executable.int.php");
require_once("Factory_1.int.php");
require_once("Creator.tra.php");

abstract class PutBody_base implements Executable
{
	private $ind=STRING_NULL;
	private $item;
	private $divTagContainer=null;
  private $selectCounter=0;
  private $fields=array();
	
	function __construct(string $actInd,mixed $item,Interfaces_container $actDivTagContainer)
	{
		$this->setInd($actInd);
		$this->setItem($item);
		$this->setDivTagContainer($actDivTagContainer);
	}
	
 function setInd(string $actInd):void
 {
 	$this->ind = $actInd;
 }
	
 function getInd():string
 {
 	return $this->ind;
 }
 
	function setItem(mixed $actItem):void
	{
		$this->item = $actItem;
	}
	
	function getItem():mixed
	{
		return $this->item;
	}
 
 function setDivTagContainer(Interfaces_container $actDivTagContainer):void
 {
 	$this->divTagContainer = $actDivTagContainer;
 }
 
 function getDivTagContainer():Interfaces_container
 {
 	return $this->divTagContainer;
 }
 
 	function setFields(array $actFields):void
	{
		$this->fields = $actFields;
	}
	
	function getFields():array
	{
		return $this->fields;
	}
	
	function getSelectCounter():int
	{
		return $this->selectCounter;
	}
	
	function setSelectCounter(int $actSelectCounter):void
	{
		$this->selectCounter = $actSelectCounter;
	}
 
 abstract function exec():void;
} 

// Array
class PutBody_array extends PutBody_base
{
	const INTERFACE_NAME_SEP = Xml_interface_serializer::INTERFACE_NAME_SEP;
	
	private $intHtmlFragment=null;
	private $interfacesFiles=array();
	private $scope=STRING_NULL;
	
	function __construct(string $actInd,array $item,Interfaces_container $actDivTagContainer)
	{
		parent::__construct($actInd,$item,$actDivTagContainer);
	}
	
	function setItems(array $actItems):void
	{
		$this->items = $actItems;
	}
	
	function getItems():array
	{
		return $this->items;
	}
	
 	function getIntHtmlFragment():Html_fragment
 	{
 		return $this->intHtmlFragment;
 	}
 	
 	function setIntHtmlFragment(Html_fragment $actIntHtmlFragment):void
 	{
 		$this->intHtmlFragment = $actIntHtmlFragment;
  }
  
  function getScope():string
  {
	  return $this->scope;
  }
  
  function setScope(string $actScope)
  {
	  $this->scope=$actScope;
  }
  
  function getInterfacesFiles():array
  {
  	return $this->interfacesFiles;
  }
  
  function setInterfacesFiles(array $actInterfacesFiles):void
  {
  	$this->interfacesFiles = $actInterfacesFiles;
  }
	
	static function getDojoMenuItemStr(string $actInd,string $actDomain):string
  {
   return "<div dojoType=\"dijit.MenuItem\">" . $actDomain . 
   			 "<script type=\"dojo/method\" event=\"onClick\" args=\"evt\">" .
   			 "var selection = new Selection(document.getElementById('" . $actInd . "'));" .
         "var s = selection.create();" .
         "var lenStr = document.getElementById('" . $actInd . "').value.length;" .
         "var leftStr = document.getElementById('" . $actInd . "').value.substring(0,s.start);" .
         "var rightStr = document.getElementById('" . $actInd . "').value.substring(s.end,lenStr);"  .
         "var newStr = leftStr + '" . $actDomain . "' + rightStr;" .
         "document.getElementById('" . $actInd . "').value=newStr;" .
         "</script></div>";
  }
  
 static function filterInterfacesFiles(string $actInt,array $actVet):array
 {
  $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
 	$newVet = array();

  $parents = Xml_interface_serializer::getFamilyParents($appName,$actInt);
 	$parents1 = Xml_interface_serializer::getInterfacesContainerParents($appName,$actInt);
 	$parents2=array_assoc_concat($parents,$parents1);
 	$parents2=array_unique($parents2);
 	$parents2=array_values($parents2);
 	foreach($actVet as $ind=>$intName)
 	{
 		if(! in_array($intName,$parents2))
 		 $newVet[$ind]=$intName;
 	}
	
 	return $newVet;
 }
	
	function exec():void
	{		
		$ind = $this->getInd();
		$item = $this->getItem();
		$scope = $this->getScope();
		$scope1 = $scope . STRING_BACKSLASH . INTERFACE_AS_STRING_CLASS;
		foreach($item as $ind2=>$val2)
		{
		 if(is_a($val2,$scope1))
			$item[$ind2]=$val2->getItemName();
		}
		$items = $this->getItems();
		$interfaceDivTagContainer0 = $this->getDivTagContainer();
		$intHtmlFragment1 = $this->getIntHtmlFragment();
		$objNodeFields = $this->getFields();
		$interfacesFiles = $this->getInterfacesFiles();
		
		 $interfaccia = $_GET["Interfaccia"]; 
		
   		if($ind != "dataFields")
   		 $ind2 = ucFirst(str_replace("dataFields",STRING_NULL,$ind));
   		else
   		 $ind2=ucFirst($ind);
   		$intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL); 
      //$intLabel1 = new Html_label_tag();
      $attribs = $intLabel1->getAttribs();
      $attribs["for"] = $ind;
      $intLabel1->setTagBody($ind2);
      $intLabel1->setAttribs($attribs);
      $intDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
      $attribs = array("style"=>"float:left;width:180px;overflow:auto;");
      $intDiv1->setAttribs($attribs);
      $intDivContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
      $intDiv1->setInterfacesContainer($intDivContainer);
      $intDiv1->getInterfacesContainer()->add($intLabel1);
      $interfaceDivTagContainer0->add($intDiv1);
      $interfaceDivTagContainer0->add($intHtmlFragment1);
      $intText1 = Creator::create(Interfaces_info::INT_HTML_TEXTAREA_TAG,STRING_NULL);
   		$attribs2 = array(); 
   		$attribs2["rows"] = "10";
   		$attribs2["cols"] = "35";
   		$attribs2["id"] = $ind;
   		$attribs2["name"] = $ind;
   		$intText1->setAttribs($attribs2); 	
   		$intText1->setTagBody(var_export(/*str_replace("\\\\\\\\\\\\",STRING_NULL,$item)*/$item,true));
   		$interfaceDivTagContainer0->add($intText1);
   		
   	  if($ind=="dataFields")
   	  {
   	   $intSpan4 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
   	   $intSpan4->setTagBody(">>");
   	   $intSpan4->setAttribs(array("id"=>$intSpan4->getId(),
   	   "title"=>LABEL_GESTIONE_CAMPI,
   	   "style"=>"font-size:10pt;cursor:pointer;color:white",
   	   "onclick"=>"span_dataFields_onClick(this);"));
   	   $intSpan3 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
   	   $intSpan3->setTagBody(ENTITY_SPACE . ENTITY_SPACE);
   	   $interfaceDivTagContainer0->add($intSpan3);
   	   $interfaceDivTagContainer0->add($intSpan4);
   	  }
   	  $intBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);  	
   		$interfaceDivTagContainer0->add($intBr3);
   		$intBr4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
   		$interfaceDivTagContainer0->add($intBr4);
   		   		
   		if(($ind=="dataFields")||
   		($ind=="dataFieldsDomains")||
   		($ind=="dataFieldsDomainsValues"))
   		{
   		 $interfaceHtmlDataTemplate1 = Creator::create(Interfaces_info::INT_HTML_DATA_TEMPLATE,STRING_NULL);
       $interfaceHtmlDataTemplate1->setDataFields(array(FIELD_TEMP_1,FIELD_TEMP_2));
       $interfaceHtmlDataTemplate1->setDataFieldsDomains(
       array(Int_domain::FIELD_DOMAIN_ATOMIC_STATIC,Int_domain::FIELD_DOMAIN_ATOMIC_STATIC));
       $interfaceHtmlDataTemplate1->setHtmlTemplate("<div id=\"{TEMP_1}_menu_id\" dojoType=\"dijit.Menu\" targetNodeIds=\"{TEMP_1}\" style=\"display:none\" >" .
       "{TEMP_2}</div>");  
   		 $interfaceHtmlDataTemplate1->setDataFieldDomainValueByPos(0,$ind);
   		}
   		if($ind=="dataFields")
   		{
   			$fieldDomainValue=STRING_NULL;
   			if(isset($objNodeFields))
   			 $fields = $objNodeFields;
   			else
   			 $fields = $item;
   			foreach($fields as $field)
   			{
   			 $fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,$field);
   		  }
   		  if($fieldDomainValue==STRING_NULL)
   		   $fieldDomainValue=self::getDojoMenuItemStr($ind,STRING_NULL);
   		  $interfaceHtmlDataTemplate1->setDataFieldDomainValueByPos(1,$fieldDomainValue);
   		}
   		elseif($ind=="dataFieldsDomains")
   		{
   			$fieldDomainValue = STRING_NULL;
   			$fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_ATOMIC);
   			$fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_ATOMIC_STATIC);
   			$fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_SET);
   			$fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_OBJ);
			$fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_FUNCTION);
            $fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_STRING_PHP_CODE);
   			$fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_TABLE);
   			$fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_TABLE_NO_LOOKUP);
   			$fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_TABLE_UNIQUE_VAL);
   			  $fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_STATIC_TEXT);
        if(($items["type"]==Interfaces_info::INT_FORM)||
        ($items["type"]==Interfaces_info::INT_FORM_2)||
        ($items["type"]==Interfaces_info::INT_FORM_SECTION)||
		($items["type"]==Interfaces_info::INT_HTML_INPUT_CTRL))
         {
   			  $fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_CHECK);
   			  $fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_RADIO);
   			  $fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_MULTIPLE);
   			  $fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_HIDDEN);
   			  $fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_PASSWORD);
   			  $fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,Int_domain::FIELD_DOMAIN_FILE);
         }
   		 $interfaceHtmlDataTemplate1->setDataFieldDomainValueByPos(1,$fieldDomainValue);
   		}
   		elseif($ind=="dataFieldsDomainsValues")
   		{
   			$fieldDomainValue=STRING_NULL;
   			$newInterfacesFiles = self::filterInterfacesFiles($interfaccia,$interfacesFiles);
   	    foreach ($newInterfacesFiles as $interfaceFile)
   	    {
   	     $fileItems = preg_split(STRING_SLASH . self::INTERFACE_NAME_SEP . STRING_SLASH,$interfaceFile);
   	     if(($fileItems[0] != STANDARD_MOD_PREFIX)&&($interfaceFile != $interfaccia))
   	     {
   			 $fieldDomainValue = $fieldDomainValue . self::getDojoMenuItemStr($ind,$interfaceFile);
   	     }
   	    }
   		 $interfaceHtmlDataTemplate1->setDataFieldDomainValueByPos(1,$fieldDomainValue);
   		}
   		if(($ind=="dataFields")||($ind=="dataFieldsDomains")||($ind=="dataFieldsDomainsValues"))
   	  $interfaceDivTagContainer0->add($interfaceHtmlDataTemplate1);  
	}
}

// Container
class PutBody_container extends PutBody_base
{
	private $intSelectContainer=null;
	private $nomePagina=STRING_NULL;
	private $intSelectTag=null;
	private $scope=STRING_NULL;


	function __construct(string $actInd,object $item,Interfaces_container $actDivTagContainer)
	{
		parent::__construct($actInd,$item,$actDivTagContainer);
	}
	
    function setScope(string $actScope):void
    {
  	 $this->scope = $actScope;
    }
	
	function getScope():string
	{
		return $this->scope;
	}
	
	function getIntSelectContainer():Interfaces_container
	{
		return $this->intSelectContainer;
	}
	
	function setIntSelectContainer(Interfaces_container $actIntSelectContainer):void
	{
		$this->intSelectContainer = $actIntSelectContainer;
	}
	
	function getNomePagina():string
	{
		return $this->nomePagina;
	}
	
	function setNomePagina(string $actNomePagina):void
	{
		$this->nomePagina = $actNomePagina;
	}
	
	function getIntSelectTag():Html_select_tag
	{
		return $this->intSelectTag;
	}
	
	function setIntSelectTag(Html_select_tag $actIntSelectTag):void
	{
		$this->intSelectTag = $actIntSelectTag;
	}
	
 static function filterSelectContainer(string $actIntStr,Interfaces_container $actIntCont):Interfaces_container
 {
  $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
 	$int_iter = $actIntCont->create();
 	$newIntCont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
  $parents = Xml_interface_serializer::getFamilyParents($appName,$actIntStr);
 	$parents1 = Xml_interface_serializer::getInterfacesContainerParents($appName,$actIntStr);
 	$parents2=array_assoc_concat($parents,$parents1);
 	$parents2=array_unique($parents2);
 	$parents2=array_values($parents2);
 	while($int_iter->hasMore())
 	{
 		$int = $int_iter->current();
 		$intName = $int->getTagBody();
 		if(! in_array($intName,$parents2))
 		 $newIntCont->add($int);
 	  $int_iter->next();
 	}
 	$int_iter->reset();
 	return $newIntCont;
 }
	
	function exec():void
	{	
		$ind = $this->getInd();
		$item = $this->getItem();
		$interfaceDivTagContainer0 = $this->getDivTagContainer();
    $interfacesSelectContainer4 = $this->getIntSelectContainer();
    $nomePagina = $this->getNomePagina();
    $k = $this->getSelectCounter();
    $interfaceSelectTag1 = $this->getIntSelectTag();

		 $interfaccia = $_GET["Interfaccia"]; 
		
		 $intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL); 
     $attribs3 = array("for" =>$ind);
     $intLabel1->setTagBody(strComplete(ucFirst($ind),ENTITY_SPACE,20));
     $intLabel1->setAttribs($attribs3);
     $intHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL);
     $intHtmlFragment1->setHtmlFragment(ENTITY_SPACE . ENTITY_SPACE); 
     $intHtmlFragment1->setDivEnvelope(false);  
     $interfaceSelectTag2 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL); 
     $attribs4 = array("name" => $ind,"id" => $ind,"class"=>"container",
     "dojoType"=>"dojo.dnd.Source");
     $interfaceSelectTag2->setAttribs($attribs4);
     $interfacesSelectContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   	 $intIter = $item->create();
	// print_r($item);
   	 $objNames = array();
	 $scope = $this->getScope();
   	 $l=0;
   	 while ($intIter->hasMore())
   	 {
   	 	$objName = $intIter->current();
		//print_r( $objName);
		if(is_a($objName,$scope . STRING_BACKSLASH . INTERFACE_AS_STRING_CLASS))
		 $objName = $objName->getItemName();
   	 	if(array_key_exists($objName,$objNames))
   	 	{
   	 	 $objNameInd = $objName . VAR_SEP . $l;
   	 	 $objNames[$objNameInd] = $objName;
   	 	 $l++;
   	 	}
   	 	else
   	   $objNames[$objName] = $objName;
   	  $intIter->next();
   	 }
   	 foreach($objNames as $ind2=>$objName)
     {
     	$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
    	$attribs2 = array("value"=>(is_string($ind2)?($ind2):($ind2->getCompleteInterfaceId())));
   	  $interfaceOptionTag->setTagBody($objName);
   	  $interfaceOptionTag->setAttribs($attribs2);
   	  $interfacesSelectContainer2->add($interfaceOptionTag);
     }
     
     $interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
     $attribs2 = array();
   	 $interfaceOptionTag->setTagBody(STRING_NULL);
   	 $interfaceOptionTag->setAttribs($attribs2);
   	 $interfacesSelectContainer2->add($interfaceOptionTag);
   	 
   	 $intButton2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
   	 $intButton2->setTagBody(LABEL_EDIT);
   	 $intButton2->setAttribs(array("onclick"=>"button_container_onClick(this)","type"=>"button"));
   	 
   	 $intSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
   	 $intSpan1->setTagBody(ENTITY_SPACE . ENTITY_SPACE);
   	 
   	 $intSpan2 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
   	 $intSpan2->setTagBody(">>");
   	 $intSpan2->setAttribs(array("id"=>$intSpan2->getId(),
   	 "title"=>LABEL_GESTIONE_CONTENITORE,
   	 "style"=>"font-size:10pt;cursor:pointer;color:white",
   	 "onclick"=>"span_container_onClick(this);"));
   	   
   	 $intLabel2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);  	 
     $attribs5 = array("for" =>"select" . VAR_SEP . $k);
     $intLabel2->setTagBody(LABEL_INTERFACCE);
     $intLabel2->setAttribs($attribs5);
     $interfaceSelectTag1bCont = self::filterSelectContainer($interfaccia,$interfacesSelectContainer4);

     if($nomePagina != STRING_NULL)
     {
      $interfaceSelectTag1b = clone $interfaceSelectTag1;
      $interfaceSelectTag1b->setInterfacesContainer($interfaceSelectTag1bCont);      
     }
     else
     {
     	//echo $k;
     	$interfaceSelectTag1b = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
      $interfaceSelectTag1b->setInterfacesContainer($interfaceSelectTag1bCont);
     } 
     
     $attribs6 = $interfaceSelectTag1b->getAttribs();
     $attribs6["name"] = "select" . VAR_SEP . $k;
     $attribs6["id"] = "select" . VAR_SEP . $k;
     $attribs6["dojoType"] = "dojo.dnd.Source";
     $attribs6["onchange"] = "lista_interfacce_2_onChange(this);";
     $interfaceSelectTag1b->setAttribs($attribs6);     
     $interfacesSelectTag1bContainer = $interfaceSelectTag1b->getInterfacesContainer();
     $interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
     $attribs3 = array("value"=>STRING_NULL,"selected"=>STRING_NULL,"class"=>"dojoDndItem");
   	 $interfaceOptionTag->setTagBody(STRING_NULL);
   	 $interfaceOptionTag->setAttribs($attribs3);
   	 $interfacesSelectTag1bContainer->add($interfaceOptionTag);
   	   
   	 $interfaceImg1 = Creator::create(Interfaces_info::INT_HTML_IMG_TAG,STRING_NULL);	 
     $interfaceImg1->setAttribs(array("src"=>"./img/trasf.gif",
     "style"=>"float:left;cursor:pointer;","title"=>LABEL_IMPOSTA_INTERFACCIA,
     "onclick"=>"select_container_interfaces($k,'$ind');"));
     
     $intBr5 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
     $intBr6 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
     $intBr7 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);  
     $intBr8 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL); 
     $intBr9 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
     $intBr10 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);    
     $interfaceSelectTag2->setInterfacesContainer($interfacesSelectContainer2);
     $intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
   	 $intDivTag2->setAttribs(array("id"=>$intDivTag2->getId(),"style"=>"padding:5px"));
     $intDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
     $intDivTagContainer2->add($interfaceImg1);
     $intDivTagContainer2->add($intLabel1);
     $intDivTagContainer2->add($intHtmlFragment1);
     $intDivTagContainer2->add($interfaceSelectTag2);
     $intDivTagContainer2->add($intButton2);
     $intDivTagContainer2->add($intSpan1);
     $intDivTagContainer2->add($intSpan2);
     $intDivTagContainer2->add($intHtmlFragment1);
     $intDivTagContainer2->add($intBr5);
     $intDivTagContainer2->add($intBr6);
     $intDivTagContainer2->add($intLabel2);
     $intDivTagContainer2->add($intHtmlFragment1);
     $intDivTagContainer2->add($interfaceSelectTag1b);
     $intDivTagContainer2->add($intBr7);
     $intDivTagContainer2->add($intBr8);
     $intDivTag2->setInterfacesContainer($intDivTagContainer2);
     $intDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2); 
     $intDivTag2->setDispFields(array(LABEL_RIEMPI_CONTENITORE));   
     $interfaceDivTagContainer0->add($intDec1);  
     $interfaceDivTagContainer0->add($intBr9);
     $interfaceDivTagContainer0->add($intBr10);  
     
	}
	
}

// Obj_node o Data_source
class PutBody_data_source extends PutBody_base
{
	private $dbStructTree=null;
	private $dbQueriesContainer=null;
	private $appDir=STRING_NULL;
	private $scope=STRING_NULL;
	private $intHtmlFragment=null;

	function __construct(string $actInd,object $item,Interfaces_container $actDivTagContainer)
	{
		parent::__construct($actInd,$item,$actDivTagContainer);
	}
	
	function setAppDir(string $actAppDir):void
	{
		$this->appDir = $actAppDir;
	}
	
	function getAppDir():string
	{
		return $this->appDir;
  } 
  
  function setScope(string $actScope):void
  {
  	$this->scope = $actScope;
  }
	
	function getScope():string
	{
		return $this->scope;
	}

//
// Argomento di tipo object per funzionare su namespaces diversi
//	
	function setDbStructTree(object $actDbStructTree):void
	{
		$this->dbStructTree = $actDbStructTree;
	}
	
	function getDbStructTree():object
	{
		return $this->dbStructTree;
	}
	
	function setDbQueriesContainer(object $actDbQueriesContainer):void
	{
		$this->dbQueriesContainer = $actDbQueriesContainer;
	}
	
	function getDbQueriesContainer():object
	{
		return $this->dbQueriesContainer;
	}
	
	function getIntHtmlFragment():Html_fragment
	{
		return $this->intHtmlFragment;
	}
	
	function setIntHtmlFragment(Html_fragment $actIntHtmlFragment):void
	{
		$this->intHtmlFragment = $actIntHtmlFragment;
	}
	
	function exec():void
	{
		
		$ind = $this->getInd();
		$item = $this->getItem();
    $appDir = $this->getAppDir();
    $scope = $this->getScope();
    $intHtmlFragment1 = $this->getIntHtmlFragment();
    $k = $this->getSelectCounter();

   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   
   $intBr1 = new Html_br_tag();

   $scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
   $className1 = $scope . STRING_BACKSLASH . GNODE_CLASS;
   $className2 = $scope . STRING_BACKSLASH . DB_ITEM_CLASS;
   $className3 = $scope . STRING_BACKSLASH . XML_NODE_CLASS;
   $className4 = $scope . STRING_BACKSLASH . JSON_NODE_CLASS;
   $className5 = $scope . STRING_BACKSLASH . INTERFACES_CONTAINER_CLASS;
   $className6 = $scope . STRING_BACKSLASH . CONTAINER_CLASS;
   $className7 = $scope . STRING_BACKSLASH . GENERIC_INTERFACE_CLASS;

		$interfaceDivTagContainer0 = $this->getDivTagContainer();
		$dbStructTree = $this->getDbStructTree();
		$dbQueriesContainer = $this->getDbQueriesContainer();
		
		 $interfaceImg1 = Creator::create(Interfaces_info::INT_HTML_IMG_TAG,STRING_NULL);
     $interfaceImg1->setAttribs(array("src"=>"./img/trasf.gif",
     "style"=>"float:left;cursor:pointer;","title"=>LABEL_IMPOSTA_NODO,
     "onclick"=>
     "\$('#$ind').get(0).value = \$('#select_$k').val();"));
     
   	 if(is_a($item,$className2))
   	 {
   	   $objName = $item->getAliasName();
   	 }
   	 else
   	 {
   	  $objName = $item->getName();
   	 }
   	 $objNodeFields = $item->getFields();
     $this->setFields($objNodeFields);
     
     $intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
     $attribs = $intLabel1->getAttribs();
     $attribs["for"] = ((is_string($ind))?($ind):
     ($ind->toString()));
     $intLabel1->setTagBody(ucFirst($ind) . "Node");
     $intLabel1->setAttribs($attribs);
     $interfaceDivTagContainer0->add($intHtmlFragment1);
   	 $intInput1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
   	 $attribs2 = $intInput1->getAttribs();
   	 $attribs2["id"] = ((is_string($ind))?($ind):
     ($ind->toString()));
   	 $attribs2["name"] = "GNode";
   	 if($objName==STRING_NULL)
   	 {
   	  $attribs2["value"] = "OBJ_NONE";
   	  $len=15;
   	 }
   	 else
   	 {
   	  $attribs2["value"] = $objName;
   	  $len = strlen($objName)+10;
   	 }
   	 $attribs2["type"] = "text";
   	 $attribs2["size"] = (string)$len;
   	 $intInput1->setAttribs($attribs2);
   	
   	 $intButton1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
   	 $intButton1->setTagBody(LABEL_EDIT);
   	 $intButton1->setAttribs(array("onclick"=>"button_obj_onClick()","type"=>"button"));
   	
   	 $nodesContainerIter = $dbStructTree->create();
     
     $intLabel2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
     $attribs3 = array("for" =>"select" . VAR_SEP . $k);
     $intLabel2->setTagBody(LABEL_NODI_DISPONIBILI);
     $intLabel2->setAttribs($attribs3);
     $intHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_1);
     $intHtmlFragment1->setHtmlFragment(ENTITY_SPACE . ENTITY_SPACE); 
     $intHtmlFragment1->setDivEnvelope(false);  
     $interfaceSelectTag3 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
     $attribs4 = array("name" => "select" . VAR_SEP . $k,"id" => "select" . VAR_SEP . $k ,
     "onchange" => "select_nodes_onChange(this,'$ind');");
     $interfaceSelectTag3->setAttribs($attribs4);   	 
     $interfacesSelectContainer3 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   	 
   	 $objNames1 = array();
   	 $objNames1["OBJ_NONE"] = "OBJ_NONE";
   	 while ($nodesContainerIter->hasMore())
   	 {
   	 	$obj = $nodesContainerIter->current();
   	 	$objName = $obj->getAliasName();
   	  $objNames1[$objName] = $objName;   	  
   	  $nodesContainerIter->next();
   	 }
   	 
   	 $queriesContainerIter = $dbQueriesContainer->create();
   	 $queriesContainerIter->reset();
   	 while ($queriesContainerIter->hasMore())
   	 {
   	 	$query = $queriesContainerIter->current();
   	 	$queryName = $query->getAliasName();
   	  $objNames1[$queryName] = $queryName;   	  
   	  $queriesContainerIter->next();
   	 }   	 
   	 
   	 $objNames2 = Xml_db_model::addAllXmlNodeDataSourceNames($appName,$objNames1);
   	 $objNames1 = Xml_db_model::addAllJsonNodeDataSourceNames($appName,$objNames2);
   	 foreach($objNames1 as $ind1=>$objName)
     {
     	$interfaceOptionTag = Creator::create(getClassNameForCreate(HTML_OPTION_TAG_CLASS),STRING_NULL);
    	$attribs5 = array("value"=>(is_string($objName)?$objName:($objName->toString())));
   	  $interfaceOptionTag->setTagBody(strComplete(ucFirst(
   	  $ind1),ENTITY_SPACE,20));
   	  $interfaceOptionTag->setAttribs($attribs5);
   	  $interfacesSelectContainer3->add($interfaceOptionTag);
     }
     $interfaceOptionTag = Creator::create(getClassNameForCreate(HTML_OPTION_TAG_CLASS),STRING_NULL);
     $attribs6 = array();
   	 $interfaceOptionTag->setTagBody(STRING_NULL);
   	 $interfaceOptionTag->setAttribs($attribs6);
   	 $interfacesSelectContainer3->add($interfaceOptionTag);  	 

     $intBr7 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
     $intBr8 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);  	 
   	 $interfaceSelectTag3->setInterfacesContainer($interfacesSelectContainer3);
   	 $intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
   	 $intDivTag2->setAttribs(array("id"=>$intDivTag2->getId(),"style"=>"padding:5px"));
     $intDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
     $intDivTagContainer2->add($interfaceImg1);
     $intDivTagContainer2->add($intLabel1);
     $intDivTagContainer2->add($intHtmlFragment1);
     $intDivTagContainer2->add($intInput1);
     $intDivTagContainer2->add($intButton1);
     $intDivTagContainer2->add($intHtmlFragment1);
     $intDivTagContainer2->add($intBr7);
     $intDivTagContainer2->add($intBr8);
     $intDivTagContainer2->add($intLabel2);
     $intDivTagContainer2->add($intHtmlFragment1);
     $intDivTagContainer2->add($interfaceSelectTag3); 
     $intDivTag2->setInterfacesContainer($intDivTagContainer2);
     $intDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2);
     $intDivTag2->setDispFields(array(LABEL_SCEGLI_OGGETTO_NODO));      		
   	 $interfaceDivTagContainer0->add($intDec1); 
   	 $interfaceDivTagContainer0->add($intBr1);  			
	}
}


// Tipo campo htmlFragment
class PutBody_htmlFragment extends PutBody_base
{
  private $intHtmlFragment=null;
  
	function __construct(string $actInd,string $item,Interfaces_container $actDivTagContainer)
	{
		parent::__construct($actInd,$item,$actDivTagContainer);
	}
	
	function getIntHtmlFragment():Html_fragment
	{
		return $this->intHtmlFragment;
	}
	
	function setIntHtmlFragment(Html_fragment $actIntHtmlFragment):void
	{
		$this->intHtmlFragment = $actIntHtmlFragment;
	}	
	
	function exec():void
	{
		$ind = $this->getInd();
		$item = $this->getItem();
		$interfaceDivTagContainer0 = $this->getDivTagContainer();
		$intHtmlFragment1 = $this->getIntHtmlFragment();
		$intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);

    $attribs = $intLabel1->getAttribs();
    $attribs["for"] = $ind;
    $indLen = strLen($ind);
    $label = substr($ind,1,$indLen-1);
    $intLabel1->setTagBody(strComplete(ucFirst($label),ENTITY_SPACE,20));
    $intLabel1->setAttribs($attribs);
    $intDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
    $attribs = array("style"=>"float:left;width:180px;overflow:auto;");
    $intDiv1->setAttribs($attribs);
    $intDivContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $intDiv1->setInterfacesContainer($intDivContainer);
    $intDiv1->getInterfacesContainer()->add($intLabel1);
    $interfaceDivTagContainer0->add($intDiv1);
    $interfaceDivTagContainer0->add($intHtmlFragment1);
   	$intText1 = Creator::create(getClassNameForCreate(HTML_TEXTAREA_TAG_CLASS),STRING_NULL);	
   	$attribs2 = array(); 
   	$attribs2["rows"] = "10";
   	$attribs2["cols"] = "35";
   	$attribs2["id"] = $ind;
   	$attribs2["name"] = $ind;
   	$intText1->setAttribs($attribs2); 		
   	$intText1->setTagBody($item);
   	$interfaceDivTagContainer0->add($intText1);

  	 $intSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
   	 $intSpan1->setTagBody(ENTITY_SPACE . ENTITY_SPACE);
	
	$intSpan2 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
   	$intSpan2->setTagBody(">>");
   	$intSpan2->setAttribs(array("id"=>$intSpan2->getId(),
   	 "style"=>"font-size:10pt;cursor:pointer;color:white",
   	 "onclick"=>"htmlFragment_span_container_onClick(this);"));
	$interfaceDivTagContainer0->add($intSpan1);
	$interfaceDivTagContainer0->add($intSpan2);
	
   	$intBr9 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);	
   	$interfaceDivTagContainer0->add($intBr9);
   	$intBr10 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);	
   	$interfaceDivTagContainer0->add($intBr10);   		
	}
}


// Tipo At @
class PutBody_at extends PutBody_base
{
  private $intHtmlFragment=null;
  
	function __construct(string $actInd,string $item,Interfaces_container $actDivTagContainer)
	{
		parent::__construct($actInd,$item,$actDivTagContainer);
	}
	
	function getIntHtmlFragment():Html_fragment
	{
		return $this->intHtmlFragment;
	}
	
	function setIntHtmlFragment(Html_fragment $actIntHtmlFragment):void
	{
		$this->intHtmlFragment = $actIntHtmlFragment;
	}	
	
	function exec():void
	{
		$ind = $this->getInd();
		$item = $this->getItem();
		$interfaceDivTagContainer0 = $this->getDivTagContainer();
		$intHtmlFragment1 = $this->getIntHtmlFragment();
		$intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
    $attribs = $intLabel1->getAttribs();
    $attribs["for"] = $ind;
    $indLen = strLen($ind);
    $label = substr($ind,1,$indLen-1);
    $intLabel1->setTagBody(strComplete(ucFirst($label),ENTITY_SPACE,20));
    $intLabel1->setAttribs($attribs);
    $intDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
    $attribs = array("style"=>"float:left;width:180px;overflow:auto;");
    $intDiv1->setAttribs($attribs);
    $intDivContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $intDiv1->setInterfacesContainer($intDivContainer);
    $intDiv1->getInterfacesContainer()->add($intLabel1);
    $interfaceDivTagContainer0->add($intDiv1);
    $interfaceDivTagContainer0->add($intHtmlFragment1);
   	$intText1 = Creator::create(getClassNameForCreate(Classes_info::HTML_TEXTAREA_TAG_CLASS),STRING_NULL);	
   	$attribs2 = array(); 
   	$attribs2["rows"] = "10";
   	$attribs2["cols"] = "35";
   	$attribs2["id"] = $ind;
   	$attribs2["name"] = $ind;
   	$intText1->setAttribs($attribs2); 		
   	$intText1->setTagBody($item);
   	$interfaceDivTagContainer0->add($intText1);
   	$intBr9 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);	
   	$interfaceDivTagContainer0->add($intBr9);
   	$intBr10 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);	
   	$interfaceDivTagContainer0->add($intBr10);   		
	}
}

// Tipo Star *
class PutBody_star extends PutBody_base
{
	private $intHtmlFragment = null;
	
	function __construct(string $actInd,string $item,Interfaces_container $actDivTagContainer)
	{
   parent::__construct($actInd,$item,$actDivTagContainer);
	} 
	
	function getIntHtmlFragment():Html_fragment
	{
		return $this->intHtmlFragment;
	}
	
	function setIntHtmlFragment(Html_fragment $actIntHtmlFragment):void
	{
		$this->intHtmlFragment = $actIntHtmlFragment;
	}	
	
	function exec():void
	{
		$ind = $this->getInd();
		$interfaceDivTagContainer0 = $this->getDivTagContainer();
		$intHtmlFragment1 = $this->getIntHtmlFragment();
		$item = $this->getItem();
		$intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
    $attribs = $intLabel1->getAttribs();
    $attribs["for"] = $ind;
    $indLen = strLen($ind);
    $label = substr($ind,1,$indLen-1);
    $intLabel1->setTagBody(strComplete(ucFirst($label),ENTITY_SPACE,20));
    $intLabel1->setAttribs($attribs);
    $intDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
    $attribs = array("style"=>"float:left;width:180px;overflow:auto;");
    $intDiv1->setAttribs($attribs);
    $intDivContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $intDiv1->setInterfacesContainer($intDivContainer);
    $intDiv1->getInterfacesContainer()->add($intLabel1);
    $interfaceDivTagContainer0->add($intDiv1);
    $interfaceDivTagContainer0->add($intHtmlFragment1);
   	$intInput1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
   	$attribs2 = array(); 
   	$attribs2["type"] = "checkbox";
   	$attribs2["id"] = $ind;
   	if($item=="true")
   	 $attribs2["checked"] = "checked";
   	$attribs2["name"] = $ind;
   	$intInput1->setAttribs($attribs2); 		
   	$interfaceDivTagContainer0->add($intInput1);
   	$intBr9 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);	
   	$interfaceDivTagContainer0->add($intBr9);
    $intBr10 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);   		
   	$interfaceDivTagContainer0->add($intBr10);   		
  }
}

// Decorated object
class PutBody_object extends PutBody_base
{
	private $intHtmlFragment=null;
	private $interfacesFiles=array();

	function __construct(string $actInd,string $item,Interfaces_container $actDivTagContainer)
	{
		parent::__construct($actInd,$item,$actDivTagContainer);
	}
	
  function getInterfacesFiles():array
  {
  	return $this->interfacesFiles;
  }
  
  function setInterfacesFiles(array $actInterfacesFiles):void
  {
  	$this->interfacesFiles = $actInterfacesFiles;
  }	
	
	function getIntHtmlFragment():Html_fragment
	{
		return $this->intHtmlFragment;
	}
	
	function setIntHtmlFragment(Html_fragment $actIntHtmlFragment):void
	{
		$this->intHtmlFragment = $actIntHtmlFragment;
	}	
	
	function exec():void
	{
		$ind = $this->getInd();
		$item = $this->getItem();
		$interfaceDivTagContainer0 = $this->getDivTagContainer();
		$intHtmlFragment1 = $this->getIntHtmlFragment();
		$interfacesFiles = $this->getInterfacesFiles();
	  $interfaccia = $_GET["Interfaccia"]; 
		$intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
    $attribs = $intLabel1->getAttribs();
    $attribs["for"] = $ind;
    $intLabel1->setTagBody(strComplete(ucFirst($ind),ENTITY_SPACE,20));
    $intLabel1->setAttribs($attribs);
    $intDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
    $attribs = array("style"=>"float:left;width:180px;overflow:auto;");
    $intDiv1->setAttribs($attribs);
    $intDivContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $intDiv1->setInterfacesContainer($intDivContainer);
    $intDiv1->getInterfacesContainer()->add($intLabel1);
    $interfaceDivTagContainer0->add($intDiv1);
    $interfaceDivTagContainer0->add($intHtmlFragment1);
   	$intInput1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
   	$attribs2 = $intInput1->getAttribs();
   	$attribs2["value"] = ((is_string($item))?($item):
     ($item->getCompleteInterfaceId()));
   	$attribs2["id"] = $ind;
   	$attribs2["name"] = $ind;
   	$intInput1->setAttribs($attribs2);
   	$interfaceDivTagContainer0->add($intInput1); 
   	$intBr11 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
   	$interfaceDivTagContainer0->add($intBr11);
   	$intBr12 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
   	$interfaceDivTagContainer0->add($intBr12);
    $intHtmlDataTemplate2 = Creator::create(Interfaces_info::INT_HTML_DATA_TEMPLATE,STRING_NULL);
    $intHtmlDataTemplate2->setDataFields(array(FIELD_TEMP_1,FIELD_TEMP_2));
    $intHtmlDataTemplate2->setDataFieldsDomains(
      array(Int_domain::FIELD_DOMAIN_ATOMIC_STATIC));
    $intHtmlDataTemplate2->setHtmlTemplate("<div id=\"{TEMP_2}_menu_id\" dojoType=\"dijit.Menu\" targetNodeIds=\"{TEMP_2}\" style=\"display:none\" >" .
      "{TEMP_1}</div>"); 
    $intHtmlDataTemplate2->setDataFieldDomainValueByPos(1,$ind);
    $fieldDomainValue=STRING_NULL;
    foreach($interfacesFiles as $interfaceFile)
    {
   	 $fileItems = preg_split(STRING_SLASH . Xml_interface_serializer::INTERFACE_NAME_SEP . STRING_SLASH,$interfaceFile);
   	 if(($fileItems[0] != STANDARD_MOD_PREFIX)&&($interfaceFile != $interfaccia))
   	 {
   	  $fieldDomainValue = $fieldDomainValue . 
   			 "<div dojoType=\"dijit.MenuItem\">" . $interfaceFile . 
   			 "<script type=\"dojo/method\" event=\"onClick\" args=\"evt\">" .
   			 "document.getElementById('" . $ind . "').value='" . $interfaceFile . "';" .
         "</script></div>";
      }
     }
     $intHtmlDataTemplate2->setDataFieldDomainValueByPos(0,$fieldDomainValue); 
     $interfaceDivTagContainer0->add($intHtmlDataTemplate2);	   		
	}
}


// Otherwise
class PutBody_otherwise extends PutBody_base
{
	private $appDir=STRING_NULL;
	private $scope=STRING_NULL;
	private $intHtmlFragment=null;

	function __construct(string $actInd,string|int $item,Interfaces_container $actDivTagContainer)
	{
		parent::__construct($actInd,$item,$actDivTagContainer);
	}
	
	function setAppDir(string $actAppDir):void
	{
		$this->appDir = $actAppDir;
	}
	
	function getAppDir():string
	{
		return $this->appDir;
  } 
  
  function setScope(string $actScope):void
  {
  	$this->scope = $actScope;
  }
	
	function getScope():string
	{
		return $this->scope;
	}
	
 function setIntHtmlFragment(Html_fragment $actIntHtmlFragment):void
 {
 	$this->intHtmlFragment = $actIntHtmlFragment;
 }
 
 function getIntHtmlFragment():Html_fragment
 {
 	return $this->intHtmlFragment;
 }
	
	function exec():void
	{
		$ind = $this->getInd();
		$item = $this->getItem();
		$interfaceDivTagContainer0 = $this->getDivTagContainer();
    $appDir = $this->getAppDir();
    $scope = $this->getScope();
    $intHtmlFragment1 = $this->getIntHtmlFragment();

   $scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
   $className1 = $scope . STRING_BACKSLASH . GNODE_CLASS;
   $className2 = $scope . STRING_BACKSLASH . DB_ITEM_CLASS;
   $className3 = $scope . STRING_BACKSLASH . XML_NODE_CLASS;
   $className4 = $scope . STRING_BACKSLASH . JSON_NODE_CLASS;
   $className5 = $scope . STRING_BACKSLASH . INTERFACES_CONTAINER_CLASS;
   $className6 = $scope . STRING_BACKSLASH . CONTAINER_CLASS;
   $className7 = $scope . STRING_BACKSLASH . GENERIC_INTERFACE_CLASS; 
	
	 $intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);		
   $attribs = $intLabel1->getAttribs();
   $attribs["for"] = $ind;
   $intLabel1->setTagBody(strComplete(ucFirst($ind),ENTITY_SPACE,20));
   $intLabel1->setAttribs($attribs);
   $intDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
   $attribs = array("style"=>"float:left;width:180px;overflow:auto;");
   $intDiv1->setAttribs($attribs);
   $intDivContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   $intDiv1->setInterfacesContainer($intDivContainer);
   $intDiv1->getInterfacesContainer()->add($intLabel1);
   $interfaceDivTagContainer0->add($intDiv1);
   $interfaceDivTagContainer0->add($intHtmlFragment1);
   $intInput1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);		
   $attribs2 = $intInput1->getAttribs();
   		
   		if(($item===false)||($item===true))
   		{
   		 $attribs2["type"]="checkbox";
   		 if ($item===true)
   		  $attribs2["checked"]=STRING_NULL;
   		}
   		else
   		 $attribs2["type"] = "text";
   		
   		if(is_a($item,$className7))
   		{
   			$interfaceClass = get_class($item);
   			$intClassItems = preg_split("/\//",$interfaceClass);
   			$intClassName = $intClassItems[count($intClassItems)-1];
   		}
   		
   		$attribs2["value"] = 
   		((is_int($item)|is_float($item))?($item . STRING_NULL):((is_string($item)?($item):
   		((is_a($item,$className1)?($item->toString()):(
   		((is_a($item,$className6)?($item->toString()):(
   		((is_a($item,$className7)?($intClassName):(var_dump($item)))))))))))));
   		
   		$attribs2["id"] = $ind;
   		$attribs2["name"] = $ind;
   		
   		if($ind=="shortName")
   		{
   		 $attribs2["onchange"] = "shortName_onChange(this)";
   		 $intLabel2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
       $attribs = $intLabel2->getAttribs();
       $attribs["for"] = "checkbox_IFreeName";
       $intLabel2->setTagBody(" - " . LABEL_USA_COME_NOME_FILE_INTERFACCIA . STRING_COLON);
       $intLabel2->setAttribs($attribs);
   		 $intInput2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
   		 $attribs3 = $intInput2->getAttribs();
   		 $attribs3["type"]="checkbox";
   		 $attribs3["id"] = "checkBox_IFreeName";
   		 if($item != STRING_NULL)
   		  $attribs3["checked"] = STRING_NULL;
   		 $attribs3["value"] = "true";
   		 $attribs3["onClick"] = "checkbox_IFreeName_onClick(this);";
   		 $intInput2->setAttribs($attribs3);
   		 $intInput1->setAttribs($attribs2);
   		 $interfaceDivTagContainer0->add($intInput1);
       $interfaceDivTagContainer0->add($intLabel2);
   		 $interfaceDivTagContainer0->add($intInput2);
   		}
   		elseif($ind=="op")
   		{
   		 $attribs2["onchange"] = "input_op_onChange(this);";
   		 $intInput1->setAttribs($attribs2);
   		 $interfaceDivTagContainer0->add($intInput1);
   		}
   		elseif($ind=="num")
   		{
   		 $attribs2["onchange"] = "input_num_onChange(this);";
   		 $intInput1->setAttribs($attribs2);
   		 $interfaceDivTagContainer0->add($intInput1);
   		}
   		else
   		{
   		 $intInput1->setAttribs($attribs2);
   		 $interfaceDivTagContainer0->add($intInput1);
   		}	
   		
   		$intBr11 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
   		$interfaceDivTagContainer0->add($intBr11);
   		$intBr12 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
   		$interfaceDivTagContainer0->add($intBr12);
   		$intBr13 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
   		$interfaceDivTagContainer0->add($intBr13);   	  

	}
}



class PutBody_factory implements Factory_1
{
	private $item;
	private $ind=STRING_NULL;
	private $scope=STRING_NULL;
	private $dbStructTree=null;
	private $dbQueriesContainer=null;
	private $items=array();
	private $interfaceDivTagContainer=null;
	private $intHtmlFragment=null;
	private $interfacesFiles=array();
	private $intSelectContainer=null;
	private $nomePagina=STRING_NULL;
	private $intSelectTag=null;
	private $selectCounter=0;
	private $fields=array();

	
 function __construct(mixed $actItem,string $actInd,string $actScope)
 {
 	$this->setItem($actItem);
 	$this->setInd($actInd);
 	$this->setScope($actScope);
 }

 function setItem(mixed $actItem)
 {
 	$this->item = $actItem;
 }	
	
 function getItem():mixed
 {
 	return $this->item;
 }
	
 function setInd(string $actInd):void
 {
 	$this->ind = $actInd;
 }
	
 function getInd():string
 {
 	return $this->ind;
 }
 
 function setScope(string $actScope):void
 {
 	$this->scope = $actScope;
 }
 
 function getScope():string
 {
 	return $this->scope;
 }

//
// Argomento di tipo object per funzionare su namespaces diversi
//

 function setDbStructTree(object $actDbStructTree):void
 {
 	$this->dbStructTree = $actDbStructTree;
 }
	
 function getDbStructTree():object
 {
 	return $this->dbStructTree;
 }	
 
 function setDbQueriesContainer(object $actDbQueriesContainer):void
 {
 	$this->dbQueriesContainer = $actDbQueriesContainer;
 }
	
 function getDbQueriesContainer():object
 {
 	return $this->dbQueriesContainer;
 }
 
 function setItems(array $actItems):void
 {
 	$this->items =$actItems;
 }
 
 function getItems():array
 {
 	return $this->items;
 }	
 
 function setDivTagContainer(Interfaces_container $actDivTagContainer):void
 {
 	$this->divTagContainer = $actDivTagContainer;
 }
 
 function getDivTagContainer():Interfaces_container
 {
 	return $this->divTagContainer;
 }
 
 function setAppDir(string $actAppDir):void
 {
 	$this->appDir = $actAppDir;
 }
 
 function getAppDir():string
 {
 	return $this->appDir;
 } 
 
 function setIntHtmlFragment(Html_fragment $actIntHtmlFragment):void
 {
 	$this->intHtmlFragment = $actIntHtmlFragment;
 }
 
 function getIntHtmlFragment():Html_fragment
 {
 	return $this->intHtmlFragment;
 }
 
 function setInterfacesFiles(array $actInterfacesFiles):void
 {
 	$this->interfacesFiles = $actInterfacesFiles;
 }
 
 function getInterfacesFiles():array
 {
 	return $this->interfacesFiles;
 }
 
	function getIntSelectContainer():Interfaces_container
	{
		return $this->intSelectContainer;
	}
	
	function setIntSelectContainer(Interfaces_container $actIntSelectContainer):void
	{
		$this->intSelectContainer = $actIntSelectContainer;
	}
	
	function setNomePagina(string $actNomePagina):void
	{
		$this->nomePagina = $actNomePagina;
	}
	
	function getNomePagina():string
	{
		return $this->nomePagina;
	}
	
	function getIntSelectTag():Html_select_tag
	{
		return $this->intSelectTag;
	}
	
	function setIntSelectTag(Html_select_tag $actSelectTag):void
	{
		$this->intSelectTag = $actSelectTag; 
	}
	
	function setFields(array $actFields):void
	{
		$this->fields = $actFields;
	}
	
	function getFields():array
	{
		return $this->fields;
	}
	
	function getSelectCounter():int
	{
		return $this->selectCounter;
	}
	
	function setSelectCounter(int $actSelectCounter):void
	{
		$this->selectCounter = $actSelectCounter;
	}
	
 function create():mixed
 {
 	
 	$ind = $this->getInd();
 	$item = $this->getItem();
 	$scope = $this->getScope();
 	$dbStructTree = $this->getDbStructTree();
 	$dbQueriesContainer = $this->getDbQueriesContainer();
 	$divTagContainer = $this->getDivTagContainer();
 	$items = $this->getItems();
 	$appDir = $this->getAppDir();
 	$intHtmlFragment = $this->getIntHtmlFragment();
 	$interfacesFiles = $this->getInterfacesFiles();
 	$intSelectContainer = $this->getIntSelectContainer();
 	$nomePagina = $this->getNomePagina();
 	$intSelectTag = $this->getIntSelectTag();
	$selectCounter = $this->getSelectCounter();
 	
   $scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;
   $className1 = $scope . STRING_BACKSLASH . GNODE_CLASS;
   $className2 = $scope . STRING_BACKSLASH . DB_ITEM_CLASS;
   $className3 = $scope . STRING_BACKSLASH . XML_NODE_CLASS;
   $className4 = $scope . STRING_BACKSLASH . JSON_NODE_CLASS;
   $className5 = $scope . STRING_BACKSLASH . INTERFACES_CONTAINER_CLASS;
   $className6 = $scope . STRING_BACKSLASH . GENERIC_CONTAINER_CLASS;
   $className7 = $scope . STRING_BACKSLASH . GENERIC_INTERFACE_CLASS;
   $className8 = $scope . STRING_BACKSLASH . INTERFACE_AS_STRING_CLASS;   
 
 //echo "<{";
 //if(is_object($item))
 //{
 //var_dump($item);
 //echo get_class($item);
 //echo $className6;
 //}
 //die('A');
 //echo "}>";
 //echo "<br>";
  $obj=null;
 	
 	if(is_array($item))
 	{
 		$obj = Creator::create(getClassNameForCreate(Classes_info::PUTBODY_ARRAY_CLASS),STRING_NULL,$ind,$item,$divTagContainer);
 		$obj->setFields($this->getFields());
 		$obj->setItems($items);
 		$obj->setInterfacesFiles($interfacesFiles);
  	$obj->setIntHtmlFragment($intHtmlFragment);
	$obj->setScope($scope);
 	}
 	elseif(is_a($item,$className6))
 	{
 	 $obj = Creator::create(getClassNameForCreate(Classes_info::PUTBODY_CONTAINER_CLASS),STRING_NULL,$ind,$item,$divTagContainer);
 	 $obj->setIntSelectContainer($intSelectContainer);
 	 $obj->setNomePagina($nomePagina);
 	 $obj->setIntSelectTag($intSelectTag);
 	 $obj->setSelectCounter($selectCounter);
	 $obj->setScope($scope); 
 	}
  elseif(is_a($item,$className2) || 
   	is_a($item,$className3) || 
   	is_a($item,$className4)) 	
  {
  	$obj = Creator::create(getClassNameForCreate(Classes_info::PUTBODY_DATA_SOURCE_CLASS),STRING_NULL,$ind,$item,$divTagContainer);
  	$obj->setAppDir($appDir);
  	$obj->setIntHtmlFragment($intHtmlFragment);
 	 $obj->setDbStructTree($dbStructTree);
 	 $obj->setDbQueriesContainer($dbQueriesContainer);
 	 $obj->setFields($this->getFields());
 	 $obj->setSelectCounter($selectCounter);
  }
  elseif($ind==STRING_AT . "htmlFragment") 
  {
  	$obj = Creator::create(getClassNameForCreate(Classes_info::PUTBODY_HTMLFRAGMENT_CLASS),STRING_NULL,$ind,$item,$divTagContainer);
 		$obj->setIntHtmlFragment($intHtmlFragment);
  }	
  elseif(substr($ind,0,1)==STRING_AT) 
  {
  	$obj = Creator::create(getClassNameForCreate(Classes_info::PUTBODY_AT_CLASS),STRING_NULL,$ind,$item,$divTagContainer);
   $obj->setIntHtmlFragment($intHtmlFragment);
  }	
  elseif(substr($ind,0,1)==STRING_STAR)
  {
  	$obj = Creator::create(getClassNameForCreate(Classes_info::PUTBODY_STAR_CLASS),STRING_NULL,$ind,$item,$divTagContainer);
  	$obj->setIntHtmlFragment($intHtmlFragment);
  } 	 	
  elseif(($ind=="decoratedObj")||($ind=="innerInterface")||($ind=="bodyStructTemplate"))	
  //elseif($item,$className7)
  {
  	$obj = Creator::create(getClassNameForCreate(Classes_info::PUTBODY_OBJECT_CLASS),STRING_NULL,$ind,
	//(is_null($item)?STRING_NULL:$item),$divTagContainer);
	$item->getItemName(),$divTagContainer);
		$obj->setIntHtmlFragment($intHtmlFragment);
		$obj->setInterfacesFiles($interfacesFiles);
  }
  elseif(($ind != "pageName")&&($ind != "appName")) 	
 	{
 		$obj = Creator::create(getClassNameForCreate(Classes_info::PUTBODY_OTHERWISE_CLASS),STRING_NULL,$ind,$item,$divTagContainer);
 		$obj->setAppDir($appDir);
 		$obj->setScope($scope); 
 		$obj->setIntHtmlFragment($intHtmlFragment);
 	}
 	
 	return $obj;
 }
	
}


?>