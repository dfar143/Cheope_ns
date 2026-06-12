<?
namespace Cheope_ns\fw;

require_once("html.const.php");
require_once("javascript.const.php");


function putScriptMsg(string $actMsg,int $actDelay):void
{
	 putScriptOpenTag();
	 putGenericHtmlstring("setTimeout(" . "\"" . "alert('" . $actMsg . "')" . "\"" . "," . $actDelay . ")",0);
	 putGenericHtmlstring(SCRIPT_CLOSE_TAG,0);
}

function make_loader_SID(string $actLabel,string $actPage):void
{
	 echo '<form name="loader" action="' . $actPage . '?' . SID . '" method="get">';
	 echo '<script language="javascript">';
	 echo 'setTimeout("window.document.forms[' . '\'' . 'loader' . '\'' . '].submit()",5000)';
	 echo '</script>';
	 echo '<fieldset>';
	 echo '&nbsp&nbsp<legend>' . $actLabel .'</legend>';
	 echo '<br>';
	 echo '<br>';
	 echo '&nbsp&nbsp<button type="submit">Invia</button>';
	 echo '<br>';
	 echo '<br>';
	 echo '</fieldset>';
	 echo '</form>';
}

function make_loader(string $actLabel,string $actPage,bool $actSend=true,bool $actTop=false):void
{
	 echo '<form name="loader" action="' . $actPage . '" method="post"';
	 if ($actTop) 
	  echo	' target="_top">';
	 else
	  echo '>';
	 if ($actSend)
	 {
	  echo '<script language="javascript">';
	  echo 'setTimeout("window.document.forms[' . '\'' . 'loader' . '\'' . '].submit()",5000)';
	  echo '</script>';
	 }
	 echo '<fieldset>';
	 echo '&nbsp&nbsp<legend>' . $actLabel .'</legend>';
	 echo '<br>';
	 echo '<br>';
	 echo '&nbsp&nbsp<button type="submit">Invia</button>';
	 echo '<br>';
	 echo '<br>';
	 echo '</fieldset>';
	 echo '</form>';
}

?>