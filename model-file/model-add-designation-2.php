<div class="modal fade" id="model-add-designation-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-dark" id="myModalLabel">Nouvelle Designation</h4>
                </div>
                <div class="modal-body">
                <h6>Champs obligatoire (<span class="text-danger">*</span>)</h6>
                <hr>
                      <form class="cmxform form-horizontal style-form" method="get" action="">

                      <div class="form-group">
                            <label for="cname" class="control-label col-lg-4">Réference (<span class="text-danger">*</span>)</label>
                            <div class="col-lg-8">
                              <input class=" form-control" id="ref_desig_2" name="ref_desig" minlength="2" type="text" required placeholder="Réference" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cname" class="control-label col-lg-4">Désignation (<span class="text-danger">*</span>)</label>
                            <div class="col-lg-8">
                              <input class=" form-control" id="lib_desig_2" name="lib_desig" minlength="2" type="text" required placeholder="Désignation" />
                            </div>
                        </div>
                        
                      </form>   
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="button" id="btn_add_design_2" onclick="add_designation_2()" data-dismiss="modal" class="btn btn-primary">Ajouter</button>
                </div>
          </div>
      </div>
</div>