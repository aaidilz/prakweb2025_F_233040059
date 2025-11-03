<?php

class Rumah {
    public $warna;
    public $alamat;

    public function __construct($warna, $alamat) {
        $this->warna = $warna;
        $this->alamat = $alamat;
    }   
}

function pasangListik(Rumah  $dataRumah) {
        return "Memasang listrik di rumah yang berwarna " . $dataRumah->warna . " dan beralamat di " . $dataRumah->alamat;
    }


$rumahSaya = new Rumah("Merah", "Jl. Merdeka No. 10");
echo pasangListik($rumahSaya);
echo "<br>";

$teksBiasa = "Ini adalah string biasa.";
?>
