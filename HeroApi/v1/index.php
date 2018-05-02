<?php 
	// ============== Parho Likho Computer Science ///
///www.youtube.com/ParholikhoCS
///www.Facebook.com/ParholikhoCS
///www.twitter.com/ParholikhoCS
//----------------------------------------------------


	require_once '../includes/DbOperation.php';
	
	$response = array(); 

	//// http://----Ur IP Address ---/heroapi/HeroApi/v1/?op=addheroes
	
	if(isset($_GET['op'])){
		
		switch($_GET['op']){
			

				/// Check URL and testing API
				/// http://=======Enter your IP Address------ /heroapi/HeroApi/v1/?op=addheroes
				/// Require POST
			case 'addheroes':
				if(isset($_POST['name']) && isset($_POST['role'])){
					$db = new DbOperation(); 
					if($db->createHeroes($_POST['name'], $_POST['role'])){
						$response['error'] = false;
						$response['message'] = 'Heores added successfully';
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not add Heores';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break; 
			
			////http://----Enter your IP Address -----/heroapi/HeroApi/v1/?op=getheroes
			////Require GET
			case 'getheroes':
				$db = new DbOperation();
				$hero = $db->getHeroes();
				if(count($hero)<=0){
					$response['error'] = true; 
					$response['message'] = 'Nothing found in the database';
				}else{
					$response['error'] = false; 
					$response['hero'] = $hero;
				}
			break; 
			
			default:
				$response['error'] = true;
				$response['message'] = 'No operation to perform';
			
		}
		
	}else{
		$response['error'] = false; 
		$response['message'] = 'Invalid Request';
	}
	
	echo json_encode($response);