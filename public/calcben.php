<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
$apen = $_SESSION['apen'];
$usuario = $_SESSION['nome'];


$result = mysql_query("select codigo from apenado where codigo=\"$apen\"")
    or die('A error occured: ' . mysql_error());
$count = mysql_num_rows($result);
if ($count != 1)
    header('Location: index.php');
$result = mysql_query("select min(data_primpris) from processo_cond where " .
    "apenado_codigo = \"$apen\"")
    or die('A error occured: ' . mysql_error());
$primpris = DATE_s2p(mysql_fetch_array($result)[0]);
$result = mysql_query("select nome from apenado where codigo = \"$apen\"")
    or die('A error occured: ' . mysql_error());
$nome = htmlspecialchars(mysql_result($result, 0, 0));
echo "<p>Atesto, para os devidos fins, que o apenado $nome é um coió de teta. Foi ";
echo "preso pela primeira vez em $primpris e ainda acha que merece algum benefício, esse mala.</p>";

    $result = mysql_query("select j.nome,j.sexo,c.nomem,c.nomef from usuario u join juiz j on u.juiz = j.codigo join " .
            " cargo_juiz c on j.cargo = c.sigla where u.nome=\"$usuario\"")
        or die('A error occured: ' . mysql_error());
    $count = mysql_num_rows($result);
    if ($count == 1) {
        $nome = mysql_result($result, 0, 0);
        $sexo = (int)mysql_result($result, 0, 1);
        $cargo = mysql_result($result, 0, 1 + $sexo);
        echo "<p>$nome</p>";
        echo "<p>$cargo</p>";
    } else {
        echo "<p>Juiz não cadastrado</p>";
    }
?>

<?php
COM_footer();
?>
