<?php
namespace EdpModuleLayouts;

use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap($e)
    {
        $e->getApplication()->getEventManager()->getSharedManager()
            ->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
                $this->setLayout($e);
        }, 100);
        
        $e->getApplication()->getEventManager()
            ->attach(MvcEvent::EVENT_DISPATCH_ERROR, function($e) {
                $this->setLayout($e);
        }, -200);
    }
    
    private function setLayout($e){
        $controller      = $e->getTarget();
        $controllerClass = get_class($controller);
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        $config          = $e->getApplication()->getServiceManager()->get('config');
        $routeMatch = $e->getRouteMatch();
        $actionName = strtolower($routeMatch->getParam('action', 'not-found')); // get the action name
        $controllerName = $routeMatch->getParam('controller', 'not-found'); // get the controller name
        $layout = '';
        if($controllerClass === 'Zend\Mvc\Application'){
            $moduleNamespace = explode('\\', $controllerName)[0];
        }
        if (isset($config['module_layouts'][$moduleNamespace][$controllerName])) {
            if (isset($config['module_layouts'][$moduleNamespace][$controllerName][$actionName])) {
                $layout = $config['module_layouts'][$moduleNamespace][$controllerName][$actionName];
            }elseif(isset($config['module_layouts'][$moduleNamespace][$controllerName]['default'])) {
                $layout = $config['module_layouts'][$moduleNamespace][$controllerName]['default'];
            }
        }elseif(isset($config['module_layouts'][$moduleNamespace]['default'])){
            $layout = $config['module_layouts'][$moduleNamespace]['default'];
        }
        $viewModel = $e->getViewModel();
        $viewModel->setTemplate($layout);
    }
}
