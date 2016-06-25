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
				<td><a href="task?taskid='+data.ID+'" target="_blank">'+data.Subject+'</a></td>\
				<td class="status">'+data.Status+'</td>\
				<td>'+data.System+'</td>\
				<td>'+data.Lastmod+'</td>\
				<td> <button class="btn btn-default btn-xs" type="button" data-taskid="'+data.Taskid+'" data-tasklistid="'+data.ID+'" onClick="quickprogresstaskstate($(this))">Next</button></td>\
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

