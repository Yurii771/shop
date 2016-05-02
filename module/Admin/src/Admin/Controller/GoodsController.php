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
        $query = $this->_objectManager->createQuery('SELECT u FROM Admin\Entity\Categories u ORDER BY u.id');
        $rows = $query->getResult();
        $goods = $this->_objectManager->getRepository('\Admin\Entity\Goods')->findAll();
        return new ViewModel(array('goods' => $goods,'categories'=>$rows));
    }


    public function addAction()
    {

      $query = $this->_objectManager->createQuery('SELECT u FROM Admin\Entity\Categories u ORDER BY u.id');
      $rows = $query->getResult();

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
        return new ViewModel(['categories'=>$rows]);
    }


    public function editAction()
    {
      $query = $this->_objectManager->createQuery('SELECT u FROM Admin\Entity\Categories u ORDER BY u.id');
      $rows = $query->getResult();

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


        return new ViewModel(array('goods' => $goods,'categories'=>$rows,'goodsList'=>$list));
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

}
