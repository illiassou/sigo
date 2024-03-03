
       <div class="alert alert-warning mt">
        <div class="col-lg-8">
            <h4 class="text-dark"><a href="menu"><i class="fa fa-home"></i></a> / Répertoire des outils</h4> 
        </div>
            <span class="align-r">
                    <a href="Nouveau-outil" class="btn btn-primary btn-xs"><i class="fa fa-plus-circle"></i> Nouveau outil</a>
                    <button class="btn btn-success btn-xs" id="exporter"><i class="fa fa-upload"></i> Exporter</button>
                    <button class="btn btn-danger btn-xs"><i class="fa  fa-print"></i> Imprimer</button> 
            </span>
        
        </div>
        <div class="col-lg-12">
            <div class="content-panel px-2">
              <h4> Répertoire des outils</h4>
              <section id="unseen">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-condensed" id="hidden-table-info">
                  <thead>
                    <tr>
                      <th>Reference</th>
                      <th>Désignation</th>
                      <th>Catégorie</th>
                      <th>Quantité</th>
                      <th>Emplacement</th>
                      <th>Identification</th>
                      <th>Position</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    // on appel la fonction qui reccupere les informations des outil
                        $repertoire = repertoire_outil();
                        while($donnees = $repertoire->fetch())
                        {
                    ?>
                    <tr>
                        <td><?=$donnees['ref_desig'] ?></td>
                        <td><?=$donnees['lib_desig'] ?></td>
                        <td><?=$donnees['lib_categorie'] ?></td>
                        <td><span class="badge bg-theme"><?=$donnees['quantite'] ?></td>
                        <td><?=$donnees['lib_emplacement'] ?></td>
                        
                        <td><?=$donnees['lib_identification'] ?></td>
                        <td><?=$donnees['lib_position'] ?></td>
                        <td>
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#model-modif-outil<?=$donnees['id_desig']?>"><i class="fa fa-pencil"></i></button>
                        </td>

                        <!-- On charge le model pour modifier un outil -->
                            <?php include('model-file/model-modif-outil.php'); ?>
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
 
