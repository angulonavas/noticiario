<?php

namespace AppBundle\Twig;

use AppBundle\Twig\AppRuntime;

class AppExtension extends \Twig_Extension {
    
    public function getFilters() {
        
        return array(        
            new \Twig_SimpleFilter('formato_url', array(AppRuntime::class, 'formatear_urlFilter')),
            new \Twig_SimpleFilter('formato_pseudonimo', array(AppRuntime::class, 'formatear_pseudonimoFilter')),
        );
    }
}