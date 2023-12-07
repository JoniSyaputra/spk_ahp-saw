<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;

$ada_error = false;
$result = '';

$id_alternatif = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if(isset($_POST['submit'])):	
	
	$nama = $_POST['nama'];
	
	// Validasi
	if(!$nama) {
		$errors[] = 'Nama tidak boleh kosong';
	}
	
	// Jika lolos validasi lakukan hal di bawah ini
	if(empty($errors)):
		
		$update = mysqli_query($koneksi,"UPDATE alternatif SET nama = '$nama' WHERE id_alternatif = '$id_alternatif'");
		if($update) {
			redirect_to('list-alternatif.php?status=sukses-edit');
		}else{
			$errors[] = 'Data gagal diupdate';
		}
	endif;

endif;
?>

<?php
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

<?php if($sukses): ?>
	<div class="alert alert-success">
		Data berhasil disimpan
	</div>	
<?php elseif($ada_error): ?>
	<div class="alert alert-info">
		<?php echo $ada_error; ?>
	</div>
<?php else: ?>		
			
<form action="edit-alternatif.php?id=<?php echo $id_alternatif; ?>" method="post">
	<div class="card">
		<div class="card-body">
		<h5 class="card-title">Edit Data Alternatif</h5>
		<?php
		if(!$id_alternatif) {
		?>
			<div class="alert alert-danger">Data tidak ada</div>
		<?php
		}else{
		$data = mysqli_query($koneksi,"SELECT * FROM alternatif WHERE id_alternatif='$id_alternatif'");
		$cek = mysqli_num_rows($data);
		if($cek <= 0) {
		?>
			<div class="alert alert-danger">Data tidak ada</div>
		<?php
		}else{
			while($d = mysqli_fetch_array($data)){
		?>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Nama</label>
					<input autocomplete="off" type="text" name="nama" required value="<?php echo $d['nama']; ?>" class="form-control"/>
				</div>
			</div>
		</div>
	
		<div class="card-footer text-right">
            <button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
        </div>
		<?php
		}
		}
		}
		?>
	</div>
</form>

<?php
endif;
require_once('template/footer.php');
?>