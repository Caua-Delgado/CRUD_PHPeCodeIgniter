<?php 
    namespace App\Controllers;
    use App\Models\UserModel;
    use CodeIgniter\Controller;
    class UserCrud extends Controller
    
    {
        // Mostrar lista de Usuarios
        public function index(){
            $userModel = new UserModel();
            $data['users'] = $userModel->orderBy('id', 'DESC')->findAll();
            return view('user_view', $data);
        }
        // Adicionar o formulario de adicionar usuario
        public function create(){
            return view('add_user');
        }
    
        // Cadastrar Usuario
        public function store() {
            $userModel = new UserModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'email'  => $this->request->getVar('email'),
            ];
            $userModel->insert($data);
            return $this->response->redirect(site_url('/users-list'));
        }
        // Mostrar o Usuario requerido
        public function singleUser($id = null){
            $userModel = new UserModel();
            $data['user_obj'] = $userModel->where('id', $id)->first();
            return view('edit_view', $data);
        }
        // Atualizar dados do Usuario
        public function update(){
            $userModel = new UserModel();
            $id = $this->request->getVar('id');
            $data = [
                'name' => $this->request->getVar('name'),
                'email'  => $this->request->getVar('email'),
            ];
            $userModel->update($id, $data);
            return $this->response->redirect(site_url('/users-list'));
        }
    
        // Deletar Usuario
        public function delete($id = null){
            $userModel = new UserModel();
            $data['user'] = $userModel->where('id', $id)->delete($id);
            return $this->response->redirect(site_url('/users-list'));
        }    
    }