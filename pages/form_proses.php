<!-- Koneksi Database -->
<?php
	include 'koneksi.php';
?>

<!-- Suplier -->
<!-- Tambah Suplier -->
<div class="modal fade" role="document" id="tambah_suplier">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="supplier_proses_tambah.php" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4>Tambah Data Suplier</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label">ID Suplier</label>
						<input type="text" name="supplier_idsuplier" placeholder="ID" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Nama Suplier</label>
						<input type="text" name="supplier_namasuplier" class="form-control" placeholder="Supplier Name">
					</div>
					<div class="form-group">
						<label class="control-label">Telepon</label>
						<input type="text" name="supplier_notelp" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label class="control-label">Alamat Suplier</label>
						<input type="text" name="supplier_alamatsuplier" class="form-control" placeholder="Supplier Name">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
	$query28 = mysqli_query($koneksi, "SELECT * FROM supplier");
	while ($data28 = mysqli_fetch_array($query28)) {
?>
<!-- Edit Supplier -->
<div class="modal fade" role="document" id="edit_suplier<?php echo $data28['SupplierID']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="supplier_proses_edit.php" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4>Edit Data Suplier</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label">ID Suplier</label>
						<input type="text" disabled="disabled" value="<?php echo $data28['SupplierID']; ?>" class="form-control">
						<input type="hidden" name="supplier_idsuplier" value="<?php echo $data28['SupplierID']; ?>">
					</div>
					<div class="form-group">
						<label class="control-label">Nama Suplier</label>
						<input type="text" name="supplier_namasuplier" class="form-control" value="<?php echo $data28['Nama']; ?>">
					</div>
					<div class="form-group">
						<label class="control-label">Telepon</label>
						<input type="text" name="supplier_notelp" class="form-control" value="<?php echo $data28['NoTelp']; ?>">
					</div>
					<div class="form-group">
						<label class="control-label">Alamat Suplier</label>
						<input type="text" name="supplier_alamatsuplier" class="form-control" value="<?php echo $data28['Alamat']; ?>">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>

<!-- Hapus Supplier -->
<?php
	$query29 = mysqli_query($koneksi, "SELECT * FROM supplier");
	while ($data29 = mysqli_fetch_array($query29)) {
?>
<div class="modal fade" role="document" id="hapus_suplier<?php echo $data29['SupplierID']; ?>">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form action="supplier_proses_hapus.php" method="post">
				<input type="hidden" name="supplier_idsuplier" value="<?php echo $data29['SupplierID']; ?>">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4>Hapus Data Suplier</h4>
				</div>
				<div class="modal-body">
					<p>Apakah Anda Yakin Menghapus Data Ini ?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
					<button type="submit" class="btn">Ya</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>


<!-- buah -->
<!-- Tambah buah -->
<div class="modal fade" role="document" id="tambah_buah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Tambah Buah</h4>
			</div>
			<?php 
				$query20 = mysqli_query($koneksi, "SELECT MAX(Kd_Buah) AS kd_prdk FROM buah");
				$data20 = mysqli_fetch_array($query20);
				$data200 = $data20['kd_prdk'];
				$get_kd = (int) substr($data200, 1, 4);

				$get_kd++;
				$hurufkd = "B";
				$cetakkd = $hurufkd.sprintf("%04s", $get_kd);
			?>
			<form action="buah_tambah_proses.php" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label">Kode Buah :</label>
						<input type="text" disabled class="form-control" value="<?php echo $cetakkd; ?>">
						<input type="hidden" name="prdk_Kd_Buah" value="<?php echo $cetakkd; ?>">
					</div>
					<div class="form-group">
						<label class="control-label">Nama Buah :</label>
						<input type="text" name="prdk_namabuah" class="form-control">
					</div>
					<?php
						$ambildatasuplier = mysqli_query($koneksi, "SELECT * FROM supplier");
					?>
					<div class="form-group">
						<label class="control-label">Nama Supplier :</label>
						<select name="prdk_namasuplier" class="form-control">
							<option> Pilih Supplier </option>
							<?php while ($proses_ambil_data_supplier = mysqli_fetch_array($ambildatasuplier)) { ?>
							<option value="<?php echo $proses_ambil_data_supplier['SupplierID']; ?>"> <?php echo $proses_ambil_data_supplier['Nama']; ?></option>
						<?php } ?>
						</select>
					</div>
					<?php
						$ambildatakategori = mysqli_query($koneksi, "SELECT * FROM kategori_buah");
					?>
					<div class="form-group">
						<label class="control-label">Nama Kategori :</label>
						<select name="prdk_namakategori" class="form-control">
							<option> Pilih Kategori buah </option>
							<?php while ($proses_ambil_data_kategori = mysqli_fetch_array($ambildatakategori)) { ?>
								<option value="<?php echo $proses_ambil_data_kategori['KategoriID']; ?>"><?php echo $proses_ambil_data_kategori['Nama_Kategori']; ?></option>
							<?php } ?>
						</select>
					</div>


					<div class="form-group">
						<label class="control-label">Satuan :</label>
						<input type="text" name="prdk_satuan" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Stok :</label>
						<input type="text" name="prdk_stok" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Harga Modal (Rp) :</label>
						<input type="text" name="prdk_hargamodal" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Harga Jual (Rp) :</label>
						<input type="text" name="prdk_hargajual" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<div>
						<button type="submit" class="btn btn-primary">Tambah</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Edit buah -->
<?php 
	$query21 = mysqli_query($koneksi, "SELECT P.*, K.Nama_Kategori AS Nama_Kat, K.KategoriID as id_katna FROM buah P, kategori_buah K WHERE P.KategoriID = K.KategoriID");
	while ($data21 = mysqli_fetch_array($query21)) {
?>
<div class="modal fade" role="document" id="edit_buah<?php echo $data21['Kd_Buah']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Edit Data buah</h4>
			</div>
			<form action="buah_edit_proses.php" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label">buah ID :</label>
						<input type="text" disabled class="form-control" value="<?php echo $data21['Kd_Buah']; ?>">
						<input type="hidden" name="prdk_Kd_Buah" value="<?php echo $data21['Kd_Buah']; ?>">
					</div>
					<div class="form-group">
						<label class="control-label">Nama buah :</label>
						<input type="text" value="<?php echo $data21['Nama']; ?>" name="prdk_namabuah" class="form-control">
					</div>
					<?php
						$ambildatasuplier1 = mysqli_query($koneksi, "SELECT * FROM supplier");
						$ambildatakategori1 = mysqli_query($koneksi, "SELECT * FROM kategori_buah");
						$id_supp = $data21['SupplierID'];
					?>
					<div class="form-group">
						<label class="control-label">Nama Supplier :</label>
						<select name="prdk_namasuplier" class="form-control">

							<?php while ($proses_ambil_data_supplier1 = mysqli_fetch_array($ambildatasuplier1)) {
								$namasupplier_value = $proses_ambil_data_supplier1['SupplierID'];
							?> 
							<option value="<?php echo $namasupplier_value; ?>" <?php if ($id_supp == $namasupplier_value){echo 'selected';} ?> > <?php echo $proses_ambil_data_supplier1['Nama']; ?></option>
						<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Nama Kategori :</label>
						<select name="prdk_namakategori" class="form-control">
							<?php while ($proses_ambil_data_kategori1 = mysqli_fetch_array($ambildatakategori1)) {
								$namakategori_value = $proses_ambil_data_kategori1['KategoriID'];
							?>
								<option value="<?php echo $namakategori_value; ?>" <?php if ($data21['id_katna'] == $namakategori_value) {echo 'selected';} ?>><?php echo $proses_ambil_data_kategori1['Nama_Kategori']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Satuan :</label>
						<input type="text" value="<?php echo $data21['Satuan']; ?>" name="prdk_satuan" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Stok :</label>
						<input type="text" value="<?php echo $data21['Stok']; ?>" name="prdk_stok" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Harga Modal (Rp) :</label>
						<input type="text" value="<?php echo $data21['Harga_Modal']; ?>" name="prdk_hargamodal" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Harga Jual (Rp) :</label>
						<input type="text" value="<?php echo $data21['Harga_Jual']; ?>" name="prdk_hargajual" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<div>
						<button type="submit" class="btn btn-primary">SIMPAN</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div> 
<?php } ?>

<!-- Hapus buah -->
<?php 
	$query22 = mysqli_query($koneksi, "SELECT P.*, K.Nama_Kategori AS Nama_Kat FROM buah P, kategori_buah K WHERE P.KategoriID = K.KategoriID");
	while ($data22 = mysqli_fetch_array($query22)) {
?>
<div class="modal fade" role="document" id="hapus_buah<?php echo $data22['Kd_Buah']; ?>">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form action="buah_hapus_proses.php" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4>Hapus</h4>
				</div>
				<div class="modal-body">
					<p>Apakah Anda Yakin Menghapus Data Ini ?</p>
					<input type="hidden" name="prdk_Kd_Buah" value="<?php echo $data22['Kd_Buah']; ?>">
				</div>
				<div class="modal-footer">
					<div>
						<button type="button" data-dismiss="modal" class="btn btn-primary">Tidak</button>
						<button type="submit" class="btn">Ya</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>

<!--/buah  -->

<!-- buah Kategori -->
<!-- Tambah Kategori -->
<div class="modal fade" role="document" id="tambah_kat_buah">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Tambah Kategori buah</h4>
			</div>
			<form action="kategori_tambah_proses_buah.php" method="post">
				<div class="modal-body">
					<?php 
						$query25 = mysqli_query($koneksi, "SELECT MAX(KategoriID) AS kd_ktgr FROM kategori_buah");
						$data25 = mysqli_fetch_array($query25);
						$data201 = $data25['kd_ktgr'];
						$get_ktgr = (int) substr($data201, 1, 4);

						$get_ktgr++;
						$hurufktgr = "K";
						$cetakktgr = $hurufktgr.sprintf("%04s", $get_ktgr);
					?>
					<div class="form-group">
						<label class="control-label">Kode Kategori</label>
						<input type="text" disabled="disabled" value="<?php echo $cetakktgr; ?>" class="form-control">
						<input type="hidden" name="ktgr_kategoriid" value="<?php echo $cetakktgr; ?>">
					</div>
					<div class="form-group">
						<label class="control-label">Nama Kategori :</label>
						<input type="text" name="ktgr_namakategori" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<div>
						<button type="submit" class="btn btn-primary">Tambah</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Edit Kategori -->
<?php
	$query26 = mysqli_query($koneksi, "SELECT * FROM kategori_buah");
	while ($data26 = mysqli_fetch_array($query26)) {
?>
<div class="modal fade" role="document" id="edit_kat_buah<?php echo $data26['KategoriID']; ?>">
		<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Edit Kategori buah</h4>
			</div>
			<form action="kategori_edit_proses_buah.php" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label">Kode Kategori</label>
						<input type="text" disabled="disabled" value="<?php echo $data26['KategoriID']; ?>" class="form-control">
						<input type="hidden" name="ktgr_kategoriid" value="<?php echo $data26['KategoriID']; ?>">
					</div>
					<div class="form-group">
						<label class="control-label">Nama Kategori :</label>
						<input type="text" name="ktgr_namakategori" value="<?php echo $data26['Nama_Kategori']; ?>" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<div>
						<button type="submit" class="btn btn-primary">SIMPAN</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>

<!-- Hapus Kategori -->
<?php
	$query27 = mysqli_query($koneksi, "SELECT * FROM kategori_buah");
	while ($data27 = mysqli_fetch_array($query27)) {
?>
<div class="modal fade" role="document" id="hapus_kat_buah<?php echo $data27['KategoriID']; ?>">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form action="kategori_hapus_proses_buah.php" method="post">
				<input type="hidden" name="ktgr_kategoriid" value="<?php echo $data27['KategoriID']; ?>">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4>Hapus</h4>
				</div>
				<div class="modal-body">
					<p>Apakah Anda Yakin Menghapus Data Ini ?</p>
				</div>
				<div class="modal-footer">
					<div>
						<button type="button" data-dismiss="modal" class="btn btn-primary">Tidak</button>
						<button type="submit" class="btn">Ya</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>



<!-- Pengguna-->
<!-- Tambah Pengguna -->
<div class="modal fade" role="document" id="tambah_pengguna">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="pengguna_tambah_proses.php" method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4>Tambah Data Admin</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label">Nama :</label>
						<input type="text" name="user_nama" placeholder="" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Jenis Kelamin :</label><br>
						<input type="radio" name="user_jeniskelamin" value="Laki - Laki"> Laki - Laki
						<input type="radio" name="user_jeniskelamin" style="margin-left: 20px;" value="Perempuan"> Perempuan
					</div>
					<div class="form-group">
						<label class="control-label">Alamat :</label>
						<input type="text" name="user_alamat" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Tempat Lahir :</label>
						<input type="text" name="user_tempatlahir" placeholder="" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Tanggal Lahir :</label>
						<input type="date" name="user_tanggallahir" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Username :</label>
						<input type="text" name="user_username" placeholder="" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Password :</label>
						<input type="password" name="user_password" placeholder="" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Foto :</label><br>
						<input type="file" name="user_foto">
					</div>
				</div>
				<div class="modal-footer">
					<div>
						<button type="submit" class="btn btn-primary">Tambah</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Edit Pengguna -->
<?php 
	$query23 = mysqli_query($koneksi, "SELECT * FROM user");
	while ($data23 = mysqli_fetch_array($query23)) {
?>
<div class="modal fade" role="document" id="edit_pengguna<?php echo $data23['ID']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="pengguna_edit_proses.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="user_id" value="<?php echo $data23['ID']; ?>">
				<input type="hidden" name="user_fotolama" value="<?php echo $data23['Foto']; ?>">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4>Edit Data Admin</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label">Nama :</label>
						<input type="text" name="user_nama" value="<?php echo $data23['Nama']; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Jenis Kelamin :</label><br>
						<input type="radio" name="user_jeniskelamin" value="Laki - Laki" <?php if ($data23['Jenis_Kelamin'] == "Laki - Laki"){echo "checked";} ?>> Laki - Laki
						<input type="radio" name="user_jeniskelamin" style="margin-left: 20px;" value="Perempuan" <?php if ($data23['Jenis_Kelamin'] == "Perempuan"){echo "checked";} ?>> Perempuan
					</div>
					<div class="form-group">
						<label class="control-label">Alamat :</label>
						<input type="text" name="user_alamat" value="<?php echo $data23['Alamat']; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Tempat Lahir :</label>
						<input type="text" name="user_tempatlahir" value="<?php echo $data23['Tempat']; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Tanggal Lahir :</label>
						<input type="text" name="user_tanggallahir" value="<?php echo $data23['Tanggal']; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Username :</label>
						<input type="text" name="user_username" value="<?php echo $data23['Username']; ?>" placeholder="" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Foto :</label><br>
						<img src="images/<?php echo $data23['Foto']; ?>" height="80px">
						<input type="file" name="user_foto">
					</div>
				</div>
				<div class="modal-footer">
					<div>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>

<!-- Hapus Pengguna -->
<?php 
	$query24 = mysqli_query($koneksi, "SELECT * FROM user");
	while ($data24 = mysqli_fetch_array($query24)) {
?>
<div class="modal fade" role="document" id="hapus_pengguna<?php echo $data24['ID']; ?>">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Hapus</h4>
			</div>
			<form action="pengguna_hapus_proses.php" method="post">
				<input type="hidden" name="user_id" value="<?php echo $data24['ID']; ?>">
				<input type="hidden" name="user_fotolama" value="<?php echo $data24['Foto']; ?>">
				<div class="modal-body">
					<p>Apakah Anda Yakin Menghapus Data Ini ?</p>
				</div>
				<div class="modal-footer">
					<div>
						<button type="button" data-dismiss="modal" class="btn btn-primary">Tidak</button>
						<button type="submit" class="btn">Ya</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>


<!-- Data penjualan -->
<?php
	$sql4 = "SELECT * FROM pembelian";
	$query4 = mysqli_query($koneksi, $sql4);
	while($data4 = mysqli_fetch_array($query4)){
		$no_invoicedetail = $data4['No_Invoice'];
?>
<div class="modal fade" role="document" id="detail_data_penjualan<?php echo $data4['No_Invoice']; ?>">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Invoice Penjualan Buah</h4>
			</div>
			<div class="modal-body">
				    <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> Fruit Mart
                <small class="pull-right">Date: <?php echo $data4['Tanggal_Invoice'] ?></small>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              <address>
                <strong>Fruit Mart</strong><br>
                Komplek Rezeki Graha Mas<br>
                Blok A No. 14-16,<br>
                Jl. Example <br>
                Phone: 0812 3456 7890
              </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col"></div>
            <?php
            	$Customers = $data4['pelanggan'];
            	$Tanggalpembuataninvoice = $data4['Tanggal_Invoice'];
            	$TanggalJatuhTempo = date('Y-m-d', strtotime('+15 days', strtotime($Tanggalpembuataninvoice)));
            	if ($Customers == "") {
            	 	$Customers = "Anonying";
            	 } 
            ?>
            <div class="col-sm-4 invoice-col">
              <b>No. Invoice : </b><?php echo $data4['No_Invoice']; ?><br/>
              <b>Nama Pelanggan : </b><?php echo $Customers ?><br>
              <b>Tanggal Pembelian : </b><?php echo $data4['Tanggal_Invoice']; ?><br>
              <b>Jatuh Tempo:</b> <?php echo $TanggalJatuhTempo; ?><br/>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                  	<th>No</th>
                    <th>Nama Buah</th>
                    <th>Harga Jual</th>
                    <th>Qty</th>
                    <th>Diskon</th>
                    <th>Jumlah Bayar</th>
                  </tr>
                </thead>
                <tbody>
                	<?php
                		$sql6 = "SELECT * FROM join_buah WHERE NoInvoice = '$no_invoicedetail'";
                		$query6 = mysqli_query($koneksi, $sql6);
                		$no = 1;
                		while ($data6 = mysqli_fetch_array($query6)) {
                	?>
                	<tr>
                		<td><?php echo $no++; ?></td>
                		<td><?php echo $data6['NamaBuah']; ?></td>
                		<td><?php echo "Rp. ".number_format($data6['HargaJual'], 2); ?></td>
                		<td><?php echo $data6['Qty']; ?></td>
                		<td><?php echo $data6['Diskon']." %"; ?></td>
                		<td><?php echo "Rp. ".number_format($data6['TotalPerProduk'], 2); ?></td>

                	</tr>
                <?php } ?>
                </tbody>
              </table>
            </div><!-- /.col -->
          </div><!-- /.row -->
         <div class="row">
          	<div class="col-xs-6">
          		
          	</div>
            <!-- accepted payments column -->
            <div class="col-xs-6">
              <div class="table-responsive">
                <table class="table">
                	<?php
                		$sql66 = "SELECT * FROM join_buah WHERE NoInvoice = '$no_invoicedetail'";
                		$query66 = mysqli_query($koneksi, $sql66);
                		$data66 = mysqli_fetch_array($query66);
                	?>
                  <tr>
                    <th style="width:50%">Subtotal : </th>
                    <td><?php echo "Rp. ".number_format($data66['SubHarga'], 2); ?></td>
                  </tr>
                  
                  <tr>
                    <th>Diskon : </th>
                    <td><?php echo $data4['Diskon']." %"; ?></td>
                  </tr>
                  <tr>
                    <th>Total Bayar : </th>
                    <td><?php echo "Rp. ".number_format($data66['TotalHarga'], 2); ?></td>
                  </tr>
                </table>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<?php
	$sql5 = "SELECT * FROM pembelian";
	$query5 = mysqli_query($koneksi, $sql5);
	while ($data5 = mysqli_fetch_array($query5)) {
?>
<div class="modal fade" role="document" id="hapus_data_penjualan<?php echo $data5['No_Invoice']; ?>">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form action="hapus_data_transaksi.php" method="get">
			<input type="hidden" name="invoiceno" value="<?php echo $data5['No_Invoice']; ?>" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Hapus <?php echo $data5['No_Invoice']; ?></h4>
			</div>
			<div class="modal-body">
				<p>Apakah Anda Yakin Menghapus Data Ini ?</p>
			</div>
			<div class="modal-footer">
				<div>
					<button type="button" data-dismiss="modal" class="btn btn-primary">Tidak</button>
					<button type="submit" class="btn">Ya</button>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>
<?php } ?>
<!-- /Modal Data Penjualan -->


<!-- buah Tambah -->
<div class="modal fade" role="document" id="cari_buah_penjualan" class="cari_buah_penjualan">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Data buah</h4>
			</div>
			<div class="modal-body">
				<table id="example2" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Kode buah</th>
                                <th>Nama buah</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Opsi</th>
                              </tr>
                            </thead>
                            <tbody>
                            	<?php
                            		$sql = mysqli_query($koneksi, "SELECT * FROM buah");
                            		while ($data = mysqli_fetch_array($sql)) {
                            	?>
                              <tr>
                                <td><?php echo $data['Kd_Buah']; ?></td>
                                <td><?php echo ucfirst($data['Nama']); ?></td>
                                <td><?php echo "Rp. ".number_format($data['Harga_Jual'],2); ?></td>
                                <td><?php echo $data['Stok']; ?></td>
                                <td>
                                  <a class="tambah_data_penjualan" Jumlah="1" Kd_Buah="<?php echo $data['Kd_Buah']; ?>" Nama="<?php echo ucfirst($data['Nama']); ?>" Harga="<?php echo $data['Harga_Jual']; ?>" href="penjualan.php?id=<?php echo $data['Kd_Buah']; ?>"><button type="button" class="btn btn-success"><span class="ion ion-plus"></span> Add</button></a>
                                </td>
                              </tr>
                              <?php
                              	}
                         	?>
                            </tbody>
                          </table>
			</div>
			<div class="modal-footer">
				<div>
					<button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>