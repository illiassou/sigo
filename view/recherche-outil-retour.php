<?php 
if(isset($_GET['matricule']))
{
    $matricule = $_GET['matricule'];
    $liste_sortie_agent = select($table='sortie S,agent A',$con='A.id_agent=S.id_agent and S.statut_sortie=0 and A.matricule="'.$matricule.'"');
    if($liste_sortie_agent->rowCount()<= 0)
    {
        echo'Aucune sortie non retournée !!!';
    }else
    {
    
        while($donnees=$liste_sortie_agent->fetch()){
?>

    <li class="list-group-item">
        <input type="hidden" name="id_sortie" id="id_sortie<?=$donnees['id_sortie_outil']?>" value="<?=$donnees['id_sortie_outil']?>">
            <div class="task-title">
                <span class="task-title-sp"><?=$donnees['nom_agent'].' '.$donnees['prenom_agent']?></span>
                Sortie du <span class="task-title-sp"><?= date('d-m-Y',strtotime($donnees['date_sortie_outil']))?></span>
                <span class="task-title-sp"><?= $donnees['mission']?></span>
                <div class="pull-right hidden-phone">
                    <a class="btn btn-primary btn-xs" onclick="add_retour_sortie(<?=$donnees['id_sortie_outil']?>)"><i class=" fa fa-plus"></i></a> 
                </div>
               
            </div>
    </li>  
        
<?php
    }
}
}