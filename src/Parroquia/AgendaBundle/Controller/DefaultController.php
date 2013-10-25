<?php

namespace Parroquia\AgendaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ParroquiaAgendaBundle:Default:index.html.twig', array('name' => $name));
    }
}
