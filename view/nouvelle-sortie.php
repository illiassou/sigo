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
    <h4 class="text-dark"><a href="menu"><i class="fa fa-home"></i></a> / Sortie outil</h4> 
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
                <form class="cmxform form-horizontal style-form" action="code" method="POST" id="commentForm">
                <div class="form-group">

                <div class="col-lg-6">
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-12">N° Matricule Technicien</label>
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                          <input class=" form-control" id="matricule" name="matricule" minlength="1" type="text" placeholder="N° Matricule Technicien" />
                          
                        </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-12"> Réference / Désignation</label>
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                              <!-- on inclu la liste deroulant designation des outils -->
                              <input class=" form-control" id="recherche_outil" name="nombre" minlength="1" type="text" placeholder="Reference / Désignation" />
                            </div>
                            <div class="col-lg-12" id="rech_outil">
                            <?php include('recherche-outil.php'); ?>
                            </div>
                            
                        </div>
                    </div>
                   
                </div>
          
            </div>
                <hr>
                <div class="form-group">

                <div class="col-lg-6">
                <div class="alert alert-warning"><i class="fa fa-user"></i> <b>Technicien Responsable</b></div>
                <div class="form-group " id="agent">

                  <?php include('recherche-agent.php'); ?>

                  </div>

                </div>

                <div class="col-lg-6">
                <div class="alert alert-warning"><i class="fa fa-shopping-cart"></i> <b>Pannier sortie</b></div>
                    <div class="form-group" id="liste_outil">

                      <?php include('add-outil-sortie.php'); ?>

                    </div>
                </div>
                </div>


                <hr>
                <div class="form-group">
                <div class="col-lg-6">
                <div class="col-lg-12">
                    <div class="form-group">
                      <label for="cemail" class="control-label col-lg-12">Date Sortie(<span class="text-danger">*</span>)</label>
                      <div class="col-lg-12">
                        <input class=" form-control" id="date_sortie" name="date_sortie" minlength="1" type="date" 
                        value="<?=date('Y-m-d')?>" required placeholder="N° Matricule Technicien"/>
                      </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                      <label for="cemail" class="control-label col-lg-12">Date retoure(<span class="text-danger">*</span>)</label>
                      <div class="col-lg-12">
                        <input class=" form-control" id="date_retoure" name="date_retoure" minlength="1" type="date" required placeholder="N° Matricule Technicien"/>
                      </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                      <div class="col-lg-12">
                        <textarea class="form-control" name="mission" id="mission" placeholder="Mission"></textarea>
                      </div>
                    </div>
                </div>

                
                </div>
                <div class="col-lg-6">
                 <div class="col-lg-12">
                    <div class="col-md-12">
                        <label class="" for="">Signature:</label>
                        <br />
                        <div id="sig"></div>
                        <br />

                        <textarea id="signature64" name="signature" style="display: none"></textarea>
                        <div class="col-12">
                            <button class="btn btn-sm btn-warning" id="clear">Changer la signature</button>
                        </div>
                    </div>

                    
                
            </div>
            </div>
            </div>


        

                <hr>

                <div class="form-group">
                    <div class="col-lg-offset-0 col-lg-10">
                      <button class="btn btn-theme" name="enregistre_sortie" id="enregistre_sortie" type="submit">Enregistrer</button>
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