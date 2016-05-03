<?php
return array(
    'doctrine' => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'admin_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Admin/Entity',
                ),
            ),
            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Admin\Entity' => 'admin_entity'
                )
            )
        )
    ),

    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route' => '/admin[/:controller[/:action[/:id]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
	
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
        ),
        'factories' => array(
            'Admin\Controller\Auth' => 'Admin\Factory\AuthControllerFactory',
            'Admin\Controller\Category' => 'Admin\Factory\CategoryControllerFactory',
			'Admin\Controller\Page' => 'Admin\Factory\PageControllerFactory',
        ),
    ),
	
    'view_manager' => array(
        'template_path_stack' => array(
            'Admin' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'layout/auth'  => __DIR__ . '/../view/layout/auth.phtml',
            'layout/admin'  => __DIR__ . '/../view/layout/admin.phtml',
        ),
    ),
    
    'module_layouts' => array(
        'Admin' => array(
            'Admin\Controller\Auth'  => array(
                'index' => 'layout/auth',
                'default' => 'layout/admin',
            ),
            'default' => 'layout/admin',
        ),
     ),
    
    'admin_guard' => array(
        'allow' => array(
            array(array('admin', 'guest'), 'Guest'),
            array(array('admin'), 'Admin'),
            array(array('admin'), 'Admin\Controller\Auth', 'logout'),
            array(array('guest'), 'Admin\Controller\Auth', 'index'),
        ),
        'deny' => array(
            array(array('guest'), 'Admin'),
            array(array('admin','guest'), 'Admin\Controller\Auth'),
        ),
        'admin_name_hash' => '$2y$10$h3UP2FK0r3DOdZyQDksPv.Qkcp6szX9C0lGh8DnA4PDA0Y3vtg0/q', //'admin'
        'admin_password_hash' => '$2y$10$FacpCw6CVAw/FYKBkL/.AuXYFwVICQhVXKaL8WW9aU6PR4WgpLdR2', //'test'
    ),
);
