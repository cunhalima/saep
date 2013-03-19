<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
COM_header(FALSE);


$count = 0;
$codigo = 0;
if (isset($_REQUEST['codigo'])) {
    $codigo = (int)$_REQUEST['codigo'];
} else {
    $codigo = (int)$_SESSION['apen'];
}
if (isset($_POST['nome']) && (trim($_POST['nome']) != '')) {
    $up = (int)(@$_POST['unid_pris_sigla'] or 0);
    $rp = (int)(@$_POST['regime_pris_sigla'] or 0);
    if ($up == 0)
        $up = "NULL";
    else
        $up = "\"$up\"";
    if ($rp == 0)
        $rp = "NULL";
    else
        $rp = "\"$rp\"";
    $sql = "replace into apenado (codigo,nome,codsaj,sexo,ipen,dtnasc,pai,mae," .
                "unid_pris_sigla,regime_pris_sigla,nacionalidade,outro_nome,liv_condicional," .
                "logradouro,numero_casa,complemento,bairro,cidade,estado,telefone," .
                "preso_outro_proc,sursis) values (\"$codigo\",\"" .
                @addslashes(trim($_POST['nome'])) . '", "' .
                @addslashes($_POST['codsaj']) . '", "' .
                @addslashes($_POST['sexo']) . '", "' .
                @addslashes($_POST['ipen']) . '", "' .
                @addslashes(DATE_p2s($_POST['dtnasc'])) . '", "' .
                @addslashes(trim($_POST['pai'])) . '", "' .
                @addslashes(trim($_POST['mae'])) . '", ' .
                $up . ', ' .
                $rp . ', "' .
                @addslashes(trim($_POST['nacionalidade'])) . '", "' .
                @addslashes(trim($_POST['outro_nome'])) . '", "' .
                @addslashes($_POST['liv_condicional']) . '", "' .
                @addslashes(trim($_POST['logradouro'])) . '", "' .
                @addslashes(trim($_POST['numero_casa'])) . '", "' .
                @addslashes(trim($_POST['complemento'])) . '", "' .
                @addslashes(trim($_POST['bairro'])) . '", "' .
                @addslashes(trim($_POST['cidade'])) . '", "' .
                @addslashes($_POST['estado']) . '", "' .
                @addslashes(trim($_POST['telefone'])) . '", "' .
                @addslashes(trim($_POST['preso_outro_proc'])) . '", "' .
                @addslashes($_POST['sursis']) . '")';
    //echo $sql;
    //die();
    mysql_query($sql);
    $codigo = (int)mysql_insert_id();
    if ($codigo) {
        $_SESSION['apen'] = $codigo;
    }
}
SAEP_printStatus();
echo '<div id="corpo">';

if ($codigo !== 0) {
    $result = mysql_query("select * from apenado where codigo=\"$codigo\"") 
        or die('A error occured: ' . mysql_error());
    $count = mysql_num_rows($result);
}
if ($count == 1) {
    $row = mysql_fetch_assoc($result);
    //$codigo = $row['codigo'];
    $nome = $row['nome'];
    $codsaj = $row['codsaj'];
    $sexo = (int)$row['sexo'];
    $ipen = $row['ipen'];
    $dtnasc = DATE_s2p($row['dtnasc']);
    $pai = $row['pai'];
    $mae = $row['mae'];
    $unid_pris_sigla = (int)$row['unid_pris_sigla'];
    $regime_pris_sigla = (int)$row['regime_pris_sigla'];
    $nacionalidade = $row['nacionalidade'];
    $outro_nome = $row['outro_nome'];
    $liv_condicional = (int)$row['liv_condicional'];
    $logradouro = $row['logradouro'];
    $numero_casa = $row['numero_casa'];
    $complemento = $row['complemento'];
    $bairro = $row['bairro'];
    $cidade = $row['cidade'];
    $estado = $row['estado'];
    $telefone = $row['telefone'];
    $preso_outro_proc = $row['preso_outro_proc'];
    $sursis = (int)$row['sursis'];
} else {
    //$codigo = 0;
    $nome = '';
    $codsaj = '';
    $sexo = 0;
    $ipen = '';
    $dtnasc = '';
    $pai = '';
    $mae = '';
    $unid_pris_sigla = 0;
    $regime_pris_sigla = 0;
    $nacionalidade = '';
    $outro_nome = '';
    $liv_condicional = 0;
    $logradouro = '';
    $numero_casa = '';
    $complemento = '';
    $bairro = '';
    $cidade = '';
    $estado = '';
    $telefone = '';
    $preso_outro_proc = '';
    $sursis = 0;
}

?>
<form action="cadapen.php" method="post">
<input type="hidden" name="codigo" value="0"/>
<input type="submit" value="Novo apenado"/><br />
</form>
<form action="cadapen.php" method="post">
<input type="hidden" name="codigo" value="<?php echo $codigo ?>"/>
Nome<br />
<input type="text" name="nome" value="<?php echo $nome ?>"/><br />
Código SAJ<br />
<input type="text" name="codsaj" value="<?php echo $codsaj ?>"/><br />
Sexo<br />
<?php
HTML_printSelectYN('sexo', $sexo, 'Masculino', 'Feminino');
?>
<br />
IPEN<br />
<input type="text" name="ipen" value="<?php echo $ipen ?>"/><br />
Data de nascimento<br />
<input type="text" name="dtnasc" value="<?php echo $dtnasc ?>"/><br />
Nome do pai<br />
<input type="text" name="pai" value="<?php echo $pai ?>"/><br />
Nome da mãe<br />
<input type="text" name="mae" value="<?php echo $mae ?>"/><br />
Local de prisão<br />
<?php
HTML_printSelect('unid_pris_sigla', 'sigla', 'nome', 'unid_pris', $unid_pris_sigla);
?>
<br />
Regime atual<br />
<?php
HTML_printSelect('regime_pris_sigla', 'sigla', 'nome', 'regime_pris', $regime_pris_sigla);
?>
<br />
Nacionalidade<br />
<input type="text" name="nacionalidade" value="<?php echo $nacionalidade ?>"/><br />
Outro nome<br />
<input type="text" name="outro_nome" value="<?php echo $outro_nome ?>"/><br />
Livramento condicional<br />
<?php
HTML_printSelectYN('liv_condicional', $liv_condicional);
?>
<br />
Logradouro<br />
<input type="text" name="logradouro" value="<?php echo $logradouro ?>"/><br />
Número<br />
<input type="text" name="numero_casa" value="<?php echo $numero_casa ?>"/><br />
Complemento<br />
<input type="text" name="complemento" value="<?php echo $complemento ?>"/><br />
Bairro<br />
<input type="text" name="bairro" value="<?php echo $bairro ?>"/><br />
Cidade<br />
<input type="text" name="cidade" value="<?php echo $cidade ?>"/><br />
Estado<br />
<input type="text" name="estado" value="<?php echo $estado ?>"/><br />
Telefone<br />
<input type="text" name="telefone" value="<?php echo $telefone ?>"/><br />
Preso em outro processo<br />
<input type="text" name="preso_outro_proc" value="<?php echo $preso_outro_proc ?>"/><br />
Sursis<br />
<?php
HTML_printSelectYN('sursis', $sursis);
?>
<br />
<input type="submit" value="Gravar"/><br />
</form>
<form action="remapen.php" method="post">
<input type="hidden" name="codigo" value="<?php echo $codigo ?>"/>
<input type="submit" value="Excluir"/><br />
</form>
<?php
COM_footer();
?>
