<?php
                   include('../db.php');
                   $i=1;
                    //$query = "SELECT * FROM `users`";
                    $query = "SELECT users.*, roles.role_name FROM `users` INNER JOIN `roles` ON users.user_role = roles.role_id";

                    $res = mysqli_query($conn, $query);
                    while ($ar = mysqli_fetch_assoc($res)) {
                        ?>
          <tr>  
          <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $ar['user_name'] ?></td>
                            <td><?php echo $ar['user_mail'] ?></td>
                            <td><?php echo $ar['role_name'] ?></td>
                           
                            <td style="display:flex">
                            <a class="btn btn-danger delete" data-del="<?php echo $ar['user_id'] ?>">Delete</a>
                            <a class="btn btn-success" href="edit_user.php?upid=<?php echo $ar['user_id'] ?>">Update</a>
                            </td>   
        </tr>
        <?php
                  $i+=1; 
                  }
                    ?>