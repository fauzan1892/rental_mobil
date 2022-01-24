<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	   : index.php 
  | @author    : fauzan1892 / Fauzan Falah
  | @copyright : Copyright (c) 2017-2021 Codekop.com (https://www.codekop.com)
  | @blog      : https://www.codekop.com/products/source-code-aplikasi-rental-mobil-php-mysql-7.html 
  | 
  | 
  | 
  | 
 */
    require '../koneksi/koneksi.php';
    $title_web = 'Dashboard';
    include 'header.php';
    if(empty($_SESSION['USER']))
    {
        session_start();
    }
    if(!empty($_POST['nama_rental']))
    {
        $data[] =  htmlspecialchars($_POST["nama_rental"]);
        $data[] =  htmlspecialchars($_POST["telp"]);
        $data[] =  htmlspecialchars($_POST["alamat"]);
        $data[] =  htmlspecialchars($_POST["email"]);
        $data[] =  htmlspecialchars($_POST["no_rek"]);
        $data[] =  1;
        $sql = "UPDATE infoweb SET nama_rental = ?, telp = ?, alamat = ?, email = ?, no_rek = ?  WHERE id = ? ";
        $row = $koneksi->prepare($sql);
        $row->execute($data);
        echo '<script>alert("Update Data Info Website Berhasil !");window.location="index.php"</script>';
        exit;
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
        echo '<script>alert("Update Data Profil Berhasil !");window.location="index.php"</script>';
        exit;
    }
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    Info Website
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php
                            $sql = "SELECT * FROM infoweb WHERE id = 1";
                            $row = $koneksi->prepare($sql);
                            $row->execute();
                            $edit = $row->fetch(PDO::FETCH_OBJ);
                        ?>
                        <div class="form-group">
                            <label for="">Nama rental</label>
                            <input type="text" class="form-control" value="<?= $edit->nama_rental;?>" name="nama_rental" id="nama_rental" placeholder=""/>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" value="<?= $edit->email;?>" name="email" id="email" placeholder=""/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Telp</label>
                                    <input type="text" class="form-control" value="<?= $edit->telp;?>" name="telp" id="telp" placeholder=""/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" placeholder=""><?= $edit->alamat;?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">No rek</label>
                            <textarea class="form-control" name="no_rek" id="no_rek" placeholder=""><?= $edit->no_rek;?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    Profil Admin
                </div>
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
<?php include 'footer.php';?>