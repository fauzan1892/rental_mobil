<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	     : booking.php 
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
        echo '<script>alert("Harap login !");window.location="index.php"</script>';
    }
    $id = $_GET['id'];
    $isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
?>
<br>
<br>
<div class="container">
<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <img src="assets/image/<?php echo $isi['gambar'];?>" class="card-img-top" style="height:200px;">
            <div class="card-body" style="background:#ddd">
            <h5 class="card-title"><?php echo $isi['merk'];?></h5>
            </div>
            <ul class="list-group list-group-flush">

            <?php if($isi['status'] == 'Tersedia'){?>
                <li class="list-group-item bg-primary text-white">
                    <i class="fa fa-check"></i> Available
                </li>
            <?php }else{?>
                <li class="list-group-item bg-danger text-white">
                    <i class="fa fa-close"></i> Not Available
                </li>
            <?php }?>
            <li class="list-group-item bg-info text-white"><i class="fa fa-check"></i> Free E-toll 50k</li>
            <li class="list-group-item bg-dark text-white">
                <i class="fa fa-money"></i> Rp. <?php echo number_format($isi['harga']);?>/ day
            </li>
            </ul>
        </div>
    </div>
    <div class="col-sm-8">
         <div class="card">
           <div class="card-body">
               <form method="post" action="koneksi/proses.php?id=booking">
                    <div class="form-group">
                      <label for="">KTP</label>
                      <input type="text" name="ktp" id="" required class="form-control" placeholder="KTP / NIK Anda">
                    </div> 
                    <div class="form-group">
                      <label for="">Nama</label>
                      <input type="text" name="nama" id="" required class="form-control" placeholder="Nama Anda">
                    </div> 
                    <div class="form-group">
                      <label for="">Alamat</label>
                      <input type="text" name="alamat" id="" required class="form-control" placeholder="Alamat">
                    </div> 
                    <div class="form-group">
                      <label for="">Telepon</label>
                      <input type="text" name="no_tlp" id="" required class="form-control" placeholder="Telepon">
                    </div> 
                    <div class="form-group">
                      <label for="">Tanggal Sewa</label>
                      <input type="date" name="tanggal" id="" required class="form-control" placeholder="Nama Anda">
                    </div> 
                    <div class="form-group">
                      <label for="">Lama Sewa</label>
                      <input type="number" name="lama_sewa" id="" required class="form-control" placeholder="Lama Sewa">
                    </div> 
                    <input type="hidden" value="<?php echo $_SESSION['USER']['id_login'];?>" name="id_login">
                    <input type="hidden" value="<?php echo $isi['id_mobil'];?>" name="id_mobil">
                    <input type="hidden" value="<?php echo $isi['harga'];?>" name="total_harga">
                    <hr/>
                    <?php if($isi['status'] == 'Tersedia'){?>
                        <button type="submit" class="btn btn-primary float-right">Booking Now</button>
                    <?php }else{?>
                        <button type="submit" class="btn btn-danger float-right" disabled>Booking Now</button>
                    <?php }?>
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