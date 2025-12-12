<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Singer Controller
 *
 * @property \App\Model\Table\SingerTable $Singer
 */
class SingerController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response JSON response
     */
    public function index()
    {
        $singers = $this->Singer->find()->all();

        $singersArray = [];
        foreach ($singers as $singer) {
            $singersArray[] = [
                'id' => $singer->id,
                'name' => $singer->name
            ];
        }

        return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode($singersArray));
    }

    /**
     * Store method
     *
     * @return \Cake\Http\Response JSON response
     */
    public function store()
    {
        $this->request->allowMethod(['post']);
        $singer = $this->Singer->newEmptyEntity();
        $singer = $this->Singer->patchEntity($singer, $this->request->getData());

        if ($this->Singer->save($singer)) {
            $response = [
                'message' => 'Singer created successfully',
                'singer' => $singer
            ];
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode($response));
        } else {
            $response = [
                'message' => 'Unable to create singer',
                'errors' => $singer->getErrors()
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
     * @param string|null $id Singer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $singer = $this->Singer->get($id, contain: ['Songs']);
        $this->set(compact('singer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $singer = $this->Singer->newEmptyEntity();
        if ($this->request->is('post')) {
            $singer = $this->Singer->patchEntity($singer, $this->request->getData());
            if ($this->Singer->save($singer)) {
                $this->Flash->success(__('The singer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The singer could not be saved. Please, try again.'));
        }
        $this->set(compact('singer'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Singer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $singer = $this->Singer->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $singer = $this->Singer->patchEntity($singer, $this->request->getData());
            if ($this->Singer->save($singer)) {
                $this->Flash->success(__('The singer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The singer could not be saved. Please, try again.'));
        }
        $this->set(compact('singer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Singer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $singer = $this->Singer->get($id);
        if ($this->Singer->delete($singer)) {
            $this->Flash->success(__('The singer has been deleted.'));
        } else {
            $this->Flash->error(__('The singer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
