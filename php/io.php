<?php

namespace _24k{
//TODO: use function _24k\{ln, write, writeln, warr, warrln};

// use "\n" instead of PHP_EOL


// write to HTML
function ln() { echo '<br />'; }
function write($s) {
	static $find = array(" ", "\n");
	static $replace = array('&nbsp;', '<br />');
	echo str_replace($find, $replace, $s);
}
/*
// write to terminal
function ln() { echo "\n"; }
function write($s) { echo $s; }
*/

function writeln($s) { write($s); ln(); }

function warr($arr) {
	$se = func_num_args()>1 ? func_get_arg(1) : ',';
	write( join($se, $arr) );
}

function warrln($arr) {
	$se = func_num_args()>1 ? func_get_arg(1) : ',';
	writeln( join($se, $arr) );
}

}

?>
