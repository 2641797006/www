var pairNum = 0;

function done() {
	var form = document.getElementById('do_form');

	var a = document.getElementsByName("method");
	for (var i=0; i<a.length; ++i)
		if (a[i].checked)
			form.method = a[i].value;

	var av = document.getElementById('form_action').value;
	var http = 'http://', https = 'https://';
	if (av == http || av == https)
		return false;
	if ( ! av.startsWith(http) && ! av.startsWith(https) )
		av = http + av;
	form.action = av;
	for (var i=0; i<=pairNum; ++i) {
		var a = document.getElementById("pair"+i).getElementsByTagName("input");
		a[1].name = a[0].value
	}
	save();
}


function save() {
	var a = document.getElementsByName("method");
	var method = a[0].checked ? true : false;
	var av = document.getElementById('form_action').value;

	var pairArray = new Array();
	for (var i=0; i<=pairNum; ++i) {
		var a = document.getElementById("pair"+i).getElementsByTagName("input");
		var pair = new Pair(a[0].value, a[1].value);
		pairArray.push(pair);
	}

	localStorage.method = JSON.stringify(method);
	localStorage.action = av;
	localStorage.pairNum = JSON.stringify(pairNum);
	localStorage.pairArray = JSON.stringify(pairArray);
}


function load() {
	var method = JSON.parse(localStorage.method);
	var av = localStorage.action;
	var n = JSON.parse(localStorage.pairNum);
	var pairArray = JSON.parse(localStorage.pairArray);

	if (method==null || av==null || n==null || pairArray==null)
		return;

	var a = document.getElementsByName("method");
	var i = method ? 0 : 1;
	a[i].checked = true;

	var action = document.getElementById('form_action');
	action.value = av;

	var a = document.getElementById("pair0").getElementsByTagName("input");
	var pair = pairArray[0];
	a[0].value = pair.first || "";
	a[1].value = pair.second || "";

	for (var i=1; i<=n; ++i) {
		pair = pairArray[i];
		addPair(pair.first, pair.second);
	}
}


function Pair(first, second) {
	this.first = first;
	this.second = second;
}


function addPair(name, value) {
	pairNum++;

	if (name == null ) name = "";
	if (value == null ) value = "";

	var add = document.getElementById('add');
	var group = document.createElement("div");
	group.setAttribute("id", "pair"+pairNum);


	var div = document.createElement("div");
	div.setAttribute("class", "input-group");

	var span = document.createElement("span");
	span.setAttribute("class", "input-group-btn");
	var button = document.createElement("div");
	button.setAttribute("class", "btn btn-default prompt");
	button.type = button;
	button.disabled = true;
	button.innerHTML = "name";

	var input = document.createElement("input");
	input.setAttribute("class", "form-control");
	input.type = "text";
	input.value = name;

	span.appendChild(button);
	div.appendChild(span);
	div.appendChild(input);
	group.appendChild(div);

	div = div.cloneNode(false);
	span = span.cloneNode(false);
	button = button.cloneNode(false);
	button.innerHTML = "value";
	input = input.cloneNode(false);
	input.value = value;

	span.appendChild(button);
	div.appendChild(span);
	div.appendChild(input);
	group.appendChild(div);
	group.appendChild(document.createElement("br"));

	add.appendChild(group);
}


function delPair() {
	if (pairNum <= 0)
		return;
	var node = document.getElementById("pair"+pairNum);
	node.parentNode.removeChild(node);
	pairNum--;
}

