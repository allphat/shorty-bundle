<?php

namespace Allphat\ShortyBundle\Controller;

use Allphat\ShortyBundle\Manager\ShortyManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShortyController extends AbstractController
{
	/**
	 * @var ShortyManager
	 */
	
    private $shortyManager;

    public function __construct(ShortyManager $shortyManager)
    {
        $this->shortyManager = $shortyManager;
    }

    /**
     * Route("/{code}", name="allphat_shorty_redirect", requirements={"code"= "^[\w]{6}$"})
     * Method({"GET","HEAD"})
     */
    public function redirectAction(string $code)
    {
        $short = $this->get('shorty.manager')->findByCode($code, $this->getParameter('allphat_shorty.allow_secure_only'));

        if (!$short) {
            throw $this->createNotFoundException('Oopps this link does does not exist');
        }
        
        $allowMaxCalls = $this->getParameter('allphat_shorty.allow_max_calls');
        if ($allowMaxCalls && $short->getCounter() >= $short->getMaxCalls()) {
            throw $this->createNotFoundException('Oopps this link does does not exist anymore');
        }

        $short = $this->get('shorty_manager')->updateCounter($short);

        return $this->redirect($this->getParameter('allphat_shorty.shorty_host') . '/' . $short->getCode(), 301);
    }

    /**
     * @TODO gerer le cas ou le code genere est deja utilise
     * @TODO gerer les templates
     *
     * @Route("/shorty/new", name="allphat_shorty_create", service="shorty.controller")
     */
    public function new(): JsonResponse
    {
        $short = new ShortyEntity();

        $form = $this->createForm(ShortType::class, $task, this->getParameter('allphat_shorty'));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $short = $form->getData();
                
            $this->get('shorty.manager')->createEntity($short);

            //return $this->redirectToRoute('task_success');
        }

        return $this->renderForm('short/new.html.twig', [
            'form' => $form,
        ]);

        //} catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e) {
        //    return new JsonResponse($e->getMessage());
        //}
    }
}