<?php
if (isset($_GET['id_etat']) and !empty($_GET['id_etat']))
{
        $filtre1 = " and O.id_etat=".$_GET['id_etat'];
}else
{
    $filtre1 = '';
}

if(isset($_GET['id_statut']) and !empty($_GET['id_statut']))
{
    $filtre2 = ' and O.id_statut='.$_GET['id_statut'];
}else
{
    $filtre2 = "";
}

if(isset($_GET["id_emplacement"]) and !empty($_GET['id_emplacement'] ))
{
    $filtre3 = ' and O.id_emplacement='.$_GET['id_emplacement'];
}else
{
    $filtre3 = '';
}

$filtre = $filtre1.''.$filtre2.''.''.$filtre3;

?>
                
                    