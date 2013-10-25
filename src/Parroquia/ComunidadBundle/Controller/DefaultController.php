<?php

namespace Parroquia\ComunidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ParroquiaComunidadBundle:Default:index.html.twig', array('name' => $name));
    }
}
