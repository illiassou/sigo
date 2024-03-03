<?php

class Manager
{

    private $db;

    public function __construct()
    {
        $connexion = new Connexion();
        $this->db = $connexion->connexion();
    }

  function Liste_article()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from article A,tva T,type_article TA
			                                  where  A.id_tva=T.id_tva and A.id_type_article=TA.id_type_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function un_article($id_article)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from article A,tva T,type_article TA
			                                  where  A.id_tva=T.id_tva and A.id_type_article=TA.id_type_article and A.id_article=$id_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

function Liste_article_alerte()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from article A,tva T,type_article TA,sortir S,entrer E
			                                  where  A.id_tva=T.id_tva and A.id_type_article=TA.id_type_article and A.id_article = S.id_article and A.id_article = E.id_article and sum(E.quantite_entree)-sum(S.quantite_sortie)<=A.seuil_min group by A.id_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function situation_entre($id_article)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT SUM(E.quantite_entree) as quantite_entre from article A,entre E
			                                  where A.id_article=E.id_article and E.id_article=$id_article group by E.id_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
function situation_sortie($id_article)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(S.quantite_sortie) as quantite_sortie from article A,sortie S
			                                  where A.id_article=S.id_article and S.id_article=$id_article group by S.id_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}



	
	function Liste_entree_Cumul()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT SUM(R.quantite_entree) as quantite_entre,A.lib_article,A.image from article A,entre E,entrer R where A.id_article=R.id_article and E.id_entre = R.id_entre group by R.id_article ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function Liste_entree_Cumul_mois()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(R.quantite_entree) FROM entrer R,entre E,article A WHERE A.id_article = R.id_article and E.id_entre=R.id_entre  GROUP by month(date_entre)");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}



	function sotck_entre_($id_article)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(ER.quantite_entree) as quantite_entree FROM entrer ER,entre E WHERE ER.id_article=$id_article  and E.verif_entre = 1 and E.id_entre = ER.id_entre group by ER.id_article ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function chiffre_affaire()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(FR.quantite_vendu*FR.prix_unitaire) as chiffe_mois,month(F.date_facture) as mois  FROM facture F, facturer FR  WHERE FR.id_facture=F.id_facture group by month(F.date_facture) ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function chiffre_affaire_article()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(FR.quantite_vendu*FR.prix_unitaire) as chiffe_mois,month(F.date_facture) as mois ,A.lib_article FROM facture F, facturer FR, article A  WHERE A.id_article = FR.id_article and FR.id_facture=F.id_facture group by FR.id_article order by chiffe_mois Desc  limit 10");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function stock_sortie_($id_article)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(quantite_sortie) as quantite_sortie FROM sortir SE,sortie S WHERE S.id_sortie = SE.id_sortie and S.verif_sortie=1 and SE.id_article=$id_article ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

		function Liste_entree()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from entre E,type_entre T where E.id_type_entre = T.id_type_entre");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


		function rapport_entree($con)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from entre E,entrer ER,article A,type_entre T where E.id_type_entre = T.id_type_entre and E.id_entre = ER.id_entre and A.id_article = ER.id_article $con group by E.date_entre");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


		function Liste_article_entree($id_entre)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from entrer E,article A where E.id_article = A.id_article and E.id_entre=$id_entre");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


		function rapport_article_entree($id_entre,$con)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from entrer E,article A where E.id_article = A.id_article and E.id_entre=$id_entre $con ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


		function Liste_somme($colonne,$table,$con)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT count($colonne) as nbre from $table $con");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


		function Liste_type_versement()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from type_versement ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


		function remise()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from remise");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}



	function Liste_entree_($id_entre)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from entre E,type_entre T where E.id_type_entre = T.id_type_entre and E.id_entre = $id_entre");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function info_entree($code_entre)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from entre E,type_entre T where E.id_type_entre = T.id_type_entre and E.code_entre = '$code_entre'");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function Liste_sortie()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT SUM(S.quantite_sortie) as quantite_sortie,A.lib_article,A.image from article A,sortie S where A.id_article=S.id_article group by S.id_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	
	function Liste_utilisateur()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from user U,privilege P where U.id_privilege=P.id_privilege");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function login($username)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from user U,privilege P where U.id_privilege=P.id_privilege and U.user_name='$username'");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function Liste_abonnement()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from client C,carte CA,saboner B where C.id_client=CA.id_client and CA.num_carte=B.num_carte and B.valide='0'");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

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


	function modif_statut_com($statut,$id_bon_com)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE bon_commande set statut_com=? where id_bon_com=?");
			$stmt->execute(array($statut,$id_bon_com));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

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



	function Modif_entre($quantite_entre,$cout_achat,$date_ex,$id_emplacement,$id_article,$id_entre)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE entre set quantite_entree=?, cout_achat=?,date_exp=?,id_emplacement=?,id_article=? where id_entre=?");
			$stmt->execute(array($quantite_entre,$cout_achat,$date_ex,$id_emplacement,$id_article,$id_entre));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}
function miseajour_quantite($quantite,$id_article)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE article set quantite_stock=? where id_article=?");
			$stmt->execute(array($quantite,$id_article));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function miseajour_quantite_m($quantite,$id_article)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE article set stock_magasin=? where id_article=?");
			$stmt->execute(array($quantite,$id_article));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}



function miseajour_compte($valide,$id_user)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE user set valide_compte=? where id_user=?");
			$stmt->execute(array($valide,$id_user));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


function Modif_client($nom_client,$prenom_client,$tel_client,$adresse_client,$id_type_client,$id_client)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE client set nom_client=?,prenom_client=?,tel_client=?,adresse_client=?,id_type_client=? where id_client=?");
			$stmt->execute(array($nom_client,$prenom_client,$tel_client,$adresse_client,$id_type_client,$id_client));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function Modif_gerant($nom_gerant,$tel_gerant,$adresse_gerant,$id_gerant)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE gerant set nom_gerant=?,tel_gerant=?,addresse_gerant=? where id_gerant=?");
			$stmt->execute(array($nom_gerant,$tel_gerant,$adresse_gerant,$id_gerant));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}



