<?
namespace Cheope_ns\fw;
require_once ("Generic_interface.class.php");
require_once ("cheope_ns.fun.php");

class Cheope_ns_pop3Mail extends Generic_interface
{
const DEFAULT_POP3MAIL_FOLDER = "INBOX";

private static $pop3MailTotNum = 0;
private $host = STRING_NULL;
private $port = STRING_NULL;
private $user = STRING_NULL;
private $pass = STRING_NULL;
private $folder = self::DEFAULT_POP3MAIL_FOLDER;
private $ssl = false;
	
function __construct(string $actOp = OP_NONE, $actNum = STRING_NULL)
{
		self::$pop3MailTotNum ++;
		if ($actNum === STRING_NULL)
			$actNum = self::$pop3MailTotNum - 1;
		parent::__construct ( $actOp, self::INT_POP3MAIL, $actNum );
}

function setHost(string $actHost):void
{
	$this->host = $actHost;
}

function getHost():string
{
	return $this->host;
}

function setPort(string $actPort):void
{
	$this->port = $actPort;
}

function getPort():string
{
	return $this->port;
}

function setUser(string $actUser):void
{
	$this->user = $actUser;
}

function getUser():string
{
	return $this->user;
}

function setPass(string $actPass):void
{
	$this->pass = $actPass;
}

function getPass():string
{
	return $this->pass;
}

function getFolder():string
{
	return $this->folder;
}

function setFolder(string $actFolder):void
{
	$this->folder = $actFolder;
}

function setSsl(string $actSsl):void
{
	$this->ssl = $actSsl;
}

function getSsl():string
{
	return $this->ssl;
}

function pop3_login():IMAP\Connection|false
{
	  $host = $this->getHost();
	  $port = $this->getPort();
	  $user = $this->getUser();
	  $pass = $this->getPass();
	  $folder = $this->getFolder();
	  $ssl = $this->getSsl();
    $ssl=($ssl==false)?"/novalidate-cert":STRING_NULL;
//  
// Ritorna una connessione imap stream.
//
    return (\imap_open("{"."$host:$port/pop3$ssl"."}$folder",$user,$pass));
}

//
// $actConnection è un IMAP stream.
//
function pop3_stat(IMAP\Connection $actConnection):array        
{
    $check = imap_mailboxmsginfo($actConnection);
    return ((array)$check);
}

//
// $actConnection è un IMAP stream.
//
function pop3_list(IMAP\Connection $actConnection,string $actMessage=STRING_NULL):array
{
    if ($actMessage)
    {
        $range=$actMessage;
    } else {
        $MC = imap_check($actConnection);
        $range = "1:" . $MC->Nmsgs;
    }
    $response = imap_fetch_overview($actConnection,$range);
	$result=array();
    foreach ($response as $msg) $result[$msg->msgno]=(array)$msg;

    return $result;
}

//
// $actConnection è un IMAP stream.
//
function pop3_retr(object $actConnection,string $actMessage):string|false
{
    return(imap_fetchheader($actConnection,$actMessage,FT_PREFETCHTEXT));
}

//
// $actConnection è un IMAP stream.
//
function pop3_delete(object $actConnection,string $actMessage):bool
{
    return(imap_delete($actConnection,$actMessage));
}

//
// Metodo accessorio per mail_mime_to_array 
//
function mail_parse_headers(string|array $actHeaders):array
{
    $headers=preg_replace('/\r\n\s+/m', STRING_NULL,$actHeaders);
    preg_match_all('/([^: ]+): (.+?(?:\r\n\s(?:.+?))*)?\r\n/m', $headers, $matches);
	$result=array();
    foreach ($matches[1] as $key =>$value) $result[$value]=$matches[2][$key];
    return($result);
}

function mail_mime_to_array(IMAP\Connection $actImap,int $actMid,bool $actParseHeaders=false):array
{
//
// $actImap è un IMAP stream.
//
    $mail = imap_fetchstructure($actImap,$actMid);
    $mail = mail_get_parts($actImap,$actMid,$mail,0);
    if ($actParseHeaders) $mail[0]["parsed"]=mail_parse_headers($mail[0]["data"]);
    return($mail);
}

function mail_get_parts(IMAP\Connection $actImap,int $actMid,stdClass|false $actPartObj,string $actPrefix):array
{  
//
// $actImap è un IMAP stream.
//  
    $attachments=array();
    $attachments[$actPrefix]=mail_decode_part($actImap,$actMid,$actPartObj,$actPrefix);
    if (isset($actPartObj->parts)) // multipart
    {
        $prefix = ($actPrefix == "0")?STRING_NULL:"$actPrefix.";
        foreach ($actPartObj->parts as $number=>$subpart) 
            $attachments=array_merge($attachments, mail_get_parts($actImap,$actMid,$subpart,$actPrefix.($number+1)));
    }
    return $attachments;
}

//
// $actConnection è un IMAP stream.
//
function mail_decode_part(IMAP\Connection $actConnection,int $actMessageNumber,stdClass|false $actPartObj,string $actPrefix):array
{
    $attachment = array();

    if($actPartObj->ifdparameters) {
        foreach($actPartObj->dparameters as $object) {
            $attachment[strtolower($object->attribute)]=$object->value;
            if(strtolower($object->attribute) == 'filename') {
                $attachment['is_attachment'] = true;
                $attachment['filename'] = $object->value;
            }
        }
    }

    if($actPartObj->ifparameters) {
        foreach($actPartObj->parameters as $object) {
            $attachment[strtolower($object->attribute)]=$object->value;
            if(strtolower($object->attribute) == 'name') {
                $attachment['is_attachment'] = true;
                $attachment['name'] = $object->value;
            }
        }
    }

    $attachment['data'] = imap_fetchbody($actConnection, $actMessageNumber, $actPrefix);
    if($actPartObj->encoding == 3) { // 3 = BASE64
        $attachment['data'] = base64_decode($attachment['data']);
    }
    elseif($actPartObj->encoding == 4) { // 4 = QUOTED-PRINTABLE
        $attachment['data'] = quoted_printable_decode($attachment['data']);
    }
    return($attachment);
}

function isContainer():bool
{
	return false;
}

function isDecorator():bool
{
	return false;
}

function isStandard():bool
{
 return false;
}

function putData():void
{
}

function action(string $actStr,Interfaces_container $actInterfacesContainer):void
{
}

}

?>