function ln() { document.write("<br />"); }

function write(s) {
	if (s == undefined)
		document.write(s);
	else
		document.write( s.toString().replace(/\n/g, "<br />") );
}

function writeln(s) { write(s); ln(); }

