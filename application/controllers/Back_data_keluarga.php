<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Back_data_keluarga extends CI_Controller {

    public function index() {
        $data["halaman"] = "Daftar Pengajuan";
        $data["subhalaman"] = "";
        $data["menu"] = "3";
        $data["submenu"] = "";
        $this->gotoView('page_back_daftarpengajuan_view', $data);
    }
    
    
    
    private function gotoView($pageview, $data) {
        force_ssl();
        if ($this->session->userdata('logged_in') != NULL || $this->session->userdata('logged_in') === TRUE) {
            redirect('/');
            exit();
        }
        $data['page'] = 'backend/'.$pageview;
        $this->load->view('backend/page_back_header_view', $data);
    }

    public function dataPemohon($id) {
        // debugCode($id);
        $data['data1_count']=select_where_array('dc_data_keluarga',$arrayName = array('id_data_diri' => $id,'id_keterangan'=>1 ))->num_rows();
        $data['data1']=select_where_array('dc_data_keluarga',$arrayName = array('id_data_diri' => $id,'id_keterangan'=>1 ))->row();
        
        //debugCode($data);
        $this->gotoView('page_front_datapemohon_datakeluarga_view', $data);
    }

      public function createFamily() {
        $login=login_api();
        $data_id=$login->Id;
        $id = $this->input->post('id');
       //data ayah & ibu
        $arrayName = array(
            'id_data_diri' => $id, 
            'nomer_surat_nikah' => $this->input->post('aktanikah1'), 
            'id_keterangan' => "1", 
            'nik' => $this->input->post('nik1'), 
            'nama' => $this->input->post('naleng1'), 
            'jenis_kelamin' => "1", 
            'tempat_lahir' => $this->input->post('tempatl1'), 
            'tanggal_lahir' => $this->input->post('tgll1'), 
            'status' => $this->input->post('status1'), 
            'jumlah_anak ' => $this->input->post('jml1'), 
            'id_pekerjaan' => $this->input->post('pekerjaan1')
        );
          $idkeluarga1  = insert_all('dc_data_keluarga',$arrayName);

            // sub byktp ayah & ibu
       $arrayAddress = array( 
            'id_data_diri' => $id, 
            'FamilyTypeXID' => "1", 
            'id_data_keluarga' => $idkeluarga1->id, 
            'alamat_lengkap' => $this->input->post('alkapktp1'), 
            'negara' => $this->input->post('negaraktp1'), 
            'provinsi' => $this->input->post('provinsiktp1'), 
            'kota' => $this->input->post('kotaktp1'), 
            'kecamatan' => $this->input->post('kecamatanktp1'), 
            'kode_pos' => $this->input->post('kodeposktp1'), 
        );
            insert_all('dc_family_address',$arrayAddress);
          
       $arrayAddress = array(
            'id_data_diri' => $id, 
            'FamilyTypeXID' => "2", 
            'id_data_keluarga' => $idkeluarga1->id, 
            'alamat_lengkap' => $this->input->post('alkap1'), 
            'negara' => $this->input->post('negara'), 
            'provinsi' => $this->input->post('provinsi'), 
            'kota' => $this->input->post('kota'), 
            'kecamatan' => $this->input->post('kecamatan'), 
            'kode_pos' => $this->input->post('kodepos'), 
        );
            insert_all('dc_family_address',$arrayAddress);
             
       //end 

 //data ayah
        $arrayName = array(
            'id_data_diri' => $id, 
            'nomer_surat_nikah' => "0", 
            'id_keterangan' => "2", 
            'nik' => $this->input->post('nik2'), 
            'nama' => $this->input->post('naleng2'), 
            'jenis_kelamin' => "2", 
            'tempat_lahir' => $this->input->post('tempatl2'), 
            'tanggal_lahir' => $this->input->post('tgll2'), 
            'status' => $this->input->post('status2'), 
            'jumlah_anak ' => $this->input->post('jml2'), 
            'id_pekerjaan' => $this->input->post('pekerjaan2')
        );
          $idkeluarga2 =  insert_all('dc_data_keluarga',$arrayName);

            // sub byktp ayah & ibu
       $arrayAddress = array( 
            'id_data_diri' => $id, 
            'FamilyTypeXID' => "1", 
            'id_data_keluarga' => $idkeluarga2->id, 
            'alamat_lengkap' => $this->input->post('alkapktp2'), 
            'negara' => $this->input->post('negaraktp2'), 
            'provinsi' => $this->input->post('provinsiktp2'), 
            'kota' => $this->input->post('kotaktp2'), 
            'kecamatan' => $this->input->post('kecamatanktp2'), 
            'kode_pos' => $this->input->post('kodeposktp2'), 
        );
            insert_all('dc_family_address',$arrayAddress);
          
       $arrayAddress = array(
            'id_data_diri' => $id, 
            'FamilyTypeXID' => "2", 
            'id_data_keluarga' => $idkeluarga2->id, 
            'alamat_lengkap' => $this->input->post('alkap2'), 
            'negara' => $this->input->post('negara2'), 
            'provinsi' => $this->input->post('provinsi2'), 
            'kota' => $this->input->post('kota2'), 
            'kecamatan' => $this->input->post('kecamatan2'), 
            'kode_pos' => $this->input->post('kodepos2'), 
        );
            insert_all('dc_family_address',$arrayAddress);


//end

//data ayah
        $arrayName = array(
            'id_data_diri' => $id, 
            'nomer_surat_nikah' => "0", 
            'id_keterangan' => "3", 
            'nik' => $this->input->post('nik3'), 
            'nama' => $this->input->post('naleng3'), 
            'jenis_kelamin' => "2", 
            'tempat_lahir' => $this->input->post('tempatl3'), 
            'tanggal_lahir' => $this->input->post('tgll3'), 
            'status' => $this->input->post('status3'), 
            'jumlah_anak ' => $this->input->post('jml3'), 
            'id_pekerjaan' => $this->input->post('pekerjaan3')
        );
           $idkeluarga3 = insert_all('dc_data_keluarga',$arrayName);

            // sub byktp ayah & ibu
       $arrayAddress = array( 
            'id_data_diri' => $id, 
            'FamilyTypeXID' => "1", 
            'id_data_keluarga' => $idkeluarga3->id, 
            'alamat_lengkap' => $this->input->post('alkapktp3'), 
            'negara' => $this->input->post('negaraktp3'), 
            'provinsi' => $this->input->post('provinsiktp3'), 
            'kota' => $this->input->post('kotaktp3'), 
            'kecamatan' => $this->input->post('kecamatanktp3'), 
            'kode_pos' => $this->input->post('kodeposktp3'), 
        );
            insert_all('dc_family_address',$arrayAddress);
          
       $arrayAddress = array(
            'id_data_diri' => $id, 
            'FamilyTypeXID' => "2", 
            'id_data_keluarga' => $idkeluarga3->id, 
            'alamat_lengkap' => $this->input->post('alkap3'), 
            'negara' => $this->input->post('negara3'), 
            'provinsi' => $this->input->post('provinsi3'), 
            'kota' => $this->input->post('kota3'), 
            'kecamatan' => $this->input->post('kecamatan3'), 
            'kode_pos' => $this->input->post('kodepos3'), 
        );
            insert_all('dc_family_address',$arrayAddress);


            redirect("data_pemohon/".$id."#step-3");



    }


 public function updateFamily() {
        $login=login_api();
        $data_id=$login->Id;
        $id = $this->input->post('id');
       //data ayah & ibu
        $arrayName = array(
            'id_data_diri' => $id, 
            'nomer_surat_nikah' => $this->input->post('aktanikah1'), 
            'id_keterangan' => "1", 
            'nik' => $this->input->post('nik1'), 
            'nama' => $this->input->post('naleng1'), 
            'jenis_kelamin' => "1", 
            'tempat_lahir' => $this->input->post('tempatl1'), 
            'tanggal_lahir' => $this->input->post('tgll1'), 
            'status' => $this->input->post('status1'), 
            'jumlah_anak ' => $this->input->post('jml1'), 
            'id_pekerjaan' => $this->input->post('pekerjaan1')
        );
            update_where_array('dc_data_keluarga',$arrayName,$arrayName = array('id_data_diri' => $id, 'id_keterangan'=>$this->input->post('idket1')));

            // sub byktp ayah & ibu
       $arrayAddress1 = array( 
            'id_data_diri' => $id, 
            'FamilyTypeXID' => "1", 
            'alamat_lengkap' => $this->input->post('alkapktp1'), 
            'negara' => $this->input->post('negaraktp1'),
            'id_data_keluarga' => $this->input->post('idkel1'),  
            'provinsi' => $this->input->post('provinsiktp1'), 
            'kota' => $this->input->post('kotaktp1'), 
            'kecamatan' => $this->input->post('kecamatanktp1'), 
            'kode_pos' => $this->input->post('kodeposktp1'), 
        );
            update_where_array('dc_family_address',$arrayAddress1,$arrayAddress1 = array('id_data_diri' => $id, 'FamilyTypeXID'=>"1",'id_data_keluarga'=>$this->input->post('idkel1') ));
          
       $arrayAddress2 = array(
            'id_data_diri' => $id, 
            'FamilyTypeXID' => "2", 
            'alamat_lengkap' => $this->input->post('alkap1'), 
            'id_data_keluarga' => $this->input->post('idkel1'), 
            'negara' => $this->input->post('negara'), 
            'provinsi' => $this->input->post('provinsi'), 
            'kota' => $this->input->post('kota'), 
            'kecamatan' => $this->input->post('kecamatan'), 
            'kode_pos' => $this->input->post('kodepos'), 
        );
            update_where_array('dc_family_address',$arrayAddress2,$arrayAddress2 = array('id_data_diri' => $id, 'FamilyTypeXID'=>"2",'id_data_keluarga'=>$this->input->post('idkel1') ));
             
       //end 

 //data ayah
        $arrayName2 = array(
            'id_data_diri' => $id, 
            'nomer_surat_nikah' => "0", 
            'id_keterangan' => "2", 
            'nik' => $this->input->post('nik2'), 
            'nama' => $this->input->post('naleng2'), 
            'jenis_kelamin' => "2", 
            'tempat_lahir' => $this->input->post('tempatl2'), 
            'tanggal_lahir' => $this->input->post('tgll2'), 
            'status' => $this->input->post('status2'), 
            'jumlah_anak ' => $this->input->post('jml2'), 
            'id_pekerjaan' => $this->input->post('pekerjaan2')
        );
            update_where_array('dc_data_keluarga',$arrayName2,$arrayName2 = array('id_data_diri' => $id, 'id_keterangan'=>$this->input->post('idket2') ));
            // sub byktp ayah & ibu
       $arrayAddress3 = array( 
            'id_data_diri' => $id, 
            'FamilyTypeXID' => "1", 
            'alamat_lengkap' => $this->input->post('alkapktp2'), 
            'negara' => $this->input->post('negaraktp2'), 
            'id_data_keluarga' => $this->input->post('idkel2'), 
            'provinsi' => $this->input->post('provinsiktp2'), 
            'kota' => $this->input->post('kotaktp2'), 
            'kecamatan' => $this->input->post('kecamatanktp2'), 
            'kode_pos' => $this->input->post('kodeposktp2'), 
        );
           update_where_array('dc_family_address',$arrayAddress3,$arrayAddress3 = array('id_data_diri' => $id, 'FamilyTypeXID'=>"1",'id_data_keluarga'=>$this->input->post('idkel2') ));
          
       $arrayAddress4 = array(
            'id_data_diri' => $id, 
            'FamilyTypeXID' => "2", 
            'alamat_lengkap' => $this->input->post('alkap2'), 
            'negara' => $this->input->post('negara2'), 
            'provinsi' => $this->input->post('provinsi2'), 
            'id_data_keluarga' => $this->input->post('idkel2'), 
            'kota' => $this->input->post('kota2'), 
            'kecamatan' => $this->input->post('kecamatan2'), 
            'kode_pos' => $this->input->post('kodepos2'), 
        );
            update_where_array('dc_family_address',$arrayAddress4,$arrayAddress4 = array('id_data_diri' => $id, 'FamilyTypeXID'=>"2",'id_data_keluarga'=>$this->input->post('idkel2') ));


//end

//data ayah
        $arrayName3 = array(
            'id_data_diri' => $id, 
            'nomer_surat_nikah' => "0", 
            'id_keterangan' => "3", 
            'nik' => $this->input->post('nik3'), 
            'nama' => $this->input->post('naleng3'), 
            'jenis_kelamin' => "2", 
            'tempat_lahir' => $this->input->post('tempatl3'), 
            'tanggal_lahir' => $this->input->post('tgll3'), 
            'status' => $this->input->post('status3'), 
            'jumlah_anak ' => $this->input->post('jml3'), 
            'id_pekerjaan' => $this->input->post('pekerjaan3')
        );
            update_where_array('dc_data_keluarga',$arrayName3,$arrayName3 = array('id_data_diri' => $id, 'id_keterangan'=>$this->input->post('idket3') ));

            // sub byktp ayah & ibu
       $arrayAddress5 = array( 
            'id_data_diri' => $id, 
            'FamilyTypeXID' => "1", 
            'alamat_lengkap' => $this->input->post('alkapktp3'), 
            'negara' => $this->input->post('negaraktp3'), 
            'provinsi' => $this->input->post('provinsiktp3'), 
            'id_data_keluarga' => $this->input->post('idkel3'), 
            'kota' => $this->input->post('kotaktp3'), 
            'kecamatan' => $this->input->post('kecamatanktp3'), 
            'kode_pos' => $this->input->post('kodeposktp3'), 
        );
             update_where_array('dc_family_address',$arrayAddress5,$arrayAddress5 = array('id_data_diri' => $id, 'FamilyTypeXID'=>"1",'id_data_keluarga'=>$this->input->post('idkel3') ));

          
       $arrayAddress6 = array(
            'id_data_diri' => $id, 
            'FamilyTypeXID' => "2", 
            'alamat_lengkap' => $this->input->post('alkap3'),
            'id_data_keluarga' => $this->input->post('idkel3'),  
            'negara' => $this->input->post('negara3'), 
            'provinsi' => $this->input->post('provinsi3'), 
            'kota' => $this->input->post('kota3'), 
            'kecamatan' => $this->input->post('kecamatan3'), 
            'kode_pos' => $this->input->post('kodepos3'), 
        );
             update_where_array('dc_family_address',$arrayAddress6,$arrayAddress6 = array('id_data_diri' => $id, 'FamilyTypeXID'=>"2",'id_data_keluarga'=>$this->input->post('idkel3') ));


             redirect("data_pemohon/".$id."#step-3");




    }









     function do_upload() {
       $config['upload_path'] = 'assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        // load library upload
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        } else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        }
    }
}