function Modif_fournisseur($nom_fournisseur,$tel_fournisseur,$adresse_founisseur,$nif_fournisseur,$rccm_fournisseur,$id_founisseur)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE fournisseur set nom_fournisseur=?,tel_fournisseur=?,adresse_fournisseur=?,nif_fournisseur=?,rccm_fournisseur=? where id_fournisseur=?");
			$stmt->execute(array($nom_fournisseur,$tel_fournisseur,$adresse_founisseur,$nif_fournisseur,$rccm_fournisseur,$id_founisseur));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


function supp_article_entre($id_article,$id_entre)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("DELETE FROM entrer where id_article=? and id_entre=?");
			$stmt->execute(array($id_article,$id_entre));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

function supp_client($id_client)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("DELETE FROM client where id_client=?");
			$stmt->execute(array($id_client));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function supp_depot($id_depot)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("DELETE FROM depot where id_depot=?");
			$stmt->execute(array($id_depot));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

function supp_Gerant($id_gerant)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("DELETE FROM gerant where id_gerant=?");
			$stmt->execute(array($id_gerant));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}
	function supp_fournisseur($id_fournisseur)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("DELETE FROM fournisseur where id_fournisseur=?");
			$stmt->execute(array($id_fournisseur));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function supp_utilisateur($id_user)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("DELETE FROM user where id_user=?");
			$stmt->execute(array($id_user));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function Ajout_utilisateur($nom_prenom,$user_name,$privilege)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO user (nom_prenom,user_name,id_privilege) 
						VALUES (?,?,?)
						");
			$stmt->execute(array($nom_prenom,$user_name,$privilege));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function Ajout_bon_com($code_bon_com,$date_bon_com,$statut_com,$date_prevu,$id_founisseur)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO bon_commande (code_bon_com,date_bon_com,statut_com,date_prevue,id_fournisseur) 
						VALUES (?,?,?,?,?)
						");
			$stmt->execute(array($code_bon_com,$date_bon_com,$statut_com,$date_prevu,$id_founisseur));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

		function Ajout_commande($id_bon_com,$id_article,$quantite_commande)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO commande (id_bon_com,id_article,quantite_commande) 
						VALUES (?,?,?)
						");
			$stmt->execute(array($id_bon_com,$id_article,$quantite_commande));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function Ajout_client($code_client,$nom_client,$prenom_client,$tel_client,$adresse_client,$id_type_client)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO client (code_client,nom_client,prenom_client,tel_client,adresse_client,id_type_client) 
						VALUES (?,?,?,?,?,?)
						");
			$stmt->execute(array($code_client,$nom_client,$prenom_client,$tel_client,$adresse_client,$id_type_client));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

function Ajout_Gerant($code_gerant,$nom_gerant,$tel_gerant,$adresse_gerant)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO gerant (code_gerant,nom_gerant,tel_gerant,addresse_gerant) 
						VALUES (?,?,?,?)
						");
			$stmt->execute(array($code_gerant,$nom_gerant,$tel_gerant,$adresse_gerant
			));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function Ajout_fournisseur($code_fournisseur,$nom_fournisseur,$tel_fournisseur,$adresse_founisseur,$nif_fournisseur,$rccm_fournisseur)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO fournisseur (code_fournisseur,nom_fournisseur,tel_fournisseur,adresse_fournisseur,nif_fournisseur,rccm_fournisseur) 
						VALUES (?,?,?,?,?,?)
						");
			$stmt->execute(array($code_fournisseur,$nom_fournisseur,$tel_fournisseur,$adresse_founisseur,$nif_fournisseur,$rccm_fournisseur));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}
function Ajout_versement($date_versement,$montant_verse,$doc_versement,$id_type_versement,$id_facture,$id_depot)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO versement (date_versement,montant_verse,doc_versement,id_type_versement,id_facture,id_depot) 
						VALUES (?,?,?,?,?,?)
						");
			$stmt->execute(array($date_versement,$montant_verse,$doc_versement,$id_type_versement,$id_facture,$id_depot));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


	function Ajout_Affect($date_affect,$id_depot,$id_user)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO affectation (date_affectation,id_depot,id_user) 
						VALUES (?,?,?)
						");
			$stmt->execute(array($date_affect,$id_depot,$id_user));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


	function Ajout_Affect_article($id_affectation,$id_article,$quantite_affecter,$prix_unitaire)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO affectation_stock (id_affectation,id_article,quantite_affecter,prix_unitaire) 
						VALUES (?,?,?,?)
						");
			$stmt->execute(array($id_affectation,$id_article,$quantite_affecter,$prix_unitaire));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


function detail_article($id)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from article A,entre E where A.id_article=$id and A.id_article=E.id_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}



	function liste_versement($id,$type_credit)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from crediter where id =$id and type='$type_credit'");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}



	}

	function versement_eff($id_depot)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from versement V,type_versement T where V.id_depot =$id_depot and V.id_type_versement = T.id_type_versement ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}

		
	}

function liste_solde($id,$type_credit)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from credit where id =$id and type_credit='$type_credit'");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function liste_client()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from client C,type_client T where C.id_type_client =T.id_type_client");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function client($id_client)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from client C,type_client T where C.id_type_client =T.id_type_client and C.id_client = $id_client");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
	

