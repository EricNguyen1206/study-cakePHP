<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 *
 * @method \App\Model\Entity\Project[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth');
        $this->loadModel('Projects');
        $this->loadModel('ProjectUsers');
    }

    public function index()
    {
        $user = $this->Auth->user();
        $projects = [];

        if ($user['role'] === 'manager') {
            // Find projects created by this user
            $projects = $this->Projects->find('all')
                ->where(['created_by' => $user['id']])
                ->order(['created_at' => 'DESC'])
                ->toArray();
        } elseif ($user['role'] === 'developer') {
            // Find projects where the user is a developer in the project_users table
            $projectIds = $this->ProjectUsers->find()
                ->select(['project_id'])
                ->where(['user_id' => $user['id']])
                ->extract('project_id')
                ->toArray();

            $projects = $this->Projects->find('all')
                ->where(['id IN' => $projectIds])
                ->order(['created_at' => 'DESC'])
                ->toArray();
        } else {
            $this->Flash->error(__('Unauthorized access.'));
            return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
        }

        $this->set(compact('projects', 'user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Auth->user();
        if ($user['role'] !== 'manager') {
            $this->Flash->error(__('You are not authorized to add a project.'));
            return $this->redirect(['action' => 'index']);
        }

        $project = $this->Projects->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['created_by'] = $user['id']; // Gán ID user tạo project
            $project = $this->Projects->patchEntity($project, $data);

            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the project.'));
        }

        $this->set(compact('project'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $this->set(compact('project'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
