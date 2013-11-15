<?php

namespace Parroquia\CertificadoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Parroquia\CertificadoBundle\Entity\Certificado;

define('CERTIFICADOS_PATH', __DIR__.'/../../../../web/certificados/');

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ParroquiaCertificadoBundle:Default:index.html.twig');
    }
    
    public function testAction()
    {
        $vars = 'hola';
        $html = $this->renderView('ParroquiaCertificadoBundle:Default:test.html.twig', array(
            'vars'  => $vars
        ));      
        
        $certificado = new Certificado();
        
        $fechaemision = new \DateTime();
        $filename = 'certificado'.sha1(uniqid(mt_rand(), true)).'.pdf'; //uso interno
      
        $certificado->name = 'certificado '.date_format($fechaemision,'Y-m-d His');  
        $certificado->setFechaEmision($fechaemision);        
        $certificado->setPath($filename);
        
        $this->get('knp_snappy.pdf')->generateFromHtml($html,CERTIFICADOS_PATH.$filename);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($certificado);
        $em->flush();        
        
        return $this->render('ParroquiaCertificadoBundle:Default:index.html.twig');

    }    
    
}
