<?php

namespace Parroquia\CertificadoBundle\Validator;

use Symfony\Component\Validator\ExecutionContextInterface;
use Parroquia\CertificadoBundle\Entity\Ministro;

class MinistroValidator
{
    public static function isMinistroValid(Ministro $ministro, ExecutionContextInterface $context)
    {
        if($ministro->getFechaCursoInicio() > $ministro->getFechaCursoTermino())
        {
            $context->addViolationAt('fecha_curso_termino', 'Fecha de Término del Curso debe ser posterior o igual a la de Inicio');
        }
        
        if($ministro->getFechaVigenciaInicio() > $ministro->getFechaVigenciaTermino())
        {
            $context->addViolationAt('fecha_vigencia_termino', 'Fecha de Término de Vigencia debe ser posterior o igual a la de Inicio');
        }        
    }
}