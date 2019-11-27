<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Auth\TestClass3;
class TestClass5
{
	public $test;
	function __construct(TestClass3 $test)
	{
		$this->test=$test;
	}

	
}