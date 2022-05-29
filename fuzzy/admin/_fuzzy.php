
<?php
function grafikfungsikeanggotaanfcr()
{?>
    <h5>Fungsi Keanggotaan FCR</h5>
    <img src="/fuzzy/assets/img/fcr.png" class="img-fluid" alt="Grafik FCR">
    <br>
<?php
}

function grafikfungsikeanggotaanhenday()
{
?>
    <h5>Fungsi Keanggotaan Henday</h5>
    <img src="/fuzzy/assets/img/hd.png" class="img-fluid" alt="Grafik Henday">
    <br>
<?php
}

function grafikoutput()
{
?>
    <h4>Output</h4>
    <p>Outputnya adalah Status Produktivitas</p>
    <img src="/fuzzy/assets/img/status.png" class="img-fluid" alt="Grafik Debit Irigasi">
    <br>
<?php
}

function gambarrules()
{
?>
    <p></p>
    <img src="/fuzzy/assets/img/rule.png" class="img-fluid" alt="Gambar Rule">
    <hr/>
<?php
}

function nilaigrafikfcr($fcr)
{
    if (fcrrendah($fcr) != 0) {
        echo "FCR Rendah (" . fcrrendah($fcr) . ")";
        echo "<br>";
    }
    if (fcrnormal($fcr) != 0) {
        echo "FCR Normal (" . fcrnormal($fcr) . ")";
        echo "<br>";
    }
    if (fcrtinggi($fcr) != 0) {
        echo "FCR Tinggi (" . fcrtinggi($fcr) . ")";
        echo "<br>";
    }
}

function nilaigrafikhenday($henday)
{
    if (rendah($henday) != 0) {
        echo "Henday Rendah (" . rendah($henday) . ")";
        echo "<br>";
    }
    if (normal($henday) != 0) {
        echo "Henday Normal(" . normal($henday) . ")";
        echo "<br>";
    }
    if (tinggi($henday) != 0) {
        echo "Henday Tinggi (" . tinggi($henday) . ")";
        echo "<br>";
    }
}

function hasilfuzzifikasi($fcr, $henday)
{
    echo "<h3 class='kasih-border-kiri'><b>Hasil Fuzzifikasi: </b></h3>";
    echo "<h4><b>Nilai Fuzzy FCR: </b></h4>";
    nilaigrafikfcr($fcr);
    echo "<br>";
    echo "<h4><b>Nilai Fuzzy Henday: </b></h4>";
    nilaigrafikhenday($henday);
    echo "<br>";
    
    
}

function tipesManual() // RETURN BANYAK TIPES BUAT DEBUG AJA
{
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

    return $tipesmanual;
}

function printRule($data) //  CUMA PRINT RULES
{

    return '. FCR: '.$data["fcr"] .' dan HD: '. $data["hd"] .' = '. $data['tipe'] .'
                    ('. $data["min"] .')
                    <br/>';
}

function filterData($array, $nama) // BUANG DATA DATA YANG SAMA
{
    $list = array();

    foreach ($array as $key) {
        if (in_array($key[$nama], $list) == FALSE) {
            array_push($list, $key[$nama]);
        } 
    }

    return $list;
}

function listFinal($tipes, $list_tipe) // filter tipe yang sama, cuma ambil nilai yang besar    
{
    $list_final = array();
  
    foreach ($list_tipe as $tipe) { 

        $value = 0;
    
        foreach ($tipes as $tipes2) {

            if (in_array($tipe, $tipes2)) {
                if ($value < $tipes2['value']) {
                    $value = $tipes2['value'];
                }
            }
        }

        $data = array(
            'tipe' => $tipe,
            'value_max' => $value
        );
        
        array_push($list_final,$data);
    }  

    // echo'<pre>';
    return $list_final;
    // echo'</pre>';
}

function cari2A($array, $nama) // ambil cuma 2, nilai yang paling besar
{

    $temp['a1'] = array(
        'tipe'=> '',
        'value' => 0
    );
    $temp['a2'] = array(
        'tipe'=> '',
        'value' => 0
    );

    foreach ($array as $array2) {
        $data = array(
            'tipe' => $array2['tipe'],
            'value' => $array2[$nama]
        );

        if ($temp['a2']['value'] < $array2[$nama]) {
            if ($temp['a1']['value'] < $array2[$nama]) {
                $temp['a2'] = $temp['a1'];
                $temp['a1'] = $data;
            } elseif ($temp['a2']['value'] < $array2[$nama]) {
                $temp['a2'] = $data;
            }
        }
    }

    return $temp;
}

