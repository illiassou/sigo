<?php

class Controller
{

// la fonction qui gere toutes les actions Insert-Update-Delete
public function ShowCode()
{

   if(isset($_POST['btn_modif_sortie']))
   {
      $id_sortie  = $_POST['id_sortie_outil'];
      $id_agent   = $_POST['id_agent'];
      $date_sortie = $_POST['date_sortie'];
      $date_retour = $_POST['date_retour'];
      $mission = $_POST['mission'];

      $modif = modif_sortie($date_sortie,$date_retour,$mission,$id_agent,$id_sortie);
      if($modif == true)
      {
         header('location:historique-sortie?msg=1');
      }else
      {
         header('location:historique-sortie?msg=0');
      }

   }

   if(isset($_GET['param_o']) and isset($_GET['param_s']))
   {
      $id_outil = $_GET['param_o'];
      $id_sortie = $_GET['param_s'];

      $supp = detele_info($table='sortir',$con='id_sortie_outil='.$id_sortie.' and id_outil='.$id_outil);

      if($supp == true)
      {
         $modif = modif_info($table=' outil',$col=' id_statut=1',$con=' id_outil='.$id_outil);
         if($modif == true)
         {
            header('location:historique-sortie?msg=1');
         }else
         {
            header('location:historique-sortie?msg=0');
         }
      }else
      {
         header('location:historique-sortie?msg=0');
      }


   }

   // Enregistrement d'une nouvelle sortie
   if(isset($_POST['enregistre_sortie']))
   {


   $folderPath = "img/";
   $image_parts = explode(";base64,", $_POST['signature']);
   $image_type_aux = explode("image/", $image_parts[0]);

   $image_type = $image_type_aux[1];

   $image_base64 = base64_decode($image_parts[1]);
   $signature = uniqid() . '.' . $image_type;

   $file = $folderPath.$signature;

   $date_sortie = $_POST['date_sortie'];
   $date_retoure = $_POST['date_retoure'];
   $mission = $_POST['mission'];

      // on verifie si l'id de l'agnet a ete envoi dans le formulaire
      // NB si l'id de l'agent a ete envoi ça veut dire que l'agent est deja enregistrer
      // si non on enregistre l'agent et on recupere son id avec la fonction select_maxID

      if(isset($_POST['id_agent']))
      {
         $id_agent = $_POST['id_agent'];
      }else
      {
         $matricule = $_POST['matricule_agent'];
         $nom_agent = $_POST['nom_agent'];
         $prenom_agent = $_POST['prenom_agent'];
         $poste_agent = $_POST['poste_agent'];
         $id_serv = $_POST['id_serv'];

         $add_agent = add_agent($matricule,$nom_agent,$prenom_agent,$poste_agent,$id_serv);
         if($add_agent == true)
         {
            $maxID = select_MaxID($id='id_agent',$table='agent');
            $reponse = $maxID->fetch();
            $id_agent = $reponse['max(id_agent)'];
         }
      }

      // on crée la sortie outil 
      $add_sortie = add_sortie($date_sortie,$date_retoure,$mission,$signature,$id_agent);

      file_put_contents($file, $image_base64);
      // Si l'opération = success, on recupere l'id de la sortie
      if($add_sortie == true)
      {
         $maxID = select_MaxID($id='id_sortie_outil',$table='sortie');
         $reponse = $maxID->fetch();
         $id_sortie = $reponse['max(id_sortie_outil)'];

         /*on enregistre les differents outils concernés stocker dans un tableau SESSION
         avec la boucle foreach on parcours le tableau et à chaque ligne du tableau 
         on enregistre l'outil correspond, on modifier le statut et on verifie s'il a des sous composant
         si oui on enregistre les sous composant.*/

         $liste_outils = $_SESSION['outil'];
         foreach($liste_outils as $key => $v):

            $add_sortie_outil = add_sortie_outie($id_sortie,$v['id_outil'],$v['id_etat']);
            if($add_sortie_outil == true)
            {

               $modif = modif_info($table1='outil',$col1='id_statut = 2',$con='id_outil='.$v['id_outil']);

               $liste_compsant = select($table='composant_outil',$con='id_outil='.$v['id_outil']);

               if($liste_compsant->rowCount()>0)
               {
                  while($donne = $liste_compsant->fetch())
                  {

                    $add_sortie_comp = add_sortie_comp($id_sortie,$donne['id_comp_outil'],$donne['id_etat'],$v['id_outil']);
                    if($add_sortie_comp == true)
                    {
                        $error = 0;
                    }else
                    {
                        $error = 1;
                    }

                  }
               }
            }else
            {
               $error =  1;
            }


         endforeach;
         

         if($add_sortie_outil == true and $error!=1)
         {
            unset($_SESSION['outil']);
            header('location:sortie-outil?msg=1');
         }else
         {
            header('location:sortie-outil?msg=0');
         }

      }else
      {
         header('location:sortie-outil?msg=0');
      }

   }

//Fin enregsitrement d'une nouvelle sortie


   if(isset($_POST['btn_modif_un_outil']))
   {
      $id_outil = $_POST['id_outil'];
      $id_desig = $_POST['id_desig'];
      $image_init = $_POST['image_init'];
      $new_image = $_FILES['file']['name'];

      $id_etat = $_POST['id_etat'];
      $id_etat_init =$_POST['id_etat_init'];

      $id_statut = $_POST['id_statut'];
      $id_categorie = $_POST['id_categorie'];
      $id_emplacement = $_POST['id_emplacement'];
      $id_position = $_POST['id_position'];
      $com_modif = $_POST['com_modif'];
      $date_modif = date('Y-m-d H:i:s');

      $target="img/".basename($_FILES['file']['name']);
      if(empty($new_image))
      {
         $image = $image_init;
      }else
      {
         $image = $new_image;
      }

      if(isset($_SESSION['user']) and !empty($_SESSION['id_user']))
      {
         $id_user = $_SESSION['id_user'];
      }else
      {
         $id_user = 0;
      }


      $modif_un_outil = modif_un_outil($date_modif,$com_modif,$image,$id_statut,$id_etat,$id_emplacement,
      $id_categorie,$id_position,$id_user,$id_outil);

      $historique = add_historique($date_modif,$id_etat_init,$id_etat,$com_modif,$id_outil,$id_user);

      if($modif_un_outil == true and $historique == true)
      {
         if(!empty($new_image))
         {
            move_uploaded_file($_FILES['file']['tmp_name'],$target);
            header('location:'.$_POST['page'].'?param='.$id_desig.'&msg=1');
         }else
         {
            header('location:'.$_POST['page'].'?param='.$id_desig.'&msg=1');
         }
      }else
      {
         header('location:'.$_POST['page'].'?param='.$id_desig.'&msg=0');
      }

   }


   if(isset($_POST['btn_modif_outil']))
   {
      $id_desig = $_POST['id_desig'];
      $ref_desig = $_POST['ref_desig'];
      $lib_desig = $_POST['lib_desig'];
      $nombre = $_POST['nbre'];

      $new_image = $_FILES['file']['name'];
      $image_init = $_POST['image_init'];
      $target="img/".basename($_FILES['file']['name']);
      if(empty($new_image))
      {
         $image = $image_init;
      }else
      {
         $image = $new_image;
      }

      $id_categorie = $_POST['id_categorie'];
      $id_emplacement = $_POST['id_emplacement'];
      $id_position = $_POST['id_position'];
      $id_emplacement = $_POST['id_emplacement'];

      if(isset($_SESSION['user']) and !empty($_SESSION['id_user']))
      {
         $id_user = $_SESSION['id_user'];
      }else
      {
         $id_user = 0;
      }

      $update_outil = modif_designation($ref_desig,$lib_desig,$id_desig);
      if($update_outil == true)
      {
         $liste_outil = select_outil($id_desig);
         $i = 0;
         while($donne = $liste_outil->fetch())
         {
            $i= $i + 1;
            $id_outil = $donne['id_outil'];
            $ref_outil = $ref_desig.'/'.$i;
            $modif_info = modif_outil_info_general($ref_outil,$image,$id_emplacement,$id_categorie,$id_position,$id_user,$id_outil);

            if($modif_info == true and $id_categorie == 2)
            {
               $liste_composant = select($table='composant_outil',$con='id_outil='.$id_outil);
               $j = 0;
               while($don = $liste_composant->fetch())
               {  
                  $j= $j + 1;
                  $ref_comp_outil = $ref_outil.'/'.$j;
                  $id_comp_outil = $don['id_comp_outil'];
                  $modif_ref_comp = modif_ref_composant($ref_comp_outil,$id_comp_outil);
                  if($modif_ref_comp == true)
                  {
                     $erreur = 1;
                  }else
                  {
                     $erreur = 2;
                  }

               }

            }else
            {
               $erreur = 2;
            }

            if($modif_info == true)
            {
               $erreur = 1;
            }else
            {
               $erreur = 2;
            }
         }

         if($erreur != 2)
         {
            if($new_image!='')
            {
               move_uploaded_file($_FILES['file']['tmp_name'],$target);
               header('location:Repertoire?msg=1');
            }else
            {
               header('location:Repertoire?msg=1');
            }
            
         }else
         {
            header('location:Repertoire?msg=0');
         }
      }else
      {
         header('location:Repertoire?msg=0');
      }

   }


   if(isset($_POST["enregistre_outil"]))
   {

      $id_desig = $_POST["id_desig"];
      $date_enreg = date("Y-m-d H:i:s");
      $id_statut = $_POST["id_statut"];
      $id_etat = $_POST["id_etat"];
      $ref_desig = $_POST["ref_desig"];
      $id_emplacement = $_POST["id_emplacement"];
      $id_categorie = $_POST["id_categorie"];
      $id_position = $_POST["id_position"];
      $nombre = $_POST["nombre"];
      $target="img/".basename($_FILES['file']['name']);
      $image_outil=$_FILES['file']['name'];
      if(isset($_POST['open']) and !empty($_POST['open']))
      {
         $open = $_POST['open'];
      }else
      {
         $open = 'off';
      }
      
      // on compte le nombre d'outil de même type deja enregistrer

      $nbre = select_count($col='id_outil',$table='outil',$con='id_desig='.$id_desig);
      var_dump($id_desig);
      if($nbre -> rowCount()> 0)
      {
         $rep = $nbre->fetch();
         $nbre_outil = $rep['nbre']+1;
      }else
      {
         $nbre_outil = 1;
      }
      

     
      for($i= 0;$i<$nombre;$i++)
      {
         $ref_outil = $ref_desig.'/'.$nbre_outil+$i;
         $add_outil = add_outil($ref_outil,$date_enreg,$image_outil,$id_statut,$id_etat,
         $id_desig,$id_emplacement,$id_categorie,$id_position);

         if($add_outil == true)
         {
            $max_id = select_MaxID($id= 'id_outil',$table= 'outil');
            $rep = $max_id->fetch();
            $id = $rep['max(id_outil)'];
           
            if($open == 'on' and isset($_SESSION['composant']) and !empty($_SESSION['composant']))
            {
               $composant = $_SESSION['composant'];
               $j = 0;
               foreach($composant as $Com=>$com):
                  $j = $j+1;
                  $id_desig_comp = $com['id_desig'];
                  $id_etat_comp = $com['id_etat'];
                  $ref_comp = $ref_outil.'/'.$j;
                  $add_comp = add_composant($ref_comp,$date_enreg,$id_etat_comp,
                  $id_desig_comp,$id);
                  
               endforeach;
            }else
            {}
         }else
         {
            $erreur = 1;
         }
         

      }

      if($add_outil == true and $erreur != 1)
      {
         move_uploaded_file($_FILES['file']['tmp_name'],$target);
         unset($_SESSION['composant']);
         header('location:Nouveau-outil?msg=1');
      }else
      {
         header('location:Nouveau-outil?msg=0');
      }

   
   }

}



