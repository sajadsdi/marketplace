<?php

namespace Sajadsdi\Marketplace\Http\Controllers\API\V1\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Sajadsdi\Marketplace\Http\Controllers\API\V1\BaseApiController;
use Sajadsdi\Marketplace\Http\Requests\API\V1\Auth\LoginRequest;
use Sajadsdi\Marketplace\Http\Requests\API\V1\Auth\RegisterRequest;
use Sajadsdi\Marketplace\Repository\User\UserRepositoryInterface;

class AuthController extends BaseApiController
{
    /**
     * @param LoginRequest $request
     *
     * @return Response|ResponseFactory
     */
    public function login(LoginRequest $request): Response|ResponseFactory
    {
        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $user  = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            if ($token) {
                return $this->response([
                    'user'          => $user,
                    'authorization' => [
                        'token' => $token,
                        'type'  => 'bearer',
                    ]
                ]);
            }
        }

        return $this->unauthorizedResponse('Login failed!', ['email' => 'invalid!', 'password' => 'invalid!']);
    }

    /**
     * @return Response|ResponseFactory
     */
    public function user(): Response|ResponseFactory
    {
        return $this->response(['user' => Auth::user()]);
    }

    /**
     * @param RegisterRequest $request
     * @param UserRepositoryInterface $userRepository
     *
     * @return Response|ResponseFactory
     */
    public function register(RegisterRequest $request, UserRepositoryInterface $userRepository): Response|ResponseFactory
    {
        $user = $userRepository->register([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        event(new Registered($user));

        $token = $user->createToken('authToken')->plainTextToken;

        return $this->response([
            'user'          => $user,
            'authorization' => [
                'token' => $token,
                'type'  => 'bearer',
            ]
        ]);
    }

    /**
     * Logout the user and invalidate the current token.
     */
    public function logout(Request $request): Response|ResponseFactory
    {
        $request->user()->currentAccessToken()->delete();

        return $this->response([],'Successfully logged out');
    }
}
