<html>
<body>
	<h1>Register Partner Link Berhasil!</h1>
	<p>Terima Kasih telah melakukan registrasi</p>
	<p>Berikut data detail Anda :</p>
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
	<p>Mohon untuk menunggu aktivasi akun anda, kami akan segera menginformasikan jika akun anda sudah aktif</p>
	<br /><br />
	<strong>ADMIN</strong><br />
	<strong>CTI TRAINING</strong>
</body>
</html>