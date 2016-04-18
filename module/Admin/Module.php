<?php

namespace Admin;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Permissions\Acl\Acl;
use Admin\Resource\Resource;
use Zend\Session\Container;

class Module implements AutoloaderProviderInterface
{
    protected $acl;

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
    
    public function onBootstrap($e) {
        $this->initAcl($e);
        
        $e  ->getApplication()
            ->getEventManager()
            ->attach(
                'route', array($this, 'checkAccess')
            );
    }
    
    public function checkAccess($e) {
        $controller = $e->getRouteMatch()->getParam('controller');
        $action = $e->getRouteMatch()->getParam('action');
        $session = new Container('admin');
        $role = (isset($session->user))? $session->user: 'guest';
        $access = FALSE;
        
        if($controller !== 'Admin\Controller\Auth'){
            $controller = explode('\\', $controller)[0];
        }
        if($this->acl->hasResource($controller)){
            $access = $this->acl->isAllowed($role, $controller, $action);
        }
        
        if(!$access){
            if($role === 'guest'){
                $e->getRouteMatch()->setParam('controller', 'Admin\Controller\Auth');
                $e->getRouteMatch()->setParam('action', 'toAuth');
            }elseif ($role === 'admin') {
                $e->getRouteMatch()->setParam('controller', 'Admin\Controller\Auth');
                $e->getRouteMatch()->setParam('action', 'toAdmin');
            }
        }
    }
    
    public function initAcl($e) {
        $this->acl = new Acl();
        $config = $e    ->getApplication()
                        ->getServiceManager()
                        ->get('Config');
        $params = $config['admin_guard'];
        $rule_names = array('allow', 'deny');
        foreach ($rule_names as $rule_name){
            if(array_key_exists($rule_name, $params)){
                $rules = $params[$rule_name];
                foreach ($rules as $rule) {
                    $roles = $rule[0];
                    $resource = isset($rule[1])? $rule[1]: NULL;
                    $privilege = isset($rule[2])? $rule[2]: NULL;
                    foreach ($roles as $role) {
                        if(!$this->acl->hasRole($role)){
                            $this->acl->addRole($role);
                        }
                        if(!$this->acl->hasResource($resource)){
                            $resource_entity = new Resource($resource);
                            $this->acl->addResource($resource_entity);
                        }
                        $this->acl->$rule_name($role, $resource, $privilege);
                    }
                }
            }
        }
    }
}
