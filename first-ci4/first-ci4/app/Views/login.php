<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h1>LOGIN</h1>
    <?php if(session()->getFlashdata('msg')):?>
        <?= session()->getFlashdata('msg') ?>
    <?php endif;?>
    <form action="<?= base_url('/login') ?>" method="post">
        <table>
			<tr>			
				<td>Username</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td><button type="submit">Submit</button></td>
			</tr>		
		</table>
    </form>
</body>
</html>