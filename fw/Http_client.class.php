<?
namespace Cheope_ns\fw;
require_once("http.const.php");

define(__NAMESPACE__ . '\DEFAULT_HTTP_CLIENT_HOST',"localhost");
define(__NAMESPACE__ . '\DEFAULT_HTTP_CLIENT_TARGET',STRING_NULL);
define(__NAMESPACE__ . '\DEFAULT_HTTP_CLIENT_PORT',80);
define(__NAMESPACE__ . '\DEFAULT_HTTP_CLIENT_TIMEOUT',160);
define(__NAMESPACE__ . '\DEFAULT_HTTP_CLIENT_PROTOCOL',HTTP_1_0);
define(__NAMESPACE__ . '\DEFAULT_HTTP_CLIENT_ACCEPT_LANG',"it");
define(__NAMESPACE__ . '\DEFAULT_HTTP_CLIENT_USER_AGENT',"Php");
define(__NAMESPACE__ . '\DEFAULT_HTTP_CLIENT_REFERRER',"it000c0007");
define(__NAMESPACE__ . '\DEFAULT_HTTP_CLIENT_CONTENT_TYPE',"application/x-www-form-urlencoded");
define(__NAMESPACE__ . '\HTTP_CLIENT_ERROR_1',STRING_NULL);
define(__NAMESPACE__ . '\DEFAULT_EOF',"\r\n");

class Http_client
{
 const DEFAULT_HTTP_CLIENT_HOST="localhost";
 const DEFAULT_HTTP_CLIENT_TARGET=STRING_NULL;
 const DEFAULT_HTTP_CLIENT_PORT=80;
 const DEFAULT_HTTP_CLIENT_TIMEOUT=160;
 const DEFAULT_HTTP_CLIENT_PROTOCOL=HTTP_1_0;
 const DEFAULT_HTTP_CLIENT_ACCEPT_LANG="it";
 const DEFAULT_HTTP_CLIENT_USER_AGENT="Php";
 const DEFAULT_HTTP_CLIENT_REFERRER="it000c0007";
 const DEFAULT_HTTP_CLIENT_CONTENT_TYPE="application/x-www-form-urlencoded";
 const HTTP_CLIENT_ERROR_1=STRING_NULL;
 const DEFAULT_EOF = "\r\n";

  private $host = STRING_NULL;
  private $target = STRING_NULL;
  private $port = self::DEFAULT_HTTP_CLIENT_PORT;
	private $timeout = self::DEFAULT_HTTP_CLIENT_TIMEOUT;
	private $protocol = STRING_NULL;
	private $eof = self::DEFAULT_EOF;
	private $acceptLang = STRING_NULL;
	private $userAgent = STRING_NULL;
	private $referrer = STRING_NULL;
	private $contentType = STRING_NULL;
	
	function __construct()
	{
	}
	
 	function getHost():string
 	{
 		if($this->host == STRING_NULL)
 		 return self::DEFAULT_HTTP_CLIENT_HOST;
 		else
 		 return $this->host;
 	}
 	
 	function setHost(string $actHost):void
 	{
 		$this->host = $actHost;
 	}
 	
 	function getTarget():string
 	{
 		if($this->target == STRING_NULL)
 		 return self::DEFAULT_HTTP_CLIENT_TARGET;
 		else
 		 return $this->target; 		
 	}
 	
 	function setTarget(string $actTarget):void
 	{
 		$this->target = $actTarget;
 	}
 	
 	function getPort():int
 	{
 	 if($this->port == NO_VALUE)
 	  return self::DEFAULT_HTTP_CLIENT_PORT;
 	 else
    return $this->port;
 	}
 	
 	function setPort(int $actPort):void
 	{
 		$this->port = $actPort;
 	}
 	
 	function getTimeout():int
 	{
 		if($this->timeout == NO_VALUE)
 		 return self::DEFAULT_HTTP_CLIENT_TIMEOUT;
 		else
 		 return $this->timeout;
 	}
 	
 	function setTimeout(int $actTimeout):void
 	{
 		$this->timeout = $actTimeout;
 	}

 	function getProtocol():string
 	{
 		if($this->protocol == STRING_NULL)
 		 return self::DEFAULT_HTTP_CLIENT_PROTOCOL;
 		else
 		 return $this->protocol;
 	}
 	
 	function setProtocol(string $actProtocol):void
 	{
 		$this->protocol = $actProtocol;
 	}
	
	function getEol():string
	{
		if($this->eof == STRING_NULL)
		 return self::DEFAULT_EOF;
		else
		 return $this->eof;
	}
	
