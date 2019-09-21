<?php

namespace _24k {
require_once "io.php";

class file {
	private $file;
	private $fname;

	function __construct($fname, $mode) {
		$this->open($fname, $mode);
	}

	function open($fname, $mode) {
		$this->file = fopen($fname, $mode);
		$this->fname = $fname;
	}

	function is_open() { return $this->file !== false; }
	function close() { fclose($this->file); $this->file = false; }

	function eof() { return feof($this->file); }

	function getline() { return fgets($this->file); }
	function getall() { return fread($this->file, filesize($this->fname)); }

	function wall() {
		$this->rewind();
		if ( func_num_args() )
			fwrite(func_get_arg(0), $this->getall());
		else
			echo $this->getall();
	}

	function pall() {
		$this->rewind();
		$bs = io_bs( $this->getall() );
		if ( func_num_args() )
			fwrite(func_get_arg(0), $bs);
		else
			echo $bs;
	}

	function rewind() { rewind($this->file); }
}

}

?>
