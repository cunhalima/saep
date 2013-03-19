<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
function deuerro($val = 1) {
    header("Location: login.php?attempt=$val");
    die();
}
function go() {
    if (!isset($_POST['nome']) || !isset($_POST['senha'])) {
        deuerro(6);
    }
    DB_connect();
    $nome = addslashes($_POST['nome']);
    $senha = PASSWORD_get($_POST['senha']);
    $result = mysql_query("select nome from usuario where nome='$nome' and senha='$senha'") 
        or deuerro(2);
    $count = mysql_num_rows($result);
    if ($count != 1)
        deuerro(3);
    session_start();
    $_SESSION['auth']=1;
    $_SESSION['nome']=$nome;
    $_SESSION['apen']=0;
    header('Location: index.php');
}
go();
?>
