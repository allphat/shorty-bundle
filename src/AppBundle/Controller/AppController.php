<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ShorturlEntity;
use AppBundle\Manager\ShorturlManager;
use AppBundle\Form\ShorturlType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;


class AppController extends Controller
{
    /**
     * @Route("/{code}", name="redir", requirements={"code"= "^[\w]{6}$"})
     * @Method({"GET","HEAD"})
     */
    public function redirectAction($code)
    {
        $short = $this->get('app_manager')->findByCode($code);
        $this->get('app_manager')->updateCounter($short);

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
        try {
            $form = $this->createForm(ShorturlType::class, new ShorturlEntity());

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->get('app_manager');

                $short = $form->getData();
                $short->setCreatedAt((new \DateTime())->getTimestamp());
                $short->setCounter(0);
                $manager->save($short);


                $littleUrl = $request->getSchemeAndHttpHost() . '/' . $short->getCode();
                $this->addFlash('success', 'Short url created: <a alt="short url created" href="' . $littleUrl . '">' . $littleUrl . '</a>.');

               return new RedirectResponse('/'); //avoid form resubmission
            }


        } catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e) {
            $this->addFlash('danger', 'An error occured. Please try again.');
        }

        return $this->render('app/create.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
