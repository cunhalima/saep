<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header();
?>
<form>
Senha atual<br />
<input type="text" /><br />
Senha nova<br />
<input type="text" /><br />
</form>
<form>
Juiz atual<br />
<select>
<?php
    $usuario = $_SESSION['nome'];
    $result = mysql_query("select juiz from usuario where nome=\"$usuario\"") 
        or die('A error occured: ' . mysql_error());
    $juiz_atual = (int)mysql_result($result, 0);
    $result = mysql_query("select codigo,nome from juiz") 
        or die('A error occured: ' . mysql_error());
    $selected = ' selected="selected"';
    $issel = ($juiz_atual == 0) ? $selected : '';
    echo "<option value=\"0\"$issel></option>";
    while ($row = mysql_fetch_assoc($result)) {
        $codigo = (int)$row['codigo'];
        $nome = $row['nome'];
        $issel = ($juiz_atual == $codigo) ? $selected : '';
        echo "<option value=\"$codigo\"$issel\">$nome</option>";
    }
?>
</select><br />

</form>
<?php
COM_footer();
?>
