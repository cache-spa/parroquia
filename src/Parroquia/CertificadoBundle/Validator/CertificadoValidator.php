<?php

namespace Parroquia\CertificadoBundle\Validator;

use Symfony\Component\Validator\ExecutionContextInterface;
use Parroquia\CertificadoBundle\Entity\Certificado;

class CertificadoValidator
{
    public static function isCertificadoValid(Certificado $certificado, ExecutionContextInterface $context)
    {        
        $persona = $certificado->getPersona();
        $tipo = $certificado->getTipo();

        if($tipo == 'Bautizo')
        {
            if(!$persona->getBautizo())
            {
                $context->addViolationAt('tipo', 'No hay datos de '.$tipo.' para '.$persona->__toString(). ' registrados en el sistema.', array(), null);
            }
        }
        elseif($tipo == 'Confirmación')
        {
            if(!$persona->getConfirmacion())
            {
                $context->addViolationAt('tipo', 'No hay datos de '.$tipo.' para '.$persona->__toString(). ' registrados en el sistema.', array(), null);                    
            }
        }
        elseif($tipo == 'Matrimonio')
        {
            if($persona->getMatrimonios()->count() == 0)
            {
                $context->addViolationAt('tipo', 'No hay datos de '.$tipo.' para '.$persona->__toString(). ' registrados en el sistema.', array(), null);
            }               
        } 
    }
}
