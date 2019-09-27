<?php
$IO_HTML=1;
require_once "io_sql.php";
require_once "html.php";
use function _24k\{io_bs, ln, write, writeln, warr, warrln, wout, woutln, werr, werrln, res2s, res2bs};
use _24k\html;
require_once "login_sql.php";

$html = new html("example.html");
$html->begin();

try {
$sql = new PDO($dsn, $username, $password);
$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$res = $sql->query("select * from sbc");
echo res2bs($res);

} catch (Exception $e) {
	werrln( $e->getMessage() );
}

$html->end();

$sql = null;
?>
