<?php
    session_start();
    require 'koneksi/koneksi.php';
    include 'header.php';
?>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    Kontak Kami
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">Nama Rental</div>
                        <div class="col-sm-8"><?= $info_web->nama_rental;?></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-4">Telp</div>
                        <div class="col-sm-8"><?= $info_web->telp;?></div>
                    </div>
                
                    <div class="row mt-3">
                        <div class="col-sm-4">Alamat</div>
                        <div class="col-sm-8"><?= $info_web->alamat;?></div>
                    </div>
                
                    <div class="row mt-3">
                        <div class="col-sm-4">Email</div>
                        <div class="col-sm-8"><?= $info_web->email;?></div>
                    </div>
                
                    <div class="row mt-3">
                        <div class="col-sm-4">No Rekening</div>
                        <div class="col-sm-8"><?= $info_web->no_rek;?></div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<br>
<br>
<br>
<?php include 'footer.php';?>