<?php include '../src/header.php'; ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        <h1>Dashboard <small>Hasil Perhitungan</small></h1>
                <div class="panel-body">
                    <table class="table table-striped table-bordered" id="example">
                      <hr>
                        <h4 align="center">INPUT NILAI JENIS KULIT DAN WARNA KULIT</h4>
                      <hr>
                      <form method="POST" action="aksi/proses_fuzzy.php">
                        <div class="form-group">
                          <label for="fcr">FCR</label>
                          <input type="text" name="fcr" class="form-control" placeholder="Input Nilai 2.1 - 2.5" required>
                        </div>
                        <div class="form-group">
                          <label for="henday">HENDAY</label>
                          <input type="text" name="henday" class="form-control" placeholder="Input Nilai 0 - 100" required>
                        </div>
                        <hr>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary" name="proses" id="proses" value="Hitung">Hitung</button>
                        </div>
                      </form>
                    </table>
                   

                   
                    <!-- HASIL PERHITUNGAN PENILAIAN PRODUKTIVITAS -->
                    <table class="table table-striped table-bordered" id="example">
                        <thead>
                            <td colspan="7"><h4 align="center">HASIL PERHITUNGAN FUZZY MAMDANI</h4></td>
                            <tr>
                                <th>ID</th>
                                <th>FCR</th>
                                <th>HENDAY</th>
                                <th>Nilai Fuzzy</th>
                                <th>PRODUKTIVITAS</th>
                                <th>KETERANGAN</th>
                            </tr>
                            <?php
                            include "../src/koneksi.php";

                            $query = mysqli_query($koneksi, "SELECT * FROM hasil_fuzzy ORDER BY id_hasil DESC LIMIT 1");                 
                            while($data = mysqli_fetch_array($query)){
                            ?>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"><?php echo $data['id_hasil']; ?></td>
                                <td align="center"><?php echo $data['fcr']; ?></td>
                                <td align="center"><?php echo $data['henday']; ?></td>
                                <td align="center"><?php echo $data['nilai_fuzzy']; ?></td>
                                <td align="center"><?php echo $data['status_produktivitas']; ?></td>
                                <td align="center"><?php echo $data['keterangan']; ?></td>
                            </tr>
                            <!-- <textarea name="" id="" cols="100" rows="12">IMPLIKASI RULE
                              
                                1. MIN RULE 1 : IF FCR RENDAH AND HENDAY RENDAH THEN Poduktif : <?= $data['rule1'];?> 
                                1. MIN RULE 2 : IF FCR RENDAH AND HENDAY NORMAL THEN Produktif : <?= $data['rule2'];?>
                                1. MIN RULE 3 : IF FCR RENDAH AND HENDAY TINGGI THEN Sangat Produktif : <?= $data['rule3'];?>
                                1. MIN RULE 4 : IF FCR NORMAL AND HENDAY RENDAH THEN Kurang Produktif : <?= $data['rule4'];?> 
                  
                  
                  MIN RULE 5 : IF FCR NORMAL AND HENDAY NORMAL THEN Produktif : <?= $data['rule5'];?>
                  MIN RULE 6 : IF FCR NORMAL AND HENDAY TINGGI THEN Sangat Produktif : <?= $data['rule6'];?>
                  MIN RULE 7 : IF FCR TINGGI AND HENDAY RENDAH THEN Tidak Produktif : <?= $data['rule7'];?>
                  MIN RULE 8 : IF FCR TINGGI AND HENDAY NORMAL THEN Kurang Produktif : <?= $data['rule8'];?>
                  MIN RULE 9 : IF FCR TINGGI AND HENDAY TINGGI THEN Produktif : <?= $data['rule9'];?>
                  
                  DEFUZZYFIKASI :

                  MIN : <?= $data['min'];?>
                  MAX : <?= $data['max'];?>
                  A1: <?= $data['a1'];?>
                  A2: <?= $data['a2'];?>
                              
                 
                </textarea> -->
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
               
        </div>
    </div>
</div>

<?php include '../src/footer.php'; ?> 