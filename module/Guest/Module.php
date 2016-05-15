<?php

namespace Guest;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\View\HelperPluginManager;
use Guest\View\Helper\Navigation;

class Module implements AutoloaderProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'guest_navigation' => function(HelperPluginManager $pm){
                    $navigation = new Navigation($pm);
                    return $navigation;
                }
            ),
        );
    }
}
