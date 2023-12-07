<?php require_once('includes/init.php'); 
$user_role = get_role();
if($user_role == 'admin' || $user_role == 'user') {
?>

<?php
$errors = array();
$sukses = false;

$ada_error = false;
$result = '';

$id_user = $_SESSION["user_id"];

if(isset($_POST['submit'])):
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	
	if(!$nama) {
		$errors[] = 'Nama tidak boleh kosong';
	}		
	
	if(!$email) {
		$errors[] = 'Email tidak boleh kosong';
	}
	
	if(!$id_user) {
		$errors[] = 'Id User salah';
	}
	
	if($password && ($password != $password2)) {
		$errors[] = 'Password harus sama keduanya';
	}
	
	
	if(empty($errors)):
		$update = mysqli_query($koneksi,"UPDATE user SET nama = '$nama', email = '$email' WHERE id_user = '$id_user'");
		
		if($password) {
			$pass = sha1($password);
			$update = mysqli_query($koneksi,"UPDATE user SET nama = '$nama',  password = '$pass', email = '$email' WHERE id_user = '$id_user'");
		}		
		if($update) {
			$errors[] = 'Data berhasil diupdate';
		}else{
			$errors[] = 'Data gagal diupdate';
		}
	endif;

endif;
?>

<?php
$page = "Profile";
require_once('template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between">
    <div class="pagetitle m-0">
		<h1>Data Profile</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active">Data Profile</li>
			</ol>
		</nav>
	</div>
</div>

<?php if(!empty($errors)): ?>
	<div class="alert alert-info">
			<?php foreach($errors as $error): ?>
				<?php echo $error; ?>
			<?php endforeach; ?>
	</div>
<?php endif; ?>

<div class="row">
	<div class="form-group col-xl-4">
		<div class="card">
			<div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
				<img src="assets/img/profile-img.png" alt="Profile" class="rounded-circle" />
				<h2><?php echo $_SESSION['username']; ?></h2>
			</div>
		</div>

	</div>
	
	<div class="form-group col-xl-8">
		<form action="" method="post">
			<div class="card">
				<div class="card-body">
				<?php
				if(!$id_user) {
				?>
					<div class="alert alert-danger">Data tidak ada</div>
				<?php
				}else{
				$data = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='$id_user'");
				$cek = mysqli_num_rows($data);
				if($cek <= 0) {
				?>
					<div class="alert alert-danger">Data tidak ada</div>
				<?php
				}else{
					while($d = mysqli_fetch_array($data)){
				?>
				<h5 class="card-title">Edit Data Profile</h5>
					<div class="row">
						<div class="form-group col-md-6">
							<label class="font-weight-bold">Username</label>
							<input autocomplete="off" type="text" readonly required value="<?php echo $d['username']; ?>" class="form-control"/>
						</div>
						
						<div class="form-group col-md-6">
							<label class="font-weight-bold">Password</sub></label>
							<input autocomplete="off" type="password" name="password" class="form-control"/>
						</div>
						
						<div class="form-group col-md-6">
							<label class="font-weight-bold">Ulangi Password</label>
							<input autocomplete="off" type="password" name="password2" class="form-control"/>
						</div>
						
						<div class="form-group col-md-6">
							<label class="font-weight-bold">Nama</label>
							<input autocomplete="off" type="text" name="nama" required value="<?php echo $d['nama']; ?>" class="form-control"/>
						</div>
						
						<div class="form-group col-md-6">
							<label class="font-weight-bold">E-Mail</label>
							<input autocomplete="off" type="email" name="email" required value="<?php echo $d['email']; ?>" class="form-control"/>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					<button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
					<button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
				</div>
			</div>
			<?php
				}
				}
				}
			?>
		</form>
		</div>
	</div>
</div>

<?php
require_once('template/footer.php');
}else {
	header('Location: login.php');
}
?>