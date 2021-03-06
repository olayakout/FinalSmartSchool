<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\Link;
use Acme\DemoBundle\Form\LinkType;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LinkController extends Controller
{

#list 

    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
	$links = $this->getDoctrine()
	              ->getRepository('AcmeDemoBundle:Link')
	              ->findAll();

      if (!$links) {
        throw $this->createNotFoundException('No links found');
      }
    
      $build['links'] = $links;
            $mysessionid=$this->get('session')->get('loginId');

      $myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
				 if($myteacher->getJob()=="امين مكتبة"){

      				return $this->render('AcmeDemoBundle:Link:link_show_all.html.twig', $build);
      			}elseif($myteacher->getJob()=="مدير"){
					return $this->render('AcmeDemoBundle:Link:linkformanger_show_all.html.twig', $build);
		

					}
    }

/////////////////////////////////////////////////////////////CRUD Operations of Book////////////////////////////////////////////

#add
	public function addAction()
		{
			$link = new link();
			$form = $this->createForm(new LinkType(), $link);
                        
                        $validator = $this->get('validator');
                        $errors = $validator->validate($link);
		
			$request = $this->get('request');
			$form->handleRequest($request);
		
			if($request->getMethod() == 'POST')
			{

				if($form->isValid())
				{
					$em = $this->getDoctrine()->getManager();
					$em->persist($link);
					$em->flush();
                 $mysessionid=$this->get('session')->get('loginId');


					$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
				 if($myteacher->getJob()=="امين مكتبة"){
                       
                $links = $this->getDoctrine()
			      ->getRepository('AcmeDemoBundle:Link')
			      ->findAll();
					      if (!$links) {
						throw $this->createNotFoundException('No links found');
					      }
				      $build['links'] = $links;
				      return $this->render('AcmeDemoBundle:Link:link_show_all.html.twig', $build);
				}elseif($myteacher->getJob()=="مدير"){
					  $books = $this->getDoctrine()
						      ->getRepository('AcmeDemoBundle:Book')
						      ->findAll();
					      if (!$books) {
						throw $this->createNotFoundException('No books found');
					      }
				      $build['books'] = $books;
				      return $this->render('AcmeDemoBundle:Book:bookformanger_show_all.html.twig', $build);
		

					}
	
				}
			
			   return $this->render('AcmeDemoBundle:Link:add.html.twig',array('form'=>$form->createView())); 

			}

			   return $this->render('AcmeDemoBundle:Link:add.html.twig',array('form'=>$form->createView())); 

		}
#show	
       public function showAction($id) {
	      $link = $this->getDoctrine()
			   ->getRepository('AcmeDemoBundle:Link')
			   ->find($id);
	      if (!$link) {
		      throw $this->createNotFoundException('No link found by id ' . $id);
	      }
	    
	      $build['link_item'] = $link;
	      return $this->render('AcmeDemoBundle:Link:link_show.html.twig', $build);
	    }

#edit
	public function editAction($id, Request $request) {
	    $em = $this->getDoctrine()->getManager();
	    $link = $em->getRepository('AcmeDemoBundle:Link')->find($id);

		$validator = $this->get('validator');
		$errors = $validator->validate($link);   
         
	    if (!$link) {
	      throw $this->createNotFoundException(
		      'No link found for id ' . $id
	      );
	    }
	    
	    $form = $this->createFormBuilder($link)
			 ->add('title', 'text')
			 ->add('url', 'text')
			 ->add('about', 'textarea')
			 ->add('submit','submit')
			 ->getForm();

	    $form->handleRequest($request);

	    if ($form->isValid()) {
					$em->flush();
					$links = $this->getDoctrine()
						      ->getRepository('AcmeDemoBundle:Link')
						      ->findAll();
					      if (!$links) {
						throw $this->createNotFoundException('No links found');
					      }
				      $build['links'] = $links;
			              return $this->render('AcmeDemoBundle:Link:link_show_all.html.twig', $build);

		// return new Response('News updated successfully');
	    }
	    
	    $build['form'] = $form->createView();

	    return $this->render('AcmeDemoBundle:Link:news_add.html.twig', $build);
	 }
		 
#delete
		 
		 public function deleteAction($id, Request $request) {

		    $em = $this->getDoctrine()->getManager();
		    $link = $em->getRepository('AcmeDemoBundle:Link')->find($id);
		    if (!$link) {
		      throw $this->createNotFoundException(
			      'No link found for id ' . $id
		      );
		    }

		      $em->remove($link);
		      $em->flush();
	              return $this->redirect($this->generateUrl('acme_link_home'));
		      return new Response('تم مسح اللينك بنجاح');

		    
		    $build['form'] = $form->createView();
		    return $this->render('AcmeDemoBundle:Link:news_add.html.twig', $build);
		}

	}
