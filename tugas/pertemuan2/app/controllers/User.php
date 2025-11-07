<?php

class User extends Controller
{
    public function index()
    {
        $data['judul'] = 'Daftar User';
        $data['usr'] = $this->model('User_model')->getAllUsers();
        $this->view('templates/header', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Tambah User';
        $this->view('templates/header', $data);
        $this->view('user/create');
        $this->view('templates/footer');
    }

    public function store()
    {
        if ($this->model('User_model')->tambahDataUser($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit User';
        $data['usr'] = $this->model('User_model')->getUserById($id);
        $this->view('templates/header', $data);
        $this->view('user/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if ($this->model('User_model')->ubahDataUser($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('User_model')->hapusDataUser($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }

    public function getubah()
    {
        echo json_encode($this->model('User_model')->getUserById($_POST['id']));
    }
}