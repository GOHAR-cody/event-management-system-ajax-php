<?php
$id = $_GET['id'];
include('db.php'); 

$que = "SELECT * FROM `volunteer` WHERE `volunteer_id`='$id'";
$res = mysqli_query($conn, $que);
$volunteer = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $exp = mysqli_real_escape_string($conn, $_POST['experience']);
    $occ = mysqli_real_escape_string($conn, $_POST['occasions']);
    $achi = mysqli_real_escape_string($conn, $_POST['achievements']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $address2 = mysqli_real_escape_string($conn, $_POST['address2']);
    $img = $_FILES['img']['name'];
    $pwd2 = mysqli_real_escape_string($conn, $_POST['pwd2']);
    $radio = mysqli_real_escape_string($conn, $_POST['exampleRadios']);

    if (empty($name) || empty($mail) || empty($dob) || empty($phone) || empty($desc) || empty($gender) || empty($occ) || empty($city)
        || empty($exp) || empty($achi) || empty($skills) || empty($pwd) || empty($address2) || empty($pwd2) || empty($radio)) {
        echo "<script>alert('fill all the fields')</script>";
    } else {
        if ($pwd == $pwd2) {
            if (!empty($img)) {
                $oldImage = $volunteer['volunteer_img'];
                $arr = array('png', 'jpeg', 'jpg');
                $exe = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                if (in_array($exe, $arr)) {
                    $pic = rand(100, 500) . "." . $exe;
                    if (file_exists("../uploads/" . $oldImage)) {
                        unlink("../uploads/" . $oldImage);
                    }
                    $sql = "UPDATE volunteer SET 
                                volunteer_name = '$name', 
                                volunteer_mail = '$mail', 
                                volunteer_dob = '$dob', 
                                volunteer_gender = '$gender', 
                                volunteer_phone = '$phone', 
                                volunteer_desc = '$desc', 
                                volunteer_city = '$city', 
                                volunteer_experience = '$exp', 
                                volunteer_occasions = '$occ', 
                                volunteer_achievements = '$achi', 
                                volunteer_skills = '$skills', 
                                volunteer_pwd = '$pwd', 
                                volunteer_address2 = '$address2', 
                                volunteer_img = '$pic', 
                                volunteer_exampleRadios = '$radio' 
                            WHERE volunteer_id = $id";

                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        echo "<script>alert('Record updated successfully')</script>";
                        move_uploaded_file($_FILES['img']['tmp_name'], "../uploads/" . $pic);
                    } else {
                        echo "<script>alert('Data not updated')</script>";
                    }
                } else {
                    echo "<script>alert('Invalid file format for image upload')</script>";
                }
            } else {
                $pic = $volunteer['volunteer_img'];
                $sql = "UPDATE volunteer SET 
                            volunteer_name = '$name', 
                            volunteer_mail = '$mail', 
                            volunteer_dob = '$dob', 
                            volunteer_gender = '$gender', 
                            volunteer_phone = '$phone', 
                            volunteer_desc = '$desc', 
                            volunteer_city = '$city', 
                            volunteer_experience = '$exp', 
                            volunteer_occasions = '$occ', 
                            volunteer_achievements = '$achi', 
                            volunteer_skills = '$skills', 
                            volunteer_pwd = '$pwd', 
                            volunteer_address2 = '$address2', 
                            volunteer_img = '$pic', 
                            volunteer_exampleRadios = '$radio' 
                        WHERE volunteer_id = $id";

                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script>alert('Record updated successfully')</script>";
                } else {
                    echo "<script>alert('Data not updated')</script>";
                }
            }
        } else {
            echo "<script>alert('Passwords do not match')</script>";
        }
    }
}
include('../include/header.php'); ?>
<style>   
.tags-input-container{
    display:flex;
    flex-wrap:wrap;
    border:1px solid #ccc;
    padding:5px;
 
    cursor:text;

}
.tags-input-container input{
    border:none;
    outline:none;
    padding:5px;
    flex-grow:1;
}
.tag{
    display:inline-block;
    background-color:#e1e1e1;
    padding:5px;
    margin:2px;
    border-radius:3px;
    font-size:14px;
}
.tag .remove-tag{
    margin-left:5px;
    cursor:pointer;
}

</style>

</head>
<body>
<?php
include('../include/sidebar.php'); 

?>

