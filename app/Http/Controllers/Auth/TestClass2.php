<?php

namespace App\Http\Controllers\Auth;
/**
 * 
 */
class TestClass2 
{
	
	function __construct()
	{
		// dd('hrllo2');
		// echo "TestClass2";
	}
	public function test(){
		echo "Hello test2 <br>";
	}

	public function isAdmin(){
		return true;
	}
}