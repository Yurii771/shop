<?php
return array(
    'doctrine' => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'guest_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Guest/Entity',
                ),
            ),
            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Guest\Entity' => 'guest_entity'
                )
            )
        )
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Guest\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'order' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/order',
                    'defaults' => array(
                        'controller' => 'Guest\Controller\Order',
                        'action'     => 'index',
                    ),
                ),
            ),
            'guest' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/guest[/:controller[/:action[/:id]]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Guest\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                ),
            
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'Guest\Controller\Index' => 'Guest\Controller\IndexController',
            'Guest\Controller\Order' => 'Guest\Controller\OrderController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Guest' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'layout/guest'  => __DIR__ . '/../view/layout/guest.phtml',
        ),
    ),
    
    'module_layouts' => array(
        'Guest' => array(
            'default' => 'layout/guest',
        ),
     ),
);
