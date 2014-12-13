function popup(url, w, h) {
	w = w ? w : 600;
	h = h ? h : 500;
	var w = window.open(url, 'popup', 'width=' + w + ',height=' + h + ',scrollbars=yes,toolbar=no,location=no,top=10,left=10');
	return false;
}
