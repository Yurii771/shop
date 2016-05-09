<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Entity\Goods;

class GoodsController extends AbstractActionController
{
    protected $_objectManager;
    
    public function __construct($em) {
        $this->_objectManager = $em;
    }

    public function indexAction()
    {
        $goods = $this->_objectManager->getRepository('\Admin\Entity\Goods')->findAll();
        return new ViewModel(array('goods' => $goods,));
    }


    public function addAction()
    {

      $query = $this->_objectManager->createQuery('SELECT u FROM Admin\Entity\Categories u ORDER BY u.id');
      $rows = $query->getResult();
      $categories = $this->sortCategories($rows);

        if ($this->request->isPost()) {
            $goods = new Goods();

            $goods->setName($this->getRequest()->getPost('name'));
            $goods->setShortDescription($this->getRequest()->getPost('short_description'));
            $goods->setDescription($this->getRequest()->getPost('description'));
            $goods->setCost($this->getRequest()->getPost('cost'));
            $goods->setCount($this->getRequest()->getPost('count'));

            $goods->setPhoto($this->getRequest()->getPost('photo'));

            $category_id = $this->getRequest()->getPost('category');
            $category =  $this->_objectManager->find('\Admin\Entity\Categories', $category_id);
            $goods->setCategory($category);

            $this->_objectManager->persist($goods);
            $this->_objectManager->flush();
            $newId = $goods->getId();

            return $this->redirect()->toRoute('admin', array(
                'controller' => 'goods',
                'action' =>  'index',
            ));
        }
        return new ViewModel(['categories'=>$categories]);
    }


    public function editAction()
    {
      $query = $this->_objectManager->createQuery('SELECT u FROM Admin\Entity\Categories u ORDER BY u.id');
      $rows = $query->getResult();
      $categories = $this->sortCategories($rows);

        $goodsList = $this->_objectManager->createQuery('SELECT u FROM Admin\Entity\Goods u ORDER BY u.id');
        $list=$goodsList->getResult();
        $id = (int) $this->params()->fromRoute('id', 0);
        $goods = $this->_objectManager->find('\Admin\Entity\Goods', $id);

        if ($this->request->isPost()) {
            $goods->setName($this->getRequest()->getPost('name'));
            $goods->setShortDescription($this->getRequest()->getPost('short_description'));
            $goods->setDescription($this->getRequest()->getPost('description'));
            $goods->setCost($this->getRequest()->getPost('cost'));
            $goods->setCount($this->getRequest()->getPost('count'));

            $goods->setPhoto($this->getRequest()->getPost('photo'));

            $category_id = $this->getRequest()->getPost('category');
            $category =  $this->_objectManager->find('\Admin\Entity\Categories', $category_id);
            $goods->setCategory($category);


            $this->_objectManager->persist($goods);
            $this->_objectManager->flush();

            return $this->redirect()->toRoute('admin', array(
                'controller' => 'goods',
                'action' =>  'index',
            ));
        }


        return new ViewModel(array('goods' => $goods,'categories'=>$categories,'goodsList'=>$list));
    }


    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $goods = $this->_objectManager->find('\Admin\Entity\Goods', $id);

        if ($this->request->isPost()) {
            $this->_objectManager->remove($goods);
            $this->_objectManager->flush();

            return $this->redirect()->toRoute('admin');
        }

        return new ViewModel(array('goods' => $goods));
    }
    
    protected function sortCategories($rows) {
        $categories = array();
        foreach ($rows as $row){
            if(!$row->getParent()){
                $categories[$row->getId()]['parent'] = $row;
                if(!isset($categories[$row->getId()]['children'])){
                    $categories[$row->getId()]['children'] = array();
                }
            }else{
                $categories[$row->getParent()->getId()]['children'][] = $row;
            }
        }
        return $categories;
    }

}
