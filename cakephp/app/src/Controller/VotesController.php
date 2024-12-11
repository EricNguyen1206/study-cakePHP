<?php

namespace App\Controller;

use App\Controller\AppController;

class VotesController extends AppController
{
    public function add()
    {
        $vote = $this->Votes->newEntity();
        if ($this->request->is('post')) {
            $vote = $this->Votes->patchEntity($vote, $this->request->getData());
            if ($this->Votes->save($vote)) {
                $this->Flash->success(__('The vote has been saved.'));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Unable to save the vote. You may have already voted.'));
        }
        $this->set(compact('vote'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vote = $this->Votes->get($id);
        if ($this->Votes->delete($vote)) {
            $this->Flash->success(__('The vote has been deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the vote.'));
        }
        return $this->redirect($this->referer());
    }
}
