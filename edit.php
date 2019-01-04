<?php
	include 'config.php';
	$idurl = md5('id');
	$idget = $_GET[$idurl];
	$id    = base64_decode($idget);
	$sql   = "SELECT * FROM coba WHERE id = '$id'";
	$res   = $conn->query($sql);
	if ($res->num_rows > 0) {
		$row = $res->fetch_assoc();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit <?= $row['nama']; ?></title>
</head>
<body>
	Edit untuk <?= $row['nama']; ?>
	<form method="post">
		<table>

		<tr>
			<td>Customer No.</td>
			<td><input type="text" name="customer_no" value="<?= $row['customer_no']; ?>"> </td>
		</tr>


		<tr>
			<td>Nama*</td>
			<td><input type="text" name="nama" value="<?= $row['nama']; ?>"></td>
		</tr>
		
		<tr>
			<td>Address*</td>
			<td><input name="alamat" rows="10" value="<?= $row['alamat']; ?>"></td>
		</tr>

		<tr>
			<td>Phone*</td>
			<td><input type="number" name="phone" value="<?= $row['phone']; ?>"></td>
		</tr>
		

		<tr>
			<td><input type="submit" name="btn" value="Update"></td>
		</tr>

		</table>
	</form>

	<?php
		if (isset($_POST['btn'])) {
			$pre    = $conn->prepare("UPDATE coba SET nama = ?, customer_no = ?, alamat = ?, phone = ? WHERE id = ? ");
			$pre->bind_param("sssii", $nama, $customer_no, $alamat, $phone, $id);

			$nama   = $_POST['nama'];
			$customer_no = $_POST['customer_no'];
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
