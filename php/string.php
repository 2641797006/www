#!/usr/bin/env php
<?php

namespace _24k {
require_once 'io.php';

class kstring implements \Iterator{
	private $arr;
	private $it_pos;

	function __construct() {
		if ( func_num_args() )
			$this->arr = str_split( func_get_arg(0) );
		else
			$this->arr = array();
		$this->rewind();
	}

	function __clone() { $this->arr = $this->arr; }
	function __toString() { return join('', $this->arr); }

	function assign($s) { $this->arr = str_split($s); }

	function at($i) { return $this->arr[$i]; }
	function front() { return $this->at(0); }
	function back() { return $this->at( $this->size()-1 ); }

	function current() { return $this->at($this->key()); }
	function key() { return $this->it_pos; }
	function next() { ++$this->it_pos; }
	function rewind() { $this->it_pos = 0; }
	function valid() { return isset($this->arr[$this->key()]); }

	function empty() { return ! $this->size(); }
	function size() { return sizeof($this->arr); }
	function reverse() { $this->arr = array_reverse($this->arr); }

	function clear() { array_splice($this->arr, 0); $this->rewind(); }
	function insert($index, $s) { array_splice($this->arr, $index, 0, str_split($s)); }
	function erase($index, $count) { array_splice($this->arr, $index, $count); }
	function push_back($s) { $this->insert($this->size(), $s); }
	function pop_back() { $this->erase($this->size()-1, 1); }
	function append($s) { $this->push_back($s); }
	function replace($index, $count, $s) {
		array_splice($this->arr, $index, $count, str_split($s));
	}
	function substr($index, $count) {
		$s = new kstring();
		$s->arr = array_splice($this->arr, $index, $count, false);
		return $s;
	}
	function swap($s) {
		$this->arr = $s->arr;
	}
}

$x = new kstring("HELLO");
writeln($x);

}

?>
