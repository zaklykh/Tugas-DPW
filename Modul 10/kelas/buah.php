<?php
require_once ('Mahasiswa.php');

$mhs1 = new mahasiswa("Habibi Zakly Khairullah");
$mhs1->setNIM("253307048");
$mhs1->setKelas("2B");

// tampilkan nama nim dan kelas dari $mhs1
echo "Nama: " . $mhs1->getNama() . "<br>";
echo "NIM: " . $mhs1->getNim() . "<br>";
echo "Kelas: " . $mhs1->getKelas() . "<br>";
?>
