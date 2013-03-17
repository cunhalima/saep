<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
HTML_header();
if (isset($_GET['attempt'])) {
    echo 'Erro na tentativa de login.<br />';
}
?>
<form action="checklogin.php" method="post">
Usuário<br />
<input type="text" name="nome"/><br />
Senha<br />
<input type="password" name="senha"/><br />
<input type="submit" value="Entrar" />
</form>
<?php
HTML_footer();
?>
