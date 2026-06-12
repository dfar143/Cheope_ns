<?
namespace Cheope_ns\fw;
require_once("root.const.php");

function require_root_modules($actApp)
{
if($actApp != STRING_NULL)
{	 
	 
   require_once(PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . 
   FRAMEWORK_DIR . DIR_SEP . $actApp . ".const.php");	    
           
  //require_once(PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . 
  //FRAMEWORK_DIR . DIR_SEP . "db_op.fun.php");
   
  /* require_once(PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . 
   FRAMEWORK_DIR . DIR_SEP . HTML_DATA_INTERFACE_CLASS . 
   ".class.php");
   require_once(PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . 
   FRAMEWORK_DIR . DIR_SEP . CONTAINER_CLASS . 
   ".class.php"); */

   require_once(PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . 
   FRAMEWORK_DIR . DIR_SEP . $actApp . VAR_SEP . "db_struct.def.php");


   $GLOBALS["dbStructTreeLocal"] = $dbStructTree;
   $GLOBALS["dbStructTree"] = $dbStructTree;

   require_once(PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . 
   FRAMEWORK_DIR . DIR_SEP . $actApp . VAR_SEP . "db_queries.def.php");
   
   
   $GLOBALS["ricSql2DefRules"] = $ricSql2DefRules;
   $GLOBALS["ricSql2DefGrRules"] = $ricSql2DefGrRules;
   $GLOBALS["dbQueriesContainerLocal"] = $dbQueriesContainer;
   $GLOBALS["dbQueriesContainer"] = $dbQueriesContainer;

   require_once(PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . 
   FRAMEWORK_DIR . DIR_SEP . $actApp . VAR_SEP . "db_connections.def.php");

   require_once(PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . 
   FRAMEWORK_DIR . DIR_SEP . $actApp . VAR_SEP . "db_binds.def.php");
   
   $GLOBALS["dbBindsContainer"] = $dbBindsContainer;
   
   require_once(THIS_DIR . DIR_SEP . FRAMEWORK_DIR . DIR_SEP . "php_arrays.def.php"); 
   
   $GLOBALS["phpArraysDefRules"] = $phpArraysDefRules;
   $GLOBALS["phpArraysDefGrRules"] = $phpArraysDefGrRules;
   
  /* require_once(PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . 
   FRAMEWORK_DIR . DIR_SEP . "Xml_node.class.php");

   require_once(PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . 
   FRAMEWORK_DIR . DIR_SEP . "Json_node.class.php"); */ 
      
}
}

function testUniquenessAndLoad($actFile)
{
 $files = get_required_files();
 $retVal = true;
 foreach($files as $file)
 {
  if (strpos($file,$actFile) != 0)
  {
  	$retVal = false;
  	break; 
  }
 }
 if ($retVal)
 {
   require_once(dirname(__FILE__) . DIR_SEP . FRAMEWORK_DIR . DIR_SEP  . $actFile);
 }
}
?>