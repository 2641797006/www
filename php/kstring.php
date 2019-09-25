<?php

namespace _24k {
// TODO: use _24k\kstring;

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
	function insert($index, $s) {
		$size = strlen($s);
		if ( ! $size )
			$size = 1;
		array_splice($this->arr, $index, 0, str_split($s));
		$this->size += $size;
	}
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

		$sz = $this->size;
		$this->size = $s->size;
		$s->size = $sz;

		$this->rewind();
		$s->rewind();
	}
	function findc($c) {
		$pos = func_num_args()>1 ? func_get_arg(1) : 0;
		$size = $this->size();
		for ($i=$pos; $i<$size; ++$i)
			if ($this->at($i) == $c)
				return $i;
		return -1;
	}

	function set($index, $c) { $this->arr[index] = $c; }

	function null2s() {
		if ( ! func_num_args() )
			$s = 'NULL';
		else
			$s = func_get_arg(0);
		$size = $this->size();
		for ($i=0; $i<$size; ++$i)
			if ($this->arr[$i] == "")
				$this->arr[$i] = $s;
	}

	function dump() {
		var_dump($this->arr);
		var_dump($this->size);
	}
}

}

?>
