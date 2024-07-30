<?php  
include('../include/header.php'); 

 ?> 
 </head>
 <body>
  <div class="app" id="app">
  <?php
 
 include('../include/sidebar.php'); 
?>
<!-- ############ LAYOUT START-->


  <!-- content -->
  <div id="content" class="app-content box-shadow-z0" role="main">
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
                    <span>Roles</span>
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

<!-- ############ PAGE START-->
<div class="padding">
  <div class="box">
    <div class="box-header">
      <h2>DataTables</h2>
    </div>
    <div class="table-responsive">
      <table ui-jp="dataTable" class="table table-striped b-t b-b">
        <thead>
          <tr>
            <th  style="width:20%">Id</th>
            <th  style="width:25%">Role Title</th>
            <th  style="width:25%">Access</th>
            <th  style="width:25%">Category</th>
            <th  style="width:25%">Planner</th>
            <th  style="width:25%">Designer</th>
            <th  style="width:25%">Volunteer</th>
            <th  style="width:25%">Venue</th>
            <th  style="width:25%">Booking</th>
            <th  style="width:25%">News</th>
            <th  style="width:25%">Events</th>
            <th  style="width:15%">Action</th>
            
          </tr>
        </thead>

        <tbody>
        <?php
                   include('db.php');
                   $i=1;
                    $query = "SELECT * FROM roles";
                    $res = mysqli_query($conn, $query);
                    $new= array('category','planner','designer','volunteer','venue','booking','news','event');
                    while ($ar = mysqli_fetch_assoc($res)) {
                        $selected=unserialize($ar['role_roles']);
                        
                        ?>
          <tr>  
          <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $ar['role_name'] ?></td>
                            <td><?php echo $ar['role_access'] ?></td>
                            
                            <?php 
                              foreach($new as $s){
                                
                               ?>
                             <td><input type="checkbox"  <?php echo in_array($s ,$selected) ? 'checked' : ' '; ?>></td>
                                
                                
                                <?php
                              } ?>
                            
                            <td style="display:flex">
                            <a class="btn btn-danger" href="delete_role.php?upid=<?php echo $ar['role_id'] ?>">Delete</a>
                            <a class="btn btn-success" href="edit_role.php?upid=<?php echo $ar['role_id'] ?>">Update</a>
                            </td>   
        </tr>
        <?php
                  $i+=1; 
                  }
                   ?>
        </tbody>
      </table>
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
 include $_SERVER['DOCUMENT_ROOT'] . "/flatkit/include/footer.php";

 ?> 