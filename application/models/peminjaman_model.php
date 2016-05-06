<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class peminjaman_model extends CI_Model{

    function __construct() {
        parent::__construct();
    }

    public function tambahPeminjaman($data) 
    {
        //code dibawah ini digunakan untuk mengkonversi jamMulai dan menitMulai menjadi format Time
        $insertMulai = (3600 * $data['jamMulai']) + (60 * $data['menitMulai']);
        
        //code dibawah ini digunakan untuk mengkonversi jamSelesai dan menitSelesai menjadi format Time
        $insertSelesai = (3600 * $data['jamSelesai']) + (60 * $data['menitSelesai']);
        
        //code dibawah ini digunakan untuk mengubah format waktuModal dd-mm-yy menjadi format database yy-mm-dd
        $data['waktuModal'] = DateTime::createFromFormat("d-m-Y", $data['waktuModal'])->getTimestamp();
        $data['waktuModal'] = date('Y-m-d', $data['waktuModal']);
        
        //Query dibawah ini untuk mendapatkan 'idPenanggungJawab'
        //sesuai dengan 'namaPenanggungJawab yang' ada di table 'peminjaman'
        $this->db->select('idPenanggungJawab');
        $this->db->where('namaPenanggungJawab', $data['penanggungJawab']);
        $queryPJ = $this->db->get('penanggungjawab')->row();
        
        //Query dibawah ini berguna sebagai pengecekan data, dan disesuaikan dengan fungsi lihatPeminjaman
        $this->db->where('tanggalPeminjaman', $data['waktuModal']);
        $this->db->where('ruangPeminjaman', $data['ruang']);
        $this->db->order_by('waktuMulai', 'asc');
        $this->db->order_by('waktuSelesai', 'asc');
        $queryCek = $this->db->get('peminjaman');
        
        //Cek apakah Data yang akan ditambahkan sudah ada pada database atau tidak
        foreach($queryCek->result() as $row)
        {
            //code dibawah ini digunakan untuk mengkonversi waktuMulai Int untuk perbandingan
            $tampCekMulai = DateTime::createFromFormat("H:i:s", $row->waktuMulai)->getTimestamp();
            $tampCekMulai = (3600 * idate("H", $tampCekMulai)) + (60 * idate("i", $tampCekMulai));
            
            //code dibawah ini digunakan untuk mengkonversi waktuSelesai Int untuk perbandingan
            $tampCekSelesai = DateTime::createFromFormat("H:i:s", $row->waktuSelesai)->getTimestamp();
            $tampCekSelesai = (3600 * idate("H", $tampCekSelesai)) + (60 * idate("i", $tampCekSelesai));
            
            //code dibawah ini digunakan sebagai pesan error apabila masuk kedalam kondisi pengecekan
            $printErrMulai = DateTime::createFromFormat("H:i:s", $row->waktuMulai)->getTimestamp();
            $printErrMulai = date("H:i", $printErrMulai);
            
            //code dibawah ini digunakan sebagai pesan error apabila masuk kedalam kondisi pengecekan
            $printErrSelesai = DateTime::createFromFormat("H:i:s", $row->waktuSelesai)->getTimestamp();
            $printErrSelesai = date("H:i" , $printErrSelesai);
            
            //apabila jam insertMulai berada di antara jam waktuMulai dan waktuSelesai Database, akan mengembalikan pesan error
            if(($tampCekMulai <= $insertMulai) && ($tampCekSelesai >= $insertMulai))
            {
                echo "0 " . $printErrMulai . " " . $printErrSelesai . " " . $data['penanggungJawab'];
                return; 
            }
            //apabila jam insertSelesai berada di antara jam waktuMulai dan waktuSelesai Database, akan mengembalikan pesan error
            else if(($tampCekMulai <= $insertSelesai) && ($tampCekSelesai) >= $insertSelesai)
            {
                echo "0 " . $printErrSelesai . " " . $printErrSelesai . " " . $data['penanggungJawab'];
                return;
            }
            //apabila jam waktuMulai dan waktuSelesai Database berada di antara  
            //jam insertMulai dan insertSelesai akan mengembalikan pesan error
            else if(($tampCekMulai >= $insertMulai) && ($tampCekSelesai <= $insertSelesai))
            {
                echo "0 " . $printErrMulai . " " . $printErrSelesai . " " . $data['penanggungJawab'];
                return;
            }
        }
        
        $insertMulai =  gmdate("H:i", $insertMulai);
        $insertSelesai = gmdate("H:i", $insertSelesai);
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
              'idPenanggungJawab' => $queryPJ->idPenanggungJawab
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
              'idPenanggungJawab' => $queryPJ->idPenanggungJawab
            );
        }

        $this->db->insert('peminjaman', $insertTable);
        $this->lihatPeminjaman($data['waktuModal']);
    }
    
    public function lihatPeminjaman($data)
    {
        $data = strtotime($data); //$data dengan format STRING diubah menjadi TIME
        $month = date("m", $data);      //$month menampung INT dari bulan yang ada pada $data
        $year = date("Y", $data);       //$year menampung INT dari tahun yang ada pada $data
        
        $this->db->where('MONTH(tanggalPeminjaman)', $month);     //Query Builder dari CI untuk WHERE tanggalPeminjaman
        $this->db->where('Year(tanggalPeminjaman)', $year);       //Query Builder dari CI untuk WHERE tanggalPeminjaman
        $this->db->order_by('tanggalPeminjaman', 'asc');
        $this->db->order_by('waktuMulai', 'asc');
        $this->db->order_by('waktuSelesai', 'asc');
        $queryCetak =  $this->db->get('peminjaman');                 //Query Builder dari CI untuk SELECT ALL ke table 'peminjaman'
        
        if(empty($queryCetak->result()))
        {
            echo "0";
            return;
        }
        
        foreach ($queryCetak->result() as $row)      //for untuk setiap row yang didapatkan dari query
        {
            //Query dibawah ini untuk mendapatkan dari 'namaPenanggungJawab'
            //sesuai dengan 'idPenanggungJawab yang' ada di table 'peminjaman'
            $this->db->select('namaPenanggungJawab');
            $this->db->where('idPenanggungJawab', $row->idPenanggungJawab);
            $queryPJ = $this->db->get('penanggungjawab')->row();
    
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
            echo "<td>" . $queryPJ->namaPenanggungJawab . "</td>";
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
        //code dibawah ini digunakan untuk mengkonversi jamMulaiEdit dan menitMulaiEdit menjadi format Time
        $editMulai = (3600 * $data['jamMulaiEdit']) + (60 * $data['menitMulaiEdit']);
        
        //code dibawah ini digunakan untuk mengkonversi jamSelesaiEdit dan menitSelesaiEdit menjadi format Time
        $editSelesai = (3600 * $data['jamSelesaiEdit']) + (60 * $data['menitSelesaiEdit']);
        
        //code dibawah ini digunakan untuk mengubah format waktuModal dd-mm-yy menjadi format database yy-mm-dd
        $data['waktuModalEdit'] = DateTime::createFromFormat("d-m-Y", $data['waktuModalEdit'])->getTimestamp();
        $data['waktuModalEdit'] = date('Y-m-d', $data['waktuModalEdit']);
        
        //Query dibawah ini untuk mendapatkan dari 'idPenanggungJawab'
        //sesuai dengan 'namaPenanggungJawab yang' ada di table 'peminjaman'
        $this->db->select('idPenanggungJawab');
        $this->db->where('namaPenanggungJawab', $data['penanggungJawabEdit']);
        $query = $this->db->get('penanggungjawab')->row();
        
        //Query dibawah ini berguna sebagai pengecekan data, dan disesuaikan dengan fungsi lihatPeminjaman
        $this->db->where('tanggalPeminjaman', $data['waktuModalEdit']);
        $this->db->where('ruangPeminjaman', $data['ruangEdit']);
        $this->db->order_by('waktuMulai', 'asc');
        $this->db->order_by('waktuSelesai', 'asc');
        $queryCek = $this->db->get('peminjaman');
        
        foreach($queryCek->result() as $row)
        {
            //abaikan pengecekan jam pada id yang sama
            if($row->idPeminjaman == $data['idEdit'])
                continue;
            
            //code dibawah ini digunakan untuk mengkonversi waktuMulai Int untuk perbandingan
            $tampCekMulai = DateTime::createFromFormat("H:i:s", $row->waktuMulai)->getTimestamp();
            $tampCekMulai = (3600 * idate("H", $tampCekMulai)) + (60 * idate("i", $tampCekMulai));
            
            //code dibawah ini digunakan untuk mengkonversi waktuSelesai Int untuk perbandingan
            $tampCekSelesai = DateTime::createFromFormat("H:i:s", $row->waktuSelesai)->getTimestamp();
            $tampCekSelesai = (3600 * idate("H", $tampCekSelesai)) + (60 * idate("i", $tampCekSelesai));
            
            //code dibawah ini digunakan sebagai pesan error apabila masuk kedalam kondisi pengecekan
            $printErrMulai = DateTime::createFromFormat("H:i:s", $row->waktuMulai)->getTimestamp();
            $printErrMulai = date("H:i", $printErrMulai);
            
            //code dibawah ini digunakan sebagai pesan error apabila masuk kedalam kondisi pengecekan
            $printErrSelesai = DateTime::createFromFormat("H:i:s", $row->waktuSelesai)->getTimestamp();
            $printErrSelesai = date("H:i" , $printErrSelesai);
            
            //apabila jam editMulai berada di antara jam waktuMulai dan waktuSelesai Database, akan mengembalikan pesan error
            if(($tampCekMulai <= $editMulai) && ($tampCekSelesai >= $editMulai))
            {
                echo "0 " . $printErrMulai . " " . $printErrSelesai . " " . $data['penanggungJawabEdit'];
                return; 
            }
            //apabila jam editSelesai berada di antara jam waktuMulai dan waktuSelesai Database, akan mengembalikan pesan error
            else if(($tampCekMulai <= $editSelesai) && ($tampCekSelesai) >= $editSelesai)
            {
                echo "0 " . $printErrSelesai . " " . $printErrSelesai . " " . $data['penanggungJawabEdit'];
                return;
            }
            //apabila jam waktuMulai dan waktuSelesai Database berada di antara
            //jam editMulai dan editSelesai akan mengembalikan pesan error
            else if(($tampCekMulai >= $editMulai) && ($tampCekSelesai <= $editSelesai))
            {
                echo "0 " . $printErrMulai . " " . $printErrSelesai . " " . $data['penanggungJawabEdit'];
                return;
            }
        }
        
        $editMulai =  gmdate("H:i", $editMulai);
        $editSelesai = gmdate("H:i", $editSelesai);
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
        $this->lihatPeminjaman($data['waktuModalEdit']);
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