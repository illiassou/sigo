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

<!-- *************************************************-->
<div class="alert alert-warning mt">
    <h4 class="text-dark"><a href="menu"><i class="fa fa-home"></i></a> / Retour outil</h4> 
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

                <div class="col-lg-12">
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-12">N° Matricule Technicien</label>
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                          <input class=" form-control" id="matricule_a" name="matricule_a" minlength="1" type="text" placeholder="N° Matricule Technicien" />
                        </div>
                        <div class="col-lg-12 " id="reponse">
                            <?php include('recherche-outil-retour.php'); ?>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
                <hr>
                <div class="form-group">
                

                <div class="col-lg-6">
                <div class="alert alert-warning"><i class="fa fa-shopping-cart"></i> <b>Pannier retour</b></div>
                    <div class="form-group" id="liste_outil_sortie">
                      <?php include('add-retour.php'); ?>
                    </div>
                    
                 </div>


                <div class="col-lg-6">
                  <div class="alert alert-warning"><i class="fa fa-user"></i> <b>Technicien Responsable</b></div>
                    <div class="form-group" id="liste_outil">

                    <div class="col-lg-12">
                    <div class="form-group">
                    <label for="cemail" class="control-label col-lg-12">Commentaire</label>
                      <div class="col-lg-12">
                        <textarea class="form-control" cols="30" rows="2" name="com" id="com" placeholder="Commentaire" ></textarea>
                      </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                      <label class="" for="">Signature:</label>
                      <br />
                      <div id="sig"></div>
                      <br />

                      <textarea id="signature64" name="signature" style="display: none"></textarea>
                      <div class="col-12">
                        <button class="btn btn-sm btn-warning" id="clear">Effacer</button>
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