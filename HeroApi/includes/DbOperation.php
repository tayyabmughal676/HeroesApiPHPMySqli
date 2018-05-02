<?php

// ============== Parho Likho Computer Science ///
///www.youtube.com/ParholikhoCS
///www.Facebook.com/ParholikhoCS
///www.twitter.com/ParholikhoCS
//----------------------------------------------------

 
class DbOperation
{
    private $con;
 
    function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }

	public function createHeroes($name, $role){
		$stmt = $this->con->prepare("INSERT INTO `hero` (`id`, `name`, `role`) VALUES (NULL, ?, ?);");
		$stmt->bind_param("ss", $name, $role);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	public function getHeroes(){
		$stmt = $this->con->prepare("SELECT id, name, role FROM hero");
		$stmt->execute();
		$stmt->bind_result($id, $name, $role);
		$artists = array();
		
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id'] = $id; 
			$temp['name'] = $name; 
			$temp['role'] = $role; 
			array_push($artists, $temp);
		}
		return $artists; 
	}
}

