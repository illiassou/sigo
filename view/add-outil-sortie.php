<?php
if(isset($_GET['supp']) and !empty($_GET['supp']))
{
    unset($_SESSION['outil'][$_GET['supp']]);
}
if(isset($_GET['id_outil']) and !empty($_GET['id_outil']))
{
    $id_outil      = $_GET['id_outil'];
    $id_etat       = $_GET['id_etat'];
    $lib_desig     = $_GET['lib_desig'];
    $lib_etat      = $_GET['lib_etat'];
    $ref_outil     = $_GET['ref_outil'];
    $image         = $_GET['image'];


    $_SESSION['outil'][$ref_outil]=array(

    'id_outil'  =>   $id_outil,
    'id_etat'   =>   $id_etat,
    'lib_desig' =>   $lib_desig,
    'lib_etat'  =>   $lib_etat,
    'ref_outil' =>   $ref_outil,
    'image'     =>   $image
    
    );
}
    echo '</hr>';  
    if(!empty($_SESSION['outil']))
    {
        $Outil = $_SESSION['outil'];
        foreach($Outil as $O => $o):
    ?>

    <div class="col-lg-3 align-center border">
    <hr>
    <div class="form-group">
    <div class="col-lg-12">
    <span class="badge bg-theme mb-1"><?=$o['ref_outil']?></span>
    </div>
    <div class="col-lg-12">
    <img src="img/<?=$o['image']?>" alt="..." class="img-thumbnail rounded mx-auto d-block" style="width: 100px;height:110px">
    </div>
    <div class="col-lg-12">
    <h6 class="text-center text-sm-center" style="font-size: smaller;"><?=$o['lib_desig']?></h6>
    </div>
    <div class="col-lg-6">
    <span class="badge bg-theme align-center"><?=$o['lib_etat']?></span>
    </div>
    <div class="col-lg-6">
    <span><a class="btn btn-danger btn-xs" onclick="supp_outil('<?=$o['ref_outil']?>')"><i class="fa fa-trash-o"></i></a> </span>
    </div>
    
    </div>
    
    </div>


<?php
    endforeach;
    }else
    {
        echo'<h4 class="text-center">Aucun outil ajouté </h4>';
    }