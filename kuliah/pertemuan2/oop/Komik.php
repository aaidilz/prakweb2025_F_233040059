<?php

require_once 'Produk.php';

class Komik extends Produk {
    public $jmlHalaman;

    public function __construct($judul = "judul", $penulis = "penulis", $penerbit = "penerbit", $harga = 0, $jmlHalaman = 0) {
        parent::__construct($judul, $penulis, $penerbit, $harga);
        $this->jmlHalaman = $jmlHalaman;
    }

    public function getInfoProduk() {
        $str = "Komik: " . $this->judul . " | " . $this->getLabel() . " (Rp. " . $this->harga . ") - " . $this->jmlHalaman . " Halaman.";
        return $str;
    }
}