 public function ShowAccueil()
 {
    
   $donnees='Accueil';

    $myView = new View('Accueil');
    $myView->render($donnees);
 }

  public function ShowSO()
 {
    
    $myView = new View('suivi');
    $myView->render(array());
 }

 public function ShowSortieOutil()
 {
    $myView = new View('nouvelle-sortie');
    $myView->render(array());
 }

 public function ShowOH()
 {
    
    $myView = new View('outil-hs');
    $myView->render(array());
 }

 public function ShowDO()
 {
    
    $myView = new View('detail-outil');
    $myView->render(array());
 }

 public function ShowListeSortieAgent()
 {
    
    $myView = new View('liste-sortie-agent');
    $myView->render(array());
 }

 public function ShowNouvelleSortieStock()
 {
    
    $myView = new View('nouvelle-sortie-stock');
    $myView->render(array());
 }

 public function ShowRAgent()
 {
    
    $myView = new View('recherche-agent');
    $myView->render_Gabari(array());
 }


  public function ShowRechercheOutil()
 {
    
    $myView = new View('recherche-outil');
    $myView->render_Gabari(array());
 }

 public function ShowAddOS()
 {
    
    $myView = new View('add-outil-sortie');
    $myView->render_Gabari(array());
 }

 
 public function ShowRO()
 {
    
    $myView = new View('retour-outil');
    $myView->render(array());
 }

 

