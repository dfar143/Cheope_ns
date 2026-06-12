<?
namespace Cheope_ns\fw;
require_once ("Generic_interface.class.php");
require_once ("cheope_ns.fun.php");


class Cheope_ns_sendmail extends Generic_interface 
{
 
	const ERROR_1 = "Cheope_ns_sendmail:Errore nell'invio dell'email.";
	const DEFAULT_MIMEVERSION = "1.0";
	const DEFAULT_CHARSET = "iso-8859-1";
	const DEFAULT_CONTENT_TYPE = "text/html";
	private $destinatari = array();
	private $oggetto = STRING_NULL;
	private $messaggio = STRING_NULL;
	private $mimeVersion = STRING_NULL;
	private $contentType = STRING_NULL;
	private $charSet = STRING_NULL;
	private $to = array ();
	private $from = STRING_NULL;
	private $cc = STRING_NULL;
	private $bcc = STRING_NULL;
	private static $sendMailsTotNum = 0;
	
	function __construct(string $actOp = OP_NONE, $actNum = STRING_NULL) 
	{
		self::$sendMailsTotNum ++;
		if ($actNum === STRING_NULL)
			$actNum = self::$sendMailsTotNum - 1;
		parent::__construct ( $actOp, self::INT_SENDMAIL, $actNum );
	}
	
	static function getInterfacesTotNum():string|int 
	{
		return self::$sendMailsTotNum;
	}
	
	static function setInterfacesTotNum(int|string $actIntNum):void 
	{
			self::$sendMailsTotNum = $actIntNum + 0;
	}
	
	function isStandard():bool 
	{
		return false;
	}
	
	function action(string $actStr,Interfaces_container $actInterfacesContainer):void
	{
	}
	
	function serialize():void 
	{
	parent::serialize();
 	//$serializer = $this->getSerializer();
	//$this->serialize_props_exec();
	
		//parent::serialize ();
		$serializer = $this->getSerializer ();
		$destinatario = $this->getDestinatari ();
		$item1 = array (
				"destinatario" => $destinatario 
		);
		$serializer->loadItems ( $item1 );
		$oggetto = $this->getOggetto ();
		$item2 = array (
				"oggetto" => $oggetto 
		);
		$serializer->loadItems ( $item2 );
		$messaggio = $this->getMessaggio ();
		$item3 = array (
				"messaggio" => $messaggio 
		);
		$serializer->loadItems ( $item3 );
		$mimeVersion = $this->getMimeVersion ();
		$item4 = array (
				"mimeVersion" => $mimeVersion 
		);
		$serializer->loadItems ( $item4 );
		$contentType = $this->getContentType ();
		$item5 = array (
				"contentType" => $contentType 
		);
		$serializer->loadItems ( $item5 );
		$charSet = $this->getCharSet ();
		$item6 = array (
				"charSet" => $charSet 
		);
		$serializer->loadItems ( $item6 );
		$to = $this->getTo ();
		$item7 = array (
				"to" => $to 
		);
		$serializer->loadItems ( $item7 );
		$from = $this->getFrom ();
		$item8 = array (
				"from" => $from 
		);
		$serializer->loadItems ( $item8 );
		$cc = $this->getCc ();
		$item9 = array (
				"cc" => $cc 
		);
		$serializer->loadItems ( $item9 );
		$bcc = $this->getBcc ();
		$item10 = array (
				"bcc" => $bcc 
		);
		$serializer->loadItems ( $item10 );
	}
	
	function setDestinatari(array $actDestinatari):void
	{
		$this->destinatari = $actDestinatari;
	}
	
	function getDestinatari():array 
	{
		return $this->destinatari;
	}
	
	function setOggetto(string $actOggetto):void
	{
		$this->oggetto = $actOggetto;
	}
	
	function getOggetto():string 
	{
		return $this->oggetto;
	}
	
	function setMessaggio(string $actMessaggio):void 
	{
		$this->messaggio = $actMessaggio;
	}
	
	function getMessaggio():string
	{
		return $this->messaggio;
	}
	
