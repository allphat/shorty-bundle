<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Shorturl;
use AppBundle\Manager\ShorturlManager;
use AppBundle\Form\ShorturlType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AppController extends Controller
{
    /**
     * @Route("/{id}", name="redir", requirements={"id"= "^[\w]{6}$"})
     * @Method({"GET","HEAD"})
     */
    public function redirectAction($id)
    {
        $short = $this->getDoctrine()
            ->getRepository('AppBundle:Shorturl')
            ->findByCode($id)[0];
        if (!$short) {
            throw $this->createNotFoundException('Oopps this link does does not exist');
        }

        return $this->redirect($short->getUrl(), 301);        
    }

    /**
     * @Route("/", name="create")
     * @Method({"GET","POST"})
     */
    public function createAction(Request $request)
    {

        $short = new Shorturl();

        $form = $this->createForm(ShorturlType::class, $short);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->get('app_manager');
            $short = $form->getData();
            $short->setCode($manager->encode());
            $short->setCreatedAt((new \DateTime())->getTimestamp());
            

             $em = $this->getDoctrine()->getManager();
             $em->persist($short);
             $em->flush();

             $this->addFlash('success', 'Shorten url created: ' . $short->getCode());
        }

        return $this->render('app/create.html.twig', array(
            'form' => $form->createView(),
            'page_title' => 'short urls creation'
        ));
    }
}
