<?php
/* Configuration du systeme de pagination */
// on defini le nombre d'enregistrement par page

$nombre_par_page = 6;

if(isset($_GET['page']) and $_GET['page']!=0 )
{
    $page = $_GET['page'];
}elseif(isset($_SESSION['page']))
{
    $page = $_SESSION['page'];
}else
{
    $page = 1;
}
$debut = ($page-1)*$nombre_par_page;


/*Filtrage en fonction du parametre envoyer
param = 1 => afficher les outils en bon etat ou neuf
param = 2 => affichier les outils disponibles
parma = 3 => afficher les outils qui sont en opération( sur le terrain)
param = 4 => afficher les outils en panne
param = 5 => afficher les outils incomplets
param = 6 => afficher les outils hors service (sorties du stock)
*/
    
// On compte les nombres d'enregistrement recuperés et on calcul le nombre des pages
// ceil permet d'arrondir le resultat de la division en un entier
   $nombre_enregistrement = select_count($col='id_desig',$table='outil',$con='id_desig>0 group by id_desig');
   $rp = $nombre_enregistrement->rowCount();
   $count = $rp;
   $nombre_de_page =ceil($count/$nombre_par_page);

// sitution des outils par filtre

// FILTRE BONNE ETAT ET NEUF
    $nombre_outil_en_bonne_etat = select_count($col='id_desig',$table='outil',$con='id_etat=1 or id_etat=2');
    $resp_e = $nombre_outil_en_bonne_etat->fetch();
    $count_BE = $resp_e['nbre'];

// Disponible
    $nombre_outil_disponible = select_count($col='id_desig',$table='outil',$con='id_statut=1');
    $resp_d = $nombre_outil_disponible->fetch();
    $count_d = $resp_d['nbre'];

// En opération
    $nombre_outil_operation = select_count($col='id_desig',$table='outil',$con='id_statut=2 and id_etat= 1 or id_statut =2 and id_etat=2');
    $resp_o = $nombre_outil_operation->fetch();
    $count_o = $resp_o['nbre'];

// En panne
    $nombre_outil_en_panne = select_count($col='id_desig',$table='outil',$con='id_etat = 3');
    $resp_p = $nombre_outil_en_panne->fetch();
    $count_p = $resp_p['nbre'];
// Imcomplet

    $nombre_outil_imcomplet = select_count($col='O.id_desig',$table='outil O,composant_outil C',$con='O.id_outil = C.id_outil and C.id_etat=5');
    $resp_i = $nombre_outil_imcomplet->fetch();
    $count_i = $resp_i['nbre'];

// Hors Service

    $nombre_outil_hs = select_count($col='id_desig',$table='outil',$con='id_etat=4');
    $resp_hs = $nombre_outil_hs->fetch();
    $count_hs = $resp_hs['nbre'];

// Tout les outils

    $nombre_outil = select_count($col='id_desig',$table='outil',$con='id_outil!=0');
    $resp = $nombre_outil->fetch();
    $count_ = $resp['nbre'];
?>

<div class="alert alert-warning mt">
        <div class="col-lg-8">
            <h4 class="text-dark"><a href="menu"><i class="fa fa-home"></i></a> / Suivi des outils</h4> 
        </div>
        <span class="align-r">
            <a href="Nouveau-outil" class="btn btn-primary btn-xs"><i class="fa fa-plus-circle"></i> Nouveau outil</a>
            <button class="btn btn-success btn-xs" id="exporter"><i class="fa fa-upload"></i> Exporter</button>
            <button class="btn btn-danger btn-xs"><i class="fa  fa-print"></i> Imprimer</button> 
        </span>
