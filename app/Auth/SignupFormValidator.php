<?php

declare(strict_types=1);

namespace App\Auth;

use Handlr\Core\Request;
use Handlr\Core\Response;
use Handlr\Validation\FormValidator;

class SignupFormValidator extends FormValidator
{
    public function __construct(private readonly UsersTable $usersTable) {}

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
        ];
    }

    public function handle(Request $request, Response $response, array $args, callable $next): Response
    {
        $n = parent::handle($request, $response, $args, $next);

        $data = $request->getParsedBody();
        unset($data['password'], $data['password_confirmation']);

        $user = $this->usersTable->findFirst($data);
        if ($user) {
            return $response->withJson(['error' => 'Unable to signup'], Response::HTTP_BAD_REQUEST);
        }

        var_dump(__METHOD__);

        return $n;
    }
}

