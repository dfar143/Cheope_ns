<?
namespace Cheope_ns\fw;
require_once("filesystem.const.php");
require_once("Serializer.class.php");

//
// Permette serializzazione e deserializzazione generico array
// Php (non object).
// Il nome dei tags è formata da due parti 1)"ind_" 2)<index>
// questo perchè il gestore DOMDocument xml non permette 
// la gestione dei tag numerici
//   

class Csv_serializer extends Serializer
{
	const CSV_DIR = STRING_POINT . STRING_SLASH . CSV_ACRONYM;
	const ITEMS_SEPARATOR = STRING_SEMICOLON;
	const ERROR_1 = "Il file non esiste.";
	
	private $dir = STRING_NULL;

	
	function __construct(string $actFileName=STRING_NULL)
	{
		parent::__construct($actFileName);
	}
	
	function setDir(string $actDir):void
	{
		$this->dir = $actDir;
	}
	
	function getDir():string
	{
		return $this->dir;
	}
	
	function loadItems(array|string $actItems=STRING_NULL):void
	{
	}
	
	function saveData():void
	{
	 $fileName = $this->getFileName();
	 $dir = $this->getDir();
	 
	 $path=((($dir != STRING_NULL)&&(strpos($fileName,DIR_SEP)===false))
	 ?($dir . DIR_SEP . $fileName):($fileName));

     if(! file_exists($path))
     {
      $path = self::CSV_DIR . DIR_SEP . $fileName;
     }
	 else
	  die(self::ERROR_1);
	 	 
    $items = $this->getItems();

    $handle = fopen($path,"wb");
    foreach($items as $line)
    {
     foreach($line as $lineItem)
     {
      $lineItems = preg_split("[" . self::ITEMS_SEPARATOR . "]",$lineItem);
     	fwrite($handle,$lineItem);
     	fwrite($handle,self::ITEMS_SEPARATOR);   	
     }    
     fwrite($handle,STRING_RETURN);
		 fwrite($handle,STRING_LINE_FEED);   
    }
    fclose($handle);
	}
		
	function getRootFields():array
	{
		$items = $this->getItems();
		$rootFields = array();
		$num = count($items[0]);
    if($num>0)
    {
    	for($i=0;$i<=$num-1;$i++)
    	 $rootFields[$i] = STRING_NULL;
    }  
		return $rootFields;
	}
	
	function loadData():void
	{
	 $loadedValues = array();
	 $values = array();
	 $fileName = $this->getFileName();
	 $dir = $this->getDir();
	 $path=(($dir !== STRING_NULL)?($dir . DIR_SEP . $fileName):($fileName));
   
   if(! file_exists($path))
   {
    $path = self::CSV_DIR . DIR_SEP . $fileName;
   }
   
   $ct=0;
   $items = array();
	 $handle = fopen($path,"r");
   while(! feof($handle))
   {
   	$line = fgets($handle);
   	$lineItems = preg_split("[" . self::ITEMS_SEPARATOR . "]",$line);
   	if(count($lineItems)>0)
     $items[$ct++] = $lineItems;
   }
   fclose($handle);
	 $this->setItems($items);
	}
	
}	
	
?>