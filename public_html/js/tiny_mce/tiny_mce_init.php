<script language="javascript" type="text/javascript">
tinyMCE.init({
	language : 'nl',
	theme : "advanced",
    mode : "textareas",
    editor_selector : "mceEditor",
	body_id : "content",
    plugins : "filemanager,imagemanager,style,layer,table,save,advhr,advlink,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,filemanager",
    theme_advanced_buttons1 : "code,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,|,insertdate,inserttime",
    theme_advanced_buttons2 : "forecolor,backcolor,|,charmap,media,advhr,|,print,|,ltr,rtl,|,fullscreen,|,tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,ibrowser",
    theme_advanced_buttons3 : "styleselect,formatselect,fontselect,fontsizeselect,|,visualchars,nonbreaking,insertimage,template,preview",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_styles : "Opsomming zonder insprong=no-margin;Tabellijnen=borders", 
    //content_css : "/css/Site.css?" + new Date().getTime(),
	relative_urls : false,
	document_base_url : "/klavinfo/",
	lng : "<?php echo $_SESSION['System']['lng'] ?>",
	font_size_style_values : "10pt,11pt,12pt,14pt,18pt,24pt,36pt,48pt",
	// Style formats
	style_formats : [
	{title : 'Opsomming zonder insprong', selector : 'ul', classes : 'no-margin '},
	{title : 'Opsomming zonder witregel', selector : 'ul', classes : 'no-br '},
	{title : 'Opsomming met extra insprong', selector : 'ul', classes : 'extra-margin '}
	],
	extended_valid_elements : "iframe[src|width|height|name|align]"
});
</script>