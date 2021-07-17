<?php

namespace App\Http\Controllers\Api;

use App\Models\DevicesToken;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use App\Models\UsersCategories;
use App\Models\UsersSettings;
use Illuminate\Support\Arr;

class UserController extends AppBaseController
{
    use SendsPasswordResetEmails;

    /** @var  UserRepository */
    private $userRepository;
    /** @var roleRepository */
    private $roleRepository;

    public function __construct(UserRepository $userRepo, RoleRepository $roleRepo )
    {
        parent::__construct();
        $this->userRepository = $userRepo;
        $this->roleRepository = $roleRepo;
    }


    /**
     * @OA\Post(
     *   path="/user/login",
     *   summary="User login,
     *   operationId="login",
     *   security={
     *      {
     *          "default": {}
     *      }
     *   },
     *   @OA\Parameter(
     *     name="email",
     *     in="query",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="password",
     *     in="query",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="device_token",
     *     in="query",
     *     required=false,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response=200, description="successful "),
     *   @OA\Response(response=401, description="missing data or Unauthorized"),
     *   @OA\Response(response=404, description="request not found"),
     *   @OA\Response(response=405, description="Method Not Allowed"),
     *   @OA\Response(response=500, description="internal server error")
     * )
     */
    function login(Request $request)
    {
        //check request is not empty
        $valid = validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($valid->fails()) {
            return $this->sendError($valid->errors()->first(), 406);
        }

        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
        {
            auth()->user()->access_token = auth()->user()->createToken('authToken')->accessToken;

            if (!empty($request->input('device_token'))) {
                $data = [
                    'token' => $request->input('device_token'),
                    'user_id' => auth()->user()->id
                ];

                DevicesToken::updateOrCreate($data, $data);
            }

            auth()->user()->token_type = 'Bearer';

            return $this->sendResponse(auth()->user(), 'User retrieved successfully');
        }

        return $this->sendError('Unauthenticated user', 401);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return
     */
    function register(Request $request)
    {
        //check request is not empty
        $valid = validator($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($valid->fails()) {
            return $this->sendError($valid->errors()->first(), 406);
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $user = $this->userRepository->create($data);

        $user->access_token = $user->createToken('Personal Access Token')->accessToken;
        $user->token_type = 'Bearer';

        if (!empty($request->device_token)) {
            $data = [
                'token' => $request->device_token,
                'user_id' => $user->id
            ];

            DevicesToken::Create($data);
        }

        return $this->sendResponse($user, 'User retrieved successfully');
    }

    function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'success' => true,
            'message' => 'You have been successfully logged out!',
        ], 200);
    }

    /**
     * @OA\Post(
     *   path="/user",
     *   summary="User data,
     *   operationId="user",
     *   security={
     *      {
     *          "bearerAuth": {}
     *      }
     *   },
     *
     *   @OA\Response(response=200, description="successful "),
     *   @OA\Response(response=401, description="missing data or Unauthorized"),
     *   @OA\Response(response=404, description="request not found"),
     *   @OA\Response(response=405, description="Method Not Allowed"),
     *   @OA\Response(response=500, description="internal server error")
     * )
     */
    function user(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return $this->sendResponse([
                'error' => true,
                'code' => 404,
            ], 'User not found');
        }

        return $this->sendResponse($user, 'User retrieved successfully');
    }

    function settings(Request $request)
    {
        $inputs = $request->all();

        if (!empty($inputs)) {
            foreach ($inputs as $key=> $value) {
                $data = [
                    'key' => $key,
                    'value' => $value,
                    'user_id' => $this->getUserId(),
                ];

                UsersSettings::updateOrCreate($data);
            }
        }

        $settings = UsersSettings::all(['user_id', 'key', 'value'])->where('user_id', $this->getUserId());

        if (!$settings) {
            return $this->sendResponse([
                'error' => true,
                'code' => 404,
            ], 'Settings not found');
        }

        $settings = Arr::pluck($settings, 'value', 'key');

        return $this->sendResponse($settings, 'Users Settings retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            return $this->sendResponse([
                'error' => true,
                'code' => 404,
            ], 'User not found');
        }
        $input = $request->except(['password', 'api_token']);
        try {

            if (!empty($request->input('device_token'))) {
                $data = [
                    'token' => $request->input('device_token'),
                    'user_id' => auth()->user()->id
                ];

                DevicesToken::updateOrCreate($data, $data);
            }

            $user = $this->userRepository->update($input, $id);

            $user->access_token = auth()->user()->createToken('authToken')->accessToken;

        } catch (ValidatorException $e) {
            return $this->sendResponse([
                'error' => true,
                'code' => 404,
            ], $e->getMessage());
        }

        return $this->sendResponse($user, __('lang.updated_successfully', ['operator' => __('lang.user')]));
    }

    function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        if ($response == Password::RESET_LINK_SENT) {
            return $this->sendResponse(true, 'Reset link was sent successfully');
        } else {
            return $this->sendError([
                'error' => 'Reset link not sent',
                'code' => 401,
            ], 'Reset link not sent');
        }
    }

}
