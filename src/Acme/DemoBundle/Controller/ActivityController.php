<?php

namespace Acme\DemoBundle\Controller;
use Acme\DemoBundle\Entity\Gallery;
use Acme\DemoBundle\Entity\Activity;
use Acme\DemoBundle\Form\ActivityType;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ActivityController extends Controller
{

#list 

    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
	$activities = $this->getDoctrine()
	                   ->getRepository('AcmeDemoBundle:Activity')
	                   ->findAll();

      if (!$activities) {
        throw $this->createNotFoundException('No activities found');
      }
    
      $build['activities'] = $activities;
      return $this->render('AcmeDemoBundle:Activity:activity_show_all.html.twig', $build);
    }

/////////////////////////////////////////////////////////////CRUD Operations of Book////////////////////////////////////////////

#add
	public function addAction()
		{
			$activity = new activity();
			$form = $this->createForm(new ActivityType(), $activity);
                        
                        $validator = $this->get('validator');
                        $errors = $validator->validate($activity);
		
			$request = $this->get('request');
			$form->handleRequest($request);
		
			if($request->getMethod() == 'POST')
			{

				if($form->isValid())
				{
					$em = $this->getDoctrine()->getManager();
					$em->persist($activity);
					$em->flush();
                                        
                $activities = $this->getDoctrine()
			      ->getRepository('AcmeDemoBundle:Activity')
			      ->findAll();
					      if (!$activities) {
						throw $this->createNotFoundException('No activities found');
					      }
				      $build['activities'] = $activities;
				      return $this->render('AcmeDemoBundle:Activity:activity_show_all.html.twig', $build);
					
				}
			
			   return $this->render('AcmeDemoBundle:Activity:add.html.twig',array('form'=>$form->createView())); 

			}

			   return $this->render('AcmeDemoBundle:Activity:add.html.twig',array('form'=>$form->createView())); 

		}
#show	
       public function showAction($id) {
	      $activity = $this->getDoctrine()
			   ->getRepository('AcmeDemoBundle:Activity')
			   ->find($id);
	      if (!$activity) {
		      throw $this->createNotFoundException('No activity found by id ' . $id);
	      }
	    
	      $build['activity_item'] = $activity;
	      return $this->render('AcmeDemoBundle:Activity:activity_show.html.twig', $build);
	    }

#edit
	public function editAction($id, Request $request) {
	    $em = $this->getDoctrine()->getManager();
	    $activity = $em->getRepository('AcmeDemoBundle:Activity')->find($id);

		$validator = $this->get('validator');
		$errors = $validator->validate($activity);   
         
	    if (!$activity) {
	      throw $this->createNotFoundException(
		      'No activity found for id ' . $id
	      );
	    }
	    
	    $form = $this->createFormBuilder($activity)
			 ->add('name', 'text')
			 ->add('description', 'textarea')
			 ->add('submit','submit')
			 ->getForm();

	    $form->handleRequest($request);

	    if ($form->isValid()) {
					$em->flush();
					$activities = $this->getDoctrine()
						      ->getRepository('AcmeDemoBundle:Activity')
						      ->findAll();
					      if (!$activities) {
						throw $this->createNotFoundException('No activities found');
					      }
				      $build['activities'] = $activities;
			              return $this->render('AcmeDemoBundle:Activity:activity_show_all.html.twig', $build);

		// return new Response('News updated successfully');
	    }
	    
	    $build['form'] = $form->createView();

	    return $this->render('AcmeDemoBundle:Activity:news_add.html.twig', $build);
	 }
		 
#delete
		 
		 public function deleteAction($id, Request $request) {

		    $em = $this->getDoctrine()->getManager();
		    $activity = $em->getRepository('AcmeDemoBundle:Activity')->find($id);
		    if (!$activity) {
		      throw $this->createNotFoundException(
			      'No activity found for id ' . $id
		      );
		    }

		      $em->remove($activity);
		      $em->flush();
		      	return $this->redirect($this->generateUrl('acme_activity_home'));
		      return new Response('تم مسح النشاط بنجاح');

		    
		    $build['form'] = $form->createView();
		    return $this->render('AcmeDemoBundle:Activity:news_add.html.twig', $build);
		}

#show photoes of activity
       public function photoAction($id) {
	      $photoes = $this->getDoctrine()
			   ->getRepository('AcmeDemoBundle:Gallery')
			   ->findBy(array('activity'=>$id));

	      $activity= $this->getDoctrine()
			   ->getRepository('AcmeDemoBundle:Activity')
			   ->find($id);
    
	      $build['activity'] = $activity;
	      $build['photoes'] = $photoes;
	      return $this->render('AcmeDemoBundle:Activity:photoes.html.twig', $build);
	    }


	}
