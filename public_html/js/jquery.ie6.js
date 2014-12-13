(function($){
   $(function(){
		var message = "<a href=\"#\" id=\"close-ie6-dialog\" style=\"float:right;\">Sluit dit venster (X)</a><p style=\"margin-top:20px;\">Beste</p>"
			+ "<p>Wij merken dat u het internet verkent met Microsoft Internet Explorer 6 (IE6). Die versie van Internet Explorer wordt echter niet ondersteund door deze website. De inhoud en de werking van deze website is bijgevolg niet gegarandeerd.</p>"
	      	+ "<p>Het gebruik van IE6 is bovendien onveilig, aangezien er geen beveiligingsupdates meer voor worden voorzien. Om dit probleem op te lossen installeert u best de nieuwste versie van uw browser.</p>"
	      	+ "<p>Bedankt voor uw begrip.<br /><a style=\"color:#fff!important;text-decoration:underline;\" href=\"http://www.sanmax.be/\">www.sanmax.be</a></p>";

		div = $('<div id="ie-warning"></div>').html(message).css({
			   'width': '400px',
			   'height': '250px',
			   'left': '50%',
			   'margin-left': '-200px',
			   'top': '50%',
			   'margin-top': '-120px',
			   'padding': '15px',
			   'background-color':'#000',
			   'text-align':'left',
			   'font-size':'12px',
			   'color':'#fff',
			   'position': 'absolute'
		}).hide().find('a').css({color:'#fff','text-decoration':'underline'}).end();

		div.prependTo(document.body).slideDown(500);

		$('#close-ie6-dialog').on('click', function() {
			$('#ie-warning').hide();
		});
	});
})(jQuery);