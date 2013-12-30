<?php

namespace Parroquia\CorreoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ParroquiaCorreoBundle:Default:index.html.twig');
    }   
}
