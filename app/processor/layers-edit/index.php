<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$error   = "";
	$success = "";
	if(!isLogin()){
		redirect(BASEURL."app/login.php");
	}
	
	if(isset($_POST['save'])){
		if(strlen($_POST['name'])<2) {
			$error = "Layer Name Too Short.";
		}
		else if(strlen($_POST['url'])<10) {
			$error = "Layer URL Too Short.";
		}
		else if(!updateLayers($_SESSION['user']['id'], $_POST['id'], $_POST['name'], $_POST['url'], $_POST['lkey'], $_POST['accesstoken'], $_POST['attribution'])){
			$error = "Something went wrong. Please refresh and try again!";
		}
		else {
			$success = "Successfully Updated!";
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	$_SESSION['response']['layers-edit']['error']   = $error;
	$_SESSION['response']['layers-edit']['success'] = $success;
	redirect(BASEURL."app/layers-edit.php?id=".$_POST['id']);
?>