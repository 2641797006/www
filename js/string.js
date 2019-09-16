function string() {
	this.arr = [];
	if ( arguments.length )
		this.assign(arguments[0]);
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
		s = s.toString();
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
	else {
		s = s.toString();
		for (i=0; i<s.length; ++i)
			this.push_back( s.charAt(i) );
	}
};

string.prototype.replace = function(index, count, s) {
	var i;
	s = s.toString();
	this.arr.splice(index, count);
	for (i=0; i<s.length; ++i)
		this.insert(index++, s.charAt(i));
};

string.prototype.substr = function(index, count) {
	return new string( this.arr.slice(index, index+count).join("") );
};

string.prototype.swap = function(s) {
	var tmp = s.arr;
	s.arr = this.arr;
	this.arr = tmp;
};

string.prototype.findc = function(index, c) {
	var i;
	for (i=index; i<this.arr.length; ++i)
		if ( this.arr[i] == c )
			return i;
	return -1;
};

