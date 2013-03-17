<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
if (!$_SESSION['apen'])
    header('Location: index.php');
$apen = $_SESSION['apen'];
if (isset($_GET['data_homolog'])) {
    $data_homolog = addslashes(DATE_p2s($_GET['data_homolog']));
    mysql_query("delete from decis_remicao where apenado_codigo = \"$apen\" and data_homolog = \"$data_homolog\"");
}
if (isset($_POST['data_homolog'])) {
    $sql = "replace into decis_remicao(apenado_codigo,data_homolog," .
                "dias_trab,sobra_dias,dias_remidos) values (\"$apen\", \"" .
                addslashes(DATE_p2s($_POST['data_homolog'])) . '", "' .
                (int)(@$_POST['dias_trab']) . '", "' .
                (int)(@$_POST['sobra_dias']) . '", "' .
                (int)(@$_POST['dias_remidos']) . '")';
    //echo $sql;
    
    //die();
    mysql_query($sql);
}

?>
<form action="lanrem.php" method="post">
Data da homologação<br />
<input type="text" name="data_homolog" value=""/><br />
Dias trabalhados<br />
<input type="text" name="dias_trab" value=""/><br />
Sobra de dias<br />
<input type="text" name="sobra_dias" value=""/><br />
Dias remidos<br />
<input type="text" name="dias_remidos" value=""/><br />
<input type="submit" value="Lançar" />
</form>
<?php
    $result = mysql_query("select data_homolog,dias_trab,sobra_dias,dias_remidos from decis_remicao where " .
        "apenado_codigo = \"$apen\"")
        or die('A error occured: ' . mysql_error());
    // get result count:
    echo '<ul>';
    while ($row = mysql_fetch_assoc($result)) {
        $data_homolog = DATE_s2p($row['data_homolog']);
        $dias_trab = (int)$row['dias_trab'];        
        $sobra_dias = (int)$row['sobra_dias'];
        $dias_remidos = (int)$row['dias_remidos'];
        echo "<li>Em $data_homolog, trabalhou $dias_trab dias, sobraram $sobra_dias dias e remiu $dias_remidos dias. " .
        "<a href=\"lanrem.php?data_homolog=$data_homolog\">Excluir</a></li>";
    }
    echo '</ul>';
    COM_footer();
?>
