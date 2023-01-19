<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

class Login extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        $userModel = new UserModel();

        $email = $this->request->getVar('email');
        $userName = $this->request->getVar('username');
        $password = $this->request->getVar('password');


        $user = $userModel->where('username', $userName)->first();
        $userEmail = $userModel->where('email', $email)->first();

        if (is_null($user) && is_null($userEmail)) {
            # no user was found
            return $this->respond(['error' => 'Invalid credentials'], 401);
        }

        $pwd_verify = null;

        if (is_null($user)) {
            # no user was found
            $pwd_verify = password_verify($password, $userEmail['password']);
        } else {
            $pwd_verify = password_verify($password, $user['password']);
        }
        

        if (is_null(!$pwd_verify)) {
            # wrong password
            return $this->respond(['error' => 'Invalid credentials'], 401);
        }

        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;

        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat,
            //Time the JWT issued at
            "exp" => $exp,
            // Expiration time of token
            //"email" => $user['email'],
        );

        $token = JWT::encode($payload, $key, 'HS256');

        $response = [
            'message' => 'Login Succesful',
            'token' => $token
        ];

        return $this->respond($response, 200);
    }
}