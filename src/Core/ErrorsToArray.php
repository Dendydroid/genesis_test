<?php

namespace App\Core;

use Symfony\Component\Validator\ConstraintViolationList;

trait ErrorsToArray
{
    public static function violationListToArray(ConstraintViolationList $errors, $invalidParameter = ""): array
    {
        $formattedViolationList = [];

        if ($errors->count() > 0) {
            for ($i = 0; $i < $errors->count(); $i++) {
                $violation = $errors->get($i);
                $formattedViolationList[] = [$invalidParameter ? $invalidParameter : $violation->getPropertyPath() => $violation->getMessage()];
            }
        }

        return $formattedViolationList;
    }
}