 public function ShowROR()
 {
    

    $myView = new View('recherche-outil-retour');
    $myView->render_Gabari(array());
 }

 public function ShowART()
 {
    

    $myView = new View('add-retour');
    $myView->render_Gabari(array());
 }


 public function ShowListeEntree()
 {
    
   $donnees='';

    $myView = new View('liste-entree');
    $myView->render(array());
 }

 public function ShowRapportFacture()
 {
    
   $donnees='';

    $myView = new View('rapport-facture');
    $myView->render(array());
 }

  public function ShowRapportStock()
 {
    
   $donnees='';

    $myView = new View('rapport-stock');
    $myView->render(array());
 }

public function ShowListeFacture()
 {
    
    $myView = new View('liste-facture');
    $myView->render(array());
 }

 public function ShowListeFactureAnnuller()
 {
    
    $myView = new View('liste-facture-annulle');
    $myView->render(array());
 }


 public function ShowListeAgent()
 {
    
    $myView = new View('liste-agent');
    $myView->render(array());
 }


 public function ShowNouveauAgent()
 {
    
    $myView = new View('Nouveau-agent');
    $myView->render(array());
 }


 public function ShowsituationStock()
 {
    
    $myView = new View('liste-stock');
    $myView->render(array());
 }

 /*public function ShowLogin()
 {
  if(isset($_POST['user_name'])){

  $username = $_POST['user_name'];
  $password = $_POST['password'];
  //$manager = new Manager();
  $reponse = login($username);
  $count=$reponse->rowCount();
  
   $donnees='';
 
   while ($donnes=$reponse->fetch()) 
   {

  $id_user=$donnes['id_user'];
  $id_ = $donnes['id_user'];
  $privilege=$donnes['lib_privilege'];
  $pass=$donnes['password'];
  $nom_prenom = $donnes['nom_prenom'];
  $valide = $donnes['valide_compte'];
  # code...
   }



   if($count>0)
   {

    if(password_verify($password,$pass))
    {
     if($valide == 1)
    {
      $msg = 0;
      $myView = new View('login-page');
      $myView->render_page(array('msg' => $msg));
    }else{

    if($privilege=='Vendeur')
    {

    $_SESSION['user']=$privilege;
    $_SESSION['username']=$username;
    $_SESSION['password']=$password;
    $_SESSION['privilege']=$privilege;
    $_SESSION['nom_prenom']=$nom_prenom;
    $_SESSION['id_user']=$id_user;
     header('location:menu-vendeur.html');

    }else
    {
    $_SESSION['user']=$privilege;
    $_SESSION['username']=$username;
    $_SESSION['password']=$password;
    $_SESSION['privilege']=$privilege;
    $_SESSION['nom_prenom']=$nom_prenom;
    $_SESSION['id_user']=$id_user;
     header('location:menu.html');
    }
    
    }
     

    }else
    {
       if($pass=='G_stock@2023*$!!'){

      if($valide == 1)
      {
     
      $msg = 0;
      $myView = new View('login-page');
      $myView->render_page(array('msg' => $msg));

    }else{
      //$myView = new View('confirme');
      //$myView->render_page_c(array('msg' => $msg));
      header('location:confirmation.php?id_user='.$id_user);
    }
  }else{
    
      $msg = 0;
      $myView = new View('login-page');
      $myView->render_page(array('msg' => $msg));
        
      
    }

   }
  }else
  {
    $msg = 0;
    $myView = new View('login-page');
    $myView->render_page(array('msg' => $msg));

  }
    
   //$myView = new View('login');
    //$myView->render($donnees);
 }
}
*/