	function setMimeVersion(string $actMimeVersion):void 
	{
		$this->mimeVersion = $actMimeVersion;
	}
	
	function getMimeVersion():string
	{
		if ($this->mimeVersion == STRING_NULL)
			return $this->mimeVersion;
		else
			return self::DEFAULT_MIMEVERSION;
	}
	
	function setContentType(string $actContentType):void 
	{
		$this->contentType = $actContentType;
	}
	
	function getContentType():string
	{
		if ($this->contentType == STRING_NULL)
			return self::DEFAULT_CONTENT_TYPE;
		else
			return $this->contentType;
	}
	
	function setCharset(string $actCharset):void
	{
		$this->charSet = $actCharset;
	}
	
	function getCharset():string
	{
		if ($this->charSet == STRING_NULL)
			return self::DEFAULT_CHARSET;
		else
			return $this->charset;
	}
	
	function setTo(array $actTo):void 
	{
		$this->to = $actTo;
	}
	
	function getTo():array 
	{
		return $this->to;
	}
	
	function setFrom(string $actFrom):void
	{
		$this->from = $actFrom;
	}
	
	function getFrom():string 
	{
		return $this->from;
	}
	
	function setCc(string $actCc):void 
	{
		$this->cc = $actCc;
	}
	
	function getCc():string 
	{
		return $this->cc;
	}
	
	function setBcc(string $actBcc):void 
	{
		$this->bcc = $actBcc;
	}
	
	function getBcc():string 
	{
		return $this->bcc;
	}
	
	function isContainer():bool
	{
		return false;
	}
	
	function isDecorator():bool 
	{
		return false;
	}
	
	function putData():void 
	{
		$destinatari = $this->getDestinatario ();
		
		foreach ( $destinatari as $ind => $val ) 
		{
			if ($i == 0)
				$destinatario = is_numeric ( $ind ) ? $val : ($ind . STRING_OPEN_ANGLE_BRACKET . $val . STRING_CLOSE_ANGLE_BRACKET);
			else
				$destinatario = $destinatario . STRING_COMMA . (is_numeric ( $ind ) ? $val : ($ind . STRING_OPEN_ANGLE_BRACKET . $val . STRING_CLOSE_ANGLE_BRACKET));
			$i ++;
		}
		
		$destinatario = $destinatario . "\r\n";
		
		$oggetto = $this->getOggetto ();
		$messaggio = $this->getMessaggio ();
		
		$mimeVersion = $this->getMimeVersion ();
		$mimeVersion = "MIME-Version" . STRING_COLON . $mimeVersion . "\r\n";
		
		$contentType = $this->getContentType ();
		$contentType = "Content-type" . STRING_COLON . $contentType . STRING_SEMICOLON . "charset" . STRING_EQUAL . $contentType;
		
		$charSet = $this->getCharset () . "\r\n";
		
		$to = $this->getTo ();
		foreach ( $to as $ind => $val ) 
		{
			if ($i == 0)
				$tos = is_numeric ( $ind ) ? $val : ($ind . STRING_OPEN_ANGLE_BRACKET . $val . STRING_CLOSE_ANGLE_BRACKET);
			else
				$tos = $tos . STRING_COMMA . (is_numeric ( $ind ) ? $val : ($ind . STRING_OPEN_ANGLE_BRACKET . $val . STRING_CLOSE_ANGLE_BRACKET));
		}
		
		$tos = "To" . STRING_COLON . $tos;
		
		$from = $this->getFrom ();
		$from = "From" . STRING_COLON . $from . "\r\n";
		
		$cc = $this->getCc ();
		$cc = "Cc" . STRING_COLON . $cc . "\r\n";
		
		$bcc = $this->getBcc ();
		$bcc = "Bcc" . STRING_COLON . $bcc . "r\n";
		
		$intestazioni = $mimeVersion . $contentType . $charSet . $tos . $from . $cc . $bcc;
		
		if (! mail ( $destinatario, $oggetto, $messaggio, $intestazioni ))
			echo self::ERROR_1;
	}
}

?>