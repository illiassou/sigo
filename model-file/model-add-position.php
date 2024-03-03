<div class="modal fade" id="model-add-position" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-dark" id="myModalLabel">Nouvelle Position</h4>
                </div>
                <div class="modal-body">
                <h6>Champs obligatoire (<span class="text-danger">*</span>)</h6>
                <hr>
                      <form class="cmxform form-horizontal style-form"  method="get" action="">
                        <div class="form-group">
                            <label for="cname" class="control-label col-lg-4">Position (<span class="text-danger">*</span>)</label>
                            <div class="col-lg-8">
                                <input class=" form-control" id="lib_position" name="lib_position" minlength="2" type="text" required placeholder="Position" />
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-4">Identification (<span class="text-danger">*</span>)</label>
                            <div class="col-lg-8">
                           
                                <select class="form-control" name="id_identification_" id="id_identification_" required>
                                    <option value="" selected>--Choisir une identification--</option>
                                <?php   $liste_emplacement = liste_identification();
                                    while($donnne = $liste_emplacement->fetch())
                                    {
                                ?>
                                    <option value="<?=$donnne['id_identification']?>"><?=$donnne['lib_identification']?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                      </form>   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <a type="button" id="add_position" onclick="add_position()" class="btn btn-primary" data-dismiss="modal">Ajouter</a>
                </div>
          </div>
      </div>
</div>