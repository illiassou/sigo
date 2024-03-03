<?php 
 //$repertoire = repertoire_outil();
    if(isset($_GET["param"]) and !empty($_GET["param"]))
    {
       $id_outil = $_GET["param"];

       $info_outil = select($table='outil O, designation D,statut S, etat E,emplacement EM, position P,identification I',
                            $con="O.id_desig = D.id_desig and S.id_statut=O.id_statut and E.id_etat=O.id_etat and 
                            EM.id_emplacement=O.id_emplacement and P.id_position = O.id_position and I.id_identification =
                            P.id_identification and O.id_outil = $id_outil");

       $donne = $info_outil->fetch();
       
       if(isset($donne["image_outil"]) and $donne["image_outil"]!='')
       {
          $image = $donne['image_outil'];
       }else
       {
          $image = 'image_outil_defaut.jpg';
       }
       
          $ref_outil             = $donne['ref_outil'];
          $lib_desig             = $donne['lib_desig'];
          $lib_etat              = $donne['lib_etat'];
          $lib_statut            = $donne['lib_statut'];
          $lib_emplacement       = $donne['lib_emplacement'];
          $lib_position          = $donne['lib_position'];
          $lib_identification    = $donne['lib_identification'];
          $id_categorie          = $donne['id_categorie'];
          $id_etat               = $donne['id_etat'];
          $id_statut             = $donne['id_statut'];
          $id_emplacement        = $donne['id_emplacement'];
          $id_position           = $donne['id_position'];
          $id_identification     = $donne['id_identification'];
          $id_desig              = $donne['id_desig'];


          $dernier_utilisateur = suivi_last_user($id_outil);
          if($dernier_utilisateur->rowCount()> 0)
          {

              $rep = $dernier_utilisateur->fetch();
              $nom_agent = $rep['nom_agent'];
              $prenom_agent = $rep['prenom_agent'];
              $lib_service = $rep['lib_serv'];

          }else
          {
              
              $nom_agent = "//";
              $prenom_agent = "//";
              $lib_service = "//";

          }
         

          if($donne['id_etat']==1 or $donne['id_etat']==2)
          {
              $bg = 'label-success';

          }elseif( $donne['id_etat']== 3)
          {
              $bg = 'label-warning';

          }else
          {
              $bg = 'label-danger';

          }

          if($donne['id_statut']==1)
          {
              $bg_s = 'label-success';

          }else
          {
              $bg_s = 'label-danger';
          }

       
    }
    
?>

<div class="alert alert-warning mt">
        <div class="col-lg-8">
            <h4 class="text-dark"><a href="menu"><i class="fa fa-home"></i></a> / Detail / <?= $lib_desig?></h4> 
        </div>
        <span class="align-r">
            <a href="Nouveau-outil" class="btn btn-primary btn-xs"><i class="fa fa-plus-circle"></i> Nouveau outil</a>
            <button class="btn btn-success btn-xs" id="exporter"><i class="fa fa-upload"></i> Exporter</button>
            <button class="btn btn-danger btn-xs"><i class="fa  fa-print"></i> Imprimer</button> 
        </span>
</div>

        <!-- page start-->
          <div class="col-sm-3">
            <section class="panel">
              <div class="panel-body">
              <span><h5 class="text-center label <?=$bg_s?>"><?=$lib_statut?></h5>
                    <h5 class="text-center label <?=$bg?>"><?=$lib_etat?></h5>
              </span>
                  
                  <h4 class="alert-p alert-title text-center"><strong><?=$ref_outil?></strong></h4>

                  <img class="img-thumbnail" src="img/<?=$image?>" alt="">

                  <h5 class="view-message alert-p alert-title text-center"><strong><?=$lib_desig?></strong></h5>
                  
                  <h5 class="view-message alert-p alert-title text-center">Emplacement <span class="badge bg-inverse"><?=$lib_emplacement?></span></h5>
                 
                  <h5 class="view-message alert-p alert-title text-center">Position <span class="badge bg-inverse"><?=$lib_identification.' / '.$lib_position?></span></h5>
              
                  <h5 class="view-message alert-p alert-title text-center">Dernier utilisateur <span class="badge bg-inverse"><?=$nom_agent.' '.$prenom_agent?> </span></h5>

                  <h5 class="view-message alert-p alert-title text-center">Service <span class="badge bg-inverse"><?= $lib_service ?> </span></h5>
              </div>
            </section>
           
          </div>


<?php   if($id_categorie == 2){ ?>


          <div class="col-sm-9">
            <section class="panel">
              <div class="panel-body minimal">
                <div class="mail-option">
                <div class="chk-all">
                    <div class="btn-group">
                      <a href="#" class="btn mini all">
                        Liste des composants
                        </a>
                    </div>
                  </div>
                  <ul class="unstyled inbox-pagination">
                    
                  </ul>
                </div>
                <div class="table-inbox-wrap ">
                    
                  <table class="table table-inbox table-hover">
                    <thead>
                        <tr>
                              
                              <th>Reference</th>
                              <th>Désigantion</th>
                              <th>Etat</th>
                              <th> Modifier</th>         
                        </tr>
                    </thead>
                    <tbody>
                   <?php
                            $composant = select_comp($id_outil);
                            $i = 0;
                            while($donnees = $composant->fetch()){ 
                              if($donnees['id_etat']==1 or $donnees['id_etat']==2)
                              {
                                    $bg = 'label-success';
                              }elseif( $donnees['id_etat']== 3)
                              {
                                    $bg = 'label-warning';
                              }else
                              {
                                  $bg = 'label-danger';
                              }

                            $i = $i + 1;
                    ?>
                      <tr <?php if($i % 2 == 0 ){}else{ echo 'class="unread"';}?>>
                      <tr class="bg">
                          <td><?= $donnees['ref_comp_outil']?></td>
                          <td><?= $donnees['lib_desig']?></span></td>
                          <td><span class="label <?= $bg?>"><?= $donnees['lib_etat']?></td>
                          <td><button class="btn btn-primary btn-xs"><i class="fa fa-pencil" title="Modifier les informations"></i></button></td>             
                          <?php include('model-file/model-modif-un-outil.php'); ?>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </section>
          </div>

  <?php }
  
  
          $select_historique = select_historique($id_outil);
          $count = $select_historique->rowCount();
        
          $nombre_par_page = 5;
          $nombre_de_page =ceil($count/$nombre_par_page);

            if(isset($_GET['page']) and $_GET['page']!=0 )
            {
                $page = $_GET['page'];

            }elseif(isset($_SESSION['page']))
            {
                $page = $_SESSION['page'];

            }else
            {
                $page = 1;
            }

        $debut = ($page-1)*$nombre_par_page;
  ?>

          <div class="col-sm-9">
            <section class="panel">
              <div class="panel-body minimal">
                <div class="mail-option">
                <div class="chk-all">
                    <div class="btn-group">
                      <a href="#" class="btn mini all">
                        Historique des entrées sorties
                        </a>
                    </div>
                  </div>
                  <ul class="unstyled inbox-pagination">
                    <li><span><?=$debut+1?>-<?php if($count>= $nombre_par_page+$debut+1){ echo $nombre_par_page+$debut+1;}else{echo $count;}?> Sur <?=$count?></span></li>
                    <li>
                    <?php if($page>1) { ?>
                            <a class="np-btn" href="?param=<?=$id_desig?>&page=<?=$page-1?>"><i class="fa fa-angle-left  pagination-left"></i></a>
                      <?php
                      }else
                      { 
                      ?>
                            <a class="np-btn" disabled><i class="fa fa-angle-left  pagination-left"></i></a>
                      <?php
                      } 
                      ?>
                    </li>
                    <li>
                    <?php
                    if($page<$nombre_de_page)
                    { 
                    ?>
                        <a class="np-btn" href="?param=<?=$id_desig?>&page=<?=$page+1?>"><i class="fa fa-angle-right pagination-right"></i></a>
                    <?php
                    }else
                    {
                    ?>

                        <a class="np-btn" disabled><i class="fa fa-angle-right pagination-right"></i></a>
                    <?php
                    }
                    ?>
                    </li>
                  </ul>
                </div>
                <div class="table-inbox-wrap ">
                  <?php  if($select_historique->rowCount() > 0){ ?> 
                  <table class="table table-inbox table-hover">
                    <thead>
                        <tr>
                              <th></th>
                              <th>Technicien</th>
                              <th>Service</th>
                              <th>Date sortie</th>
                              <th>Etat à la sortie</th>
                              <th>Date retoure</th>
                              <th>Etat au retour</th>
                              <th>Mission</th>
                                      
                        </tr>
                    </thead>
                    <tbody>
                   <?php
                           
                            $i = 0;
                            while($donnees = $select_historique->fetch()){ 

                              $etat_retour = select($table='etat',$con='id_etat='.$donnees['id_etat_retour']);
                              
                              if($etat_retour->rowCount() > 0)
                              {
                                $ER = $etat_retour->fetch();
                                $lib_etat_retour = $ER['lib_etat'];
                              }else
                              {
                                $lib_etat_retour = '//';
                              }
                              

                              if($donnees['id_etat']==1 or $donnees['id_etat']==2)
                              {
                                    $bg = 'label-success';
                              }elseif( $donnees['id_etat']== 3)
                              {
                                    $bg = 'label-warning';
                              }else
                              {
                                  $bg = 'label-danger';
                              }

                              if($donnees['id_statut']==1)
                              {
                                    $bg_s = 'label-success';
                              }else
                              {
                                    $bg_s = 'label-danger';
                              }
                            $i = $i + 1;
                    ?>
                      <tr <?php if($i % 2 == 0 ){}else{ echo 'class="unread"';}?>>
                          <td><?=$i?></td>
                          <td><?= $donnees['nom_agent'].' '.$donnees['prenom_agent']?></td>
                          <td><?= $donnees['lib_serv']?></td>
                          <td><?= date('d-m-Y',strtotime($donnees['date_sortie_outil']))?></span></td>
                          <td><span class="label <?= $bg?>"><?= $donnees['lib_etat']?></td>
                          <td><?= date('d-m-Y',strtotime($donnees['date_retour_outil']))?></span></td>
                          <td><span class="label <?= $bg?>"><?=$lib_etat_retour?></span></td>
                          <td><?= $donnees['mission']?></td>             
            
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                <?php
                    }else{ echo '<h3 class="text-center">Aucun resultat</h3>';}
                ?>
                </div>
              </div>
            </section>
          </div>


  <?php $historique_modification = select($table='historique_modif_outil H,etat E',$con='E.id_etat=H.id_etat_init and H.id_outil='.$id_outil); ?>

          <div class="col-sm-6">
            <section class="panel">
              <div class="panel-body minimal">
                <div class="mail-option">
                <div class="chk-all">
                    <div class="btn-group">
                      <a href="#" class="btn mini all">
                        Dernières modification
                        </a>
                    </div>
                  </div>
                  <ul class="unstyled inbox-pagination">
                   
                  </ul>
                </div>
                <div class="table-inbox-wrap ">
                  <?php  if($historique_modification->rowCount() > 0){ ?> 
                  <table class="table table-inbox table-hover">
                    <thead>
                        <tr>
                              <th></th>
                              <th>Date</th>
                              <th>Etat initial</th>
                              <th>Etat final</th>
                              <th>commentaire</th>
                              
                                      
                        </tr>
                    </thead>
                    <tbody>
                   <?php
                           
                            $i = 0;
                            while($donnees = $historique_modification->fetch()){ 

                              $etat_modif = select($table='etat',$con='id_etat='.$donnees['id_etat_modif']);
                              
                              if($etat_modif->rowCount() > 0)
                              {
                                $EM = $etat_modif->fetch();
                                $lib_etat_modif = $EM['lib_etat'];
                              }else
                              {
                                $lib_etat_modif = '//';
                              }
                              

                              if($donnees['id_etat_init']==1 or $donnees['id_etat_init']==2)
                              {
                                    $bg = 'label-success';
                              }elseif( $donnees['id_etat_init']== 3)
                              {
                                    $bg = 'label-warning';
                              }else
                              {
                                  $bg = 'label-danger';
                              }

                              if($donnees['id_etat_modif']==1 or $donnees['id_etat_modif']==2)
                              {
                                    $bg_s = 'label-success';
                              }elseif( $donnees['id_etat_modif']== 3)
                              {
                                    $bg_s = 'label-warning';
                              }else
                              {
                                  $bg_s = 'label-danger';
                              }

                             
                            $i = $i + 1;
                    ?>
                      <tr <?php if($i % 2 == 0 ){}else{ echo 'class="unread"';}?>>
                          <td><?=$i?></td>
                          <td><?= date('d-m-Y',strtotime($donnees['date_modif']))?></td>
                          <td><span class="label <?= $bg?>"><?= $donnees['lib_etat']?></td>
                          <td><span class="label <?= $bg_s?>"><?=$lib_etat_modif?></span></td>
                          <td><?= $donnees['com_modif']?></td>             
            
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                <?php
                    }else{ echo '<h3 class="text-center">Aucun resultat</h3>';}
                ?>
                </div>
              </div>
            </section>
          </div>



<?php 
          $frequence = select_count($col='SR.id_outil',$table='sortir SR,sortie S,outil O',$con='SR.id_sortie_outil=S.id_sortie_outil 
                                    and O.id_outil=SR.id_outil and SR.id_outil='.$id_outil.' group by S.date_sortie_outil'); 
                                    
          $i=0;
          $data ='';
          while($donne = $frequence->fetch())
          {
            $i+=1;
            if($i <= $frequence->rowCount()-1)
            {
              $data = $data.''.$donne['nbre'].',';
            }else
            {
              $data = $data.''.$donne['nbre'];
            }
            
          }
?>
                              
          <div class="col-sm-3">
                <!-- REVENUE PANEL -->
                <div class="grey-panel pn">
                  <div class="grey-header">
                    <h5>Freguence d'utilisation</h5>
                  </div>
                  <div class="chart mt">
                    <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[<?=$data?>]"></div>
                  </div>
                  <p class="mt"><br/>Mensuel</p>
                </div>
              </div>
             


        
               
                 
             
             