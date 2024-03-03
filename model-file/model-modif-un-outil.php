<div class="modal fade" id="model-modif-un-outil<?=$donnees['id_outil']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-dark" id="myModalLabel">MODIFICATION OUTIL : <?= $donnees['lib_desig'].' '.$donnees['ref_outil']?></h4>
                </div>
                <form method="POST" action="code" enctype="multipart/form-data">
                    <input type="hidden" name="id_desig" value="<?=$donnees['id_desig']?>">
                    <input type="hidden" name="id_outil" value="<?=$donnees['id_outil']?>">
                    <input type="hidden" name="image_init" value="<?= $donnees['image_outil']?>">
                    <input type="hidden" name="id_etat_init" value="<?= $donnees['id_etat']?>">
                    <input type="hidden" name="page" value="<?= $_GET['r']?>">
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
                                <label for="cname" class="control-label col-lg-4">Etat (<span class="text-danger">*</span>)</label>
                                <div class="col-lg-8">
                                <select class="form-control" name="id_etat" id="id_etat" data-live-search="true" required>
                                    <option value="" selected>--Choisir la categorie--</option>
                                    <?php   $liste_categorie = liste_etat();
                                            while($donne = $liste_categorie->fetch())
                                            {
                                    ?>
                                            <option value="<?=$donne['id_etat']?>" <?php if($donne['id_etat']==$donnees['id_etat']){echo 'selected';}?>><?=$donne['lib_etat']?></option>
                                    <?php
                                            }
                                    ?>
                                    </select>
                                    </div>    
                                </div> 
                            </div>

                            <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="cname" class="control-label col-lg-4">Statut (<span class="text-danger">*</span>)</label>
                                <div class="col-lg-8">
                                <select class="form-control" name="id_statut" id="id_statut" data-live-search="true" required>
                                    <option value="" selected>--Choisir la categorie--</option>
                                    <?php   $liste_categorie = liste_statut();
                                            while($donne = $liste_categorie->fetch())
                                            {
                                    ?>
                                            <option value="<?=$donne['id_statut']?>" <?php if($donne['id_statut']==$donnees['id_statut']){echo 'selected';}?>><?=$donne['lib_statut']?></option>
                                    <?php
                                            }
                                    ?>
                                    </select>
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

                            <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="cname" class="control-label col-lg-4">Commentaire </label>
                                <div class="col-lg-8" >

                                     <textarea class="form-control" name="com_modif" id="com_modif"></textarea>
                               
                                </div>    
                                </div> 
                            </div>
                        </div>
                  
                </div>
                
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <input type="submit" id="btn_modif_un_outil" name="btn_modif_un_outil"  class="btn btn-primary" value="Modifier">
                </div>
                </form> 
                </div>
                
                </div>
          </div>