<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	   : edit.php 
  | @author    : fauzan1892 / Fauzan Falah
  | @copyright : Copyright (c) 2017-2021 Codekop.com (https://www.codekop.com)
  | @blog      : https://www.codekop.com/products/source-code-aplikasi-rental-mobil-php-mysql-7.html 
  | 
  | 
  | 
  | 
 */
    require '../../koneksi/koneksi.php';
    $title_web = 'Edit Mobil';
    include '../header.php';
    if(empty($_SESSION['USER']))
    {
        session_start();
    }
    $id = $_GET['id'];

    $sql = "SELECT * FROM mobil WHERE id_mobil =  ?";
    $row = $koneksi->prepare($sql);
    $row->execute(array($id));

    $hasil = $row->fetch();
?>


<br>
<div class="container">
    <div class="card">
        <div class="card-header text-white bg-primary">
            <h4 class="card-title">
                Edit Mobil - <?= $hasil['merk'];?>
                <div class="float-right">
                    <a class="btn btn-warning" href="mobil.php" role="button">Kembali</a>
                </div>
            </h4>
        </div>
        <div class="card-body">
            <div class="container">
                <form method="post" action="proses.php?aksi=edit&id=<?= $id;?>" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-sm-6">

                            <div class="form-group row">
                                <label class="col-sm-3">No Plat</label>
                                <input type="text" class="form-control col-sm-9" value="<?= $hasil['no_plat'];?>" name="no_plat" placeholder="Isi No Plat">
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Merk Mobil</label>
                                <input type="text" class="form-control col-sm-9"  value="<?= $hasil['merk'];?>" name="merk" placeholder="Isi Merk">
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Harga</label>
                                <input type="text" class="form-control col-sm-9"  value="<?= $hasil['harga'];?>" name="harga" placeholder="Isi Harga">
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group row">
                                <label class="col-sm-3">Deskripsi</label>
                                <input type="text" class="form-control col-sm-9"  value="<?= $hasil['deskripsi'];?>" name="deskripsi" placeholder="Isi Deskripsi">
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Status</label>
                                <select class="form-control col-sm-9" name="status">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option <?php if($hasil['status'] == 'Tersedia'){ echo 'selected';}?>>Tersedia</option>
                                    <option  <?php if($hasil['status'] == 'Tidak Tersedia'){ echo 'selected';}?>>Tidak Tersedia</option>
                                </select>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Gambar</label>
                                <input type="file" accept="image/*" class="form-control col-sm-9" name="gambar" placeholder="Isi Gambar">
                               
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Penampakan</label>
                                <img src="../../assets/image/<?php echo $hasil['gambar'];?>" class="img-fluid" style="width:200px;">                               
                            </div>
                            <input type="hidden" value="<?= $hasil['gambar'];?>" name="gambar_cek">
                        </div>
                    </div>
                    <hr>
                    <div class="float-right">
                        <button class="btn btn-primary" role="button" type="submit">
                            Simpan
                        </button>
                    </div>
                </form>       
            </div>
        </div>
    </div>
</div>
<?php  include '../footer.php';?>