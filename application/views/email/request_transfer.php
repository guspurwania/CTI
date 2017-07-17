<html>
<body>
	<h1>Permintaan Pengiriman Point</h1>
	<p>Berikut data detail Pengiriman :</p>
	<table>
		<tr>
			<td>Nama Lengkap</td>
			<td>:</td>
			<td><?php echo $user['full_name'] ?></td>
		</tr>
		<tr>
			<td>Nomer Rekening</td>
			<td>:</td>
			<td><?php echo $user['account_number'] ?></td>
		</tr>
		<tr>
			<td>Atas Nama</td>
			<td>:</td>
			<td><?php echo $user['account_name'] ?></td>
		</tr>
		<tr>
			<td>Nama Bank</td>
			<td>:</td>
			<td><?php echo $user['bank_name'] ?></td>
		</tr>
		<tr>
			<td>Total Point</td>
			<td>:</td>
			<td><?php echo $user['point'] ?></td>
		</tr>
		<tr>
			<td>Point yang ditransfer</td>
			<td>:</td>
			<td><strong><?php echo $additional_data['total_transfer'] ?></strong></td>
		</tr>
	</table>

	<br /><br />
	<strong>ADMIN</strong><br />
	<strong>CTI TRAINING</strong>
</body>
</html>