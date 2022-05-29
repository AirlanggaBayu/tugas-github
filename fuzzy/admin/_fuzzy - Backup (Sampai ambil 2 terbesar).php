
<?php
function grafikfungsikeanggotaansuhu()
{
?>
    <h5>Fungsi Keanggotaan FCR</h5>
    <img src="/fuzzy/fuzzy/fuzzy/assets/img/fcr.png" class="img-fluid" alt="Grafik Suhu">
    <br>
<?php
}
function grafikfungsikeanggotaankelembapan()
{
?>
    <h5>Fungsi Keanggotaan Henday</h5>
    <img src="/fuzzy/fuzzy/fuzzy/assets/img/henday.png" class="img-fluid" alt="Grafik Kelembapan">
    <br>
<?php
}

function grafikoutput()
{
?>
    <h4>Output</h4>
    <p>Outputnya adalah Status Produktivitas</p>
    <img src="/fuzzy/fuzzy/fuzzy/assets/img/status.png" class="img-fluid" alt="Grafik Debit Irigasi">
    <br>
<?php
}
function gambarrules()
{
?>
    <p>Daftar Rules:</p>
    <img src="/fuzzy/fuzzy/fuzzy/assets/img/rule.png" class="img-fluid" alt="Grafik Kelembapan">
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
    echo "<p><b>Nilai Fuzzy FCR: </b></p>";
    nilaigrafiksuhu($suhu);
    echo "<p><b>Nilai Fuzzy Henday: </b></p>";
    nilaigrafikkelembapan($kelembapan);
    // echo "<p><b>Nilai Fuzzy Tinggi Air: </b></p>";
    
}

function ambilTipVal()
{

}

function filterArray($tipes, $tipe)
{
  
    $min = 0;

    foreach ($tipes as $tipes) {
        if (in_array($tipe, $tipes)) {
            if ($min < $tipes['value']) {
                $min = $tipes['value'];
            }
        }
    }

    // echo'<pre>';
    return $min;
    // echo'</pre>';
}

