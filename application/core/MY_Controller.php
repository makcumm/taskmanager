<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	//Page info
	protected $data = Array();
	protected $pageName = FALSE;
	protected $template = "main";
	protected $hasNav = TRUE;
	//Page contents
	protected $javascript = array();
	protected $css = array();
	protected $fonts = array();
	//Page Meta
	protected $title = FALSE;
	protected $description = FALSE;
	protected $keywords = FALSE;
	protected $author = FALSE;

	function __construct()
	{

		parent::__construct();
		$this->data["uri_segment_1"] = $this->uri->segment(1);
		$this->data["uri_segment_2"] = $this->uri->segment(2);
		$this->title = $this->config->item('site_title');
		$this->description = $this->config->item('site_description');
		$this->keywords = $this->config->item('site_keywords');
		$this->author = $this->config->item('site_author');

		$this->pageName = strToLower(get_class($this));

		$this->javascript = array(
			'list_min' => 'libs/list.js',
			'jquery' => 'bootstrap/jquery.js',
			'jquery_ui' => 'libs/jquery_ui.js',
			'my_scripts' => 'script.js',
			'load_img'		=> 'libs/load-image.js',
			'validity'  => 'libs/validity.js',
			'validation_script' => 'validation_script.js',
      'fullcalendar' => 'libs/fullcalendar.js',
      'calendar' => 'calendar.js'
		);
		$this->css = array(
			'jquery_ui' => 'vader/jquery-ui-1.8.20.custom.css',
			'image_gallery' => 'bootstrap-image-gallery.css',
			'user_styles' => 'user_style.css',
			'validity'  => 'validity.css',
      'fullcalendar' => 'fullcalendar.css'
		);
	}


	protected function _render($view) {
		//static
		$toTpl["javascript"] = $this->javascript;
		$toTpl["css"] = $this->css;
		$toTpl["fonts"] = $this->fonts;

		//meta
		$toTpl["title"] = $this->title;
		$toTpl["description"] = $this->description;
		$toTpl["keywords"] = $this->keywords;
		$toTpl["author"] = $this->author;

		//data
		$toBody["content_body"] = $this->load->view($view,array_merge($this->data,$toTpl),true);

		//nav menu
		if($this->hasNav){
			$this->load->helper("nav");
			$toMenu["pageName"] = $this->pageName;
			$toHeader["nav"] = $this->load->view("template/nav",$toMenu,true);
		}
		$toHeader["basejs"] = $this->load->view("template/basejs",$this->data,true);

		$toBody["header"] = $this->load->view("template/header",$toHeader,true);
		$toBody["footer"] = $this->load->view("template/footer",'',true);

		$toTpl["body"] = $this->load->view("template/".$this->template,$toBody,true);


		//render view
		$this->load->view("template/skeleton",$toTpl);

	}
}
