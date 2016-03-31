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
        $data = strtotime($data);       //$data dengan format STRING diubah menjadi TIME
        $month = date("m", $data);      //$month menampung INT dari bulan yang ada pada $data
        $year = date("Y", $data);       //$year menampung INT dari tahun yang ada pada $data
        
        $this->db->where('MONTH(tanggalPeminjaman)', $month);     //Query Builder dari CI untuk WHERE tanggalPeminjaman
        $this->db->where('Year(tanggalPeminjaman)', $year);       //Query Builder dari CI untuk WHERE tanggalPeminjaman
        $this->db->order_by('tanggalPeminjaman', 'asc');
        $query =  $this->db->get('peminjaman');                 //Query Builder dari CI untuk SELECT ALL ke table 'peminjaman'
        
        foreach ($query->result() as $row)      //for untuk setiap row yang didapatkan dari query
        {
            //Query dibawah ini untuk mendapatkan dari 'namaPenanggungJawab'
            //sesuai dengan 'idPenanggungJawab yang' ada di table 'peminjaman'
            $this->db->select('namaPenanggungJawab');
            $this->db->where('idPenanggungJawab', $row->idPenanggungJawab);
            $query2 = $this->db->get('penanggungjawab')->row();
    
            //mengubah format date yang ada pada mysql 'yyyy-mm-dd' menjadi 'mm/dd/yyyy' sesuai dengan input date id 'waktuModal'
            $dateBaru = strtotime($row->tanggalPeminjaman);
            $dateBaru = date("m/d/Y", $dateBaru);
            
            //mengubah format time yang ada pada mysql 'HH:mm:ss' menjadi 'HH:mm' sesuai dengan format MULAI 'Jam:Menit'
            $mulaiBaru = strtotime($row->waktuMulai);
            $mulaiBaru = date("H:i" , $mulaiBaru);
            
            //mengubah format time yang ada pada mysql 'HH:mm:ss' menjadi 'HH:mm' sesuai dengan format AKHIR 'Jam:Menit'
            $selesaiBaru = strtotime($row->waktuSelesai);
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
            //echo ini digunakan untuk memunculkan keteranganPeminjaman pada Tabel Peminjaman
            echo "<td>" . $row->keteranganPeminjaman . "</td>";
            //echo ini digunakan untuk memunculkan idPenanggungJawab pada Tabel Peminjaman
            echo "<td>" . $query2->namaPenanggungJawab . "</td></tr>"; 
        }
    }
    
    public function editPeminjaman()
    {
        
    }
    
    public function hapusPeminjaman()
    {
        
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