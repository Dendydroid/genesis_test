<?php

namespace App\Http;

use App\Core\Controller;
use App\Core\FailResponse;
use App\Core\SuccessResponse;
use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validation;

class IndexController extends Controller
{
    /**
     * @var ContactRepository $contactRepository
     */
    private $contactRepository;

    public function __construct()
    {
        parent::__construct();

        $this->contactRepository = $this->database->getEntityManger()->getRepository(Contact::class);
    }

    public function index()
    {
        $contacts = $this->contactRepository->all();
        return new Response(
            new SuccessResponse(
                "All contacts have been retrieved!",
                $contacts
            )
        );
    }

    public function add()
    {
        $request = app()->request;

        $parameterName = "";

        $errors = $this->invalid([
            "phones" => [
                new NotBlank(),
                new NotNull(),
                new Regex("/^\d+(,\d+)*$/")
            ],
            "firstName" => [
                new NotBlank(),
                new NotNull(),
                new Length([
                    'min' => 2,
                    'max' => 50,
                ]),
                new Regex("/^[A-Za-z]+$/")
            ],
            "lastName" => [
                new NotBlank(),
                new NotNull(),
                new Length([
                    'min' => 2,
                    'max' => 50,
                ]),
                new Regex("/^[A-Za-z]+$/")
            ],
        ], $parameterName);

        if($errors instanceof ConstraintViolationList && $errors->count())
        {
            return new Response(
                new FailResponse(
                    "Validation errors.",
                    $errors,
                    $parameterName
                )
            );
        }

        $contact = new Contact();
        $contact->phones = explode(",", $request->get('phones'));
        $contact->firstName = $request->get('firstName');
        $contact->lastName = $request->get('lastName');
        $this->contactRepository->save($contact);

        return new Response(
            new SuccessResponse(
                "A contact has been created!",
                $contact->id
            )
        );
    }
}