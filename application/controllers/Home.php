<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        $data["halaman"] = "Beranda";
        $data["menu"] = "1";
        $data["submenu"] = "";
        $data['kanim']=select_where('dc_list_kanim','MP_ID','7')->result();
        $this->gotoView('page_front_beranda_view', $data);
    }
    
    public function jadwalPengajuan() {
        $data["halaman"] = "Jadwal";
        $data["menu"] = "1";
        $data["submenu"] = "";
        $data['kanim']=select_where('dc_list_kanim','MP_ID','7')->result();
        $this->gotoView('page_front_jadwalpengajuan_view', $data);
    }
    
    public function daftarPengajuan() {
        $data["halaman"] = "Daftar Pengajuan";
        $data["menu"] = "1";
        $data["submenu"] = "";
        $this->gotoView('page_front_daftarpengajuan_view', $data);
    }
    
    public function dataPemohon() {
        $data["halaman"] = "Lengkapi Data Pemohon";
        $data["subhalaman"] = "";
        $data["menu"] = "3";
        $data["submenu"] = "";
        $this->gotoView('page_front_datapemohon_view', $data);
    }
    public function check_quota(){
        $provinsi=$this->input->post('provinsi');
        $kanim=$this->input->post('kanim');
        $jml=$this->input->post('jml');
        //syntax api check quota
        redirect("jadwal/".$provinsi."/".$kanim."/".$jml);
    }

    public function download(){
        $data=login_api();
        print_r($data->Token);
        
    }

    public function check_quota2(){
        $kanim=$this->input->post('kanim');
        $start_date=$this->input->post('start_date');
        $jml=$this->input->post('jml');
        $thn1=substr($start_date, 0,4);
        $bln1=substr($start_date, 5,2);
        $tgl1=substr($start_date, 8,2);
        if($bln1<10){
            $bln1=substr($start_date,6,1);
        }else{
            $bln1=substr($start_date,5,2);
        }
        if($tgl1<10){
            $tgl1=substr($start_date,9,1);
        }else{
            $tgl1=substr($start_date,8,2);
        }
        $tgl_tambah=substr($start_date,8,2)+1;
        $thn=substr($start_date,0,4);
        $bln=substr($start_date,5,2);
        if($bln<10){
            $bln=substr($start_date,6,1);
        }else{
            $bln=substr($start_date,5,2);
        }
        $end_date=$thn."-".$bln."-".$tgl_tambah;
        $start_date=$thn1."-".$bln1."-".$tgl1;
        $login=login_api();
        $url=file_get_contents('https://antrian.imigrasi.go.id/Antrian/api/availabilityinfo.jsp?Token='.$login->Token.'&KANIM_ID='.$kanim.'&START_DATE='.$start_date.'&END_DATE='.$end_date);
        $data=json_encode($url);
        $data=json_decode($url);
        $html='<table style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 25%;">Shift</th>
                            <th style="width: 25%;">Waktu</th>
                            <th style="width: 25%;" class="param_kuota">Kuota</th>
                            <th style="width: 25%;"></th>
                        </tr>
                    </thead>
                    <tbody>';
        $no=0;
        foreach ($data->Availability as $key) {
            $no++;
            if(strlen($key->MD_MULAI)==3){
                $day='pagi';
            }else{
                $day='siang';
            }
                        $html.='<tr>
                            <td>'.$day.'</td>
                            <td>';
                        if(strlen($key->MD_MULAI)==3){
                        $html.='0'.substr($key->MD_MULAI,0,1).':'.substr($key->MD_MULAI,1,2);
                        }else{
                         $html.=substr($key->MD_MULAI,0,2).':'.substr($key->MD_MULAI,2,2);
                        }
                            $html.='</td>
                            <td class="param_kuota">'.$key->MD_AVAILABILITY.'/'.$key->MD_QUOTA.'</td>
                            <td class="text-center">
                            <form action="'.base_url().'Home/add_pengajuan" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_kantor_imigrasi" value="'.$kanim.'"/>
                            <input type="hidden" name="jumlah_pengajuan" value="'.$jml.'"/>
                            <input type="hidden" name="tanggal" value="'.$key->MT_TANGGAL.'"/>
                            <input type="hidden" name="waktu" value="'.$key->MD_MULAI.'"/>
                            <button type="submit" class="btn btn-sm bg-green">Pilih</button>
                            </form>
                            </td>
                        </tr>';
        }
                        $html.='</tbody>
                        </table>';
      if($no==0){
        $html='<h3 style="color:#fff">Maaf Data Tidak Tersedia</h3>';
      }
       echo $html;

    }
    private function gotoView($pageview, $data) {
        force_ssl();
        if ($this->session->userdata('logged_in') != NULL || $this->session->userdata('logged_in') === TRUE) {
            redirect('/');
            exit();
        }
        $data['page'] = 'frontend/'.$pageview;
        $this->load->view('frontend/page_front_header_view', $data);
    }

    public function add_pengajuan(){
        $arrayName = array(
            'id_kantor_imigrasi' => $this->input->post('id_kantor_imigrasi'),
            'jumlah_pengajuan' => $this->input->post('jumlah_pengajuan'), 
            'tanggal' => $this->input->post('tanggal'), 
            'waktu' => $this->input->post('waktu'), 
        );
        insert_all('dc_jadwal',$arrayName);
        $id=$this->db->insert_id();
        insert_all('dc_daftar_pengajuan',$arrayName = array('id_jadwal' => $id, ));
        redirect('daftar_pengajuan/'.$id);
    }

}