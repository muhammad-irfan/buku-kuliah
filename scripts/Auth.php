<?php
require('Utility.php');

class Auth{
	function __construct(){}
	
	function login($username, $password, $link, $attemptN=0){
		if($link == null){
			throw new Exception("203");
		}		
		if($attempN == 3){
			throw new Exception("204");
		}
		
		$resultSet = $link->login($username, $password);
		if($resultSet){
			$name = $resultSet['name'];
			$id = $resultSet['id'];
			$random = Util::rand(10);
			
			$_SESSION['name'] = $name;
			$_SESSION['id'] = $id;
			$_SESSION['random'] = $id;
			
			$link->addHash($id, $random);
			return true;
		}else{
			return false;
		}
	}
	
	function logout($link){
		if($link == null){
			throw new Exception("203");
		}
		if(isset($_SESSION['name']) && isset($_SESSION['id']) && isset($_SESSION['random'])){
			$hash = $link->getHash($_SESSION['id']);
			if($hash == $_SESSION['random']){
				unset($_SESSION);
				return true;
			}else{
				return false;
			}
		}	
		return false;
	}
	
	function register($data, $link){
		if($link == null){
			throw new Exception("203");
		}
		
		if($data == null || count($data) == 0){
			throw new Exception("204");
		}
		
		return $link->register($data);
		
	}
}
?>