<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class peminjaman_model extends CI_Model{

    function __construct() {
        parent::__construct();
    }

    public function tambahPeminjaman() 
    {
        //Query dibawah ini untuk mendapatkan dari 'idPenanggungJawab'
        //sesuai dengan 'namaPenanggungJawab yang' ada di table 'peminjaman'
        $this->db->select('idPenanggungJawab');
        $this->db->where('namaPenanggungJawab', $data['penanggungJawab']);
        $query = $this->db->get('penanggungjawab')->row();
          
        $insertTable = array(
          'waktuPeminjaman' => $data['waktuModal'],
          'ruangPeminjaman' => $data['ruang'],
          'alatPeminjaman'  => $data['alat'],
          'keteranganPeminjaman' => $data['keterangan'],
          'idPenanggungJawab' => $query->idPenanggungJawab
        );
              
        $this->db->insert('peminjaman', $insertTable);
        $this->lihatPeminjaman($data['waktuSearch']);
    }
    
    public function lihatPeminjaman($data)
    {
        $data = strtotime($data);       //$data dengan format STRING diubah menjadi TIME
        $month = date("m", $data);      //$month menampung INT dari bulan yang ada pada $data
        $year = date("Y", $data);       //$year menampung INT dari tahun yang ada pada $data
        
        $this->db->where('MONTH(waktuPeminjaman)', $month);     //Query Builder dari CI untuk WHERE waktuPeminjaman
        $this->db->where('Year(waktuPeminjaman)', $year);       //Query Builder dari CI untuk WHERE waktuPeminjaman
        $query =  $this->db->get('peminjaman');                 //Query Builder dari CI untuk SELECT ALL ke table 'peminjaman'
        
        foreach ($query->result() as $row)      //for untuk setiap row yang didapatkan dari query
        {
            //Query dibawah ini untuk mendapatkan dari 'namaPenanggungJawab'
            //sesuai dengan 'idPenanggungJawab yang' ada di table 'peminjaman'
            $this->db->select('namaPenanggungJawab');
            $this->db->where('idPenanggungJawab', $row->idPenanggungJawab);
            $query2 = $this->db->get('penanggungjawab')->row();
    
            echo "<tr><td>" . $row->waktuPeminjaman . "</td>";      //echo ini digunakan untuk memunculkan waktuPeminjaman pada Tabel Peminjaman
            if($row->ruang == 0)                //echo ini digunakan untuk memunculkan ruang pada Tabel Peminjaman
                echo "<td> Kapel Atas </td>";
            else
                echo "<td> Kapel Bawah </td>";
            echo "<td>" . $row->alat . "</td>"; //echo ini digunakan untuk memunculkan alat pada Tabel Peminjaman
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