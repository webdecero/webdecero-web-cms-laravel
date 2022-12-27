<?php


namespace Webdecero\Webcms\Controllers\Manager;

//Facades
use Carbon\Carbon;
use Webdecero\Webcms\Models\Admin;
//Models
use Illuminate\Http\Request;

use Webdecero\Webcms\Traits\ResponseApi;
//Class
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Webdecero\Webcms\Controllers\Manager\ManagerController;

class LoginController extends ManagerController
{
    use ResponseApi;

    protected $redirectAuth;

    public function __construct()
    {
        parent::__construct();

        $this->redirectAuth = config('webcms.settings.manager.settings.redirectAuth', '/');
    }

    public function login(Request $request)
    {

        $rules = array(
            'email' => array('required', 'email'),
            'password' => array('required', 'min:6'),
        );

        $input = $request->all();

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return $this->sendError('Validator', $validator->errors()->all(), 422);
        }

        $admin = $this->_adminAuthentication($input['email'], $input['password']);
        
        if (!$admin) {
            return $this->sendError('Authentication', trans('Credenciales incorrectas'), 403);
        }
        
        return $this->sendResponse($this->_createAccesTokenResponse($admin));
    }


    private function _adminAuthentication($email, $password, $status = true)
    {

        $credentials = [
            'email' => $email,
            'status' => $status,
        ];

        $admin = Admin::where($credentials)->first();
        return $admin && Hash::check($password, $admin->password) ? $admin : false;
    }

    private function _createAccesTokenResponse($user, $menssage = 'Personal Access Token WebDeCero')
    {
        if ($user->role === NULL) {
            $user->role = '*';
        }
        
        $tokenResult = $user->createToken($menssage, [$user->role])->accessToken;

        return [
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
        ];
    }
}