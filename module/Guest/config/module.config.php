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
        ),
        'factories' => array(
            'Guest\Controller\Cart' => 'Guest\Factory\CartControllerFactory',
			'Guest\Controller\Category' => 'Guest\Factory\CategoryControllerFactory',
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
