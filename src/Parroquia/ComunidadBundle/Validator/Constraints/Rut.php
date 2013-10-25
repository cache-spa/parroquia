<?php

namespace Parroquia\ComunidadBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Rut extends Constraint
{
    public $message = 'The rut "%rut%" is not a valid value.';
}
