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

//    'router' => array(
//        'routes' => array(
//            'admin' => array(
//                'type'    => 'literal',
//                'options' => array(
//                    'route'    => '/admin',
//                    'defaults' => array(
//						'controller' => 'Admin\Controller\Index',
//                        'action'        => 'index',
//                    ),
//                ),
//				'may_terminate' => true,
//				'child_routes' => array(
//					'category' => array(
//						'type' => 'segment',
//						'options' => array(
//							'route' => '/category[/:action][/:id]',
//							'defaults' => array(
//								'controller' => 'Admin\Controller\Category',
//								'action' => 'index',
//							),
//						),
//					),
//				), //child_routes
//            ),
//        ),
//    ),
    
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/admin[/:controller[/:action[/:id]]]',
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
//                
//                'may_terminate' => true,
//                'child_routes' => array(
//                        'category' => array(
//                                'type' => 'Segment',
//                                'options' => array(
//                                        'route' => '/category[/:action][/:id]',
//                                        'defaults' => array(
//                                                'controller' => 'Admin\Controller\Category',
//                                                'action' => 'index',
//                                        ),
//                                ),
//                        ),
//                ), //child_routes
            ),
        ),
    ),
	
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\Auth' => 'Admin\Controller\AuthController',
            'Admin\Controller\Category' => 'Admin\Controller\CategoryController',
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
);
