<?php


namespace App\Controllers;

use App\Models\UserModel;


class Users extends \CodeIgniter\Controller
{
    public function login(){
        $data = [];
        helper(["form"]);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Email or Password doesn\'t match'
                ]
            ];

            if (! $this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            }

            else{
                $model = new UserModel();

                $user = $model->where('email', $this->request->getVar('email'))
                    ->first();

                $this->setUserSession($user);
                return redirect()->to('activity');

            }
        }
        return view("login_page", $data);
    }

    private function setUserSession($user){
        $data = [
            'id' => $user['iduser'],
            'username' => $user['username'],
            'email' => $user['email'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }


    public function register(){
        helper(["form"]);
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'username' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]',
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
            }
            else {
                $model = new UserModel();

                $newData = [
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                ];
                $model->insert($newData);
                $session = session();
                $session->setFlashdata('success', 'Successful Registration');
                return redirect()->to("login");

            }
        }

        return view("register_page", $data);
    }

    public function logout(){
        session()->destroy();
        $session = session();
        $session->setFlashdata('logout', 'You are logged out now');
        return redirect()->to('/');
    }
}