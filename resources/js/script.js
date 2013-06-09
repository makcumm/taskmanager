$(document).ready( function() {
		var task_description = $( "#task_description" ),
			task_name = $( "#task_name" ),
			task_deadline = $( "#task_deadline" )
		allFields = $( [] ).add( task_description ).add( task_name).add( task_deadline );

        /*Open modal window*/
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

        /*AJAX request for add task*/
		$(document).on( "click", "#add_edit_task", function () {
            var task_data = {
                structure: $( "#structure").val(),
                division: $( "#division").val(),
                importance: $( "#importance").val(),
                worker: $( "#worker").val(),
                task_name: $( "#task_name").val(),
                task_description: $( "#task_description").val(),
                task_deadline: $( "#task_deadline").val(),
                type: $(".modal-body").attr( "type" ),
                task_id: $(".modal-body").attr( "task_id" ),
                ajax: '1',
            };

      $.ajax( {
        url: '/task_action/add_task',
				type: 'POST',
				data: task_data,
				dataType: "json",
				success: function( response ) {
					if ( response.status == "ok" )
					{
                        // location.reload(true);
                        // setTimeout("$( "div.modal").modal("hide").remove())", 35);
            $("#msg-success").removeAttr('style').html( '<button class="close" data-dismiss="alert">x</button>' + response.message );
            $( "div.modal").modal("hide").remove();
            $("tbody.list").append(response.new_task_data);
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

        $("tbody.list").on(
            "click",
            "[class*=icon-remove]",
            function()
            {
                $row_object = $( this );
                $ajax_data =
                    {
                        ajax: 1,
                        task_id: $( this ).attr( "task_id" )
                    };
                $.ajax({
                    url: 'task_action/task_remove',
                    type: "POST",
                    data: $ajax_data,
                    dataType: "json",
                    success: function( response )
                    {
                        if ( response.status == "ok" )
                        {
                            $row_object.parents("tr").fadeIn( 3000 ).remove();
                            $("#msg-success").removeAttr('style').html( '<button class="close" data-dismiss="alert">x</button>' + "Task deleted successfully");
                        }
                        else
                        {
                            $("#msg-error").removeAttr('style').html( '<button class="close" data-dismiss="alert">x</button>' + "Task wasn't delete" );
                        }
                    }
                });
            }
        );

        // Made buttom
        $("tbody.list").on(
          "click",
          "[class*=icon-ok]",
          function()
          {
            $row_object = $( this );
            $ajax_data =
              {
                ajax: 1,
                task_id: $( this ).attr( "task_id" )
              };

              // get parent <tr> for click icon
              var parent = $(this).parent().parent().parent();

              $.ajax({
                    url: 'task_action/task_made',
                    type: "POST",
                    data: $ajax_data,
                    dataType: "json",
                    success: function( response )
                    {
                        if ( response.status == "ok" )
                        {
                          parent.addClass('task_made');
                          $("#msg-success").removeAttr('style').html( '<button class="close" data-dismiss="alert">x</button>' + "Cool... task was made =)");
                        }
                        else
                        {
                          $("#msg-error").removeAttr('style').html( '<button class="close" data-dismiss="alert">x</button>' + "Upss, something is wrong =(" );
                        }
                    }
                });
          }
        );

        // Edit buttom
        $("tbody.list").on(
          "click",
          "[id*=task_edit]",
          function()
          {
            var $row_object = $( this );
            var task_id = $( this ).attr( "task_id" );

              $.ajax({
                    url: 'modal/open_modal_window',
                    type: 'POST',
                    data: {type: 'edit_task', id: task_id},
                    dataType: 'html',
                    success: function( response )
                    {
                        $('<div class="modal hide fade">' + response + '</div>').modal({
                            backdrop: true,
                            keyboard: true
                          }).css({'width':'600'});
                    }
                });


          }
        );
	} );
