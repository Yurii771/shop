<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;

class AuthController extends AbstractActionController
{
    private $config;
    
    public function __construct($conf) {
        $this->config = $conf;
    }
    
    public function indexAction() {
        if($this->request->isPost()){
            $data = $this->request->getPost();
            
            if(isset($data['adm_pwd']) && isset($this->config['admin_guard']['admin_password_hash'])){
                $hash_pwd = $this->config['admin_guard']['admin_password_hash'];
                $hash_name = $this->config['admin_guard']['admin_name_hash'];
                if(password_verify($data['adm_pwd'], $hash_pwd) && password_verify($data['adm_name'], $hash_name)){
                    $session = new Container('admin');
                    $session->user = 'admin';
                    $this->toAdminAction();
                }else{
                    $this->flashMessenger()
                            ->addErrorMessage('Введены неверное имя или пароль');
                    $this->toAuthAction();
                }
            }
        }
        return array();
    }
    
    public function logoutAction() {
        $session = new Container('admin');
        if(isset($session->user)){
            unset($session->user);
        }
        $this->toAuthAction();
    }
    
    public function toAuthAction() {
        $this->redirect()->toRoute('admin', array('controller'=>'auth'));
    }
    
    public function toAdminAction() {
        $this->redirect()->toRoute('admin', array('controller'=>'index'));
    }
    
}