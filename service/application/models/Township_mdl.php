<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Township_mdl extends CI_Model
{		
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_township_list(){
		$q=$this->db->query("SELECT t.*,c.city_id,c.city_name
					 FROM township as t 
					 LEFT JOIN city as c ON(c.city_id=t.city_id) 
					 order by c.city_id");

		return $q->result();
	}

	public function add_township($data){
		$d=array(
				"city_id"=>$this->db->escape_like_str($data->cityid),
				"township_name"=>$this->db->escape_like_str($data->townshipname)
			);

		return $this->db->insert("township",$d);
	}

	public function update_township($data){
		$chktownshipid = $this->db->escape_like_str($data->townshipid);
		$d=array(
				"city_id"=>$this->db->escape_like_str($data->cityid),
				"township_name"=>$this->db->escape_like_str($data->townshipname)
			);

		return $this->db->update("township",$d,array("township_id"=>$chktownshipid));
	}

	//get city data list
	function get_city_list(){
		$this->db->select("*");
		$this->db->from("city");
		$q=$this->db->get();
		return $q->result();
	}

}
?>