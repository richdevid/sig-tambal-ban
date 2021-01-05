<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('googlemaps','session'));
	}

	public function index()
	{
		$this->data['title'] = "SISTEM INFORMASI GIS";
		$config['center'] = '-2.1232247,106.1058501';
		$config['zoom'] = 'auto';
		$config['styles'] = array(
		  	array(
		  		"name"=>"No Businesses",
		  		"definition"=> array(
		   			array(
		   				"featureType"=>"poi",
		   				"elementType" =>
		   				"business",
		   				"stylers"=> array(
		   					array(
		   						"visibility"=>"off"
		   					)
		   				)
		   			)
		  		)
		  	)
		);
		$this->googlemaps->initialize($config);
		foreach($this->searchQuery() as $key => $value) :
		$lat = $value->latitude;
		$long = $value->longitude;
		$marker = array();
		$marker['position'] = "{$value->latitude}, {$value->longitude}";
		$marker['animation'] = 'DROP';
		$marker['infowindow_content'] = '<div class="media" style="width:400px;">';
		$marker['infowindow_content'] .= '<div class="media-left">';
		$marker['infowindow_content'] .= '<img src="'.base_url("public/image/{$value->photo}").'" class="media-object" style="width:150px">';
		$marker['infowindow_content'] .= '</div>';
		$marker['infowindow_content'] .= '<div class="media-body">';
		$marker['infowindow_content'] .= '<h5 class="media-heading">'.$value->name.'</h5>';
		$marker['infowindow_content'] .= '<p>Range Harga : <strong>Rp. '.number_format($value->price).' - '.number_format($value->price2).'</strong></p>';
		$marker['infowindow_content'] .= '<p>Buka Pukul : '.$value->open.' - '.$value->close.'</p>';
		$marker['infowindow_content'] .= '<p>Hari Libur : '.$value->holiday.'</p>';
		$marker['infowindow_content'] .= '<p>Melayani : '.$value->serve.'</p>';
		$marker['infowindow_content'] .= '<p><a href=http://maps.google.com/maps?z=12&t=m&q=loc:'.$lat.'+'.$long.'>Open in Google Maps</a></p>';
		$marker['infowindow_content'] .= '</div>';
		$marker['infowindow_content'] .= '</div>';
		$marker['icon'] = base_url("public/icon/repair-shop.png");
		$this->googlemaps->add_marker($marker);
		endforeach;


		$this->googlemaps->initialize($config);

	$this->data['map'] = $this->googlemaps->create_map();


		$this->load->view('main-index', $this->data);
	}

	public function searchQuery()
	{
		$this->db->select('location.*, categories.name as category');

		$this->db->join('locationCategories', 'location.ID = locationCategories.category_id', 'left');

		$this->db->join('categories', 'locationCategories.category_id = categories.category_id', 'left');
		$this->db->where('location.status', 'ACCEPTED');
	/*	switch ($this->input->get('price'))
		{
			case '<100K':
				$this->db->where('location.price <', 100000);
				break;
			case '100K-300K':
				$this->db->where('location.price >=', 100000);
				$this->db->where('location.price <=', 300000);
				break;
			case '300K-500K':
				$this->db->where('location.price >=', 300000);
				$this->db->where('location.price <=', 500000);
				break;
			case '500K':
				$this->db->where('location.price >=', 500000);
				break;
		} */

/*		if( is_array(@$this->input->post('categories')) )
			$this->db->where_in('locationCategories.category_id', $this->input->post('categories'));
			$this->db->group_by('location.ID'); */


		if($this->input->get('q') != '')
			$this->db->like('location.name', $this->input->get('q'));

		$this->db->where('location.latitude !=', NULL)
				 ->where('location.longitude !=', NULL);


		return $this->db->get("location")->result();
	}
}
