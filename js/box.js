function box(px, pa, pyl, pyr) {
	this.align = 0;
	this.px = px;
	this.pa = pa;
	this.pyl = pyl;
	this.pyr = pyr;
	this.width = 0;
	this.buffer = new string("");
}

box.prototype.set_align = function(a) { this.align = a; };
box.prototype.buttom = function(n) {
	var i, w;
	w = n + this.pyl.length + this.pyr.length - this.pa.length * 2;
	this.buffer.append(this.pa);
	for (i=0; i<w; ++i)
		this.buffer.append(this.px);
	this.buffer.append(this.pa);
	this.buffer.push_back('\n');
};

box.prototype.width = function(s) {
	var pos1=0, pos2, subw, width;
	for ( ; pos1 < s.size(); ) {
		pos2 = s.findc(pos1, '\n');
		if (pos2 == -1)
			pos2 = s.size();
		subw = pos2 - pos1;
//		subw = this.width_fix(s, pos1, pos2);
		if (subw > width)
			width = subw;
		pos1 = pos2 + 1;
	}
	this.width = width;
	return width;
};

box.prototype.line = function(s, pos1, pos2) {
	var c, i, wd, left, right;
//	wd
};

var b = new box('-', "+", "| ", " |");
b.buttom(16);
write(b.buffer);
writeln("| 啦啦啦啦啦啦啦啦 |");

writeln("\n------------------ ALL OK ------------------");
