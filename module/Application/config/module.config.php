<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
            'Zend\Navigation\Service\NavigationAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => Controller\IndexController::class
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/guest.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    
    'navigation' => array(
        'guest' => array(
            array(
                'label' => 'Главная',
                'route' => 'guest',
                'controller' => 'index',
            ),
            array(
                'label' => 'Каталог',
                'route' => 'guest',
                'controller' => 'category',
                'pages' => array(
                    array(
                        'label' => 'Стегозавры',
                        'route' => 'guest',
                        'controller' => 'goods',
                        'action' => 'index',
                        'params' => array(
                            'id' => 1,
                        ),
                    ),
                    array(
                        'label' => 'Яйца динозавров',
                        'route' => 'guest',
                        'controller' => 'goods',
                        'action' => 'index',
                        'params' => array(
                            'id' => 7,
                        ),
                    ),
                ),
            ),
            array(
                'label' => 'Оплата и доставка',
                'route' => 'guest',
                'controller' => 'payment',
            ),
            array(
                'label' => 'О нас',
                'route' => 'guest',
                'controller' => 'about',
            ),
            array(
                'label' => 'Контакты',
                'route' => 'guest',
                'controller' => 'contacts',
            ),
        ),
        'admin_left' => array(
            array(
                'label' => 'Кабинет',
                'route' => 'admin',
                'controller' => 'index',
            ),
            array(
                'label' => 'Категории',
                'route' => 'admin',
                'controller' => 'category',
            ),
            array(
                'label' => 'Товары',
                'route' => 'admin',
                'controller' => 'goods',
            ),
            array(
                'label' => 'Заказы',
                'route' => 'admin',
                'controller' => 'order',
            ),
            array(
                'label' => 'Главная страница',
                'route' => 'admin',
                'controller' => 'page',
            ),
        ),
        'admin_right' => array(
            array(
                'label' => 'На сайт',
                'route' => 'guest',
                'controller' => 'index',
            ),
            array(
                'label' => 'Выйти',
                'route' => 'admin',
                'controller' => 'auth',
                'action' => 'logout',
            ),
        ),
    ),
);
