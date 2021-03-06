function showDialog(win, link) {
	$(win).dialog({
		bgiframe: true,
		resizable: false,
		height: 160,
		width: 500,
		modal: true,
		position: 'center',
		overlay: {
			backgroundColor: '#000',
			opacity: 0.5
		},
		buttons: {
			'Yes': function() {
				window.location = link;
				$(this).dialog('close');
			},
			No: function() {
				$(this).dialog('destroy');
			}
		}
	});
}