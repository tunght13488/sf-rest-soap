<?php

namespace AppBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BookController.
 */
class BookController extends FOSRestController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getBooksAction(Request $request)
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle:Book');
        $entities = $repo->findByConditions($request->query->all());

        $view = $this->view($entities, 200)
                     ->setTemplate(':api/book:index.html.twig');

        return $this->handleView($view);
    }
}
