<?php
session_start();
include_once('connexion.php');


/*if(!isset($_SESSION['username']))
{
    if(!isset($_POST['user_name']))
    {
        if(!isset($_GET['id_user']))
        {
        MyAutoload::start();
        $request="loginPage.html";
        $routeur = new Routeur($request);
        $routeur->renderController();
         }else
         {
        MyAutoload::start();
        $request="confirmation.html";
        $routeur = new Routeur($request);
        $routeur->renderController(); 
         }
    }else
    {
        MyAutoload::start();
        $request=$_GET['r'];
        $routeur = new Routeur($request);
        $routeur->renderController();

    }

}else{
*/
    if(isset($_GET['r']))
    {

        MyAutoload::start();
        $request = $_GET['r'];
        $routeur = new Routeur($request);
        $routeur->renderController();

    }else
    {
        MyAutoload::start();
        $request = 'menu';
        $routeur = new Routeur($request);
        $routeur->renderController();

    }

//}

