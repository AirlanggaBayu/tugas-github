<?php include '../src/header.php'; ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        <h1>Dashboard <small>Perhitungan Fuzzy</small></h1>
            <div class="panel-body">
              <form method="POST" action="">
                <div class="form-group">
                  <label for="fcr">FCR</label>
                  <input type="text" name="fcr" class="form-control" placeholder="Input Nilai 2 - 3 (jika ada koma gunakan '.' contoh '2.25')" value="<?php if (isset($_POST["submit"])) echo $_POST["fcr"] ?>"  required>
                </div>
                <div class="form-group">
                  <label for="henday">HENDAY</label>
                  <input type="text" name="henday" class="form-control" placeholder="Input Nilai 1 - 100 (jika ada koma gunakan '.' contoh '50.45') " value="<?php if (isset($_POST["submit"])) echo $_POST["henday"] ?>"  required>
                </div>
                <hr>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary" name="submit" id="proses" value="Hitung">Hitung</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
<?php
include "_fuzzy.php";


if (isset($_POST["submit"])) {
  ?>
      <div class="card card-body" style="padding: 0px 40px 7em">
      <?php
      //grafik fcr
      grafikfungsikeanggotaanfcr();
      nilaigrafikfcr($_POST["fcr"]);
      //grafik henday
      grafikfungsikeanggotaanhenday();
      nilaigrafikhenday($_POST["henday"]);
      
      //output
      grafikoutput();
      gambarrules();
      hasilfuzzifikasi($_POST["fcr"], $_POST["henday"]);
      inferensi($_POST["fcr"], $_POST["henday"]);
      
      echo "</div>";
  }
?>

  