function liste_type_client()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from type_client");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function liste_ville()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from ville order by lib_ville asc");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

		function liste_gerant()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from gerant G  order by nom_gerant asc");
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
			$rep = $pdo->query("SELECT * from agent A,fonction F where A.id_fonction = F.id_fonction  order by A.nom_agent asc");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

		function agent($id_agent)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from agent A,fonction F where A.id_fonction = F.id_fonction and A.id_agent =$id_agent  order by A.nom_agent asc");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function liste_fournisseur()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from fournisseur");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function liste_depot_vente()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from depot D, gerant G,ville V where D.id_gerant = G.id_gerant and D.id_ville = V.id_ville");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function depot_vente($id_depot)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from depot D, gerant G,ville V where D.id_gerant = G.id_gerant and D.id_ville = V.id_ville and D.id_depot = $id_depot");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function affectation_depot($id_depot)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from sortie  where id_depot = $id_depot order by date_sortie Desc");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


		function retour_stock_depot($id_depot)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from entre E, sortie S where S.id_depot = $id_depot and E.code_sortie=S.code_sortie and E.code_sortie!='0' order by E.date_entre Desc");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

		function affectation_article($id_depot,$id_sortie)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from sortie S, sortir SR,article A,tva T  where S.id_depot = $id_depot and A.id_article = SR.id_article and A.id_tva = T.id_tva and S.id_sortie =SR.id_sortie and SR.id_sortie =$id_sortie order by S.date_sortie asc ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


		function retour_article($id_depot,$id_entre)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from entre E, entrer ER,article A,tva T, sortie S, sortir SR  where S.id_depot = $id_depot and E.code_sortie!='0' and A.id_article = ER.id_article and A.id_tva = T.id_tva and S.id_sortie=SR.id_sortie and S.code_sortie=E.code_sortie and E.id_entre =ER.id_entre and ER.id_entre =$id_entre and SR.id_article =A.id_article order by E.date_entre asc ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function liste_affectation()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(SR.quantite_sortie*SR.prix_unitaire) as montant,sum(SR.quantite_sortie*SR.prix_unitaire*T.taux_tva) as tva,S.code_sortie,S.date_sortie,S.id_sortie,A.id_article,T.taux_tva,D.lib_depot,S.code_facture,SR.id_sortie,G.nom_gerant,G.tel_gerant from sortie S,sortir SR,depot D, article A, tva T, gerant G where G.id_gerant = D.id_gerant and D.id_depot = S.id_depot and S.id_sortie = SR.id_sortie and A.id_article = SR.id_article and A.id_tva = T.id_tva and S.id_depot!=0 and S.id_client = 0 and S.code_facture=0 group by SR.id_sortie order by S.date_sortie Desc");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function liste_sortie_stock()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from sortie S,sortir SR,client C, article A, tva T where C.id_client = S.id_client and S.id_sortie = SR.id_sortie and A.id_article = SR.id_article and A.id_tva = T.id_tva and S.id_depot=0 and S.id_client !=0 and S.code_facture!='0' group by SR.id_sortie order by S.id_sortie");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function liste_sortie_stock_agent()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from sortie S,sortir SR,agent C, article A, tva T,fonction F where C.id_agent = S.id_agent and S.id_sortie = SR.id_sortie and A.id_article = SR.id_article and A.id_tva = T.id_tva and F.id_fonction = C.id_fonction and S.id_depot=0 and S.id_client =0 and S.id_agent!=0 and S.code_facture='0' group by SR.id_sortie order by S.id_sortie");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

		function rapport_sortie_stock_c($con)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from sortie S,sortir SR,client C, article A, tva T where C.id_client = S.id_client and S.id_sortie = SR.id_sortie and A.id_article = SR.id_article and A.id_tva = T.id_tva and S.id_depot=0 and S.id_client !=0 and S.code_facture!='0' $con   order by S.id_sortie");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


		function rapport_sortie_stock_d($con)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from sortie S,sortir SR,depot D, article A, tva T where D.id_depot = S.id_depot and S.id_sortie = SR.id_sortie and A.id_article = SR.id_article and A.id_tva = T.id_tva and S.id_depot!=0 and S.id_client =0 and S.code_facture!='0'  $con  order by S.id_sortie");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

			function rapport_sortie_stock_a($con)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from sortie S,sortir SR, article A, tva T where S.id_sortie = SR.id_sortie and A.id_article = SR.id_article and A.id_tva = T.id_tva   $con  order by S.id_sortie");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function sortie_stock_depot($id_depot)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT 
				sum(SR.quantite_sortie*SR.prix_unitaire) as montant,
				sum(SR.quantite_sortie*SR.prix_unitaire*T.taux_tva) as tva,
				S.code_sortie,S.date_sortie,S.id_sortie,A.id_article,T.taux_tva
				from sortie S,sortir SR ,depot D, article A, tva T 
				where D.id_depot = S.id_depot and S.id_sortie = SR.id_sortie and A.id_article = SR.id_article and A.id_tva = T.id_tva and S.id_depot!=0 and S.id_client =0 and S.id_depot = $id_depot group by S.id_sortie order by S.date_sortie Desc");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}



	function article_affecter($id_sortie)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from article A, sortir S,tva T where S.id_sortie =$id_sortie and A.id_article = S.id_article and A.id_tva = T.id_tva order by A.lib_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

		function verif_sortie($code_sortie)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from article A,sortie SE, sortir S,tva T where SE.code_sortie ='$code_sortie' and A.id_article = S.id_article and A.id_tva = T.id_tva and S.id_sortie=SE.id_sortie order by A.lib_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


