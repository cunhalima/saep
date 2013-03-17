<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
if (!$_SESSION['apen'])
    header('Location: index.php');
$apen = $_SESSION['apen'];
if (isset($_GET['pec'])) {
    $pec = addslashes($_GET['pec']);
    mysql_query("delete from processo_cond where pec = \"$pec\"");
}
/*
        apenado_codigo integer not null,
        numero_acao_penal varchar(45),
        numero_pec varchar(45),
        data_primpris date,

*/
if (isset($_POST['pec'])) {
    $sql = "replace into processo_cond(apenado_codigo,pec," .
                "numero_acao_penal,data_primpris) values (\"$apen\", \"" .
                addslashes($_POST['pec']) . '", "' .
                addslashes(@$_POST['numero_acao_penal']) . '", "' .
                addslashes(@DATE_p2s($_POST['data_primpris'])) . '")';
    //echo $sql;
    
    //die();
    mysql_query($sql);
}

?>
<form action="cadproc.php" method="post">
N. do PEC<br />
<input type="text" name="pec" value=""/><br />
N. da ação penal<br />
<input type="text" name="numero_acao_penal" value=""/><br />
Data primeira prisão<br />
<input type="text" name="data_primpris" value=""/><br />
<input type="submit" value="Gravar" />
</form>
<?php
    $result = mysql_query("select pec,numero_acao_penal,data_primpris from processo_cond where " .
        "apenado_codigo = \"$apen\"")
        or die('A error occured: ' . mysql_error());
    // get result count:
    echo '<ul>';
    while ($row = mysql_fetch_assoc($result)) {
        $pec = $row['pec'];
        $numero_acao_penal = htmlspecialchars($row['numero_acao_penal']);
        $data_primpris = htmlspecialchars(DATE_s2p($row['data_primpris']));
        echo "<li>PEC <a href=\"cadpen.php?pec=$pec\">$pec</a>, ação penal $numero_acao_penal, com primeira prisão em $data_primpris. " .
        "<a href=\"cadproc.php?pec=$pec\">Excluir</a></li>";
    }
    echo '</ul>';
    COM_footer();
?>
