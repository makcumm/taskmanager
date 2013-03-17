function task_edit( task_id )
{
	$(document).ready( function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		var task_description = $( "#task_description" ),
			task_name = $( "#task_name" ),
			task_deadline = $( "#task_deadline" )
		allFields = $( [] ).add( task_description ).add( task_name).add( task_deadline );

		$( "#dialog-form2" ).dialog({
			autoOpen: true,
			height: 600,
			width: 450,
			modal: true,
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		/*$.attr( "#task_id" ).click(function() {
				$( "#dialog-form2").removeAttr( "style" );
				$( "#dialog-form2" ).dialog( "open" );
			});*/

		$( "#submit_edit").click( function () {
			var task_data = {
				t_id: task_id,
				structure: $( "#structure_edit").val(),
				division: $( "#division_edit").val(),
				importance: $( "#importance_edit").val(),
				worker: $( "#worker_edit").val(),
				task_name: $( "#task_edit_name").val(),
				task_description: $( "#task_edit_description").val(),
				task_deadline: $( "#task_edit_deadline").val(),
				ajax: '1'
			};

			$.ajax( {
				url: "main/task_edit",
				type: 'POST',
				data: task_data,
				dataType: "json",
				success: function( response ) {
					if ( response.status == "ok" )
					{
//						$("#msg").removeAttr('style').html( '<button class="close" data-dismiss="alert">x</button>' + response.message );
						$( "#dialog-form2").dialog( "close" );
						window.location.href="main";
					}
					else
					{
						$( response.structure ).insertAfter( "#structure_edit" );
						$( response.division ).insertAfter( "#division_edit" );
						$( response.importance ).insertAfter( "#importance_edit" );
						$( response.worker ).insertAfter( "#worker_edit" );
						$( response.task_name ).insertAfter( "#task_name_edit" );
						$( response.task_description ).insertAfter( "#task_description_edit" );
						$( response.task_deadline ).insertAfter( "#task_deadline_edit" );
					}
				}
			} );

			return false;
		} );
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
