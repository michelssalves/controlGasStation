



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap336.min.css" />
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap335.min.js"></script>
    <script src="../assets/js/bootstrap-multiselect.js"></script>

</head>
<body>
<label for="exampleFormControlInput1">Grupos</label><br>
			<select id="status" name="gruposPublicar[]" multiple>
                    <option value="1">TODOS</option>
                    <option value="2">NOVO</option>
                    <option value="3">PEFIN</option>
                    <option value="4">PAGO</option>
                    <option value="5">BAIXADO</option>
                    <option value="5">CANCELADO</option>
			</select>
            <script>
        	  $(document).ready(function(){
	
                $('#status').multiselect({
                nonSelectedText: 'Selecione o Grupo',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth:'400px',
                includeSelectAllOption: true
                });
            });
    </script>
</body>
</html>