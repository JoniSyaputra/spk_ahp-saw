<?php
require_once('includes/init.php');
cek_login($role = array(1));
$page = "Sub Kriteria";
require_once('template/header.php');

if(isset($_POST['tambah'])):	
	$id_kriteria = $_POST['id_kriteria'];
	$nama = $_POST['nama'];
	$nilai = $_POST['nilai'];

	if(!$id_kriteria) {
		$errors[] = 'ID kriteria tidak boleh kosong';
	}
	// Validasi Nama Kriteria
	if(!$nama) {
		$errors[] = 'Nama kriteria tidak boleh kosong';
	}		
	// Validasi Tipe
	if(!$nilai) {
		$errors[] = 'Nilai kriteria tidak boleh kosong';
	}	
	
	if(empty($errors)):
		$simpan = mysqli_query($koneksi,"INSERT INTO sub_kriteria (id_sub_kriteria, id_kriteria, nama, nilai) VALUES ('', '$id_kriteria', '$nama', '$nilai')");
		
		if($simpan) {
			$sts[] = 'Data berhasil disimpan';
		}else{
			$sts[] = 'Data gagal disimpan';
		}
	endif;
endif;

if(isset($_POST['edit'])):	
	$id_sub_kriteria = $_POST['id_sub_kriteria'];
	$id_kriteria = $_POST['id_kriteria'];
	$nama = $_POST['nama'];
	$nilai = $_POST['nilai'];

	if(!$id_kriteria) {
		$errors[] = 'ID kriteria tidak boleh kosong';
	}
	// Validasi Nama Kriteria
	if(!$nama) {
		$errors[] = 'Nama kriteria tidak boleh kosong';
	}		
	// Validasi Tipe
	if(!$nilai) {
		$errors[] = 'Nilai kriteria tidak boleh kosong';
	}	
	
	if(empty($errors)):
		$update = mysqli_query($koneksi,"UPDATE sub_kriteria SET nama = '$nama', nilai = '$nilai' WHERE id_kriteria = '$id_kriteria' AND id_sub_kriteria = '$id_sub_kriteria'");
		
		if($update) {
			$sts[] = 'Data berhasil diupdate';
		}else{
			$sts[] = 'Data gagal diupdate';
		}
	endif;
endif;
?>
<div class="d-sm-flex align-items-center justify-content-between">
    <div class="pagetitle m-0">
		<h1>Data Sub kriteria</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active">Data Sub kriteria</li>
			</ol>
		</nav>
	</div>
</div>

<?php if(!empty($sts)): ?>
	<div class="alert alert-info">
		<?php foreach($sts as $st): ?>
			<?php echo $st; ?>
		<?php endforeach; ?>
	</div>
<?php
endif;

$status = isset($_GET['status']) ? $_GET['status'] : '';
$msg = '';
switch($status):
	case 'sukses-baru':
		$msg = 'Data berhasil disimpan';
		break;
	case 'sukses-hapus':
		$msg = 'Data behasil dihapus';
		break;
	case 'sukses-edit':
		$msg = 'Data behasil diupdate';
		break;
endswitch;

if($msg):
	echo '<div class="alert alert-info">'.$msg.'</div>';
endif;

$query = mysqli_query($koneksi,"SELECT * FROM kriteria WHERE ada_pilihan='1' ORDER BY kode_kriteria ASC");
$cek = mysqli_num_rows($query);
if($cek <= 0) {
?>
<div class="card">
    <div class="card-body">
		<div class="alert alert-info">
			Cara penilaian pada kriteria berjenis input langsung semua.
		</div>
	</div>
</div>
<?php
}else{
	while($data = mysqli_fetch_array($query)){
?>
<div class="card">
	<div class="card-body">
		<div class="d-sm-flex align-items-center justify-content-between">
			<h5 class="card-title"><?= $data['nama']." (".$data['kode_kriteria'].")" ?></h5>
			
			<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah<?= $data['id_kriteria']; ?>">
			Tambah Data
			</button>
		</div>
	
		<div class="modal fade" id="tambah<?= $data['id_kriteria']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Tambah <?= $data['nama'] ?></h5>
					</div>
					<form action="" method="post">
						<div class="modal-body">
							<input type="text" name="id_kriteria" value="<?= $data['id_kriteria']; ?>" hidden>
							<div class="form-group">
								<label class="font-weight-bold">Nama Sub Kriteria</label>
								<input autocomplete="off" type="text"class="form-control" name="nama" required>
							</div>
							<div class="form-group">
								<label class="font-weight-bold">Nilai</label>
								<input autocomplete="off" step="0.001" type="number" name="nilai" class="form-control" required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
							<button type="submit" name="tambah" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table" width="100%" cellspacing="0">
				<thead>
					<tr align="center">				
						<th width="5%">No</th>
						<th>Nama Sub Kriteria</th>
						<th>Nilai</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no=1;
						$id_kriteria = $data['id_kriteria'];
						$q = mysqli_query($koneksi,"SELECT * FROM sub_kriteria WHERE id_kriteria = '$id_kriteria' ORDER BY nilai DESC");			
						while($d = mysqli_fetch_array($q)){
					?>
					<tr align="center">
						<td><?=$no ?></td>
						<td align="left"><?= $d['nama'] ?></td>
						<td><?= $d['nilai'] ?></td>
						<td>
							<div class="btn-group" role="group">
								<a data-bs-toggle="modal" data-bs-target="#editsk<?= $d['id_sub_kriteria'] ?>" title="Edit Data" href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil text-white"></i></a>
								<a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="hapus-sub-kriteria.php?id=<?php echo $d['id_sub_kriteria']; ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="bi bi-trash2 text-white"></i></a>
							</div>
						</td>
					</tr>

					<!-- Modal -->
					<div class="modal fade" id="editsk<?= $d['id_sub_kriteria'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="myModalLabel">Edit <?= $d['nama'] ?></h5>
								</div>
								<form action="list-sub-kriteria.php?id=<?php echo $d['id_sub_kriteria']; ?>" method="post">
									<input type="text" name="id_sub_kriteria" value="<?= $d['id_sub_kriteria']; ?>" hidden>
									<div class="modal-body">
										<input type="text" name="id_kriteria" value="<?= $d['id_kriteria'] ?>" hidden>
										<div class="form-group">
											<label class="font-weight-bold">Nama Sub Kriteria</label>
											<input type="text" autocomplete="off" class="form-control" value="<?= $d['nama'] ?>" name="nama" required>
										</div>
										<div class="form-group">
											<label class="font-weight-bold">Nilai</label>
											<input type="number" step="0.001" autocomplete="off" name="nilai" class="form-control" value="<?= $d['nilai'] ?>" required>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
										<button type="submit" name="edit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
                <?php
					$no++;
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
}
}
require_once('template/footer.php');
?>