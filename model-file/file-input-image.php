<div class="form-group last">
    <label class="control-label col-md-12">Choisir une image</label>
        <div class="col-md-12">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 320px; height: 200px;">
                    <img src="<?=HOST?>/img/<?=$donnees['image_outil']?>" alt="" />
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 320px; max-height: 200px; line-height: 20px;"></div>
                <div>
                    <span class="btn btn-file btn-primary">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Choisir une image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Changer</span>
                        <input type="hidden" value="" >
                        <input type="file" name="file" class="default" />
                    </span>
                    <a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Supprimer</a>
                </div>
            </div>
                   
        </div>
</div>