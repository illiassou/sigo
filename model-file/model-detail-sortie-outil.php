<div class="modal fade" id="model-detail-outil<?=$donnees['id_sortie_outil']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-dark" id="myModalLabel">Detail sortie</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-warning text-center">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <h4 class="text-center">Liste des outils</h4>
                            </div>
                        </div>

                    </div>
                    <hr>
        
                  <!-- COMPLEX TO DO LIST -->
                    <div class="row mt">
                        <div class="col-md-12">
                            <section class="tasks-widget">
                            <div class="panel-body">
                                <div class="task-content">
                                <ul class="task-list">
                                    <div class="form-group">
                                    <?php $liste_outil = liste_outil_sortie($donnees['id_sortie_outil'],$limit='');

                                    $nbre_outil = $liste_outil->rowCount();

                                    while($done = $liste_outil->fetch()){

                                        if($done['id_etat']==1 or $done['id_etat']==2)
                                        {
                                              $bg = ' bg-success';
                                        }elseif( $done['id_etat']== 3)
                                        {
                                              $bg = 'bg-warning';
                                        }else
                                        {
                                            $bg = ' bg-danger';
                                        }
                                    ?>
                                <div class="col-md-4">
                                    <li class="list-primary" style="padding:5px;">
                                    
                                        <div class="form-group">
                                        <div class="col-lg-12">
                                        <span class="badge bg-theme mb-1"><?=$done['ref_outil']?></span>
                                        </div>
                                        <div class="col-lg-12">
                                        <img src="img/<?=$done['image_outil']?>" alt="..." class="img-thumbnail rounded mx-auto d-block" style="width: 100px;height:110px">
                                        </div>
                                        <div class="col-lg-12">
                                        <h6 class="text-center text-sm-center" style="font-size: smaller;"><?=$done['lib_desig']?></h6>
                                        </div>
                                        <div class="col-lg-6">
                                        <span class="badge <?=$bg?> align-center"><?=$done['lib_etat']?></span>
                                        </div>
                                        <?php
                                            if($nbre_outil<=1)
                                            {}else
                                            {
                                        ?>
                                        <div class="col-lg-6">
                                        <span><a class="btn btn-danger btn-xs" href="code?param_o=<?=$done['id_outil']?>&param_s=<?=$done['id_sortie_outil']?>"><i class="fa fa-trash-o"></i></a> </span>
                                        </div>
                                        <?php
                                         }
                                        ?>
                                        </div>
                                    </li>
                                </div>
                                    <?php
                                    }
                                    ?>
                                    </div>
                                </ul>
                                </div>
                            </div>
                            </section>
                        </div>
                        <!-- /col-md-12-->
        </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
          </div>
      </div>
</div>