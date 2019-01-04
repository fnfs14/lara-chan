function _pNotify(title,text,type){
	new PNotify({
		title: title,
		text: text,
		type: type,
		styling: 'bootstrap3'
	});
}
function loadLoader(txt){
	$("#loader").modal({
		backdrop: "static", //remove ability to close modal with click
		keyboard: false, //remove option to close with keyboard
		show: true //Display loader!
	});
	$("#loader .loader-txt").html(txt)
}
function unloadLoader(){
	$("#loader").modal("hide");
	$("#loader .loader-txt").html()
}