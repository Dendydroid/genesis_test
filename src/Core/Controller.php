<?php

namespace App\Core;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Validation;

abstract class Controller
{
    protected Database $database;

    public function invalid(array $rules, string &$invalidParameter = "")
    {
        $request = app()->request;

        $bodyParams = $request->request->all();

        if($getData = $request->query->all())
        {
            $bodyParams += $getData;
        }

        $validator = Validation::createValidator();

        $bodyErrors = $validator->validate($bodyParams, [
            new NotNull(),
            new NotBlank(),
        ]);

        if($bodyErrors->count())
        {
            $invalidParameter = "body";
            return $bodyErrors;
        }

        $errors = null;

        foreach ($rules as $key => $value)
        {
            $errors = $validator->validate($bodyParams[$key] ?? null, $value);

            if($errors->count())
            {
                $invalidParameter = $key;
                return $errors;
            }
        }

        return $errors;
    }

    public function __construct()
    {
        $this->database = app()->get("database");
    }
}