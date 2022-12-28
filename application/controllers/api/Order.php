<?php
require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Order extends RestController
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
	public function fetchOrder_get($id)
	{

		if (!empty($id)) {
			$sql = "select * from orders where id =$id";
			$data = $this->db->query($sql)->result();
			$this->response($data, RestController::HTTP_OK);
		} else {
			$this->response(["no record found"], RestController::HTTP_OK);
		}
	}

	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function createOrder_post()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_id', 'user id', 'required');
		$this->form_validation->set_rules('amt', 'Amount', 'required');
		$this->form_validation->set_rules('item_name', 'Item name', 'required');
		$this->form_validation->set_rules('scheduled_pickup', 'Pickup', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->response(['validationError' => strip_tags(validation_errors())], RestController::HTTP_OK);
		}
		$user_id = $this->post("user_id");
		$amt = $this->post("amt");
		$item_name = $this->post("item_name");
		$scheduled_pickup = $this->post("scheduled_pickup");
		$sql = "insert into orders set user_id='$user_id' , amt='$amt',item_name='$item_name', 
		scheduled_pickup='$scheduled_pickup'";
		$this->db->query($sql);
		$this->response(['order created successfully.'], RestController::HTTP_OK);
	}

	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function updatePickup_put($id)
	{
		$scheduled_pickup = $this->put("scheduled_pickup");
		$sql = "update orders set scheduled_pickup='$scheduled_pickup'  where id=$id";
		$this->db->query($sql);
		$this->response(['order scheduled pickup updated successfully.'], RestController::HTTP_OK);
	}

	public function removeOrder_delete($id)
	{
		$sql = "delete from orders where id =$id";
		$this->db->query($sql);
		$this->response(['order deleted successfully.'], RestController::HTTP_OK);
	}
}
