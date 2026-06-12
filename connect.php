<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "db.def.php");

  $db = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);
  if (!$db)
  {
    die( "Impossibile connettersi al database. Ritentare più tardi.");
  } else {
    print("Utente ".SQLSRV_USER." connesso a ".SQLSRV_HOST.".");
  }
  if ($info=sqlsrv_server_info($db)) {
    print("<br>Selezionato il db ".$info["CurrentDatabase"].".");
  } else {
    die("<br>Errore nella connessione al db ".SQLSRV_DB.".");
  }
?>