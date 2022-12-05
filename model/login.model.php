
<?php
 
$out = array('error' => false);
 
$username = $_POST['username'];
$password = $_POST['password'];
 
if($username==''){
    $out['error'] = true;
    $out['message'] = "Username is required";
}
else if($password==''){
    $out['error'] = true;
    $out['message'] = "Password is required";
}
else{
    $sql = "SELECT * FROM ti_clientes WHERE email='$username' AND senha ='$password'";
    $qry = odbc_exec($conn,$sql);
    $num_row = odbc_num_rows($qry);
    if($num_rows>0){

        $row= odbc_fetch_array($qry);
        
        $_SESSION['user']=$row['id'];
        $out['message'] = "Login Successful";
    }
    else{
        $out['error'] = true;
        $out['message'] = "Login Failed. User not Found";
    }
}
     
 
header("Content-type: application/json");
echo json_encode($out);
die();
?>