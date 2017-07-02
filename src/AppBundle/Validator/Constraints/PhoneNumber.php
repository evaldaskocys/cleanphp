<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class PhoneNumber extends Constraint
{
    public $message = 'The number "%number%" is not a valid phone number.';
}
