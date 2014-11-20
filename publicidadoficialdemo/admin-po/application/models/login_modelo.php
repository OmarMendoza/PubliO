<?php 
class Login_modelo extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	public function login_user($username,$password)
    {
        //$this->db->where('username',$username);
        //$this->db->where('password',$password);
        $query = $this->db->query("select * from tp_usuarios where username='".$username."' and password=MD5('".$password."')");
        if($query->num_rows() == 1)
        {
            return $query->row();
        }else{
            $this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
            redirect(base_url().'index.php/login','refresh');			
        }
    }
	
	public function verificar($id_usuario,$username,$password)
    {
        //$this->db->where('username',$username);
        //$this->db->where('password',$password);
        $query = $this->db->query("select * from tp_usuarios where id=".$id_usuario." and password=MD5('".$password."')");
		
        if($query->num_rows() == 1)
        {
            return true;
			
        }else{
			
           return false;
		   			
        }
    }
	
	public function actualizar_datos($id_usuario,$username,$password)
    {
		
		$query = $this->db->query("update tp_usuarios set username='".$username."', password=MD5('".$password."') where id=".$id_usuario);		       
		
    }
	
	

}