function ln() { document.write("<br />"); }
function write(s) { document.write(s); }
function writeln(s) { document.write(s); ln(); }

function string() {
	this.arr = [];
	if ( arguments.length ) {
		var i, s = arguments[0];
		this.assign(s);
	}
}

string.prototype.at = function(index) { return this.arr[index]; };
string.prototype.size = function() { return this.arr.length; };
string.prototype.toString = function() { return this.arr.join(""); };
string.prototype.assign = function(s) {
	if ( s instanceof string )
		this.arr = [...s.arr];
	else {
		var i;
		this.arr.length = 0;
		for (i in s)
			this.arr.push( s.charAt(i) );
	}
};

var i, s = new string("hello");
for (i=0; i<s.size(); ++i)
	writeln(s.at(i));

ln();
writeln("--------------- All OK ---------------");

