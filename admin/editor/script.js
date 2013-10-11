function replaceAll (a, b, str) {
	while (true) {
		var pStr = str;
		str = str.replace(a, b);
		if (pStr == str) {
			break;
		}
	}
	return str;
}

function updateSlug (element) {
	if (document.getElementById('slugAutoUpdate').checked) {
		str = element.value;
		str = str.toLowerCase();
		str = replaceAll(' ', '_', str);
		str = str.replace(/\W/g, '')
		
		document.getElementById('slug').value = str;
	}

}

function updatePreview (id) {
	var element = document.getElementById(id);
	str = element.value;
	str = replaceAll('<?php', "(this is a server side script)<div class='hidden'>", str);
	str = replaceAll('?>', "</div>", str);
	
	str += "_";
	
	document.getElementById('preview').innerHTML = str;
}

function init() {
	updatePreview('content');
}