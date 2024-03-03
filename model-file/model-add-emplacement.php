<div class="modal fade" id="model-add-emplacement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-dark" id="myModalLabel">Nouveau emplacement</h4>
                </div>
                <div class="modal-body">
                <h6>Champs obligatoire (<span class="text-danger">*</span>)</h6>
                <hr>
                      <form class="cmxform form-horizontal style-form"  method="get" action="">
                        <div class="form-group">
                            <label for="cname" class="control-label col-lg-4">Emplacement Outil (<span class="text-danger">*</span>)</label>
                            <div class="col-lg-8">
                              <input class=" form-control" id="lib_emplacement" name="lib_emplacement" minlength="2" type="text" required placeholder="Emplacement" />
                            </div>
                        </div>
                      </form>   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <a type="button" id="add_emplacement" onclick="add_emplacement()" class="btn btn-primary" data-dismiss="modal">Ajouter</a>
                </div>
          </div>
      </div>
</div>