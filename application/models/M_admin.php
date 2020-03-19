<?php

class M_admin extends CI_Model
{
    public function getById($table, $where, $id)
    {
        return $this->db->get_where($table, [$where => $id])->row_array();
    }

    public function update_profile()
    {
        $id = $this->input->post('id');
        $password = $this->input->post('password');

        if ($password == null) {
            //cek jika ada gambar
            $upload_image = $_FILES['gambar']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = 'assets/uploads/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->where('id', $id);
            $this->db->update('tb_master_asesor');
        } else {
            //cek jika ada gambar
            $upload_image = $_FILES['gambar']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = 'uploads/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('password', $password);
            $this->db->where('id', $id);
            $this->db->update('tb_master_asesor');
        }
    }

    public function getRataraRata($nik)
    {
        $data['head'] = $this->db->get_where('tb_head_uji', ['nik' => $nik])->row_array();
        $data['hasilBaris'] = $this->db->get_where('tb_detail_uji', ['nomor_ujian' => $data['head']['nomor_ujian']])->num_rows();
        $this->db->select_sum('nilai');
        $this->db->where('nomor_ujian', $data['head']['nomor_ujian']);
        $query = $this->db->get('tb_detail_uji')->row_array();

        $woid = $data['hasilBaris'];


        $hitung =  $query['nilai'] / $woid;
        $hitung = round($hitung, 2);

        return $hitung;
    }

    public function getStatus($nik)
    {
        $data['head'] = $this->db->get_where('tb_head_uji', ['nik' => $nik])->row_array();
        $data['hasilBaris'] = $this->db->get_where('tb_detail_uji', ['nomor_ujian' => $data['head']['nomor_ujian']])->num_rows();
        $this->db->select_sum('nilai');
        $this->db->where('nomor_ujian', $data['head']['nomor_ujian']);
        $query = $this->db->get('tb_detail_uji')->row_array();

        $woid = $data['hasilBaris'];


        $hitung = $query['nilai'] / $woid;
        $hitung = round($hitung, 2);
        $status = '';

        if ($hitung > 79) {
            $status = 'K';
        } else if ($hitung < 79) {
            $status = 'BK';
        };

        return $status;
    }

    public function updateRataRata($nik)
    {
        $data['head'] = $this->db->get_where('tb_head_uji', ['nik' => $nik])->row_array();
        $data['hasilBaris'] = $this->db->get_where('tb_detail_uji', ['nomor_ujian' => $data['head']['nomor_ujian']])->num_rows();
        $this->db->select_sum('nilai');
        $this->db->where('nomor_ujian', $data['head']['nomor_ujian']);
        $query = $this->db->get('tb_detail_uji')->row_array();

        $woid = $data['hasilBaris'];


        $hitung = $query['nilai'] / $woid;
        $status = '';

        if ($hitung > 79) {
            $status = 'K';
        } else if ($hitung < 79) {
            $status = 'BK';
        };

        $update = [
            'status' => $status,
            'nilai_akhir' => $hitung
        ];

        return $this->db->update('tb_master_asesi', $update, array('nik' => $nik));
    }

    public function data_asesor()
    {
        return $this->db->get_where('tb_master_asesor', ['role_id' => 3])->result_array();
    }

    public function data_asesi()
    {
        return $this->db->get('tb_master_asesi')->result_array();
    }

    public function data_kuk()
    {
        return $this->db->get('tb_master_kuk')->result_array();
    }

    public function data_elemen_skema($id_skema)
    {
        return $this->db->get_where('tb_master_elemen', ['id_skema' => $id_skema])->result_array();
    }

    public function data_elemen_skema_id($nomor_ujian3)
    {
        return $this->db->get_where('tb_detail_uji', ['nomor_ujian' => $nomor_ujian3])->result_array();
    }

    public function data_elemen_skema_count($id_skema)
    {
        return $this->db->get_where('tb_master_elemen', ['id_skema' => $id_skema])->num_rows();
    }

    public function data_asesi_role($no_reg)
    {
        return $this->db->get_where('tb_master_asesi', ['no_reg' => $no_reg])->result_array();
    }

    public function data_asesi_row($id)
    {
        // return $this->db->get_where('tb_master_asesi', ['id' => $id])->row_array();

        $query = "SELECT `tb_master_asesor`.*,`tb_master_asesi`.* FROM `tb_master_asesor` JOIN `tb_master_asesi` ON `tb_master_asesi`.`no_reg` = `tb_master_asesor`.`no_reg` WHERE `tb_master_asesi`.`id` = $id";
        return $this->db->query($query)->row_array();
    }

