<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\Job;
use Acme\DemoBundle\Form\JobType;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class JobController extends Controller
{

#list 

    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
	$jobs = $this->getDoctrine()
	              ->getRepository('AcmeDemoBundle:Job')
	              ->findAll();

      if (!$jobs) {
        throw $this->createNotFoundException('No jobs found');
      }
    
      $build['jobs'] = $jobs;
      return $this->render('AcmeDemoBundle:Job:job_show_all.html.twig', $build);
    }

/////////////////////////////////////////////////////////////CRUD Operations of Book////////////////////////////////////////////

#add
	public function addAction()
		{
			$job = new job();
			$form = $this->createForm(new JobType(), $job);
                        
                        $validator = $this->get('validator');
                        $errors = $validator->validate($job);
		
			$request = $this->get('request');
			$form->handleRequest($request);
		
			if($request->getMethod() == 'POST')
			{

				if($form->isValid())
				{
					$em = $this->getDoctrine()->getManager();
					$em->persist($job);
					$em->flush();
                                        
                $jobs = $this->getDoctrine()
			      ->getRepository('AcmeDemoBundle:Job')
			      ->findAll();
					      if (!$jobs) {
						throw $this->createNotFoundException('No jobs found');
					      }
				      $build['jobs'] = $jobs;
				      return $this->render('AcmeDemoBundle:Job:job_show_all.html.twig', $build);
					
				}
			
			   return $this->render('AcmeDemoBundle:Job:add.html.twig',array('form'=>$form->createView())); 

			}

			   return $this->render('AcmeDemoBundle:Job:add.html.twig',array('form'=>$form->createView())); 

		}
#show	
       public function showAction($id) {
	      $job = $this->getDoctrine()
			   ->getRepository('AcmeDemoBundle:Job')
			   ->find($id);
	      if (!$job) {
		      throw $this->createNotFoundException('No job found by id ' . $id);
	      }
	    
	      $build['job_item'] = $job;
	      return $this->render('AcmeDemoBundle:Job:job_show.html.twig', $build);
	    }

#edit
	public function editAction($id, Request $request) {
	    $em = $this->getDoctrine()->getManager();
	    $job = $em->getRepository('AcmeDemoBundle:Job')->find($id);

		$validator = $this->get('validator');
		$errors = $validator->validate($job);   
         
	    if (!$job) {
	      throw $this->createNotFoundException(
		      'No job found for id ' . $id
	      );
	    }
	    
	    $form = $this->createFormBuilder($job)
			 ->add('job', 'text')
			 ->add('submit','submit')
			 ->getForm();

	    $form->handleRequest($request);

	    if ($form->isValid()) {
					$em->flush();
					$jobs = $this->getDoctrine()
						      ->getRepository('AcmeDemoBundle:Job')
						      ->findAll();
					      if (!$jobs) {
						throw $this->createNotFoundException('No jobs found');
					      }
				      $build['jobs'] = $jobs;
			              return $this->render('AcmeDemoBundle:Job:job_show_all.html.twig', $build);

		// return new Response('News updated successfully');
	    }
	    
	    $build['form'] = $form->createView();

	    return $this->render('AcmeDemoBundle:Job:news_add.html.twig', $build);
	 }
		 
#delete
		 
		 public function deleteAction($id, Request $request) {

		    $em = $this->getDoctrine()->getManager();
		    $job = $em->getRepository('AcmeDemoBundle:Job')->find($id);
		    if (!$job) {
		      throw $this->createNotFoundException(
			      'No job found for id ' . $id
		      );
		    }

		      $em->remove($job);
		      $em->flush();
		      return new Response('تم مسح بنجاح');

		    
		    $build['form'] = $form->createView();
		    return $this->render('AcmeDemoBundle:Job:news_add.html.twig', $build);
		}

	}
