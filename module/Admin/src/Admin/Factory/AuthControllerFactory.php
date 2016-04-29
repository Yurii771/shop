<?php
namespace Admin\Factory;

 use Admin\Controller\AuthController;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class AuthControllerFactory implements FactoryInterface
 {
     /**
      * Create service
      *
      * @param ServiceLocatorInterface $serviceLocator
      *
      * @return mixed
      */
     public function createService(ServiceLocatorInterface $serviceLocator)
     {
        $sm = $serviceLocator->getServiceLocator();
        $config = $sm->get('Config');
         return new AuthController($config);
     }
 }