<!DOCTYPE html>
<html lang="pt">
<head>
  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MED WEB</title>
    <!-- Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <!-- Font-Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.all.min.6.2.1.css">
    <!-- Bootstrap-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- W3-SCHOOL-->
    <link href="assets/css/w3.min.css" rel="stylesheet">  
    <!-- TABLESAW - DEIXA A TABELA RESPONSIVA-->  
    <link rel="stylesheet" href="assets/css/tablesaw.css">
    <script>
	TablesawConfig = {
		getColumnToggleLabelTemplate: function( text ) {
			return "<label><input type='checkbox' checked><span>" + text + "</span></label>";
		}
	};
	</script>
    <script src="assets/js/tablesaw.js"></script>
    <script src="assets/js/tablesaw-init.js"></script>
     <!-- /TABLESAW - DEIXA A TABELA RESPONSIVA--> 
</head>
<?php

include 'controller/conn.php';
include 'controller/vetoresAuxiliares.php';

include 'controller/gerenciadorDePaginas.php';

?>

</div>
</main>
<!--Awesome-->
<script src="assets/js/fontawesome.all.min.js"></script>
<!--Jquery-->
<script src="assets/js/jquery-3.6.1.min.js"></script>
<!--Bootstrap
<script src="assets/js/bootstrap.bundle.min.4.3.1.js"></script>-->
<script src="assets/js/bootstrap.bundle.min.v5.2.3.js"></script>

<!--Custom -->
<script src="assets/js/main.js"></script>

</body>
</html>