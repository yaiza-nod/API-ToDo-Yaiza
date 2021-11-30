<?php

namespace App\Validator;

use App\Entity\User;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;


class UserFound extends Constraint
{
    public $message = 'Usuario no encontrado';
    //public $mode = 'strict'; // If the constraint has configuration options, define them as public properties

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UserFound) {
            throw new UnexpectedTypeException($constraint, UserFound::class);
        }

        if ($value === NULL) {

            $this->context->buildViolation($constraint->message)
                ->addViolation();

            // separate multiple types using pipes
            // throw new UnexpectedValueException($value, 'string|int');
        }
    }
}