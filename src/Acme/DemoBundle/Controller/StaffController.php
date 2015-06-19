<?php

namespace Acme\DemoBundle\Controller;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

use Acme\DemoBundle\Entity\Staff;
use Acme\DemoBundle\Entity\Login;
use Acme\DemoBundle\Entity\Studentclass;
use Acme\DemoBundle\Entity\Staffandclass;

use Acme\DemoBundle\Entity\Staffphone;
use Acme\DemoBundle\Entity\Job;
use Acme\DemoBundle\Form\StaffType;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class StaffController extends Controller
{

	public function teacherpageAction()
{

	$mysessionid=$this->get('session')->get('loginId');


	$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
		 			// \Doctrine\Common\Util\Debug::dump($myteacher->getId());

$teacherdata= $this->getDoctrine()
        ->getRepository('AcmeDemoBundle:Staff')
        ->findBy(
    array('id' =>$myteacher->getId()));

  if (!$teacherdata) {
    throw $this->createNotFoundException('No notes found');
  }

  $build['staff_item'] = $teacherdata;
return $this->render('AcmeDemoBundle:Staff:teacherpage.html.twig', $build);
}
///////////////////////////////////////////////////////////
public function librarianpageAction()
{

	$mysessionid=$this->get('session')->get('loginId');


	$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
		 			// \Doctrine\Common\Util\Debug::dump($myteacher->getId());

$teacherdata= $this->getDoctrine()
        ->getRepository('AcmeDemoBundle:Staff')
        ->findBy(
    array('id' =>$myteacher->getId()));

  if (!$teacherdata) {
    throw $this->createNotFoundException('No notes found');
  }

  $build['staff_item'] = $teacherdata;
return $this->render('AcmeDemoBundle:Staff:librarianpage.html.twig', $build);
}
//////////////////////////////////////////////////////////////////////////////////////////////
public function mangerpageAction()
{

			$mysessionid=$this->get('session')->get('loginId');


	$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
		 			// \Doctrine\Common\Util\Debug::dump($myteacher->getId());

$teacherdata= $this->getDoctrine()
        ->getRepository('AcmeDemoBundle:Staff')
        ->findBy(
    array('id' =>$myteacher->getId()
    	));

  if (!$teacherdata) {
    throw $this->createNotFoundException('No notes found');
  }

  $build['staff_item'] = $teacherdata;
  //return $this->render('AcmeDemoBundle:Staff:staff_show.html.twig', $build);
return $this->render('AcmeDemoBundle:Staff:mangerpage.html.twig' , $build);
}
///////////////////////////////////////
#list 

    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
	$staff = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:Staff')
            ->findAll();
      if (!$staff) {
        throw $this->createNotFoundException('No teachers found');
      }
    
      $build['staff'] = $staff;
      return $this->render('AcmeDemoBundle:Staff:staff_show_all.html.twig', $build);
    }

/////////////////////////////////////////////////////////////CRUD Operations of Teacher////////////////////////////////////////////

#add
	public function addAction()
		{
			$staffandclass = new staffandclass();
			$staff = new staff();
			$form = $this->createForm(new StaffType(), $staff);
			$form->add('class', 'entity', array(
					    'class' => 'AcmeDemoBundle:Studentclass','empty_value' => 'اسم القاعة',
					    
					'mapped'=>false));
			$job = new Job();
			$login = new Login();
			$phone = new staffphone();
			
		
		        $validator = $this->get('validator');
                        $errors = $validator->validate($staff);

			$request = $this->get('request');
			$form->handleRequest($request);
			
        		

			if($request->getMethod() == 'POST')
			{

				if($form->isValid())
				{
					//$name=$form->get('fullname')->getData();
				      
		       //to save the data of teacher in database
			        $em = $this->getDoctrine()->getManager();
					$em->persist($staff);
					$phone->setUser($staff);
					$phone->setPhone($form->get('phone')->getData());
					$em->persist($phone);
					$em->persist($staff);
					$em->flush();
					$salt = '$2a$07$R.gJb2U2N.FmZ4hPp1y2CN$';
					
					$em->persist($staff);
					$em->flush();
					//var_dump($form->get('job')->getData());
					

					$staff->setJob($form->get('job')->getData());
					$em->persist($phone);
					$em->persist($staff);
					$login->setUsername($form->get('nationalid')->getData());
					$login->setPassword(crypt($form->get('code')->getData(), $salt));
					$em->persist($login);
        		                $em->flush();
					if($form->get('class')->getData()){
                                        $class = $em->getRepository('AcmeDemoBundle:Studentclass')->find($form->get('class')->getData());
					
			           
					$staffandclass->setStaff($staff);
					$staffandclass->setClass($class);

					$em->persist($staffandclass);
					$em->flush();
					}


                                  
                                        return new Response('تم حفظ بيانات العضو بنجاح');
				      	
				}
			
			   return $this->render('AcmeDemoBundle:Staff:add.html.twig',array('form'=>$form->createView())); 

			}

			   return $this->render('AcmeDemoBundle:Staff:add.html.twig',array('form'=>$form->createView())); 

		}

#show	
       public function showAction($id) {
	      $staff = $this->getDoctrine()
		            ->getRepository('AcmeDemoBundle:Staff')
		            ->find($id);
	      if (!$staff) {
		throw $this->createNotFoundException('No teachers found by id ' . $id);
	      }


	    
	      $build['staff_item'] = $staff;
 	      $teacher=new staff();
	      $build['phones']=$teacher->getPhones();
	       
	      return $this->render('AcmeDemoBundle:Staff:staff_show.html.twig', $build);
	    }

