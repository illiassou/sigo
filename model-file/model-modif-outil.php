<div class="modal fade" id="model-modif-outil<?=$donnees['id_desig']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-dark" id="myModalLabel">Modification d'un outil</h4>
                </div>
                <form method="POST" action="code" enctype="multipart/form-data">
                    <input type="hidden" name="id_desig" value="<?=$donnees['id_desig']?>">
                    <input type="hidden" name="nbre" value="<?=$donnees['quantite']?>">
                    <input type="hidden" name="image_init" value="<?= $donnees['image_outil']?>">
                <div class="modal-body">
                <h6>Champs obligatoire (<span class="text-danger">*</span>)</h6>
                <hr>
                    
                    <div class="form-group row">
                        <div class="col-lg-5">
                        <?php include('file-input-image.php'); ?>
                        </div>
                        <div class="col-lg-7">
                            <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="cname" class="control-label col-lg-4">Reference (<span class="text-danger">*</span>)</label>
                                <div class="col-lg-8">
                                    <input class=" form-control" id="ref_desig" name="ref_desig" value="<?=$donnees['ref_desig']?>" minlength="2" type="text" required placeholder="Reference" />
                                    <input type="hidden" name='ref_base' value="<?=$donnees['ref_desig']?>">
                                </div> 
                                </div> 
                            </div>

                            <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="cname" class="control-label col-lg-4">Désignation (<span class="text-danger">*</span>)</label>
                                <div class="col-lg-8">
                                    <input class=" form-control" id="lib_desig" name="lib_desig" value="<?=$donnees['lib_desig']?>" minlength="2" type="text" required placeholder="Désignation" />
                                    </div>    
                                </div> 
                            </div>

                            <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="cname" class="control-label col-lg-4">Catégorie (<span class="text-danger">*</span>)</label>
                                <div class="col-lg-8">
                                <select class="form-control" name="id_categorie" id="id_categorie" data-live-search="true" required>
                                    <option value="" selected>--Choisir la categorie--</option>
                                    <?php   $liste_categorie = liste_categorie();
                                            while($donne = $liste_categorie->fetch())
                                            {
                                    ?>
                                            <option value="<?=$donne['id_categorie']?>" <?php if($donne['id_categorie']==$donnees['id_categorie']){echo 'selected';}?>><?=$donne['lib_categorie']?></option>
                                    <?php
                                            }
                                    ?>
                                    </select>
                                    </div>    
                                </div> 
                            </div>

                            <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="cname" class="control-label col-lg-4">Emplacement (<span class="text-danger">*</span>)</label>
                                <div class="col-lg-8">
                                <select class="form-control" name="id_emplacement" id="id_emplacement" data-live-search="true" required>
                                        <option value="" selected>--Choisir un emplacement--</option>
                                        <?php   $liste_emplacement = liste_emplacement();
                                                while($donne = $liste_emplacement->fetch())
                                                {
                                        ?>
                                                <option value="<?=$donne['id_emplacement']?>" <?php if($donnees['id_emplacement']==$donne['id_emplacement']){echo'selected';}?>><?=$donne['lib_emplacement']?></option>
                                        <?php
                                                }
                                        ?>
                                </select>
                                    </div>    
                                </div> 
                            </div>


                            <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="cname" class="control-label col-lg-4">Identification (<span class="text-danger">*</span>)</label>
                                <div class="col-lg-8">
                                <select class="form-control" name="id_identification" id="id_identification" data-live-search="true" onchange="charge()" required>
                                        <option value="" selected>--Choisir une identification--</option>
                                        <?php   $liste_emplacement = liste_identification();
                                                while($donne = $liste_emplacement->fetch())
                                                {
                                        ?>
                                                <option value="<?=$donne['id_identification']?>" <?php if($donne['id_identification']==$donnees['id_identification']){echo'selected';}?>><?=$donne['lib_identification']?></option>
                                        <?php
                                                }
                                        ?>
                                </select>
                                    </div>    
                                </div> 
                            </div>


                            <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="cname" class="control-label col-lg-4">Position (<span class="text-danger">*</span>)</label>
                                <div class="col-lg-8" id='position_2'>

                                <select class="form-control" name="id_position" id="id_position" data-live-search="true"  required>
                                    <option value="" selected>--Choisir la position--</option>
                                <?php       $position = liste_position();
                                            while($donne = $position->fetch())
                                            {
                                ?>
                                            <option value="<?=$donne['id_position']?>"<?php if($donne['id_position']==$donnees['id_position']){echo 'selected';}?>><?=$donne['lib_position']?></option>
                                <?php
                                            }
                                ?>
                                </select>
                               
                                    </div>    
                                </div> 
                            </div>
                        </div>
                  
                </div>
                
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <input type="submit" id="btn_modif_outil" name="btn_modif_outil"  class="btn btn-primary" value="Modifier">
                </div>
                </form> 
                </div>
                
                </div>
          </div>