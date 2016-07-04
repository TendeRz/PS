var socket = io();

var url = window.location.href;
console.log(url);

function checkallcountries(){           
	$('input:checkbox').prop('checked', true);
};

function uncheckallcountries(){         
	$('input:checkbox').prop('checked', false);
};

function checkTasks(){
	$('.taskrow').each(function(){
		var tasktime = $(this).children('.tasktime').text();
		var status = $(this).children('.status').text();
		var taskdate = $(this).children('.taskdate').text();
		var now = new Date(Date.now());
		var startdate = now.getFullYear() + "/" + taskdate.substr(0, 2) + "/" + taskdate.substr(3, 2);
		var curdate = now.getFullYear() + "/" + (now.getMonth() + 1) + "/" + now.getDate();
		var curtime = now.getHours() + ":" + now.getMinutes();
		var timedifference = ( new Date(startdate + " " + tasktime ) - new Date(curdate + " " + curtime) ) / 60000;				

		if ((status == 'Not possible now') || (status == 'Problem')){
			$(this).addClass('task-notpossible');
		} else if (((status == 'To be done') || (status == 'Check result')) && (timedifference <= 0)) {
			$(this).addClass('task-missed');
		}else if (((status == 'To be done') || (status == 'Check result')) && (timedifference <= 5)) {
			$(this).addClass('task-late');
		}else if (status == 'In progress'){
			$(this).addClass('task-inprogress');
		}
	})
}

function selectcountries() {

	var selected = $( "input:checked" ).map(function() {
		return this.value;
	}).get().join();
	if (selected) {
		$.get( '/selectCountries', {set : selected}, function(data) {
			var setMe = selected;
			var trHTML = '';
			data.forEach(function(data){
				trHTML += '\
				<tr class="taskrow">\
				<td class="taskdate">'+data.Startdate+'</td>\
				<td class="tasktime">'+data.Starttime+'</td>\
				<td>'+data.Country+'</td>\
				<td><a href="tasks?tasklistid='+data.ID+'&taskid='+data.Taskid+'" target="_blank">'+data.Subject+'</a></td>\
				<td class="status">'+data.Status+'</td>\
				<td>'+data.System+'</td>\
				<td>'+data.Lastmod+'</td>\
				<td> <button class="btn btn-default btn-xs" type="button" data-taskid="'+data.Taskid+'"\
					data-tasklistid="'+data.ID+'" onClick="quickprogresstaskstate($(this))">Next</button></td>\
				</tr>\
				';
			})
			$('#tasklist').html(trHTML);
			checkTasks();
		})
	}else{
		$('#noCountriesModal').modal('show');
	}
};

function selectTask(tasklistid){
	$.get( '/selectTask', {tasklistid : tasklistid}, function(data) {
		var state = data.task[0].state;
		var taskid = data.task[0].taskid;
		var taskHTML = '';
		var testDescription = $('#taskDescription').val();
		if (testDescription === undefined || testDescription === null) {
     		var taskHTML2 = '';	
		}else{
			var taskHTML2 = testDescription;
		}
		taskHTML += '\
			<div class="panel panel-default">\
				<div class="panel-heading">Actions</div>\
				<div class="panel-body">\
					<input class="btn btn-primary" type="button" value="Progress"\
						onclick="quickprogresstaskstatefromtask(\''+state+'\', '+tasklistid+', '+taskid+')">\
					<input class="btn btn-warning" style="float:right" type="button" value="Close" onclick="self.close()">\
				</div>\
			</div>\
			<div class="panel panel-default">\
				<div class="panel-heading">Description</div>\
				<div class="panel-body">\
					<div class="col-sm-2">Subject: </div>\
					<div class="col-sm-10">'+ data.task[0].taskname +'</div>\
					<div class="col-sm-2">Start Date: </div>\
					<siv class="col-sm-10">'+ data.task[0].startdate +'</siv>\
					<div class="col-sm-2">Status:  </div>\
					<siv class="col-sm-10">'+ data.task[0].state +'</siv>\
				</div>\
			</div>\
			<div class="panel panel-default">\
				<div class="panel-heading">Classification</div>\
				<div class="panel-body">\
					<div class="col-sm-2">System: </div>\
					<div class="col-sm-4">'+ data.task[0].system +'</div>\
					<div class="col-sm-2">Functional Area: </div>\
					<div class="col-sm-4">'+ data.task[0].funcarea +'</div>\
					<div class="col-sm-2">Country: </div>\
					<div class="col-sm-10">'+ data.task[0].country +'</div>\
				</div>\
			</div>\
			<div class="panel panel-default">\
				<div class="panel-heading">Procedure</div>\
				<div class="panel-body">\
					<div class="col-sm-2">Procedure</div>\
					<div class="col-sm-10"><a href="procedure?procID='+ data.task[0].listproc +'" target="_blank">'+ data.task[0].procname +'</a></div>\
				</div>\
			</div>\
			<div class="panel panel-default">\
				<div class="panel-heading">Detailed Description</div>\
				<div class="panel-body">'+ data.task[0].descript +'</div>\
				<div class="panel-body">\
					<textarea id="taskDescription" class="form-control" rows="3" placeholder="Update">'+taskHTML2+'</textarea>\
				 	<input class="btn btn-primary" type="button" style="margin-top: 20px" value="Add Info"\
						onclick="updateDescription('+tasklistid+', '+taskid+')">\
				</div>\
			</div>\
			<div class="panel panel-default">\
				<div class="panel-heading">History</div>\
				<div class="panel-body">\
				<div class="col-sm-2">'+ data.createdate +'</div>\
				<div class="col-sm-2">'+ data.task[0].createname +'</div>\
				<div class="col-sm-8">'+ data.task[0].note +'</div>';

				for (i=0; i < data.tablehistory.length; i++) {
				taskHTML +=	'<div class="col-sm-2">'+ convertDate(data.tablehistory[i].moddate) +'</div>\
					<div class="col-sm-2">'+ data.tablehistory[i].modname +'</div>\
					<div class="col-sm-2">'+ data.tablehistory[i].setstate +'</div>\
					<div class="col-sm-6">'+ data.tablehistory[i].comment +'</div>';
				};
			taskHTML += '</div>';
		$('#taskinfo').html(taskHTML);
		$('#taskinfo2').html(taskHTML2);
	})
}

