<html>
<body>
	<h1>Register Mahasiswa Berhasil!</h1>
	<p>Terima Kasih telah melakukan registrasi</p>
	<p>Berikut data detail Mahasiswa :</p>
	<table>
		<tr>
			<td>Nama Lengkap</td>
			<td>:</td>
			<td><?php echo $additional_data['full_name'] ?></td>
		</tr>
		<tr>
			<td>Telepon</td>
			<td>:</td>
			<td><?php echo $additional_data['phone'] ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><?php echo $additional_data['email'] ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?php echo $additional_data['address'] ?></td>
		</tr>
		<tr>
			<td>Didaftarkan Oleh</td>
			<td>:</td>
			<td><?php echo $session['full_name'] ?></td>
		</tr>
	</table>
	<p>Mohon untuk menunggu sampai admin melakukan validasi dan menyetujui data yang anda ajukan.</p>
	<br /><br />
	<strong>ADMIN</strong><br />
	<strong>CTI TRAINING</strong>
</body>
</html>