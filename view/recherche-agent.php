<?php
if(isset($_GET['matricule']))
{
    $matricule = $_GET['matricule'];
    $liste_agent = select($table="agent A,service S",$con="A.id_serv = S.id_serv and A.valide = 0 and A.matricule='$matricule' ");
    $count = $liste_agent->rowCount();
    if($count > 0)
    {
        $donnee = $liste_agent->fetch();

?>

<div class="col-lg-12">
    <div class="form-group">
        <div class="col-lg-12">
            <label for="cemail" class="control-label col-lg-3">N° matricule (<span class="text-danger">*</span>)</label>
            <div class="col-lg-9">
                <input class=" form-control" id="matricule_agent" name="matricule" minlength="1" type="text" 
                 value="<?=$donnee['matricule']?>" required placeholder="N° Matricule Technicien"  disabled/> 
                 <input type="hidden" name="id_agent" value="<?=$donnee['id_agent']?>" required>  
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-12">
            <label for="cemail" class="control-label col-lg-3">Nom  (<span class="text-danger">*</span>)</label>
            <div class="col-lg-9">
                <input class=" form-control" id="nom_agent" name="nom_agent" minlength="1" type="text" 
                value="<?=$donnee['nom_agent']?>"  required placeholder="Nom Technicien" disabled/>   
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-12">
            <label for="cemail" class="control-label col-lg-3">Prénom  (<span class="text-danger">*</span>)</label>
            <div class="col-lg-9">
                <input class=" form-control" id="prenom_agent" name="prenom_agent" minlength="1" type="text" 
                value="<?=$donnee['prenom_agent']?>" required placeholder="Prénom Technicien" disabled/>   
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-12">
            <label for="cemail" class="control-label col-lg-3">Poste  (<span class="text-danger">*</span>)</label>
            <div class="col-lg-9">
                <input class=" form-control" id="poste_agent" name="poste_agent" minlength="1" type="text" 
                value="<?=$donnee['poste_agent']?>" required placeholder="Poste Technicien" disabled />   
            </div>
        </div>
    </div>


    <div class="form-group ">
        <div class="col-lg-12">
            <label for="cemail" class="control-label col-lg-3">Poste  (<span class="text-danger">*</span>)</label>
                <div class="col-lg-9">
                    <select class="form-control " name="id_serv" id="id_serv" data-live-search="true" disabled>
                        <option value="" selected>--Choisir le service--</option>
                            <?php   $liste_service = liste_service();
                            while($donnne = $liste_service->fetch())
                            {
                            ?>
                            <option value="<?=$donnne['id_serv']?>" <?php if($donnee['id_serv']==$donnne['id_serv']){echo "selected";}?>><?=$donnne['lib_serv']?></option>
                            <?php
                            }
                            ?>
                    </select>
                </div>
        </div>
    </div>
                             
</div>       




<?php

    }else
    {

?>


                   
<div class="col-lg-12">
    <div class="form-group">
        <div class="col-lg-12">
            <label for="cemail" class="control-label col-lg-3">N° matricule (<span class="text-danger">*</span>)</label>
            <div class="col-lg-9">
                <input class=" form-control" id="matricule_agent" name="matricule_agent" value="<?=$matricule?>" minlength="1" type="text" required placeholder="N° Matricule Technicien" />   
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-12">
            <label for="cemail" class="control-label col-lg-3">Nom  (<span class="text-danger">*</span>)</label>
            <div class="col-lg-9">
                <input class=" form-control" id="nom_agent" name="nom_agent" minlength="1" type="text" required placeholder="Nom Technicien" />   
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-12">
            <label for="cemail" class="control-label col-lg-3">Prénom  (<span class="text-danger">*</span>)</label>
            <div class="col-lg-9">
                <input class=" form-control" id="prenom_agent" name="prenom_agent" minlength="1" type="text" required placeholder="Prénom Technicien" />   
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-12">
            <label for="cemail" class="control-label col-lg-3">Poste  (<span class="text-danger">*</span>)</label>
            <div class="col-lg-9">
                <input class=" form-control" id="poste_agent" name="poste_agent" minlength="1" type="text" required placeholder="Poste Technicien" />   
            </div>
        </div>
    </div>


    <div class="form-group ">
        <div class="col-lg-12">
            <label for="cemail" class="control-label col-lg-3">Poste  (<span class="text-danger">*</span>)</label>
                <div class="col-lg-9">
                    <select class="form-control " name="id_serv" id="id_serv" data-live-search="true" >
                        <option value="" selected>--Choisir le service--</option>
                            <?php   $liste_service = liste_service();
                            while($donnne = $liste_service->fetch())
                            {
                            ?>
                            <option value="<?=$donnne['id_serv']?>"><?=$donnne['lib_serv']?></option>
                            <?php
                            }
                            ?>
                    </select>
                </div>
        </div>
    </div>
                             
</div>       

<?php


    }
}