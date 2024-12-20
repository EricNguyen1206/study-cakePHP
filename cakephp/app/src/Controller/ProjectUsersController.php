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

    public function addUsers($projectId)
    {
        $this->request->allowMethod(['post']);
        $this->loadModel('ProjectUsers');

        $users = $this->request->getData('users');
        foreach ($users as $userId) {
            $projectUser = $this->ProjectUsers->newEntity([
                'project_id' => $projectId,
                'user_id' => $userId
            ]);
            $this->ProjectUsers->save($projectUser);
        }

        $this->Flash->success(__('Users added to project successfully.'));
        return $this->redirect($this->referer());
    }

    public function deleteUser($projectId, $userId)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('ProjectUsers');

        $projectUser = $this->ProjectUsers->find()
            ->where(['project_id' => $projectId, 'user_id' => $userId])
            ->firstOrFail();

        if ($this->ProjectUsers->delete($projectUser)) {
            $this->Flash->success(__('User removed from project successfully.'));
        } else {
            $this->Flash->error(__('Unable to remove user.'));
        }

        return $this->redirect($this->referer());
    }
}
