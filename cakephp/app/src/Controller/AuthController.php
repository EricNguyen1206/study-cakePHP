<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;

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
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->request->session()->write('Auth.User', $user);

                // Generate one-time login token
                $token = [
                    'token' => Security::hash(Security::randomBytes(32), 'sha256', true),
                    'expires' => (new \DateTime())->modify('+1 hour')->getTimestamp()
                ];

                $this->request->session()->write('Auth.Token', $token);
                return $this->redirect('/notes');
            }
            $this->Flash->error(__('Invalid username or password.'));
        }
    }

    public function logout()
    {
        $session = $this->request->session();
        $session->destroy();
        return $this->redirect($this->Auth->logout());
    }

    public function register()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->password = (new DefaultPasswordHasher())->hash($user->password);
            $user->role = 'developer';
            if ($this->Users->save($user)) {
                $this->Flash->success(__('You have successfully registered. Please log in.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Registration failed. Please try again.'));
        }
        $this->set(compact('user'));
    }
}
