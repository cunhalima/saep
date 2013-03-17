<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
SESSION_check();
DB_connect();
function go() {
    if (isset($_GET['apen'])) {
        $codigo = (int)$_GET['apen'];
        $result = mysql_query("select codigo from apenado where codigo=\"$codigo\""); 
        $count = mysql_num_rows($result);
        if ($count == 1) {
            $_SESSION['apen']=$codigo;
        }
    }
    header('Location: index.php');
}
go();
?>