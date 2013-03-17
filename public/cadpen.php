<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
if (!$_SESSION['apen'])
    header('Location: cadproc.php');
$apen = $_SESSION['apen'];
$pec = '';
if (isset($_GET['pec'])) {
    $pec = addslashes($_GET['pec']);
    $result = mysql_query("select pec from processo_cond where apenado_codigo=\"$apen\" and pec=\"$pec\"")
        or die('A error occured: ' . mysql_error());
    $count = mysql_num_rows($result);
    if ($count !== 1)
        $pec = '';
}
if ($pec == '')
    header('Location: cadproc.php');
if (isset($_GET['data_fato'])) {
    $data_fato = addslashes(DATE_p2s($_GET['data_fato']));
    mysql_query("delete from pena_aplic where pec = \"$pec\" and data_fato = \"$data_fato\"");
}
if (isset($_POST['data_fato'])) {
/*
        pec varchar(15) not null,
        data_fato date not null,
        capitulacao varchar(45),
        reincidencia tinyint(1),
        subst_restritiva tinyint(1),
        hediondez tinyint(1),
        revog_lc tinyint(1),
        pena_anos integer,
        pena_meses integer,
        pena_dias integer,
*/
    $sql = "replace into pena_aplic(pec,data_fato,capitulacao," .
            "pena_anos,pena_meses,pena_dias" .
                ") values (\"$pec\", \"" .
                addslashes(DATE_p2s($_POST['data_fato'])) . '", "' .
                addslashes(@$_POST['capitulacao']) . '", "' .
                addslashes(@$_POST['pena_anos']) . '", "' .
                addslashes(@$_POST['pena_meses']) . '", "' .
                addslashes(@$_POST['pena_dias']) . '")';
    //echo $sql;
    
    //die();
    mysql_query($sql);
}

?>
<p>PEC N. <?php echo $pec ?></p>
<form action="cadpen.php?pec=<?php echo $pec?>" method="post">
Data do fato<br />
<input type="text" name="data_fato" value=""/><br />
Capitulação<br />
<input type="text" name="capitulacao" value=""/><br />
Pena (anos)<br />
<input type="text" name="pena_anos" value=""/><br />
Pena (meses)<br />
<input type="text" name="pena_meses" value=""/><br />
Pena (dias)<br />
<input type="text" name="pena_dias" value=""/><br />
<input type="submit" value="Gravar" />
</form>
<?php
    $result = mysql_query("select data_fato,capitulacao,pena_anos,pena_meses,pena_dias from pena_aplic where " .
        "pec = \"$pec\"")
        or die('A error occured: ' . mysql_error());
    // get result count:
    echo '<ul>';
    while ($row = mysql_fetch_assoc($result)) {
        $data_fato = DATE_s2p($row['data_fato']);
        $capitulacao = htmlspecialchars($row['capitulacao']);
        $pena_anos = $row['pena_anos'];
        $pena_meses = $row['pena_meses'];
        $pena_dias = $row['pena_dias'];
        echo "<li>Fato em $data_fato, capitulação $capitulacao, pena de $pena_anos anos, $pena_meses " .
            "meses e $pena_dias dias. " .
        "<a href=\"cadpen.php?pec=$pec&data_fato=$data_fato\">Excluir</a></li>";
    }
    echo '</ul>';
    COM_footer();
?>
