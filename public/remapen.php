<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
SESSION_check();
DB_connect();
function go() {
    if (isset($_POST['codigo'])) {
        $codigo = (int)$_POST['codigo'];
        if ($codigo) {
            $result = mysql_query("delete from apenado where codigo=\"$codigo\""); 
            $_SESSION['apen']=0;
        }
    }
    header('Location: cadapen.php');
}
go();
?>