<?php
/* Codificação UTF-8 */
function HTML_header() {
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
    echo '<html><head><meta http-equiv="content-type" content="text/html;charset=utf-8" />';
    echo '<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>';
    echo '<title>Consultar apenado</title></head><body>';
    echo '<p><a href="index.php">Tela principal</a></p>';
}
function HTML_footer() {
    echo '</body></html>';
}
function DATE_p2s($date) {
    $date = "$date";
    $date = explode("/", $date);
    $d = @$date[0] or 0;
    $m = @$date[1] or 0;
    $y = @$date[2] or 0;
    return sprintf("%04d-%02d-%02d", $y, $m, $d);
}
function DATE_s2p($date) {
    $date = "$date";
    $date = explode("-", $date);
    $y = @$date[0] or 0;
    $m = @$date[1] or 0;
    $d = @$date[2] or 0;
    return sprintf("%02d/%02d/%04d", $d, $m, $y);
}
function SAEP_printStatus() {
    $nome = $_SESSION['nome'];
    $apen = $_SESSION['apen'];
    echo "<div>Usuário atual: $nome<br />&nbsp;</div>";
    $result = mysql_query("select nome from apenado where codigo=\"$apen\"") 
        or die('A error occured: ' . mysql_error());
    $count = mysql_num_rows($result);
    if ($count == 1) {
        $nomeapen = mysql_result($result, 0);
    } else {
        $nomeapen = '';
        $_SESSION['apen'] = 0;
    }
    echo "<div>Apenado atual: $nomeapen<br />&nbsp;</div>";

}
function SESSION_check() {
    session_start();
    if (!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
        session_destroy();
        header('Location: login.php');
        exit();
    }
}
function DB_connect() {
    // Para depuração, o servidor mysql é em localhost
    if ($_SERVER['DOCUMENT_ROOT'] === 'D:/xampp/htdocs') {
        $hostname = 'localhost';
    } else {
        $hostname = 'saep-db.my.phpcloud.com';
    }
    $con = mysql_connect($hostname, 'saep', '7f3iYhGMhg3w') 
        or die('Could not connect to the server!');
    mysql_select_db('saep') 
        or die('Could not select a database.');
}
function ADMIN_ok() {
    if (!isset($_SESSION['nome']) || (($_SESSION['nome'] !== 'admin') && ($_SESSION['nome'] !== 'alex'))) {
        return FALSE;
    }
    return TRUE;
}
function ADMIN_check() {
    if (!ADMIN_ok()) {
        header('Location: index.php');
        exit();
    }
}
function COM_header($printstatus = TRUE) {
    SESSION_check();
    DB_connect();
    HTML_header();
    if ($printstatus)
        SAEP_printStatus();
}
function COM_footer() {
    HTML_footer();
}
function HTML_printSelectYN($tname, $cur, $yes = 'Sim', $no = 'Não') {
    echo "<select name=\"$tname\">";    
    $selected = ' selected="selected"';
    $issel = ($cur == 0) ? $selected : '';
    echo "<option value=\"0\"$issel></option>";
    $issel = ($cur == 1) ? $selected : '';
    echo "<option value=\"1\"$issel>$yes</option>";
    $issel = ($cur == 2) ? $selected : '';
    echo "<option value=\"2\"$issel>$no</option>";
    echo '</select>';    
}

function HTML_printSelect($tname, $cname, $nname, $tab, $cur) {
    echo "<select name=\"$tname\">";    
    $result = mysql_query("select $cname,$nname from $tab") 
        or die('A error occured: ' . mysql_error());
    $selected = ' selected="selected"';
    $issel = ($cur == 0) ? $selected : '';
    echo "<option value=\"0\"$issel></option>";
    while ($row = mysql_fetch_assoc($result)) {
        $codigo = (int)$row[$cname];
        $nome = $row[$nname];
        $issel = ($cur == $codigo) ? $selected : '';
        echo "<option value=\"$codigo\"$issel\">$nome</option>";
    }
    echo '</select>';    
}
function PASSWORD_get($senha) {
    $salt = 'ugnpjbPrBJqcxK9RW8FS4Ux4';
    return md5($senha . $salt);
}
?>