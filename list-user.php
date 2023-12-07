<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$page = "User";
require_once('template/header.php');
?>


<div class="d-sm-flex align-items-center justify-content-between">
    <div class="pagetitle m-0">
		<h1>Data User</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active">Data User</li>
			</ol>
		</nav>
	</div>

	<a href="tambah-user.php" class="btn btn-success">Tambah Data </a>
</div>

<?php
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
?>

<div class="card">
    <div class="card-body">
		<h5 class="card-title"></h5>
		<div class="table-responsive">
			<table class="table" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr align="center">
						<th width="5%">No</th>
						<th>Username</th>
						<th>Nama</th>
						<th>Role</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
			
				<?php
				$no=0;
				$query = mysqli_query($koneksi,"SELECT * FROM user");
				while($data = mysqli_fetch_array($query)):
				$no++;
				?>
					<tr align="center">
						<td><?php echo $no; ?></td>
						<td><?php echo $data['username']; ?></td>
						<td><?php echo $data['nama']; ?></td>
						<td>
						<?php
						if($data['role'] == 1) {
							echo 'Administrator';
						} elseif($data['role'] == 2) {
							echo 'User';
						}
						?>
						</td>
						<td>
							<div class="btn-group" role="group">
								<a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="edit-user.php?id=<?php echo $data['id_user']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil text-white"></i></a>
								<a  data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="hapus-user.php?id=<?php echo $data['id_user']; ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="bi bi-trash2 text-white"></i></a>
							</div>
						</td>
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
require_once('template/footer.php');
?>