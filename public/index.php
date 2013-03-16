<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
HTML_header();
SAEP_printStatus();
?>
<ul>
<li><a href="consapen.php">Consultar apenado</a></li>
<li><a href="index.php">Consultar processo</a></li>
<li><a href="index.php">Calcular benefícios</a></li>
<li><a href="index.php">Configurações</a></li>
<li><a href="admin.php">Administração</a></li>
<li><a href="index.php">Sair</a></li>
</ul>

<?php
function test() {
    if ($_SERVER['DOCUMENT_ROOT'] === 'D:/xampp/htdocs') {
        $hostname = 'localhost';
        $password = 'password';
    } else {
        $hostname = 'saep-db.my.phpcloud.com';
        $password = '7f3iYhGMhg3w';
    }
    // connect to the database
    //$con = mysql_connect('saep-db.my.phpcloud.com','saep','7f3iYhGMhg3w') 
    //$con = mysql_connect('localhost','saep','password') 
    $con = mysql_connect($hostname, 'saep', $password) 
    or die('Could not connect to the server!');
    // select a database:
    mysql_select_db('saep') 
        or die('Could not select a database.');
    /*
    ** Fetch some rows from database:
    */

    // read username from URL
    //$username = $_GET['username'];
    // escape bad chars:
    //$username = mysql_real_escape_string($username);
    // build query:
    $sql = "select * from usuario";
    // execute query:
    $result = mysql_query($sql) 
        or die('A error occured: ' . mysql_error());
    // get result count:
    $count = mysql_num_rows($result);
    print "Showing $count rows:<hr/>";
    // fetch results:
    while ($row = mysql_fetch_assoc($result)) {
        $row_nome = $row['nome'];
        $row_senha = $row['senha'];
        print "$row_nome = $row_senha<br />";
    }
}
test();
HTML_footer();
?>
