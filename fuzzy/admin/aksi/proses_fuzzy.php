
<?php
function grafikfungsikeanggotaansuhu()
{
?>
    <h5>Fungsi Keanggotaan Suhu</h5>
    <img src="_assets/img/suhu.jpg" class="img-fluid" alt="Grafik Suhu">
    <br>
<?php
}
function grafikfungsikeanggotaankelembapan()
{
?>
    <h5>Fungsi Keanggotaan Kelembapan</h5>
    <img src="_assets/img/kelembapan.jpg" class="img-fluid" alt="Grafik Kelembapan">
    <br>
<?php
}

function grafikoutput()
{
?>
    <h4>Output</h4>
    <p>Outputnya adalah Debit Irigasi</p>
    <img src="_assets/img/debitirigasi.jpg" class="img-fluid" alt="Grafik Debit Irigasi">
    <br>
<?php
}
function gambarrules()
{
?>
    <p>Daftar Rules:</p>
    <img src="_assets/img/rules.jpg" class="img-fluid" alt="Daftar Rules">
    <br>
<?php
}
function nilaigrafiksuhu($suhu)
{
    if (suhuminimum($suhu) != 0) {
        echo "Rendah FCR (" . suhuminimum($suhu) . ")";
        echo "<br>";
    }
    if (suhuoptimal($suhu) != 0) {
        echo "FCR Normal (" . suhuoptimal($suhu) . ")";
        echo "<br>";
    }
    if (suhumaksimal($suhu) != 0) {
        echo "FCR Tinggi (" . suhumaksimal($suhu) . ")";
        echo "<br>";
    }
    echo "<br>";
}
function nilaigrafikkelembapan($kelembapan)
{
    if (tidaklembab($kelembapan) != 0) {
        echo "Henday Rendah (" . tidaklembab($kelembapan) . ")";
        echo "<br>";
    }
    if (sangatsesuai($kelembapan) != 0) {
        echo "Henday Normal(" . sangatsesuai($kelembapan) . ")";
        echo "<br>";
    }
    if (lembab($kelembapan) != 0) {
        echo "Henday Tinggi (" . lembab($kelembapan) . ")";
        echo "<br>";
    }
    echo "<br>";
}

