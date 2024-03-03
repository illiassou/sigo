<?php
if (isset($_POST['agent_id']) and !empty($_POST['agent_id']))
{
        $filtre1 = " and S.id_agent=".$_POST['agent_id'];
}else
{
    $filtre1 = '';
}

if(isset($_POST['serv_id']) and !empty($_POST['serv_id']))
{
    $filtre2 = ' and A.id_serv='.$_POST['serv_id'];
}else
{
    $filtre2 = "";
}

if(isset($_POST["date"]) and !empty($_POST['date'] ))
{
    $filtre3 = ' and S.date_sortie_outil="'.$_POST['date'].'"';
}else
{
    $filtre3 = '';
}

$filtre = $filtre1.''.$filtre2.''.$filtre3;

?>
<div class="alert alert-warning mt">
        <div class="col-lg-8">
            <h4 class="text-dark"><a href="menu"><i class="fa fa-home"></i></a> / Entrées Sorties outils</h4> 
        </div>
            <span class="align-r">
                    <a href="sortie-outil" class="btn btn-primary btn-xs"><i class="fa fa-plus-circle"></i> Nouvelle sortie</a>
                    <button class="btn btn-success btn-xs" id="exporter_sortie"><i class="fa fa-upload"></i> Exporter</button>
                    <button class="btn btn-danger btn-xs"><i class="fa  fa-print"></i> Imprimer</button> 
            </span>
        
        </div>
        <div class="col-lg-12">
            <div class="content-panel px-2">

            <form method="post" action="historique-sortie">
            <div class="alert alert-warning py-3">
               
              <div class="form-group">
              <div class="col-lg-2">   
              <h4 class="text-left"><i class="fa  fa-sort-alpha-asc"></i><strong>   Filtrer</strong></h4>
                </div>
                <div class="col-lg-3">
                    <select class="form-control" name="serv_id" id="serv_id" >
                        <option value="" selected="selected">--Par Service--</option>
                        <?php   $liste_statut = liste_service();
                            while($donnne = $liste_statut->fetch())
                            {
                            ?>
                                <option value="<?=$donnne['id_serv']?>"><?=$donnne['lib_serv']?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="col-lg-3">
                    <select class="form-control selectpicker"  data-live-search="true" name="agent_id" id="agent_id">
                        <option value="" selected="selected">--Par utilisation--</option>
                        <?php   $liste_agent = liste_agent();
                            while($donnne = $liste_agent->fetch())
                            {
                            ?>
                            <option value="<?=$donnne['id_agent']?>" ><?=$donnne['nom_agent'].' '.$donnne['prenom_agent']?></option>
                            <?php
                            }
                            ?>
                    </select>
                </div>

                <div class="col-lg-2">
                    <input class="form-control" type="date" name="date" >
                </div>
                <div class="col-lg-2">
                   
                    <button class="btn btn-primary btn-sm"><i class="fa fa-check" title="Filtrer"></i></button>
                    <span><a href="historique-sortie" class="btn btn-primary btn-sm" title="Actualiser"><i class="fa fa-refresh"></i></a></span>
                </div>

                </div>
                
              </div>
              </form>
             
              <section id="unseen">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped " id="hidden-table-info">
                  <thead>
                    <tr>
                      <th>Date sortie</th>
                      <th>Technicien</th>
                      <th>Service</th>
                      <th>Statut</th>
                      <th>Outils</th>
                      <th>Mission</th>
                      <th>Signature S</th>
                      <th>date retour</th>
                      <th>Signature R</th>
                      <th>Act</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    // on appel la fonction qui reccupere les informations des outil
                        $repertoire = historique_sortie($filtre);
                        while($donnees = $repertoire->fetch())
                        {
                            $liste_outil_sortie = liste_outil_sortie($donnees['id_sortie_outil'],$limit='');
                            if($donnees['date_retour_outil']<date('Y-m-d') and $donnees['statut_sortie']==0)
                            {
                                $style = 'style="background-color:orangered; color:white;"';
                            }else
                            {
                                $style = "";
                            }

                            if($donnees['statut_sortie']==0)
                            {
                               $statut='<span class="badge bg-danger">Sortie</span>';
                            }else
                            {
                               $statut =' <span class="badge bg-success">Retour</span>';
                            }
                    ?>
                   
                    <tr>
                        <td><?=date('d-m-Y', strtotime($donnees['date_sortie_outil'])) ?></td>
                        <td><?=$donnees['nom_agent'].' '.$donnees['prenom_agent'] ?></td>
                        <td>
                            <?php 
                                if($donnees['id_atelier']!=0){echo $donnees['lib_serv'].' / '.$donnees['lib_atelier'];}
                                  else{ echo $donnees['lib_serv'];} 
                            ?>
                        </td>
                        <td><?=$statut?></td>
                        <td>
                        <?php 
                    
                         while($donne = $liste_outil_sortie->fetch())
                         {
                        ?>
                            <span class="badge bg-theme"><?=$donne['lib_desig']?></span>
                          
                        <?php
                          
                         }
                         ?>
                          <span class="badge bg-theme" data-toggle="modal" title="Voir tout les outils" data-target="#model-detail-outil<?=$donnees['id_sortie_outil']?>">...</span>
                      
                        </td>
                        <td><?=$donnees['mission'] ?></td>
                        <td><img src="<?=HOST?>img/<?=$donnees['signature_sortie']?>" alt="" style="width: 80px;"></td>

                        <td <?=$style?>><?=date('d-m-Y', strtotime($donnees['date_retour_outil'])) ?></td>
                        <td>
                        <?php if($donnees['signature_retour']!=0)
                        {
                            echo '<img src="<?=HOST?>img/<?=$donnees["signature_retour"]?>" alt="" style="width: 80px;">';
                        }else
                        {
                            echo '//';
                        }    
                        ?>
                        </td>
                        
                        <td>
                            <button class="btn btn-primary btn-xs" title="Modifier la sortie" data-toggle="modal" data-target="#model-modif-sortie<?=$donnees['id_sortie_outil']?>"><i class="fa fa-pencil"></i></button>
                        </td>
                        <!-- On charge le model pour modifier un outil -->
                            <?php include('model-file/model-modif-sortie.php'); 
                             include('model-file/model-detail-sortie-outil.php');
                            ?>
                           
                           
                        <!--**********************************************************-->
                    </tr>
                    <?php
                        }
                    ?>
                  </tbody>
                </table>
              </section>
                </div>
             
            </div>
            <!-- /content-panel -->
        </div>      
 
