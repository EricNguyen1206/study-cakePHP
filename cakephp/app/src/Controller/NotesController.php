<?php
namespace App\Controller;

use App\Controller\AppController;

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
        // // Fetch all notes from the database
        // $notes = $this->Notes->find('all', [
        //     'order' => ['Notes.created_at' => 'DESC']
        // ]);

        // // Pass notes data to the view
        // $this->set(compact('notes'));

        // Enable the use of the RequestHandler component
        $this->loadComponent('Paginator');

        // Retrieve the search keyword, sort, and direction from query parameters
        $search = $this->request->getQuery('search');
        $sort = $this->request->getQuery('sort', 'created_at'); // Default sort by created_at
        $direction = $this->request->getQuery('direction', 'desc'); // Default direction desc

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
     * View method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('note', $note);
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
            $note = $this->Notes->patchEntity($note, $this->request->getData());
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The note could not be saved. Please, try again.'));
        }
        $users = $this->Notes->Users->find('list', ['limit' => 200]);
        $this->set(compact('note', 'users'));
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
            $note = $this->Notes->patchEntity($note, $this->request->getData());
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The note could not be saved. Please, try again.'));
        }
        $users = $this->Notes->Users->find('list', ['limit' => 200]);
        $this->set(compact('note', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $note = $this->Notes->get($id);
        if ($this->Notes->delete($note)) {
            $this->Flash->success(__('The note has been deleted.'));
        } else {
            $this->Flash->error(__('The note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
