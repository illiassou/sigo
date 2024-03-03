<?php 

// la classe MyAutolode 
class MyAutoload
{

		public static function start()
		{
			spl_autoload_register(array(__CLASS__, 'autoload'));

			$root=$_SERVER['DOCUMENT_ROOT'];
			$host=$_SERVER['HTTP_HOST'];

			define('HOST','http://'.$host.'/sigo/');
			define('ROOT',$root.'/sigo/');
			define('CONTROLLER', ROOT.'controller/');
			define('MODEL', ROOT.'model/');
			define('VIEW', ROOT.'view/');
			define('ASSETS', HOST.'assets/');
			define('IMAGES', ROOT.'images/');
			define('CLASSES', ROOT.'classes/');
		}

		public static function autoload($class)
		{
			if(file_exists(MODEL.$class.'.php'))
			{
				include_once(MODEL.$class.'.php');

			}elseif(file_exists(CLASSES.$class.'.php'))
			{
				include_once(CLASSES.$class.'.php');

			}elseif (file_exists(CONTROLLER.$class.'.php'))
			{
				include_once(CONTROLLER.$class.'.php');
			}

		}

}

//************************************************************************************************ */

// Connexion à la base de donnée

 try{
		
		$hostname = "localhost";
		$user_name = "root";
		
		$password = "";
		$bd_name = "sigo_db";
		
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
	

//******************************************************************************************************** */


//*******************************LES FONCTION AJOUT-MODIFICATION-SUPPRESSION-SELECTION*************************************** */

// fonction pour la selection des privilege des utiliateurs
function privilege()
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from privilege
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
//******************************************************************************************************* */

// modification des mot de passe utilisateur

	function enregistrer_password($password,$id_user)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE user set password=? where id_user=?");
			$stmt->execute(array($password,$id_user));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


	function modif_info($table,$col,$con)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE $table set $col where $con");
			$stmt->execute();
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function modif_sortie($date_sortie,$date_retour,$mission,$id_agent,$id_sortie)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE sortie set date_sortie_outil=?, date_retour_outil=?,mission=?,id_agent=? where id_sortie_outil = ?");
			$stmt->execute(array($date_sortie,$date_retour,$mission,$id_agent,$id_sortie));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function detele_info($table,$con)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("DELETE FROM $table where $con");
			$stmt->execute();
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}
//************************************************************************************************************* */


// fonction qui permet de modifier les informations d'un utilisateur

	function Modif_user($nom_prenom,$user_name,$id_privilege,$id_user)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE user set nom_prenom=?, user_name=?,id_privilege=? where id_user=?");
			$stmt->execute(array($nom_prenom,$user_name,$id_privilege,$id_user));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}
//********************************************************************************************************************* */
	
// fonction pour ajouter un nouveau utilisateur

	function Ajout_utilisateur($user_name,$id_agent,$privilege)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO user (login,id_agent,id_priv) 
						VALUES (?,?,?)
						");
			$stmt->execute(array($user_name,$id_agent,$privilege));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}
//******************************************************************************************************** */
// SELECTION DES OUTIL
function repertoire_outil()
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT count(O.id_desig) as quantite,O.id_desig,D.ref_desig, D.lib_desig,M.lib_emplacement, C.lib_categorie, 
							P.lib_position, I.lib_identification, O.image_outil,O.id_emplacement,P.id_identification,O.id_position,O.id_categorie
							FROM
								outil O, designation D, categorie C, emplacement M, identification I, position P
							WHERE 
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification
							group by O.id_desig
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function repertoire_outil_hs()
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT * FROM
								outil O, designation D, categorie C, emplacement M, identification I, position P, etat E, statut S
							WHERE 
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification and 
								E.id_etat=O.id_etat and S.id_statut = O.id_statut and E.id_etat = 4
							order by O.ref_outil
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}

function select_outil($id_desig)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT *
							FROM
								outil O, designation D, categorie C, emplacement M, identification I, position P,etat E,statut S
							WHERE 
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification and O.id_etat=E.id_etat and S.id_statut = O.id_statut and O.id_desig=$id_desig
								order by O.ref_outil
							
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}

function recherche_outil($recherche)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT *
							FROM
								outil O, designation D, categorie C, emplacement M, identification I, position P,etat E,statut S
							WHERE 
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification and 
								O.id_etat=E.id_etat and S.id_statut = O.id_statut and O.id_statut =1 and O.ref_outil like'%$recherche%'
							or
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification and 
								O.id_etat=E.id_etat and S.id_statut = O.id_statut and O.id_statut =1 and D.lib_desig like'%$recherche%'

									order by O.ref_outil
							
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function select_outil_filtre($id_desig,$debut,$nombre_par_page)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT *
							FROM
								outil O, designation D, categorie C, emplacement M, identification I, position P,etat E,statut S
							WHERE 
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification and O.id_etat=E.id_etat and S.id_statut = O.id_statut and O.id_desig=$id_desig
								order by O.ref_outil limit $debut,$nombre_par_page
							
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}

