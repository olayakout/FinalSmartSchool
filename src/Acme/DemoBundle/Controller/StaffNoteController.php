<?php
namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\StaffNote;
use Acme\DemoBundle\Entity\Staff;

use Acme\DemoBundle\Form\StaffNoteType;
use Acme\DemoBundle\Form\SpecificStaffNoteType;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\DBAL\DriverManager;

class StaffNoteController extends Controller
{

/////////////////////////////////////////////////////////////CRUD Operations of Note////////////////////////////////////////////

#add
public function addStaffNoteToAllAction()
	{

	$mysessionid=$this->get('session')->get('loginId');
  	//\Doctrine\Common\Util\Debug::dump($mystudentid);


    	$staff = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
    			// \Doctrine\Common\Util\Debug::dump($staff->getId());


		$form = $this->createForm(new StaffNoteType(), new StaffNote());

		$mystaff = $this->getDoctrine()
							->getRepository('AcmeDemoBundle:Staff')
							->findAll();



		        $validator = $this->get('validator');
                 $errors = $validator->validate($form);
		
		$request = $this->get('request');
		$form->handleRequest($request);
		
		// \Doctrine\Common\Util\Debug::dump($mystudent->getId());

		 if($request->getMethod() == 'POST')
		  {

		// if($form->isValid())
	 //  {	
	  		$em = $this->getDoctrine()->getManager();

			 foreach($mystaff as $myteacher) {
			 	if($myteacher->getId() !=$staff->getId()){
			 $ss = new StaffNote();	
			 	//var_dump($mystudent->getId());
			 	//echo '************************'."<br>";
	    	 $ss->setMynote($form->get('mynote')->getData());
	    	 $ss->setNotes($myteacher)
	    	 	->setNoteDate($form->get('noteDate')->getData())
	    	 	->setNoteType('ملاحظة سلوكية');
	  

			$em->persist($ss);
		}else{
		 	continue;
		 }
}
		
		$em->flush();
		$notes = $this->getDoctrine()
				        ->getRepository('AcmeDemoBundle:StaffNote')
				        ->findAll();
				  if (!$notes) {
				    throw $this->createNotFoundException('No notes found');
				  }

				  $build['notes'] = $notes;
				  return $this->render('AcmeDemoBundle:StaffNote:staffnotes_show_all.html.twig', $build);



		 	//return new Response('تم حفظ البيانات بنجاح');
		 
		//}
	  }
		
    
    return $this->render('AcmeDemoBundle:StaffNote:addStaffNote_all.html.twig',array('form'=>$form->createView()));
                
}
#note/add_all
public function addSpecificStaffNoteAction()
	{
			$mysessionid=$this->get('session')->get('loginId');

		
		$staffNote = new StaffNote();
    	$staff = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
		$form = $this->createForm(new SpecificStaffNoteType(), $staffNote);					
		

        $validator = $this->get('validator');
        $errors = $validator->validate($staff);

		$request = $this->get('request');
		$form->handleRequest($request);

	 if($request->getMethod() == 'POST')
	  {

		//if($form->isValid())
	  //{		
	    	 $staffNote->setMynote($form->get('mynote')->getData());
	    	 $staffNote->setNotes($form->get('notes')->getData())
	    	              ->setNoteDate($form->get('noteDate')->getData())
	    	 			  ->setNoteType('ملاحظة سلوكية');
	    	 			
		
				$em = $this->getDoctrine()->getManager();
				$em->persist($staffNote);

				$em->flush();
				$notes = $this->getDoctrine()
					        ->getRepository('AcmeDemoBundle:StaffNote')
					        ->findAll();
					  if (!$notes) {
					    throw $this->createNotFoundException('No notes found');
					  }

					  $build['notes'] = $notes;
					  return $this->render('AcmeDemoBundle:StaffNote:staffnotes_show_all.html.twig', $build);

		//}
		
		 	//return new Response('تم حفظ البيانات بنجاح');
		 
		 //}
	  }    
//}
    return $this->render('AcmeDemoBundle:StaffNote:addSpecificStaffNote.html.twig',array('form'=>$form->createView()));
                
}
//////////addrequire//////////////////////

public function addStaffRequireToAllAction()
	{
			$mysessionid=$this->get('session')->get('loginId');

		$staff = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
    		
		$form = $this->createForm(new StaffNoteType(), new StaffNote());

		$mystaff = $this->getDoctrine()
							->getRepository('AcmeDemoBundle:Staff')
							->findAll();

		$validator = $this->get('validator');
        $errors = $validator->validate($form);
		
		$request = $this->get('request');
		$form->handleRequest($request);
		
		 if($request->getMethod() == 'POST')
		  {

		// if($form->isValid())
	 //  {	
	  		$em = $this->getDoctrine()->getManager();

			 foreach($mystaff as $myteacher) {
			 	if($myteacher->getId() !=$staff->getId()){
			 $ss = new StaffNote();	
	    	 $ss->setMynote($form->get('mynote')->getData());
	    	 $ss->setNotes($myteacher)
	    	 	->setNoteDate($form->get('noteDate')->getData())
	    	 	->setNoteType('طلب تعليمى');
	  
			$em->persist($ss);
		}else{
		 	continue;
		 }
}
		
		$em->flush();
		$notes = $this->getDoctrine()
				        ->getRepository('AcmeDemoBundle:StaffNote')
				        ->findAll();
				  if (!$notes) {
				    throw $this->createNotFoundException('No notes found');
				  }

				  $build['notes'] = $notes;
				  return $this->render('AcmeDemoBundle:StaffNote:staffnotes_show_all.html.twig', $build);



		 	//return new Response('تم حفظ البيانات بنجاح');
		 
		//}
	  }
		
    
    return $this->render('AcmeDemoBundle:StaffNote:addStaffNote_all.html.twig',array('form'=>$form->createView()));
                  
}


//////////////addspecificrequire/////////////////////////

public function addSpecificstaffRequireAction()
	{
		$mysessionid=$this->get('session')->get('loginId');

		$staffNote = new StaffNote();
    	$staff = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
		$form = $this->createForm(new SpecificStaffNoteType(), $staffNote);					
		

        $validator = $this->get('validator');
        $errors = $validator->validate($staff);

		$request = $this->get('request');
		$form->handleRequest($request);

	 if($request->getMethod() == 'POST')
	  {

		//if($form->isValid())
	  //{		
	    	 $staffNote->setMynote($form->get('mynote')->getData());
	    	 $staffNote->setNotes($form->get('notes')->getData())
	    	              ->setNoteDate($form->get('noteDate')->getData())
	    	 			  ->setNoteType('طلب تعليمى');
	    	 			
		
				$em = $this->getDoctrine()->getManager();
				$em->persist($staffNote);

				$em->flush();
				$notes = $this->getDoctrine()
						        ->getRepository('AcmeDemoBundle:StaffNote')
						        ->findAll();
						  if (!$notes) {
						    throw $this->createNotFoundException('No notes found');
						  }

						  $build['notes'] = $notes;
						  return $this->render('AcmeDemoBundle:StaffNote:staffnotes_show_all.html.twig', $build);

		//}s
		
		 	//return new Response('تم حفظ البيانات بنجاح');
		 
		 //}
	  }    
//}
    return $this->render('AcmeDemoBundle:StaffNote:addSpecificStaffNote.html.twig',array('form'=>$form->createView()));
                
}
/////////////list/////////////////


public function indexAction()
{
$notes = $this->getDoctrine()
        ->getRepository('AcmeDemoBundle:StaffNote')
        ->findAll();
  if (!$notes) {
    throw $this->createNotFoundException('No notes found');
  }

  $build['notes'] = $notes;
  return $this->render('AcmeDemoBundle:StaffNote:staffnotes_show_all.html.twig', $build);
}

##############listtospecific teacher

public function showSpecificTeacherAction()
{

		$mysessionid=$this->get('session')->get('loginId');


	$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
		 			// \Doctrine\Common\Util\Debug::dump($myteacher->getId());
 if($myteacher->getJob()=="مدرس"){


$notes = $this->getDoctrine()
        ->getRepository('AcmeDemoBundle:StaffNote')
        ->findBy(
    array('notes' =>$myteacher->getId()));

  if (!$notes) {
    throw $this->createNotFoundException('No notes found');
  }

  $build['notes'] = $notes;
  return $this->render('AcmeDemoBundle:StaffNote:staffnotesforteacher_show_all.html.twig', $build);
 }elseif($myteacher->getJob()=="امين مكتبة"){
 	$notes = $this->getDoctrine()
        ->getRepository('AcmeDemoBundle:StaffNote')
        ->findBy(
    array('notes' =>$myteacher->getId()));

  if (!$notes) {
    throw $this->createNotFoundException('No notes found');
  }

  $build['notes'] = $notes;
  return $this->render('AcmeDemoBundle:StaffNote:staffnotesforlibrarian_show_all.html.twig', $build);


}
}

#######################show
public function showAction($id) {
$notes = $this->getDoctrine()
			  ->getRepository('AcmeDemoBundle:StaffNote')
			  ->find($id);

  if (!$notes) {
		throw $this->createNotFoundException('No notes found by note ' . $note);
  	}

  $build['note_item'] = $notes;
  return $this->render('AcmeDemoBundle:StaffNote:staffnote_show.html.twig', $build);
}

##################edit

public function editAction($id, Request $request) {

$em = $this->getDoctrine()->getManager();
$staffnote = $em->getRepository('AcmeDemoBundle:StaffNote')->find($id);

$validator = $this->get('validator');
$errors = $validator->validate($staffnote);   
 
if (!$staffnote) {
  throw $this->createNotFoundException(
      'No teachers found for id ' . $id
  );
}
//foreach ($staff as $mynote) {
	    //$em->remove($mynote);
			// \Doctrine\Common\Util\Debug::dump($mynote->getNoteType());

	$form = $this->createFormBuilder($staffnote)
->add('mynote', 'text')
->add('noteDate', 'date', array(
'years' => range(date('Y') -60, date('Y')+3),
                     ))
->add('notes')
->add('submit','submit')
->getForm();

//}
$form->handleRequest($request);

if ($form->isValid()) {

		$em->flush();
	return $this->redirect($this->generateUrl('acme_staffnote_home'));

 return new Response('News updated successfully');
}

$build['form'] = $form->createView();

return $this->render('AcmeDemoBundle:StaffNote:editSpecificStaffNote.html.twig', $build);
}
 
#########################delete
 
 public function deleteAction($id) {

    $em = $this->getDoctrine()->getManager();
    $staffnote = $em->getRepository('AcmeDemoBundle:StaffNote')->find($id);
    if (!$staffnote) {
      throw $this->createNotFoundException(
	      'No news found for note ' . $note
      );
    }
	    $em->remove($staffnote);
      $em->flush();
	return $this->redirect($this->generateUrl('acme_staffnote_home'));

}

}
