<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once('./application/libraries/base_ctrl.php');

	class Township_ctrl extends base_ctrl
	{
		function __construct()
		{
			parent::__construct();
			$this->headers = apache_request_headers();
			$this->load->model('Township_mdl','model');
		}

		function index(){
			$data['error'] = 'check error';
			$this->load->view('index');
		}

		function gettownshiplist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_township_list();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}

		function savetownship(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->add_township($this->post());
				echo json_encode(array("success"=>$data));	
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		function updatetownship(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->update_township($this->post());
				echo json_encode(array("success"=>$data));
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}	
		}

		function getcitylist(){
			$res=$this->auth_chk();
			if(isset($res["trust"])){
				$data =$this->model->get_city_list();
				echo json_encode($data);
			}else{
				echo json_encode(array("status" => array("code" => 1,'success'=>false,'msg'=>'User have no permission')));	
			}		
		}	
	}
?>