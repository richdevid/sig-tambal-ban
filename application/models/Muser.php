<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('upload','session'));
	}

	public function createlocation()
	{
		$config['upload_path'] = './public/image/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_width']  = 1024*3;
		$config['max_height']  = 768*3;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('photo'))
		{
			$photo = "";
			$this->session->set_flashdata('message', $this->upload->display_errors());
		} else{
			$photo = $this->upload->file_name;
		}

		$object = array(
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'price2' => $this->input->post('price2'),
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude'),
			'address' => $this->input->post('alamat'),
			'photo' => $photo,
			'serve' => @implode(", ", @$this->input->post('serve')),
			'open' => $this->input->post('open'),
			'close' => $this->input->post('close'),
			'holiday' => $this->input->post('holiday'),
			'status' => 'PENDING'
		);

		$this->db->insert('location', $object);

		$IDlocation = $this->db->insert_id();

		if( is_array($this->input->post('categories')) )
		{
			$this->db->where('location_id', $IDlocation)
					 ->where_not_in('category_id', $this->input->post('categories'))
					 ->delete('locationcategories');
			foreach ($this->input->post('categories') as $key => $value)
			{
				$this->db->insert('locationcategories', array(
					'location_id' => $IDlocation,
					'category_id' => $value
				));
			}
		}

		$this->session->set_flashdata('message', "Data location berhasil ditambahkan. Status penambahan data sedang dimoderasi oleh admin");
	}

	public function getlocation($param = 0)
	{
		return $this->db->get_where('location', array('ID' => $param) )->row();
	}

	public function categorylocation($lokasi = 0, $category = 0)
	{
		return $this->db->get_where('locationcategories', array('location_id' => $lokasi, 'category_id' => $category) )->row();
	}

	public function updatelocation($param = 0)
	{
		$lokasi = $this->getlocation($param);

		$config['upload_path'] = './public/image/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_width']  = 1024*3;
		$config['max_height']  = 768*3;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('photo'))
		{
			$photo = $lokasi->photo;
			$this->session->set_flashdata('message', $this->upload->display_errors());
		} else{
			$photo = $this->upload->file_name;
		}

		$object = array(
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'latitude' => $this->input->post('latitude'),
			'longitude' => $this->input->post('longitude'),
			'address' => $this->input->post('alamat'),
			'photo' => $photo,
			'serve' => @implode(", ", @$this->input->post('serve')),
			'open' => $this->input->post('open'),
			'close' => $this->input->post('close'),
			'holiday' => $this->input->post('holiday')
		);

		$this->db->update('location', $object, array('ID' => $param));

		if( is_array($this->input->post('categories')) )
		{
			$this->db->where('location_id', $param)
					 ->where_not_in('category_id', $this->input->post('categories'))
					 ->delete('locationcategories');
			foreach ($this->input->post('categories') as $key => $value)
			{
				$this->db->insert('locationcategories', array(
					'location_id' => $param,
					'category_id' => $value
				));
			}
		} else {
			$this->db->where('location_id', $param)
					 ->where_not_in('category_id', $this->input->post('categories'))
					 ->delete('locationcategories');
		}

		$this->session->set_flashdata('message', "Perubahan berhasil disimpan");
	}

	public function getAlllocation($limit = 10, $offset = 0, $type = 'result')
	{
		if( $this->input->get('q') != '')
			$this->db->like('name', $this->input->get('q'));

		$this->db->order_by('ID', 'desc');

		if($type == 'num')
		{
			return $this->db->get('location')->num_rows();
		} else {
			return $this->db->get('location', $limit, $offset)->result();
		}
	}

	public function deletelocation($param = 0)
	{
		$lokasi = $this->getlocation($param);

		if( $lokasi->photo != '')
			@unlink(".pulbic/image/{$lokasi->photo}");

		$this->db->delete('location', array('ID' => $param));
		$this->db->delete('locationcategories', array('location_id' => $param));

		$this->session->set_flashdata('message', "Data location berhasil dihapus");
	}


	public function setAccount()
	{
		$user = $this->getAccount();

		$object = array(
			'fullname' => $this->input->post('name'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email')
		);

		if( $this->input->post('new_pass') != '')
			$object['password'] = password_hash($this->input->post('new_pass'), PASSWORD_DEFAULT);

		$this->db->update('users', $object, array('ID' => $user->ID));

		$this->session->set_flashdata('message', "Perubahan berhasil disimpan.");
	}

	public function getAccount()
	{
		return $this->db->get_where('users', array('ID' => $this->session->userdata('user')->ID) )->row();
	}
}

/* End of file Madmin.php */
/* Location: ./application/models/Madmin.php */
