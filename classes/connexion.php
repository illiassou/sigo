<?php  
class Connexion
{
  public function connexion()
  {
    try{
		
		$hostname = "localhost";
		$user_name = "root";
		
		$password = "";
		$bd_name = "g_stock";
		
		$connStr = "mysql:host=".$hostname.";dbname=".$bd_name; 
		$arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
                $pdo = new PDO($connStr, $user_name, $password, $arrExtraParam); 
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$pdo->query("SET NAMES 'utf8'");          
                $GLOBALS['connexion'] = $pdo;
	}
	catch(PDOException $e) {
		$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		die($msg);
	}
  }

}

?>