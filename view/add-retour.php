<?php
if(isset($_GET['id_sortie']) and !empty($_GET['id_sortie']))
{
    $id_sortie = $_GET['id_sortie'];

    $liste_outil_sortie = select($table='sortie S,sortir SR,outil O,designation D, etat E',$con='SR.id_sortie_outil=S.id_sortie_outil
     and O.id_outil=SR.id_outil and O.id_desig=D.id_desig and S.statut_sortie=0 and SR.id_etat=E.id_etat and S.id_sortie_outil='.$id_sortie);

     if($liste_outil_sortie->rowCount()>0)
     {
        while($row = $liste_outil_sortie->fetch() )
        {

            if($row['id_categorie']==2)
            {

                $liste_composant = select($table='sortie S,sortir_composant SR,composant_outil C,designation D, etat E',$con='SR.id_sortie_outil=S.id_sortie_outil and S.statut_sortie=0 and SR.id_sortie_outil='.$id_sortie.' and C.id_desig=D.id_desig and C.id_etat=E.id_etat and SR.id_outil='.$row['id_outil']);
               
                while($done = $liste_composant->fetch())
                {

                    $_SESSION[$row['ref_outil']][$done['ref_comp_outil']]= array(
                        
                        'id_comp_outil'=>$done['id_comp_outil'],
                        'id_outil'=>$done['id_outil'],
                        'lib_desig'=>$done['lib_desig'],
                        'id_etat'=>$done['id_etat'],
                        'ref_comp_outil' =>$done['ref_comp_outil'],
                        'lib_etat'  =>$done['lib_etat'],
                        );

                       // unset($_SESSION[$row['ref_outil']]);
                }

                $_SESSION['outil_retour'][$row['ref_outil']] = array(

                    'composant' => $_SESSION[$row['ref_outil']],
                    'id_outil'=>$row['id_outil'],
                    'id_sortie_outil'=>$row['id_sortie_outil'],
                    'id_etat'=>$row['id_etat'],
                    'lib_desig' =>$row['lib_desig'],
                    'ref_outil' =>$row['ref_outil'],
                    'lib_etat' =>$row['lib_etat'],
                    'id_categorie' =>$row['id_categorie']

                );       

                }else
                {


                $_SESSION['outil_retour'][$row['ref_outil']] = array(

                    'composant' => array(),
                    'id_outil'=>$row['id_outil'],
                    'id_sortie_outil'=>$row['id_sortie_outil'],
                    'id_etat'=>$row['id_etat'],
                    'lib_desig' =>$row['lib_desig'],
                    'ref_outil' =>$row['ref_outil'],
                    'lib_etat' =>$row['lib_etat'],
                    'id_categorie' =>$row['id_categorie']

                ); 

                
            } 
           // unset($_SESSION['outil_retour']);            
            }


            
        }



    }
    
//unset($_SESSION['outil_retour']);
?>
            <div class="col-lg-12">
                
                  <table class="table accordion table-bordered table-striped table-condensed">
                  <thead>
                        <tr>
                            <th></th>
                            <th>Réference</th>
                            <th>Désignation</th>
                            <th>Etat retour</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                <?php 

                    if(isset($_SESSION['outil_retour']) and !empty($_SESSION['outil_retour']))
                    {
                    $recherche = $_SESSION['outil_retour'];

                    foreach($recherche as $k=>$v){ 

                ?>
                      <tr>
                      <?php 
                            if($v['id_categorie'] == 2){
                      ?> 
                        <td class="inbox-small-cells" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne<?=$v['id_outil']?>"><i class="fa  fa-chevron-down"></i></td>
                    <?php 
                    }else
                    {
                    ?>
                    
                    <td class="inbox-small-cells" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne<?=$v['id_outil']?>"><i class="fa  fa-chevron-down"></i></td>

                    <?php 
                    }
                    ?>    

                        <td class="view-message  dont-show"><?= $v['ref_outil']?></td>
                        <td class="view-message  dont-show"><?= $v['lib_desig']?></td>
                        <td class="view-message  inbox-small-cells"><span class="badge bg-theme"><?= $v['lib_etat']?></span></td>
                        <td class="view-message">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#model-modif-etat<?=$v['id_outil']?>"><i class="fa fa-pencil"></i></a>
                        </td>
                        <?php include('model-file/model-modif-etat.php'); ?>
                      </tr>
                      <tr class="except-tr">
                        <td colspan="5">
                            <div id="collapseOne<?=$v['id_outil']?>" class="collapse">
                                <div class="accordion-inner">
                                    <h4>Composants</h4>
                                    <table class="table bg">
                                        <tr>
                                            <th>Réf Spe</th>
                                            <th>Desigantion</th>
                                            <th>Etat</th>
                                            <th></th>
                                        </tr>
                                    <?php 
                                    if(isset($recherche[$v['ref_outil']]['composant']) and !empty($recherche[$v['ref_outil']]['composant']))
                                    {
                                        $composant = $recherche[$v['ref_outil']]['composant'];

                                        foreach($composant as $donnees=>$donne)
                                        {
                                            if($donne['id_etat']==1 or $donne['id_etat']==2)
                                            {
                                                $bg = 'label-success';
                                            }elseif( $donne['id_etat']== 3)
                                            {
                                                $bg = 'label-warning';
                                            }else
                                            {
                                                $bg = 'label-danger';
                                            } 
                                    ?>
                                        <tr class="bg">
                                            <td><?= $donne['ref_comp_outil']?></td>
                                            <td><?= $donne['lib_desig']?></td>
                                            <td><?= $donne['lib_etat']?></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        }
                                    }
                                        ?>
                                    </table>
                                </div>
                            </div>

                        </td>
                    </tr
                    <?php } 
                    
                        }else
                        {
                            echo'Aucun resultat !!!';
                        }
                    ?>
                    </tbody>
                  </table>
            </div>