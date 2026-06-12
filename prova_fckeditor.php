<?
namespace Cheope_ns\fw; 
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "FCKEditor.class.php");?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Untitled</title>
</head>
<body>
<form action="sampleposteddata.php" method="post" target="_blank">
<? 
$fck = new FCKEditor('aaa','bbb','0');
$fck->putData();
?>
<input type="submit" value="Submit">
</form>
</body>
</html>
