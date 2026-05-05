<?php
require_once ('Mahasiswa.php');

$mhs1 = new mahasiswa("Nama Anda");
$mhs1->setNIM("NIM anda");
$mhs1->setKelas("Kelas anda");

// tampilkan nama nim dan kelas dari $mhs1
echo "Nama: " . $mhs1->getNama() . "<br>";
echo "NIM: " . $mhs1->getNim() . "<br>";
echo "Kelas: " . $mhs1->getKelas() . "<br>";
?>
