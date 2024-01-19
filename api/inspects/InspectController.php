<?php

/**
 *  
 */
include_once './Inspect.php';

class InspectController
{	
	protected $parameters;
	protected $board_id;
	protected $model;
	protected $returnValue = [
		'success' => false,
		'data'	=> [],
		'message' => null,
		'status' => 'OUT',
		'judge'	=> 'NG' // NG / not NG
	];
	protected $allowedParameter = [
		'board_id'
	];

	public function __construct($parameters ){
		$this->parameters = $_GET;
		$this->model = new Inspect();
		foreach ($parameters as $key => $parameter) {
			# code...
			if (in_array($key, $this->allowedParameter )) {
				# code...
				$this->board_id = $parameter ;
			}
		}

		if($this->board_id == null ){
			http_response_code(422);
			$this->returnValue['message'] = 'you need to pass board_id!';
		  	// return json_encode( $this->returnValue);
		  // throw new Exception("You need to pass board_id !", 1);
		}
		
	}

	public function index(){
		
		if($this->returnValue['message']!= null) return json_encode( $this->returnValue );

		$result = $this->model->find($this->board_id);

		if(count($result) > 0 ){
			$this->returnValue['success'] = true;
			$this->returnValue['data'] = $result;
			$this->returnValue['status'] = 'OUT';
			$this->returnValue['judge'] = ( $result ) ? 'OK':'NG' ;
		}else{
			http_response_code(422);
			$this->returnValue['message'] = "DATA '".$this->board_id."' NG OR NOT FOUND!";
		}
		return json_encode($this->returnValue);
	}

	private function getStatus(array $inspects ){
		$tmpArray = [
			'proc1'
			, 'proc2'
			, 'proc3'
			, 'proc4'
			, 'proc5'
			, 'proc6'
			, 'proc7'
			, 'proc8'
			, 'proc9'
			, 'proc10'
			, 'proc11'
			, 'proc12'
			, 'proc13'
			, 'proc14'
			, 'proc15'
			, 'proc16'
			, 'proc17'
			, 'proc18'
			, 'proc19'
			, 'proc20'
		];

		$result = true;
		foreach ($inspects as $key => $value) {
			if(in_array($key, $tmpArray)){
				$result = ($value == '0');
			}
		}

		return $result;
	}
	
}