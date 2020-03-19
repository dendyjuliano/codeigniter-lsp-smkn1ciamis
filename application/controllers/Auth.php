<?php

class Auth extends CI_Controller
{
    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', [
            'required' => 'No Reg MET tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $data['icon'] = base_url('assets/img/logo.png');
            $this->load->view('admin/templates/auth/auth_header', $data);
            $this->load->view('admin/auth/login');
            $this->load->view('admin/templates/auth/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $noreg = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tb_master_asesor', ['no_reg' => $noreg])->row_array();

        if ($user) {
            if ($password == $user['password']) {

                $data = [
                    'id' => $user['id'],
                    'no_reg' => $user['no_reg'],
                    'nama_asesor' => $user['nama_asesor'],
                    'id_skema' => $user['id_skema'],
                    'asal_lsp' => $user['asal_lsp'],
                    'password' => $user['password'],
                    'image' => $user['image'],
                    'role_id' => $user['role_id'],
                    'status' => true
                ];

                $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    redirect('admin');
                } else {
                    redirect('admin/entry');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password Salah</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            No Reg MET tidak ada</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('no_reg');
        $this->session->unset_userdata('nama_asesor');
        $this->session->unset_userdata('asal_lsp');
        $this->session->unset_userdata('password');
        $this->session->unset_userdata('image');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Berhasil Keluar</div>');
        redirect('auth');
    }
}
