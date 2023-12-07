<?php
require_once('includes/init.php');
cek_login($role = array(1));
$page = "Kriteria";
require_once('template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between">
    <div class="pagetitle m-0">
		<h1>Data Kriteria</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active">Data Kriteria</li>
			</ol>
		</nav>
	</div>

	<div>
		<a href="tambah-bobot.php" class="btn btn-primary"> Bobot Preferensi AHP </a>
		<a href="tambah-kriteria.php" class="btn btn-success"> Tambah Data </a>
	</div>
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
						<th>No</th>
						<th>Kode Kriteria</th>
						<th>Nama Kriteria</th>
						<th>Type</th>
						<th>Bobot</th>
						<th>Cara Penilaian</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$query = mysqli_query($koneksi,"SELECT * FROM kriteria ORDER BY kode_kriteria ASC");			
				while($data = mysqli_fetch_array($query)):
				?>
					<tr align="center">
						<td><?php echo $no; ?></td>
						<td><?php echo $data['kode_kriteria']; ?></td>
						<td align="left"><?php echo $data['nama']; ?></td>
						<td><?php echo $data['type']; ?></td>
						<td>
							<?php
							if (empty($data['bobot'])) {
								echo "-";
							}else{
								echo $data['bobot'];
							}
							?>
						</td>	
						<td><?php echo ($data['ada_pilihan']) ? 'Pilihan Sub Kriteria': 'Input Langsung'; ?></td>							
						<td>
							<div class="btn-group" role="group">
								<a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="edit-kriteria.php?id=<?php echo $data['id_kriteria']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil text-white"></i></a>
								<a  data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="hapus-kriteria.php?id=<?php echo $data['id_kriteria']; ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="bi bi-trash2 text-white"></i></a>
							</div>
						</td>
					</tr>
					<?php 
					$no++;
					endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
require_once('template/footer.php');
?>