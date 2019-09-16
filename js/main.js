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
string.prototype.front = function() { return this.arr[0]; };
string.prototype.back = function() { return this.arr[this.arr.length-1]; };
string.prototype.empty = function() { return this.arr.length == 0; };
string.prototype.clear = function() { this.arr.length = 0; };
string.prototype.reverse = function() { this.arr.reverse(); };
string.prototype.insert = function(index, c) { this.arr.splice(index, 0, c); };
string.prototype.erase = function(index) { this.arr.splice(index, 1); };
string.prototype.push_back = function(c) { this.arr.push(c); };
string.prototype.pop_back = function() { this.arr.pop(); };
string.prototype.append = function(s) {
	var i;
	if ( s instanceof string )
		for (i=0; i<s.size(); ++i)
			this.push_back( s.at(i) );
	else
		for (i=0; i<s.length; ++i)
			this.push_back( s.charAt(i) );
};


var i, s = new string("hello");
for (i=0; i<s.size(); ++i)
	write(s.at(i));
ln();


ln();
writeln("--------------- All OK ---------------");

