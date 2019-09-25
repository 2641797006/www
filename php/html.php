<?php

namespace _24k {
require_once "file.php";
// TODO: // use _24k\html;

class html {
	private static $begin = ".begin", $end = ".end", $path = "file/";

	private $file_begin, $file_end;

	function __construct($fname) {
		$this->file_begin = new file(self::$path.$fname.self::$begin, "r");
		$this->file_end = new file(self::$path.$fname.self::$end, "r");
	}

	function write($s) {
		$this->begin();
		echo $s;
		$this->end();
	}

	function begin() { $this->file_begin->wall(); }
	function end() { $this->file_end->wall(); }
}

}

?>
