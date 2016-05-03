<?php
namespace Guest\Factory;

 use Guest\Controller\IndexController;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class IndexControllerFactory implements FactoryInterface
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
        $em = $sm->get('Doctrine\ORM\EntityManager');
         return new IndexController($em);
     }
 }