function verif_entre($code_entre)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from article A,entre E, entrer ER,tva T where E.code_entre ='$code_entre' and A.id_article = ER.id_article and A.id_tva = T.id_tva and E.id_entre=ER.id_entre order by A.lib_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}



		function liste_acces()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from acces");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

		function acces_user($id_user)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from acces A, user U, droit_acces D where D.id_user = $id_user and U.id_user = D.id_user and D.id_acces = A.id_acces");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function liste_commande()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from bon_commande BC, commande C, fournisseur F where F.id_fournisseur=BC.id_fournisseur and C.id_bon_com = BC.id_bon_com group by C.id_bon_com");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function info_sortie($id_sortie)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from sortie S,type_sortie T where S.id_sortie =$id_sortie and S.id_type_sortie = T.id_type_sortie");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function info_sortie_verif($code_sortie)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from sortie S,type_sortie T where S.code_sortie ='$code_sortie' and S.id_type_sortie = T.id_type_sortie");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}



		function info_depot($id_depot)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from depot D,ville V, gerant G where D.id_depot =$id_depot and D.id_ville = V.id_ville and D.id_gerant = G.id_gerant");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function liste_facture()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from facture F,remise R,client C where C.id_client = F.id_client and  R.id_remise = F.id_remise");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}



function rapport_facture($con)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from facture F,remise R where  R.id_remise = F.id_remise $con");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

		function un_facture($code_facture)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from facture F,client C,remise R where F.id_client = C.id_client and R.id_remise = F.id_remise and F.code_facture='$code_facture'");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

function facture_one($id_facture)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from facture F,client C,remise R where F.id_client = C.id_client and R.id_remise = F.id_remise and F.id_facture = $id_facture");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function versement_facture($id_facture)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(V.montant_verse) as montant_verse from versement V ,facture D where V.id_facture = $id_facture and D.id_facture = V.id_facture group by V.id_facture");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function versement_facture_cumul()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(V.montant_verse) as montant_verse from versement V ,facture D where  D.id_facture = V.id_facture and V.id_facture!=0");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function versement_depot($id_depot)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(V.montant_verse) as montant_verse from versement V ,depot D where V.id_depot = $id_depot and V.id_depot = D.id_depot  group by V.id_depot");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}






	function versement_depot_cumule()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(montant_verse) as montant_verse from versement  ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function calcul_facture($id_facture)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT SUM(FR.quantite_vendu*FR.prix_unitaire) as prix,SUM(FR.quantite_vendu*FR.prix_unitaire*T.taux_tva) as mont_tva from facturer FR, article A,tva T where FR.id_article = A.id_article and A.id_tva = T.id_tva and FR.id_facture=$id_facture group by FR.id_facture");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function calcul_facture_cumul()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT SUM(FR.quantite_vendu*FR.prix_unitaire) as prix_c,SUM(FR.quantite_vendu*FR.prix_unitaire*T.taux_tva) as mont_tva, sum((FR.quantite_vendu*FR.prix_unitaire)*R.taux_remise) as mont_remise from facturer FR,facture F,article A,tva T,remise R where R.id_remise = F.id_remise and F.id_facture = FR.id_facture and FR.id_article = A.id_article and A.id_tva = T.id_tva ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function calcul_par_article()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT SUM(FR.quantite_vendu) as quantite_vendu,A.lib_article from facturer FR, article A,tva T where FR.id_article = A.id_article and A.id_tva = T.id_tva  group by FR.id_article order by SUM(FR.quantite_vendu) Desc limit 10");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

		function situation_depot()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT SUM(SR.quantite_sortie*SR.prix_unitaire) as prix,SUM(SR.quantite_sortie*SR.prix_unitaire*T.taux_tva) as mont_tva,D.lib_depot,S.id_depot,G.nom_gerant,G.tel_gerant, V.lib_ville,S.code_sortie from sortie S,sortir SR, article A,tva T,depot D,ville V, gerant G where SR.id_article = A.id_article and A.id_tva = T.id_tva and SR.id_sortie=S.id_sortie and D.id_depot = S.id_depot and V.id_ville = D.id_ville and G.id_gerant = D.id_gerant and S.id_client =0 and S.id_depot!=0 group by S.id_depot");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


			function situation_depot_cumul()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT SUM(SR.quantite_sortie*SR.prix_unitaire) as prix,SUM(SR.quantite_sortie*SR.prix_unitaire*T.taux_tva) as mont_tva,D.lib_depot,S.id_depot,G.nom_gerant,G.tel_gerant, V.lib_ville,S.code_sortie from sortie S,sortir SR, article A,tva T,depot D,ville V, gerant G where SR.id_article = A.id_article and A.id_article=SR.id_article and A.id_tva = T.id_tva and SR.id_sortie=S.id_sortie and D.id_depot = S.id_depot and V.id_ville = D.id_ville and G.id_gerant = D.id_gerant and S.id_client =0 ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


		function situation_depot_retour_stock($id_depot)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT SUM(ER.quantite_entree*SR.prix_unitaire) as prix,SUM(ER.quantite_entree*SR.prix_unitaire*T.taux_tva) as mont_tva_r,D.lib_depot,S.id_depot,G.nom_gerant,G.tel_gerant, V.lib_ville,S.code_sortie from sortie S,sortir SR, article A,tva T,depot D,ville V, gerant G,entre E, entrer ER where SR.id_article = A.id_article and A.id_article=ER.id_article and A.id_tva = T.id_tva and SR.id_sortie=S.id_sortie and D.id_depot = S.id_depot and V.id_ville = D.id_ville and G.id_gerant = D.id_gerant and E.id_entre = ER.id_entre and S.code_sortie = E.code_sortie and S.id_client =0 and S.id_depot=$id_depot and E.code_sortie!='0'  group by S.id_depot");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}




		function situation_agent_retour_stock($id_article,$code_sortie)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from sortie S,sortir SR, article A,agent D,entre E, entrer ER where SR.id_article = A.id_article and A.id_article=ER.id_article and SR.id_sortie=S.id_sortie and D.id_agent = S.id_agent and E.id_entre = ER.id_entre and S.code_sortie = E.code_sortie and S.id_client =0 and ER.id_article=$id_article and E.code_sortie ='$code_sortie' and E.code_sortie!='0' ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

		function situation_depot_retour_stock_ta()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT SUM(ER.quantite_entree*SR.prix_unitaire) as prix ,A.lib_article from sortie S,sortir SR, article A,tva T,depot D,ville V, gerant G,entre E, entrer ER where SR.id_article = A.id_article and A.id_article=ER.id_article and A.id_tva = T.id_tva and SR.id_sortie=S.id_sortie and D.id_depot = S.id_depot and V.id_ville = D.id_ville and G.id_gerant = D.id_gerant and E.id_entre = ER.id_entre and S.code_sortie = E.code_sortie and S.id_client =0  and E.code_sortie!='0' group by S.id_depot ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

		function situation_par_depot($id_depot)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT SUM(SR.quantite_sortie*SR.prix_unitaire) as prix,SUM(SR.quantite_sortie*SR.prix_unitaire*T.taux_tva) as mont_tva,D.lib_depot,S.id_depot,G.nom_gerant,G.tel_gerant, V.lib_ville from sortie S,sortir SR, article A,tva T,depot D,ville V, gerant G where SR.id_article = A.id_article and A.id_tva = T.id_tva and SR.id_sortie=S.id_sortie and D.id_depot = S.id_depot and V.id_ville = D.id_ville and G.id_gerant = D.id_gerant and S.id_client =0 and S.id_depot =$id_depot group by S.id_depot");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

