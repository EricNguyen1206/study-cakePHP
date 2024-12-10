<?php

namespace App\Controller;

use App\Controller\AppController;

class UserProjectRolesController extends AppController
{
    public function index()
    {
        $roles = $this->UserProjectRoles->find('all', [
            'contain' => ['Users', 'Projects'],
        ]);
        $this->set(compact('roles'));
    }

    public function add()
    {
        $role = $this->UserProjectRoles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->UserProjectRoles->patchEntity($role, $this->request->getData());
            if ($this->UserProjectRoles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to save the role.'));
        }
        $users = $this->UserProjectRoles->Users->find('list');
        $projects = $this->UserProjectRoles->Projects->find('list');
        $this->set(compact('role', 'users', 'projects'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->UserProjectRoles->get($id);
        if ($this->UserProjectRoles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the role.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
