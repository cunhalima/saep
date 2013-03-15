<?php
/* Codificação UTF-8 */
function HTML_header() {
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
    echo '<html><head><meta http-equiv="content-type" content="text/html;charset=utf-8" />';
    echo '<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>';
    echo '<title>Consultar apenado</title></head><body>';
}
function HTML_footer() {
    echo '</body></html>';
}
function SAEP_printStatus() {
    echo '<div>Apenado atual: João da Silva<br />&nbsp;</div>';

}
?>