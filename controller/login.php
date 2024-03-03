<?php
session_start();
include('connexion.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" >
<title>Login</title>

</head>
<body>
	<?php
	if(isset($_POST['user_name']) and isset($_POST['password'] )){

			$u=$_POST['user_name'];
			$p=$_POST['password'];


				$req='SELECT * from user where user_name=?';
						$rep=$pdo->prepare($req);
						$rep->execute(array($u));
						$count=$rep->rowCount($req);

$_SESSION['admin']=[];
$_SESSION['vendeur']=[];
while ($donnes=$rep->fetch()) {
	$id_user=$donnes['id_user'];
	$privilege=$donnes['id_privilege'];
	$password=$donnes['password'];
	

	# code...
}
if($count==1 and $privilege==1){

	if(password_verify($p,$password)){
$_SESSION['user']='user';
$_SESSION['admin'][$u]=$p;
$_SESSION['user_name']=$u;
//$_SESSION['mot_passe_admin']=$p;
$_SESSION['privilege']=$privilege;
header('location:../view/Accueil.php');
}else{
	if($password='mot_passe'){
		header('location:../confirmation.php?id_user='.$id_user);
	}else{
	header('location:../index.php');
}
}

}else if($count==1 and $privilege==2){
	if(password_verify($p,$password)){
$_SESSION['user']='user';
$_SESSION['vendeur'][$u]=$p;
$_SESSION['username']=$u;
$_SESSION['privilege']=$privilege;
header('location:../view/Accueil.php');
}else{
	if($password=='mot_passe'){
header('location:../confirmation.php?id_user='.$id_user);
	}else{
	header('location:../index.php');
}	
}
}else{

	header('location:../index.php');
}



 }

 ?>



	<script language="javascript">
   // window.location.href = "menu_administrateur.php"
</script>

</body>
</html>