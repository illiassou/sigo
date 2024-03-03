<!-- On charge le model pour ajouter une designation -->
<?php include('model-file/model-add-designation.php'); ?>
<?php include('model-file/model-add-designation-2.php'); ?>
 <!-- *************************************************-->
<!-- On charge le model pour ajouter une designation -->
<?php include('model-file/model-add-emplacement.php'); ?>
<!-- *************************************************-->
<!-- On charge le model pour ajouter une identification -->
<?php include('model-file/model-add-identification.php'); ?>
<!-- *************************************************-->
<!-- On charge le model pour ajouter une position -->
<?php include('model-file/model-add-position.php'); ?>
<!-- *************************************************-->
<div class="alert alert-warning mt">
    <h4 class="text-dark"><a href="menu"><i class="fa fa-home"></i></a> / Nouveau outil</h4> 
</div>
 <!-- FORM VALIDATION -->
 <div class="row">
  <div id="test"></div>
    <div class="col-lg-12">
         <div id="cible"></div>  
        <div class="form-panel">
            <h6>Champs obligatoire (<span class="text-danger">*</span>)</h6>
            <hr>
            <div class="form">
                <form class="cmxform form-horizontal style-form" id="commentForm" method="POST" action="code" enctype="multipart/form-data">
                <div class="form-group ">
                <div class="col-lg-6">

                    

                    <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-4">Réference / Désignation(<span class="text-danger">*</span>)</label>
                        <div class="col-lg-8">
                            <div class="col-lg-10" id="designation">
                              <!-- on inclu la liste deroulant designation des outils -->
                                <?php include('add-info.php'); ?>
                            </div>
                            <div class="col-lg-1">
                                    <a class="btn btn-primary btn-sx" data-toggle="modal" data-target="#model-add-designation"><i class="fa fa-plus-circle"></i></a> 
                            </div>
                        </div>
                    </div>
                    <div id="reference">
                      <?php include('charger-reference.php'); ?>
                    </div>
                    

                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-4">Nombre d'exemplaire (<span class="text-danger">*</span>)</label>
                      <div class="col-lg-8">
                        <input class=" form-control" id="nombre" name="nombre" minlength="1" type="text" required placeholder="Nbre d'exemplaire" />
                      </div>
                    </div>

                  <div class="form-group ">
                    <label for="curl" class="control-label col-lg-4">Categorie(<span class="text-danger">*</span>)</label>
                    <div class="col-lg-8">
                    <select class="form-control selectpicker" name="id_categorie" id="id_categorie" data-live-search="true" required>
                            <option value="" selected>--Choisir la categorie--</option>
                            <?php   $liste_categorie = liste_categorie();
                                            while($donnne = $liste_categorie->fetch())
                                            {
                                    ?>
                                            <option value="<?=$donnne['id_categorie']?>"><?=$donnne['lib_categorie']?></option>
                                    <?php
                                            }
                                    ?>
                    </select>
                    </div>
                  </div>

                  <div class="form-group ">
                    <label for="ccomment" class="control-label col-lg-4">Etat(<span class="text-danger">*</span>)</label>
                    <div class="col-lg-8">
                    <select class="form-control selectpicker" name="id_etat" id="id_etat" data-live-search="true" required>
                            <option value="" selected>--Choisir l'état actuelle--</option>
                            <?php   $liste_etat = liste_etat();
                                            while($donnne = $liste_etat->fetch())
                                            {
                                    ?>
                                            <option value="<?=$donnne['id_etat']?>"><?=$donnne['lib_etat']?></option>
                                    <?php
                                            }
                                    ?>
                    </select>
                    </div>
                  </div>

                  <div class="form-group ">
                    <label for="ccomment" class="control-label col-lg-4">Statut(<span class="text-danger">*</span>)</label>
                    <div class="col-lg-8">
                    <select class="form-control selectpicker" name="id_statut" id="id_statut" data-live-search="true" required>
                            <option value="" selected>--Choisir le statut actuel--</option>
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
                  </div>
                <div class="form-group ">
                   <label for="ccomment" class="control-label col-lg-4">Ajouter des composants</label>
                   
                    <div class="col-sm-6">
                        <input type="checkbox" name="open" onclick="Open_composant_add()" id="open" data-toggle="switch" />
                    </div>
               
                   
                   </div>

                </div>

                <div class="col-lg-6">
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-4">Emplacement(<span class="text-danger">*</span>)</label>
                    <div class="col-lg-8">
                        <div class="col-lg-10" id="emplacement">
                            <!-- on inclu la liste deroulant pour les emplacements -->
                            <?php include('add-emplacement.php'); ?>
                        </div>
                        <div class="col-lg-1">
                                    <a class="btn btn-primary btn-sx" data-toggle="modal" data-target="#model-add-emplacement"><i class="fa fa-plus-circle"></i></a> 
                        </div>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-4">Identification (<span class="text-danger">*</span>)</label>
                    <div class="col-lg-8">
                        <div class="col-lg-10" id="identification">
                           <!-- on inclu la liste deroulant pour les emplacements -->
                           <?php include('add-identification.php'); ?>

                          </div>
                        <div class="col-lg-1">
                            <a class="btn btn-primary btn-sx" data-toggle="modal" data-target="#model-add-identification"><i class="fa fa-plus-circle"></i></a> 
                        </div>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-4">Position (<span class="text-danger">*</span>)</label>
                    <div class="col-lg-8">
                        <div class="col-lg-10" id="position">
                            
                            <!-- Affichage du resultat en fonction de l'identification choisi -->
                            <?php include('charger-position.php'); ?>
                           
                        </div>
                        <div class="col-lg-1">
                                    <a class="btn btn-primary btn-sx" data-toggle="modal" data-target="#model-add-position"><i class="fa fa-plus-circle"></i></a> 
                        </div>
                    </div>
                  </div>

                 <div class="form-group last">
                  <label class="control-label col-md-4">Choisir une image</label>
                  <div class="col-md-8">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 320px; height: 200px;">
                        <img src="" alt="" />
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 320px; max-height: 200px; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-file btn-primary">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Choisir une image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Changer</span>
                        <input type="hidden" value="" >
                        <input type="file" name="file" class="default" />
                        </span>
                        <a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Supprimer</a>
                      </div>
                    </div>
                   
                  </div>
                </div>
           

                </div>
          
            </div>
            
            <div class="form-group" id="composant-add" hidden>
            
                <div class="col-md-5">
                <h4 class="text-left">Formulaire d'ajout composant </h4>
                <hr>
                  <div class="form-group">
                      <div class="col-lg-12">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="col-lg-10" id="designation_2">
                                   <!-- Affichage du resultat en fonction de l'identification choisi -->
                                  <?php include('add-info-2.php'); ?> 
                                </div>
                                <div class="col-lg-2">
                                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#model-add-designation-2"><i class="fa fa-plus-circle"></i></a> 
                                </div>
                            
                            </div>
                            </div>

                            <div class="form-group ">
                            <div class="col-lg-12">
                                    <select class="form-control " name="id_etat_2" id="id_etat_2" data-live-search="true" >
                                        <option value="" selected>--Choisir l'etat actuelle--</option>
                                        <?php   $liste_etat = liste_etat();
                                            while($donnne = $liste_etat->fetch())
                                            {
                                        ?>
                                            <option value="<?=$donnne['id_etat']?>"><?=$donnne['lib_etat']?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                            </div>
                            </div> 
                    </div>       
                </div>
                <div class="col-lg-offset-5 col-lg-10">
                        <a class="btn btn-primary align-centre" onclick="add_composant()">Ajouter un composant</a>
                </div>      
                </div>
                <div class="col-md-7">
                <h4 class="text-left">Liste des composants ajoutés </h4>
                <hr>
                <div id="add-composant">
                    <?php include('composant-add.php'); ?>
                </div>
                </div>
            </div>
                <hr>
                  <div class="form-group">
                    <div class="col-lg-offset-0 col-lg-10">
                      <button class="btn btn-theme" name="enregistre_outil" type="submit">Enregistrer</button>
                      <button class="btn btn-theme04" type="button">Fermer</button>
                    </div>
                    </div>
                </form>
              </div>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>