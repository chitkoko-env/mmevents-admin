<?php
class City_mdl extends CI_Model
{		
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getcitylist(){
		$q=$this->db->query("SELECT *
					 FROM city 
					 GROUP BY city_id ;");

		return $q->result();
	}

	public function savecity($data){
		$d=array("city_name"=>$data->city_name);

		return $this->db->insert("city",$d);
	}

	public function updatecity($data){
		$d=array("city_name"=>$data->city_name);

		return $this->db->update("city",$d,array("city_id"=>$data->city_id));
	}

}
?>