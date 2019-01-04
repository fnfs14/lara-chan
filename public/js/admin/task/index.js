$('[data-toggle="tooltip"]').livequery(function() { // run tooltip when it loaded
	$(this).tooltip();
});
$('.progress .progress-bar').livequery(function() { // run progress-bar when it loaded
	$(this).progressbar();
});
$('.dropdown-menu').livequery(function() { // run dropdown when it loaded
	$('.dropdown-toggle').dropdown();
});
function getDesc(a){ // modal description
	var txt = "<h2>Retrieving data.</h2>";
	loadLoader(txt);
	$('#description').css('z-index','1052');
	var pk = $(a).attr('primaryKey');
	$.ajax({
		url: _urlData+"/desc/"+pk,
		success: function(r){
			$("#description strong").html(r.title); // return title
			$("#description .modal-footer").html(r.description); // return description
			$("#description").modal("show");
		},
		error: function(r){
			_pNotify('Task',"Error 4 : An error has been occured, please contact your Admin.","danger");
		}
	})
	.done(function (data) {
		unloadLoader();
	});
}
function toSub(id){ // load sub task
	window.location = _url + "/" + id;
	console.log("b");
}
function create_progress_bar(percentage){ // create progress bar
	var progress = document.createElement("div");
	progress.setAttribute('class','progress right mrg-btm-0');
	progress.setAttribute('title',percentage+'%');
	progress.setAttribute('data-toggle','tooltip');
	progress.setAttribute('data-placement','top');
		var progressBar = document.createElement("div");
		progressBar.setAttribute('class','progress-bar progress-bar-'+progressz(percentage));
		progressBar.setAttribute('data-transitiongoal',percentage);
	progress.appendChild(progressBar);
	return progress;
}
function create_content(id,title,percentage,child){ // create task
	var onclick = 'toSub("'+id+'")';
	if(child==0){
		onclick = 'perc("'+id+'")';
	}
	var row = document.createElement("div");
	row.setAttribute('class','alert alert-info bg-second alert-dismissible fade in row');
	row.setAttribute('row','alert');
	row.setAttribute('onclick',onclick);
	row.setAttribute('id',id);
		var colFirst = document.createElement("div");
		colFirst.setAttribute('class','col-md-6');
			var label = document.createTextNode(title);
		colFirst.appendChild(label);
	row.appendChild(colFirst);
		var colSecond = document.createElement("div");
		colSecond.setAttribute('class','col-md-6 divProgress');
		var progress = create_progress_bar(percentage);
		colSecond.appendChild(progress);
	row.appendChild(colSecond);
	document.getElementById('x_content').appendChild(row);
}
function create_empty(){ // create empty alert
	var row = document.createElement("div");
	row.setAttribute('class','alert alert-info bg-second alert-dismissible fade in row');
	row.setAttribute('row','alert');
		var colFirst = document.createElement("div");
		colFirst.setAttribute('class','col-md-12');
			var center = document.createElement("center");
				var text = document.createTextNode("No data available.");
	center.appendChild(text);
	colFirst.appendChild(center);
	row.appendChild(colFirst);
	document.getElementById('x_content').appendChild(row);
}
function create_load_more(offset){ // create button load more
	var row = document.createElement("div");
	row.setAttribute('class','alert alert-info bg-third alert-dismissible fade in row pdg-5 load_more');
	row.setAttribute('row','alert');
	row.setAttribute('onclick','get_data('+_parent+','+_offset+')');
		var colFirst = document.createElement("div");
		colFirst.setAttribute('class','col-md-12');
			var center = document.createElement("center");
				var label = document.createTextNode("Load More");
	center.appendChild(label);
	colFirst.appendChild(center);
	row.appendChild(colFirst);
	document.getElementById('x_content').appendChild(row);
}
function get_data(parent,offset){ // return data based on it parent
	var txt = "<h2>Retrieving data.</h2>";
	loadLoader(txt);
	$.ajax({
		url: _urlData+"/"+parent+"/"+offset,
		success: function(r){
			r = JSON.parse(r);
			if(r.length==0){ // if empty
				create_empty();
			}else{ // if not empty
				for(var a=0; a<r.length; a++){ // return data
					var z = r[a];
					create_content(z.id,z.title,z.perc,z.child);
				}
				_offset+=5;
				$(".load_more").remove();
				if(_offset<_countAllData){ // create button load more if needed
					create_load_more(_offset);
				}
			}
		},
		error: function(r){
			_pNotify('Task',"Error 1 : An error has been occured, please contact your Admin.","danger");
		}
	})
	.done(function (data) {
		unloadLoader();
	});
}
function doDelete(id,title){ // open delete modal
	$("#delete form").attr('action',_url+'/'+id);
	$("#delete strong").html(title);
	$("#delete").modal('show');
	$("#delete").css('z-index',1051);
}
function progressz(value){ // progress
	result = '';
	if(value==100){
		result = 'success';
	}else if(value>=75){
		result = 'primary';
	}else if(value>=50){
		result = 'info';
	}else if(value>=25){
		result = 'warning';
	}else if(value>=0){
		result = 'danger';
	}
	return result;
}
function perc(a){ // open progress modal
	var txt = "<h2>Retrieving data.</h2>";
	loadLoader(txt);
	$.ajax({
		url: _urlData+"/"+a+"/"+0+"?perc=1",
		success: function(r){
			r = JSON.parse(r)[0];
			$("#perc strong").html(r.title); // return title
			$("#perc .btn-primary").attr('href',_url+"/create?t="+a);
			$("#perc #perc-detail").attr('onclick',"toSub('"+a+"')");
			$("#perc #perc-desc").attr('primaryKey',a);
			$("#perc .btn-danger").attr('onclick',"doDelete('"+a+"','"+r.title+"')");
			$("#perc").modal('show');
			$('#perc .knob').val(r.perc).trigger('change');
			$(".knob").knob({
				release: function (v) { // update progress
					updatePerc($("#perc #perc-desc").attr('primaryKey'),v);
				}
			});
		},
		error: function(r){
			_pNotify('Task',"Error 2 : An error has been occured, please contact your Admin.","danger");
		}
	})
	.done(function (data) {
		unloadLoader();
	});
}
function updatePerc(a,perc){ // update progress
	var txt = "<h2>Updating data.</h2>";
	loadLoader(txt);
	$.ajax({
		url: _urlUpdPerc+"/"+a+"/"+perc,
		success: function(r){
			_pNotify('Task',"Successfully updated.","success");
			var progress = create_progress_bar(r); // update progress
			$("#"+a).find(".divProgress").html(progress);
		},
		error: function(r){
			_pNotify('Task',"Error 3 : An error has been occured, please contact your Admin.","danger");
		}
	})
	.done(function (data) {
		unloadLoader();
	});
}
get_data(_parent,_offset); // get data