<div class="app" id="app">
    <div class="app-header white box-shadow">
        <div class="navbar navbar-toggleable-sm flex-row align-items-center">
            <!-- Open side - Naviation on mobile -->
            <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
                <i class="material-icons">&#xe5d2;</i>
            </a>
            <!-- / -->

            <!-- Page title - Bind to $state's title -->
            <div class="mb-0 h5 no-wrap" ng-bind="$state.current.data.title" id="pageTitle"></div>

            <!-- navbar collapse -->
            <div class="collapse navbar-collapse" id="collapse">
                <!-- link and dropdown -->
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href data-toggle="dropdown">
                            <i class="fa fa-fw fa-plus text-muted"></i>
                            <span>New</span>
                        </a>
                        <div ui-include="'../views/blocks/dropdown.new.html'"></div>
                    </li>
                </ul>

                <div ui-include="'../views/blocks/navbar.form.html'"></div>
                <!-- / -->
            </div>
            <!-- / navbar collapse -->

            <!-- navbar right -->
            <ul class="nav navbar-nav ml-auto flex-row">
                <li class="nav-item dropdown pos-stc-xs">
                    <a class="nav-link mr-2" href data-toggle="dropdown">
                        <i class="material-icons">&#xe7f5;</i>
                        <span class="label label-sm up warn">3</span>
                    </a>
                    <div ui-include="'../views/blocks/dropdown.notification.html'"></div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link p-0 clear" href="#" data-toggle="dropdown">
                        <span class="avatar w-32">
                            <img src="../assets/images/a0.jpg" alt="...">
                            <i class="on b-white bottom"></i>
                        </span>
                    </a>
                    <div ui-include="'../views/blocks/dropdown.user.html'"></div>
                </li>
                <li class="nav-item hidden-md-up">
                    <a class="nav-link pl-2" data-toggle="collapse" data-target="#collapse">
                        <i class="material-icons">&#xe5d4;</i>
                    </a>
                </li>
            </ul>
            <!-- / navbar right -->
        </div>
    </div>

    <div class="app-footer">
        <div class="p-2 text-xs">
            <div class="pull-right text-muted py-1">
                &copy; Copyright <strong>Flatkit</strong> <span class="hidden-xs-down">- Built with Love v1.1.3</span>
                <a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
            </div>
            <div class="nav">
                <a class="nav-link" href="../">About</a>
                <a class="nav-link" href="http://themeforest.net/user/flatfull/portfolio?ref=flatfull">Get it</a>
            </div>
        </div>
    </div>
    <div ui-view class="app-body" id="view">
        <div class="padding">
            <div class="row " style="margin-left:40em">
                <div class="col-sm-6">

                    <form method="POST" enctype="multipart/form-data">
                        <div class="box">
                            <div class="box-header">
                                <h2>Volunteer</h2>
                            </div>
                            <div class="box-body">
                                <p class="text-muted">Please fill the information to continue</p>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. john"
                                    value="<?php echo $volunteer['volunteer_name']; ?>"    required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="mail" class="form-control" placeholder="example@gmail.com"
                                    value="<?php echo $volunteer['volunteer_mail']; ?>"   required>
                                </div>
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" name="dob" class="form-control" value="<?php echo $volunteer['volunteer_dob']; ?>" required>
                                </div>
                                <div class="form-group" >
                                <label>Gender</label>
                                <div style="display: flex; margin-left: 2em;">
                                    <div class="form-check ">
                                        <input class="form-check-input  " type="radio" name="gender" <?php echo ($volunteer['volunteer_gender'] == 'male') ? 'checked' : ''; ?>
                                            id="exampleRadios1" value="male" checked>
                                        <label class="form-check-label  "  style=" margin-left: -1em;" for="exampleRadios1">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check" style=" margin-left: 2.5em;">
                                        <input class="form-check-input  " type="radio" name="gender"
                                            id="exampleRadios2" value="female" <?php echo ($volunteer['volunteer_gender'] == 'female') ? 'checked' : ''; ?>>
                                        <label class="form-check-label   " style=" margin-left: -1em;" for="exampleRadios2">
                                            Female</label>
                                    </div>
                                    <div class="form-check" style=" margin-left: 2.5em;">
                                        <input class="form-check-input  " type="radio" name="gender"
                                            id="exampleRadios3" value="other" <?php echo ($volunteer['volunteer_gender'] == 'other') ? 'checked' : ''; ?>>
                                        <label class="form-check-label  " style=" margin-left: -1em;" for="exampleRadios3">
                                            Other</label>
                                    </div>
                                </div>
                            </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" name="phone" class="form-control" placeholder="xxxx xxxx xxxx"
                                    value="<?php echo $volunteer['volunteer_phone']; ?>"   required >
                                </div>
                            
                                <div class="select_option form-group">
                                    <label>City</label>
                                    <select class="form-select city form-control" name="city" id="city" required>
                                        <option value="" selected>Select City</option>
                                        <?php
                                     $city_query = "SELECT * FROM cities ";
                                     $city_result=$city_result = mysqli_query($conn, $city_query);
                                     while ($city = mysqli_fetch_assoc($city_result)) {
                                        $selected = ($volunteer['volunteer_city'] == $city['city_name']) ? 'selected' : '';
                                        echo "<option value='{$city['city_name']}' {$selected}>{$city['city_name']}</option>";
                                  }
                                  ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Experience</label><br>
                                    <select name="experience" class="form-select input_text form-control" required>
                                    <option value="null">Select experience</option>
                                    <option value="First" <?php echo ($volunteer['volunteer_experience'] == 'First') ? 'selected' : ''; ?>>First</option>
                                    <option value="Second" <?php echo ($volunteer['volunteer_experience'] == 'Second') ? 'selected' : ''; ?>>Second</option>
                                    <option value="Third" <?php echo ($volunteer['volunteer_experience'] == 'Third') ? 'selected' : ''; ?>>Third</option> 

                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="desc" rows="6" data-minwords="6" required
                                        placeholder="Add description here"><?php echo $volunteer['volunteer_desc']; ?></textarea>
                                </div>
                               
                              
                                <div class="form-group">
                                    <label for="achievements">Type of Occasions(you want to volunteer)</label>
                                    <div class="tags-input-container" id="occasions-tags-input-container">
                                        <input type="text" class="form-control" id="occasions-tags-input"
                                            placeholder="Type a tag and press Enter "value="<?php echo $volunteer['volunteer_occasions']; ?>">
                                    </div>
                                    <input type="hidden" name="occasions"  id="occasions-hidden-tags" value="<?php echo $volunteer['volunteer_occasions']; ?>">
                                </div>
                               
                                <div class="form-group">
                                    <label for="achievements">Achievements</label>
                                    <div class="tags-input-container" id="achievements-tags-input-container">
                                        <input type="text" class="form-control" id="achievements-tags-input"
                                            placeholder="Type a tag and press Enter " value="<?php echo $volunteer['volunteer_achievements']; ?>">
                                    </div>
                                    <input type="hidden" name="achievements"  id="achievements-hidden-tags"value="<?php echo $volunteer['volunteer_achievements']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="skills">Personal Skills</label>
                                    <div class="tags-input-container" id="skills-tags-input-container">
                                        <input type="text" class="form-control" id="skills-tags-input"
                                            placeholder="Type a tag and press Enter " value="<?php echo $volunteer['volunteer_skills']; ?>">
                                    </div>
                                    <input type="hidden" name="skills" id="skills-hidden-tags" value="<?php echo $volunteer['volunteer_skills']; ?>">
                                </div>
                               
                               

                                <div class="row m-b">
                                    <div class="col-sm-6">
                                        <label>Enter password</label>
                                        <input type="password" name="pwd" class="form-control" required id="pwd" value="<?php echo $volunteer['volunteer_pwd']; ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Confirm password</label>
                                        <input type="password" class="form-control" name="pwd2"
                                            data-parsley-equalto="#pwd" value="<?php echo $volunteer['volunteer_pwd']; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" name="address2" rows="6" data-minwords="6" required
                                        placeholder="Add address here"><?php echo $volunteer['volunteer_address2']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Picture</label>
                                    <input type="file" class="form-control" name="img" >
                                </div>
                            </div>
                            <div class="form-group" style=" margin-left: 1.5em;padding-bottom: 3em;">
                                <label>Status</label>
                                <div style="display: flex; margin-left: 4em;">
                                    <div class="form-check ">
                                        <input class="form-check-input  " type="radio" name="exampleRadios"
                                            id="exampleRadios1" value="pending" <?php echo ($volunteer['volunteer_exampleRadios'] == 'pending') ? 'checked' : ''; ?> checked>
                                        <label class="form-check-label  " for="exampleRadios1">
                                            Pending
                                        </label>
                                    </div>
                                    <div class="form-check" style=" margin-left: 4em;">
                                        <input class="form-check-input  " type="radio" name="exampleRadios"
                                            id="exampleRadios2" value="confirm" <?php echo ($volunteer['volunteer_exampleRadios'] == 'confirm') ? 'checked' : ''; ?>>
                                        <label class="form-check-label  " for="exampleRadios2">
                                            Confirm</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="dker p-a text-right">
                            <button type="submit" name="submit" class="btn info">Submit</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<?php
    include('../include/footer.php'); 
    ?>

