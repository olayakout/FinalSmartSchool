<?php

namespace Acme\DemoBundle\Controller;
use Acme\DemoBundle\Entity\Studentclass;
use Acme\DemoBundle\Entity\Staffandclass;
use Acme\DemoBundle\Entity\Studentandclass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{
    public function indexAction()
    {
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */
	$classes = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:Studentclass')
            ->findAll();
       $activites = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:Activity')
            ->findAll();
       $staff = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:Staff')
            ->findAll();
      $contents = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:Tansek')
            ->findAll();

        $em = $this->getDoctrine()->getManager();
	$query = $em->createQuery(
	    'SELECT a.body
	    FROM AcmeDemoBundle:Advertising a
	    WHERE a.date > :now
	    ORDER BY a.date ASC'
	)->setParameter('now', new \DateTime('now'));

	$advs = $query->getResult();
      $build['classes'] = $classes;
      $build['activites'] = $activites;
      $build['staff'] = $staff;
      $build['contents'] = $contents;
      $build['advs'] = $advs;
      return $this->render('AcmeDemoBundle:Welcome:index.html.twig', $build);
    }


public function aboutAction(){
      return $this->render('AcmeDemoBundle:Welcome:about.html.twig');
}

public function complainAction(){
      return $this->render('AcmeDemoBundle:Welcome:complain.html.twig');
}

public function contactAction(){
      return $this->render('AcmeDemoBundle:Welcome:contact.html.twig');
}

public function nfcAction(){
      return $this->render('AcmeDemoBundle:Welcome:nfc.html.twig');
}

public function staffAction(){
       $staff = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:Staff')
            ->findAll();

      $build['staff'] = $staff;
      return $this->render('AcmeDemoBundle:Welcome:staff.html.twig', $build);
}

public function advertisingAction(){
       $em = $this->getDoctrine()->getManager();
	$query = $em->createQuery(
	    'SELECT a.body
	    FROM AcmeDemoBundle:Advertising a
	    WHERE a.date > :now
	    ORDER BY a.date ASC'
	)->setParameter('now', new \DateTime('now'));

	$advs = $query->getResult();

      $build['advs'] = $advs;
      return $this->render('AcmeDemoBundle:Welcome:advertising.html.twig', $build);
}

public function libraryAction(){
	$books = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:Book')
            ->findAll();

	$links = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:Link')
            ->findAll();

      $build['books'] = $books;
      $build['links'] = $links;


      return $this->render('AcmeDemoBundle:Welcome:library.html.twig', $build);
}

public function activityAction(){
	$activities = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:Activity')
            ->findAll();


      $build['activities'] = $activities;


      return $this->render('AcmeDemoBundle:Welcome:activity.html.twig', $build);
}

public function classAction(){
	$allclasses = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:Studentclass')
            ->findAll();

	$staffandclasses = $this->getDoctrine()
            ->getRepository('AcmeDemoBundle:Staffandclass')
            ->findAll();


      $build['classes'] = $staffandclasses;
      $build['allclasses'] = $allclasses;


      return $this->render('AcmeDemoBundle:Welcome:class.html.twig', $build);
}

}
