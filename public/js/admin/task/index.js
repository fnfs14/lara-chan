$('[data-toggle="tooltip"]').livequery(function() {
	$(this).tooltip();
});
$('.progress .progress-bar').livequery(function() {
	$(this).progressbar();
});
$('.dropdown-menu').livequery(function() {
	$('.dropdown-toggle').dropdown();
});
function toSub(id){
	window.location = _url + "/" + id;
	console.log("b");
}
function create_content(id,title,percentage,child){
	var onclick = 'toSub("'+id+'")';
	if(child==0){
		onclick = 'perc("'+id+'")';
	}
	var row = document.createElement("div");
	row.setAttribute('class','alert alert-info bg-second alert-dismissible fade in row');
	row.setAttribute('row','alert');
	row.setAttribute('onclick',onclick);
		var colFirst = document.createElement("div");
		colFirst.setAttribute('class','col-md-6');
			var label = document.createTextNode(title);
		colFirst.appendChild(label);
	row.appendChild(colFirst);
		var colSecond = document.createElement("div");
		colSecond.setAttribute('class','col-md-6');
			var progress = document.createElement("div");
			progress.setAttribute('class','progress right mrg-btm-0');
			progress.setAttribute('title',percentage+'%');
			progress.setAttribute('data-toggle','tooltip');
			progress.setAttribute('data-placement','top');
				var progressBar = document.createElement("div");
				progressBar.setAttribute('class','progress-bar progress-bar-'+progressz(percentage));
				progressBar.setAttribute('data-transitiongoal',percentage);
			progress.appendChild(progressBar);
		colSecond.appendChild(progress);
	row.appendChild(colSecond);
	document.getElementById('x_content').appendChild(row);
}
function create_empty(){
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
function create_load_more(offset){
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
function get_data(parent,offset){
	$.ajax({
		url: _urlData+"/"+parent+"/"+offset,
		success: function(r){
			r = JSON.parse(r);
			if(r.length==0){
				create_empty();
			}else{
				for(var a=0; a<r.length; a++){
					var z = r[a];
					create_content(z.id,z.title,z.perc,z.child);
				}
				_offset+=5;
				$(".load_more").remove();
				if(_offset<=_countAllData){					
					create_load_more(_offset);
				}
			}
		},
		error: function(r){
			new PNotify({
				title: 'Task',
				text: "Error 1 : An error has been occured, please contact your admin.",
				type: "danger",
				styling: 'bootstrap3'
			});
		}
	});
}
function doDelete(id,title){
	$("#delete form").attr('action',_url+'/'+id);
	$("#delete strong").html(title);
	$("#delete").modal('show');
}
function progressz(value){	
	result = '';
	if(value==100){
		result = 'success';
	}else if(value>=75){
		result = 'primary';
	}else if(value>=40){
		result = 'warning';
	}else if(value>=0){
		result = 'danger';
	}
	return result;
}
function perc(a){
	$.ajax({
		url: _urlData+"/"+a+"/"+0+"?perc=1",
		success: function(r){
			r = JSON.parse(r)[0];
			$("#perc strong").html(r.title);
			$("#perc .knob").val(r.perc);
			$("#perc").modal('show');
			$(".knob").knob({
				change: function (v) {
					updatePerc(a,v);
				}
			});
		},
		error: function(r){
			new PNotify({
				title: 'Task',
				text: "Error 2 : An error has been occured, please contact your admin.",
				type: "danger",
				styling: 'bootstrap3'
			});
		}
	});
}
function updatePerc(id,perc){
	$.ajax({
		url: _urlData+"/"+a+"/"+0+"?perc=1",
		success: function(r){
			r = JSON.parse(r)[0];
		},
		error: function(r){
			new PNotify({
				title: 'Task',
				text: "Error 2 : An error has been occured, please contact your admin.",
				type: "danger",
				styling: 'bootstrap3'
			});
		}
	});
}
get_data(_parent,_offset);