<?php
namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\StaffStudent;
use Acme\DemoBundle\Entity\Student;
use Acme\DemoBundle\Entity\Staff;

use Acme\DemoBundle\Form\StaffStudentType;
use Acme\DemoBundle\Form\SpecificStaffStudentType;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\DBAL\DriverManager;

class StaffStudentController extends Controller
{

/////////////////////////////////////////////////////////////CRUD Operations of Note////////////////////////////////////////////

#add
public function addAction()
	{

	    $mysessionid=$this->get('session')->get('loginId');


    	$staff = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
    	$ss = new StaffStudent();	

		$form = $this->createForm(new StaffStudentType(), new StaffStudent());

		$mystudents = $this->getDoctrine()
							->getRepository('AcmeDemoBundle:Student')
							->findAll();

		        $validator = $this->get('validator');
                 $errors = $validator->validate($form);
		
		$request = $this->get('request');
		$form->handleRequest($request);
		
		// \Doctrine\Common\Util\Debug::dump($mystudent->getId());

		 if($request->getMethod() == 'POST')
		  {

		//if($form->isValid())
	  //{	
	  		$em = $this->getDoctrine()->getManager();

			 foreach($mystudents as $mystudent) {
			 $ss = new StaffStudent();	
			 
	    	 $ss->setNote($form->get('note')->getData());
	    	 $ss->setMember($staff);
	    	 $ss->setStudent($mystudent)
		    ->setNoteDate($form->get('noteDate')->getData())
	    	 	->setNoteType('ملاحظة سلوكية');
	  

			$em->persist($ss);

		}
		$em->flush();
				if($staff->getJob()=="مدير"){
				$notes = $this->getDoctrine()
		        ->getRepository('AcmeDemoBundle:StaffStudent')
		        ->findAll();
		  if (!$notes) {
		    throw $this->createNotFoundException('No notes found');
		  }

		  $build['notes'] = $notes;
		  return $this->render('AcmeDemoBundle:StaffStudent:notes_show_all.html.twig', $build);
			}elseif($staff->getJob()=="مدرس"){



								$mysessionid=$this->get('session')->get('loginId');

						$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
							 			 //\Doctrine\Common\Util\Debug::dump($myteacher->getId());

					$notes = $this->getDoctrine()
					        ->getRepository('AcmeDemoBundle:StaffStudent')
					        ->findBy(
					    array('member' =>$myteacher->getId()));

					  if (!$notes) {
					    throw $this->createNotFoundException('No notes found');
					  }

					  $build['notes'] = $notes;
					  return $this->render('AcmeDemoBundle:StaffStudent:notesforteacherpage_show_all.html.twig', $build);

			}	

		 	//return new Response('تم حفظ البيانات بنجاح');
		 
		 //}
	  }
		
    
    return $this->render('AcmeDemoBundle:StaffStudent:addStaffStudent.html.twig',array('form'=>$form->createView()));
                
}
#note/add_all
public function addBehvioralSpecificNoteAction()
	{
					$mysessionid=$this->get('session')->get('loginId');

		$staffstudent = new StaffStudent();
    	$staff = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
		$form = $this->createForm(new SpecificStaffStudentType(), $staffstudent);					
		

        // $validator = $this->get('validator');
        //         $errors = $validator->validate($staff);

		$request = $this->get('request');
		$form->handleRequest($request);

	 if($request->getMethod() == 'POST')
	  {

		//if($form->isValid())
	  //{		
	    	 $staffstudent->setNote($form->get('note')->getData());
	    	 $staffstudent->setMember($staff);
	    	 //$staffstudent->setStudent($form->get('student')->getData());
	    	 $staffstudent->setNoteType('ملاحظة سلوكية')
			      ->setNoteDate($form->get('noteDate')->getData());
	    	 			
		
				$em = $this->getDoctrine()->getManager();
				$em->persist($staffstudent);

				$em->flush();
		//}
				if($staff->getJob()=="مدير"){
				$notes = $this->getDoctrine()
		        ->getRepository('AcmeDemoBundle:StaffStudent')
		        ->findAll();
		  if (!$notes) {
		    throw $this->createNotFoundException('No notes found');
		  }

		  $build['notes'] = $notes;
		  return $this->render('AcmeDemoBundle:StaffStudent:notes_show_all.html.twig', $build);
			}elseif($staff->getJob()=="مدرس"){



								$mysessionid=$this->get('session')->get('loginId');

						$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
							 			 //\Doctrine\Common\Util\Debug::dump($myteacher->getId());

					$notes = $this->getDoctrine()
					        ->getRepository('AcmeDemoBundle:StaffStudent')
					        ->findBy(
					    array('member' =>$myteacher->getId()));

					  if (!$notes) {
					    throw $this->createNotFoundException('No notes found');
					  }

					  $build['notes'] = $notes;
					  return $this->render('AcmeDemoBundle:StaffStudent:notesforteacherpage_show_all.html.twig', $build);

			}	
		
		 	//return new Response('تم حفظ البيانات بنجاح');
		 
		 //}
	  }    
//}
    return $this->render('AcmeDemoBundle:StaffStudent:addSpecificStaffStudent.html.twig',array('form'=>$form->createView()));
                
}
//////////addrequire//////////////////////
public function addRequireAction()
	{

					$mysessionid=$this->get('session')->get('loginId');

$staff = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
		$form = $this->createForm(new StaffStudentType(), new StaffStudent());

		$mystudents = $this->getDoctrine()
							->getRepository('AcmeDemoBundle:Student')
							->findAll();

		
        // $validator = $this->get('validator');
        //         $errors = $validator->validate($staff);
		
		$request = $this->get('request');
		$form->handleRequest($request);
		
		// \Doctrine\Common\Util\Debug::dump($mystudent->getId());

		$em = $this->getDoctrine()->getManager();
		 if($request->getMethod() == 'POST')
		  {

		//if($form->isValid())
	  //{	
	  
			 foreach($mystudents as $mystudent) {
			 $ss = new StaffStudent();	
			 	//var_dump($mystudent->getId());
			 	//echo '************************'."<br>";
	    	 $ss->setNote($form->get('note')->getData());
	    	 $ss->setMember($staff);
	    	 $ss->setStudent($mystudent)
	    	 	->setNoteType('طلب دراسى')
			->setNoteDate($form->get('noteDate')->getData());
	  

			$em->persist($ss);

		}
		$em->flush();
		if($staff->getJob()=="مدير"){
				$notes = $this->getDoctrine()
		        ->getRepository('AcmeDemoBundle:StaffStudent')
		        ->findAll();
		  if (!$notes) {
		    throw $this->createNotFoundException('No notes found');
		  }

		  $build['notes'] = $notes;
		  return $this->render('AcmeDemoBundle:StaffStudent:notes_show_all.html.twig', $build);
			}elseif($staff->getJob()=="مدرس"){



								$mysessionid=$this->get('session')->get('loginId');

						$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
							 			 //\Doctrine\Common\Util\Debug::dump($myteacher->getId());

					$notes = $this->getDoctrine()
					        ->getRepository('AcmeDemoBundle:StaffStudent')
					        ->findBy(
					    array('member' =>$myteacher->getId()));

					  if (!$notes) {
					    throw $this->createNotFoundException('No notes found');
					  }

					  $build['notes'] = $notes;
					  return $this->render('AcmeDemoBundle:StaffStudent:notesforteacherpage_show_all.html.twig', $build);

			}	

		 	//return new Response('تم حفظ البيانات بنجاح');
		 
		 //}
	  }
    return $this->render('AcmeDemoBundle:StaffStudent:addStaffStudent.html.twig',array('form'=>$form->createView()));
                
}


//////////////addspecificrequire/////////////////////////
public function addSpecificRequireAction()
	{
					$mysessionid=$this->get('session')->get('loginId');

		$staffstudent = new StaffStudent();
    	$staff = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
		$form = $this->createForm(new SpecificStaffStudentType(), $staffstudent);					
		

        // $validator = $this->get('validator');
        //         $errors = $validator->validate($staff);

		$request = $this->get('request');
		$form->handleRequest($request);

	 if($request->getMethod() == 'POST')
	  {

		//if($form->isValid())
	  //{		
	    	 $staffstudent->setNote($form->get('note')->getData());
	    	 $staffstudent->setMember($staff);
	    	 //$staffstudent->setStudent($form->get('student')->getData());
	    	 $staffstudent->setNoteType('طلب دراسى')
				->setNoteDate($form->get('noteDate')->getData());
	    	 			
		
				$em = $this->getDoctrine()->getManager();
				$em->persist($staffstudent);

				$em->flush();
		//}
				if($staff->getJob()=="مدير"){
				$notes = $this->getDoctrine()
		        ->getRepository('AcmeDemoBundle:StaffStudent')
		        ->findAll();
		  if (!$notes) {
		    throw $this->createNotFoundException('No notes found');
		  }

		  $build['notes'] = $notes;
		  return $this->render('AcmeDemoBundle:StaffStudent:notes_show_all.html.twig', $build);
			}elseif($staff->getJob()=="مدرس"){



								$mysessionid=$this->get('session')->get('loginId');

						$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
							 			 //\Doctrine\Common\Util\Debug::dump($myteacher->getId());

					$notes = $this->getDoctrine()
					        ->getRepository('AcmeDemoBundle:StaffStudent')
					        ->findBy(
					    array('member' =>$myteacher->getId()));

					  if (!$notes) {
					    throw $this->createNotFoundException('No notes found');
					  }

					  $build['notes'] = $notes;
					  return $this->render('AcmeDemoBundle:StaffStudent:notesforteacherpage_show_all.html.twig', $build);

			}	
		
		 	//return new Response('تم حفظ البيانات بنجاح');
		 
		 //}
	  }    
//}
    return $this->render('AcmeDemoBundle:StaffStudent:addSpecificStaffStudent.html.twig',array('form'=>$form->createView()));
                
}
/////////////list/////////////////
public function indexAction()
{
$notes = $this->getDoctrine()
        ->getRepository('AcmeDemoBundle:StaffStudent')
        ->findAll();
  if (!$notes) {
    throw $this->createNotFoundException('No notes found');
  }

  $build['notes'] = $notes;
  return $this->render('AcmeDemoBundle:StaffStudent:notes_show_all.html.twig', $build);
}

##############listtospecific teacherstudentnotes

public function showSpecificTeacherStudentsAction()
{
			$mysessionid=$this->get('session')->get('loginId');

	$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
		 			 //\Doctrine\Common\Util\Debug::dump($myteacher->getId());

$notes = $this->getDoctrine()
        ->getRepository('AcmeDemoBundle:StaffStudent')
        ->findBy(
    array('member' =>$myteacher->getId()));

  if (!$notes) {
    throw $this->createNotFoundException('No notes found');
  }

  $build['notes'] = $notes;
  return $this->render('AcmeDemoBundle:StaffStudent:notesforteacherpage_show_all.html.twig', $build);
}
///////////////////////////////////////////
public function showSpecificStudentNotesAction()
{

		$mysessionid=$this->get('session')->get('loginId');


	$mystudent = $this->getDoctrine()->getRepository('AcmeDemoBundle:Student')->find($mysessionid);
		 			// \Doctrine\Common\Util\Debug::dump($myteacher->getId());

$notes = $this->getDoctrine()
        ->getRepository('AcmeDemoBundle:StaffStudent')
        ->findBy(
    array('student' =>$mystudent->getId()));

  if (!$notes) {
    throw $this->createNotFoundException('No notes found');
  }

  $build['notes'] = $notes;
  return $this->render('AcmeDemoBundle:StaffStudent:staffstudentnotes_show_all.html.twig', $build);
}




##############################show
public function showAction($student,$member,$note) {
$notes = $this->getDoctrine()
			  ->getRepository('AcmeDemoBundle:StaffStudent')
			  ->findBy(
    array('student' => $student,'member' => $member,'note' => $note)

);
  if (!$notes) {
		throw $this->createNotFoundException('No notes found by note ' . $note);
  	}

  $build['note_item'] = $notes;
  return $this->render('AcmeDemoBundle:StaffStudent:note_show.html.twig', $build);
}
#edit

public function editAction($student,$member,$note, Request $request) {
$em = $this->getDoctrine()->getManager();
$staff = $em->getRepository('AcmeDemoBundle:StaffStudent')->findBy(
    array('student' => $student,'member' => $member,'note' => $note)

);

$validator = $this->get('validator');
$errors = $validator->validate($staff);   
 
if (!$staff) {
  throw $this->createNotFoundException(
      'No teachers found for id ' . $id
  );
}
foreach ($staff as $mynote) {
	    //$em->remove($mynote);
			// \Doctrine\Common\Util\Debug::dump($mynote->getNoteType());

	$form = $this->createFormBuilder($mynote)
->add('note', 'text')
->add('noteDate', 'date', array(
'years' => range(date('Y') -60, date('Y')+3),
                     ))
->add('student')
->add('submit','submit')
->getForm();

}
$form->handleRequest($request);

if ($form->isValid()) {

		$em->flush();
	    $mysessionid=$this->get('session')->get('loginId');


    	$staffobj = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);


	    
		if($staffobj->getJob()=="مدير"){
				$notes = $this->getDoctrine()
		        ->getRepository('AcmeDemoBundle:StaffStudent')
		        ->findAll();
		  if (!$notes) {
		    throw $this->createNotFoundException('No notes found');
		  }

		  $build['notes'] = $notes;
		  return $this->render('AcmeDemoBundle:StaffStudent:notes_show_all.html.twig', $build);
			}elseif($staffobj->getJob()=="مدرس"){



								$mysessionid=$this->get('session')->get('loginId');

						$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
							 			 //\Doctrine\Common\Util\Debug::dump($myteacher->getId());

					$notes = $this->getDoctrine()
					        ->getRepository('AcmeDemoBundle:StaffStudent')
					        ->findBy(
					    array('member' =>$myteacher->getId()));

					  if (!$notes) {
					    throw $this->createNotFoundException('No notes found');
					  }

					  $build['notes'] = $notes;
					  return $this->render('AcmeDemoBundle:StaffStudent:notesforteacherpage_show_all.html.twig', $build);

			}	
	//return $this->redirect($this->generateUrl('acme_note_home'));

 return new Response('News updated successfully');
}

$build['form'] = $form->createView();

return $this->render('AcmeDemoBundle:StaffStudent:editNoteStaffStudent.html.twig', $build);
}
 
#delete
 
 public function deleteAction($student,$member,$note, Request $request) {

    $em = $this->getDoctrine()->getManager();
    $staff = $em->getRepository('AcmeDemoBundle:StaffStudent')->findBy(
    array('student' => $student,'member' => $member,'note' => $note)

);
    if (!$staff) {
      throw $this->createNotFoundException(
	      'No news found for note ' . $note
      );
    }
	foreach ($staff as $mynote) {
	    $em->remove($mynote);
	}
      //$em->remove($staff);
      $em->flush();
     //return $this->render('AcmeDemoBundle:StaffStudent:notes_show_all.html.twig');
	return $this->redirect($this->generateUrl('acme_note_home'));
//, array('id' => $entity->getId())
      //return new Response('News deleted successfully');

    
    // $build['form'] = $form->createView();
    return $this->render('AcmeDemoBundle:StaffStudent:notes_show_all.html.twig', $build);
}

}
