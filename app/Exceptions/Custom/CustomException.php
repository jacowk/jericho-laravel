<?php
namespace jericho\Exceptions\Custom;

use Illuminate\Http\Request;
use Exception;

class CustomException extends Exception
{

	public function __construct(Request $request, $message)
	{
		$this->message = $message;
	}
	
}