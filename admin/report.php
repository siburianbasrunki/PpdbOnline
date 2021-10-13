<?php
include('../dbconnect.php');
$u = $_GET['u'];
$cekdulu = mysqli_query($conn,"select * from userdata where nisn='$u'");
    $ambil = mysqli_fetch_array($cekdulu);
    //get alamat
    $ambilprov = $ambil['provinsi'];
    $prov1 = mysqli_query($conn,"select name from provinces where id='$ambilprov'");
    $prov = mysqli_fetch_array($prov1)['name'];
    $ambilkota = $ambil['kabupaten'];
    $kab1 = mysqli_query($conn,"select name from regencies where id='$ambilkota'");
    $kab = mysqli_fetch_array($kab1)['name'];
    $ambilkec = $ambil['kecamatan'];
    $kec1 = mysqli_query($conn,"select name from districts where id='$ambilkec'");
    $kec = mysqli_fetch_array($kec1)['name'];
    $ambilkel = $ambil['kelurahan'];
    $kel1 = mysqli_query($conn,"select name from villages where id='$ambilkel'");
    $kel = mysqli_fetch_array($kel1)['name'];

require_once("../dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$query = mysqli_query($conn,"select * from userdata where nisn='$u'");
$html = '
<center><h3>Daftar Pendaftaran SMK Richards Lab (Berbasis Online)</h3></center><hr/><br/>';
$html .= '<div class="row mt-5 mb-5">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center">
                <h2>Data Pribadi</h2>
                <img src="../user/'. $ambil['foto'].'" width="20%">
            </div>
            <div class="market-status-table mt-4">
                <div class="table-responsive" style="overflow-x:hidden;">
                    
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>NISN</label>
                            <input name="nisn" type="text" class="form-control" value="'.$u.'">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>NIK</label>
                            <input name="nik" type="text" class="form-control" value="'.$ambil['nik'].'">
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input name="namalengkap" type="text" class="form-control" value="'. $ambil['namalengkap'].'">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" class="form-control" value="'. $ambil['jeniskelamin'].'">
                        </select>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input name="tempatlahir" type="text" class="form-control" maxlength="20" value="'. $ambil['tempatlahir'].'">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input name="tgllahir" type="date" class="form-control" value="'. $ambil['tanggallahir'].'">
                        </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <input name="alamat" type="text" class="form-control" placeholder="Alamat" value="'. $ambil['alamat'].'">
                        </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label>Provinsi:</label>
                        <input type="text" class="form-control" value="'. $prov.'">
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label>Kota/Kabupaten:</label>
                        <input type="text" class="form-control" value="'. $kab.'">
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label>Kecamatan:</label>
                        <input type="text" class="form-control" value="'. $kec.'">
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label>Kelurahan:</label>
                        <input type="text" class="form-control" value="'. $kel.'">
                    </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Agama</label>
                            <input type="text" class="form-control" value="'.  $ambil['agama'].'">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input name="telepon" type="text" class="form-control" maxlength="15" value="'.  $ambil['telepon'].'">
                        </div>
                        </div>
                    </div>
                        
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>




                 

                
                </div>
            </div>
        </div>
    </div>
</div>
</div>';

$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream($u.'.pdf');
?>