 public function ShowLoginPage()
 {
  
    $myView = new View('login-page');
    $myView->render_Page(array());
 }

  public function ShowStatProduit()
 {
  
    $myView = new View('stat-produits');
    $myView->render(array());
 }

   public function ShowStatClient()
 {
  
    $myView = new View('stat-client');
    $myView->render(array());
 }

   public function ShowStatDepot()
 {
  
    $myView = new View('stat-depot');
    $myView->render(array());
 }

    public function ShowListeDepense()
 {
  
    $myView = new View('liste-depense');
    $myView->render(array());
 }

 public function ShowHSO()
 {
  
    $myView = new View('historique-sortie-outil');
    $myView->render(array());
 }

    public function ShowMeFacture()
 {
  
    $myView = new View('liste-facture');
    $myView->render_v(array());
 }

  public function ShowFiltreS()
 {
  $myView = new View('filtre-suivi');
  $myView->render_Gabari(array());

 }
public function ShowRepertoire()
{
  
    $myView = new View('repertoire-outil');
    $myView->render(array());
}

  public function ShowConfirmation()
 {
  
   
    $myView = new View('confirme');
    $myView->render_Page_c(array());
 }

 public function ShowMenu()
 {
  $donnees='';
 
  $myView = new View('tableau-bord');
  $myView->render(array());

 }


