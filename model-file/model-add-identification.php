<div class="modal fade" id="model-add-identification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-dark" id="myModalLabel">Nouvelle Identification</h4>
                </div>
                <div class="modal-body">
                <h6>Champs obligatoire (<span class="text-danger">*</span>)</h6>
                <hr>
                      <form class="cmxform form-horizontal style-form"  method="get" action="">
                        <div class="form-group">
                            <label for="cname" class="control-label col-lg-4">Identification (<span class="text-danger">*</span>)</label>
                            <div class="col-lg-8">
                              <input class=" form-control" id="lib_identification" name="lib_identification" minlength="2" type="text" required placeholder="Identification" />
                            </div>
                        </div>
                      </form>   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <a type="button" id="add_identification" onclick="add_identification()" class="btn btn-primary" data-dismiss="modal">Ajouter</a>
                </div>
          </div>
      </div>
</div>