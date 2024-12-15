<?php

namespace App\Controller;

use App\Controller\AppController;

class ProjectUsersController extends AppController
{
    public function index()
    {
        $projectUsers = $this->ProjectUsers->find()
            ->contain(['Users', 'Projects'])
            ->all();

        $this->set(compact('projectUsers'));
    }

    public function add()
    {
        $projectUser = $this->ProjectUsers->newEmptyEntity();

        if ($this->request->is('post')) {
            $projectUser = $this->ProjectUsers->patchEntity($projectUser, $this->request->getData());
            if ($this->ProjectUsers->save($projectUser)) {
                $this->Flash->success(__('The project-user association has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to save project-user association.'));
        }

        $users = $this->ProjectUsers->Users->find('list');
        $projects = $this->ProjectUsers->Projects->find('list');
        $this->set(compact('projectUser', 'users', 'projects'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $projectUser = $this->ProjectUsers->get($id);
        if ($this->ProjectUsers->delete($projectUser)) {
            $this->Flash->success(__('The project-user association has been deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the project-user association.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
