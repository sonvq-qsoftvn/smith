// JavaScript Document

var confirm = false;
$(document).ready(function(){
	$('#main input').each(function() {
		$(this).change(function() {
			confirm = true;
		});
	});
});

function disableConfirm() {
	confirm = false;
}

function confirmLeave(e) {
	if (!confirm) {
		return;
	}

    if (!e) e = window.event;
    e.cancelBubble = true;
    e.returnValue = 'U heeft bepaalde wijzigingen nog niet opgeslagen.';

    if (e.stopPropagation) {
    	e.stopPropagation();
        e.preventDefault();
    }
}

window.onbeforeunload = confirmLeave;


