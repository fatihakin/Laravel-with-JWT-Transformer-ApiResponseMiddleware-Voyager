<?php

namespace App\Http\Controllers;


use App\Lib\APIException\NotFoundException;
use App\Lib\ApiResponse;
use App\Lib\Transformer;
use App\Lib\TransformSerializer;
use App\Transformers\EducationHistoryTransformer;
use App\Transformers\FollowTransformer;
use App\Transformers\JwtTransformer;
use App\Transformers\MessageTransformer;
use App\Transformers\UserTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth:jwt', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('jwt')->setTTL(60 * 60 * 24 * 7 * 52)->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        $transformer = (new Transformer())->createData(new Item(['token' => $token], new JwtTransformer()));
        return new ApiResponse($transformer->toArray());
    }


    public function me()
    {
//        throw (new NotFoundException())->setMessages(['mesaj 1', 'mesaj 2']);
        $user = auth('jwt')->users();
        $transformer = (new Transformer())
            ->createData(new Item($user, new UserTransformer()));

        return new ApiResponse(
            $transformer->toArray()
        );

    }

    public function logout()
    {
        auth('jwt')->logout();
        $transformer = (new Transformer())
            ->createData(new Collection(['Successfully logged out'], new MessageTransformer()));

        return new ApiResponse(
            $transformer->toArray()
        );
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('jwt')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('jwt')->factory()->getTTL() * 60
        ]);
    }
}
