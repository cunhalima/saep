<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
/*
        inicio date not null,
        apenado_codigo integer not null,
        dias integer,
*/
if (!$_SESSION['apen'])
    header('Location: index.php');
$apen = $_SESSION['apen'];
if (isset($_GET['inicio'])) {
    $inicio = addslashes(DATE_p2s($_GET['inicio']));
    mysql_query("delete from periodo_interrup where apenado_codigo = \"$apen\" and inicio = \"$inicio\"");
}
if (isset($_POST['inicio'])) {
    $sql = "replace into periodo_interrup(apenado_codigo,inicio," .
                "fim) values (\"$apen\", \"" .
                addslashes(DATE_p2s($_POST['inicio'])) . '", "' .
                addslashes(@DATE_p2s($_POST['fim'])) . '")';
    //echo $sql;
    
    //die();
    mysql_query($sql);
}

?>
<form action="lanint.php" method="post">
Início<br />
<input type="text" name="inicio" value=""/><br />
Fim<br />
<input type="text" name="fim" value=""/><br />
<input type="submit" value="Lançar" />
</form>
<?php
    $result = mysql_query("select inicio,fim from periodo_interrup where " .
        "apenado_codigo = \"$apen\"")
        or die('A error occured: ' . mysql_error());
    // get result count:
    echo '<ul>';
    while ($row = mysql_fetch_assoc($result)) {
        $inicio = DATE_s2p($row['inicio']);
        $fim = DATE_s2p($row['fim']);
        echo "<li>Interrupção de $inicio até $fim. " .
        "<a href=\"lanint.php?inicio=$inicio\">Excluir</a></li>";
    }
    echo '</ul>';
    COM_footer();
?>
