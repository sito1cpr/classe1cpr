<?php  

if (isset($_POST['create'])) {
	include "../db_conn.php";
	function validate($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$name = validate($_POST['name']);
	$email = validate($_POST['email']);

	$user_data = 'name='.$name. '&email='.$email;

	if (empty($name)) {
		header("Location: ../index.php?error=Il nome è obbligatorio&$user_data");
	}elseif (empty($email)) {
		header("Location: ../index.php?error=La mail è obbligatoria&$user_data");
	}else{
		$sql = "INSERT INTO users(name, email) VALUES('$name', '$email')";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			header("Location: ../read.php?success=Cliente aggiunto con sucesso");
		}else{
			header("Location: ../index.php?error=Errore sconosciuto interno!&$user_data");
		}
	}
}