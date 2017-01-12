<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AppController extends Controller
{
    /**
     * @Route("/{shortId}", name="redirect", requirements={"shortId": "^\w[6]$"})
     * @Method({"GET","HEAD"})
     */
    public function redirectAction($shortId)
    {
        //find url linked to current uri
        //if found
            //redirect
        //sinon
            //404

        //si bad params
            //400
        //

        
    }

    /**
     * @Route("/create", name="create")
     * @Method({"GET","POST"})
     */
    public function createAction(Request $request)
    {

        //get form

        //si form soumis
            // si ok
                //generation uri
                //insert en base
                //affiche vue avec message ok + uri
            //sinon
                //affiche vue avec erreurs
    }
}