#show staff profile

	    
public function showTeacherProfileAction()
{

			$mysessionid=$this->get('session')->get('loginId');


	$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
		 			// \Doctrine\Common\Util\Debug::dump($myteacher->getId());

$teacherdata= $this->getDoctrine()
        ->getRepository('AcmeDemoBundle:Staff')
        ->findBy(
    array('id' =>$myteacher->getId()
    	));

  if (!$teacherdata) {
    throw $this->createNotFoundException('No notes found');
  }

  $build['staff_item'] = $teacherdata;
  return $this->render('AcmeDemoBundle:Staff:staff_show_profile.html.twig', $build);
}
	    

#edit
	public function editAction($id, Request $request) {
	    $em = $this->getDoctrine()->getManager();
	    $staff = $em->getRepository('AcmeDemoBundle:Staff')->find($id);
	    $phone = $em->getRepository('AcmeDemoBundle:Staffphone')->find($id);
	    $staffandclass = $em->getRepository('AcmeDemoBundle:Staffandclass')->find($id);	

	    $job = $em->getRepository('AcmeDemoBundle:Job')->find($id);	    
		$validator = $this->get('validator');
		$errors = $validator->validate($staff);  
 
         
	    if (!$staff) {
	      throw $this->createNotFoundException(
		      'No teachers found for id ' . $id
	      );
	    }
	    
	    $form = $this->createFormBuilder($staff)
		->add('code', 'text')
		->add('fullname', 'text')
                ->add('job')
		->add('graduate', 'text')
		->add('dateofgraduate', 'date', array(
                 'years' => range(date('Y') -60, date('Y')+3),
                     ))
		->add('birthday', 'date', array(
                 'years' => range(date('Y') -60, date('Y')+3),
                     ))
		->add('appointmentdate', 'date', array(
                 'years' => range(date('Y') -60, date('Y')+3),
                     ))
		->add('dateofanotherstudy', 'date', array(
                 'years' => range(date('Y') -60, date('Y')+3),
                     ))
		->add('joindate', 'date', array(
                 'years' => range(date('Y') -60, date('Y')+3),
                     ))
		->add('degree', 'text')
		->add('dateofgetdegree', 'date', array(
                 'years' => range(date('Y') -60, date('Y')+3),
                     ))
		->add('nationalid', 'text')
		->add('address', 'text')
		->add('anotherstudy', 'text')
		->add('phone', 'text',array('mapped'=>false))
		->add('image','file', array(
                'data_class' => null, 'required' => false
            ))
		->add('submit','submit')
		->getForm();

if($staffandclass){
$form->add('class', 'entity', array('class' => 'AcmeDemoBundle:Studentclass','data' => $staffandclass->getClass() ,'mapped'=>false,'empty_value' => 'اسم القاعة'));

}else{
$form->add('class', 'entity', array('class' => 'AcmeDemoBundle:Studentclass','empty_value' => 'اسم القاعة' ,'mapped'=>false));
}

	    $form->handleRequest($request);

		if($form->isValid())
				{
				$em->persist($staff);
				$phone->setUser($staff);
				$phone->setPhone($form->get('phone')->getData());
				$em->persist($phone);
				$em->flush();
				$staff->setJob($job);
				$staff->setJob($form->get('job')->getData());
				$em->persist($staff);
				$em->flush();
				if($form->get('class')->getData()){
                                        $class = $em->getRepository('AcmeDemoBundle:Studentclass')->find($form->get('class')->getData());
			                if(!$staffandclass){
					$staffandclass=new Staffandclass();
					}
					$staffandclass->setStaff($staff);
					$staffandclass->setClass($class);

					$em->persist($staffandclass);
					$em->flush();
					}elseif($form->get('class')->getData() == null){
						$em = $this->getDoctrine()->getEntityManager();
						$repo = $em->getRepository('AcmeDemoBundle:Staffandclass');

						$classofstaff = $repo->findOneBy(array('staff' => $id));
						$em->remove($classofstaff);
						$em->flush();
					}
				
                          
                                $staff = $this->getDoctrine()
					    ->getRepository('AcmeDemoBundle:Staff')
					    ->findAll();
				      if (!$staff) {
					throw $this->createNotFoundException('No teachers found');
				      }
			      $build['staff'] = $staff;
			      return $this->render('AcmeDemoBundle:Staff:staff_show_all.html.twig', $build);
				      	
				}
	    $teacher = $em->getRepository('AcmeDemoBundle:Staff')->find($id);

	    $build['form'] = $form->createView();
	    $build['phones']=$teacher->getPhones();
	    return $this->render('AcmeDemoBundle:Staff:news_add.html.twig', $build);
	 }
		 
#delete
		 
		 public function deleteAction($id, Request $request) {

		    $em = $this->getDoctrine()->getManager();
		    $staff = $em->getRepository('AcmeDemoBundle:Staff')->find($id);
		    if (!$staff) {
		      throw $this->createNotFoundException(
			      'No news found for id ' . $id
		      );
		    }

		      $em->remove($staff);
		      $em->flush();
		      	return $this->redirect($this->generateUrl('acme_staff_home'));
		      return new Response('News deleted successfully');

		    
		    $build['form'] = $form->createView();
		    return $this->render('AcmeDemoBundle:Staff:news_add.html.twig', $build);
		}

	}
