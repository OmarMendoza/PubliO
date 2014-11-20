<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Captcha_modelo extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insert_captcha($cap)
	{
		//insertamos el captcha en la bd
		$data = array(
			'captcha_time' => $cap['time'],
			'ip_address' => $this->input->ip_address(),
			'word' => $cap['word']
			);
		$query = $this->db->insert_string('tp_captcha', $data);
		$this->db->query($query);

	}

	public function remove_old_captcha($expiration)
	{
		//eliminamos los registros de la base de datos cuyo 
		//captcha_time sea menor a expiration
		$this->db->where('captcha_time <',$expiration);
		$this->db->delete('tp_captcha');

	}

	public function check($ip,$expiration,$captcha)
	{
		//comprobamos si existe un registro con los datos
		//envíados desde el formulario
		$this->db->where('word',$captcha);
		$this->db->where('ip_address',$ip);
		$this->db->where('captcha_time >',$expiration);

		$query = $this->db->get('tp_captcha');
		//devolvemos el número de filas que coinciden
		return $query->num_rows();
	}

}

//end application/models/home_model.php