function hitungA($array)
{
    $data = array();
    $ax = array($array['a1']['tipe'], $array['a2']['tipe']);
    $a1 = $array['a1']['tipe']; 
    $a2 = $array['a2']['tipe'];

    $a1v = $array['a1']['value']; 
    $a2v = $array['a2']['value'];

    // echo $a1 . ' ' . $a2;
    
    if (in_array('tidak produktif', $ax)) {
        if (in_array('kurang produktif', $ax)) { // TIPE 2

            $tipe = 'tipe 5';

        } else { // TIPE 1

            $tipe = 'tipe 1';

        }
    } elseif (in_array('kurang produktif', $ax)) {
        if (in_array('tidak produktif', $ax)) { // TIPE 2

            $tipe = 'tipe 5';

        } elseif (in_array('produktif', $ax)) { // TIPE 3

            $tipe = 'tipe 6';

        } else { // TIPE 2

            $tipe = 'tipe 2';

        }
    } elseif (in_array('produktif', $ax)) {
        if (in_array('kurang produktif', $ax)) { // TIPE 3

            $tipe = 'tipe 6';

        } elseif (in_array('sangat produktif', $ax)) { // TIPE 4

            $tipe = 'tipe 7';

        } else { // TIPE 3

            $tipe = 'tipe 3';

        }

    } elseif (in_array('sangat produktif', $ax)) { // TIPE 4

            $tipe = 'tipe 4';

    }

    array_push($data, $tipe);

    if ($tipe == 'tipe 1') {

        $y1 = (27.5 - 0) * $a1v;

        $h1 = 0 + $y1;

        $y2 = (55 - 27.5) * $a2v;

        $h2 = 55 - $y2;

        $n = ($h1+$h2)/2;
        
    } elseif ($tipe == 'tipe 2') {

        $y1 = (57.5 - 50) * $a1v;

        $h1 = 50 + $y1;

        $y2 = (70 - 57.5) * $a2v;

        $h2 = 70 - $y2;

        $n = ($h1+$h2)/2;
        
    } elseif ($tipe == 'tipe 3') {
        
        $y1 = (70 - 57.5) * $a1v;

        $h1 = 60 + $y1;

        $y2 = (85 - 72.5) * $a2v;

        $h2 = 85 - $y2;

        $n = ($h1+$h2)/2;

    } elseif ($tipe == 'tipe 4') {

        $y1 = (90 - 75) * $a1v;

        $h1 = 75 + $y1;

        $y2 = (100 - 90) * $a2v;

        $h2 = 100 - $y2;

        $n = ($h1+$h2)/2;
        
    }elseif ($tipe == 'tipe 5') {

        $y1 = (55 - 27.5) * $a1v;

        $h1 = 50 + $y1;

        $y2 = (55 - 27.5) * $a2v;

        $h2 = 55 - $y2;

        $n = ($h1+$h2)/2;
    }elseif ($tipe == 'tipe 6') {

        $y1 = (70 - 57.5) * $a1v;

        $h1 = 60 + $y1;

        $y2 = (70 - 57.5) * $a2v;

        $h2 = 70 - $y2;

        $n = ($h1+$h2)/2;
        
    }elseif ($tipe == 'tipe 7') {

        $y1 = (85 - 72.5) * $a1v;

        $h1 = 75 + $y1;

        $y2 = (85 - 72.5) * $a2v;

        $h2 = 85 - $y2;

        $n = ($h1+$h2)/2;
    }

    

    array_push($data, $n);
  
    return $data;

}

function filterAkhir($array) // AMBIL 1 NILAI YANG PALING BESAR, JIKA ADA 2 NILAI SAMA TAPI TIPE BEDA, AMBIL DUA DUANYA
{

    if ($array['a1']['value'] == $array['a2']['value']) {
        return $array;
    } elseif ($array['a1']['value'] > $array['a2']['value']) {
        $array['a2'] = $array['a1'];
        return $array;
    } else {
        $array['a1'] = $array['a2'];
        return $array;
    }

}

