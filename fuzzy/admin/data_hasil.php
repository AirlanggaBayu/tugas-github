<?php include '../src/header.php'; 

include 'aksi/koneksi.php';
if(isset($_POST['hapus'])){
    $id    = $_POST['id_hasil'];
    $query = mysqli_query($koneksi, "DELETE FROM hasil_fuzzy WHERE id_hasil='$id'") or die(mysqli_error($koneksi));
    if($query):
        echo "<script language='javascript'>swal('Selamat...', 'Data Berhasil di input!', 'success');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_hasil.php">';
    else:
        echo "<script language='javascript'>swal('Oops...', 'Something went wrong!', 'error');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_hasil.php">';
    endif;
}
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        <h1>Dashboard <small>Data Hasil Perhitungan</small></h1>
            <div class="panel-heading">
                <a href="hitung_fuzzy.php"><button class="btn btn-pencil"><span class="glyphicon glyphicon-pencil"></span> Create</button></a> 
                <a href="aksi/lap_hasil.php" target="_blank"><button class="btn btn-info"><span class="glyphicon glyphicon-print"></span> Cetak</button></a>
            </div>
                <div class="panel-body">
                    <!-- HASIL PERHITUNGAN PENILAIAN KARYAWAN -->
                    <table class="table table-striped table-bordered" id="example">
                        <thead>
                            <td colspan="7"><h4 align="center">HASIL PERHITUNGAN FUZZY MAMDANI</h4></td>
                            <tr>
                                <th>ID</th>
                                <th>FCR</th>
                                <th>HENDAY</th>
                                <th>Nilai Fuzzy</th>
                                <th>STATUS PRODUKTIVITAS</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            include "../src/koneksi.php";

                            $page = (isset($_GET['page']))? $_GET['page'] : 1;
                            $limit = 10;
                            $limit_start = ($page - 1) * $limit;

                            $query = mysqli_query($koneksi, "SELECT * FROM hasil_fuzzy LIMIT ".$limit_start.",".$limit);
                            $no = $limit_start + 1;
                            
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

                                <td class="align-middle text-center">
                                  <!-- Modal Hapus -->
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myy<?php echo $data['id_hasil']; ?>"><span aria-hidden="true"></span>Hapus</button>
                                <div class="modal fade" id="myy<?php echo $data['id_hasil'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h3 align="center">Hapus Data Hasil Fuzzy</h3>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST" role="form">
                                            <div class="phAnimate">
                                                <label for="id_hasil">Id hasil</label>
                                                <input type="text" name="id_hasil" class="form-control" align="center" value="<?php echo $data['id_hasil']; ?>" readonly="">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="fcr">FCRt</label>
                                                <input type="text" name="fcr" class="form-control" align="center" value="<?php echo $data['fcr']; ?>">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="henday">HENDAY</label>
                                                <input type="text" name="henday" class="form-control" align="center" value="<?php echo $data['henday']; ?>">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="nilai_fuzzy">Nilai Fuzzy</label>
                                                <input type="text" name="nilai_fuzzy" class="form-control" align="center" value="<?php echo $data['nilai_fuzzy']; ?>">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="status_produktivitas">PRODUKTIVITAS</label>
                                                <input type="text" name="status_produktivitas" class="form-control" align="center" value="<?php echo $data['status_produktivitas']; ?>">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="status_produktivitas">KETERANGAN</label>
                                                <input type="text" name="keterangan" class="form-control" align="center" value="<?php echo $data['status_produktivitas']; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class=" btn btn-primary btn-danger" name="hapus">Hapus Data</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                                </div>
                                <!-- Tutup Modal Hapus -->
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <hr>
                     <ul class="pagination">
                      <?php
                      if($page == 1){
                      ?>
                        <li class="disabled"><a href="#">First</a></li>
                        <li class="disabled"><a href="#">&laquo;</a></li>
                      <?php
                      }else{
                        $link_prev = ($page > 1)? $page - 1 : 1;
                      ?>
                        <li><a href="data_hasil.php?page=1">First</a></li>
                        <li><a href="data_hasil.php?page=<?php echo $link_prev; ?>">&laquo;</a></li>
                      <?php
                      }
                      ?>
                      <?php
                      include "../src/koneksi.php";
                      $sql2 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM hasil_fuzzy");
                      $get_jumlah = mysqli_fetch_array($sql2);
                      
                      $jumlah_page = ceil($get_jumlah['jumlah'] / $limit);
                      $jumlah_number = 3;
                      $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
                      $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
                      
                      for($i = $start_number; $i <= $end_number; $i++){
                        $link_active = ($page == $i)? ' class="active"' : '';
                      ?>
                        <li<?php echo $link_active; ?>><a href="data_hasil.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                      <?php
                      }
                      ?>
                      <?php
                      if($page == $jumlah_page){
                      ?>
                        <li class="disabled"><a href="#">&raquo;</a></li>
                        <li class="disabled"><a href="#">Last</a></li>
                      <?php
                      }else{
                        $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                      ?>
                        <li><a href="data_hasil.php?page=<?php echo $link_next; ?>">&raquo;</a></li>
                        <li><a href="data_hasil.php?page=<?php echo $jumlah_page; ?>">Last</a></li>
                      <?php
                      }
                      ?>
                    </ul>
                </div>
        </div>
    </div>
</div>

<?php include '../src/footer.php'; ?>