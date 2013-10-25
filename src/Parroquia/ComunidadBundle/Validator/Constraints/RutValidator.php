<?php

namespace Parroquia\ComunidadBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RutValidator extends ConstraintValidator
{   
    public function validate($value, Constraint $constraint)
    {
        $rut=str_replace('.', '', $value);
        if($rut != "")
        {
            if (preg_match('/^(\d{1,9})-((\d|k|K){1})$/',$rut,$d))
            {
                $s=1;$r=$d[1];for($m=0;$r!=0;$r/=10)$s=($s+$r%10*(9-$m++%6))%11;
                if(chr($s?$s+47:75)!=strtoupper($d[2]))
                {
                    $this->context->addViolation($constraint->message, array('%rut%' => $value));
                }            
            }
            else
            {
                $this->context->addViolation($constraint->message, array('%rut%' => $value));
            }
        }
    }
}