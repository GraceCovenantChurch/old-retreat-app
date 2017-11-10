var showing = null;
var allowed = ['jesus','involved','resources','contact','staff','welcome',''];
$(document).ready(function() {
	$("a[href^='#load']").click(function() { 
		load($(this).attr("rel"));
		return false;
	});
	
	var r = SWFAddress.getPathNames();
	load(r[0]);
});

function isValid(n) {
	return (jQuery.inArray(n, allowed) != -1);
}

function load(targetId) {
	if (!isValid(targetId)) {
		return;
	}
	if (showing != targetId) {
			$("#contents").slideUp("normal", function() {
				var targetContent = 'c-'+targetId; 
				$("#contents").html($('#'+targetContent).html());
				$("#contents").prepend("<a class='closer' href='javascript:close(); void(0);'>close</a>").hide(500, function() {
					$("#contents").slideDown();
				});
			});
			showing = targetId;
			SWFAddress.setValue('/'+targetId+'/');
		} else { // they are equal
			close();
		}
}

function close() {
	$("#contents").slideUp(); // hide
	showing = null;
	SWFAddress.setValue('/'); 
}

SWFAddress.onChange = function() {  
     if (showing != SWFAddress.getPathNames()[0]) {
		load(SWFAddress.getPathNames()[0]);
	 }
}
