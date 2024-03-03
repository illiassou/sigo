
        <div class="alert alert-warning mt">
        <div class="col-lg-8">
            <h4 class="text-dark"><a href="menu"><i class="fa fa-home"></i></a> / Outils HS</h4> 
        </div>
            <span class="align-r">
                    <button class="btn btn-primary btn-xs"><i class="fa fa-plus-circle"></i> Nouveau outil</button>
                    <button class="btn btn-success btn-xs" id="exporter"><i class="fa fa-upload"></i> Exporter</button>
                    <button class="btn btn-danger btn-xs"><i class="fa  fa-print"></i> Imprimer</button> 
            </span>
        
        </div>
        <div class="col-lg-12">
            <div class="content-panel px-2">
              <h4>Outils HS</h4>
             
                <div class="adv-table">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-condensed" id="hidden-table-info">
                  <thead>
                    <tr>
                      <th>Ref</th>
                      <th>Designation</th>
                      <th>Categorie</th>
                      <th>Emplacement</th>
                      <th>Etat</th>
                      <th>dernière modification</th>
                      <th>Commentaire</th>
                      <th>Technicien</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    // on appel la fonction qui reccupere les informations des outil
                        $repertoire = repertoire_outil_hs();
                        while($donnees = $repertoire->fetch())
                        {

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
                    ?>
                    <tr>
                        <td><?=$donnees['ref_outil'] ?></td>
                        <td><?=$donnees['lib_desig'] ?></td>
                        <td><?=$donnees['lib_categorie'] ?></td>
                        <td><?=$donnees['lib_emplacement'] ?></td>
                        <td><span class="label <?= $bg?>"><?=$donnees['lib_etat'] ?></span></td>
                        <td><?= date('d-m-Y H:i:s', strtotime($donnees['date_modif'])) ?></td>
                        <td><?=$donnees['com_modif'] ?></td>
                        <td>//</td>
                        <td>
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#model-modif-un-outil<?=$donnees['id_outil']?>"><i class="fa fa-pencil"></i></button>
                        </td>
                        <?php include('model-file/model-modif-un-outil.php'); ?>
                      
                    </tr>
                    <?php
                        }
                    ?>
                  </tbody>
                </table>
                </div>
             
            </div>
            <!-- /content-panel -->
        </div>      
 