function select_comp($id_outil)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT *
							FROM
								outil O, designation D, etat E,statut S, composant_outil CO
							WHERE 
								CO.id_desig = D.id_desig and CO.id_outil=O.id_outil
								and CO.id_etat=E.id_etat and S.id_statut = CO.id_statut and CO.id_outil=$id_outil
								order by CO.ref_comp_outil
							
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function select_historique($id_outil)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT *
							FROM
								outil O, etat E, sortie S, sortir SR,agent A, service SE
							WHERE 
								O.id_outil = SR.id_outil and SR.id_sortie_outil = S.id_sortie_outil
								and E.id_etat = SR.id_etat and A.id_agent = S.id_agent and SE.id_serv=A.id_serv
								and SR.id_outil = $id_outil
							
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function repertoire_outil_2($debut,$nombre)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT count(O.id_desig) as quantite,O.id_desig,D.ref_desig, D.lib_desig,M.lib_emplacement, C.lib_categorie, P.lib_position, I.lib_identification
							FROM
								outil O, designation D, categorie C, emplacement M, identification I, position P
							WHERE 
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification
							group by O.id_desig limit $debut,$nombre
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}

function suivi_outil($con)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
		SELECT *
		FROM
			outil O, designation D, categorie C, emplacement M, identification I, position P,
			etat E, statut S
		WHERE 
			O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
			and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification and
			E.id_etat = O.id_etat and S.id_statut=O.id_statut $con
		
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function suivi_last_user($id_outil)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
		SELECT max(S.id_sortie_outil), A.nom_agent,A.prenom_agent, SE.lib_serv
		FROM
		sortie S,sortir SR, agent A, service SE
		WHERE 
		S.id_sortie_outil=SR.id_sortie_outil and A.id_agent = S.id_agent and A.id_serv = SE.id_serv
		 and SR.id_outil=$id_outil
		
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


/*function liset_composant($id_outil)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
		SELECT *
		FROM
		designation D, composant_outil C, etat E
		WHERE 
		D.id_desig = C.id_desig and C.id_etat = E.id_etat and C.id_outil=$id_outil
		
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}
*/

function repertoire_outil_disponible($debut,$nombre)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT count(O.id_desig) as quantite,O.id_desig,D.ref_desig, D.lib_desig,M.lib_emplacement, C.lib_categorie, P.lib_position, I.lib_identification
							FROM
								outil O, designation D, categorie C, emplacement M, identification I, position P
							WHERE 
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification 
								and O.id_statut = 1
							group by O.id_desig limit $debut,$nombre
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function repertoire_outil_en_panne($debut,$nombre)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT count(O.id_desig) as quantite,O.id_desig,D.ref_desig, D.lib_desig,M.lib_emplacement, C.lib_categorie, P.lib_position, I.lib_identification
							FROM
								outil O, designation D, categorie C, emplacement M, identification I, position P
							WHERE 
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification 
								and O.id_etat = 3
							group by O.id_desig limit $debut,$nombre
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function repertoire_outil_hors_service($debut,$nombre)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT count(O.id_desig) as quantite,O.id_desig,O.id_desig,D.ref_desig, D.lib_desig,M.lib_emplacement, C.lib_categorie, P.lib_position, I.lib_identification
							FROM
								outil O, designation D, categorie C, emplacement M, identification I, position P
							WHERE 
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification 
								and O.id_etat = 4
							group by O.id_desig limit $debut,$nombre
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}

function repertoire_outil_incomplet($debut,$nombre)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT count(O.id_desig) as quantite,O.id_desig,D.ref_desig, D.lib_desig,M.lib_emplacement, C.lib_categorie, P.lib_position, I.lib_identification
							FROM
								outil O, designation D, categorie C, emplacement M, identification I, position P, composant_outil CO
							WHERE 
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification and CO.id_outil=O.id_outil 
								and CO.id_etat = 5
							group by O.id_desig limit $debut,$nombre
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function repertoire_outil_bon_etat($debut,$nombre)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT count(O.id_desig) as quantite,O.id_desig,D.ref_desig, D.lib_desig,M.lib_emplacement, C.lib_categorie, P.lib_position, I.lib_identification
							FROM
								outil O, designation D, categorie C, emplacement M, identification I, position P
							WHERE 
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification 
								and O.id_etat = 1
								or
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification 
								and O.id_etat = 2
							
							group by O.id_desig limit $debut,$nombre
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}

