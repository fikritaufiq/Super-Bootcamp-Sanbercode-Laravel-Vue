<?php

abstract class Hewan {
  protected $nama;
  protected $darah = 50;
  protected $jumlahKaki;
  protected $keahlian;
  protected $attackPower;
  protected $defencePower;

  public function __construct($nama) {
    $this->nama = $nama;
  }

  public function atraksi() {
    echo $this->nama. " sedang ". $this->keahlian. "<br>";
  }

  abstract public function serang(Hewan $target);
  abstract public function diserang(Hewan $penyerang);

  public function getStatusAwal() {
    echo "Status Awal ". $this->nama. "<br>";
    echo "Darah : ". $this->darah. "<br>";
    echo "Jumlah Kaki : ". $this->jumlahKaki. "<br>";
    echo "Keahlian : ". $this->keahlian. "<br>";
    echo "Attack Power : ". $this->attackPower. "<br>";
    echo "Defence Power : ". $this->defencePower. "<br>";
  }
}

class Elang extends Hewan {
  public function __construct($nama) {
    parent::__construct($nama);
    $this->jumlahKaki = 2;
    $this->keahlian = "terbang tinggi";
    $this->attackPower = 10;
    $this->defencePower = 5;
  }

  public function serang(Hewan $target) {
    echo $this->nama. " sedang menyerang ". $target->nama. "<br>";
    $target->diserang($this);
  }

  public function diserang(Hewan $penyerang) {
    $this->darah -= ($penyerang->attackPower / $this->defencePower);
    echo $this->nama. " sedang diserang<br>";
    echo $this->nama. " darah sekarang : ". $this->darah. "<br>";
  }

  public function getStatusAwal() {
    parent::getStatusAwal();
    echo "Jenis Hewan : Elang<br>";
  }
}

class Harimau extends Hewan {
  public function __construct($nama) {
    parent::__construct($nama);
    $this->jumlahKaki = 4;
    $this->keahlian = "lari cepat";
    $this->attackPower = 7;
    $this->defencePower = 8;
  }

  public function serang(Hewan $target) {
    echo $this->nama. " sedang menyerang ". $target->nama. "<br>";
    $target->diserang($this);
  }

  public function diserang(Hewan $penyerang) {
    $this->darah -= ($penyerang->attackPower / $this->defencePower);
    echo "<br>";
    echo $this->nama. " darah setelah diserang : ". $this->darah. "<br>";
  }

  public function getInfoHewan() {
    parent::getInfoHewan();
    echo "Jenis Hewan : Harimau<br>";
  }
}

// Example usage:
$hewan1 = new Elang("Elang 1");
$hewan2 = new Harimau("Harimau 2");

echo "Status Awal:<br>";
$hewan1->getStatusAwal();
echo "<br>";
$hewan2->getStatusAwal();
echo "<br><br>";

$hewan1->atraksi();
echo "<br>";
$hewan2->atraksi();
echo "<br><br>";

$hewan1->serang($hewan2);

echo "<br><br>";


?>