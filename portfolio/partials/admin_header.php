<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="zakaria" content="">

		<title>Mon administration</title>

		<link rel="stylesheet" href="<?= WEBROOT; ?>src/css/bootstrap.min.css">
	</head>

	<body>
	
		<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a href="#" class="navbar-brand">Mon premier portfolio en PHP</a>
				</div>
				<ul class="nav navbar-nav">
					<li>
						<a href="category.php">Catégories</a>
					</li>
					<li>
						<a href="work.php">Réalisations</a>
					</li>
				</ul>
			</div>
		</div>
	
		<div class="container">
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>

			<?= flash(); ?>