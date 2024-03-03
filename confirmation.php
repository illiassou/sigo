
<?php 
include('connexion.php');

if(isset($_POST['Enregistrer_mot_passe'])){

   


  $id_user=$_POST['id_user'];
  $password=$_POST['password'];
  $password_confirm=$_POST['password_confirm'];
  if($password==$password_confirm){
    $password1=password_hash($password,PASSWORD_BCRYPT);
    $enregistrer_password=enregistrer_password($password1,$id_user);
    if($enregistrer_password==true){
      header('location:loginPage.html');
    }else
    {
       header('location:confirmation.php?id_user='.$id_user.'&password='.$password.'&password_confirm='.$password_confirm);  
    }

  }else{
    header('location:confirmation.php?id_user='.$id_user.'&password='.$password.'&password_confirm='.$password_confirm);
  }
}


 ?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Confirmation</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
    	<br>
    	<br>
    	<br>

    	<br>
    
    	<p><h4 style="text-align: center;">Votre compte vient d'être créer</h4></p>
        <p><h4 style="text-align: center;">Pour vous connecter veillez enregistrer votre mot de passe</h4></p>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Enregistrer le mot de passe</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="confirmation.php" method="POST">
                            <fieldset>
                            
                                    <input class="form-control" placeholder="Nouveau mot de passe" name="id_user" type="hidden" autofocus required="" value="<?= $_GET['id_user']?>">
                              
                                <div class="form-group">
                                    <input class="form-control" placeholder="Nouveau mot de passe" name="password" type="password" autofocus required="" value="<?php if(isset($_GET['password'])){echo $_GET['password'];} ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirmer le mot de passe" name="password_confirm" type="password" value="<?php if(isset($_GET['password'])){echo $_GET['password_confirm'];} ?>">
                                </div>
                                <input type="submit" name="Enregistrer_mot_passe" class="btn btn-lg btn-success btn-block" value="Valider">
                                <!-- Change this to a button or input when using this as a form -->
                                
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>

