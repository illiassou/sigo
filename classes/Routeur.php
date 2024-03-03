<?php

/**Class Routur
 * Permet de definir les routes
 */
class Routeur
{
    private $request;
    private $routes= [ 
        

                    "loginPage/"                  => ["controller" => "Controller" , "method" => "ShowLoginPage"],
                    "login/"                      => ["controller" => "Controller" , "method" => "ShowLogin"],
                    "code"                       => ["controller" => "Controller" , "method" => "ShowCode"],
                    "menu"                        => ["controller" => "Controller" , "method" => "ShowMenu"],
                    "Repertoire"                  => ["controller" => "Controller" , "method" => "ShowRepertoire"],
                    "Nouveau-outil"               => ["controller" => "Controller" , "method" => "ShowNouveauOutil"],
                    "add-info"                    => ["controller" => "Controller" , "method" => "ShowAN"],
                    "add-info-2"                  => ["controller" => "Controller" , "method" => "ShowAN2"],
                    "add-emplacement"             => ["controller" => "Controller" , "method" => "ShowAE"],
                    "add-identification"          => ["controller" => "Controller" , "method" => "ShowAI"],
                    "add-position"                => ["controller" => "Controller" , "method" => "ShowAP"],
                    "composant-add"               => ["controller" => "Controller" , "method" => "ShowAC"],
                    "charger-position"            => ["controller" => "Controller" , "method" => "ShowCP"],
                    "charger-reference"           => ["controller" => "Controller" , "method" => "ShowCR"],
                    "suivi-outil"                 => ["controller" => "Controller" , "method" => "ShowSO"],
                    "detail"                      => ["controller" => "Controller" , "method" => "ShowDO"],
                    "outil-hs"                    => ["controller" => "Controller" , "method" => "ShowOH"],
                    "sortie-outil"                => ["controller" => "Controller" , "method" => "ShowSortieOutil"],
                    "recherche-outil"             => ["controller" => "Controller" , "method" => "ShowRechercheOutil"],
                    "add-outil-sortie"            => ["controller" => "Controller" , "method" => "ShowAddOS"],
                    "recherche-agent"             => ["controller" => "Controller" , "method" => "ShowRAgent"],
                    "filtre-suivi"                => ["controller" => "Controller" , "method" => "ShowFiltreS"],
                    "historique-sortie"           => ["controller" => "Controller" , "method" => "ShowHSO"],
                    "retour-outil"                => ["controller" => "Controller" , "method" => "ShowRO"],
                    "recherche-outil-retour"      => ["controller" => "Controller" , "method" => "ShowROR"],
                    "add-retour"                  => ["controller" => "Controller" , "method" => "ShowART"],

                       
                                   ];
                    
    public function __construct($request)
    {
        $this->request=$request;
    }

    public function renderController()
    {
        $request = $this->request;

        if(key_exists($request,$this->routes))
        {
            $controller = $this->routes[$request]['controller'];
            $method = $this->routes[$request]['method'];
            $currentController = new $controller();
            $currentController->$method();

        }else 
        {
             echo "404";
        }
    }
}