function article_facture($id_facture)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from facturer F,article A,tva T where F.id_article = A.id_article and A.id_tva = T.id_tva and F.id_facture=$id_facture");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function stock_article($id_article)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(E.quantite_entree) as quantite_entree,sum(S.quantite_sortie) as quantite_sortie from article A,entrer E, sortir S where E.id_article = A.id_article and S.id_article = A.id_article and A.id_article=$id_article group by A.id_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}

	}

	function stock_entre()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(E.quantite_entree) as quantite_entree,A.id_article, A.lib_article,A.image,A.seuil_min from article A,entrer E,entre ER where E.id_article = A.id_article and ER.verif_entre=1 and E.id_entre = ER.id_entre group by E.id_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}

	}


	function rapport_stock($con)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(E.quantite_entree) as quantite_entree,A.id_article, A.lib_article,A.image,A.seuil_min from article A,entrer E,entre ER where ER.id_entre = E.id_entre and E.id_article = A.id_article $con group by E.id_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}

	}

	function stock_entre_article($id_article)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(E.quantite_entree) as quantite_entree,A.id_article, A.lib_article,A.image,A.seuil_min from article A,entrer E,entre ER where ER.id_entre=E.id_entre and E.id_article = A.id_article and E.id_article=$id_article and ER.verif_entre=1 group by E.id_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}

	}

	function stock_sortie($id_article)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(S.quantite_sortie) as quantite_sortie, A.lib_article,A.image,A.seuil_min from article A,sortir S,sortie E where S.id_article = A.id_article and E.id_sortie = S.id_sortie and E.verif_sortie=1 and S.id_article=$id_article group by S.id_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}

	}


		function rapport_sortie($id_article,$con)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(S.quantite_sortie) as quantite_sortie, A.lib_article,A.image,A.seuil_min from article A,sortir S,sortie E where S.id_article = A.id_article and E.id_sortie = S.id_sortie and E.verif_sortie=1 and S.id_article=$id_article $con group by S.id_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}

	}



	function groupe_Tva($id_facture)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT SUM(F.prix_unitaire*F.quantite_vendu) as baseHT,T.lib_tva, T.taux_tva,A.id_tva from facturer F,article A,tva T where F.id_article = A.id_article and A.id_tva = T.id_tva and F.id_facture=$id_facture group by A.id_tva");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

function liste_solde_etat($id,$type_credit,$dateD,$dateF)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from credit where id =$id and type_credit='$type_credit' and date_credit>='$dateD' and date_credit<='$dateF'");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


	function versement($id,$type)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT sum(montant_verser) as total_verser from crediter where id=$id and type='$type'");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
/*
		function liste_copie()
	{
		$date=date('Y-m-d');
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT * from copie C,tarif T where C.id_tarif=T.id_tarif ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
*/
	



	





	


	/*function situation_A($date)
	{

		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT V.date from vente V where V.date !='$date' ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
*/






function commande($id)
{
	
	try
	{
	    $pdo = $GLOBALS['connexion'];
		$stmt = $pdo->prepare("SELECT * from bon_commande BC,fournisseur F where BC.id_fournisseur = F.id_fournisseur and BC.id_bon_com = $id");
		$stmt->execute();
		return $stmt;
	}catch(Exception $e)
	{
		
		return $e;
		
	}
}

function liste_article_commande($id)
{
	
	try
	{
	    $pdo = $GLOBALS['connexion'];
		$stmt = $pdo->prepare("SELECT * from commande C,article A where C.id_article = A.id_article and C.id_bon_com = $id");
		$stmt->execute();
		return $stmt;
	}catch(Exception $e)
	{
		
		return $e;
		
	}
}


function liste_fonction()
{
	
	try
	{
	    $pdo = $GLOBALS['connexion'];
		$stmt = $pdo->prepare("SELECT * from fonction ");
		$stmt->execute();
		return $stmt;
	}catch(Exception $e)
	{
		
		return $e;
		
	}
}





	function historique()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT E.id_article,A.lib_article,A.image from article A,entre E where A.id_article=E.id_article 

				group by E.id_article");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
function GetRecettes($id)
{
	
	try
	{
	    $pdo = $GLOBALS['connexion'];
		$stmt = $pdo->prepare("select id,intitule,detail from recette where valide=1 and id > ?");
		$stmt->execute(array($id));
		return $stmt->fetchAll();
	}catch(Exception $e)
	{
		
		return $e;
		
	}
}

function ListeRecette()
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$records = $pdo->query("select id,intitule,detail from recette where valide=1 order by id");
			return $records;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