 public function ShowMenuVendeur()
 {
  $donnees='';
 
  $myView = new View('nouvelle-facture');
  $myView->render_v(array('donnees' => $donnees));

 }


 public function ShowListeUtilisateur()
 {
  
 
  $myView = new View('liste-utilisateur');
  $myView->render(array());

 }


 public function ShowNouveauOutil()
 {
  
 
  $myView = new View('ajout-outil');
  $myView->render(array());

 }


  public function ShowListecredit()
 {
  
  $myView = new View('liste-credit');
  $myView->render(array());

 }


  public function ShowNouveauCredit()
 {
  
  $myView = new View('nouveau-credit');
  $myView->render(array());

 }


  public function ShowListeFonction()
 {
  
  $myView = new View('liste-fonction');
  $myView->render(array());

 }


  public function ShowNouveauDepot()
 {
  
  $myView = new View('nouveau-depot-vente');
  $myView->render(array());

 }
 
  public function ShowAN()
 {
  
  $myView = new View('add-info');
  $myView->render_Gabari(array());

 }

 public function ShowCR()
 {
  
  $myView = new View('charger-reference');
  $myView->render_Gabari(array());

 }

 public function ShowAN2()
 {
  
  $myView = new View('add-info-2');
  $myView->render_Gabari(array());

 }

 public function ShowAE()
 {
  
  $myView = new View('add-emplacement');
  $myView->render_Gabari(array());

 }

 public function ShowAC()
 {
  
  $myView = new View('composant-add');
  $myView->render_Gabari(array());

 }

 public function ShowAI()
 {
  
  $myView = new View('add-identification');
  $myView->render_Gabari(array());

 }

 public function ShowAP()
 {
  
  $myView = new View('add-position');
  $myView->render_Gabari(array());

 }
 
 public function ShowCP()
 {
  
  $myView = new View('charger-position');
  $myView->render_Gabari(array());

 }
 // Fournisseur //


// Fournisseur
 public function ShowListeFournisseur()
 {
  
 
  $myView = new View('liste-fournisseur');
  $myView->render(array());

 }

  public function ShowNouveauFournisseur()
 {
  
 
  $myView = new View('nouveau-fournisseur');
  $myView->render(array());

 }
 // Client


 public function ShowListeClient()
 {
 
  $myView = new View('liste-client');
  $myView->render(array());

 }

  public function ShowNouveauClient()
 {
 
  $myView = new View('nouveau-client');
  $myView->render(array());

 }
 // Article

 /*public function ShowListeArticle()
 {
  
  $manager = new Manager();
  $id = "id_article";
  $table = "article";
  $maxid = $manager->MaxID($id,$table);
  while($art = $maxid->fetch())
  {
    $article = new Article();
    $article->setId_article($art['max(id_article)']);
    $articles[] = $article;
  }
 
  $donne = $articles;
  $article = $manager->ListeArticle();
  $Liste_tva = $manager->ListeTva();
  $Tva = $Liste_tva;
  $donnees = $article;
  $myView = new View('liste-article');
  $myView->render(array('donnees' => $donnees, 'donne'  => $donne ,'Tva' => $Tva ));

 }
*/
 // Approvisionnement