function hasilfuzzifikasi($suhu, $kelembapan)
{
    echo "<h4><b>Hasil Fuzzifikasi: </b></h4>";
    echo "<p><b>Nilai Fuzzy Suhu: </b></p>";
    nilaigrafiksuhu($suhu);
    echo "<p><b>Nilai Fuzzy Kelembapan: </b></p>";
    nilaigrafikkelembapan($kelembapan);
    echo "<p><b>Nilai Fuzzy Tinggi Air: </b></p>";
    
}
function inferensi($suhu, $kelembapan)
{
    echo "<h4><b>Rules yang digunakan: </b></h4>";
    $x = 0;
    $no = 1;
    $kondisi = [];
    $nilaisuhu = [suhuminimum($suhu), suhuoptimal($suhu), suhumaksimal($suhu)];
    $nilaikelembapan = [tidaklembab($kelembapan), sangatsesuai($kelembapan), lembab($kelembapan)];
   

    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            for ($k = 0; $k < 3; $k++) {
                if (($nilaisuhu[$i] > 0) && ($nilaikelembapan[$j] > 0)) {
                    $minimal[$x] = min($nilaisuhu[$i], $nilaikelembapan[$j]);
                    if ($k == 0) {
                        $kondisi[$x] = "Banyak";
                    } else if (($i == 2) && ($k == 1) && ($j < 2)) {
                        $kondisi[$x] = "Banyak";
                    } else {
                        $kondisi[$x] = "Sedikit";
                    }
                    echo "<p>" . $no . ". IF Suhu = " . $nilaisuhu[$i] . " AND Kelembapan = " . $nilaikelembapan[$j] . " THAN Debit Irigasi = " . $kondisi[$x] . "(" . $minimal[$x] . ")</p>";
                    $x++;
                }
                $no++;
            }
        }
    }
    //Nilai Fuzzy Output
    $nilai_banyak = 0;
    $nilai_sedikit = 0;
    for ($l = 0; $l < $x; $l++) {
        if ($kondisi[$l]  == "Banyak") {
            $nilai_banyak = max($minimal[$l], $nilai_banyak);
        } else {
            $nilai_sedikit = max($minimal[$l], $nilai_sedikit);
        }
    }
    echo "<h4><b>Nilai Fuzzy Output: </b></h4>";
    echo "<p>Debit Irigasi Banyak(" . $nilai_banyak . ")</p>";
    echo "<p>Debit Irigasi Sedikit( " . $nilai_sedikit . ")</p>";
    //Defuzzifikasi
    echo '<h4><b>Defuzzifikasi</b></h4>';
    echo '<p>Menggunakan metode Centroid Method</p>';
    echo '<img src="_assets/img/defuzzifikasi.jpg" class="img-fluid" alt="Grafik Debit Irigasi">';
    echo '<p>Sampel yang diambil adalah titik 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10. Kemudian dimasukkan ke dalam rumus:</p>';
    echo '<img src="https://latex.codecogs.com/svg.latex?y*&space;=&space;\frac{((0&plus;1&plus;2&plus;3&plus;4)*' . $nilai_sedikit . ')&plus;((5)*0,5)&plus;((6&plus;7&plus;8&plus;9&plus;10)*' . $nilai_banyak . ')}{((5)*' . $nilai_sedikit . ')&plus;((1)*0,5)&plus;((5)*' . $nilai_banyak . ')}"/>';
    $nilaiy = ((10 * $nilai_sedikit) + (40 * $nilai_banyak) + 0.5) / ((5 * $nilai_sedikit) + (5 * $nilai_banyak) + 0.5);
    echo "<br><h4><b>Banyaknya Debit Irigasi (y*)= </b>" . $nilaiy . " L/s/Ha</h4>";
}
function suhuminimum($suhu)
{
    //fcr rendah
    $nilaisuhuminimum = 0;
    //suhu minimum
    if ($suhu <= 2.10) {
        $nilaisuhuminimum = 1;
    } else {
        if ($suhu < 2.2) {
            $nilaisuhuminimum = (2.2 - $suhu) / 0.1;
        } else {
            $nilaisuhuminimum = 0;
        }
    }
    return $nilaisuhuminimum;
}
function suhuoptimal($suhu)
{
    //fcr normal
    $nilaisuhuoptimal = 0;
    //suhu optimal
    if ($suhu >= 2.1 && $suhu <= 2.5) {
        if ($suhu >= 2.2 && $suhu <= 2.3) {
            $nilaisuhuoptimal = 1;
        } else {
            if ($suhu >= 2.1 && $suhu < 2.2) {
                $nilaisuhuoptimal = ($suhu - 2.1) / 0.1;
            } else {
                if ($suhu > 2.3 && $suhu <= 2.5) {
                    $nilaisuhuoptimal = (2.5 - $suhu) / 0.1;
                } else {
                    $nilaisuhuoptimal = 0;
                }
            }
        }
    }
    return $nilaisuhuoptimal;
}
function suhumaksimal($suhu)
{
    //fcr tinggi
    $nilaisuhumaksimal = 0;
    //suhu maksimal
    if ($suhu >= 2.5) {
        $nilaisuhumaksimal = 1;
    } else {
        if ($suhu >= 2.3 && $suhu < 2.5) {
            $nilaisuhumaksimal = ($suhu - 2.3) / 0.1;
        } else {
            $nilaisuhumaksimal = 0;
        }
    }
    return $nilaisuhumaksimal;
}
function tidaklembab($kelembapan)
{
    //henday rendah
    $kelembapantidaklembab = 0;
    //tidak LEMBAB
    if ($kelembapan <= 55) {
        $kelembapantidaklembab = 1;
    } else {
        if ($kelembapan < 60) {
            $kelembapantidaklembab = (60 - $kelembapan) / 5;
        } else {
            $kelembapantidaklembab = 0;
        }
    }
    return $kelembapantidaklembab;
}
function sangatsesuai($kelembapan)
{
    //henday normal
    $nilaikelembapansangatsesuai = 0;
    //sangat sesuai
    if ($kelembapan >= 55 && $kelembapan <= 85) {
        if ($kelembapan >= 60 && $kelembapan <= 70) {
            $nilaikelembapansangatsesuai = 1;
        } else {
            if ($kelembapan >= 55 && $kelembapan < 60) {
                $nilaikelembapansangatsesuai = ($kelembapan - 55) / 5;
            } else {
                if ($kelembapan > 70 && $kelembapan <= 85) {
                    $nilaikelembapansangatsesuai = (85 - $kelembapan) / 15;
                } else {
                    $nilaikelembapansangatsesuai = 0;
                }
            }
        }
    }
    return $nilaikelembapansangatsesuai;
}
function lembab($kelembapan)
{
    //henday tinggi
    $kelembapanlembab = 0;
    //LEMBAB
    if ($kelembapan >= 85) {
        $kelembapanlembab = 1;
    } else {
        if ($kelembapan >= 70 && $kelembapan < 85) {
            $kelembapanlembab = ($kelembapan - 70) / 15;
        } else {
            $kelembapanlembab = 0;
        }
    }
    return $kelembapanlembab;
}
function tinggiairkering($tinggiair)
{
    $nilaitinggiairkering = 0;
    //tinggi air kering
    if ($tinggiair <= 1) {
        $nilaitinggiairkering = 1;
    } else {
        if ($tinggiair <= 3) {
            $nilaitinggiairkering = (3 - $tinggiair) / 2;
        } else {
            $nilaitinggiairkering = 0;
        }
    }
    return $nilaitinggiairkering;
}
function tinggiairideal($tinggiair)
{
    $nilaitinggiairideal = 0;
    //tinggi air ideal
    if ($tinggiair >= 1 && $tinggiair <= 10) {
        if ($tinggiair >= 3 && $tinggiair <= 5) {
            $nilaitinggiairideal = 1;
        } else {
            if ($tinggiair >= 1 && $tinggiair < 3) {
                $nilaitinggiairideal = ($tinggiair - 1) / 2;
            } else {
                if ($tinggiair > 5 && $tinggiair <= 10) {
                    $nilaitinggiairideal = (10 - $tinggiair) / 5;
                } else {
                    $nilaitinggiairideal = 0;
                }
            }
        }
    }
    return $nilaitinggiairideal;
}
function tinggiairbanjir($tinggiair)
{
    $nilaitinggiairbanjir = 0;
    //tinggi air banjir
    if ($tinggiair >= 10) {
        $nilaitinggiairbanjir = 1;
    } else {
        if ($tinggiair >= 5 && $tinggiair <= 10) {
            $nilaitinggiairbanjir = ($tinggiair - 5) / 5;
        } else {
            $nilaitinggiairbanjir = 0;
        }
    }
    return $nilaitinggiairbanjir;
}
?>