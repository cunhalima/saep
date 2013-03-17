<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
/*
        data_decis date not null,
        apenado_codigo integer not null,
        penac_anos integer,
        penac_meses integer,
        penac_dias integer,
        decreto varchar(20),

*/
if (!$_SESSION['apen'])
    header('Location: index.php');
$apen = $_SESSION['apen'];
if (isset($_GET['data_decis'])) {
    $data_decis = addslashes(DATE_p2s($_GET['data_decis']));
    mysql_query("delete from decis_comut where apenado_codigo = \"$apen\" and data_decis = \"$data_decis\"");
}
if (isset($_POST['data_decis'])) {
    $sql = "replace into decis_comut(apenado_codigo,data_decis," .
                "penac_anos,penac_meses,penac_dias,decreto) values (\"$apen\", \"" .
                addslashes(DATE_p2s($_POST['data_decis'])) . '", "' .
                (int)(@$_POST['penac_anos']) . '", "' .
                (int)(@$_POST['penac_meses']) . '", "' .
                (int)(@$_POST['penac_dias']) . '", "' .
                addslashes(@$_POST['decreto']) . '")';
    //echo $sql;
    
    //die();
    mysql_query($sql);
}

?>
<form action="lancom.php" method="post">
Data da decisão<br />
<input type="text" name="data_decis" value=""/><br />
Anos<br />
<input type="text" name="penac_anos" value=""/><br />
Meses<br />
<input type="text" name="penac_meses" value=""/><br />
Dias<br />
<input type="text" name="penac_dias" value=""/><br />
Decreto<br />
<input type="text" name="decreto" value=""/><br />
<input type="submit" value="Lançar" />
</form>
<?php
    $result = mysql_query("select data_decis,penac_anos,penac_meses,penac_dias,decreto from decis_comut where " .
        "apenado_codigo = \"$apen\"")
        or die('A error occured: ' . mysql_error());
    // get result count:
    echo '<ul>';
    while ($row = mysql_fetch_assoc($result)) {
        $data_decis = DATE_s2p($row['data_decis']);
        $penac_anos = (int)$row['penac_anos'];
        $penac_meses = (int)$row['penac_meses'];
        $penac_dias = (int)$row['penac_dias'];
        $decreto = htmlspecialchars($row['decreto']);
        echo "<li>Em $data_decis, comutou $penac_anos anos, $penac_meses meses e $penac_dias dias pelo decreto $decreto. " .
        "<a href=\"lancom.php?data_decis=$data_decis\">Excluir</a></li>";
    }
    echo '</ul>';
    COM_footer();
?>
