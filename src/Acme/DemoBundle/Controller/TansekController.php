<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\Tansek;
use Acme\DemoBundle\Form\TansekType;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TansekController extends Controller
{

#list 

    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
	$contents = $this->getDoctrine()
	              ->getRepository('AcmeDemoBundle:Tansek')
	              ->findAll();

      if (!$contents) {
        throw $this->createNotFoundException('No contents found');
      }
    
      $build['contents'] = $contents;
      return $this->render('AcmeDemoBundle:Tansek:tansek_show_all.html.twig', $build);
    }

/////////////////////////////////////////////////////////////CRUD Operations of Book////////////////////////////////////////////

#add
	public function addAction()
		{
			$tansek = new tansek();
			$form = $this->createForm(new TansekType(), $tansek);
                        
                        $validator = $this->get('validator');
                        $errors = $validator->validate($tansek);
		
			$request = $this->get('request');
			$form->handleRequest($request);
		
			if($request->getMethod() == 'POST')
			{

				if($form->isValid())
				{
					$em = $this->getDoctrine()->getManager();
					$em->persist($tansek);
					$em->flush();
                                        
                $contents = $this->getDoctrine()
			      ->getRepository('AcmeDemoBundle:Tansek')
			      ->findAll();
					      if (!$contents) {
						throw $this->createNotFoundException('No contents found');
					      }
				      $build['contents'] = $contents;
				      return $this->render('AcmeDemoBundle:Tansek:tansek_show_all.html.twig', $build);
					
				}
			
			   return $this->render('AcmeDemoBundle:Tansek:add.html.twig',array('form'=>$form->createView())); 

			}

			   return $this->render('AcmeDemoBundle:Tansek:add.html.twig',array('form'=>$form->createView())); 

		}
#show	
       public function showAction($id) {
	      $tansek = $this->getDoctrine()
			   ->getRepository('AcmeDemoBundle:Tansek')
			   ->find($id);
	      if (!$tansek) {
		      throw $this->createNotFoundException('No tansek found by id ' . $id);
	      }
	    
	      $build['tansek_item'] = $tansek;
	      return $this->render('AcmeDemoBundle:Tansek:tansek_show.html.twig', $build);
	    }

#edit
	public function editAction($id, Request $request) {
	    $em = $this->getDoctrine()->getManager();
	    $tansek = $em->getRepository('AcmeDemoBundle:Tansek')->find($id);

		$validator = $this->get('validator');
		$errors = $validator->validate($tansek);   
         
	    if (!$tansek) {
	      throw $this->createNotFoundException(
		      'No tansek found for id ' . $id
	      );
	    }
	    
	    $form = $this->createFormBuilder($tansek)
			 ->add('content', 'textarea')
			 ->add('submit','submit')
			 ->getForm();

	    $form->handleRequest($request);

	    if ($form->isValid()) {
					$em->flush();
					$contents = $this->getDoctrine()
						      ->getRepository('AcmeDemoBundle:Tansek')
						      ->findAll();
					      if (!$contents) {
						throw $this->createNotFoundException('No contents found');
					      }
				      $build['contents'] = $contents;
			              return $this->render('AcmeDemoBundle:Tansek:tansek_show_all.html.twig', $build);

		// return new Response('News updated successfully');
	    }
	    
	    $build['form'] = $form->createView();

	    return $this->render('AcmeDemoBundle:Tansek:news_add.html.twig', $build);
	 }
		 
#delete
		 
		 public function deleteAction($id, Request $request) {

		    $em = $this->getDoctrine()->getManager();
		    $tansek = $em->getRepository('AcmeDemoBundle:Tansek')->find($id);
		    if (!$tansek) {
		      throw $this->createNotFoundException(
			      'No tansek found for id ' . $id
		      );
		    }

		      $em->remove($tansek);
		      $em->flush();
		      	return $this->redirect($this->generateUrl('acme_tansek_home'));
		      return new Response('تم مسح بنجاح');

		    
		    $build['form'] = $form->createView();
		    return $this->render('AcmeDemoBundle:Tansek:news_add.html.twig', $build);
		}

	}
