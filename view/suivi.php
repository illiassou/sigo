<?php
if (isset($_POST['etat_id']) and !empty($_POST['etat_id']))
{
        $filtre1 = " and O.id_etat=".$_POST['etat_id'];
}else
{
    $filtre1 = '';
}

if(isset($_POST['statut_id']) and !empty($_POST['statut_id']))
{
    $filtre2 = ' and O.id_statut='.$_POST['statut_id'];
}else
{
    $filtre2 = "";
}

if(isset($_POST["empl_id"]) and !empty($_POST['empl_id'] ))
{
    $filtre3 = ' and O.id_emplacement='.$_POST['empl_id'];
}else
{
    $filtre3 = '';
}

$filtre = $filtre1.''.$filtre2.''.$filtre3;

?>
   <div class="alert alert-warning mt">
        <div class="col-lg-8">
            <h4 class="text-dark"><a href="menu"><i class="fa fa-home"></i></a> / Suivi des outils</h4> 
        </div>
            <span class="align-r">
                    <a href="Nouveau-outil" class="btn btn-primary btn-xs"><i class="fa fa-plus-circle"></i> Nouveau outil</a>
                    <button class="btn btn-success btn-xs" id="exporter_suivi"><i class="fa fa-upload"></i> Exporter</button>
                    <button class="btn btn-danger btn-xs"><i class="fa  fa-print"></i> Imprimer</button> 
            </span>
        
    </div>
        <div class="col-lg-12">
            <div class="content-panel px-2">
            <form method="post" action="suivi-outil">
            <div class="alert alert-warning py-3">
               
              <div class="form-group">
              <div class="col-lg-2">   
              <h4 class="text-left"><i class="fa  fa-sort-alpha-asc"></i><strong>   Filtrer</strong></h4>
                </div>
                <div class="col-lg-3">
                    <select class="form-control" name="statut_id" id="statut_id" onchange="fitre($url='filtre-suivi')">
                        <option value="" selected="selected">--Par statut--</option>
                        <?php   $liste_statut = liste_statut();
                            while($donnne = $liste_statut->fetch())
                            {
                            ?>
                                <option value="<?=$donnne['id_statut']?>"><?=$donnne['lib_statut']?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="col-lg-3">
                    <select class="form-control" name="empl_id" id="empl_id" onchange="fitre($url='filtre-suivi')">
                        <option value="" selected="selected">--Par Emplacement--</option>
                        <?php   $liste_service = liste_emplacement();
                            while($donnne = $liste_service->fetch())
                            {
                            ?>
                            <option value="<?=$donnne['id_emplacement']?>" ><?=$donnne['lib_emplacement']?></option>
                            <?php
                            }
                            ?>
                    </select>
                </div>

                <div class="col-lg-2">
                    <select class="form-control" name="etat_id" id="etat_id" onchange="fitre($url='filtre-suivi')">
                    <option value="" selected="selected">--Par état--</option>
                        <?php   $liste_service = liste_etat();
                            while($donnne = $liste_service->fetch())
                            {
                            ?>
                            <option value="<?=$donnne['id_etat']?>" ><?=$donnne['lib_etat']?></option>
                            <?php
                            }
                            ?>
                    </select>
                </div>
                <div class="col-lg-2">
                   
                    <button class="btn btn-primary btn-sm"><i class="fa fa-check" title="Filtrer"></i></button>
                    <span><a href="suivi-outil" class="btn btn-primary btn-sm" title="Actualiser"><i class="fa fa-refresh"></i></a></span>
                </div>

                </div>
                
              </div>
              </form>
              <section id="unseen">
              <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-condensed" 
                    id="hidden-table-info">
                  <thead>
                    <tr>
                      <th>Reference</th>
                      <th>Désignation</th>
                      <th>Statut</th>
                      <th>Etat</th>
                      <th>Emplacement</th>
                      <th>Identification</th>
                      <th>Position</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php 
                     $repertoire = suivi_outil($filtre);
                     while($donnees = $repertoire->fetch())
                     {

                              if($donnees['id_etat']==1 or $donnees['id_etat']==2)
                              {
                                    $bg = ' bg-success';
                              }elseif( $donnees['id_etat']== 3)
                              {
                                    $bg = 'bg-warning';
                              }else
                              {
                                  $bg = ' bg-danger';
                              }

                              if($donnees['id_statut']==1)
                              {
                                    $bg_s = ' bg-success';
                              }else
                              {
                                    $bg_s = ' bg-danger';
                              }
                 ?>
                
                 <tr>
                     <td onclick="document.location='detail?param=<?=$donnees['id_outil']?>'"><?=$donnees['ref_outil'] ?></td>
                     <td onclick="document.location='detail?param=<?=$donnees['id_outil']?>'"><?=$donnees['lib_desig'] ?></td>
                     <td onclick="document.location='detail?param=<?=$donnees['id_outil']?>'"><span class="badge <?= $bg_s?>"><?=$donnees['lib_statut'] ?></span></td>
                     <td onclick="document.location='detail?param=<?=$donnees['id_outil']?>'"><span class="badge <?= $bg?>"><?=$donnees['lib_etat'] ?></span></td>
                     <td onclick="document.location='detail?param=<?=$donnees['id_outil']?>'"><?=$donnees['lib_emplacement'] ?></td>
                     <td onclick="document.location='detail?param=<?=$donnees['id_outil']?>'"><?=$donnees['lib_identification'] ?></td>
                     <td onclick="document.location='detail?param=<?=$donnees['id_outil']?>'"><?=$donnees['lib_position'] ?></td>
                     <td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#model-modif-un-outil<?=$donnees['id_outil']?>"><i class="fa fa-pencil"></i></button></td>
                     <!-- On charge le model pour modifier un outil -->
                         <?php include('model-file/model-modif-un-outil.php'); ?>
                     <!--**********************************************************-->
                    
                 </tr>
                 <?php
                     }
                 ?>
                                  
                </tbody>
                </table>
                </div>
              </section>
                </div>
             
           
            <!-- /content-panel -->
        </div>   
        
<?php if(isset($_POST))
{
    unset($_POST);
}
 
