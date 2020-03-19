<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_crud extends CI_Model
{
    public function getRules($method)
    {
        if ($method == 'asesor') {
            $config = [
                [
                    'field' => 'no_reg',
                    'label' => 'No Reg',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'name_asesor',
                    'label' => 'Nama Asesor',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'asal_lsp',
                    'label' => 'Asal Lsp',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required|min_length[6]'
                ],
            ];
        } else if ($method == 'asesi') {
            $config = [
                [
                    'field' => 'nama_asesi',
                    'label' => 'Nama asesi',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'nik',
                    'label' => 'Nik',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'tempat_lahir',
                    'label' => 'Tempat Lahir',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'tanggal_lahir',
                    'label' => 'Tanggal Lahir',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'alamat',
                    'label' => 'Alamat',
                    'rules' => 'required'
                ],
                [
                    'field' => 'kode_kota',
                    'label' => 'Kode Kota',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'kode_provinsi',
                    'label' => 'Kode provinsi',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'telepon',
                    'label' => 'Telepon',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'kode_pendidikan',
                    'label' => 'Kode Pendidikan',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'kode_pekerjaan',
                    'label' => 'Kode Pekerjaan',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'jadwal',
                    'label' => 'Jadwal',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'tanggal_uji',
                    'label' => 'Tanggal Uji',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'no_reg',
                    'label' => 'No Reg',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'kode_sumber_anggaran',
                    'label' => 'Kode sumber anggaran',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'kode_kementrian',
                    'label' => 'Kode Kementrian',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'status',
                    'label' => 'Status',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'nilai_akhir',
                    'label' => 'Nilai Akhir',
                    'rules' => 'trim|required'
                ],
            ];
        } else if ($method == 'skema') {
            $config = [
                [
                    'field' => 'id_skema',
                    'label' => 'Id Skema',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'jenis_ujian',
                    'label' => 'Jenis Ujian',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'judul_skema',
                    'label' => 'Judul Skema',
                    'rules' => 'trim|required'
                ],
            ];
        } else if ($method == 'unit') {
            $config = [
                [
                    'field' => 'id_skema',
                    'label' => 'Id Skema',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'id_unit',
                    'label' => 'Id Unit',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'judul_unit',
                    'label' => 'Judul Unit',
                    'rules' => 'trim|required'
                ],
            ];
        } else if ($method == 'elemen') {
            $config = [
                [
                    'field' => 'id_skema',
                    'label' => 'Id Skema',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'id_unit',
                    'label' => 'Id Unit',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'id_elemen',
                    'label' => 'Id Elemen',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'judul_elemen',
                    'label' => 'Judul Elemen',
                    'rules' => 'trim|required'
                ],
            ];
        } else if ($method == 'kuk') {
            $config = [
                [
                    'field' => 'id_skema',
                    'label' => 'Id Skema',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'id_unit',
                    'label' => 'Id unit',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'id_elemen',
                    'label' => 'Id Elemen',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'id_kuk',
                    'label' => 'Id Kuk',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'judul_kuk',
                    'label' => 'Judul Kuk',
                    'rules' => 'trim|required'
                ],
            ];
        }
        return $config;
    }

    public function getRulesEdit($method)
    {
        if ($method == 'asesor') {
            $config = [
                [
                    'field' => 'no_reg',
                    'label' => 'No Reg',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'name_asesor',
                    'label' => 'Nama Asesor',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'id_skema',
                    'label' => 'Id Skema',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'asal_lsp',
                    'label' => 'asal_lsp',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'role_id',
                    'label' => 'Role Id',
                    'rules' => 'trim|required'
                ],
            ];
        } else if ($method == 'asesor_password') {
            $config = [
                [
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required|min_length[6]'
                ],
                [
                    'field' => 'konfirmasi',
                    'label' => 'Konfirmasi Password',
                    'rules' => 'trim|required|matches[password]'
                ]
            ];
        }
        return $config;
    }

    public function delete($table, $id, $redirect)
    {
        $this->db->delete($table, array('id' => $id));
        $this->session->set_flashdata('flash', 'Delete');
        redirect('admin/' . $redirect);
    }


    // Asesor
    public function saveAsesor()
    {
        $data = [
            'no_reg' => $this->input->post('no_reg'),
            'nama_asesor' => $this->input->post('name_asesor'),
            'id_skema' => $this->input->post('id_skema'),
            'asal_lsp' => $this->input->post('asal_lsp'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'image' => 'default.jpg',
            'role_id' => 3
        ];

        $this->db->insert('tb_master_asesor', $data);
        $this->session->set_flashdata('flash', 'Insert');
        redirect('admin/asesor');
    }

    public function updateAsesor()
    {
        $id = $this->input->post('id');

        $data = [
            'no_reg' => $this->input->post('no_reg'),
            'nama_asesor' => $this->input->post('name_asesor'),
            'id_skema' => $this->input->post('id_skema'),
            'asal_lsp' => $this->input->post('asal_lsp'),
            'image' => 'default.jpg',
            'role_id' => $this->input->post('role_id')
        ];

        $this->db->update('tb_master_asesor', $data, array('id' => $id));
        $this->session->set_flashdata('flash', 'Update');
        redirect('admin/asesor');
    }

    // End Asesor

    // Asesi
    public function saveAsesi()
    {
        $data = [
            'nama_asesi' => $this->input->post('nama_asesi'),
            'nik'   => $this->input->post('nik'),
            'tempat_lahir'   => $this->input->post('tempat_lahir'),
            'tanggal_lahir'   => $this->input->post('tanggal_lahir'),
            'kelamin'   => $this->input->post('kelamin'),
            'alamat'   => $this->input->post('alamat'),
            'kode_kota'   => $this->input->post('kode_kota'),
            'kode_propinsi'   => $this->input->post('kode_provinsi'),
            'telepon'   => $this->input->post('telepon'),
            'email'   => $this->input->post('email'),
            'kode_pendidikan'   => $this->input->post('kode_pendidikan'),
            'kode_pekerjaan'   => $this->input->post('kode_pekerjaan'),
            'kode_jadwal'   => $this->input->post('jadwal'),
            'tanggal_uji'   => $this->input->post('tanggal_uji'),
            'no_reg'   => $this->input->post('no_reg'),
            'kode_sumber_anggaran'   => $this->input->post('kode_sumber_anggaran'),
            'kode_kementrian'   => $this->input->post('kode_kementrian'),
            'status'   => $this->input->post('status'),
            'nilai_akhir'   => $this->input->post('nilai_akhir'),
        ];

        $this->db->insert('tb_master_asesi', $data);
        $this->session->set_flashdata('flash', 'Insert');
        redirect('admin/asesi');
    }

    public function asesi_update()
    {
        $id = $this->input->post('id');

        $data = [
            'nama_asesi' => $this->input->post('nama_asesi'),
            'nik'   => $this->input->post('nik'),
            'tempat_lahir'   => $this->input->post('tempat_lahir'),
            'tanggal_lahir'   => $this->input->post('tanggal_lahir'),
            'kelamin'   => $this->input->post('kelamin'),
            'alamat'   => $this->input->post('alamat'),
            'kode_kota'   => $this->input->post('kode_kota'),
            'kode_propinsi'   => $this->input->post('kode_provinsi'),
            'telepon'   => $this->input->post('telepon'),
            'email'   => $this->input->post('email'),
            'kode_pendidikan'   => $this->input->post('kode_pendidikan'),
            'kode_pekerjaan'   => $this->input->post('kode_pekerjaan'),
            'kode_jadwal'   => $this->input->post('jadwal'),
            'tanggal_uji'   => $this->input->post('tanggal_uji'),
            'no_reg'   => $this->input->post('no_reg'),
            'kode_sumber_anggaran'   => $this->input->post('kode_sumber_anggaran'),
            'kode_kementrian'   => $this->input->post('kode_kementrian'),
            'status'   => $this->input->post('status'),
            'nilai_akhir'   => $this->input->post('nilai_akhir'),
        ];

        $this->db->update('tb_master_asesi', $data, array('id' => $id));
        $this->session->set_flashdata('flash', 'Edit');
        redirect('admin/asesi');
    }

    // End Asesi

    // Skema
    public function skema_add()
    {
        $data = [
            'id_skema' => $this->input->post('id_skema'),
            'jenis_ujian' => $this->input->post('jenis_ujian'),
            'judul_skema' => $this->input->post('judul_skema'),
        ];

        $this->db->insert('tb_master_skema', $data);
        $this->session->set_flashdata('flash', 'Insert');
        redirect('admin/skema');
    }

    public function skema_update()
    {
        $id = $this->input->post('id');
        $data = [
            'id_skema' => $this->input->post('id_skema'),
            'jenis_ujian' => $this->input->post('jenis_ujian'),
            'judul_skema' => $this->input->post('judul_skema'),
        ];

        $this->db->update('tb_master_skema', $data, array('id' => $id));
        $this->session->set_flashdata('flash', 'Edit');
        redirect('admin/skema');
    }

    // End Skema

    // Unit
    public function unit_add()
    {
        $data = [
            'id_skema' => $this->input->post('id_skema'),
            'id_unit'  => $this->input->post('id_unit'),
            'judul_unit'  => $this->input->post('judul_unit'),
        ];

        $this->db->insert('tb_master_unit', $data);
        $this->session->set_flashdata('flash', 'Insert');
        redirect(base_url('admin/unit'));
    }

    public function unit_update()
    {
        $id = $this->input->post('id');
        $data = [
            'id_skema' => $this->input->post('id_skema'),
            'id_unit'  => $this->input->post('id_unit'),
            'judul_unit'  => $this->input->post('judul_unit'),
        ];
        $this->db->update('tb_master_unit', $data, array('id' => $id));
        $this->session->set_flashdata('flash', 'Edit');
        redirect(base_url('admin/unit'));
    }

    // End Unit

    // Elemen
    public function elemen_add()
    {
        $data = [
            'id_skema' => $this->input->post('id_skema'),
            'id_unit' => $this->input->post('id_unit'),
            'id_elemen' => $this->input->post('id_elemen'),
            'judul_elemen' => $this->input->post('judul_elemen'),
        ];
        $this->db->insert('tb_master_elemen', $data);
        $this->session->set_flashdata('flash', 'Insert');
        redirect(base_url('admin/elemen'));
    }

    public function elemen_update()
    {
        $id = $this->input->post('id');
        $data = [
            'id_skema' => $this->input->post('id_skema'),
            'id_unit' => $this->input->post('id_unit'),
            'id_elemen' => $this->input->post('id_elemen'),
            'judul_elemen' => $this->input->post('judul_elemen'),
        ];
        $this->db->update('tb_master_elemen', $data, array('id' => $id));
        $this->session->set_flashdata('flash', 'Edit');
        redirect(base_url('admin/elemen'));
    }

    // Kuk
    public function kuk_add()
    {
        $data = [
            'id_skema' => $this->input->post('id_skema'),
            'id_unit'  => $this->input->post('id_unit'),
            'id_elemen'  => $this->input->post('id_elemen'),
            'id_kuk'  => $this->input->post('id_kuk'),
            'judul_kuk'  => $this->input->post('judul_kuk'),
        ];

        $this->db->insert('tb_master_kuk', $data);
        $this->session->set_flashdata('flash', 'Insert');
        redirect('admin/kuk');
    }

    public function kuk_update()
    {
        $id = $this->input->post('id');
        $data = [
            'id_skema' => $this->input->post('id_skema'),
            'id_unit'  => $this->input->post('id_unit'),
            'id_elemen'  => $this->input->post('id_elemen'),
            'id_kuk'  => $this->input->post('id_kuk'),
            'judul_kuk'  => $this->input->post('judul_kuk'),
        ];
        $this->db->update('tb_master_kuk', $data, array('id' => $id));
        $this->session->set_flashdata('flash', 'Edit');
        redirect('admin/kuk');
    }
}

/* End of file M_crud.php */
