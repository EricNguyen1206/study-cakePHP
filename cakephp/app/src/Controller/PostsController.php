<?php

namespace App\Controller;

use App\Controller\AppController;

class PostsController extends AppController
{
    public function index()
    {
        $posts = $this->Posts->find('all', [
            'contain' => ['Projects', 'Users'],
            'conditions' => ['is_deleted' => false],
            'order' => ['created_at' => 'DESC']
        ]);
        $this->set(compact('posts'));
    }

    public function add()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to save the post.'));
        }
        $projects = $this->Posts->Projects->find('list');
        $users = $this->Posts->Users->find('list');
        $this->set(compact('post', 'projects', 'users'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        $post->is_deleted = true;
        if ($this->Posts->save($post)) {
            $this->Flash->success(__('The post has been soft deleted.'));
        } else {
            $this->Flash->error(__('Unable to delete the post.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
