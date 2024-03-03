<?php
if(isset($_GET['r'])){

    if($_GET['r'] == 'Nouveau-outil' or $_GET['r'] == 'Repertoire' or $_GET['r'] == 'suivi-outil' 
        or $_GET['r'] == 'outil-hs' or $_GET['r'] == 'inventaire' or $_GET['r'] == 'detail')
    {
      $active = 'active_go'; 
    }
    else if($_GET['r'] == 'sortie-outil' or $_GET['r'] == 'retour-outil' or $_GET['r'] == 'historique-sortie')
    {
      $active = 'active_es';
    }
    else
    {
      $active = 'active_tb';
    }

}else
{
  $active = 'active_tb';
}

?>
<div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="img/user_image.png" class="img" width="50"></a></p>
          <h5 class="centered">Nom d'utilisateur</h5>
          <li class="mt">
            <a class="<?php if($active == 'active_tb'){echo "active";}?>" href="menu">
              <i class="fa fa-dashboard"></i>
              <span>Tableau de bord</span>
              </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="<?php if($active == 'active_go'){echo "active";}?>">
              <i class="fa fa-cogs"></i>
              <span>Gestion des outils</span>
              </a>
            <ul class="sub">
              <li><a href="Nouveau-outil">Nouveau outil</a></li>
              <li><a href="Repertoire">Répertoire</a></li>
              <li><a href="suivi-outil">Suivi</a></li>
              <li><a href="outil-hs">Outils HS</a></li>
              <li><a href="inventaire">Inventaires</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="<?php if($active == 'active_es'){echo "active";}?>">
              <i class="fa fa-exchange"></i>
              <span>Gestion des entrées-Sorties</span>
              </a>
            <ul class="sub">
              <li><a href="sortie-outil">Sortie outil</a></li>
              <li><a href="retour-outil">Retour outil</a></li>
              <li><a href="historique-sortie">Historique</a></li>
            </ul>
          </li>
          <!--
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-book"></i>
              <span>Extra Pages</span>
              </a>
            <ul class="sub">
              <li><a href="blank.html">Blank Page</a></li>
              <li><a href="login.html">Login</a></li>
              <li><a href="lock_screen.html">Lock Screen</a></li>
              <li><a href="profile.html">Profile</a></li>
              <li><a href="invoice.html">Invoice</a></li>
              <li><a href="pricing_table.html">Pricing Table</a></li>
              <li><a href="faq.html">FAQ</a></li>
              <li><a href="404.html">404 Error</a></li>
              <li><a href="500.html">500 Error</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-tasks"></i>
              <span>Forms</span>
              </a>
            <ul class="sub">
              <li><a href="form_component.html">Form Components</a></li>
              <li><a href="advanced_form_components.html">Advanced Components</a></li>
              <li><a href="form_validation.html">Form Validation</a></li>
              <li><a href="contactform.html">Contact Form</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-th"></i>
              <span>Data Tables</span>
              </a>
            <ul class="sub">
              <li><a href="basic_table.html">Basic Table</a></li>
              <li><a href="responsive_table.html">Responsive Table</a></li>
              <li><a href="advanced_table.html">Advanced Table</a></li>
            </ul>
          </li>
          <li>
            <a href="inbox.html">
              <i class="fa fa-envelope"></i>
              <span>Mail </span>
              <span class="label label-theme pull-right mail-info">2</span>
              </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class=" fa fa-bar-chart-o"></i>
              <span>Charts</span>
              </a>
            <ul class="sub">
              <li><a href="morris.html">Morris</a></li>
              <li><a href="chartjs.html">Chartjs</a></li>
              <li><a href="flot_chart.html">Flot Charts</a></li>
              <li><a href="xchart.html">xChart</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-comments-o"></i>
              <span>Chat Room</span>
              </a>
            <ul class="sub">
              <li><a href="lobby.html">Lobby</a></li>
              <li><a href="chat_room.html"> Chat Room</a></li>
            </ul>
          </li>
          <li>
            <a href="google_maps.html">
              <i class="fa fa-map-marker"></i>
              <span>Google Maps </span>
              </a>
          </li>
        </ul> -->
        <!-- sidebar menu end-->
      </div>
     