 public function ShowNouvelleEntree()
 {
 
  $donnes = '';
  $myView = new View('nouvelle-entree');
  $myView->render(array());

 }


  public function ShowDetailDepot()
 {
 

  $myView = new View('detail-depot');
  $myView->render(array());

 }



  public function ShowRapportEntre()
 {
 

  $myView = new View('rapport-entre');
  $myView->render(array());

 }

  public function ShowListeStockBoutique()
 {
 

  $myView = new View('liste-stock-boutique');
  $myView->render(array());

 }

   public function ShowAddEntreeBoutique()
 {
 

  $myView = new View('add-entree-boutique');
  $myView->render_Gabari(array());

 }

  public function ShowEntreeBoutique()
 {
 

  $myView = new View('nouvelle-entree-boutique');
  $myView->render(array());

 }

public function ShowRapportCredit()
 {
 

  $myView = new View('rapport-credit');
  $myView->render(array());

 }

 public function ShowSituation()
 {
 

  $myView = new View('situation');
  $myView->render(array());

 }

  public function ShowListeMarque()
 {
 

  $myView = new View('liste-marque');
  $myView->render(array());

 }

public function ShowNouveauProduit()
 {
  
  $myView = new View('nouveau_produit');
  $myView->render(array());

 }

public function ShowNouveauRetourStock()
 {
  
  $myView = new View('nouveau-retour-stock');
  $myView->render(array());

 }

 public function ShowAddRS()
 {
  
  $myView = new View('add-retour-stock');
  $myView->render_Gabari(array());

 }
public function ShowVerifEntre()
 {
  
  $myView = new View('verif-entre');
  $myView->render_Gabari(array());

 }

public function  ShowVerificationEntree()
 {
  
  $myView = new View('verification-entre');
  $myView->render(array());

 }

public function  ShowSituationDepot()
 {
  
  $myView = new View('situation-depot');
  $myView->render(array());

 }

public function   ShowListeAffect()
 {
  
  $myView = new View('liste-affectation');
  $myView->render(array());

 }

public function ShowNouvelleAffect()
 {
  
  $myView = new View('nouvelle-affectation');
  $myView->render(array());

 }

public function  ShowAffectStock()
 {
  
  $myView = new View('affect-stock');
  $myView->render_Gabari(array());

 }


 public function ShowNouvelleFacture()
 {
  
  $myView = new View('nouvelle-facture');
  $myView->render(array());

 }

 public function ShowRechercheFacture()
 {
  
  $myView = new View('recherche-facture');
  $myView->render(array());

 }

  public function ShowNouvelleFactureVendeur()
 {
  
  $myView = new View('nouvelle-facture');
  $myView->render_v(array());

 }

  public function ShowaddFacture()
 {
  
  $myView = new View('add-input');
  $myView->render_Gabari(array());

 }


  public function ShowEntreeClient()
 {
  
  $myView = new View('add-entree');
  $myView->render_Gabari(array());

 }

  public function ShowVerifSortie()
 {
  
  $myView = new View('verif-sortie');
  $myView->render_Gabari(array());

 }


  public function  ShowVerificationSortie()
 {
  
  $myView = new View('verification-bon-sortie');
  $myView->render(array());

 }

 public function  ShowListeBonCom()
 {
  
  $myView = new View('liste-commande');
  $myView->render(array());

 }

public function  ShowNouveauBonCom()
 {
  
  $myView = new View('nouveau-bon-com');
  $myView->render(array());

 }

 public function  ShowDetailCom()
 {
  
  $myView = new View('detail-commande');
  $myView->render(array());

 }

public function ShowAddBonCom ()
 {
  
  $myView = new View('add-bon_com');
  $myView->render_Gabari(array());

 }

public function ShowListeGerant()
 {
  
  $myView = new View('liste-gerant');
  $myView->render(array());

 }

 public function ShowNouveauGerant()
 {
  
  $myView = new View('nouveau-gerant');
  $myView->render(array());

 }

 public function ShowListeProduit()
 {
  
  if(isset($_GET['msg_a']))
  {
    $msg = '';
  }else
  {
    $msg = 1;
  }
  
  $myView = new View('liste-produit');
  $myView->render(array('msg_a' => $msg));

 }
 

}