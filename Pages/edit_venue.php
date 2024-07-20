<?php  
 include('db.php'); 
 $id = $_GET['upid'];
 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
  $ven_name= mysqli_real_escape_string($conn,$_POST['ven_name']);
  $ven_desc= mysqli_real_escape_string($conn,$_POST['ven_desc']);
 if(empty($ven_name) || empty($ven_desc)){
  echo "Fill all the fields";
 }
 else{
   $sql="UPDATE `venue`SET `venue_name`='$ven_name', `venue_desc`= '$ven_desc' WHERE `venue_id`='$id'";
   $result=mysqli_query($conn,$sql);
   if($result){
    echo "<script>alert('Venue has been updated')</script>";
   }
   else{
    echo "<script>alert('Error! Venue not updated')</script>";;
   }
 }
  
 }


 ?> 
 <?php
 include('../include/header.php'); 
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
    <div class="col-sm-6 " >
      <form  Method="POST">
        <div class="box">
          <div class="box-header">
            <h2>Venue</h2>
          </div>
          <div class="box-body">
          <?php
                 $sql="SELECT * FROM `venue` WHERE `venue_id`='$id'";
                 $result = mysqli_query($conn, $sql);
                 $data= mysqli_fetch_assoc($result);
                 
                 ?>               
              
              <div class="form-group">
                <label>Add Venue</label>
                <input type="text" name="ven_name" value="<?php echo $data['venue_name']  ?>" required class="form-control" placeholder="Add name here">
              </div>
              <div class="form-group">
                <label>Add Description</label>
                <textarea class="form-control" name="ven_desc"  rows="6" data-minwords="6" required placeholder="Add description here"><?php echo $data['venue_desc']  ?></textarea>
              </div>
          </div>
          <div class="dker p-a text-right">
            <button type="submit" name="submit" class="btn info">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
 
</div>

<!-- ############ PAGE END-->

    </div>
  </div>
  <!-- / -->

 

<!-- ############ LAYOUT END-->

  </div>
  <?php  
include('../include/footer.php'); 

 ?> 