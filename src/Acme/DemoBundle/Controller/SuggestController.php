<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\Suggest;
use Acme\DemoBundle\Form\SuggestType;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SuggestController extends Controller
{

#list 

    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
	$suggests = $this->getDoctrine()
	              ->getRepository('AcmeDemoBundle:Suggest')
	              ->findAll();

      if (!$suggests) {
        throw $this->createNotFoundException('No suggests found');
      }
    
      $build['suggests'] = $suggests;
      return $this->render('AcmeDemoBundle:Suggest:suggest_show_all.html.twig', $build);
    }

/////////////////////////////////////////////////////////////CRUD Operations of Book////////////////////////////////////////////

#add
	public function addAction()
		{
			$suggest = new Suggest();
			$form = $this->createForm(new SuggestType(), $suggest);
                        
                        $validator = $this->get('validator');
                        $errors = $validator->validate($suggest);
		
			$request = $this->get('request');
			$form->handleRequest($request);
		
			if($request->getMethod() == 'POST')
			{

				if($form->isValid())
				{
					$em = $this->getDoctrine()->getManager();
					$suggest->setDate(new \DateTime("now"));
					$em->persist($suggest);
					$em->flush();
                                        
                                    return $this->render('AcmeDemoBundle:Suggest:thanks.html.twig');
					
				}
			
			   return $this->render('AcmeDemoBundle:Suggest:add.html.twig',array('form'=>$form->createView())); 

			}

			   return $this->render('AcmeDemoBundle:Suggest:add.html.twig',array('form'=>$form->createView())); 

		}
#show	
       public function showAction($id) {
	      $suggest = $this->getDoctrine()
			   ->getRepository('AcmeDemoBundle:Suggest')
			   ->find($id);
	      if (!$suggest) {
		      throw $this->createNotFoundException('No suggest found by id ' . $id);
	      }
	    
	      $build['suggest'] = $suggest;
	      return $this->render('AcmeDemoBundle:Suggest:suggest_show.html.twig', $build);
	    }
 
#delete
		 
		 public function deleteAction($id, Request $request) {

		    $em = $this->getDoctrine()->getManager();
		    $suggest = $em->getRepository('AcmeDemoBundle:Suggest')->find($id);
		    if (!$suggest) {
		      throw $this->createNotFoundException(
			      'No suggest found for id ' . $id
		      );
		    }

		      $em->remove($suggest);
		      $em->flush();
		      	return $this->redirect($this->generateUrl('acme_suggest_home'));
		      return new Response('تم مسح بنجاح');

		    
		    $build['form'] = $form->createView();
		    return $this->render('AcmeDemoBundle:Suggest:news_add.html.twig', $build);
		}

	}
