<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\Gallery;
use Acme\DemoBundle\Entity\Activity;
use Acme\DemoBundle\Entity\Studentclass;
use Acme\DemoBundle\Form\GalleryType;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class GalleryController extends Controller
{

#list 

    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
	$pics = $this->getDoctrine()
                        ->getRepository('AcmeDemoBundle:Gallery')
                        ->findAll();
      if (!$pics) {
        throw $this->createNotFoundException('No pics found');
      }
    
      $build['pics'] = $pics;
      return $this->render('AcmeDemoBundle:Gallery:gallery_show_all.html.twig', $build);
    }

/////////////////////////////////////////////////////////////CRUD Operations of Teacher////////////////////////////////////////////

#add
	public function addAction()
		{
			$pic = new gallery();
			$form = $this->createForm(new GalleryType(), $pic);
			$class = new Studentclass();
			$activity = new Activity();

		        $validator = $this->get('validator');
                        $errors = $validator->validate($pic);

			$request = $this->get('request');
			$form->handleRequest($request);

		// relate this phone to the one member of pic

			if($request->getMethod() == 'POST')
			{

				if($form->isValid())
				{
					//$name=$form->get('fullname')->getData();
				
		       //to save the data of teacher in database
			        	$em = $this->getDoctrine()->getManager();
        				$em->persist($pic);
					$pic->setClass($form->get('class')->getData());
					$pic->setActivity($form->get('activity')->getData());

					$em->persist($pic);
					$em->flush();

                                  
                                        $pics = $this->getDoctrine()
						    ->getRepository('AcmeDemoBundle:Gallery')
						    ->findAll();
					      if (!$pics) {
						throw $this->createNotFoundException('No pics found');
					      }
				      $build['pics'] = $pics;
				      return $this->render('AcmeDemoBundle:Gallery:gallery_show_all.html.twig', $build);
				      	
				}
			
			   return $this->render('AcmeDemoBundle:Gallery:add.html.twig',array('form'=>$form->createView())); 

			}

			   return $this->render('AcmeDemoBundle:Gallery:add.html.twig',array('form'=>$form->createView())); 

		}

#show	
       public function showAction($id) {
	      $pic = $this->getDoctrine()
		    ->getRepository('AcmeDemoBundle:Gallery')
		    ->find($id);
	      if (!$pic) {
		throw $this->createNotFoundException('No pics found by id ' . $id);
	      }
	    
	      $build['pic_item'] = $pic;
	      return $this->render('AcmeDemoBundle:Gallery:gallery_show.html.twig', $build);
	    }

#edit
	public function editAction($id, Request $request) {
	    $em = $this->getDoctrine()->getManager();
	    $pic = $em->getRepository('AcmeDemoBundle:Gallery')->find($id);
	    $class = $em->getRepository('AcmeDemoBundle:Studentclass')->find($id);
	    $activity = $em->getRepository('AcmeDemoBundle:Activity')->find($id);
	    	    
		$validator = $this->get('validator');
		$errors = $validator->validate($pic);   
         
	    if (!$pic) {
	      throw $this->createNotFoundException(
		      'No pics found for id ' . $id
	      );
	    }
	    
	    $form = $this->createFormBuilder($pic)
		->add('dateofpic', 'date')
		->add('class')
		->add('activity')
		->add('image','file', array(
                'data_class' => null, 'required' => false
            ))
		->add('submit','submit')
		->getForm();

	    $form->handleRequest($request);

	    if ($form->isValid()) {
				$pic->setClass($class);
				$pic->setClass($form->get('class')->getData());
				$pic->setActivity($activity);
				$pic->setActivity($form->get('activity')->getData());
				$em->persist($pic);
		$em->flush();
		$pics = $this->getDoctrine()
			    ->getRepository('AcmeDemoBundle:Gallery')
			    ->findAll();
		      if (!$pics) {
			throw $this->createNotFoundException('No pics found');
		      }
	      $build['pics'] = $pics;
              return $this->render('AcmeDemoBundle:Gallery:gallery_show_all.html.twig', $build);

		// return new Response('News updated successfully');
	    }
	    
	    $build['form'] = $form->createView();

	    return $this->render('AcmeDemoBundle:Gallery:news_add.html.twig', $build);
	 }
		 
#delete
		 
		 public function deleteAction($id, Request $request) {

		    $em = $this->getDoctrine()->getManager();
		    $pic = $em->getRepository('AcmeDemoBundle:Gallery')->find($id);
		    if (!$pic) {
		      throw $this->createNotFoundException(
			      'No pic found for id ' . $id
		      );
		    }

		      $em->remove($pic);
		      $em->flush();
		      return new Response('News deleted successfully');

		    
		    $build['form'] = $form->createView();
		    return $this->render('AcmeDemoBundle:Gallery:news_add.html.twig', $build);
		}

	}