function SupprimerRecette($del_id)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE recette set valide=0 where id=?");
			$stmt->execute(array($del_id));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


	function modif_v($montant,$type,$id_versement)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE crediter set montant_verser=?,type=? where id_versement=?");
			$stmt->execute(array($montant,$type,$id_versement));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

		function modif_agent($nom_agent,$tel_agent,$id_fonction,$id_agent)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE agent set nom_agent=?,tel_agent=?,id_fonction=? where id_agent=?");
			$stmt->execute(array($nom_agent,$tel_agent,$id_fonction,$id_agent));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


		function modif_article_entre($quantite_entre,$cout_achat,$date_ex,$id_article,$id_entre)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE entrer set quantite_entree=?,cout_achat=?,date_exp=? where id_article=? and id_entre=?");
			$stmt->execute(array($quantite_entre,$cout_achat,$date_ex,$id_article,$id_entre));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


		function modif_article_bc($quantite,$id_article,$id_bon_com)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE commande set quantite_commande=? where id_article=? and id_bon_com=?");
			$stmt->execute(array($quantite,$id_article,$id_bon_com));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


	function modif_fonction($lib_fonction,$id_fonction)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE fonction set lib_fonction=?where id_fonction=?");
			$stmt->execute(array($lib_fonction,$id_fonction));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}



function modif_article_sortie($quantite_sortie,$prix_unitaire,$id_user,$id_sortie,$id_article)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE sortir set quantite_sortie=?,prix_unitaire=?,modif_user_id=? where id_sortie=? and id_article=?");
			$stmt->execute(array($quantite_sortie,$prix_unitaire,$id_user,$id_sortie,$id_article));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}
	function Reinitialiser()
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE saboner set valide=1");
			$stmt->execute();
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}





	function valide_sortie($verif_sortie,$id_user,$code_sortie)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE sortie set verif_sortie=?,verif_user_id=? where code_sortie=?");
			$stmt->execute(array($verif_sortie,$id_user,$code_sortie));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


	function valide_entre($verif_entre,$id_user,$code_entre)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE entre set verif_entre=?,verif_user_id=? where code_entre=?");
			$stmt->execute(array($verif_entre,$id_user,$code_entre));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


function Restoration($dateD,$dateF)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE saboner set valide=0 where date_abonement>='$dateD' and date_abonement<='$dateF'");
			$stmt->execute();
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}
	function modif_depot($lib_depot,$nif_depot,$rccm_depot,$id_ville,$id_gerant,$id_depot)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE depot set lib_depot=?,nif_depot=?,rccm_depot=?,id_ville=?,id_gerant=? where id_depot=?");
			$stmt->execute(array($lib_depot,$nif_depot,$rccm_depot,$id_ville,$id_gerant,$id_depot));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function Modif_article($lib_article,$prix_unitaire_min,$prix_unitaire_max,$seuil_min,$id_tva,$id_type_article,$image,$id_article)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE article set lib_article=?,prix_unitaire_min=?,prix_unitaire_max=?,seuil_min=?,id_tva=?,id_type_article=?,image=? where id_article=?");
			$stmt->execute(array($lib_article,$prix_unitaire_min,$prix_unitaire_max,$seuil_min,$id_tva,$id_type_article,$image,$id_article));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	

	function enregistre_payer ($code,$reference,$id_payer)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE payer set code_payer=? where reference_fact=? and id_payer=?");
			$stmt->execute(array($code,$reference,$id_payer));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

function entree_article($quantite_stock,$id_article)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE article set quantite_stock=? where id_article=?");
			$stmt->execute(array($quantite_stock,$id_article));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function sortie_article($quantite_stock,$quantite_boutique,$prix_vente,$id_article)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE article set quantite_stock=?,quantite_boutique=?,prix_vente=? where id_article=?");
			$stmt->execute(array($quantite_stock,$quantite_boutique,$prix_vente,$id_article));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function supp_article($id_article)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("DELETE FROM article where id_article=?");
			$stmt->execute(array($id_article));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function supp_acces($id_user,$id_acces)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("DELETE FROM droit_acces where id_user=? and id_acces=?");
			$stmt->execute(array($id_user,$id_acces));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function supp_article_com($id_article,$id_bon_com)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("DELETE FROM commande where id_article=? and id_bon_com=?");
			$stmt->execute(array($id_article,$id_bon_com));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function article_vendu($quantite_stock,$id_article)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE article set quantite_stock=? where id_article=?");
			$stmt->execute(array($quantite_stock,$id_article));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	

	function modif_payer($mois_fact,$annee_fact,$montant,$num_compte,$reference,$id_payer,$reference_fact)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE payer set mois_fact=?,annee_fact=?,montant_fact=?,num_compte=?,reference_fact=? where id_payer=? and reference_fact=?");
			$stmt->execute(array($mois_fact,$annee_fact,$montant,$num_compte,$reference,$id_payer,$reference_fact));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function modif_facture($reference,$id_type_fact,$reference_fact)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE facture set reference_fact=?,id_type_fact=? where reference_fact=?");
			$stmt->execute(array($reference,$id_type_fact,$reference_fact));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function modif_carte($num_carte_m,$id_client,$num_carte)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE carte set num_carte=?,id_client=? where num_carte=?");
			$stmt->execute(array($num_carte_m,$id_client,$num_carte));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function modif_abonnement($montant,$remise,$code,$num_carte,$id_abonement)
	{
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("UPDATE saboner set montant_abonement=?,remise=?,code_abonement=?, num_carte=? where id_abonement=?");
			$stmt->execute(array($montant,$remise,$code,$num_carte,$id_abonement));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}