function inferensi($fcr, $henday)
{
    echo "<h3 class='kasih-border-kiri'><b>Inferensi: </b></h3>";
    echo "<h4>Menggunakan nilai min yang didapat dari nilai fuzzy fcr & nilai fuzzy henday, kemudian disesuaikan dengan rule yang sesuai</h4>";
    $x = 0;
    $no = 1;
    $kondisi = [];
    $nilaifcr = [fcrrendah($fcr), fcrnormal($fcr), fcrtinggi($fcr)];
    $nilaihenday = [rendah($henday), normal($henday), tinggi($henday)];
    $tipes = array();

    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {

            if (($nilaifcr[$i] > 0) && ($nilaihenday[$j] > 0)){
                $min = min($nilaifcr[$i], $nilaihenday[$j]);
                
                $data = array(
                    'value' => $min,
                    'fcr' => $nilaifcr[$i],
                    'hd' => $nilaihenday[$j],
                    'min' =>  $min
                );

                // if($i == 2 && $j <= 2){ // EXCEPTIONAL TINGGI + TINGGI
                //    $data['tipe'] = 'kurang produktif';
                // } else 

                if (($i == 0 && $j <= 1) || ($i == $j)) {
                
                    $data['tipe'] = 'produktif';

                } elseif (($i == 0 && $j == 2) || ($i == 1 && $j == 2)) {

                    $data['tipe'] = 'sangat produktif';

                } elseif (($i == 1 && $j == 0) || ($i == 2 && $j == 1)) {
                    
                    $data['tipe'] = 'kurang produktif';
                
                } elseif ($i == 2 && $j == 0) {

                    $data['tipe'] = 'tidak produktif';
                    
                }
                
                array_push($tipes, ['tipe' => $data['tipe'], 'value' => $min]); // SIMPAN DATA
                echo $no . printRule($data); // PRINT RULES
            }

            $no++;

        }
    }
    echo '<br/><hr/>';

    // ====================================
    // ====================================

    echo "<h3 class='kasih-border-kiri'><b>Komposisi Aturan: </b></h3>";


    // ==================================== STEP 1


    echo "<h4><strong>Langkah 1:</strong> Jika ada >1 tipe yang sama, ambil yang punya valie paling besar, sisanya abaikan </h4>";
    
    $list_tipe = filterData($tipes, 'tipe');

    $list_final = listFinal($tipes, $list_tipe);
    // echo '<pre>'; echo '<h3>List Final</h3>'; print_r($list_final); echo '</pre>'; // JIKA ADA >1 TIPE SAMA, AMBIL YANG VALUE PALING BESAR, SISANYA DROP

    echo '<table class="table table-primary" style="display:inline-block; margin-top:1em;">
            <tr>
                <th>Tipe</th>
                <th>Nilai</th>
            </tr>';

            foreach ($list_final as $list_final2) {
                echo '<tr>';
                    echo '<td>'. $list_final2['tipe'] .'</td>';
                    echo '<td>'. $list_final2['value_max'] .'</td>';
                echo '</tr>';
            }

    echo '</table>';


    // ==================================== STEP 2 - OPTIONAL


    // echo "<h4><strong>Step 2:</strong> Ambil nilai yang paling besar dari step sebelumnya </h4>";

    $cari2A = cari2A($list_final, 'value_max');
    // // echo '<pre>'; echo '<h3>Cari A</h3>'; print_r($cari2A); echo '</pre>'; // AMBIL 2 ROW, YANG NILAINYA PALING BESAR

    // echo '<table class="table table-primary" style="display:inline-block; margin-top:1em;">
    //         <tr>
    //             <th>Tipe</th>
    //             <th>Nilai</th>
    //         </tr>';

    //         foreach ($cari2A as $cari2Ax) {
    //             echo '<tr>';
    //                 echo '<td>'. $cari2Ax['tipe'] .'</td>';
    //                 echo '<td>'. $cari2Ax['value'] .'</td>';
    //             echo '</tr>';
    //         }

    // echo '</table>';


    // ==================================== STEP 3 ta 2

    echo "<h4><strong>Langkah 2:</strong> Ambil 1 value yang paling besar, jika ada 2 yang paling besar tapi dengan tipe berbeda, ambil dua-duanya  </h4>";
    
    $filterAkhir = filterAkhir($cari2A);
    // echo '<pre>'; echo '<h3>filter Akhir</h3>'; print_r($filterAkhir); echo '</pre>'; // AMBIL 1 NILAI YANG PALING BESAR, JIKA ADA 2 NILAI SAMA TAPI TIPE BEDA, AMBIL DUA DUANYA

    echo '<table class="table table-primary" style="display:inline-block; margin-top:1em;">
            <tr>
                <th>Tipe</th>
                <th>Nilai</th>
            </tr>';

            if ($filterAkhir['a1']['tipe'] == $filterAkhir['a2']['tipe']) {
                echo '<tr>';
                    echo '<td>'. $filterAkhir['a1']['tipe'] .'</td>';
                    echo '<td>'. $filterAkhir['a1']['value'] .'</td>';
                echo '</tr>';

            } else {   

                foreach ($filterAkhir as $filterAkhirx) {
                    echo '<tr>';
                    echo '<td>'. $filterAkhirx['tipe'] .'</td>';
                    echo '<td>'. $filterAkhirx['value'] .'</td>';
                    echo '</tr>';
                }
            }

    echo '</table>';
    echo '<hr/>';


    // ====================================
    // ====================================


    echo '<h3 class="kasih-border-kiri"><b>Defuzzifikasi:</b></h3>';
    //Defuzzifikasi
    // echo '<pre>'; echo '<h3>Hasil</h3>'; print_r(hitungA($filterAkhir)); echo '</pre>';

   
    echo '<h3>Hitung rumus menggunakan metode MOM (Mean Of Maximum) : Mengambil nilai rata-rata domain yang memiliki nilai keanggotaan maksimum</h3> ';
    
    // ================hasil======================//
    echo "<h2><strong>Z* </strong>= ";
    echo round(hitungA($filterAkhir)[1], 2). " %";
   
    
   
    

    
    //========================REKOMENDASI===================================

    if((hitungA($filterAkhir)[1] > "0") && (hitungA($filterAkhir)[1] < "57.5")){
        echo "<h2><strong>Status Produktivitas:</strong> Tidak Produktif</h2>";
        echo "<h4><strong>Rekomendasi Keputusan:</strong> Segera tangani, anda bisa merugi!</h4>";
    }elseif((hitungA($filterAkhir)[1] >= "57.5") && (hitungA($filterAkhir)[1] <= "65")){
        echo "<h2><strong>Status Produktivitas:</strong> Kurang Produktif</h2>";
        echo "<h4><strong>Rekomendasi Keputusan:</strong> Segera tangani, belum memenuhi standart</h4>";
    }elseif((hitungA($filterAkhir)[1] > "65") && (hitungA($filterAkhir)[1] <= "85")){
        echo "<h2><strong>Status Produktivitas:</strong> Produktif</h2>";
        echo "<h4><strong>Rekomendasi Keputusan:</strong> Pertahankan, jika bisa ditingkatkan lagi</h4>";
    }else{
        echo "<h2><strong>Status Produktivitas:</strong> Sangat Produktif</h2>";
        echo "<h4><strong>Rekomendasi Keputusan:</strong> Pertahankan !</h4>";
    }

        
    
  
    // hitungA($filterAkhir);


}



