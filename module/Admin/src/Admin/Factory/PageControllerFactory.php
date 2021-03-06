<?php
namespace Admin\Factory;

 use Admin\Controller\PageController;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;
 
 class PageControllerFactory implements FactoryInterface
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
        return new PageController($em);
     }
 }