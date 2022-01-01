<?php

namespace Allphat\Bundle\ShortyBundle\Controller;

use Allphat\Bundle\ShortyBundle\Manager\ShortyManager;
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
     * Route("/{code}", name="redirect", requirements={"code"= "^[\w]{6}$"})
     * Method({"GET","HEAD"})
     */
    /*public function redirectAction($code)
    {
        $short = $this->get('shorty.manager')->findByCode($code);

        if (!$short) {
            throw $this->createNotFoundException('Oopps this link does does not exist');
        }
        
        $this->get('shorty_manager')->updateCounter($short);

        //@TODO create method to ckeck against options

        return $this->redirect($short->getUrl(), 301);
    }*/

    /**
     * @Route("/", name="create", service="shorty.controller")
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