<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Validation\Validator;

/**
 * Notes Controller
 *
 * @property \App\Model\Table\NotesTable $Notes
 *
 * @method \App\Model\Entity\Note[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        // Load the Notes model
        $this->loadModel('Notes');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        // Enable the use of the RequestHandler component
        $this->loadComponent('Paginator');

        // Retrieve the search keyword, sort, and direction from query parameters
        $search = $this->request->getQuery('search');
        $sort = $this->request->getQuery('sort', 'created_at'); // Default sort by created_at
        $direction = $this->request->getQuery('direction', 'desc'); // Default direction desc

        // Sanitize search input to prevent SQL injection
        if (!empty($search)) {
            // Trim whitespace
            $search = trim($search);
        }
        // Validate the sort parameter
        if (!in_array($sort, ['title', 'created_at'])) {
            $sort = 'created_at';
        }

        // Build the query with search, sort, direction, and is_active = true
        $query = $this->Notes->find()
            ->where(['is_active' => true])
            ->order([$sort => $direction]);

        // Apply search filter if provided
        if (!empty($search)) {
            $query->where(['Notes.title LIKE' => '%' . $search . '%']);
        }

        // Set pagination limit and other settings
        $notes = $this->Paginator->paginate($query, [
            'limit' => 5, // Display 5 notes per page
        ]);

        // Pass data to the view
        $this->set(compact('notes', 'search', 'sort', 'direction'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $note = $this->Notes->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $validator = $this->Notes->validationDefault(new Validator());
            $errors = $validator->validate($data);

            if (!empty($errors)) {
                foreach ($errors as $field => $error) {
                    $this->Flash->error(__($error));
                }
                $this->set(compact('note'));
                return;
            }

            $note = $this->Notes->patchEntity($note, $data);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The note could not be saved. Please, try again.'));
        }
        $this->set(compact('note'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $validator = $this->Notes->validationDefault(new Validator());
            $errors = $validator->validate($data);

            if (!empty($errors)) {
                foreach ($errors as $field => $error) {
                    $this->Flash->error(__($error));
                }
                $this->set(compact('note'));
                return;
            }

            $note = $this->Notes->patchEntity($note, $data);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The note could not be saved. Please, try again.'));
        }

        // Pass the note to the view for confirmation
        $this->set(compact('note'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        try {
            // Fetch the note by its ID
            $note = $this->Notes->get($id);
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Note not found.', [
                'key' => 'error',
            ]);
            return $this->redirect(['action' => 'index']);
        }

        // If the request is POST (meaning the user confirmed the deletion)
        if ($this->request->is('post')) {
            $note->set('is_active', false);
            if ($this->Notes->save($note)) {
                $this->Flash->success('The note ' . $note->title . ' has been deactivated.', [
                    'key' => 'success',
                ]);
            } else {
                $this->Flash->error('Unable to deactivate the note. Please try again.', [
                    'key' => 'error',
                ]);
            }
            return $this->redirect(['action' => 'index']);
        }

        // Pass the note to the view for confirmation
        $this->set(compact('note'));
    }
}
