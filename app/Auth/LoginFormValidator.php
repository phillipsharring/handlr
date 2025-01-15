<?php

declare(strict_types=1);

namespace App\Auth;

use Handlr\Core\Request;
use Handlr\Core\Response;
use Handlr\Validation\FormValidator;

class LoginFormValidator extends FormValidator
{
    public function __construct(private readonly UsersTable $usersTable) {}

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function handle(Request $request, Response $response, array $args, callable $next): Response
    {
        $n = parent::handle($request, $response, $args, $next);

        $data = $request->getParsedBody();
        unset($data['password']);

        $user = $this->usersTable->findFirst($data);
        if (!$user) {
            return $response->withJson(['error' => 'Invalid email or password'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $n;
    }
}
