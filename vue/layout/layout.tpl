<?php  
	global $controle;  //accès aux variables globales 
	global $action; 	//nécessaire car layout inclus au sein d'une fonction-action
?>

<!doctype html>
<html><head>
    <meta charset="utf-8">
    <title>Test mvc  <?php  echo ($action); ?> </title>
    <link rel="stylesheet" href="./vue/styleCSS/style.css"/>
    <link rel="stylesheet" href="./vue/styleCSS/bootstrap.css"/>
    <link rel="stylesheet" href="./vue/styleCSS/normalize.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>

<body>

	<nav>
		<?php  require ("./vue/layout/menu.tpl"); ?>
	</nav>

	<div id ="main">
		<h2> Vue </h2>
		<?php  require ("./vue/" . $controle . "/" . $action . ".tpl"); ?>
	</div>

</body></html>
