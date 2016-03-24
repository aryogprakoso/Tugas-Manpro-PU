<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class peminjaman_model extends CI_Model{

    function __construct() {
        parent::__construct();
    }

    public function lihatData($data)
    {
        $data = strtotime($data);       //$data dengan format STRING diubah menjadi TIME
        $month = date("m", $data);      //$month menampung INT dari bulan yang ada pada $data
        $year = date("Y", $data);       //$year menampung INT dari tahun yang ada pada $data
        
        $this->db->where('MONTH(waktuPeminjaman)', $month);     //Query Builder dari CI untuk WHERE waktuPeminjaman
        $this->db->where('Year(waktuPeminjaman)', $year);       //Query Builder dari CI untuk WHERE waktuPeminjaman
        $query =  $this->db->get('peminjaman');                 //Query Builder dari CI untuk SELECT ALL ke table 'peminjaman'
        
        foreach ($query->result() as $row)      //for untuk setiap row yang didapatkan dari query
        {
            echo "<tr><td>" . $row->waktuPeminjaman . "</td>";      //echo ini digunakan untuk memunculkan waktuPeminjaman pada Tabel Peminjaman    
            if($row->ruang == 0)                //echo ini digunakan untuk memunculkan ruang pada Tabel Peminjaman
                echo "<td> Kapel Atas </td>";
            else
                echo "<td> Kapel Bawah </td>";
            echo "<td>" . $row->alat . "</td>"; //echo ini digunakan untuk memunculkan alat pada Tabel Peminjaman
            echo "<td>" . $row->keteranganPeminjaman . "</td>"; //echo ini digunakan untuk memunculkan keteranganPeminjaman pada Tabel Peminjaman
            echo "<td>" . $row->idPenanggungJawab . "</td></tr>"; //echo ini digunakan untuk memunculkan idPenanggungJawab pada Tabel Peminjaman
        }
    }
    
    public function tambah_data() 
    {
        
    }
    
}