    public function import_exel_asesi($inserdata)
    {
        $res = $this->db->insert_batch('tb_master_asesi', $inserdata);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function import_exel_asesor($inserdata)
    {
        $res = $this->db->insert_batch('tb_master_asesor', $inserdata);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }
    public function import_exel_unit($inserdata)
    {
        $res = $this->db->insert_batch('tb_master_unit', $inserdata);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }
    public function import_exel_elemen($inserdata)
    {
        $res = $this->db->insert_batch('tb_master_elemen', $inserdata);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }
    public function import_exel_kuk($inserdata)
    {
        $res = $this->db->insert_batch('tb_master_kuk', $inserdata);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    // public function data_pelajaran($id_unit, $skema)
    // {
    //     $this->db->select('tb_master_elemen.*,tb_master_kuk.*');
    //     $this->db->from('tb_master_elemen');
    //     $this->db->join('tb_master_kuk', 'tb_master_kuk.id_unit = tb_master_elemen.id_unit');
    //     $this->db->where(['tb_master_kuk.id_unit' => $id_unit, 'tb_master_kuk.id_skema' => $skema]);
    //     return $this->db->get()->result_array();
    // }

    public function data_head($nik)
    {
        return $this->db->get_where('tb_head_uji', ['nik' => $nik])->row_array();
    }

    public function data_skema()
    {
        return $this->db->get('tb_master_skema')->result_array();
    }

    public function data_unit()
    {
        $query = "SELECT `tb_master_skema`.*,`tb_master_unit`.* FROM `tb_master_skema` JOIN `tb_master_unit` ON `tb_master_unit`.`id_skema` = `tb_master_skema`.`id_skema`";
        return $this->db->query($query)->result_array();
    }

    public function data_elemen()
    {

        $query = "SELECT `tb_master_unit`.*,`tb_master_elemen`.* FROM `tb_master_unit` JOIN `tb_master_elemen` ON `tb_master_elemen`.`id_unit` = `tb_master_unit`.`id_unit`";
        return $this->db->query($query)->result_array();
    }

    public function data_menu()
    {
        return $this->db->get('tb_user_menu')->result_array();
    }

    public function data_submenu()
    {
        $query = "SELECT `tb_user_sub_menu`.*,`tb_user_menu`.`menu`
        from `tb_user_sub_menu` join `tb_user_menu`
        on `tb_user_sub_menu`.`menu_id` = `tb_user_menu`.`id`";
        return $this->db->query($query)->result_array();
    }

    public function uniqe_code()
    {
        $this->db->select('RIGHT(tb_head_uji.nomor_ujian,4) as kode', false);
        $this->db->order_by('nomor_ujian', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_head_uji');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = date('Ym') . "-LSP-" . $kodemax;
        return $kodejadi;
    }

    public function data_asesor_row()
    {

        $query = $this->db->get_where('tb_master_asesor', ['role_id' => 3]);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function data_asesi_row2()
    {

        $query = $this->db->get('tb_master_asesi');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function data_skema_row()
    {

        $query = $this->db->get('tb_master_skema');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function data_unit_row()
    {

        $query = $this->db->get('tb_master_unit');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function tambahSubmenu()
    {
        $data = [
            'menu_id' => $this->input->post('menu'),
            'title' => $this->input->post('title'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon')
        ];

        $this->db->insert('tb_user_sub_menu', $data);
    }

    //

    var $column_order = [null, "NIK", "NAMA", "SKEMA", "NILAI", "STATUS"];
    var $column_search = ["NIK", "NAMA", "SKEMA", "NILAI", "STATUS"];
    var $order = array('NAMA', 'ASC');

    public function _get_supporter_query()
    {
        $input = $this->input;
        $this->db->select("tb_master_asesor.*,tb_master_asesi.*");
        $this->db->from('tb_master_asesor');
        $this->db->join('tb_master_asesi', "tb_master_asesi.no_reg=tb_master_asesor.no_reg", "LEFT");
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($input->post("search")['value']) {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by($order[0], $order[1]);
        }
    }

    public function _get_custom_field()
    {
        $input = $this->input;
        $skema = $input->post('SKEMA');
        $this->db->where('tb_master_asesi.nilai_akhir > 0');
        if ($skema != null) {
            $this->db->where(['tb_master_asesor.id_skema' => $skema]);
        }
    }

    function get_datatables()
    {
        $this->_get_supporter_query();
        $this->_get_custom_field();

        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_supporter_query();
        $this->_get_custom_field();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function data_nilai_asesi_K($id_skema = null)
    {
        $query = "SELECT `tb_master_asesor`.*,`tb_master_asesi`.* FROM `tb_master_asesor` JOIN `tb_master_asesi` ON `tb_master_asesi`.`no_reg` = `tb_master_asesor`.`no_reg` WHERE `tb_master_asesi`.`status` = 'K' AND `tb_master_asesor`.`id_skema` = '$id_skema'";
        return $this->db->query($query)->num_rows();
    }

    public function data_nilai_asesi_BK($id_skema = null)
    {
        $query = "SELECT `tb_master_asesor`.*,`tb_master_asesi`.* FROM `tb_master_asesor` JOIN `tb_master_asesi` ON `tb_master_asesi`.`no_reg` = `tb_master_asesor`.`no_reg` WHERE `tb_master_asesi`.`status` = 'BK' AND `tb_master_asesor`.`id_skema` = '$id_skema'";
        return $this->db->query($query)->num_rows();
    }
}
