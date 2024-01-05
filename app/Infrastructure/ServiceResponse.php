<?php
namespace App\Infrastructure;

class ServiceResponse {
	public $IsSuccess;

	public function __construct($Data = null, $IsSuccess = false, $Message = 'Invalid Data.'){
		$this->IsSuccess = $IsSuccess;
		$this->Data = $Data;
		$this->Message = $Message;
	}
}
