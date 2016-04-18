<?php

namespace Admin\Controller;

use Application\Controller\BaseAdminController as BaseController;
use Admin\Form\CategoryAddForm;
use Admin\Entity\Categories;

class CategoryController extends BaseController
{
    public function indexAction()
    {
        //$em = $this->getEntityManager();
		$query = $this->getEntityManager()->createQuery('SELECT u FROM Admin\Entity\Categories u ORDER BY u.id');
		$rows = $query->getResult();
		return array('categories' => $rows);
    }
	
	public function addIndex()
	{
		$form = new CategoryAddForm();
		$status = $message = '';
		$em = $this->getEntityManager();
		$request = $this->getRequest();
		if($request->isPost()){
			$form->setData($request->getPost());
			if($form->isValid()){
				$category = new Categories();
				$category->exchangeArray($form->getData());
				$em->persist($category);
				$em->flush();
				$status = 'success';
				$message = 'Категория добавлена';
			}else{
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
		
		return $this->redirect()->toRoute('admin/category');
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
			return $this->redirect()->toRoute('admin/category');
		}
		$form->bind($category);
		$request = $this->getRequest();
		if($request->isPost()){
			$form->setData($request->getPost());
			if($form->isValid()){
				$em->persist($category);
				$em->flush();
				$status = 'success';
				$message = 'Категория обновлена';
			}else{
				$status = 'error';
				$message = 'Ошибка параметров';
				foreach ($form->getInputFilter()->getInvalidInput() as $errors){
					foreach ($errors->getMessages() as $error){
						$message .= ' ' . $error;
					}
				}
			}
		}else{
			return array('form' => $form, 'id' => $id);
		}
	}
	
	public function deleteAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
		$em = $this->getEntityManager();
		$status = 'Success!';
		$message = 'Категория удалена';
		try{
			$repository = $em->getRepository('Admin\Entity\Categories');
			$category = $repository->find($id);
			$em->remove($category);
			$em->fllush();
		} catch (\Exception $ex) {
			$status = 'error';
			$message = 'Ошибка удаления категории: ' . $ex->getMessage();
		}
		$this->flashMessenger()
					->setNamespace($status)
					->addMessage($message);
		return $this->redirect()->toRoute('admin/category');
	}
	
}