function inferensi($suhu, $kelembapan)
{
    echo "<h4><b>Rules yang digunakan: </b></h4>";
    $x = 0;
    $no = 1;
    $kondisi = [];
    $nilaisuhu = [suhuminimum($suhu), suhuoptimal($suhu), suhumaksimal($suhu)];
    $nilaikelembapan = [tidaklembab($kelembapan), sangatsesuai($kelembapan), lembab($kelembapan)];
    $tipes = array();
        
    // array_filter($nilaikelembapan);
    // array_filter($nilaisuhu);

    // print_r($nilaisuhu);
    // print_r($nilaikelembapan);

    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {

            if (($nilaisuhu[$i] > 0) && ($nilaikelembapan[$j] > 0)){
                $min = min($nilaisuhu[$i], $nilaikelembapan[$j]);

                // if($i == 2 && $j <= 2){ //EXCEPTIONAL TINGGI + TINGGI
                //     $data = array(
                //         'tipe' => 'kurang',
                //         'value' => $min
                //     );

                //     array_push($tipes, $data);

                //     echo $no.'. FCR: '.$nilaisuhu[$i] .' dan HD: '. $nilaikelembapan[$j] .' = kurang
                //     ('. $min .')
                //     <br/>';
                // } else 

                if (($i == 0 && $j <= 1) || ($i == $j)) {
                    


                    $data = array(
                        'tipe' => 'produktif',
                        'value' => $min
                    );

                    array_push($tipes, $data);

                    echo $no.'. FCR: '.$nilaisuhu[$i] .' dan HD: '. $nilaikelembapan[$j] .' = produktif
                    ('. $min .')
                    <br/>';

                } elseif (($i == 0 && $j == 2) || ($i == 1 && $j == 2)) {
                    // filterArray($tipes, 'sangat', $min);
                    $data = array(
                        'tipe' => 'sangat',
                        'value' => $min
                    );

                    array_push($tipes, $data);
                    
                    echo $no.'. FCR: '.$nilaisuhu[$i] .' dan HD: '. $nilaikelembapan[$j] .' = sangat produktif
                    ('. $min .')
                    <br/>';

                } elseif (($i == 1 && $j == 0) || ($i == 2 && $j == 1)) {
                    // filterArray($tipes, 'kurang', $min);
                    $data = array(
                        'tipe' => 'kurang',
                        'value' => $min
                    );

                    array_push($tipes, $data);
                    
                    echo $no.'. FCR: '.$nilaisuhu[$i] .' dan HD: '. $nilaikelembapan[$j] .' = kurang produktif
                    ('. $min .')
                    <br/>';

                } elseif ($i == 2 && $j == 0) {
                    // filterArray($tipes, 'tidak', $min);
                    $data = array(
                        'tipe' => 'tidak',
                        'value' => $min
                    );

                    array_push($tipes, $data);
                    
                    echo $no.'. FCR: '.$nilaisuhu[$i] .' dan HD: '. $nilaikelembapan[$j] .' = tidak produktif
                    ('. $min .')
                    <br/>';
                }
            }

            $no++;

        }
    }

    // for ($i = 0; $i < 3; $i++) {
    //     for ($j = 0; $j < 3; $j++) {
    //          {
    //             if (($nilaisuhu[$i] > 0) && ($nilaikelembapan[$j] > 0)) {
    //                 $minimal[$x] = min($nilaisuhu[$i], $nilaikelembapan[$j]);
    //                 if ($j == 0) {
    //                     $kondisi[$x] = "Tidak Produktif";
    //                 } else if (($i < 2) && ($j < 1)) {
    //                     $kondisi[$x] = " Kurang Produktif";
    //                 } else if (($i < 3) && ($j < 2)) {
    //                     $kondisi[$x] = " Produktif";
    //                 } else {
    //                     $kondisi[$x] = "Sangat Produktif";
    //                 }
    //                 echo "<p>" . $no . ". IF FCR = " . $nilaisuhu[$i] . " AND Henday = " . $nilaikelembapan[$j] . " THAN Status Produktivitas = " . $kondisi[$x] . "(" . $minimal[$x] . ")</p>";
    //                 $x++;
    //             }
    //             $no++;
    //         }
    //     }
    // }


    // //Nilai Fuzzy Output
    // $nilai_banyak = 0;
    // $nilai_sedikit = 0;
    // for ($l = 0; $l < $x; $l++) {
    //     if ($kondisi[$l]  == "Banyak") {
    //         $nilai_banyak = max($minimal[$l], $nilai_banyak);
    //     } else {
    //         $nilai_sedikit = max($minimal[$l], $nilai_sedikit);
    //     }
    // }

    echo '<pre>';
    echo '<h3>DD Tipes</h3>';
    var_dump($tipes);
    echo '</pre>';

    echo "<h4><b>Nilai Fuzzy Output: </b></h4>";

    // $tipe = array_filter($tipe);
    
    
    $tipesmanual = array(
        ['tipe' => 'tidak', 'value' => 3.0],
        ['tipe' => 'sangat', 'value' => 20.0],
        ['tipe' => 'produktif', 'value' => 10],
        ['tipe' => 'tidak', 'value' => 8.0],
        ['tipe' => 'produktif', 'value' => 0.1],
        ['tipe' => 'kurang', 'value' => 0.7],
        ['tipe' => 'sangat', 'value' => 8.0],
        ['tipe' => 'kurang', 'value' => 0.2],
        ['tipe' => 'produktif', 'value' => 8]
    );

    $list_tipe = array();
    $list_value= array();
    $list_final = array();
    $listyangdipakai = $tipes;

    foreach ($listyangdipakai as $key) {
        if (in_array($key['tipe'], $list_tipe) == FALSE) {
            array_push($list_tipe, $key['tipe']);
        } 
    }

    foreach ($list_tipe as $list) {
        echo $list.' : '.filterArray($listyangdipakai, $list).' || ';
        $data = array(
            'tipe' => $list,
            'value_max' => filterArray($listyangdipakai, $list)
        );
        array_push($list_value,$data['value_max']);
        array_push($list_final,$data);
    }   

    echo '<pre>';
    echo '<h3>List tipe</h3>';
    var_dump($list_tipe);
    echo '</pre>';

    echo '<pre>';
    echo '<h3>List value</h3>';
    var_dump($list_value);
    echo '</pre>';
    // var_dump($list_final);
    

    // if (in_array('produktif', $tipes)) {
    //     echo 'ada loh produktif';
    // } else {
    //     echo 'tidak ada loh';
    // }

    // echo "<p>Debit Irigasi Banyak(" . $nilai_banyak . ")</p>";
    // echo "<p>Debit Irigasi Sedikit( " . $nilai_sedikit . ")</p>";
    //Defuzzifikasi
    echo '<h4><b>Defuzzifikasi:</b></h4>';
    // echo '<p>Menggunakan metode Centroid Method</p>';
    // echo '<img src="_assets/img/defuzzifikasi.jpg" class="img-fluid" alt="Grafik Debit Irigasi">';
    // echo '<p>Sampel yang diambil adalah titik 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10. Kemudian dimasukkan ke dalam rumus:</p>';
    // echo '<img src="https://latex.codecogs.com/svg.latex?y*&space;=&space;\frac{((0&plus;1&plus;2&plus;3&plus;4)*' . $nilai_sedikit . ')&plus;((5)*0,5)&plus;((6&plus;7&plus;8&plus;9&plus;10)*' . $nilai_banyak . ')}{((5)*' . $nilai_sedikit . ')&plus;((1)*0,5)&plus;((5)*' . $nilai_banyak . ')}"/>';
    // $nilaiy = ((10 * $nilai_sedikit) + (40 * $nilai_banyak) + 0.5) / ((5 * $nilai_sedikit) + (5 * $nilai_banyak) + 0.5);
    // echo "<br><h4><b>Banyaknya Debit Irigasi (y*)= </b>" . $nilaiy . " L/s/Ha</h4>";

    echo '<br/><br/><br/><br/><br/><br/><br/><hr/><br/>';

    var_dump(cobaHitung($list_value));

    echo '<br/><br/><br/><br/><br/><br/><br/><br/>';
}

function cobaHitung($data)
{
    // $data = array(
    //     3,3,9
    // );

    $besar1 = 0;
    $besar2 = 0;

    foreach ($data as $value) {
        
        if ($value > $besar2) {
            if ($value > $besar1) {
                $besar2 = $besar1;
                $besar1 = $value;
            } else {
                $besar2 = $value;
            }
        }
    }

    $dataKeluar = array($besar1, $besar2);

    return $dataKeluar;
}

function suhuminimum($suhu)
{
    //fcr rendah
    $nilaisuhuminimum = 0;
    //suhu minimum
    if ($suhu <= 2.1) {
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
                    $nilaisuhuoptimal = (2.5 - $suhu) / 0.2;
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
            $nilaisuhumaksimal = ($suhu - 2.3) / 0.2;
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