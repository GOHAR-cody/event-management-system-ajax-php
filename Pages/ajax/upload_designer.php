<?php
 include('../db.php');
$name=mysqli_real_escape_string($conn,$_POST['name']);
$mail=mysqli_real_escape_string($conn,$_POST['mail']);
$dob=mysqli_real_escape_string($conn,$_POST['dob']);
$gender=mysqli_real_escape_string($conn,$_POST['gender']);
$phone=mysqli_real_escape_string($conn,$_POST['phone']);
$desc=mysqli_real_escape_string($conn,$_POST['desc']);
$city=mysqli_real_escape_string($conn,$_POST['city']);
$exp=mysqli_real_escape_string($conn,$_POST['experience']);
$ordered=mysqli_real_escape_string($conn,$_POST['ordered']);
$company=mysqli_real_escape_string($conn,$_POST['company']);
$color=mysqli_real_escape_string($conn,$_POST['color']);
$tools=mysqli_real_escape_string($conn,$_POST['tools']);
$content=mysqli_real_escape_string($conn,$_POST['content']);
$number=mysqli_real_escape_string($conn,$_POST['number']);
$pwd=mysqli_real_escape_string($conn,$_POST['pwd']);
$address2=mysqli_real_escape_string($conn,$_POST['address2']);
$img=$_FILES['img']['name'];
$pwd2=mysqli_real_escape_string($conn,$_POST['pwd2']);
$radio=mysqli_real_escape_string($conn,$_POST['exampleRadios']);
if(empty($name)||empty($mail)||empty($dob)||empty($phone)||empty($desc)||empty($gender)||empty($ordered)||empty($city)
|| empty($exp)||empty($company)||empty($color)||empty($tools)||empty($content)||empty($number)||empty($pwd)||empty($address2)||empty($img)||empty($pwd2)||empty($radio))
{
  echo 3;
}
else {
    if($pwd==$pwd2){
    $arr = array('png', 'jpeg', 'jpg');
   $exe = strtolower(pathinfo($img, PATHINFO_EXTENSION));
   if(in_array($exe, $arr)){
   $pic= rand(100,500).".".$exe;
    $sql = "INSERT INTO `designer` (
        `designer_name`, 
        `designer_mail`, 
        `designer_dob`, 
        `designer_gender`, 
        `designer_phone`, 
        `designer_desc`, 
        `designer_city`, 
        `designer_experience`, 
        `designer_ordered`, 
        `designer_company`, 
        `designer_color`, 
        `designer_tools`, 
    `designer_content`, 
        `designer_number`, 
        `designer_pwd`, 
        `designer_address2`, 
        `designer_img`, 
        `designer_exampleRadios`
    ) VALUES (
        '$name', 
        '$mail', 
        '$dob', 
        '$gender', 
        '$phone', 
        '$desc', 
        '$city', 
        '$exp', 
        '$ordered', 
        '$company', 
        '$color', 
        '$tools', 
        '$content', 
        '$number', 
        '$pwd', 
        '$address2', 
        '$pic', 
        '$radio'
    )";
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
?>