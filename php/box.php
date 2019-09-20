<?php

namespace _24k {
require_once 'kstring.php';

class box {
	private $align;
	private $px, $pa, $pyl, $pyr;
	private $pa_sz, $pyl_sz, $pyr_sz;
	private $width;
	private $buffer;

	function __construct($px, $pa, $pyl, $pyr) {
		$this->align = 0;

		$this->px = $px;
		$this->pa = $pa;
		$this->pyl = $pyl;
		$this->pyr = $pyr;

		$this->pa_sz = strlen($pa);
		$this->pyl_sz = strlen($pyl);
		$this->pyr_sz = strlen($pyr);

		$this->width = 0;
		$this->buffer = new kstring();
	}
	function __toString() { return $this->buffer->__toString(); }

	function set_align($a) { $this->align = $a; }
	function clear() { $this->buffer->clear(); }
	function buttom($n) {
		$w = $n + $this->pyl_sz + $this->pyr_sz - $this->pa_sz * 2;
		$this->buffer->append( $this->pa );
		for ($i=0; $i<$w; ++$i)
			$this->buffer->push_back($this->px);
		$this->buffer->append( $this->pa );
		$this->buffer->push_back("\n");
	}

	function line(kstring $s, $pos1, $pos2) {
		$wd = $this->width - $this->width_fix($s, $pos1, $pos2);
		if ($this->align < 0) {
			$left = 0;
			$right = $wd;
		} else if ($this->align > 0) {
			$left = $wd;
			$right = 0;
		} else {
			$left = intdiv($wd, 2);
			$right = $wd - $left;
		}
		$this->buffer->append($this->pyl);
		for ($i=0; $i<$left; ++$i)
			$this->buffer->push_back(' ');
		for ($i=$pos1; $i<$pos2; ++$i)
			$this->buffer->push_back( $s->at($i) );
		for ($i=0; $i<$right; ++$i)
			$this->buffer->push_back(' ');
		$this->buffer->append($this->pyr);
		$this->buffer->push_back("\n");
	}

	function box(kstring $s) {
		$pos1=0;
		$this->kstring_width($s);
		$this->frame_width_fix();
		$this->buttom( $this->width );
		$size = $s->size();
		for ( ; $pos1 < $size; ) {
			$pos2 = $s->findc("\n", $pos1);
			if ($pos2 == -1)
				$pos2 = $size;
			$this->line($s, $pos1, $pos2);
			$pos1 = $pos2 + 1;
		}
		$this->buttom( $this->width );
		return $this;
	}

	// fix string width for chinese
	function width_fix($s, $pos1, $pos2) {
		// do nothing ...
		return $pos2 - $pos1;
	}

	function kstring_width(kstring $s) {
		$pos1=0; $width=0;
		$size = $s->size();
		for ( ; $pos1 < $size; ) {
			$pos2 = $s->findc("\n", $pos1);
			if ($pos2 == -1)
				$pos2 = $size;
			$subw = $this->width_fix($s, $pos1, $pos2);
			if ($subw > $width)
				$width = $subw;
			$pos1 = $pos2 + 1;
		}
		$this->width = $width;
		return $width;
	}

	function frame_width_fix() {
		// fix frame width for Chinese ...
	}

	function multi($n) {
		$s = new kstring();
		for ($i=0; $i<$n; ++$i) {
			$s->clear();
			$s->swap($this->buffer);
			$this->box($s);
		}
	}

	function buffer() { return $this->buffer; }

}

}

?>
