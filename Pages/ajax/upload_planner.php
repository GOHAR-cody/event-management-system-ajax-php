<?php
 include('../db.php');  
$name=mysqli_real_escape_string($conn,$_POST['name']);
$mail=mysqli_real_escape_string($conn,$_POST['mail']);
$dob=mysqli_real_escape_string($conn,$_POST['dob']);
$phone=mysqli_real_escape_string($conn,$_POST['phone']);
$desc=mysqli_real_escape_string($conn,$_POST['desc']);
$city=mysqli_real_escape_string($conn,$_POST['city']);
$exp=mysqli_real_escape_string($conn,$_POST['experience']);
$achi=mysqli_real_escape_string($conn,$_POST['achievements']);
$skill=mysqli_real_escape_string($conn,$_POST['skills']);
$partner=mysqli_real_escape_string($conn,$_POST['partners']);
$pwd=mysqli_real_escape_string($conn,$_POST['pwd']);
$address2=mysqli_real_escape_string($conn,$_POST['address2']);
$img=$_FILES['img']['name'];
$pwd2=mysqli_real_escape_string($conn,$_POST['pwd2']);
$radio=mysqli_real_escape_string($conn,$_POST['exampleRadios']);
if(empty($name)||empty($mail)||empty($dob)||empty($phone)||empty($desc)||empty($city)
|| empty($exp)||empty($achi)||empty($skill)||empty($partner)||empty($pwd)||empty($address2)||empty($img)||empty($pwd2)||empty($radio))
{
  echo 4;
}
else {
     // Check if the email already exists in any of the three tables
     $checkEmailQuery = "
     SELECT 'planner' AS source FROM planner WHERE planner_mail = '$mail'
     UNION
     SELECT 'designer' AS source FROM designer WHERE designer_mail = '$mail'
     UNION
     SELECT 'volunteer' AS source FROM volunteer WHERE volunteer_mail = '$mail'
 ";
 $emailResult = mysqli_query($conn, $checkEmailQuery);

 if (mysqli_num_rows($emailResult) > 0) {
    
     echo 3;
 } else {
    if($pwd==$pwd2){
    $arr = array('png', 'jpeg', 'jpg');
   $exe = strtolower(pathinfo($img, PATHINFO_EXTENSION));
   if(in_array($exe, $arr)){
   $pic= rand(100,500).".".$exe;
    $sql = "INSERT INTO `planner` (`planner_name`, `planner_mail`, `planner_dob`, `planner_phone`, `planner_desc`, `planner_city`, `planner_exp`, `planner_achi`, `planner_skills`,`planner_partner`, `planner_pwd`, `planner_address`, `planner_pic`, `planner_status`) 
    VALUES ('$name', '$mail', '$dob', '$phone', '$desc', '$city', '$exp', '$achi', '$skill', '$partner', '$pwd', '$address2', '$pic', '$radio')";
    if($radio == 'confirm'){
        $sql="INSERT INTO `login_users`( `login_mail`, `login_pass`,`login_role`) VALUES ('$mail', '$pwd', 2)";
        $res=mysqli_query($conn,$sql);
       
    }
    
    $result=mysqli_query($conn, $sql);
    if($result) {
        echo 1;
        move_uploaded_file($_FILES['img']['tmp_name'], "../../uploads/" . $pic);
    } else {
        echo 0;
    }
}
    }
else{
    echo 2;
}
}
 }

?>