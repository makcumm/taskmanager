<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Максим
 * Date: 17.06.12
 * Time: 18:00
 * To change this template use File | Settings | File Templates.
 */
class Calendar extends MY_Controller {

	public function index( $year = NULL, $month = NULL )
	{
		if ( $this->is_logged_in() === FALSE )
		{
			$this->data['error'] = "У вас нет прав для просмотра данной страницы." . anchor('login/', 'Войдите!');

			$this->_render( 'pages/helpers/strickt_access' );
		}
		else
		{
			$this->load->model('calendar_model');

			$conf = array(

				'start_day' => 'monday',
				'show_next_prev' => true,
				'next_prev_url' => base_url() . 'calendar/index'

			);
			$conf['template'] = '
			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

			{heading_row_start}<tr>{/heading_row_start}

			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

			{heading_row_end}</tr>{/heading_row_end}

			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td>{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}

			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}

			{cal_cell_content}
				<div class="day_num">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
				<div class="day_num highlight">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content_today}

			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}

			{cal_cell_blank}&nbsp;{/cal_cell_blank}

			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}

			{table_close}</table>{/table_close}
		';

			if (!$year) {
				$year = date('Y');
			}
			if (!$month) {
				$month = date('m');
			}

			if ($day = $this->input->post('day')) {
				$this->calendar_model->add_calendar_data(
					"$year-$month-$day",
					$this->input->post('data')
				);
			}

			$calendar_data = $this->calendar_model->get_calendar_data( $year, $month );

			$this->load->library( 'calendar', $conf );
			$this->data['calendar'] = $this->calendar->generate( $year, $month, $calendar_data );

			$this->_render( 'pages/helpers/calendar_view' );
		}

	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

}
