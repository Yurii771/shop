<?php

namespace Admin\Controller;


use Zend\Db\Adapter\AdapterInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Entity\Goods;
use Doctrine\ORM\EntityManager;



class GoodsController extends AbstractActionController
{
    protected $_objectManager;

    public function indexAction()
    {
        $query = $this->getObjectManager()->createQuery('SELECT u FROM Admin\Entity\Categories u ORDER BY u.id');
        $rows = $query->getResult();
        $goods = $this->getObjectManager()->getRepository('\Admin\Entity\Goods')->findAll();
        return new ViewModel(array('goods' => $goods,'categories'=>$rows));
    }


    public function addAction()
    {

      $query = $this->getObjectManager()->createQuery('SELECT u FROM Admin\Entity\Categories u ORDER BY u.id');
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
            $category =  $this->getObjectManager()->find('\Admin\Entity\Categories', $category_id);
            $goods->setCategory($category);

            $this->getObjectManager()->persist($goods);
            $this->getObjectManager()->flush();
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
      $query = $this->getObjectManager()->createQuery('SELECT u FROM Admin\Entity\Categories u ORDER BY u.id');
      $rows = $query->getResult();

        $goodsList = $this->getObjectManager()->createQuery('SELECT u FROM Admin\Entity\Goods u ORDER BY u.id');
        $list=$goodsList->getResult();
        $id = (int) $this->params()->fromRoute('id', 0);
        $goods = $this->getObjectManager()->find('\Admin\Entity\Goods', $id);

        if ($this->request->isPost()) {
            $goods->setName($this->getRequest()->getPost('name'));
            $goods->setShortDescription($this->getRequest()->getPost('short_description'));
            $goods->setDescription($this->getRequest()->getPost('description'));
            $goods->setCost($this->getRequest()->getPost('cost'));
            $goods->setCount($this->getRequest()->getPost('count'));

            $goods->setPhoto($this->getRequest()->getPost('photo'));

            $category_id = $this->getRequest()->getPost('category');
            $category =  $this->getObjectManager()->find('\Admin\Entity\Categories', $category_id);
            $goods->setCategory($category);


            $this->getObjectManager()->persist($goods);
            $this->getObjectManager()->flush();

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
        $goods = $this->getObjectManager()->find('\Admin\Entity\Goods', $id);

        if ($this->request->isPost()) {
            $this->getObjectManager()->remove($goods);
            $this->getObjectManager()->flush();

            return $this->redirect()->toRoute('admin');
        }

        return new ViewModel(array('goods' => $goods));
    }



    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }

}
