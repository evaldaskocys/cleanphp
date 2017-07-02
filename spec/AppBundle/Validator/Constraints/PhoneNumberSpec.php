<?php

namespace spec\AppBundle\Validator\Constraints;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PhoneNumberSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Validator\Constraints\PhoneNumber');
    }
}
