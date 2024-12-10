<?php

namespace App\Controller;

use App\Controller\AppController;

class UserProjectController extends AppController
{
    public function index()
    {
        $user_project = $this->UserProject->find('all', [
            'contain' => ['Users', 'Projects'],
        ]);
        $this->set(compact('user_project'));
    }

    public function add()
    {
        $relation = $this->UserProject->newEntity();
        if ($this->request->is('post')) {
            $role = $this->UserProject->patchEntity($relation, $this->request->getData());
            if ($this->UserProject->save($relation)) {
                $this->Flash->success(__('The relation has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to save the relation.'));
        }
        $users = $this->UserProject->Users->find('list');
        $projects = $this->UserProject->Projects->find('list');
        $this->set(compact('user_project', 'users', 'projects'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $relation = $this->UserProject->get($id);
        if ($this->UserProject->delete($relation)) {
            $this->Flash->success(__('The relation has been deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the relation.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
