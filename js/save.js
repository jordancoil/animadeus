$(document).ready(function(){

	$("#bgurl").val($("#backdrop").attr('style'));

	$("#fgurl").val($("#foreground").attr('style'));

	$("#opt-text").val($("#temp-slogan").html());

	$(".change-icons").click(function(){

		$("#bgurl").val($("#backdrop").attr('style'));

		$("#fgurl").val($("#foreground").attr('style'));

	})

})
