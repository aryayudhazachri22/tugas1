<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php 
 include('mylib/myDb.php');
?>
<body>
    <?php 
        $Db = new MyDb();
        $data_warga = $Db->show();
        if(isset($_POST['daftar'])){
            //echo "Tombol Daftar Telah Di Klik";
            $noktp = $_POST['no_ktp'];
            $nama = $_POST['nama_lengkap'];
            $alamat = $_POST['alamat_lengkap'];
            $nohp = $_POST['no_hp'];
            $querysimpan = $Db->add_data($noktp, $nama, $alamat, $nohp);
            //print_r($_POST);
            if($querysimpan==TRUE){
                $pesansimpan = "Data Tersimpan Ke Database";
            }else{
                $pesansimpan = "Data Gagal Simpan Ke Database";
            }
        }
        if(isset($_GET['hapus'])){
            //echo "Data Dengan ID :".$_GET['hapus']."  Akan Di Hapus";
            $idwarga = $_GET['hapus'];
            $queryhapus = $Db->delete($idwarga);
            if($queryhapus==TRUE){
                $pesanhapus = "Data Berhasil Di Hapus";
            }else{
                $pesanhapus = "Data Gagal DI Hapus";
            }
        }
    ?>
    <div class="container">
        <div class="col-12">
            <div class="py-3">
            <h2>Data Warga</h2>
            <a href="form-daftar.php" class='btn btn-success'>Tambah Data Warga [+]</a>
            </div>
            <?php 
            if(isset($_POST['daftar'])){
                ?>
            <div class="alert alert-success"><?php echo $pesansimpan; ?></div>
            <?php
            }
            
            ?>
            <?php 
            if(isset($_GET['hapus'])){
                ?>
            <div class="alert alert-danger"><?php echo $pesanhapus; ?></div>
            <?php
            }

            ?>
        <table class="table table-border" border = 1>
        <tr>
            <td>No</td>
            <td>No KTP</td>
            <td>Nama Lengkap</td>
            <td>Alamat</td>
            <td>No HP</td>
            <td>Action</td>
        </tr>
        <?php 
        $i=0;
        foreach($data_warga as $data){ 
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data['no_ktp']; ?></td>
                <td><?php echo $data['nama_lengkap']; ?></td>
                <td><?php echo $data['alamat_lengkap']; ?></td>
                <td><?php echo $data['no_hp']; ?></td>
                <td><a class="badge badge-primary" href="detail-warga.php?id=<?php echo $data['id']; ?>">Detail</a>  <a class="badge badge-danger" href="index.php?hapus=<?php echo $data['id']; ?>">Hapus</a></td>
            </tr>
            <?php } ?>
    </table>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
    var form = document.querySelector('form');

    function handleForm(event) {
        event.preventDefault();
    }
    form.addEventListener('submit', handleForm);
</script>
</body>
</html>