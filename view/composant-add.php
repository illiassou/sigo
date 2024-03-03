<?php
//session_start();

    if(isset($_GET['supp']))
    {
        unset($_SESSION['composant'][$_GET['supp']]);
    }

    if(isset($_GET['id_desig_2']) and !empty($_GET['id_desig_2']))
    {        
        $id_desig_2 = $_GET['id_desig_2'];
        $id_etat_2 = $_GET['id_etat_2'];
       

        // Avec l'ID on recupère les libelle correspondants
        // la designation correspondante
        if(isset($_GET['id_desig_2']) and !empty($_GET['id_desig_2']))
        {
            $designation = select($table='designation',$con='id_desig='.$id_desig_2);
            $donne = $designation->fetch();
            $lib_desig = $donne['lib_desig'];
        }

        //l'etat correspondante
        if(isset($_GET['id_etat_2']) and !empty($_GET['id_etat_2']))
        {
            $etat = select($table='etat',$con='id_etat='.$id_etat_2);
            $donne_e = $etat->fetch();
            $lib_etat = $donne_e['lib_etat'];
        }

       

if(isset($_GET['id_desig_2']) and !empty($_GET['id_desig_2']) and isset($_GET['id_etat_2']) and 
   !empty($_GET['id_etat_2']))
{
        $_SESSION['composant'][$id_desig_2] = array
        (
            'id_desig'    => $id_desig_2,
            'lib_desig'   => $lib_desig,
            'id_etat'     => $id_etat_2,
            'lib_etat'    => $lib_etat
        );    
    }
}
?>
<script type="text/javascript">
    //$("#id_desig_2").val('');
   // $("#id_etat_2").val('');
   // $("#id_statut_2").val('');
</script>

<?php
if(isset($_SESSION['composant']) and $_SESSION['composant']!=''){
    $i = 0;
    $liste_composant = $_SESSION['composant'];
    foreach($liste_composant as $C => $c):
    $i = $i+1;
?>
 <!-- SORTABLE TO DO LIST -->
            <div class="panel-body" style="margin-top: -20px;">
                        <span class="task-title-sp"><?= $i ?>. </span>
                        <span class="task-title-sp"> <?= $c['lib_desig'] ?></span>
                        <span class="badge bg-theme"><?= $c['lib_etat'] ?></span>
                        <div class="pull-right hidden-phone">
                        <a class="btn btn-danger btn-xs fa fa-trash-o" onclick="supp_composant(<?=$c['id_desig']?>)"></a>
                        </div>
                </div>
  <?php
  endforeach;
}else
{
    echo "Aucun composant selectionné!!!";
}
  ?>       
      