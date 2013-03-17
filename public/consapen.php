<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
$nome=null;
if (isset($_REQUEST['nome'])) {
    $nome = addslashes(trim($_REQUEST['nome']));
}

?>
<form action="consapen.php" method="get">
Nome do(a) apenado(a)<br />
<input type="text" name="nome" value="<?php echo $nome ?>"/>
<input type="submit" value="Consultar" />
</form>
<?php
if ($nome !== null) {
    echo 'Resultados';
    $result = mysql_query("select codigo,nome,ipen,dtnasc from apenado where nome like \"%$nome%\"") 
        or die('A error occured: ' . mysql_error());
    // get result count:
    echo '<ul>';
    while ($row = mysql_fetch_assoc($result)) {
        $n = $row['nome'];
        $c = (int)$row['codigo'];        
        $ipen = htmlspecialchars($row['ipen']);
        $dtnasc = DATE_s2p($row['dtnasc']);
        print "<li><a href=\"selapen.php?apen=$c\">$n</a>, IPEN:$ipen, nascimento:$dtnasc</li>";
    }
    echo '</ul>';
}
COM_footer();
?>