function repertoire_outil_en_operation($debut,$nombre)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("
							SELECT *
							FROM
								outil O, designation D, categorie C, emplacement M, identification I, position P,sortie S,sortir SR, agent A
								,etat E
							WHERE 
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification 
								and S.id_sortie_outil = SR.id_sortie_outil and S.id_agent = A.id_agent and O.id_outil = SR.id_outil
								and E.id_etat = O.id_etat and O.id_etat = 1 and O.id_statut = 2
								or
								O.id_desig = D.id_desig and O.id_position = P.id_position and O.id_categorie = C.id_categorie
								and O.id_emplacement = M.id_emplacement and P.id_identification = I.id_identification 
								and S.id_sortie_outil = SR.id_sortie_outil and S.id_agent = A.id_agent and O.id_outil = SR.id_outil
								and E.id_etat = O.id_etat and O.id_etat = 2 and O.id_statut = 2
							
							group by O.id_desig limit $debut,$nombre
						  ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}

function liste_designation()
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query(" SELECT * FROM designation ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}




function liste_emplacement()
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query(" SELECT * FROM emplacement ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function liste_categorie()
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query(" SELECT * FROM categorie ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}

function liste_etat()
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query(" SELECT * FROM etat ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}

function liste_statut()
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query(" SELECT * FROM statut ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function liste_identification()
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query(" SELECT * FROM identification order by lib_identification ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function liste_agent()
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query(" SELECT * FROM  agent A, service SE, atelier AT where
		                   
							SE.id_serv=A.id_serv and AT.id_atelier=A.id_atelier");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}

function liste_outil_sortie($id_sortie_outil,$limit)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query(" SELECT * FROM  sortir SR, outil O, designation D, etat E where
		                   
							SR.id_outil=O.id_outil and O.id_desig = D.id_desig and E.id_etat= SR.id_etat and SR.id_sortie_outil=$id_sortie_outil $limit");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function historique_sortie($filtre)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query(" SELECT * FROM sortie S,sortir SR, agent A, service SE, atelier AT where
		                    S.id_sortie_outil=SR.id_sortie_outil and A.id_agent = S.id_agent and
							SE.id_serv=A.id_serv and AT.id_atelier=A.id_atelier $filtre ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}

function liste_position()
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query(" SELECT * FROM position ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}

function position($id_identification)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("SELECT * FROM position where id_identification = $id_identification");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}

function liste_service()
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query("SELECT * FROM service ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function select($table,$con)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query(" SELECT * FROM $table where $con ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function select_count($col,$table,$con)
{
	try
	{
		$pdo = $GLOBALS['connexion'];
		$rep = $pdo->query(" SELECT count($col) as nbre FROM $table where $con ");
		return $rep;
	}catch(Exception $e)
	{
		return $e;
	}
}


function select_MaxID($id,$table)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT max($id) from $table ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
//***************************************************************************************************************** */
//Fonction pour ajouter une designation
	function add_designation($ref_designation,$lib_designation)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO designation(ref_desig,lib_desig) VALUES(?,?)");
			$stmt->execute(array($ref_designation,$lib_designation));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}



	function add_agent($matricule,$nom_agent,$prenom_agent,$poste_agent,$id_serv)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO agent(matricule,nom_agent,prenom_agent,poste_agent,id_serv) VALUES(?,?,?,?,?)");
			$stmt->execute(array($matricule,$nom_agent,$prenom_agent,$poste_agent,$id_serv));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


	function add_sortie($date_sortie,$date_retoure,$mission,$signature,$id_agent)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO sortie(date_sortie_outil,date_retour_outil,mission,signature_sortie,id_agent) VALUES(?,?,?,?,?)");
			$stmt->execute(array($date_sortie,$date_retoure,$mission,$signature,$id_agent));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function add_sortie_outie($id_sortie_outil,$id_outil,$id_etat)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO sortir(id_sortie_outil,id_outil,id_etat) VALUES(?,?,?)");
			$stmt->execute(array($id_sortie_outil,$id_outil,$id_etat));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function add_sortie_comp($id_sortie_outil,$id_comp_outil,$id_etat_sortie_c,$id_outil)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO sortir_composant(id_sortie_outil,id_comp_outil,id_etat_sortie_c,id_outil) VALUES(?,?,?,?)");
			$stmt->execute(array($id_sortie_outil,$id_comp_outil,$id_etat_sortie_c,$id_outil));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}



	// Fonction pour enregistrer un outil

	function add_outil($ref_outil,$date_enreg,$image_outil,$id_statut,$id_etat,$id_desig,$id_emplacement,$id_categorie,$id_position)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO outil(ref_outil,date_enreg,image_outil,id_statut,id_etat,id_desig,id_emplacement,id_categorie,id_position)
													 VALUES(?,?,?,?,?,?,?,?,?)");
			$stmt->execute(array($ref_outil,$date_enreg,$image_outil,$id_statut,$id_etat,$id_desig,$id_emplacement,$id_categorie,$id_position));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

// Fonction pour enregistrer une composant
	function add_composant($ref_outil_comp,$date_enreg_comp,$id_etat,$id_desig,$id_outil)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO composant_outil(ref_comp_outil,date_enreg_comp,id_etat,id_desig,id_outil)
													 VALUES(?,?,?,?,?)");
			$stmt->execute(array($ref_outil_comp,$date_enreg_comp,$id_etat,$id_desig,$id_outil));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	//Fonction pour ajouter une designation
/*	function add_position_($lib_position,$id_identification)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO position(lib_position,id_identification) VALUES(?,?)");
			$stmt->execute(array($lib_position,$id_identification));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}
*/

function add_position($lib_position,$id_identification)
{
	
	try
	{
		$pdo = $GLOBALS['connexion'];
		$pdo->beginTransaction();
		$stmt = $pdo->prepare("INSERT INTO position (lib_position,id_identification) VALUES(?,?)");
		$stmt->execute(array($lib_position,$id_identification));
		
		$pdo->commit();
		return true;

	}catch(Exception $e)
	{
		return false;
		
	}
}


	function add_emplacement($lib_emplacement)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO emplacement(lib_emplacement) VALUES(?)");
			$stmt->execute(array($lib_emplacement));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function add_identification($lib_identification)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO identification(lib_identification) VALUES(?)");
			$stmt->execute(array($lib_identification));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function add_historique($date_modif,$id_etat_init,$id_etat_modif,$com,$id_outil,$id_user)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO historique_modif_outil(date_modif,id_etat_init,id_etat_modif,com_modif,id_outil,id_user) VALUES(?,?,?,?,?,?)");
			$stmt->execute(array($date_modif,$id_etat_init,$id_etat_modif,$com,$id_outil,$id_user));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}
//********************************************************************************************************************** */
// FONCTIONS DE MODIFICATION DES DONNEES
function modif_outil_info_general($ref_outil,$image_outil,$id_emplacement,$id_categorie,$id_position,$id_user,$id_outil)
{
	
	try
	{
		$pdo = $GLOBALS['connexion'];
		$pdo->beginTransaction();
		$stmt = $pdo->prepare("UPDATE outil set ref_outil=?,image_outil=?,id_emplacement=?,id_categorie=?,id_position=?,id_user_modif=? where id_outil=?");
		$stmt->execute(array($ref_outil,$image_outil,$id_emplacement,$id_categorie,$id_position,$id_user,$id_outil));
		
		$pdo->commit();
		return true;

	}catch(Exception $e)
	{
		return false;
		
	}
}


function modif_un_outil($date_modif,$com_modif,$image_outil,$id_statut,$id_etat,$id_emplacement,$id_categorie,$id_position,$id_user,$id_outil)
{
	
	try
	{
		$pdo = $GLOBALS['connexion'];
		$pdo->beginTransaction();
		$stmt = $pdo->prepare("UPDATE outil set date_modif=?,com_modif=?,image_outil=?,id_statut=?,id_etat=?,id_emplacement=?,id_categorie=?,id_position=?,id_user_modif=? where id_outil=?");
		$stmt->execute(array($date_modif,$com_modif,$image_outil,$id_statut,$id_etat,$id_emplacement,$id_categorie,$id_position,$id_user,$id_outil));
		
		$pdo->commit();
		return true;

	}catch(Exception $e)
	{
		return false;
		
	}
}

function modif_designation($ref_desig,$lib_desig,$id_desig)
{
	
	try
	{
		$pdo = $GLOBALS['connexion'];
		$pdo->beginTransaction();
		$stmt = $pdo->prepare("UPDATE designation set ref_desig = ?,lib_desig = ?  where id_desig=?");
		$stmt->execute(array($ref_desig,$lib_desig, $id_desig));
		
		$pdo->commit();
		return true;

	}catch(Exception $e)
	{
		return false;
		
	}
}

function modif_ref_composant($ref_comp_outil,$id_comp_outil)
{
	
	try
	{
		$pdo = $GLOBALS['connexion'];
		$pdo->beginTransaction();
		$stmt = $pdo->prepare("UPDATE composant_outil set ref_comp_outil = ? where id_comp_outil=?");
		$stmt->execute(array($ref_comp_outil,$id_comp_outil));
		
		$pdo->commit();
		return true;

	}catch(Exception $e)
	{
		return false;
		
	}
}