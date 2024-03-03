<div class="modal fade" id="model-modif-etat<?=$v['id_outil']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-dark" id="myModalLabel">Modifier etat</h4>
                </div>
                <div class="modal-body">
                <h6>Champs obligatoire (<span class="text-danger">*</span>)</h6>
                <hr>
                      <form class="cmxform form-horizontal style-form"  method="get" action="">
                        <div class="form-group">
                            <label for="cname" class="control-label col-lg-2">Etat outil (<span class="text-danger">*</span>)</label>
                            <div class="col-lg-10">
                              <select class="form-control" name="id_etat" id="id_etat">
                                <option value="" selected="selected">--- Etat ---</option>
                                <?php $etat = liste_etat();
                                      while($donne = $etat->fetch())
                                      {
                                ?>
                                <option value="<?=$donne['id_etat']?>" <?php if($donne['id_etat']==$v['id_etat']){echo 'Selected';}?>><?=$donne['lib_etat']?></option>
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
                    <a type="button" id="add_emplacement" onclick="add()" class="btn btn-primary" data-dismiss="modal">Modifier</a>
                </div>
          </div>
      </div>
</div>