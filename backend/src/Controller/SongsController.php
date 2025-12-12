<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Songs Controller
 *
 * @property \App\Model\Table\SongsTable $Songs
 */
class SongsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $songs = $this->Songs->find()
            ->contain(['Singer'])
            ->all();

        $this->set([
            'songs' => $songs,
            '_serialize' => ['songs']
        ]);
        $this->viewBuilder()->setOption('serialize', ['songs']);
    }

    /**
     * Store method
     *
     * @return \Cake\Http\Response JSON response
     */
    public function store()
    {
        $this->request->allowMethod(['post']);
        $song = $this->Songs->newEmptyEntity();
        $song = $this->Songs->patchEntity($song, $this->request->getData());

        if ($this->Songs->save($song)) {
            $response = [
                'message' => 'Song created successfully',
                'song' => $song
            ];
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode($response));
        } else {
            $response = [
                'message' => 'Unable to create song',
                'errors' => $song->getErrors()
            ];
            return $this->response
                ->withType('application/json')
                ->withStatus(400)
                ->withStringBody(json_encode($response));
        }
    }

    /**
     * View method
     *
     * @param string|null $id Song id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $song = $this->Songs->get($id, contain: ['Singers']);
        $this->set(compact('song'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $song = $this->Songs->newEmptyEntity();
        if ($this->request->is('post')) {
            $song = $this->Songs->patchEntity($song, $this->request->getData());
            if ($this->Songs->save($song)) {
                $this->Flash->success(__('The song has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The song could not be saved. Please, try again.'));
        }
        $singers = $this->Songs->Singers->find('list', limit: 200)->all();
        $this->set(compact('song', 'singers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Song id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $song = $this->Songs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $song = $this->Songs->patchEntity($song, $this->request->getData());
            if ($this->Songs->save($song)) {
                $this->Flash->success(__('The song has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The song could not be saved. Please, try again.'));
        }
        $singers = $this->Songs->Singers->find('list', limit: 200)->all();
        $this->set(compact('song', 'singers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Song id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $song = $this->Songs->get($id);
        if ($this->Songs->delete($song)) {
            $this->Flash->success(__('The song has been deleted.'));
        } else {
            $this->Flash->error(__('The song could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
