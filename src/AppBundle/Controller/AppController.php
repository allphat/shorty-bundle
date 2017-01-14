<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ShorturlEntity;
use AppBundle\Manager\ShorturlManager;
use AppBundle\Form\ShorturlType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AppController extends Controller
{
    /**
     * @Route("/{code}", name="redir", requirements={"code"= "^[\w]{6}$"})
     * @Method({"GET","HEAD"})
     */
    public function redirectAction($code)
    {
        $short = $this->get('app_manager')->findByCode($id);

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
        $form = $this->createForm(ShorturlType::class, new ShorturlEntity());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
    
            $manager = $this->get('app_manager');
    
            $short = $form->getData();
            $short->setCreatedAt((new \DateTime())->getTimestamp());
            $manager->save($short);            

             $this->addFlash('success', 'Shorten url created: ' . $short->getCode());
        }

        return $this->render('app/create.html.twig', array(
            'form' => $form->createView(),
            'page_title' => 'short urls creation'
        ));
    }
}