<script>
$(document).ready(function() {
    // Function to handle tags input
    function handleTagsInput(inputFieldId, containerId, hiddenInputId) {
        const tagsInput = $('#' + inputFieldId);
        const tagsInputContainer = $('#' + containerId);
        const hiddenTagsInput = $('#' + hiddenInputId);
        let tags = [];

        // Function to update hidden input value
        function updateHiddenTagsInput() {
            hiddenTagsInput.val(tags.join(','));
        }

        // Function to create tag element
        function createTagElement(tag) {
            const tagElement = $('<span class="tag">' + tag + '</span>');
            const removeTagElement = $('<span class="remove-tag">x</span>');
            removeTagElement.click(function() {
                tags = tags.filter(t => t !== tag);
                tagElement.remove();
                updateHiddenTagsInput();
            });
            tagElement.append(removeTagElement);
            return tagElement;
        }

        // Event listener for input field
        tagsInput.keydown(function(event) {
            if (event.key === 'Enter' || event.key === ',') {
                event.preventDefault();
                const tag = tagsInput.val().trim().replace(',', '');
                if (tag && !tags.includes(tag)) {
                    tags.push(tag);
                    tagsInputContainer.append(createTagElement(tag));
                    tagsInput.val('');
                    updateHiddenTagsInput();
                }
            }
        });
    }

    // Call handleTagsInput for each input field
    handleTagsInput('achievements-tags-input', 'achievements-tags-input-container', 'achievements-hidden-tags');
    handleTagsInput('skills-tags-input', 'skills-tags-input-container', 'skills-hidden-tags');
    handleTagsInput('occasions-tags-input', 'occasions-tags-input-container', 'occasions-hidden-tags');
   
});

</script>