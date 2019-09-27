<?php

namespace _24k{
//TODO: use function _24k\{io_bs, ln, write, writeln, warr, warrln, wout, woutln, werr, werrln};
// use "\n" instead of PHP_EOL

function io_bs($s) {
	static $find = array('&', ' ', '"', '<', '>', "\n");
	static $replace = array('&amp;', '&nbsp;', '&quot;', '&lt;', '&gt;', '<br/>');
	return str_replace($find, $replace, $s);
}

if ( isset($IO_HTML) && $IO_HTML ) {
// write to HTML
function ln() { echo '<br />'; }
function write($s) { echo io_bs($s); }
} else {
// write to terminal
function ln() { echo "\n"; }
function write($s) { echo $s; }
}

function writeln($s) { write($s); ln(); }

function warr($arr) {
	$se = func_num_args()>1 ? func_get_arg(1) : ',';
	write( join($se, $arr) );
}

function warrln($arr) {
	$se = func_num_args()>1 ? func_get_arg(1) : ',';
	writeln( join($se, $arr) );
}

function wout($s) { fwrite(STDOUT, $s); }
function woutln($s) { fwrite(STDOUT, $s); fwrite(STDOUT, "\n"); }
function werr($s) { fwrite(STDERR, $s); }
function werrln($s) { fwrite(STDERR, $s); fwrite(STDERR, "\n"); }

}

?>
