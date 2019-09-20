<?php

namespace _24k {

class kstring implements \Iterator{
	private $arr;
	private $size;
	private $it_pos;

	function __construct() {
		if ( func_num_args() )
			$this->assign( func_get_arg(0) );
		else {
			$this->arr = array();
			$this->size = 0;
		}
		$this->rewind();
	}

	function __clone() { $this->rewind(); }
	function __toString() { return join('', $this->arr); }

	function assign($s) { $this->arr = str_split($s); $this->size = strlen($s); }

	function at($i) { return $this->arr[$i]; }
	function front() { return $this->at(0); }
	function back() { return $this->at( $this->size()-1 ); }

	function current() { return $this->at($this->key()); }
	function key() { return $this->it_pos; }
	function next() { ++$this->it_pos; }
	function rewind() { $this->it_pos = 0; }
	function valid() { return isset($this->arr[$this->key()]); }

	function empty() { return ! $this->size(); }
	function size() { return $this->size; }
	function reverse() { $this->arr = array_reverse($this->arr); $this->rewind(); }

	function clear() { $this->arr = array(); $this->size = 0; $this->rewind(); }
	function insert($index, $s) { array_splice($this->arr, $index, 0, str_split($s)); $this->size += strlen($s); }
	function erase($index, $count) { array_splice($this->arr, $index, $count); $this->size -= $count; }
	function push_back($c) { array_push($this->arr, $c); ++$this->size; }
	function pop_back() { array_pop($this->arr); --$this->size; }
	function append($s) { $this->insert( $this->size(), $s ); }
	function replace($index, $count, $s) {
		array_splice($this->arr, $index, $count, str_split($s));
		$this->size += (-$count + strlen($s));
	}
	function substr($index, $count) {
		$s = new kstring();
		$s->arr = array_splice($this->arr, $index, $count);
		$s->size = $count;
		$this->size -= $count;
		return $s;
	}
	function swap(kstring $s) {
		$a = &$this->arr;
		$this->arr = &$s->arr;
		$s->arr = &$a;
		$this->rewind();
		$s->rewind();
	}
	function findc($c) {
		$index = array_search($c, $this->arr);
		return $index!==false ? $index : -1;
	}
}

}

?>
