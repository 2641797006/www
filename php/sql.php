<?php
$IO_HTML=true;
require_once "io_sql.php";
require_once "kstring.php";
require_once "html.php";
use function _24k\{io_bs, ln, write, writeln, warr, warrln, res2s, res2bs};
use _24k\kstring;
use _24k\html;
require_once "login_sql.php";

$html = new html("example.html");
$html->begin();

$sql = new PDO($dsn, $username, $password);
$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$res = $sql->query('select * from sbc');

$s = res2bs($res);

echo $s;

$html->end();


?>
