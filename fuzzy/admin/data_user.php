<?php 
include '../src/header.php'; 

include '../src/koneksi.php';
if(isset($_POST['simpan'])){
    $id    = $_POST['id_user'];
    $nama  = $_POST['nama'];
    $user  = $_POST['username'];
    $pass  = md5($_POST['password']);
    $query = mysqli_query($koneksi, "INSERT INTO user VALUES ('$id','$nama','$user','$pass')") or die(mysqli_error($koneksi));
    if($query):
        echo "<script language='javascript'>swal('Selamat...', 'Data Berhasil di input!', 'success');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_user.php">';
    else:
        echo "<script language='javascript'>swal('Oops...', 'Something went wrong!', 'error');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_user.php">';
    endif;             
}elseif(isset($_POST['update'])){
    $id    = $_POST['id_user'];
    $nama  = $_POST['nama'];
    $user  = $_POST['username'];
    $pass  = md5($_POST['password']);
    $query = mysqli_query($koneksi, "UPDATE user SET nama='$nama',username='$user',password='$pass' WHERE id_user='$id'") or die(mysqli_error($koneksi));
    if($query):
        echo "<script language='javascript'>swal('Selamat...', 'Data Berhasil di input!', 'success');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_user.php">';
    else:
        echo "<script language='javascript'>swal('Oops...', 'Something went wrong!', 'error');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_user.php">';
    endif;
}elseif(isset($_POST['hapus'])){
    $id    = $_POST['id_user'];
    $query = mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id'") or die(mysqli_error($koneksi));
    if($query):
        echo "<script language='javascript'>swal('Selamat...', 'Data Berhasil di input!', 'success');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_user.php">';
    else:
        echo "<script language='javascript'>swal('Oops...', 'Something went wrong!', 'error');</script>" ;
        echo '<meta http-equiv="Refresh" content="0; URL=data_user.php">';
    endif;
}
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        <h1>Dashboard <small>Data user</small></h1>
            <div class="panel-heading">                   
            <!-- Modal Tambah -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Tambah Baru</button>
            <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 align="center">Tambah Data User</h4>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" role="form">
                                    <div class="form-group">
                                        <?php
                                        include "../src/koneksi.php";
                                        $ambil = mysqli_query($koneksi, "SELECT max(id_user) AS hasil FROM user");
                                        $aksi  = mysqli_fetch_array($ambil);
                                        $ID    = $aksi['hasil'] + 1;
                                        ?>
                                        <label for="id_user">Id user </label>
                                        <input type="text" name="id_user" class="form-control" value="<?php echo $ID ?>" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" placeholder="input Nama Lengkap" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="input username" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="text" name="password" class="form-control" placeholder="input password" required="">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" name="simpan" class="btn btn-primary">Reset</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" name="simpan" class="btn btn-primary">Tambah Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tutup Modal Tambah -->
                <form action="" method="get">
                  <div class="input-group col-md-5 col-md-offset-7">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Cari Nama" onchange="this.form.submit()">
                  </div>
                </form>
                <br/>
                <?php 
                if(isset($_GET['nama'])){
                  $nama=mysqli_real_escape_string($koneksi, $_GET['nama']);
                }
                ?>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama </th>
                                <th>Username</th>
                             
                                <th>Tools</th>
                            </tr>
                            <?php
                            include "../src/koneksi.php";

                            $page = (isset($_GET['page']))? $_GET['page'] : 1;
                            $limit = 10;
                            $limit_start = ($page - 1) * $limit;
                            
                            if(isset($_GET['nama'])){
                                $nama  = mysqli_real_escape_string($koneksi, $_GET['nama']);
                                $query = mysqli_query($koneksi, "SELECT * FROM user WHERE nama LIKE '$nama'");
                            }else{
                                $query = mysqli_query($koneksi, "SELECT * FROM user LIMIT ".$limit_start.",".$limit);
                                $no = $limit_start + 1;
                            } 
                            
                            while($data = mysqli_fetch_array($query)){
                            ?>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"><?php echo $data['id_user']; ?></td>
                                <td align="center"><?php echo $data['nama']; ?></td>
                                <td align="center"><?php echo $data['username']; ?></td>
                                

                                <!-- aksi modal edit -->
                                <td class="align-middle text-center">
                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#my<?php echo $data['id_user'];?>"><span aria-hidden="true"></span>Edit</button>
                                <div class="modal fade" id="my<?php echo $data['id_user'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 align="center">Edit Data User</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST" role="form">
                                            <div class="phAnimate">
                                                <label for="id_user">Id user</label>
                                                <input type="text" name="id_user" class="form-control" placeholder="Input Id" align="center" value="<?php echo $data['id_user']; ?>" readonly="">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="nama">Nama User</label>
                                                <input type="text" name="nama" class="form-control" placeholder="Input Nama User" align="center" value="<?php echo $data['nama']; ?>">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" class="form-control" placeholder="Input Username" align="center" value="<?php echo $data['username']; ?>">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="password">Password</label>
                                                <input type="text" name="password" class="form-control" placeholder="Input Password" align="center" value="<?php echo $data['password']; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-default" data-dismiss="modal">Reset</button>
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
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myy<?php echo $data['id_user']; ?>"><span aria-hidden="true"></span>Hapus</button>
                                <div class="modal fade" id="myy<?php echo $data['id_user'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 align="center">Hapus Data User</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST" role="form">
                                            <div class="phAnimate">
                                                <label for="id_user">Id user</label>
                                                <input type="text" name="id_user" class="form-control" placeholder="input id" align="center" value="<?php echo $data['id_user']; ?>">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" class="form-control" placeholder="input username" align="center" value="<?php echo $data['username']; ?>">
                                            </div>
                                            <div class="phAnimate">
                                                <label for="password">Password</label>
                                                <input type="text" name="password" class="form-control" placeholder="input password" align="center" value="<?php echo $data['password']; ?>">
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
                        <li><a href="data_user.php?page=1">First</a></li>
                        <li><a href="data_user.php?page=<?php echo $link_prev; ?>">&laquo;</a></li>
                      <?php
                      }
                      ?>
                      <?php
                      include "../src/koneksi.php";
                      $sql2 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM user");
                      $get_jumlah = mysqli_fetch_array($sql2);
                      
                      $jumlah_page = ceil($get_jumlah['jumlah'] / $limit);
                      $jumlah_number = 3;
                      $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
                      $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
                      
                      for($i = $start_number; $i <= $end_number; $i++){
                        $link_active = ($page == $i)? ' class="active"' : '';
                      ?>
                        <li<?php echo $link_active; ?>><a href="data_user.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
                        <li><a href="data_user.php?page=<?php echo $link_next; ?>">&raquo;</a></li>
                        <li><a href="data_user.php?page=<?php echo $jumlah_page; ?>">Last</a></li>
                      <?php
                      }
                      ?>
                    </ul>
                </div>
        </div>
    </div>
</div>

<?php include '../src/footer.php'; ?>