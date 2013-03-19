<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
$apen = $_SESSION['apen'];
$usuario = $_SESSION['nome'];
$result = mysql_query("select min(data_primpris) from processo_cond where " .
    "apenado_codigo = \"$apen\"")
    or die('A error occured: ' . mysql_error());
$primpris = DATE_s2p(mysql_fetch_array($result)[0]);
echo $primpris;

//select min(data_primpris) from processo_cond where apenado_codigo = "1"

    $result = mysql_query("select j.nome,j.sexo,c.nomem,c.nomef from usuario u join juiz j on u.juiz = j.codigo join " .
            " cargo_juiz c on j.cargo = c.sigla where u.nome=\"$usuario\"") 
        or die('A error occured: ' . mysql_error());
    $nome = mysql_result($result, 0, 0);
    $sexo = (int)mysql_result($result, 0, 1);
    $cargo = mysql_result($result, 0, 1 + $sexo);
    
    echo "<p>$nome</p>";
    echo "<p>$cargo</p>";



?>

<?php
COM_footer();
?>
