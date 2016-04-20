<?php
namespace EdpModuleLayouts;

class Module
{
    public function onBootstrap($e)
    {
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
            $controller      = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            
            $config          = $e->getApplication()->getServiceManager()->get('config');

            $routeMatch = $e->getRouteMatch();
            $actionName = strtolower($routeMatch->getParam('action', 'not-found')); // get the action name
            $controllerName = $routeMatch->getParam('controller', 'not-found'); // get the controller name
            
            if (isset($config['module_layouts'][$moduleNamespace][$controllerName])) {
                if (isset($config['module_layouts'][$moduleNamespace][$controllerName][$actionName])) {
                    $controller->layout($config['module_layouts'][$moduleNamespace][$controllerName][$actionName]);
                }elseif(isset($config['module_layouts'][$moduleNamespace][$controllerName]['default'])) {
                    $controller->layout($config['module_layouts'][$moduleNamespace][$controllerName]['default']);
                }
            }elseif(isset($config['module_layouts'][$moduleNamespace]['default'])){
                $controller->layout($config['module_layouts'][$moduleNamespace]['default']);
            }


        }, 100);
    }
}
