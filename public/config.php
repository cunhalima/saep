<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
$usuario = $_SESSION['nome'];
if (isset($_POST['senha_antiga']) && isset($_POST['senha_nova'])) {
    $antiga = PASSWORD_get($_POST['senha_antiga']);
    $nova = PASSWORD_get($_POST['senha_nova']);
    $result = mysql_query("update usuario set senha=\"$nova\" where nome=\"$usuario\" and senha=\"$antiga\"") 
        or die('A error occured: ' . mysql_error());
    if ($result === TRUE) {
        $num = mysql_affected_rows();
        if ($num === 1)
            echo '<p>Senha alterada com sucesso</p>';
    }
}
if (isset($_POST['juiz'])) {
    $juiz = addslashes($_POST['juiz']);
    $result = mysql_query("update usuario set juiz=\"$juiz\" where nome=\"$usuario\"") 
        or die('A error occured: ' . mysql_error());
}

?>


<form method="post" action="config.php">
Senha atual<br />
<input type="password" name="senha_antiga"/><br />
Senha nova<br />
<input type="password" name="senha_nova"/><br />
<input type="submit" value="Alterar senha"/><br />
</form>
<form method="post" action="config.php">
Juiz atual<br />
<?php
    $result = mysql_query("select juiz from usuario where nome=\"$usuario\"") 
        or die('A error occured: ' . mysql_error());
    $juiz = (int)mysql_result($result, 0);
    HTML_printSelect('juiz', 'codigo', 'nome', 'juiz', $juiz);
?>
<br />
<input type="submit" value="Alterar juiz"/><br />
</form>
<?php
COM_footer();
?>
