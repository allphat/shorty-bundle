<?php

namespace Alphat\Bundle\ShortyBundle\Controller;

use Alphat\Bundle\ShortyBundle\Entity\ShortyEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShortyController extends Controller
{
    /**
     * @Route("/{code}", name="redir", requirements={"code"= "^[\w]{6}$"})
     * @Method({"GET","HEAD"})
     */
    public function redirectAction($code)
    {
        $short = $this->get('shorty_manager')->findByCode($code);
        $this->get('shorty_manager')->updateCounter($short);

        if (!$short) {
            throw $this->createNotFoundException('Oopps this link does does not exist');
        }

        //@TODO create method to ckeck against options

        return $this->redirect($short->getUrl(), 301);
    }

    /**
     * @Route("/", name="create")
     * @Method({"POST"})
     */
    public function createAction(array $params)
    {
        try {
            if (!empty($params))
            {
                $short = new ShortyEntity();
                $short->setCreatedAt((new \DateTime())->getTimestamp());
                $manager = $this->get('shorty_manager');
                $manager->save($short);

                $response = [
                    $short->getCode()
                ];

                $response = $this->addOptionsToResponse($params, $response;


                return new JsonResponse($response);
            } else {
                throw new \BadRequestException("Error Processing Request");

            }
        } catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e) {
            return new JsonResponse($e->getMessage());
        }
    }


    /**
     * @param arry $params   [description]
     * @param array $response [description]
     * @return array $response
     */
    protected function addOptionsToResponse($params, $response)
    {
        $response['allow_lifetime'] = $this->getParameter('shorty.allow_lifetime');
        if (isset($params['allow_lifetime']) {
            $response = $params['allow_lifetime'];
        }

        $response['allow_secure'] = $this->getParameter('shorty.allow_secure');
        if (isset($params['allow_secure']) {
            $response = $params['allow_secure'];
        }

        $response['allow_follow'] = $this->getParameter('shorty.allow_follow');
        if (isset($params['allow_follow']) {
            $response = $params['allow_follow'];
        }

        return $response;
    }
}