function convertDate(problemDate){
	var newdate = new Date(problemDate).toISOString().replace(/T/, ' ').replace(/\..+/, '');
	return(newdate);
}

function quickprogresstaskstate(element){
	var status = $(element).parent().siblings('.status').text();
	var tasklistid = $(element).data('tasklistid');
	var taskid = $(element).data('taskid');

	if ((status == 'To be done') || (status == 'Check result')){
		var progress = "In Progress";
		$.get('/progressTask',
			{newstate : progress,
			tasklistid : tasklistid,
			taskid : taskid
			},
			function(data) {
				if (data == 'Done'){
					socket.emit('Send Ping');
					socket.emit('Update Task State');
				}else{
					alert(data);
				}
		});
	}else{
		$('#newstate').data('tasklistid', tasklistid);
		$('#newstate').data('taskid', taskid);
		$('#taskprogdescript').val('');
		$('#newstatus').modal('show');
	}
};

function progresstaskstate(element, comment){
	var newstatus = $(":selected").val();
	var tasklistid = $(element).data('tasklistid');
	var taskid = $(element).data('taskid');
	var progress = "Set Next State";

	$.get('/progressTask',
	{newstate : progress,
	newstatus : newstatus,
	tasklistid : tasklistid,
	taskid : taskid,
	description : comment
	},
	function(data) {
		if (data == 'Done'){
			socket.emit('Send Ping');
			socket.emit('Update Task State');
		}else{
			alert(data);
		}
	});

};

function quickprogresstaskstatefromtask(status, tasklistid, taskid){
	if ((status == 'To be done') || (status == 'Check result')){
		var progress = "In Progress";
		$.get('/progressTask',
			{newstate : progress,
			tasklistid : tasklistid,
			taskid : taskid
			},
			function(data) {
				if (data == 'Done'){					
					socket.emit('Send Ping');
					socket.emit('Update Task State');
				}else{
					alert(data);
				}			
		});
	}else{
		$('#newtaskstate').data('tasklistid', tasklistid);
		$('#newtaskstate').data('taskid', taskid);
		$('#taskprogdescript').val('');
		$('#newtaskstatus').modal('show');
	}
}

function updateDescription(tasklistid, taskid){
	var testDescription = '<br/>' + $('#taskDescription').val();
	var progress = "Description Update";
	if (testDescription === undefined || testDescription === null) {
		$('#emptyDescription').modal('show');
	}else{
		$.get('/progressTask',
			{newstate : progress,
			tasklistid : tasklistid,
			taskid : taskid,
			testDescription: testDescription
			},
			function(data) {
				if (data == 'Done'){					
					socket.emit('Send Ping');
					socket.emit('Update Task State');
				}else{
					alert(data);
				}
			})			
		};
}