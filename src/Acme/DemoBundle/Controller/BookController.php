<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\Book;
use Acme\DemoBundle\Form\BookType;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BookController extends Controller
{

#list 

    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
	$books = $this->getDoctrine()
		          ->getRepository('AcmeDemoBundle:Book')
		          ->findAll();

      if (!$books) {
        throw $this->createNotFoundException('No books found');
      }
    
      $build['books'] = $books;
      $mysessionid=$this->get('session')->get('loginId');


					$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
				 if($myteacher->getJob()=="امين مكتبة"){

		      return $this->render('AcmeDemoBundle:Book:book_show_all.html.twig', $build);
		  }elseif($myteacher->getJob()=="مدير"){
				return $this->render('AcmeDemoBundle:Book:bookformanger_show_all.html.twig', $build);
		

					}

    }

/////////////////////////////////////////////////////////////CRUD Operations of Book////////////////////////////////////////////

#add
	public function addAction()
		{
			$book = new book();
			$form = $this->createForm(new BookType(), $book);
                        
                        $validator = $this->get('validator');
                        $errors = $validator->validate($book);
		
			$request = $this->get('request');
			$form->handleRequest($request);
		
			if($request->getMethod() == 'POST')
			{

				if($form->isValid())
				{
					$em = $this->getDoctrine()->getManager();
					$em->persist($book);
					$em->flush();
					$mysessionid=$this->get('session')->get('loginId');


					$myteacher = $this->getDoctrine()->getRepository('AcmeDemoBundle:Staff')->find($mysessionid);
				 if($myteacher->getJob()=="امين مكتبة"){

                                        
                                        $books = $this->getDoctrine()
						      ->getRepository('AcmeDemoBundle:Book')
						      ->findAll();
					      if (!$books) {
						throw $this->createNotFoundException('No books found');
					      }
				      $build['books'] = $books;
				      return $this->render('AcmeDemoBundle:Book:book_show_all.html.twig', $build);
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
			
			   return $this->render('AcmeDemoBundle:Book:add.html.twig',array('form'=>$form->createView())); 

			}

			   return $this->render('AcmeDemoBundle:Book:add.html.twig',array('form'=>$form->createView())); 

		}
#show	
       public function showAction($id) {
	      $book = $this->getDoctrine()
					    ->getRepository('AcmeDemoBundle:Book')
					    ->find($id);
	      if (!$book) {
		      throw $this->createNotFoundException('No book found by id ' . $id);
	      }
	    
	      $build['book_item'] = $book;
	      return $this->render('AcmeDemoBundle:Book:book_show.html.twig', $build);
	    }

#edit
	public function editAction($id, Request $request) {
	    $em = $this->getDoctrine()->getManager();
	    $book = $em->getRepository('AcmeDemoBundle:Book')->find($id);

		$validator = $this->get('validator');
		$errors = $validator->validate($book);   
         
	    if (!$book) {
	      throw $this->createNotFoundException(
		      'No book found for id ' . $id
	      );
	    }
	    
	    $form = $this->createFormBuilder($book)
					 ->add('name', 'text')
					 ->add('code', 'text')
					 ->add('author', 'text')
					 ->add('publishinghouse', 'text')
					 ->add('submit','submit')
					 ->getForm();

	    $form->handleRequest($request);

	    if ($form->isValid()) {
					$em->flush();
					$books = $this->getDoctrine()
						    ->getRepository('AcmeDemoBundle:Book')
						    ->findAll();
					      if (!$books) {
						throw $this->createNotFoundException('No books found');
					      }
				      $build['books'] = $books;
			              return $this->render('AcmeDemoBundle:Book:book_show_all.html.twig', $build);

		// return new Response('News updated successfully');
	    }
	    
	    $build['form'] = $form->createView();

	    return $this->render('AcmeDemoBundle:Book:news_add.html.twig', $build);
	 }
		 
#delete
		 
		 public function deleteAction($id, Request $request) {

		    $em = $this->getDoctrine()->getManager();
		    $book = $em->getRepository('AcmeDemoBundle:Book')->find($id);
		    if (!$book) {
		      throw $this->createNotFoundException(
			      'No book found for id ' . $id
		      );
		    }

		      $em->remove($book);
		      $em->flush();
	              return $this->redirect($this->generateUrl('acme_book_home'));
		      return new Response('تم مسح الكتاب بنجاح');

		    
		    $build['form'] = $form->createView();
		    return $this->render('AcmeDemoBundle:Book:news_add.html.twig', $build);
		}

	}
