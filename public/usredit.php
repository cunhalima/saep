<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
ADMIN_check();
if (isset($_GET['nome'])) {
    $nome = addslashes(trim($_GET['nome']));
    mysql_query("delete from usuario where nome = \"$nome\"");
}
if (isset($_POST['nome'])) {
    $nome = addslashes(trim($_POST['nome']));
    if ($nome != '') {
        $senha = @$_POST['senha'] or '';
        $senha = PASSWORD_get($senha);
        $sql = "replace into usuario(nome,senha) " .
                    "values (\"$nome\", \"$senha\")";
        //echo $sql;
        //die();
        mysql_query($sql);
    }
}

?>
<form action="usredit.php" method="post">
Nome de usuário<br />
<input type="text" name="nome" value=""/><br />
Senha<br />
<input type="password" name="senha" value=""/><br />
<input type="submit" value="Gravar" />
</form>
<?php
    $result = mysql_query("select nome from usuario")
        or die('A error occured: ' . mysql_error());
    echo '<ul>';
    while ($row = mysql_fetch_assoc($result)) {
        $nome = $row['nome'];
        echo "<li>$nome <a href=\"usredit.php?nome=$nome\">Excluir</a></li>";
    }
    echo '</ul>';
    COM_footer();
?>