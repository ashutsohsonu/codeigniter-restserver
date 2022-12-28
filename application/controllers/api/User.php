<?php
require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';

use chriskacerguis\RestServer\RestController;





class User extends RestController
{

	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function fetchUser_get($id)
	{

		$sql = "select * from users where 1=1 ";
		if (!empty($id)) {
			$sql .= "and id =$id";
		}
		$data = $this->db->query($sql)->result();
		$this->response($data, RestController::HTTP_OK);
	}

	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function createUser_post()
	{
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('mail', 'Email', 'required|is_unique[users.mail]');
		if ($this->form_validation->run() == FALSE) {
			$this->response(['validationError' => strip_tags(validation_errors())], RestController::HTTP_OK);
		}
		$name = $this->post("name");
		$mail = $this->post("mail");
		$sql = "insert into users set name='$name' , mail='$mail'";
		$this->db->query($sql);
		$this->response(['User created successfully.'], RestController::HTTP_OK);
	}

	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function updateUser_put($id)
	{
		$name = $this->put("name");
		$mail = $this->put("mail");
		$this->load->library('form_validation');	
		$sql = "update users set name='$name' , mail='$mail' where id=$id";
		$this->db->query($sql);
		$this->response(['user updated successfully.'], RestController::HTTP_OK);
	}

	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function removeUser_delete($id)
	{
		$sql = "delete from users where id=$id";
		$this->db->query($sql);
		$this->response(['User deleted successfully.'], RestController::HTTP_OK);
	}
}
