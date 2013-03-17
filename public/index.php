<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
?>
<div>
<ul>
<li><a href="cadapen.php">Cadastrar apenado</a></li>
<li><a href="consapen.php">Consultar apenado</a></li>
<li><a href="lanrem.php">Lançar remições</a></li>
<li><a href="lancom.php">Lançar comutações</a></li>
<li><a href="lanst.php">Lançar saídas temporárias</a></li>
<li><a href="lanint.php">Lançar interrupções</a></li>
<li><a href="cadproc.php">Cadastro de processos</a></li>
<li><a href="index.php">Calcular benefícios</a></li>
<li><a href="config.php">Configurações</a></li>
<?php if (ADMIN_ok()) { ?>
<li><a href="admin.php">Administração</a></li>
<?php } ?>
<li><a href="logout.php">Sair</a></li>
</ul>
</div>
<?php
function go() {
/*
    $result = mysql_query("select * from usuario") 
        or die('A error occured: ' . mysql_error());
    // get result count:
    $count = mysql_num_rows($result);
    print "Showing $count rows:<hr/>";
    // fetch results:
    while ($row = mysql_fetch_assoc($result)) {
        $row_nome = $row['nome'];
        $row_senha = $row['senha'];
        print "$row_nome = $row_senha<br />";
    }

    $result = mysql_query("select j.nome from usuario u join juiz j on u.juiz = j.codigo") 
        or die('A error occured: ' . mysql_error());
    // get result count:
    $count = mysql_num_rows($result);
    print "Showing $count rows:<hr/>";
    // fetch results:
    while ($row = mysql_fetch_assoc($result)) {
        $row_nome = $row['nome'];
        print "AAA $row_nome<br />";
    }
*/
}
go();
COM_footer();
?>
