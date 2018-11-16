<?php 

namespace AppBundle\Twig;

class AppRuntime {
    
    public function __construct() {
        // this simple example doesn't define any dependency, but in your own
        // extensions, you'll need to inject services using this constructor
    }

    public function formatear_urlFilter($texto) {
        $url = str_replace(" ", "-", $texto);
        return $url;
    }    

    public function formatear_pseudonimoFilter($texto) {
        $pseudonimo = str_replace("@", "", $texto);
        return $pseudonimo;
    }    

}