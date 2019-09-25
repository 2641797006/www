<?php
namespace _24k{
require_once "io.php";
require_once "kstring.php";
// TODO: use function _24k\{io_bs, ln, write, writeln, warr, warrln, res2s, res2bs};

function res2s(\PDOStatement $res) {
	$ks = new kstring();
	$col = $res->columnCount();
	foreach ($res as $line) {
		for ($i=0; $i<$col; ++$i) {
			if ( ! $line[$i] )
				$ks->push_back('NULL');
			else
				$ks->push_back($line[$i]);
			$ks->push_back(' ');
		}
		$ks->push_back("\n");
	}
	return $ks->__toString();
}

function res2bs(\PDOStatement $res) {
	$ks = new kstring();
	$col = $res->columnCount();
	$ks->push_back('<table border="1">');
	$head = true;
	foreach ($res as $line) {
		if ( $head ) {
			$ks->push_back('<tr>');
			$size = sizeof($line);
			$i=0;
			foreach ($line as $key => $value) {
				if ($i >= $size)
					break;
				if (++$i%2 == 0)
					continue;
				$ks->push_back('<th>');
				$ks->push_back($key);
				$ks->push_back('</th>');
			}
			$head = false;
			$ks->push_back('</tr>');
		}
		$ks->push_back('<tr>');
		for ($i=0; $i<$col; ++$i) {
			$ks->push_back('<td>');
			if ( ! $line[$i] )
				$ks->push_back('NULL');
			else
				$ks->push_back( io_bs($line[$i]) );
			$ks->push_back('</td>');
		}
		$ks->push_back('</tr>');
	}
	$ks->push_back('</table>');
	return $ks->__toString();
}

}

?>
