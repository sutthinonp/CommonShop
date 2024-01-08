<?php
session_start();
session_destroy();
?>
<html>
<head>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<style>

	@import url(https://fonts.googleapis.com/css?family=Prompt&display=swap);

	* {
		font-family: 'Prompt', sans-serif;
	}

</style>
<body>
					<script>
						Swal.fire(
						  ':3',
						  'ออกจากระบบสำเร็จ!',
						  'success'
						)
					</script>
					<meta http-equiv='refresh' content='2;URL=login'>
</body>
</html>