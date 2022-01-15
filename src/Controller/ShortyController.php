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
     * @Route("/", name="allphat_shorty_create", service="shorty.controller")
     * @Method({"POST"})
     */
    public function createAction(): JsonResponse
    {
        try {

            $short = $this->shortyManager->save();

            $response = [
                $short->getCode()
            ];


            return new JsonResponse(['code' => $response]);

        } catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e) {
            return new JsonResponse($e->getMessage());
        }
    }

    /**
     * param array $params   [description]
     */
    //protected function checkOptions($params)
    //{
        /*$response['allow_lifetime'] = $this->getParameter('shorty.allow_lifetime');
        if (isset($params['allow_lifetime'])) {
            throw new \Exception('');
        }

        $response['allow_secure'] = $this->getParameter('shorty.allow_secure');
        if (isset($params['allow_secure']) && is_null($params['allow_secure'])) {
            throw new \Exception('secured url not allowed');
        }

        $response['allow_follow'] = $this->getParameter('shorty.allow_follow');
        if (isset($params['allow_follow'])  && is_null($params['allow_follow'])) {
            throw new \Exception('Redirection not allowed');
        }*/
    //}
}