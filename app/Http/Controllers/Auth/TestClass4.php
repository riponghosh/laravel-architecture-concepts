<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Auth\TestClass2;
class TestClass4
{
	public $test;
	function __construct(TestClass2 $test)
	{
		$this->test=$test;
	}

	public function user(){
		if ($this->test->isAdmin()) {
			echo "Admin <br> ";
		}else{
			echo "Not Admin <br> ";
		}
	}
}