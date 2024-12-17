<?php

namespace App\Controller;

use App\Controller\AppController;
use Aws\S3\S3Client;
use Cake\Core\Configure;

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

    public function view($id = null)
    {
        // Get project
        $project = $this->Projects->get($id);

        // Get notes by project_id
        $this->loadModel('Notes');
        $notes = $this->Notes->find()
            ->where(['project_id' => $id, 'is_active' => true])
            ->order(['created_at' => 'DESC'])
            ->toArray();

        // Check if user is manager
        $isManager = ($this->Auth->user('role') === 'manager');

        $this->set(compact('project', 'notes', 'isManager'));
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
            $data['created_by'] = $user['id']; // Assign ID user created project
            $project = $this->Projects->patchEntity($project, $data);

            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the project.'));
        }

        $this->set(compact('project'));
    }

    public function addNote($id = null)
    {
        // Check if project exists
        $project = $this->Projects->get($id);
        if (!$project) {
            $this->Flash->error(__('Invalid Project.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->loadModel('Notes');
        $note = $this->Notes->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $minioConfig = Configure::read('MinIO');
            $s3 = new S3Client([
                'version' => 'latest',
                'region' => 'us-east-1',
                'endpoint' => 'http://myapp-minio:9000',
                'credentials' => [
                    'key' => 'NM69CfIYm29lyFfCwFQ5',
                    'secret' => 'MkNkhlTJWMQpTyVorT7kQPHnHCfNS0vnGUjv9QCB',
                ],
                'use_path_style_endpoint' => true, // Required for MinIO
            ]);
            // Handle Image Upload
            $uploadedFile = $this->request->getData('image');
            if (!empty($uploadedFile)) {
                $filename = time() . '_' . $uploadedFile['name'];
                $fileStream = file_get_contents($uploadedFile['tmp_name']);
                try {
                    // Upload file to MinIO
                    $result = $s3->putObject([
                        'Bucket' => 'uploads',
                        'Key' => $filename,
                        'Body' => $fileStream,
                        'ACL' => 'public-read'
                    ]);
                    // Save image URL
                    // $data['image'] = $result['ObjectURL'];
                    // $data['image'] = $s3->getObjectUrl('uploads', $filename);
                    $host = ($_SERVER['HTTP_HOST'] === 'localhost:8180') ? 'localhost:9000' : 'myapp-minio:9000';
                    $data['image'] = 'http://' . $host . '/uploads/' . $filename;
                } catch (\Exception $e) {
                    $this->Flash->error(__('Image upload failed: ' . $e->getMessage()));
                    return $this->redirect(['controller' => 'Projects', 'action' => 'view', $id]);
                }
            } else {
                $data['image'] = null;
            }

            // Assign other note data
            $data['project_id'] = $id;
            $data['user_id'] = $this->Auth->user('id');

            $note = $this->Notes->patchEntity($note, $data);

            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));
                return $this->redirect(['controller' => 'Projects', 'action' => 'view', $id]);
            }
            $this->Flash->error(__('Unable to save the note. Please try again.'));
        }

        $this->set(compact('note', 'project'));
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
