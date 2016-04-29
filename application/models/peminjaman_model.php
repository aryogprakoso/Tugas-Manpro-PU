<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class peminjaman_model extends CI_Model{

    function __construct() {
        parent::__construct();
    }

    public function tambahPeminjaman($data) 
    {
        //code dibawah ini digunakan untuk mengkonversi jamMulai dan menitMulai menjadi format Time supaya bisa dimasukkan kedalam database
        $insertMulai = (3600 * $data['jamMulai']) + (60 * $data['menitMulai']);
        $insertMulai =  gmdate("H:i", $insertMulai);
        
        //code dibawah ini digunakan untuk mengkonversi jamSelesai dan menitSelesai menjadi format Time supaya bisa dimasukkan kedalam database
        $insertSelesai = (3600 * $data['jamSelesai']) + (60 * $data['menitSelesai']);
        $insertSelesai = gmdate("H:i", $insertSelesai);
        
        //Query dibawah ini untuk mendapatkan dari 'idPenanggungJawab'
        //sesuai dengan 'namaPenanggungJawab yang' ada di table 'peminjaman'
        $this->db->select('idPenanggungJawab');
        $this->db->where('namaPenanggungJawab', $data['penanggungJawab']);
        $query = $this->db->get('penanggungjawab')->row();
        
        //code dibawah ini digunakan untuk mengubah format waktuModal dd-mm-yy menjadi format database yy-mm-dd
        $data['waktuModal'] = DateTime::createFromFormat("d-m-Y", $data['waktuModal'])->getTimestamp();
        $data['waktuModal'] = date('Y-m-d', $data['waktuModal']);
        
        //jika salah satu atau banyak alat dipilih maka alatPeminjaman diisi sesuai dengan alat yang dipilih
        if(isset($data['alat']))
        {
            $insertTable = array(
              'tanggalPeminjaman' => $data['waktuModal'],
              'waktuMulai' => $insertMulai,
              'waktuSelesai' => $insertSelesai,
              'ruangPeminjaman' => $data['ruang'],
              'alatPeminjaman'  => $data['alat'],
              'keteranganPeminjaman' => $data['keterangan'],
              'idPenanggungJawab' => $query->idPenanggungJawab
            );
        }
        //jika tidak ada alat yang dipilih maka alatPeminjaman diisi dengan 'NULL'
        else
        {
            $insertTable = array(
              'waktuPeminjaman' => $data['waktuModal'],
              'waktuMulai' => $insertMulai,
              'waktuSelesai' => $insertSelesai,
              'ruangPeminjaman' => $data['ruang'],
              'alatPeminjaman'  => NULL,
              'keteranganPeminjaman' => $data['keterangan'],
              'idPenanggungJawab' => $query->idPenanggungJawab
            );
        }
              
        $this->db->insert('peminjaman', $insertTable);
        $this->lihatPeminjaman($data['waktuSearch']);
    }
    
    public function lihatPeminjaman($data)
    {
        $data = DateTime::createFromFormat("Y-m", $data)->getTimestamp(); //$data dengan format STRING diubah menjadi TIME
        $month = date("m", $data);      //$month menampung INT dari bulan yang ada pada $data
        $year = date("Y", $data);       //$year menampung INT dari tahun yang ada pada $data
        
        $this->db->where('MONTH(tanggalPeminjaman)', $month);     //Query Builder dari CI untuk WHERE tanggalPeminjaman
        $this->db->where('Year(tanggalPeminjaman)', $year);       //Query Builder dari CI untuk WHERE tanggalPeminjaman
        $this->db->order_by('tanggalPeminjaman', 'asc');
        $this->db->order_by('waktuMulai', 'asc');
        $query =  $this->db->get('peminjaman');                 //Query Builder dari CI untuk SELECT ALL ke table 'peminjaman'
        
        foreach ($query->result() as $row)      //for untuk setiap row yang didapatkan dari query
        {
            //Query dibawah ini untuk mendapatkan dari 'namaPenanggungJawab'
            //sesuai dengan 'idPenanggungJawab yang' ada di table 'peminjaman'
            $this->db->select('namaPenanggungJawab');
            $this->db->where('idPenanggungJawab', $row->idPenanggungJawab);
            $query2 = $this->db->get('penanggungjawab')->row();
    
            //mengubah format date yang ada pada mysql 'yyyy-mm-dd' menjadi 'mm/dd/yyyy' sesuai dengan input date id 'waktuModal'
            $dateBaru = DateTime::createFromFormat("Y-m-d", $row->tanggalPeminjaman)->getTimestamp();
            $dateBaru = date("d-m-Y", $dateBaru);
            
            //mengubah format time yang ada pada mysql 'HH:mm:ss' menjadi 'HH:mm' sesuai dengan format MULAI 'Jam:Menit'
            $mulaiBaru = DateTime::createFromFormat("H:i:s", $row->waktuMulai)->getTimestamp();
            $mulaiBaru = date("H:i" , $mulaiBaru);
            
            //mengubah format time yang ada pada mysql 'HH:mm:ss' menjadi 'HH:mm' sesuai dengan format AKHIR 'Jam:Menit'
            $selesaiBaru = DateTime::createFromFormat("H:i:s", $row->waktuSelesai)->getTimestamp();
            $selesaiBaru = date("H:i" , $selesaiBaru);
            
            //echo ini digunakan untuk memunculkan tanggalPeminjaman pada tabel Peminjaman dengan format baru
            echo "<tr><td>" . $dateBaru . "</td>";      
            echo "<td>" . $mulaiBaru . "</td>";         //echo ini digunakan untuk memunculkan waktuMulai pada Tabel Peminjaman
            echo "<td>" . $selesaiBaru . "</td>";       //echo ini digunakan untuk memunculkan waktuSelesai pada Tabel Peminjaman
            echo "<td>" . $row->ruangPeminjaman . "</td>";    //echo ini digunakan untuk memunculkan ruangPeminjaman pada Tabel Peminjaman
            if($row->alatPeminjaman != NULL)            //echo ini digunakan untuk memunculkan alatPeminjaman pada Tabel Peminjaman
                echo "<td>" . $row->alatPeminjaman . "</td>"; 
            else
                echo "<td> - </td>";
            //echo ini digunakan untuk memunculkan idPenanggungJawab pada Tabel Peminjaman
            echo "<td>" . $query2->namaPenanggungJawab . "</td>";
            //echo ini digunakan untuk memunculkan keteranganPeminjaman pada Tabel Peminjaman
            echo "<td>" . $row->keteranganPeminjaman . "</td>";
            if($this->session->userdata('username'))
            {
                echo "<td><button class='btn btn-danger hapus' id='" . $row->idPeminjaman . "' data-toggle='modal' data-target='#modalHapusPeminjaman' data-backdrop='static'><span class='glyphicon glyphicon-remove'></span> Hapus</button> ";
                echo "<button class='btn btn-warning ubah' id='" . $row->idPeminjaman . "' data-toggle='modal' data-target='#modalEditPeminjaman'><span class='glyphicon glyphicon-edit'></span> Ubah</button></td></tr>";
            }
        }
    }
    
    public function editPeminjaman($data)
    {
        //code dibawah ini digunakan untuk mengkonversi jamMulai dan menitMulai menjadi format Time supaya bisa dimasukkan kedalam database
        $editMulai = (3600 * $data['jamMulaiEdit']) + (60 * $data['menitMulaiEdit']);
        $editMulai =  gmdate("H:i", $editMulai);
        
        //code dibawah ini digunakan untuk mengkonversi jamSelesai dan menitSelesai menjadi format Time supaya bisa dimasukkan kedalam database
        $editSelesai = (3600 * $data['jamSelesaiEdit']) + (60 * $data['menitSelesaiEdit']);
        $editSelesai = gmdate("H:i", $editSelesai);
        
        //Query dibawah ini untuk mendapatkan dari 'idPenanggungJawab'
        //sesuai dengan 'namaPenanggungJawab yang' ada di table 'peminjaman'
        $this->db->select('idPenanggungJawab');
        $this->db->where('namaPenanggungJawab', $data['penanggungJawabEdit']);
        $query = $this->db->get('penanggungjawab')->row();
        
        //code dibawah ini digunakan untuk mengubah format waktuModal dd-mm-yy menjadi format database yy-mm-dd
        $data['waktuModalEdit'] = DateTime::createFromFormat("d-m-Y", $data['waktuModalEdit'])->getTimestamp();
        $data['waktuModalEdit'] = date('Y-m-d', $data['waktuModalEdit']);
        
        //jika salah satu atau banyak alat dipilih maka alatPeminjaman diisi sesuai dengan alat yang dipilih
        if(isset($data['alatEdit']))
        {
            $editTable = array(
              'tanggalPeminjaman' => $data['waktuModalEdit'],
              'waktuMulai' => $editMulai,
              'waktuSelesai' => $editSelesai,
              'ruangPeminjaman' => $data['ruangEdit'],
              'alatPeminjaman'  => $data['alatEdit'],
              'keteranganPeminjaman' => $data['keteranganEdit'],
              'idPenanggungJawab' => $query->idPenanggungJawab
            );
        }
        //jika tidak ada alat yang dipilih maka alatPeminjaman diisi dengan 'NULL'
        else
        {
            $editTable = array(
              'waktuPeminjaman' => $data['waktuModalEdit'],
              'waktuMulai' => $editMulai,
              'waktuSelesai' => $editSelesai,
              'ruangPeminjaman' => $data['ruangEdit'],
              'alatPeminjaman'  => NULL,
              'keteranganPeminjaman' => $data['keteranganEdit'],
              'idPenanggungJawab' => $query->idPenanggungJawab
            );
        }
        
        $this->db->where('idPeminjaman', $data['idEdit']);
        $this->db->update('peminjaman', $editTable);
        $this->lihatPeminjaman($data['waktuSearch']);
    }
    
    public function hapusPeminjaman($idHapus)
    {
        $this->db->where('idPeminjaman', $idHapus);
        $this->db->delete('peminjaman');
    }
    
    public function lihatPenanggungJawab() 
    {
        //SELECT semua data yang ada pada table 'penanggungjawab'
        $query = $this->db->get('penanggungjawab');
        
        foreach($query->result() as $row)
        {
            //echo ini digunakan untuk menampilkan semua 'namaPenanggungJawab' yang ada didalam table 'penanggungjawab'
            echo "<option>" . $row->namaPenanggungJawab . "</option>";
        }
    }
    
}