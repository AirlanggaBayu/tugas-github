<?php 
include '../src/header.php'; 

include '../src/koneksi.php';
if(isset($_POST['simpan'])){
    $id    = $_POST['id_aturan'];
    $fcr = $_POST['fcr'];
    $henday = $_POST['henday'];
    $status = $_POST['status_produktivitas'];
    $keterangan = $_POST['keterangan'];
    $query = mysqli_query($koneksi, "INSERT INTO data_aturan VALUES ('$id','$fcr','$henday','$status','$keterangan')") or die(mysqli_error($koneksi));
    if($query):
        echo "<script language='javascript'>swal('Selamat...', 'Data Berhasil di input!', 'success');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_aturan.php">';
    else:
        echo "<script language='javascript'>swal('Oops...', 'Something went wrong!', 'error');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_aturan.php">';
    endif;             
}elseif(isset($_POST['update'])){
    $id    = $_POST['id_aturan'];
    $fcr = $_POST['fcr'];
    $henday = $_POST['henday'];
    $status = $_POST['status_produktivitas'];
    $keterangan = $_POST['$keterangan'];
    $query = mysqli_query($koneksi, "UPDATE data_aturan SET fcr='$fcr',henday='$henday',status_produktivitas='$status' , keterangan='$keterangan' WHERE id_aturan='$id'") or die(mysqli_error($koneksi));
    if($query):
        echo "<script language='javascript'>swal('Selamat...', 'Data Berhasil di input!', 'success');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_aturan.php">';
    else:
        echo "<script language='javascript'>swal('Oops...', 'Something went wrong!', 'error');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_aturan.php">';
    endif;
}elseif(isset($_POST['hapus'])){
    $id    = $_POST['id_aturan'];
    $query = mysqli_query($koneksi, "DELETE FROM data_aturan WHERE id_aturan='$id'") or die(mysqli_error($koneksi));
    if($query):
        echo "<script language='javascript'>swal('Selamat...', 'Data Berhasil di input!', 'success');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_aturan.php">';
    else:
        echo "<script language='javascript'>swal('Oops...', 'Something went wrong!', 'error');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_aturan.php">';
    endif;
}
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        <h1>Dashboard <small>Data Aturan (Rule)</small></h1>
            <div class="panel-heading">                    
            <!-- Modal Tambah -->
            <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Tambah Baru</button> -->
            <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 align="center">Tambah Data Aturan</h3>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" role="form">
                                    <div class="form-group">
                                        <?php
                                        include "../src/koneksi.php";
                                        $ambil = mysqli_query($koneksi, "SELECT max(id_aturan) AS hasil FROM data_aturan");
                                        $aksi  = mysqli_fetch_array($ambil);
                                        $ID    = $aksi['hasil'] + 1;
                                        ?>
                                        <label for="id_aturan">ID Aturan </label>
                                        <input type="text" name="id_aturan" class="form-control" value="<?php echo $ID ?>" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label for="fcr">FCR</label>
                                        <select id="fcr" name="fcr" class="form-control">
                                            <option value="Rendah">Rendah</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Tinggi">Tinggi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="henday">Henday</label>
                                        <select id="henday" name="henday" class="form-control">
                                            <option value="Rendah">Rendah</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Tinggi">Tinggi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status_produktivitas">Status Produktivitas</label>
                                        <select id="status_produktivitas" name="status_produktivitas" class="form-control">
                                            <option value="Tidak Produktif">Tidak Produktif</option>
                                            <option value="Kurang Produktif">Kurang Produktif</option>
                                            <option value="Produktif">Produktif</option>
                                            <option value="Sangat Produktif">Sangat Produktif</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <select id="keterangan" name="keterangan" class="form-control">
                                            <option value="Segera Tangani">Segera Tangani</option>
                                            <option value="Tingkatkan">Tingkatkan</option>
                                            <option value="Pertahankan">Pertahankan</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" name="simpan" class="btn btn-danger">Reset</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" name="simpan" class="btn btn-primary">Tambah Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <a href="aksi/lap_aturan.php" target="_blank"><button class="btn btn-info"><span class="glyphicon glyphicon-print"></span> Cetak</button></a>                     -->
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>FCR</th>
                                <th>HENDAY</th>
                                <th>STATUS PRODUKTIVITAS</th>
                                <!-- <th>KETERANGAN</th>
                                <th>Tools</th> -->
                            </tr>
                            <?php
                            include "../src/koneksi.php";

                            $page = (isset($_GET['page']))? $_GET['page'] : 1;
                            $limit = 10;
                            $limit_start = ($page - 1) * $limit;

                            $query = mysqli_query($koneksi, "SELECT * FROM data_aturan LIMIT ".$limit_start.",".$limit);
                            $no = $limit_start + 1;
                            
                            while($data = mysqli_fetch_array($query)){
                            ?>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"><?php echo $data['id_aturan']; ?></td>
                                <td align="center"><?php echo $data['fcr']; ?></td>
                                <td align="center"><?php echo $data['henday']; ?></td>
                                <td align="center"><?php echo $data['status_produktivitas']; ?></td>
                                <!-- <td align="center"><?php echo $data['keterangan']; ?></td> -->

                                <!-- aksi modal edit -->
                                <td class="align-middle text-center">
                                <!-- <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#my<?php echo $data['id_aturan'];?>"><span aria-hidden="true"></span>Edit</button> -->
                                <div class="modal fade" id="my<?php echo $data['id_aturan'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h3 align="center">Edit Data Aturan</h3>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST" role="form">
                                            <div class="phAnimate">
                                                <label for="id_aturan">Id Aturan</label>
                                                <input type="text" name="id_aturan" class="form-control" align="center" value="<?php echo $data['id_aturan']; ?>" readonly="">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="fcr">FCR</label>
                                                <select id="fcr" name="fcr" class="form-control">
                                                    <option value="<?php echo $data['fcr']; ?>"><?php echo $data['fcr']; ?></option>
                                                    <option value="Rendah">Rendah</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Tinggi">Tinggi</option>
                                                </select>
                                            </div>
                                            <div class="phAnimate">
                                                <label for="henday">Henday</label>
                                                <select id="henday" name="henday" class="form-control">
                                                    <option value="<?php echo $data['henday']; ?>"><?php echo $data['henday']; ?></option>
                                                    <option value="Rendah">Rendah</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Tinggi">Tinggi</option>
                                                </select>
                                            </div>
                                            <div class="phAnimate">
                                                <label for="status_produktivitas">Status Produktivitas</label>
                                                <select id="status_produktivitas" name="status_produktivitas" class="form-control">
                                                    <option value="<?php echo $data['status_produktivitas']; ?>"><?php echo $data['status_produktivitas']; ?></option>
                                                    <option value="Tidak Produktif">Tidak Produktif</option>
                                                    <option value="Kurang Produktif">Kurang Produktif</option>
                                                    <option value="Produktif">Produktif</option>
                                                    <option value="Sangat Produktif">Sangat Produktif</option>
                                                </select>
                                            </div>
                                            <div class="phAnimate">
                                                <label for="KETERANGAN">KETERANGAN</label>
                                                <select id="KETERANGAN" name="keterangan" class="form-control">
                                                    <option value="<?php echo $data['keterangan']; ?>"><?php echo $data['keterangan']; ?></option>
                                                    <option value="Segera Tangani">Segera Tangani</option>
                                                    <option value="Pertahankan">Pertahankan</option>
                                                    <option value="Tingkatkan">Tingkatkan</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-danger" data-dismiss="modal">Reset</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" name="update" class="btn btn-primary">Edit Data</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                                </div>
                                <!--tutup modal edit -->

                                <!-- Modal Hapus -->
                                <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myy<?php echo $data['id_aturan']; ?>"><span aria-hidden="true"></span>Hapus</button> -->
                                <div class="modal fade" id="myy<?php echo $data['id_aturan'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h3 align="center">Hapus Data Aturan</h3>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST" role="form">
                                            <div class="phAnimate">
                                                <label for="id_aturan">Id Aturan</label>
                                                <input type="text" name="id_aturan" class="form-control" align="center" value="<?php echo $data['id_aturan']; ?>" readonly="">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="jenis_kulit">FCR</label>
                                                <input type="text" name="fcr" class="form-control" align="center" value="<?php echo $data['fcr']; ?>">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="warna_kulit">HENDAY</label>
                                                <input type="text" name="henday" class="form-control" align="center" value="<?php echo $data['henday']; ?>">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="tinta_tato">STATUS PRODUKTIVITAS</label>
                                                <input type="text" name="status_produktivitas" class="form-control" align="center" value="<?php echo $data['status_produktivitas']; ?>">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="tinta_tato">KETERANGAN</label>
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
                        <li><a href="data_aturan.php?page=1">First</a></li>
                        <li><a href="data_aturan.php?page=<?php echo $link_prev; ?>">&laquo;</a></li>
                      <?php
                      }
                      ?>
                      <?php
                      include "../src/koneksi.php";
                      $sql2 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM data_aturan");
                      $get_jumlah = mysqli_fetch_array($sql2);
                      
                      $jumlah_page = ceil($get_jumlah['jumlah'] / $limit);
                      $jumlah_number = 3;
                      $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
                      $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
                      
                      for($i = $start_number; $i <= $end_number; $i++){
                        $link_active = ($page == $i)? ' class="active"' : '';
                      ?>
                        <li<?php echo $link_active; ?>><a href="data_aturan.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
                        <li><a href="data_aturan.php?page=<?php echo $link_next; ?>">&raquo;</a></li>
                        <li><a href="data_aturan.php?page=<?php echo $jumlah_page; ?>">Last</a></li>
                      <?php
                      }
                      ?>
                    </ul>
                </div>
        </div>
    </div>
</div>

<?php include '../src/footer.php'; ?>