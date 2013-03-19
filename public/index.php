<?php
/* Codificação UTF-8 */
/* Autor: Alex Reimann Cunha Lima
   E-mail: cunha.lima@ufrgs.br
   Propósito do programa: cadastrar os apenados da exeucução penal e emitir
   atestados de penas em seu nome que indiquem a situação de seu processo.
*/
require_once 'inc/inc.php';
COM_header();
?>
<ul>
<li><a href="cadapen.php">Cadastrar apenado</a></li>
<li><a href="consapen.php">Consultar apenado</a></li>
<li><a href="lanrem.php">Lançar remições</a></li>
<li><a href="lancom.php">Lançar comutações</a></li>
<li><a href="lanst.php">Lançar saídas temporárias</a></li>
<li><a href="lanint.php">Lançar interrupções</a></li>
<li><a href="cadproc.php">Cadastro de processos</a></li>
<li><a href="calcben.php">Calcular benefícios</a></li>
<li><a href="config.php">Configurações</a></li>
<?php if (ADMIN_ok()) { ?>
<li><a href="admin.php">Administração</a></li>
<?php } ?>
<li><a href="logout.php">Sair</a></li>
</ul>
<?php
COM_footer();
?>
