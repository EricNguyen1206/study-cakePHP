<?php

namespace App\Controller;

use App\Controller\AppController;

class AuthController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'loginAction' => ['controller' => 'Auth', 'action' => 'login'],
            'logoutRedirect' => ['controller' => 'Auth', 'action' => 'login'],
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'username', 'password' => 'password']
                ]
            ],
            'unauthorizedRedirect' => $this->referer()
        ]);
        $this->Auth->allow(['register']);
        $this->loadModel('Users');
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('auth');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect('/projects');
            }
            $this->Flash->error(__('Invalid username or password.'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function register()
    {
        $this->viewBuilder()->setLayout('auth');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('You have successfully registered. Please log in.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Registration failed. Please try again.'));
        }
        $this->set(compact('user'));
    }
}
