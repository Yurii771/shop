<?php

namespace Guest\Controller;

use Application\Controller\BaseAdminController;
use Guest\Form\SubscriberAddForm;
use Admin\Entity\Subscribers;

/**
 * Description of Subscriber
 *
 * @author 1
 */
class SubscriberController extends BaseAdminController {

//     public function addAction()
//    {
//       $email = trim($_POST["email"]);
//$link= mysqli_connect('localhost', 'root', '', 'shop');
//$query="INSERT INTO subscribers (email) values ('$email')";
//$res= mysqli_query($link, $query);
//    }

	public function addAction() {
		$form = new SubscriberAddForm();
		$status = $message = '';
		$em = $this->getEntityManager();
		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$data = $form->getData();
				$email = $data['email'];
				$subscriber = new Subscribers();
				$subscriber->exchangeArray($data);
				$em->persist($subscriber);
				$em->flush();
				$status = 'success';
				$message = 'Подписка оформлена';
			} else {
				$status = 'error';
				$message = 'Ошибка параметров';
			}
		} else {
			return array('form' => $form);
		}
		if ($message) {
			$this->flashMessenger()
					->setNamespace($status)
					->addMessage($email);
		}
		$recepient = $email;
		$sitename = "petbox.esy.es";
		$message = "Спасибо за подписку!";
		$pagetitle = $sitename;
		mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");
		return false;
	}

}
