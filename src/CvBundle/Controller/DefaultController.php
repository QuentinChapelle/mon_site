<?php

namespace CvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CvBundle\Form\ContactType;
use CvBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);
        $session = $request->getSession();
        $session->start();
        $id = '';


        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Contact From CV en Ligne')
                    ->setFrom('Mon@Site.fr')
                    ->setTo('chapellequentin@live.fr')
                    ->setBody($this->renderView('contact/sentMail.txt.twig', array('contact' => $contact)));
                $this->get('mailer')->send($message);

                $this->addFlash('contact-notice', "Votre message à bien été envoyé, je reviens vers vous au plus vite !");

                return $this->redirect($this->generateUrl('home', array('id' => $id)) . '#slide5');
            }
        }


        return $this->render('CvBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/mentions_légales", name="mentions")
     */
    public function mentionsAction()
    {
        return $this->render('CvBundle:Default:mentions.html.twig');
    }
}