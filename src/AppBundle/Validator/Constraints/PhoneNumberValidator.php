<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PhoneNumberValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!preg_match('/^\+3706\d{7}$/', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%number%', $value)
                ->addViolation();
        }
    }
}
