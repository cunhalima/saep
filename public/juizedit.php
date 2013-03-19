<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
ADMIN_check();
if (isset($_GET['codigo'])) {
    $codigo = (int)$_GET['codigo'];
    mysql_query("delete from juiz where codigo = \"$codigo\"");
}
if (isset($_POST['codigo'])) {
    

    $codigo = (int)$_POST['codigo'];
    $nome = @addslashes($_POST['nome']);
    $cargo = (int)$_POST['cargo'];
    $sexo = (int)$_POST['sexo'];
    $sql = "replace into juiz(codigo,nome,cargo,sexo) " .
                "values (\"$codigo\", \"$nome\", \"$cargo\", \"$sexo\")";

                    echo $_POST['codigo'];
    /*
    echo $codigo;
    echo $_POST['nome'];
    echo $nome;
    echo $_POST['sexo'];
    echo $sexo;
    die();
    */

    //            echo $sql;
    //die();
    mysql_query($sql);
}

?>
<form action="juizedit.php" method="post">
Matrícula<br />
<input type="text" name="codigo" value=""/><br />
Nome<br />
<input type="text" name="nome" value=""/><br />
Sexo<br />
<?php
HTML_printSelectYN('sexo', 0, 'Masculino', 'Feminino');
?>
<br />
Cargo<br />
<?php
HTML_printSelect('cargo', 'sigla', 'nomem', 'cargo_juiz', 0);
?>
<br />
<input type="submit" value="Gravar" />
</form>
<?php
    $result = mysql_query("select codigo,nome,sexo,cargo from juiz")
        or die('A error occured: ' . mysql_error());
    echo '<ul>';
    while ($row = mysql_fetch_assoc($result)) {
    
        $codigo = $row['codigo'];
        $nome = $row['nome'];
        $sexo = $row['sexo'];
        $cargo = $row['cargo'];
        $result2 = mysql_query("select nomem,nomef from cargo_juiz where sigla = \"$cargo\"")
            or die('A error occured: ' . mysql_error());
        $cargo = mysql_result($result2, 0, $sexo - 1);
        echo "<li>$nome, $cargo (matrícula $codigo) <a href=\"juizedit.php?codigo=$codigo\">Excluir</a></li>";
    }
    echo '</ul>';
    COM_footer();
?>