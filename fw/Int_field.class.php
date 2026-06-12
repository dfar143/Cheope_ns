<?
namespace Cheope_ns\fw;
require_once("Interface_data_domains.class.php");

class Int_field 
{
  //const ERROR_1="Int_field:Errore nell'inserimento del dominio.";

	private $name=STRING_NULL;
	private $domain=STRING_NULL;
	private $domainObj=null;
	private $domainValue;
	private $domainKey=STRING_NULL;
		
	function __construct(string $actName=STRING_NULL)
	{
		$this->name = $actName;
	}
	
	function setName(string $actName):void
	{
		$this->name = $actName;
	}

	function getName():string
	{
		return $this->name;
	}
	
	
	function setDomain(string $actDomain):void
	{
		$this->domain = $actDomain;
	}
	
	function getDomain():string
	{
		 return $this->domain;
	}
	
	function setDomainValue($actValue):void
	{
		$this->domainValue = $actValue;
	}
	
	function getDomainValue():mixed
	{
		return $this->domainValue;
	}
	
	function setDomainKey(string $actKey):void
	{
		$this->domainKey = $actKey;
	}
	
	function getDomainKey():string|int
	{
		return $this->domainKey;
	}
	
	function setDomainObj(Int_domain|null $actDomainObj):void
	{
		$this->domainObj = $actDomainObj;
	}


	function getDomainObj():Int_domain|null
	{
		return $this->domainObj;
	}
	
	function sync():void
	{
		$domObj = $this->getDomainObj();
		$domainValue = $domObj->getValue();
		$this->setDomainValue($domainValue);
		$domainKey = $domObj->getKey();
		$this->setDomainKey($domainKey);
	}
	
}




?>