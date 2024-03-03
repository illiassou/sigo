<div class="modal fade" id="model-modif-sortie<?=$donnees['id_sortie_outil']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-dark" id="myModalLabel">MODIFICATION SORTIE OUTILS</h4>
                </div>
                <form method="POST" action="code" enctype="multipart/form-data">
                    <input type="hidden" name="id_sortie_outil" value="<?=$donnees['id_sortie_outil']?>">
                    <input type="hidden" name="page" value="<?= $_GET['r']?>">
                <div class="modal-body">
                <h6>Champs obligatoire (<span class="text-danger">*</span>)</h6>
                <hr>
                    
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="cname" class="control-label col-lg-4">Agent (<span class="text-danger">*</span>)</label>
                                <div class="col-lg-8">
                                <select class="form-control" name="id_agent" id="id_agent" data-live-search="true" required>
                                    <option value="" selected>--Agent--</option>
                                    <?php   $liste_agent = liste_agent();
                                            while($donne = $liste_agent->fetch())
                                            {
                                    ?>
                                            <option value="<?=$donne['id_agent']?>" <?php if($donne['id_agent']==$donnees['id_agent']){echo 'selected';}?>><?=$donne['nom_agent'].' '.$donne['prenom_agent']?></option>
                                    <?php
                                            }
                                    ?>
                                    </select>
                                    </div>    
                                </div> 
                            </div>

                            <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="cname" class="control-label col-lg-4">Date sortie (<span class="text-danger">*</span>)</label>
                                <div class="col-lg-8">
                                <input type="date" name="date_sortie" id="date_sortie" class="form-control" value="<?=$donnees['date_sortie_outil']?>" required>
                                </div>    
                                </div> 
                            </div>

                            <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="cname" class="control-label col-lg-4">Date retour (<span class="text-danger">*</span>)</label>
                                <div class="col-lg-8">
                                <input type="date" name="date_retour" id="date_retour" class="form-control" value="<?=$donnees['date_retour_outil']?>" required>
                                </div>    
                                </div> 
                            </div>

                            <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="cname" class="control-label col-lg-4">Mission (<span class="text-danger">*</span>)</label>
                                <div class="col-lg-8">
                                <textarea class="form-control" name="mission" id="mission"><?=$donnees['mission']?></textarea>
                                    </div>    
                                </div> 
                            </div>
                        </div>
                  
                </div>
                
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <input type="submit" id="btn_modif_sortie" name="btn_modif_sortie"  class="btn btn-primary" value="Modifier">
                </div>
                </form> 
                </div>
                
                </div>
          </div>