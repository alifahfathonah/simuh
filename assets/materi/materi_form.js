$(document).ready(function () {
	$("#uploadf").click(function () {
		$("#inputFile").show();
		$("#linkFile").hide();
	});
	$("#link").click(function () {
		$("#inputFile").hide();
		$("#linkFile").show();
	});
});
