<?php

class Admin extends CI_Controller
{
    //Start Default
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') !== true) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Anda Belum Login</div>');
            redirect('auth');
        }
        $this->load->model('M_crud', 'crud');
    }
    //Start Default


    //Start Dashboard
    public function index()
    {
        $data['title'] = "Dashboard";
        $data['icon'] = base_url('assets/img/logo.png');
        $data['asesor_row'] = $this->M_admin->data_asesor_row();
        $data['asesi_row'] = $this->M_admin->data_asesi_row2();
        $data['skema_row'] = $this->M_admin->data_skema_row();
        $data['unit_row'] = $this->M_admin->data_unit_row();
        $data['skema'] = $this->db->get('tb_master_skema')->result_array();
        $data['nilai_a'] = $this->db->get_where('tb_master_asesi', ['status' => "K"])->num_rows();
        $data['nilai_b'] = $this->db->get_where('tb_master_asesi', ['status' => "BK"])->num_rows();
        $data['seluruh'] = $this->db->get_where('tb_master_asesi')->num_rows();
        $id_skema = $this->input->post('jurusan');
        $data['nilai_k'] = $this->M_admin->data_nilai_asesi_K();
        $data['nilai_bk'] = $this->M_admin->data_nilai_asesi_BK();
        $data['page_js'] = 'dashboard.js';

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer');
    }

    public function profile($id)
    {
        $data['profile'] = $this->db->get_where('tb_master_asesor', ['id' => $id])->row_array();
        $data['skema']   = $this->db->get('tb_master_skema')->result_array();

        $this->form_validation->set_rules('password', 'Password', 'matches[konfirmasi]', [
            'matches' => 'Password tidak sama',
        ]);
        $this->form_validation->set_rules('konfirmasi', 'Konfirmasi', 'matches[password]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Profile";
            $data['icon'] = base_url('assets/img/logo.png');
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/profile', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->M_admin->update_profile();
            $this->session->set_flashdata('flash', 'Edit');
            redirect('admin/entry');
        }
    }

    public function cari_jurusan()
    {
        $id_skema = $this->input->post('jurusan');

        $data['nilai_k'] = $this->M_admin->data_nilai_asesi_K($id_skema);
        $data['nilai_bk'] = $this->M_admin->data_nilai_asesi_BK($id_skema);
        $k = $data['nilai_k'];
        $bk = $data['nilai_bk'];

        echo "<input type='hidden' id='nilai_k' value='" . $k . "'></input>";
        echo "<input type='hidden' id='nilai_bk' value='" . $bk . "'></input>";
    }

    //End Dashboard


    //Start Asesor
    public function asesor()
    {
        $data['title'] = "Asesor";
        $data['icon'] = base_url('assets/img/logo.png');
        $data['asesordata'] = $this->M_admin->data_asesor();
        $data['id_skema']   = $this->db->get('tb_master_skema')->result_array();
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/templates/navbar');
        $this->form_validation->set_rules($this->crud->getRules('asesor'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/asesor', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->crud->saveAsesor();
        }
    }

    public function asesor_update_password()
    {
        $id = $this->input->post('id');
        $data = [
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        ];

        $this->form_validation->set_rules($this->crud->getRulesEdit('asesor_password'));

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('flash', 'Error');
            redirect('admin/edit_asesor/' . $id);
        } else {
            $this->db->update('tb_master_asesor', $data, array('id' => $id));
            $this->session->set_flashdata('flash', 'Edit');
            redirect('admin/asesor');
        }
    }

    public function edit_asesor($id)
    {
        $asesor     = $this->M_admin->getById('tb_master_asesor', 'id', $id);
        $id_skema   = $this->db->get('tb_master_skema')->result_array();
        $icon   = base_url('assets/img/logo.png');
        $title  = 'Asesor Edit';
        $data = [
            'icon'      => $icon,
            'title'     => $title,
            'asesor'    => $asesor,
            'skema'     => $id_skema
        ];

        $this->form_validation->set_rules($this->crud->getRulesEdit('asesor'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/crud/edit/asesor_edit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->crud->updateAsesor();
        }
    }

    public function delete_asesor($id)
    {
        $this->db->delete('tb_master_asesor', array('id' => $id));
        $this->session->set_flashdata('flash', 'Delete');
        redirect('admin/asesor');
    }

    public function importFileAsesor()
    {
        if ($this->input->post('submit2')) {
            $path = 'assets/uploads/';
            require_once APPPATH . "/third_party/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }

            if (empty($error)) {
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                }
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i = 0;

                foreach ($allDataInSheet as $value) {
                    if ($flag) {
                        $flag = false;
                        continue;
                    }

                    $inserdata[$i]['no_reg'] = $value['A'];
                    $inserdata[$i]['nama_asesor'] = $value['B'];
                    $inserdata[$i]['id_skema'] = $value['C'];
                    $inserdata[$i]['asal_lsp'] = $value['D'];
                    $inserdata[$i]['password'] = $value['E'];
                    $inserdata[$i]['image'] = 'default.jpg';
                    $inserdata[$i]['role_id'] = '3';
                    $i++;
                }

                $result = $this->M_admin->import_exel_asesor($inserdata);

                if ($result) {
                    $this->session->set_flashdata('flash', 'Tambah');
                    redirect('admin/asesor');
                } else {
                    echo "Error";
                }
            } catch (Exception $e) {
                die('Error Upload File "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
            }
        } else {
            echo $error['error'];
        }
    }
    //End Asesor


    //Start Asesi
    public function asesi()
    {
        $data['title'] = "Asesi";
        $data['icon'] = base_url('assets/img/logo.png');
        $data['asesidata'] = $this->M_admin->data_asesi();
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/templates/navbar');

        $this->form_validation->set_rules($this->crud->getRules('asesi'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/asesi', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->crud->saveAsesi();
        }
    }

    public function edit_asesi($id)
    {
        $asesi = $this->M_admin->getById('tb_master_asesi', 'id', $id);
        $data = [
            'title' => 'Asesi Edit',
            'icon'  => base_url('assets/img/logo.png'),
            'asesi' => $asesi
        ];

        $this->form_validation->set_rules($this->crud->getRules('asesi'));


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/crud/edit/asesi_edit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->crud->asesi_update();
        }
    }

    public function detail_asesi($id)
    {
        $asesi = $this->M_admin->getById('tb_master_asesi', 'id', $id);
        $data = [
            'title' => 'Asesi Detail',
            'icon'  => base_url('assets/img/logo.png'),
            'asesi' => $asesi
        ];

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/asesi_detail', $data);
        $this->load->view('admin/templates/footer');
    }

    public function delete_asesi($id)
    {
        $this->crud->delete('tb_master_asesi', $id, 'asesi');
    }

    public function importFileAsesi()
    {
        if ($this->input->post('submit1')) {
            $path = 'assets/uploads/';
            require_once APPPATH . "/third_party/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }

            if (empty($error)) {
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                }
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i = 0;

                foreach ($allDataInSheet as $value) {
                    if ($flag) {
                        $flag = false;
                        continue;
                    }

                    $inserdata[$i]['nama_asesi'] = $value['A'];
                    $inserdata[$i]['nik'] = $value['B'];
                    $inserdata[$i]['tempat_lahir'] = $value['C'];
                    $inserdata[$i]['tanggal_lahir'] = $value['D'];
                    $inserdata[$i]['kelamin'] = $value['E'];
                    $inserdata[$i]['alamat'] = $value['F'];
                    $inserdata[$i]['kode_kota'] = $value['G'];
                    $inserdata[$i]['kode_propinsi'] = $value['H'];
                    $inserdata[$i]['telepon'] = $value['I'];
                    $inserdata[$i]['email'] = $value['J'];
                    $inserdata[$i]['kode_pendidikan'] = $value['K'];
                    $inserdata[$i]['kode_pekerjaan'] = $value['L'];
                    $inserdata[$i]['kode_jadwal'] = $value['M'];
                    $inserdata[$i]['tanggal_uji'] = $value['N'];
                    $inserdata[$i]['no_reg'] = $value['O'];
                    $inserdata[$i]['kode_sumber_anggaran'] = $value['P'];
                    $inserdata[$i]['kode_kementrian'] = $value['Q'];
                    $inserdata[$i]['status'] = $value['R'];
                    $inserdata[$i]['nilai_akhir'] = $value['S'];
                    $i++;
                }

                $result = $this->M_admin->import_exel_asesi($inserdata);

                if ($result) {
                    $this->session->set_flashdata('flash', 'Tambah');
                    redirect('admin/asesi');
                } else {
                    echo "Error";
                }
            } catch (Exception $e) {
                die('Error Upload File "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
            }
        } else {
            echo $error['error'];
        }
    }
    //End Asesi


    //Start Skema
    public function skema()
    {
        $data['title'] = "Skema";
        $data['icon'] = base_url('assets/img/logo.png');
        $data['skemadata'] = $this->M_admin->data_skema();


        $this->form_validation->set_rules($this->crud->getRules('skema'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/skema', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->crud->skema_add();
        }
    }

    public function edit_skema($id)
    {
        $skema = $this->M_admin->getById('tb_master_skema', 'id', $id);
        $data = [
            'title' => 'Skema Edit',
            'icon'  => base_url('assets/img/logo.png'),
            'skema' => $skema
        ];

        $this->form_validation->set_rules($this->crud->getRules('skema'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/crud/edit/skema_edit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->crud->skema_update();
        }
    }

    public function delete_skema($id)
    {
        $this->crud->delete('tb_master_skema', $id, 'skema');
    }

    //End Skema


    //Start Unit
    public function unit()
    {
        $data['title'] = "Unit";
        $data['icon'] = base_url('assets/img/logo.png');
        $data['unitdata'] = $this->M_admin->data_unit();
        $data['id_skema'] = $this->db->get('tb_master_skema')->result_array();

        $this->form_validation->set_rules($this->crud->getRules('unit'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/unit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->crud->unit_add();
        }
    }

    public function unit_update($id)
    {
        $unit = $this->M_admin->getById('tb_master_unit', 'id', $id);
        $id_skema = $this->db->get('tb_master_skema')->result_array();
        $data = [
            'title' => 'Unit Edit',
            'icon'  => base_url('assets/img/logo.png'),
            'unit'  => $unit,
            'id_skema'  => $id_skema
        ];

        $this->form_validation->set_rules($this->crud->getRules('unit'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/crud/edit/unit_edit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->crud->unit_update();
        }
    }

    public function unit_delete($id)
    {
        $this->crud->delete('tb_master_unit', $id, 'unit');
    }

    public function importFileUnit()
    {
        if ($this->input->post('submit')) {
            $path = 'assets/uploads/';
            require_once APPPATH . "/third_party/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }

            if (empty($error)) {
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                }
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i = 0;

                foreach ($allDataInSheet as $value) {
                    if ($flag) {
                        $flag = false;
                        continue;
                    }

                    $inserdata[$i]['id_skema'] = $value['A'];
                    $inserdata[$i]['id_unit'] = $value['B'];
                    $inserdata[$i]['judul_unit'] = $value['C'];
                    $i++;
                }

                $result = $this->M_admin->import_exel_unit($inserdata);

                if ($result) {
                    $this->session->set_flashdata('flash', 'Tambah');
                    redirect('admin/unit');
                } else {
                    echo "Error";
                }
            } catch (Exception $e) {
                die('Error Upload File "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
            }
        } else {
            echo $error['error'];
        }
    }
    //End Unit


    //Start Elemen
    public function elemen()
    {
        $data['title'] = "Elemen";
        $data['icon'] = base_url('assets/img/logo.png');
        $data['elemendata'] = $this->M_admin->data_elemen();
        $data['id_skema']   = $this->db->get('tb_master_skema')->result_array();

        $this->form_validation->set_rules($this->crud->getRules('elemen'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/elemen', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->crud->elemen_add();
        }
    }

    public function edit_elemen($id)
    {
        $elemen = $this->M_admin->getById('tb_master_elemen', 'id', $id);
        $id_skema = $this->db->get('tb_master_skema')->result_array();
        $data = [
            'title' => 'Elemen Edit',
            'icon'  => base_url('assets/img/logo.png'),
            'elemen' => $elemen,
            'id_skema'  => $id_skema
        ];

        $this->form_validation->set_rules($this->crud->getRules('elemen'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/crud/edit/elemen_edit', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->crud->elemen_update();
        }
    }

    public function delete_elemen($id)
    {
        $this->crud->delete('tb_master_elemen', $id, 'elemen');
    }

    public function importFileElemen()
    {
        if ($this->input->post('submit')) {
            $path = 'assets/uploads/';
            require_once APPPATH . "/third_party/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }

            if (empty($error)) {
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                }
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i = 0;

                foreach ($allDataInSheet as $value) {
                    if ($flag) {
                        $flag = false;
                        continue;
                    }

                    $inserdata[$i]['id_skema'] = $value['A'];
                    $inserdata[$i]['id_unit'] = $value['B'];
                    $inserdata[$i]['id_elemen'] = $value['C'];
                    $inserdata[$i]['judul_elemen'] = $value['D'];
                    $i++;
                }

                $result = $this->M_admin->import_exel_elemen($inserdata);

                if ($result) {
                    $this->session->set_flashdata('flash', 'Tambah');
                    redirect('admin/elemen');
                } else {
                    echo "Error";
                }
            } catch (Exception $e) {
                die('Error Upload File "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
            }
        } else {
            echo $error['error'];
        }
    }
    //End Elemen


    //Start KUK
    public function kuk()
    {
        $data['title'] = "KUK";
        $data['icon'] = base_url('assets/img/logo.png');
        $data['kukdata'] = $this->M_admin->data_kuk();
        $data['id_skema'] = $this->db->get('tb_master_skema')->result_array();

        $this->form_validation->set_rules($this->crud->getRules('kuk'));

        $dataapi = $this->M_api->getApiKuk();
        $api = json_decode($dataapi, true);
        $data['api'] = $api;

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/kuk', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->crud->kuk_add();
        }
    }

    public function edit_kuk($id)
    {
        $kuk = $this->M_admin->getById('tb_master_kuk', 'id', $id);
        $id_skema = $this->db->get('tb_master_skema')->result_array();
        $data = [
            'title' => 'KUK Edit',
            'icon'  => base_url('assets/img/logo.png'),
            'kuk'   => $kuk,
            'id_skema'  => $id_skema
        ];

        $this->form_validation->set_rules($this->crud->getRules('kuk'));


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/crud/edit/kuk_edit', $data);
            $this->load->view('admin/templates/footer'); # code...
        } else {
            $this->crud->kuk_update();
        }
    }

    public function delete_kuk($id)
    {
        $this->crud->delete('tb_master_kuk', $id, 'kuk');
    }

    public function importFileKuk()
    {
        if ($this->input->post('submit')) {
            $path = 'assets/uploads/';
            require_once APPPATH . "/third_party/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }

            if (empty($error)) {
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                }
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i = 0;

                foreach ($allDataInSheet as $value) {
                    if ($flag) {
                        $flag = false;
                        continue;
                    }

                    $inserdata[$i]['id_skema'] = $value['A'];
                    $inserdata[$i]['id_unit'] = $value['B'];
                    $inserdata[$i]['id_elemen'] = $value['C'];
                    $inserdata[$i]['id_kuk'] = $value['D'];
                    $inserdata[$i]['judul_kuk'] = $value['E'];
                    $i++;
                }

                $result = $this->M_admin->import_exel_kuk($inserdata);

                if ($result) {
                    $this->session->set_flashdata('flash', 'Tambah');
                    redirect('admin/kuk');
                } else {
                    echo "Error";
                }
            } catch (Exception $e) {
                die('Error Upload File "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
            }
        } else {
            echo $error['error'];
        }
    }
    //End KUK


    //Start Entry
    public function entry()
    {
        $data['title'] = "Entry Penilaian";
        $data['icon'] = base_url('assets/img/logo.png');
        $data['asesidata'] = $this->M_admin->data_asesi();
        $no_reg = $this->session->userdata('no_reg');
        $data['asesidata_role'] = $this->M_admin->data_asesi_role($no_reg);
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/entry', $data);
        $this->load->view('admin/templates/footer');
    }

    public function detail_entry($id, $nik)
    {
        $data['title'] = "Entry Penilaian";
        $data['icon'] = base_url('assets/img/logo.png');
        $data['asesidata_id'] = $this->M_admin->data_asesi_row($id);
        $data['head'] = $this->M_admin->data_head($nik);
        $nomor_ujian = $data['head']['nomor_ujian'];
        $skema = $data['asesidata_id']['id_skema'];

        $hasil2 = $this->db->get_where('tb_master_unit', ['id_skema' => $skema])->row_array();
        $id_unit = $hasil2['id_unit'];
        $hasil3 = $this->db->get_where('tb_master_elemen', ['id_unit' => $id_unit])->result_array();
        $data['elemen'] = $this->db->get_where('tb_master_kuk', ['id_skema' => $skema])->result_array();
        $data['elemen_id'] = $this->db->get_where('tb_detail_uji', ['nomor_ujian' => $nomor_ujian])->result_array();

        // $data['elemen'] = $this->M_admin->data_pelajaran($id_unit, $skema);
        if ($data['head']['nik'] == $data['asesidata_id']['nik']) {
            $data['kode'] = $this->M_admin->uniqe_code();
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/edit_entry', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $data['kode'] = $this->M_admin->uniqe_code();
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/penilaian_entry', $data);
            $this->load->view('admin/templates/footer');
        }
    }

    public function input_nilai()
    {
        $id_skema = $this->input->post('id_skema');
        $id_unit = $this->input->post('id_unit');
        $id_kuk = $this->input->post('id_kuk');
        $id_elemen = $this->input->post('id_elemen');
        $no_ujian = $this->input->post('no_ujian');
        $no_ujian2 = $this->input->post('no_ujian2');
        $nik = $this->input->post('nik');
        $judul_kuk = $this->input->post('judul_kuk');
        $nilai =  $this->input->post('nilai');

        $data2  = [
            'nomor_ujian' => $no_ujian2,
            'nik' => $nik
        ];
        $this->db->insert('tb_head_uji', $data2);

        $eror = array();
        $data3 = array();
        $index = 0;

        foreach ($no_ujian as $key) {

            if ($nilai > 79) {
                $kompeten[$index] = "K";
            } elseif ($nilai < 79) {
                $kompeten[$index] = "BK";
            } else {
                $kompeten[$index] = "BK";
            }

            array_push($data3, array(
                'nomor_ujian' => $key,
                'id_skema' => $id_skema[$index],
                'id_unit' => $id_unit[$index],
                'id_elemen' => $id_elemen[$index],
                'id_kuk' => $id_kuk[$index],
                'judul_kuk' => $judul_kuk[$index],
                'hasil' => $kompeten[$index],
                'nilai' => $nilai[$index]
            ));

            $index++;
        }

        echo count($data3);

        $berhasil = $this->db->insert_batch('tb_detail_uji', $data3);
        if ($berhasil) {
            $this->session->set_flashdata('flash', 'Tambah');
            redirect('admin/entry');
        } elseif (count($eror) > 0) {
            echo "Data tidak lengkap";
        } else {
            echo "Gagal Upload Data";
        }
    }

    public function update_nilai()
    {
        $nilai = $this->input->post('nilai');
        $id_skema = $this->input->post('id_skema');
        $id_unit = $this->input->post('id_unit');
        $id_elemen = $this->input->post('id_elemen');
        $id_kuk = $this->input->post('id_kuk');
        $judul_kuk = $this->input->post('judul_kuk');
        $no_ujian = $this->input->post('no_ujian');
        $id = $this->input->post('id');

        $eror = array();
        $data3 = array();
        $index = 0;

        foreach ($nilai as $key) {

            if ($key > 79) {
                $kompeten[$index] = "K";
            } else {
                $kompeten[$index] = "BK";
            }

            array_push($data3, array(
                'id' => $id[$index],
                'nomor_ujian' => $no_ujian[$index],
                'id_skema' => $id_skema[$index],
                'id_unit' => $id_unit[$index],
                'id_elemen' => $id_elemen[$index],
                'id_kuk' => $id_kuk[$index],
                'judul_kuk' => $judul_kuk[$index],
                'hasil' => $kompeten[$index],
                'nilai' => $key
            ));

            $index++;
        }

        $berhasil = $this->db->update_batch('tb_detail_uji', $data3, 'id');
        if ($berhasil) {
            $this->session->set_flashdata('flash', 'Edit');
            redirect('admin/entry');
        } elseif (count($eror) > 0) {
            echo "Data tidak lengkap";
        } else {
            echo "Gagal Update Data";
        }
    }
    //End Entry


    //Start Menu
    public function menu()
    {
        $data['title'] = "Menu Management";
        $data['icon'] = base_url('assets/img/logo.png');
        $data['menudata'] = $this->M_admin->data_menu();
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/menu', $data);
        $this->load->view('admin/templates/footer');
    }
    //End Menu


    //Start Submenu
    public function submenu()
    {
        $data['title'] = "Submenu Management";
        $data['icon'] = base_url('assets/img/logo.png');
        $data['menu'] = $this->M_admin->data_menu();
        $data['submenudata'] = $this->M_admin->data_submenu();
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/submenu', $data);
        $this->load->view('admin/templates/footer');
    }

    public function insert_submenu()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => 'Menu Category cannot be empty'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Submenu Management";
            $data['icon'] = base_url('assets/img/logo.png');
            $data['menu'] = $this->M_admin->data_menu();
            $data['submenudata'] = $this->M_admin->data_submenu();
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/submenu', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->M_admin->tambahSubmenu();
            $this->session->set_flashdata('flash', 'Tambah');
            redirect('admin/submenu');
        }
    }
    //End Submenu

    //Start Hasil
    public function ujikom()
    {
        $data['title'] = "Hasil Ujikom";
        $data['asesidata'] = $this->M_admin->data_asesi();
        $no_reg = $this->session->userdata('no_reg');

        $data['asesidata_role'] = $this->M_admin->data_asesi_role($no_reg);
        $data['icon'] = base_url('assets/img/logo.png');
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/hasil_ujikom', $data);
        $this->load->view('admin/templates/footer');
    }

    public function detail_hasil($id, $nik)
    {
        $data['title'] = "Hasil Ujikom";
        $data['head'] = $this->db->get_where('tb_head_uji', ['nik' => $nik])->row_array();
        $data['asesidata_id'] = $this->M_admin->data_asesi_row($id);
        $data['icon'] = base_url('assets/img/logo.png');

        $query = "SELECT tb_head_uji.nomor_ujian, tb_head_uji.nik, tb_master_asesi.nama_asesi,tb_master_asesi.id, tb_master_asesor.id_skema, tb_master_skema.judul_skema, tb_detail_uji.id_unit, tb_master_unit.judul_unit, Sum(tb_detail_uji.nilai) AS nilai_kumulatif, Count(tb_detail_uji.id_kuk) AS jml_kuk, Sum(tb_detail_uji.nilai)/Count(tb_detail_uji.id_kuk) AS rata2, If(Sum(tb_detail_uji.nilai)/Count(tb_detail_uji.id_kuk)<80,'BK','K') AS keterangan FROM (tb_master_skema INNER JOIN ((tb_master_elemen INNER JOIN tb_master_kuk ON (tb_master_elemen.id_elemen = tb_master_kuk.id_elemen) AND (tb_master_elemen.id_unit = tb_master_kuk.id_unit) AND (tb_master_elemen.id_skema = tb_master_kuk.id_skema)) INNER JOIN (tb_master_asesor INNER JOIN (tb_master_asesi INNER JOIN (tb_head_uji INNER JOIN tb_detail_uji ON tb_head_uji.nomor_ujian = tb_detail_uji.nomor_ujian) ON tb_master_asesi.nik = tb_head_uji.nik) ON tb_master_asesor.no_reg = tb_master_asesi.no_reg) ON (tb_master_kuk.id_kuk = tb_detail_uji.id_kuk) AND (tb_master_kuk.id_elemen = tb_detail_uji.id_elemen) AND (tb_master_kuk.id_unit = tb_detail_uji.id_unit) AND (tb_master_kuk.id_skema = tb_detail_uji.id_skema)) ON tb_master_skema.id_skema = tb_master_asesor.id_skema) INNER JOIN tb_master_unit ON (tb_master_unit.id_unit = tb_master_elemen.id_unit) AND (tb_master_unit.id_skema = tb_master_elemen.id_skema) AND (tb_master_skema.id_skema = tb_master_unit.id_skema) WHERE tb_master_asesi.id = $id GROUP BY tb_head_uji.nomor_ujian, tb_head_uji.nik, tb_master_asesi.nama_asesi, tb_master_asesor.id_skema, tb_master_skema.judul_skema, tb_detail_uji.id_unit, tb_master_unit.judul_unit;";
        $data['hasil2'] = $this->db->query($query)->result_array();

        $hitung =  count($data['hasil2']);
        if ($hitung > 0) {
            $this->M_admin->updateRataRata($nik);
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/hasil_siswa', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar');
            $this->load->view('admin/templates/navbar');
            $this->load->view('admin/hasil_siswa_tidak', $data);
            $this->load->view('admin/templates/footer');
        }

        // $data['rata_rata'] = $this->M_admin->getRataraRata($nik);
        // $data['status'] = $this->M_admin->getStatus($nik);
    }
    //End Hasil

    //Start Rekap
    public function rekap()
    {
        $data['title'] = "Rekap Nilai Akhir";
        $no = $this->session->userdata('no_reg');
        $skema = $this->input->post('skema');

        if ($skema == '') {
            $query = "SELECT `tb_master_asesor`.*,`tb_master_asesi`.* FROM `tb_master_asesor` JOIN `tb_master_asesi` ON `tb_master_asesi`.`no_reg` = `tb_master_asesor`.`no_reg` WHERE `tb_master_asesi`.`nilai_akhir` > 0";
            $data['rekap2'] = $this->db->query("SELECT * FROM tb_master_asesi WHERE no_reg = '$no' AND nilai_akhir > 0")->result_array();
            $data['rekap'] = $this->db->query($query)->result_array();
            $data['skema'] = $this->db->get('tb_master_skema')->result_array();
        } else {
            $query = $this->db->select("ts.*,ti.*")->from("tb_master_asesor as ts")->join("tb_master_asesi as ti", "ti.no_reg = ts.no_reg", "inner")->where("ti.nilai_akhir > 0")->get();
            $data['rekap'] = $query->result_array();
            $data['rekap2'] = $this->db->query("SELECT * FROM tb_master_asesi WHERE no_reg = '$no' AND nilai_akhir > 0")->result_array();
            $data['skema'] = $this->db->get('tb_master_skema')->result_array();
        }



        $data['icon'] = base_url('assets/img/logo.png');
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/rekap_nilai', $data);
        $this->load->view('admin/templates/footer');
    }

    public function data_nilai()
    {
        $skema = $this->input->post('SKEMA');
        $no = $this->input->post('start');

        $supporter = $this->M_admin->get_datatables();
        $data = [];
        foreach ($supporter as $item) {
            $no++;
            $row = [];
            $row[] = $no;
            // Pengisian array sesuai urutan pada table di html
            $row[] = $item->nik;
            $row[] = $item->nama_asesi;
            $row[] = $item->id_skema;
            $row[] = round($item->nilai_akhir, 1);
            $row[] = $item->status;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_admin->count_filtered(),
            "recordsFiltered" => $this->M_admin->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function export_excel_rekap()
    {
        $this->load->library('excel');

        $query = "SELECT `tb_master_asesor`.*,`tb_master_asesi`.* FROM `tb_master_asesor` JOIN `tb_master_asesi` ON `tb_master_asesi`.`no_reg` = `tb_master_asesor`.`no_reg` WHERE `tb_master_asesi`.`nilai_akhir` > 0";
        $rekap = $this->db->query($query)->result_array();

        $fileName = 'dataRekap.xls';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        //Set Header
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'NIK');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'NAMA');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'SKEMA');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'NILAI');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'STATUS');

        //Set Row
        $rowCount = 2;
        foreach ($rekap as $row) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, $row['nik']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowCount, $row['nama_asesi']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowCount, $row['id_skema']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowCount, $row['nilai_akhir']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowCount, $row['status']);

            $rowCount++;
        }

        $object_excel_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); // Explain format of Excel data
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=', $fileName);
        $object_excel_writer->save('php://output'); // For automatic download to local computer
        echo "EXPORTED";
    }
    //End Rekap
}
