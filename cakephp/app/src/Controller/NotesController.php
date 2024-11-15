<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;

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
            // Remove any potentially dangerous characters
            $search = preg_replace('/[^a-zA-Z0-9\s]/', '', $search);
            // Trim whitespace
            $search = trim($search);
        }

        // Validate sort field to prevent SQL injection
        if (!in_array($sort, ['created_at', 'title'])) {
            $sort = 'created_at'; // Default to created_at if invalid sort field
        }
        // Validate direction field to prevent SQL injection
        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc'; // Default to desc if invalid direction field
        }

        // Build the query with search, sort, and direction
        $query = $this->Notes->find()
            // ->contain(['Users'])
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
            
            // Validate and sanitize title
            if (empty($data['title'])) {
                $this->Flash->error(__('Title is required.'));
                $this->set(compact('note'));
                return;
            }

            // Sanitize title to prevent SQL injection
            $data['title'] = htmlspecialchars(strip_tags($data['title']));
            
            if (strlen($data['title']) > 255) {
                $this->Flash->error(__('Title cannot exceed 255 characters.'));
                $this->set(compact('note'));
                return;
            }

            // Sanitize description if provided
            if (!empty($data['description'])) {
                $data['description'] = htmlspecialchars(strip_tags($data['description']));
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
            
            // Validate and sanitize title
            if (empty($data['title'])) {
                $this->Flash->error(__('Title is required.'));
                $this->set(compact('note'));
                return;
            }

            // Sanitize title to prevent SQL injection
            $data['title'] = htmlspecialchars(strip_tags($data['title']));
            
            if (strlen($data['title']) > 255) {
                $this->Flash->error(__('Title cannot exceed 255 characters.'));
                $this->set(compact('note'));
                return;
            }

            // Sanitize description if provided
            if (!empty($data['description'])) {
                $data['description'] = htmlspecialchars(strip_tags($data['description']));
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
            $this->Flash->error(__('Note not found.'));
            return $this->redirect(['action' => 'index']);
        }

        // If the request is POST (meaning the user confirmed the deletion)
        if ($this->request->is('post')) {
            if ($this->Notes->delete($note)) {
                $this->Flash->success(__('The note "{0}" has been deleted.', h($note->title)));
            } else {
                $this->Flash->error(__('Unable to delete the note. Please try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }

        // Pass the note to the view for confirmation
        $this->set(compact('note'));
    }
}
