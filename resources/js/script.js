function task_edit( task_id )
{
	$(document).ready( function() {
		$('#create-user').click(function() {
			$.ajax({
				url : 'modal/add_task',
				type: 'POST',
				data: task_data,
				dataType: 'html',
				success: function(response) {
					console.log('Ok');
				}
			});
		});
	} );
}

function task_made( task_id )
{
	$.ajax( {
		url: "main/task_made",
		type: 'POST',
		data:  { 'task_id':  task_id, 'status': "yes",  'ajax': 1},
		dataType: "json",
		success: function(response) {
			$('td[task_name*="'+task_id+'"]').parent().addClass("task_made");
		}
	} );
}

function task_remove( task_id ) {
	$.ajax( {
		url: "main/task_remove",
		type: 'POST',
		data:  { 'task_id':  task_id,  'ajax': 1},
		dataType: "json",
		success: function(response) {
			$('li[task_id*="'+task_id+'"]').parents('tr').remove();
		}
	} );
}

$(document).ready( function() {
		var task_description = $( "#task_description" ),
			task_name = $( "#task_name" ),
			task_deadline = $( "#task_deadline" )
		allFields = $( [] ).add( task_description ).add( task_name).add( task_deadline );

		$("#create-user").click(function() {
			$.ajax({
				url: '/modal/open_modal_window',
				type: 'POST',
				data: {type: 'add_task'},
				dataType: 'html',
				success: function(response) {
					$('<div class="modal hide fade">' + response + '</div>').modal({
							backdrop: true,
							keyboard: true
						}).css({'width':'600'});
					}
			});
		});

		$(document).on( "click", "#add_edit_task", function () {
            var task_data = {
                structure: $( "#structure").val(),
                division: $( "#division").val(),
                importance: $( "#importance").val(),
                worker: $( "#worker").val(),
                task_name: $( "#task_name").val(),
                task_description: $( "#task_description").val(),
                task_deadline: $( "#task_deadline").val(),
                ajax: '1'
            };

			$.ajax( {
				url: '/task_action/add_task',
				type: 'POST',
				data: task_data,
				dataType: "json",
				success: function( response ) {
					if ( response.status == "ok" )
					{
						$("#msg").removeAttr('style').html( '<button class="close" data-dismiss="alert">x</button>' + response.message );
					}
					else if (response.status == "error")
					{
						$( response.structure ).insertAfter( "#structure" );
						$( response.division ).insertAfter( "#division" );
						$( response.importance ).insertAfter( "#importance" );
						$( response.worker ).insertAfter( "#worker" );
						$( response.task_name ).insertAfter( "#task_name" );
						$( response.task_description ).insertAfter( "#task_description" );
						$( response.task_deadline ).insertAfter( "#task_deadline" );
					}
				}
			} );

			return false;
		} );
	} );
