<?php include '../src/header.php'; ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        <h1>Dashboard <small>Data Variabel</small></h1>
            <div class="panel-body">
                <table class="table table-striped table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>ID Kriteria</th>
                            <th>Nama Variabel</th>
                            <th>Keterangan</th>
                        </tr>
                        <?php
                        include "../src/koneksi.php";

                        $query = mysqli_query($koneksi, "SELECT * FROM kriteria");       
                        while($data = mysqli_fetch_array($query)){
                        ?>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center"><?php echo $data['id_kriteria']; ?></td>
                            <td align="center"><?php echo $data['nama_kriteria']; ?></td>
                            <td align="center"><?php echo $data['ket']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../src/footer.php'; ?>