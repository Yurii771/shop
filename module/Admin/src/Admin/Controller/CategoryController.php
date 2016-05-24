<?php

namespace Admin\Controller;

use Application\Controller\BaseAdminController as BaseController;
use Admin\Form\CategoryAddForm;
use Admin\Entity\Categories;

class CategoryController extends BaseController
{
    public function __construct($em) {
        $this->_entityManager = $em;
    }
    
    public function indexAction()
    {
        $query = $this->getEntityManager()->createQuery('SELECT u FROM Admin\Entity\Categories u ORDER BY u.id');
        $rows = $query->getResult();
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
        uasort($categories, function($a, $b){
            return ( count($a['children']) > count($b['children']) )? 1: -1;
        });
        return array('categories' => $categories);
    }
	
    public function addAction()
    {
        $form = new CategoryAddForm();
        $form->get('parent')->setValueOptions($this->getParents());
        $status = $message = '';
        $em = $this->getEntityManager();
        $request = $this->getRequest();
        if($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
                $category = new Categories();
                $data = $form->getData();
                $parent = $em->find('Admin\Entity\Categories', intval($data['parent']));
                $data['parent'] = $parent;
                $category->exchangeArray($data);
                $em->persist($category);
                $em->flush();
                $status = 'success';
                $message = 'Категория добавлена';
            }else{
                var_dump($form->get('parent')); die();
                $status = 'error';
                $message = 'Ошибка параметров';
            }
        }else{
            return array('form' => $form);
        }
        if($message){
            $this->flashMessenger()
                    ->setNamespace($status)
                    ->addMessage($message);
        }

        return $this->redirect()->toRoute('admin', array('controller' => 'category'));
    }

    public function editAction()
    {
        $form = new CategoryAddForm();
        $status = $message = '';
        $em = $this->getEntityManager();
        $id = (int) $this->params()->fromRoute('id', 0);
        $category = $em->find('Admin\Entity\Categories', $id);
        if(empty($category)){
            $message = 'Category not found!';
            $status = 'error';
            $this->flashMessenger()
                            ->setNamespace($status)
                            ->addMessage($message);
            return $this->redirect()->toRoute('admin', array('controller' => 'category'));
        }
        $request = $this->getRequest();
        $parents = $this->getParents();
        if(array_key_exists($id, $parents) && !($request->isPost())){
            unset($parents[$id]);
        }
        $form->bind($category);
        $form->get('parent')->setValueOptions($parents);
        if($form->get('parent')->getValue()){
            $form->get('parent')->setValue($form->get('parent')->getValue()->getId());
        }
        if($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
                $data = $form->getData();
                $parent = $em->find('Admin\Entity\Categories', intval($data->getParent()));
                $data->setParent($parent);
                $category->exchangeArray($data);
                $em->persist($category);
                $em->flush();
                $status = 'success';
                $message = 'Категория обновлена';
            }else{
                $status = 'error';
                $message = 'Ошибка параметров';
            }
        }else{
            return array('form' => $form, 'id' => $id);
        }
        if($message){
            $this->flashMessenger()
                    ->setNamespace($status)
                    ->addMessage($message);
        }
        return $this->redirect()->toRoute('admin', array('controller' => 'category'));
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id');
        $em = $this->getEntityManager();
        $status = 'Success!';
        $message = 'Категория удалена';
        try{
                $repository = $em->getRepository('Admin\Entity\Categories');
                $category = $repository->find($id);
                $em->remove($category);
                $em->flush();
        } catch (\Exception $ex) {
                $status = 'error';
                $message = 'Ошибка удаления категории: ' . $ex->getMessage();
        }
        $this->flashMessenger()
                                ->setNamespace($status)
                                ->addMessage($message);
        return $this->redirect()->toRoute('admin', array('controller' => 'category'));
    }
    
    protected function getParents() {
        $query = $this->getEntityManager()->createQuery(
                'SELECT u FROM Admin\Entity\Categories u '
                . 'WHERE u.parent IS NULL ORDER BY u.id'
                );
        $parents = $query->getResult();
        $options = array(
            '0' => 'Создать как главную категорию',
        );
        foreach ($parents as $item){
            $options[$item->getId()] = $item->getName();
        }
        return $options;
    }
	
}
