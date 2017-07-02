<?php

namespace spec\AppBundle\Validator\Constraints;

use AppBundle\Validator\Constraints\PhoneNumber;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilder;

class PhoneNumberValidatorSpec extends ObjectBehavior
{
    function let(ExecutionContextInterface $context)
    {
        $this->initialize($context);
    }

    function it_allows_valid_lithuanian_phone_number($context)
    {
        $context->buildViolation(Argument::any())->shouldNotBeCalled();
        $this->validate('+37060000000', new PhoneNumber);
    }

    function it_does_not_allow_too_short_phone_number(
        $context,
        Constraint $constraint,
        ConstraintViolationBuilder $violationBuilder
    ) {
        $phone = '+3706000000';

        $context->buildViolation(Argument::any())
            ->shouldBeCalled()
            ->willReturn($violationBuilder);
        $violationBuilder->setParameter(Argument::exact('%number%'), Argument::exact($phone))
            ->shouldBeCalled()
            ->willReturn($violationBuilder);
        $violationBuilder->addViolation()->shouldBeCalled();
        
        $this->validate($phone, new PhoneNumber);
    }

    function it_does_not_allow_too_long_phone_number(
        $context,
        Constraint $constraint,
        ConstraintViolationBuilder $violationBuilder
    ) {
        $phone = '+370600000000';

        $context->buildViolation(Argument::any())
            ->shouldBeCalled()
            ->willReturn($violationBuilder);
        $violationBuilder->setParameter(Argument::exact('%number%'), Argument::exact($phone))
            ->shouldBeCalled()
            ->willReturn($violationBuilder);
        $violationBuilder->addViolation()->shouldBeCalled();

        $this->validate($phone, new PhoneNumber);
    }
}
