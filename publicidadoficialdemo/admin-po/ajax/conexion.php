<?php  
//************************************************ clase conexion 
class Conexion // definición de la clase padre
{
//************************************************ propiedades del objeto	
	
/*	protected $DB_SERVIDOR = 'localhost';
	protected $DB_USUARIO  = 'root';	
	protected $DB_PASSWORD = 'root';
	protected $DB_NOMBRE= 'publioficial';*/
	
	protected $DB_SERVIDOR = '172.16.10.65';
	protected $DB_USUARIO  = 'web.oaxtrans';	
	protected $DB_PASSWORD = 'P90G6dX7df';
	protected $DB_NOMBRE= 'S04_04xtr4n5p4r3nt3';
	
//*************************metodo conectar******************************	
	public function conecta()
	{
		 $db = mysql_connect($this->DB_SERVIDOR, $this->DB_USUARIO, $this->DB_PASSWORD);
		  mysql_select_db($this->DB_NOMBRE, $db);
		 return $db;
	}	
}

?>
