<?php

namespace Parroquia\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ParroquiaHomeBundle:Default:index.html.twig');
    }
}
