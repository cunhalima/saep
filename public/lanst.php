<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
/*
        data_inicio date not null,
        apenado_codigo integer not null,
        dias integer,
*/
if (!$_SESSION['apen'])
    header('Location: index.php');
$apen = $_SESSION['apen'];
if (isset($_GET['data_inicio'])) {
    $data_inicio = addslashes(DATE_p2s($_GET['data_inicio']));
    mysql_query("delete from decis_st where apenado_codigo = \"$apen\" and data_inicio = \"$data_inicio\"");
}
if (isset($_POST['data_inicio'])) {
    $sql = "replace into decis_st(apenado_codigo,data_inicio," .
                "dias) values (\"$apen\", \"" .
                addslashes(DATE_p2s($_POST['data_inicio'])) . '", "' .
                (int)(@$_POST['dias']) . '")';
    //echo $sql;
    
    //die();
    mysql_query($sql);
}

?>
<form action="lanst.php" method="post">
Data do início<br />
<input type="text" name="data_inicio" value=""/><br />
Dias<br />
<input type="text" name="dias" value=""/><br />
<input type="submit" value="Lançar" />
</form>
<?php
    $result = mysql_query("select data_inicio,dias from decis_st where " .
        "apenado_codigo = \"$apen\"")
        or die('A error occured: ' . mysql_error());
    // get result count:
    echo '<ul>';
    while ($row = mysql_fetch_assoc($result)) {
        $data_inicio = DATE_s2p($row['data_inicio']);
        $dias = (int)$row['dias'];
        echo "<li>Em $data_inicio, teve saída temporária de $dias dias. " .
        "<a href=\"lanst.php?data_inicio=$data_inicio\">Excluir</a></li>";
    }
    echo '</ul>';
    COM_footer();
?>
