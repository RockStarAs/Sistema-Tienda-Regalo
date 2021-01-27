<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	

	<title>Página de error</title>

	
	<link type="text/css" rel="stylesheet" href="<?= media();?>css/styleError.css" />

</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>4<span></span>4</h1>
			</div>
			<h2>OOPS! PÁGINA NO ENCONTRADA</h2>
			<p>Lo sentimos, pero la página que está buscando no existe, o se ha eliminado, o cambiado el nombre o no está disponible temporalmente</p>
			<a href="<?= base_url();?>dashboard">Regresar al inicio</a>
		</div>
	</div>

</body>

</html>
