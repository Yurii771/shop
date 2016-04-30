<?php
return array(
    'router' => array(
        'routes' => array(
            'guest' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/[:controller[/:action[/:id]]]',
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
            'Guest\Controller\Payment' => 'Guest\Controller\PaymentController',
            'Guest\Controller\Goods' => 'Guest\Controller\GoodsController',
        ),
        'factories' => array(
            'Guest\Controller\Category' => 'Guest\Factory\CategoryControllerFactory',
            'Guest\Controller\Order' => 'Guest\Factory\OrderControllerFactory',
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
