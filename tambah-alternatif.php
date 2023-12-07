<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;

$nama = (isset($_POST['nama'])) ? trim($_POST['nama']) : '';

if(isset($_POST['submit'])):	
	
	// Validasi
	if(!$nama) {
		$errors[] = 'Nama tidak boleh kosong';
	}
	
	// Jika lolos validasi lakukan hal di bawah ini
	if(empty($errors)):
		$simpan = mysqli_query($koneksi,"INSERT INTO alternatif (id_alternatif, nama) VALUES ('', '$nama')");
		if($simpan) {
			redirect_to('list-alternatif.php?status=sukses-baru');
		}else{
			$errors[] = 'Data gagal disimpan';
		}
	endif;

endif;

$page = "Alternatif";
require_once('template/header.php');
?>


<div class="d-sm-flex align-items-center justify-content-between">
    <div class="pagetitle m-0">
		<h1>Data Alternatif</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active">Data Alternatif</li>
			</ol>
		</nav>
	</div>

	<a href="list-alternatif.php" class="btn btn-secondary btn-icon-split">
		<span class="text">Kembali</span>
	</a>
</div>

			
<?php if(!empty($errors)): ?>
	<div class="alert alert-info">
		<?php foreach($errors as $error): ?>
			<?php echo $error; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>			
			
<form action="tambah-alternatif.php" method="post">
	<div class="card">
		<div class="card-body">
		<h5 class="card-title">Tambah Data Kriteria</h5>
			<div class="row">				
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Nama</label>
					<input autocomplete="off" type="text" name="nama" required value="<?php echo $nama; ?>" class="form-control"/>
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
        </div>
	</div>
</form>

<?php
require_once('template/footer.php');
?>