<?php

namespace App\Controllers;

class User extends BaseController
{
    public function getIndex()
    {
        return redirect()->to('/user/signin');
    }

    public function postRegister()
    {
        $userModel = model('User');
        $email = $this->request->getPost('email');

        if ($userModel->where('email', $email)->countAllResults() > 0)
        {
            return redirect()->to('/user/register')->with('errors', ['email' => 'The email has already been registered.']);
        }

        // Validate password with passconf
        if (!$this->validate(\App\Models\User::$passwordValidation))
        {
            return redirect()->to('/user/register')->with('errors', $this->validator->getErrors());
        }

        $name = $this->request->getPost('name');
        $password = $this->request->getPost('password');

        $password_hash = password_hash($password, null);

        $userModel->save([
            'name' => $name,
            'email' => $email,
            'password' => $password_hash,
        ]);

        return redirect()->to('/user/signin')->with('success', ['You have successfully registered!']);
    }
    public function getRegister()
    {
        if ($this::getUser())
        {
            return redirect()->to('/');
        }

        $data = [
            'errors' => session()->getFlashData('errors'),
        ];
        return view('register', $data);
    }

    public function postSignin()
    {
        $userModel = model('User');

        // Validate email and check if it exists
        if (!$this->validate(\App\Models\User::$loginValidation))
        {
            return redirect()->to('/user/signin')->with('errors', $this->validator->getErrors());
        }
        
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();
        if (!password_verify($pass, $user['password']))
        {
            return redirect()->to('/user/signin')->with('errors', ['The password is incorrect.']);
        }

        $ttl = 0;

        if (!$this->request->getPost('remember-me'))
        {
            //$ttl = 3600 * 2;
            $ttl = 5;
        }

        static::setUser($user, $ttl);
        return redirect()->to('/');
    }
    public function getSignin()
    {
        if (static::getUser())
        {
            return redirect()->to('/');
        }

        $data = [
            'errors' => session()->getFlashdata('errors'),
            'success' => session()->getFlashdata('success'),
        ];

        return view('signin', $data);
    }

    public function getSignout()
    {
        static::removeUser();
        return redirect()->back();
    }

    public static function getUser() : array|null
    {
        if ($temp = session()->getTempdata('user'))
        {
            session()->setTempdata('user', $temp);
        }
        return session()->get('user');
    }

    public static function setUser(array $user, bool $remember = false)
    {
        if (!$remember)
        {
            session()->setTempdata('user', $user);
        }
        else
        {
            session()->set('user', $user);
        }
    }

    public static function removeUser()
    {
        session()->remove('user');
    }
}
