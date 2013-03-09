<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Максим
 * Date: 17.06.12
 * Time: 18:05
 * To change this template use File | Settings | File Templates.
 */
?>
<div class="span8 offset3">
	<?php echo $calendar; ?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.calendar .day').click(function() {
			day_num = $(this).find('.day_num').html();
			day_data = prompt('Enter Stuff', $(this).find('.content').html());
			if (day_data != null) {

				$.ajax({
					url: window.location,
					type: 'POST',
					data: {
						day: day_num,
						data: day_data
					},
					success: function(msg) {
						location.reload();
					}
				});

			}

		});

	});

</script>