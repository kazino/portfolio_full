<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="zakaria" content="">

		<title><?= isset($title) ? $title : 'Mon portfolio'; ?></title>

		<link rel="stylesheet" href="<?= WEBROOT; ?>/src/css/bootstrap.min.css">
	</head>

	<body>

		<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a href="<?= WEBROOT; ?>portfolio.php" class="navbar-brand">Mon premier portfolio en PHP</a>
				</div>
			</div>
		</div>

		<div class="container">
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>

			<?= flash(); ?>