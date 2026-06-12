<?
namespace Cheope_ns\fw;

trait Caller
{
	public function getOneInSetByName(string $actName):mixed
  {
  	$set = $this->getContents();
  	foreach($set as $one)
  	{
  		if($one->getName()==$actName)
  		{
  			return $one;
  		}
  	}
  	$ret=NULL;
  	return $ret;
  }
  
	public function getOneInContainerByName(string $actName):mixed
  {
		$cont = $this->getContainer();
		$iterator = $cont->create();
		$iterator->reset();
		while($iterator->hasMore())
		{
			$op = $iterator->current();
			if($op->getName()==$actName)
			{
			 return $op;
			} 
			$iterator->next();
		}
		$ret = NULL;
		return $ret;
  }  
  
  public function getSomeInSetByName(string $actName):mixed
  {
  	$set = $this->getContents();
  	$buf = array();
  	$find = false;
  	$ct=0;
  	
  	foreach($set as $one)
  	{
  		if($one->getName()==$actName)
  		{
  			$buf[$ct++] = $one;
  			if(! $find)
  			 $find = true; 
  		}
  	}
  	
  	if(! $find)
  	 $ret=NULL;
  	else
  	 $ret=$buf;
  	 
  	return $ret;
  }
  
  public function getSomeInContainerByName(string $actName):mixed
  {
		$cont = $this->getContainer();
		$iterator = $cont->create();
		$iterator->reset();
		$ct = 0;
		$find = false;
		$buf = array();
		
		while($iterator->hasMore())
		{
			$one = $iterator->current();
			if($one->getName()==$actName)
			{
		   if(! $find)
		   	 $find=true;
			 $buf[$ct++] = $one;
			} 
			$iterator->next();
		}
		
  	if(! $find)
  	 $ret=NULL;
  	else
  	 $ret=$buf;		
		
		return $ret;
  }
  
}




?>