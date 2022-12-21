<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
</head>
<body>
<input onkeyup="filtrar(this.id)" id="1">
<table id="tabela">
    <thead>
        <tr>
            <th>id</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
        </tr>
        <tr>
            <td>2</td>
        </tr>
        <tr>
            <td>3</td>
        </tr>
        <tr>
            <td>4</td>
        </tr>
    </tbody>
</table>
</body>
</html>
<script>
function filtrar(x){

    var inp = '#'+ x 
 
    $(inp).keyup(function(){   

    var index = $(this).parent().index();
    var nth = "#tabela td:nth-child("+(index+x).toString()+")";
    var valor = $(this).val().toUpperCase();
    $("#tabela tbody tr").show();

    $(nth).each(function(){
        if($(this).text().toUpperCase().indexOf(valor) < 0){
            $(this).parent().hide();
        }
        });
    });
}
</script>