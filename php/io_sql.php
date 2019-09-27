<?php
namespace _24k{
require_once "io.php";
require_once "kstring.php";
// TODO: use function _24k\{io_bs, ln, write, writeln, warr, warrln, wout, woutln, werr, werrln, res2s, res2bs};

function res2s(\PDOStatement $res) {
	$res->setFetchMode(\PDO::FETCH_BOTH);
	$ks = new kstring();
	$row = $res->rowCount();
	$col = $res->columnCount();
	if ( ! $col ) {
		$ks->push_back('Query OK, ');
		$ks->push_back($row);
		$ks->push_back($row>1 ? ' rows affected' : ' row affected');
		$ks->push_back("\n");
		return $ks->__toString();
	}
	if ( ! $row ) {
		$ks->push_back('Empty set');
		$ks->push_back("\n");
		return $ks->__toString();
	}
	$head = true;
	foreach ($res as $line) {
		if ( $head ) {
			$size = sizeof($line);
			$i=0;
			foreach ($line as $key => $value) {
				if ($i >= $size)
					break;
				if (++$i%2 == 0)
					continue;
				$ks->push_back($key);
				$ks->push_back(' ');
			}
			$head = false;
			$ks->push_back("\n");
		}
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
	$res->setFetchMode(\PDO::FETCH_BOTH);
	$ks = new kstring();
	$row = $res->rowCount();
	$col = $res->columnCount();
	if ( ! $col ) {
		$ks->push_back(io_bs('Query OK, '));
		$ks->push_back(io_bs($row));
		$ks->push_back(io_bs($row>1 ? ' rows affected' : ' row affected'));
		$ks->push_back('<br/>');
		return $ks->__toString();
	}
	if ( ! $row ) {
		$ks->push_back(io_bs('Empty set'));
		$ks->push_back('<br/>');
		return $ks->__toString();
	}
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
				$ks->push_back(io_bs($key));
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
