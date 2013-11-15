<?php

namespace Parroquia\ComunidadBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Rut extends Constraint
{
    public $message = 'El rut "%rut%" no es válido.';
}