	function getAcceptLang():string
	{
		if($this->acceptLang == STRING_NULL)
		 return self::DEFAULT_HTTP_CLIENT_ACCEPT_LANG;
		else
		 return $this->acceptLang;
	}
	
	function setAcceptLang(string $actAcceptLang):void
	{
		$this->acceptLang = $actAcceptLang;
	}
	
	function getUserAgent():string
	{
		if($this->userAgent == STRING_NULL)
		 return self::DEFAULT_HTTP_CLIENT_USER_AGENT;
		else
		 return $this->userAgent;
	}
	
	function getReferrer():string
	{
		if($this->referrer == STRING_NULL)
		 return self::DEFAULT_HTTP_CLIENT_REFERRER;
		else
		 return $this->referrer;
	}
	
	function setReferrer(string $actReferrer):void
	{
		$this->referrer = $actReferrer;
	}
	
	function getContentType():string
	{
		if($this->contentType == STRING_NULL)
		 return self::DEFAULT_HTTP_CLIENT_CONTENT_TYPE;
		else
		 return $this->contentType;
	}
	
	function get():string
	{
	 $br = $this->getEol();
	 $target = $this->getTarget();
	 $port = $this->getPort();
	 $timeout = $this->getTimeout();
	 $protocol = $this->getProtocol();
	 $host = $this->getHost();
	 $acceptLang = $this->getAcceptLang();
	 $userAgent = $this->getUserAgent();
	 $referrer = $this->getReferrer();
	 
	 $sk = fsockopen($host,$port,$errnum,$errstr,$timeout) ; 

   if( ! is_resource($sk))
   { 
    exit(self::HTTP_CLIENT_ERROR_1 . STRING_COLON . $errnum . STRING_SPACE . $errstr) ; 
   } 
   else
   { 	 
    $headers = "GET " . $target . STRING_SPACE . $protocol . $br; 
    $headers .= "Accept: image/gif, image/x-xbitmap, image/jpeg" . $br; 
    $headers .= "Accept-Language: " . $acceptLang . $br; 
    $headers .= "Host: " . $host . $br; 
 //   $headers .= "Connection: Keep-Alive" . $br; 
    $headers .= "User-Agent: " . $userAgent . $br; 
    $headers .= "Referrer: " . $referrer . $br . $br; 
    fputs($sk,$headers); 
    $dati = STRING_NULL; 
    while ( ! feof($sk)) 
    { 
     $dati .= fgets ($sk,2048); 
    } 
   } 
   fclose($sk) ; 
   return $dati;
	}
	
	function post(array $actPostData):string
	{
	 $br = $this->getEol();
	 $target = $this->getTarget();
	 $port = $this->getPort();
	 $timeout = $this->getTimeout();
	 $protocol = $this->getProtocol();
	 $host = $this->getHost();
	 $acceptLang = $this->getAcceptLang();
	 $userAgent = $this->getUserAgent();
	 $referrer = $this->getReferrer();
	 $contentType = $this->getContentType();
	 
	 $sk = fsockopen($host,$port,$errnum,$errstr,$timeout) ; 

   if( ! is_resource($sk))
   { 
    exit(self::HTTP_CLIENT_ERROR_1 . STRING_COLON . $errnum . STRING_SPACE . $errstr) ; 
   } 
   else
   {  
    $req_body = STRING_NULL; 
    foreach($actPostData as $key=>$val)
    { 
     $req_body.= STRING_AMPERSEND . $key . STRING_EQUAL . rawurlencode(htmlentities($val)); 
    } 	 
    $headers = "POST " . $target . STRING_SPACE . $protocol . $br; 
    $headers .= "Accept: image/gif, image/x-xbitmap, image/jpeg" . $br; 
    $headers .= "Accept-Language: " . $acceptLang . $br; 
    $headers .= "Host: " . $host . $br; 
    $headers .= "Connection: Keep-Alive" . $br; 
    $headers .= "User-Agent: " . $userAgent . $br; 
    $headers .= "Referrer: " . $referrer . $br; 
    $headers .= "Content-Type: " . $contentType . $br ;
    $headers .= "Content-Length: "  . strlen($req_body) . $br . $br ; 

    fputs($sk,$headers . $req_body); 
    $dati = STRING_NULL; 
    while ( ! feof($sk)) 
    { 
     $dati .= fgets ($sk,2048); 
    } 
   } 
   fclose($sk) ; 
   return $dati;
	}
	
}

?>