<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Entity\User;
use Acme\DemoBundle\Form\UserType;
use Symfony\Component\HttpFoubdation\Response;

class LoginController extends Controller
{
	public function indexAction()
	{



		$mysessionVar=$this->container->get('security.context')->getToken()->getUser();
		\Doctrine\Common\Util\Debug::dump($mysessionVar->getUsername());
		$studentobj = $this->getDoctrine()
			  ->getRepository('AcmeDemoBundle:Student')
			  ->findBy(array('nationalid' => $mysessionVar->getUsername()));

if (!$studentobj) {//staff table
		//throw $this->createNotFoundException('the username is not from table student');
		$staffobj = $this->getDoctrine()
				  ->getRepository('AcmeDemoBundle:Staff')
				  ->findBy(array('nationalid' => $mysessionVar->getUsername()));
		\Doctrine\Common\Util\Debug::dump($mysessionVar->getUsername());
				if($staffobj[0]->getJob()=="مدرس"){

					  	$this->get('session')->set('loginId', $staffobj[0]->getId());
					  	$mystudentid=$this->get('session')->get('loginId');
  		  		\Doctrine\Common\Util\Debug::dump($mystudentid);

					  		return $this->redirect($this->generateUrl('acme_staff_teacherpage'));




				}elseif($staffobj[0]->getJob()=="مدير"){

					  		$this->get('session')->set('loginId', $staffobj[0]->getId());
					  	// 	$mystudentid=$this->get('session')->get('loginId');
  		  		// \Doctrine\Common\Util\Debug::dump($mystudentid);

					  			return $this->redirect($this->generateUrl('acme_staff_mangerpage'));



				}elseif($staffobj[0]->getJob()=="امين مكتبة"){

					  		$this->get('session')->set('loginId', $staffobj[0]->getId());
					  	// 	$mystudentid=$this->get('session')->get('loginId');
  		  		// \Doctrine\Common\Util\Debug::dump($mystudentid);

					  			return $this->redirect($this->generateUrl('acme_staff_librarianpage'));


					
				}



  	}else{//student table

  		$this->get('session')->set('loginId', $studentobj[0]->getId());

  		// $mystudentid=$this->get('session')->get('loginId');
  		//   		\Doctrine\Common\Util\Debug::dump($mystudentid);

	return $this->redirect($this->generateUrl('acme_student_studentpage'));

  		//\Doctrine\Common\Util\Debug::dump($studentobj[0]->getId());

 // throw $this->createNotFoundException('the username  from table student');
	// 	\Doctrine\Common\Util\Debug::dump($studentobj.getId());

  	}
  			
	}
	public function logoutAction()
	{
		$this->get('session')->remove('loginId');

	return $this->redirect($this->generateUrl('_welcome'));



	}
}
