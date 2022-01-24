<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	   : profil.php 
  | @author    : fauzan1892 / Fauzan Falah
  | @copyright : Copyright (c) 2017-2021 Codekop.com (https://www.codekop.com)
  | @blog      : https://www.codekop.com/products/source-code-aplikasi-rental-mobil-php-mysql-7.html 
  | 
  | 
  | 
  | 
 */
    session_start();
    require 'koneksi/koneksi.php';
    include 'header.php';
    if(empty($_SESSION['USER']))
    {
        echo '<script>alert("Harap Login");window.location="index.php"</script>';
    }

    if(!empty($_POST['nama_pengguna']))
    {
        $data[] =  htmlspecialchars($_POST["nama_pengguna"]);
        $data[] =  htmlspecialchars($_POST["username"]);
        $data[] =  md5($_POST["password"]);
        $data[] =  $_SESSION['USER']['id_login'];
        $sql = "UPDATE login SET nama_pengguna = ?, username = ?, password = ? WHERE id_login = ? ";
        $row = $koneksi->prepare($sql);
        $row->execute($data);
        echo '<script>alert("Update Data Profil Berhasil !");window.location="profil.php"</script>';
        exit;
    }
?>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                            <?php
                                $id =  $_SESSION["USER"]["id_login"];
                                $sql = "SELECT * FROM login WHERE id_login = ?";
                                $row = $koneksi->prepare($sql);
                                $row->execute(array($id));
                                $edit_profil = $row->fetch(PDO::FETCH_OBJ);
                            ?>
                            <div class="form-group">
                                <label for="">Nama Pengguna</label>
                                <input type="text" class="form-control" value="<?= $edit_profil->nama_pengguna;?>" name="nama_pengguna" id="nama_pengguna" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" required class="form-control" value="<?= $edit_profil->username;?>" name="username" id="username" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" required class="form-control" value="" name="password" id="password" placeholder=""/>
                            </div>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</div>
<br>
<br>
<br>

<?php include 'footer.php';?>