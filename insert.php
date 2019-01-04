<?php 
include 'config.php'; 
$no = mysqli_query($conn, "SELECT customer_no FROM coba ORDER BY customer_no DESC");
$no_customer = mysqli_fetch_array($no);
$code = $no_customer['customer_no'];

$urut = substr($code, 6, 4);
$tambah = (int) $urut + 1;
if (strlen($tambah)==1) {
	$format = "CRM"."000".$tambah;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Insert</title>
</head>
<body>
	<h1>DATA CUSTOMER</h1>
	


	<form method="post" action="">
		<table>
		<tr>
			<td>Customer No.</td>
			<td><input type="text" name="customer_no" value="<?php echo $format; ?>" readonly></td>
		</tr>
		
		<tr>
			<td>Nama*</td>	
			<td><input type="text" name="nama" class="form-control" required></td>
		</tr>

		<tr>
			<td>Phone*</td>
			<td><input type="number" name="phone" class="form-control"  required> </td>
		</tr>

		<tr>
			<td>Address*</td>
			<td><input name="alamat" rows="10" class="form-control" required></td>
		</tr>

		<tr>
		<td><input type="submit" name="btn" value="Simpan"></td>
		</tr>

		</table>
	</form>
	<br>

<?php
	$sql = "SELECT * FROM coba";
	$res = $conn->query($sql);
	if ($res->num_rows > 0) { ?>
	<table border="1">
		<thead>
			<tr>
				<th>Nama</th>
				<th>Customer Nomor</th>
				<th>Alamat</th>
				<th>Telepon</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			
		<?php while ($row = $res->fetch_assoc()) { ?>
		<tr>
			<td><?= $row["nama"]; ?></td>
			<td><?= $row["customer_no"]; ?></td>
			<td><?= $row["alamat"]; ?></td>
			<td><?= $row["phone"]; ?></td>
			<td>
				<a href="edit.php?<?= md5("id"); ?>=<?= base64_encode($row["id"]); ?>">Edit</a>
				<a href="hapus.php?<?= md5("id"); ?>=<?= base64_encode($row["id"]); ?>" onclick="return confirm('Yakin Mau Di Hapus Data nya ?')">Hapus</a>
			</td>
		</tr>	
	<?php }
	} else { ?>
	<h1>Data kosong</h1>
		</tbody>
	</table>
<?php }?>
	<?php
		if (isset($_POST['btn'])) {
			$pre    = $conn->prepare("INSERT INTO coba (nama, customer_no, alamat, phone) VALUES (?, ?, ?, ?)");
			$pre->bind_param("sssi", $nama, $customer_no, $alamat, $phone);
			$nama   = $_POST['nama']; 
			$customer_no  = $_POST['customer_no']; 
			$alamat = $_POST['alamat']; 
			$phone = $_POST['phone']; 
			$pre->execute();
			echo "Sukses";
			echo "<meta http-equiv='refresh' content='1;url=insert.php'>";

			$pre->close();
			$conn->close();
		}
	?>
</body>
</html>