</div>
        <!-- page start-->
          <div class="col-sm-3">
            <section class="panel">
              <div class="panel-body">
              <h4 class="alert-p alert-title text-left"><i class="fa  fa-sort-alpha-asc"></i><strong> Fitre</strong></h4>
                <ul class="nav nav-pills nav-stacked mail-nav">
                  <li><a href="suivi-outil"><i class="fa fa-inbox"></i> Tout  <span class="badge bg-theme pull-right"><?=$count_?></span></a></li>
                  <li><a href="?param=1"> <i class="fa  fa-check-square-o"></i> En Bon état <span class="badge bg-theme pull-right inbox-notification"><?=$count_BE?></span></a></li>
                  
                  <li><a href="?param=2"> <i class="fa  fa-mail-forward"></i> Disponible <span class="badge label-theme pull-right inbox-notification"><?=$count_d?></span></a></a>
                  </li>
                  <li><a href="?param=3"> <i class="fa fa-mail-reply "></i> Sur le terrain <span class="badge bg-theme pull-right inbox-notification"><?=$count_o?></span></a></li>
                  <li><a href="?param=4"> <i class="fa  fa-gears"></i> En panne <span class="badge bg-theme pull-right inbox-notification"><?=$count_p?></span></a></li>
                  <li><a href="?param=5"> <i class="fa fa-exclamation-circle"></i> Incomplet <span class="badge bg-theme pull-right inbox-notification"><?=$count_i?></span></a></li>
                  <li><a href="?param=6"> <i class="fa  fa-archive"></i> Hors Service <span class="badge bg-theme pull-right inbox-notification"><?=$count_hs?></span></a></li>
                </ul>
              </div>
            </section>
           
          </div>
          <div class="col-sm-9">
            <section class="panel">
              <header class="panel-heading wht-bg">
                
                <h4 class="gen-case">
                    <?php 
                        if(isset($_GET["param"]) and $_GET["param"] ==1 )
                        {
                            echo"Outils en bon état";
                        }elseif(isset($_GET["param"]) and $_GET["param"] ==2 )
                        {
                            echo "Outils disponibles";
                        }elseif(isset($_GET["param"]) and $_GET["param"] ==3 )
                        {
                            echo "Outils Sur le terrain";
                        }elseif(isset($_GET["param"]) and $_GET["param"] ==4 )
                        {
                            echo "Outils en panne";
                        }elseif(isset($_GET["param"]) and $_GET["param"] ==5 )
                        {
                            echo "Outils imcomplet";
                        }elseif(isset($_GET["param"]) and $_GET["param"] ==6 )
                        {
                            echo "Outils Hors service";
                        }else
                        {
                            echo "Tout les outils";
                        }
                        ?>
                    <form action="#" class="pull-right mail-src-position">
                      <div class="input-append">
                        <input type="text" class="form-control " placeholder="Recherche">
                      </div>
                    </form>
                  
                  </h4>
              </header>
              <div class="panel-body minimal">
                <div class="mail-option">
                  <div class="chk-all">
                    <div class="pull-left mail-checkbox">
                      <input type="checkbox" class="">
                    </div>
                    <div class="btn-group">
                      <a href="#" class="btn mini all">
                        All
                        </a>
                    </div>
                  </div>
                  <div class="btn-group">
                    <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
                      <i class=" fa fa-refresh"></i>
                      </a>
                  </div>
                  
                  <ul class="unstyled inbox-pagination">
                    <li><span><?=$debut+1?>-<?php if($count>= $nombre_par_page+$debut+1){ echo $nombre_par_page+$debut+1;}else{echo $count;}?> Sur <?=$count?></span></li>
                    <li>
                    <?php if($page>1) { ?>
                            <a class="np-btn" href="?page=<?=$page-1?>"><i class="fa fa-angle-left  pagination-left"></i></a>
                      <?php
                      }else
                      { 
                      ?>
                            <a class="np-btn" disabled><i class="fa fa-angle-left  pagination-left"></i></a>
                      <?php
                      } 
                      ?>
                    </li>
                    <li>
                    <?php
                    if($page<$nombre_de_page)
                    { 
                    ?>
                        <a class="np-btn" href="?page=<?=$page+1?>"><i class="fa fa-angle-right pagination-right"></i></a>
                    <?php
                    }else
                    {
                    ?>

                        <a class="np-btn" disabled><i class="fa fa-angle-right pagination-right"></i></a>
                    <?php
                    }
                    ?>
                    </li>
                  </ul>
                </div>
                <?php          
                      if(isset($_GET["param"]) and $_GET["param"] == 1)
                      {
                        include('suivi-bon-etat.php');

                      }elseif(isset($_GET["param"]) and $_GET["param"] == 2)
                      {
                        include('suivi-dispo.php');

                      }elseif(isset($_GET["param"]) and $_GET["param"]==3)
                      {
                        include('suivi-non-dispo.php');

                      }elseif(isset($_GET["param"]) and $_GET["param"] == 4)
                      {
                        include('suivi-panne.php');

                      }elseif(isset($_GET["param"]) and $_GET["param"] == 5)
                      {
                        include('suivi-incomplet.php');

                      }elseif(isset($_GET["param"]) and $_GET["param"] == 6)
                      {
                        include('suivi-hs.php');

                      }else
                      {
                          include('suivi-all.php');
                      }
                  ?>

              </div>
            </section>
          </div>