function Ajout_article($code_article,$lib_article,$prix_unitaire_min,$prix_unitaire_max,$seuil_min,$id_tva,$id_type_article,$image,$id_user)
	{
		
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO article (code_article,lib_article,prix_unitaire_min,prix_unitaire_max,seuil_min,id_tva,id_type_article,image,id_user) 
						VALUES (?,?,?,?,?,?,?,?,?)
						");
			$stmt->execute(array($code_article,$lib_article,$prix_unitaire_min,$prix_unitaire_max,$seuil_min,$id_tva,$id_type_article,$image,$id_user));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


	function Ajout_article_m($code_article,$lib_article,$quantite_stock,$prix_unitaire,$seuil_min,$id_tva,$id_type_article,$image)
	{
		
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO article (code_article,lib_article,stock_magasin,prix_unitaire,seuil_min,id_tva,id_type_article,image) 
						VALUES (?,?,?,?,?,?,?,?)
						");
			$stmt->execute(array($code_article,$lib_article,$quantite_stock,$prix_unitaire,$seuil_min,$id_tva,$id_type_article,$image));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


function Ajout_depot($code_depot,$lib_depot,$nif_depot,$rccm_depot,$id_ville,$id_gerant)
	{
		
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO depot (code_depot,lib_depot,nif_depot,rccm_depot,id_ville,id_gerant) 
						VALUES (?,?,?,?,?,?)
						");
			$stmt->execute(array($code_depot,$lib_depot,$nif_depot,$rccm_depot,$id_ville,$id_gerant));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


	function Ajout_copie($date_copie,$nbre_ex,$nbre_page,$prix_reluire,$id_tarif)
	{
		
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO copie (date_copie,nbre_ex,nbre_page,prix_reluire,id_tarif) 
						VALUES (?,?,?,?,?)
						");
			$stmt->execute(array($date_copie,$nbre_ex,$nbre_page,$prix_reluire,$id_tarif));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}
	function facture($date,$code_facture,$mode_paie,$id_remise,$id_client,$id_user)
	{
		
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO facture (date_facture,code_facture,mode_paie,id_remise,id_client,id_user) 
						VALUES (?,?,?,?,?,?)
						");
			$stmt->execute(array($date,$code_facture,$mode_paie,$id_remise,$id_client,$id_user));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function ajout_acces($id_user,$id_acces)
	{
		
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO droit_acces (id_user,id_acces) 
						VALUES (?,?)
						");
			$stmt->execute(array($id_user,$id_acces));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


function ajout_fonction($lib_fonction)
	{
		
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO fonction (lib_fonction) 
						VALUES (?)
						");
			$stmt->execute(array($lib_fonction));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


function ajout_achat($date_achat,$quantite_achat,$prix_u,$id_consomable)
	{
		
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO achat_consomable (date_achat,quantite_achat,prix_u,id_consomable) 
						VALUES (?,?,?,?)
						");
			$stmt->execute(array($date_achat,$quantite_achat,$prix_u,$id_consomable));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

function facturer($id_facture,$id_article,$quantite,$prix)
	{
		
		
		try
		{
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO facturer (id_facture,id_article,quantite_vendu,prix_unitaire )
						VALUES (?,?,?,?)
						");
			$stmt->execute(array($id_facture,$id_article,$quantite,$prix));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


	function Ajout_entree($date,$quantite_entre,$cout_achat,$date_ex,$id_emplacement,$id_article)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO entre (date_entre,quantite_entree,cout_achat,date_exp,id_emplacement,id_article) 
						VALUES (?,?,?,?,?,?)
						");
			$stmt->execute(array($date,$quantite_entre,$cout_achat,$date_ex,$id_emplacement,$id_article));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function entre($code_entre,$date_entre,$id_type_entre,$lot_entre,$code_bon_com,$id_user)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO entre (code_entre,date_entre,id_type_entre,lot_entre,code_bon_commande,id_user) 
						VALUES (?,?,?,?,?,?)
						");
			$stmt->execute(array($code_entre,$date_entre,$id_type_entre,$lot_entre,$code_bon_com,$id_user));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


	function entre_retour($code_entre,$date_entre,$id_type_entre,$lot_entre,$code_sortie,$id_user)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO entre (code_entre,date_entre,id_type_entre,lot_entre,code_sortie,id_user) 
						VALUES (?,?,?,?,?,?)
						");
			$stmt->execute(array($code_entre,$date_entre,$id_type_entre,$lot_entre,$code_sortie,$id_user));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


	function entrer($id_entre,$id_article,$quantite_entree,$cout_achat,$date_exp,$id_emplacement)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO entrer (id_entre,id_article,quantite_entree,cout_achat,date_exp,id_emplacement) 
						VALUES (?,?,?,?,?,?)
						");
			$stmt->execute(array($id_entre,$id_article,$quantite_entree,$cout_achat,$date_exp,$id_emplacement));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

function Ajout_sortie($code_sortie,$date,$id_type_sortie,$id_depot,$id_client,$id_agent,$id_user,$code_facture)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO sortie (code_sortie,date_sortie,id_type_sortie,id_depot,id_client,id_agent,id_user,code_facture) 
						VALUES (?,?,?,?,?,?,?,?)
						");
			$stmt->execute(array($code_sortie,$date,$id_type_sortie,$id_depot,$id_client,$id_agent,$id_user,$code_facture));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

	function MaxID($id,$table)
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

	function Ajout_sortir_article($id_sortie,$id_article,$quantite,$prix)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO sortir (id_sortie,id_article,quantite_sortie,prix_unitaire) 
						VALUES (?,?,?,?)
						");
			$stmt->execute(array($id_sortie,$id_article,$quantite,$prix));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


		function Ajout_agent($nom_agent,$tel_agent,$id_fonction)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO agent (nom_agent,tel_agent,id_fonction) 
						VALUES (?,?,?)
						");
			$stmt->execute(array($nom_agent,$tel_agent,$id_fonction));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}


function Ajout_facture($reference,$id_client,$id_type_fact)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO facture (reference_fact,id_client,id_type_fact) 
						VALUES (?,?,?)
						");
			$stmt->execute(array($reference,$id_client,$id_type_fact));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

function Ajout_carte($num_carte,$id_client)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO carte (num_carte,id_client) 
						VALUES (?,?)
						");
			$stmt->execute(array($num_carte,$id_client));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

function Ajout_abonnement($date,$montant,$remise,$code,$num_carte)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO saboner (date_abonement,montant_abonement,remise,code_abonement,num_carte) 
						VALUES (?,?,?,?,?)
						");
			$stmt->execute(array($date,$montant,$remise,$code,$num_carte));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

function Ajout_payer($mois,$annee,$date,$montant,$num_compte,$reference)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO payer (mois_fact,annee_fact,date_payer,montant_fact,num_compte,reference_fact) 
						VALUES (?,?,?,?,?,?)
						");
			$stmt->execute(array($mois,$annee,$date,$montant,$num_compte,$reference));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}
	
	function Ajout_credit($date,$heur,$montant,$type,$id)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO credit (date_credit,heure_credit,montant_credit,type_credit,id) 
						VALUES (?,?,?,?,?)
						");
			$stmt->execute(array($date,$heur,$montant,$type,$id));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

function Ajout_client_chapchap($nom,$tel)
	{
		
		
		try
		{
		
			$pdo = $GLOBALS['connexion'];
			$pdo->beginTransaction();
			$stmt = $pdo->prepare("INSERT INTO client_chap_chap (nom,tel_client) 
						VALUES (?,?)
						");
			$stmt->execute(array($nom,$tel));
			
			$pdo->commit();
			return true;

		}catch(Exception $e)
		{
			return false;
			
		}
	}

function type()
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from type 
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
function tarif()
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from tarif 
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function tarif_prix($id_tarif)
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from tarif  where id_tarif=$id_tarif
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function facture_non_payer()
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from facture F,client C,payer P,type_facture T where F.id_client=C.id_client and F.reference_fact=P.reference_fact and P.code_payer='0' and F.id_type_fact=2 and F.id_type_fact=T.id_type_fact order by P.montant_fact Desc
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

function facture_non_ref_payer($ref)
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from facture F,client C,payer P,type_facture T where P.reference_fact LIKE '$ref%' and F.id_client=C.id_client and F.reference_fact=P.reference_fact and P.code_payer='0' and F.id_type_fact=2 and F.id_type_fact=T.id_type_fact order by P.montant_fact Desc
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


function situationAB($dateD,$dateF)
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT * from client C,carte CA,saboner B where C.id_client=CA.id_client and CA.num_carte=B.num_carte and B.date_abonement>='$dateD' and B.date_abonement<='$dateF'
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

function facture_non_payer_SEEN()
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from facture F,client C,payer P,type_facture T where F.id_client=C.id_client and F.reference_fact=P.reference_fact and P.code_payer='0' and F.id_type_fact=1 and F.id_type_fact=T.id_type_fact order by P.montant_fact Desc
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

function facture_non_payer_ref_SEEN($ref)
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from facture F,client C,payer P,type_facture T where P.reference_fact LIKE '$ref%' and F.id_client=C.id_client and F.reference_fact=P.reference_fact and P.code_payer='0' and F.id_type_fact=1 and F.id_type_fact=T.id_type_fact order by P.montant_fact Desc
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
	function facture_payer()
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from facture F,client C,payer P,type_facture T where  F.id_client=C.id_client and F.reference_fact=P.reference_fact and P.code_payer!='0' and T.id_type_fact=F.id_type_fact and F.id_type_fact=2 order by P.montant_fact Desc 
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

function facture_payer_SEEN()
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from facture F,client C,payer P,type_facture T where F.id_client=C.id_client and F.reference_fact=P.reference_fact and P.code_payer!='0' and T.id_type_fact=F.id_type_fact and F.id_type_fact=1 order by P.montant_fact Desc
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

/*
function etat_facture_payer($dateD,$dateF)
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from facture F,client C,payer P,type_facture T where P.date_payer>=$dateD and P.date_payer<=$dateF and F.id_client=C.id_client and F.reference_fact=P.reference_fact and P.code_payer!='0' and T.id_type_fact=F.id_type_fact and F.id_type_fact=2 order by P.montant_fact Desc 
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
*/
/*function etat_facture_payer_SEEN($dateD,$dateF)
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from facture F,client C,payer P,type_facture T where  P.date_payer>=$dateD and P.date_payer<=$dateF and F.id_client=C.id_client and F.reference_fact=P.reference_fact and P.code_payer!='0' and T.id_type_fact=F.id_type_fact and F.id_type_fact=1 order by P.montant_fact Desc
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
*/



function article()
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from article 
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


function liste_credit()
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT sum(D.montant_credit) as montant,C.nom,C.tel_client,D.type_credit,D.id_credit,C.id
				from client_chap_chap C,credit D where C.id=D.id group by D.id,D.type_credit
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
function liste_credit_client($type_credit,$id)
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT  sum(D.montant_credit) as montant,C.nom,C.tel_client,D.type_credit,D.id_credit,C.id
				from client_chap_chap C,credit D where C.id=$id and D.type_credit='$type_credit' and C.id=D.id
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

function consomable()
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from consomable
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}
 function charger_image($cond)
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT *
				from article A, tva T where $cond
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	 
////////////////////////////////////////////////////////////////////////////////////


function liste_type_article()
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT * 
				from type_article 
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}


function liste_table($table)
	{
		
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("
				SELECT * 
				from $table 
			    ");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

	function SelectCompte($colonne,$table)
	{
		try
		{
		    $pdo = $GLOBALS['connexion'];
			$rep = $pdo->query("SELECT max($colonne) as count from $table");
			return $rep;
		}catch(Exception $e)
		{
			
			return $e;
			
		}
	}

}
?>