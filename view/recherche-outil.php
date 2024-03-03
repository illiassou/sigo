<?php

if(isset($_GET['recherche']) and $_GET['recherche']!='')
{
    $recherche = $_GET['recherche'];
    $resul = recherche_outil($recherche);
    if($resul->rowCount() <= 0)
    {
        echo 'Aucun resultat !!!';
    }else
    {

      if($resul->rowCount()>4)
      {
        $style = 'style="height: 150px;overflow-y: scroll;"';
      }else
      {
        $style = 'style="height: auto;overflow-y: hidden;"';
      }
?>

<ul  class="list-group rech" <?=  $style?>>
                    
                    
                  
                        
<?php
        while($donnees = $resul->fetch())
        {
?>               
                <li class="list-group-item">
                  <input type="hidden" name="id_outil" id="id_outil<?=$donnees['id_outil']?>" value="<?=$donnees['id_outil']?>">
                  <input type="hidden" name="id_etat" id="id_etat<?=$donnees['id_outil']?>" value="<?=$donnees['id_etat']?>">
                  <input type="hidden" name="lib_desig" id="lib_desig<?=$donnees['id_outil']?>" value="<?=$donnees['lib_desig']?>">
                  <input type="hidden" name="lib_etat" id="lib_etat<?=$donnees['id_outil']?>" value="<?=$donnees['lib_etat']?>">
                  <input type="hidden" name="ref_outil" id="ref_outil<?=$donnees['id_outil']?>" value="<?=$donnees['ref_outil']?>">
                  <input type="hidden" name="image" id="image<?=$donnees['id_outil']?>" value="<?=$donnees['image_outil']?>">
                      <div class="task-title">
                      <span class="task-title-sp"><?=$donnees['ref_outil']?></span>
                        <span class="task-title-sp"><?=$donnees['lib_desig']?></span>
                        <div class="pull-right hidden-phone">
                          <a class="btn btn-primary btn-xs" onclick="add_outil_sortie(<?=$donnees['id_outil']?>)"><i class=" fa fa-plus"></i></a> 
                        </div>
                      </div>
                    </li>                  

                            
<?php
        }
?>
        </ul>  
<?php
    }
}

?>