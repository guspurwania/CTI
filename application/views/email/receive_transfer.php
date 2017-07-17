<html>
<body>
	<h1>Dana Berhasil di Transfer</h1>
	<p>Pengiriman dana berhasil sebesar <strong><?php echo number_format($transfer['total_transfer'],2,",",".") ?></strong>, Mohon untuk mengecek rekening Anda.</p>
	<p>Berikut merupakan link bukti pembayarannya <a href="<?php echo base_url() ?>assets/images/<?php echo $transfer['note'] ?>" target="_blank"><?php echo base_url() ?>assets/images/<?php echo $transfer['note'] ?></a></p>

	<br /><br />
	<strong>ADMIN</strong><br />
	<strong>CTI TRAINING</strong>
</body>
</html>