function bikinTable($data)
{
    
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

function fcrrendah($fcr)
{
    //fcr rendah
    $nilaifcrrendah = 0;
    //suhu minimum
    if ($fcr <= 2.1) {
        $nilaifcrrendah = 1;
    } else {
        if ($fcr < 2.2) {
            $nilaifcrrendah = (2.2 - $fcr) / 0.1;
        } else {
            $nilaifcrrendah = 0;
        }
    }
    return $nilaifcrrendah;
}

function fcrnormal($fcr)
{
    //fcr normal
    $nilaifcrnormal = 0;
    //suhu optimal
    if ($fcr >= 2.1 && $fcr <= 2.5) {
        if ($fcr >= 2.2 && $fcr <= 2.3) {
            $nilaifcrnormal = 1;
        } else {
            if ($fcr >= 2.1 && $fcr < 2.2) {
                $nilaifcrnormal = ($fcr - 2.1) / 0.1;
            } else {
                if ($fcr > 2.3 && $fcr <= 2.5) {
                    $nilaifcrnormal = (2.5 - $fcr) / 0.2;
                } else {
                    $nilaifcrnormal = 0;
                }
            }
        }
    }
    return $nilaifcrnormal;
}

function fcrtinggi($fcr)
{
    //fcr tinggi
    $nilaifcrtinggi = 0;
    //suhu maksimal
    if ($fcr >= 2.5) {
        $nilaifcrtinggi = 1;
    } else {
        if ($fcr >= 2.3 && $fcr < 2.5) {
            $nilaifcrtinggi = ($fcr - 2.3) / 0.2;
        } else {
            $nilaifcrtinggi = 0;
        }
    }
    return $nilaifcrtinggi;
}

function rendah($henday)
{
    //henday rendah
    $hendayrendah = 0;
    //tidak LEMBAB
    if ($henday <= 55) {
        $hendayrendah = 1;
    } else {
        if ($henday < 60) {
            $hendayrendah = (60 - $henday) / 5;
        } else {
            $hendayrendah = 0;
        }
    }
    return $hendayrendah;
}

function normal($henday)
{
    //henday normal
    $hendaynormal = 0;
    //sangat sesuai
    if ($henday >= 55 && $henday <= 85) {
        if ($henday >= 60 && $henday <= 75) {
            $hendaynormal = 1;
        } else {
            if ($henday >= 55 && $henday < 60) {
                $hendaynormal = ($henday - 55) / 5;
            } else {
                if ($henday > 75 && $henday <= 85) {
                    $hendaynormal = (85 - $henday) / 10;
                } else {
                    $hendaynormal = 0;
                }
            }
        }
    }
    return $hendaynormal;
}

function tinggi($henday)
{
    //henday tinggi
    $hendaytinggi = 0;
    //LEMBAB
    if ($henday >= 85) {
        $hendaytinggi = 1;
    } else {
        if ($henday >= 75 && $henday < 85) {
            $hendaytinggi = ($henday - 75) / 10;
        } else {
            $hendaytinggi = 0;
        }
    }
    return $hendaytinggi;
}
?>