<?php
namespace App\Controller;

use App\Controller\AppController;

class CommentsController extends AppController
{
    public function add($noteId = null)
    {
        $this->loadModel('Comments');
        $comment = $this->Comments->newEntity();

        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            $comment->note_id = $noteId;
            $comment->user_id = $this->Auth->user('id'); // Lấy ID của user hiện tại

            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('Comment added successfully.'));
            } else {
                $this->Flash->error(__('Unable to add comment.'));
            }

            return $this->redirect($this->referer());
        }

        $this->set(compact('comment'));
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('Comment deleted successfully.'));
        } else {
            $this->Flash->error(__('Unable to delete comment.'));
        }

        return $this->redirect($this->referer());
    }
}
