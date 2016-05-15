<?php

namespace Guest\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Navigation\Navigation as Container;

class Navigation extends AbstractHelper {
    
    protected $plagin_manager;
    protected $router;
    protected $routeMatch;

    public function __construct($pm) {
        $this->plagin_manager = $pm;
        $this->router = $pm->getServiceLocator()->get('Router');
        $this->routeMatch = $pm->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch();
    }
    
    public function __invoke() {
        $navigation = $this->plagin_manager->get('Zend\View\Helper\Navigation');
        $pages = $this->getPages();
        $container = new Container($pages);
        $navigation->setContainer($container);
        return $navigation;
    }
    
    protected function getPages(){
        return array(
            array(
                'label' => 'Главная',
                'router' => $this->router,
                'route' => 'guest',
                'controller' => 'index',
                'action' => 'index',
                'routeMatch' => $this->routeMatch,
            ),
            array(
                'label' => 'Каталог',
                'router' => $this->router,
                'route' => 'guest',
                'controller' => 'category',
                'pages' => $this->getChildPages(),
                'routeMatch' => $this->routeMatch,
            ),
            array(
                'label' => 'Оплата и доставка',
                'router' => $this->router,
                'route' => 'guest',
                'controller' => 'payment',
                'routeMatch' => $this->routeMatch,
            ),
            array(
                'label' => 'О нас',
                'router' => $this->router,
                'route' => 'guest',
                'controller' => 'about',
                'routeMatch' => $this->routeMatch,
            ),
            array(
                'label' => 'Контакты',
                'router' => $this->router,
                'route' => 'guest',
                'controller' => 'contacts',
                'routeMatch' => $this->routeMatch,
            ),
        );
    }
    
    protected function getChildPages(){
        $pages = array();
        $categories = $this->getEntities('Categories');
        $goods = $this->getEntities('Goods');
        
        $parents = array();
        $children = array();
        foreach ($categories as $category){
            if($category->getParent()){
                $children[] = $category;
            }else{
                $parents[] = $category;
            }
        }
        
        foreach ($parents as $item){
            $pages[] = $this->getPage($item, 'goods', 'index');
        }
        
        foreach ($children as $item){
            for ($i=0; $i<count($pages); $i++){
                if($item->getParent()->getId() == $pages[$i]['params']['id']){
                    $pages[$i]['pages'][] = $this->getPage($item, 'goods', 'index');
                    break;
                }
            }
        }
        
        foreach ($goods as $item){
            for ($i=0; $i<count($pages); $i++){
                if($item->getCategory()->getId() == $pages[$i]['params']['id']){
                    $pages[$i]['pages'][] = $this->getPage($item, 'goods', 'view');
                    break;
                }elseif ( isset($pages[$i]['pages'])) {
                    for($j=0; $j< count($pages[$i]['pages']); $j++){
                        if($item->getCategory()->getId() == $pages[$i]['pages'][$j]['params']['id'] &&
                            $pages[$i]['pages'][$j]['action'] == 'index'
                        ){
                            $pages[$i]['pages'][$j]['pages'][] = $this->getPage($item, 'goods', 'view');
                        }
                    }
                }
            }
        }
        
        return $pages;
    }
    
    protected function getEntities($entity) {
        $em = $this->plagin_manager->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $query = $em->createQuery('SELECT u FROM Admin\Entity\\'.$entity.' u ORDER BY u.id');
        return $query->getResult();
    }
    
    protected function getPage($item, $controller, $action){
        return array(
            'label' => $item->getName(),
            'router' => $this->router,
            'route' => 'guest',
            'controller' => $controller,
            'action' => $action,
            'routeMatch' => $this->routeMatch,
            'params' => array(
                'id' => (int)$item->getId(),
            ),
        );
    }
    
}
