<?php

class View
{
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }


    public function render($params = array())
    {
        extract($params);
        $template=$this->template;
        ob_start();
        include_once(VIEW.$template.'.php');

        $contentPage = ob_get_clean(); 
        include_once(VIEW.'menu.php');
    }


    public function render_v($params = array())
    {
        extract($params);
        $template=$this->template;
        ob_start();
        include_once(VIEW.$template.'.php');

        $contentPage = ob_get_clean(); 
        include_once(VIEW.'menu-vendeur.php');
    }
    
    public function render_Page($params = array())
    {
        extract($params);
        $template=$this->template;
        ob_start();
        include_once(VIEW.$template.'.php');
        $contentPage= ob_get_clean(); 
        include_once(VIEW.'page-login.php');
    }

      public function render_Page_c($params = array())
    {
        extract($params);
        $template=$this->template;
        ob_start();
        include_once(VIEW.$template.'.php');
        $contentPage= ob_get_clean(); 
        include_once(VIEW.'confirmation.php');
    }

    public function render_Gabari($params = array())
    {
        extract($params);
        $template=$this->template;
        ob_start();
        include_once(VIEW.$template.'.php');
        $contentPage= ob_get_clean(); 
        include_once(VIEW.'gabari.php');
    }
   
    }