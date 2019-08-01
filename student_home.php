<?php require_once 'config/header.php';
      require_once 'config/functions.php';
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
?>

<div class="nav-item dropdown">
        
        <img class="nav-link dropdown-toggle" src="img/user.png" alt="admin" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <div class="dropdown-divider"></div>
          <a id="logout" href="index.php?logout='1'">Logout</a>
        </div>
      </div>
    
  </div>
</nav>

<div class="container">
<table class="table mt-5">
  <thead class="thead-light">
    <tr>
      <th scope="col">Adviser Name</th>
      <th scope="col">Documents</th>
      <th scope="col">Approval</th>
      <th scope="col">Apointment</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><?php
   echo $_SESSION['student']['adviser'] ?></th>
      <td><a class="btn btn-warning" data-toggle="modal" data-target="#uploadModal">Submit Documents</a></td>
      <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
         <div class="modal-content">
         <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Upload File</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          </div>
         <div class="modal-body">
         <div class="md-form mb-1">
         <div class="modal-footer d-flex justify-content-end">
          </div>
          <div class="row">
          <div class="col-6">
          <label>Title</label>
          <form action="upload.php" method="post" enctype="multipart/form-data">   
          <input type="text" name="title">
          <input type="file" name="file"/>
          </div>
          <div class="col-6">
          
          </div>
          </div>
          
         </div>
         </div>
         <div class="modal-footer">
            <button class="btn btn-info" name="btn-upload">Confirm</button>
                </div>
            </div>
         </div>
        </div>
      <td>All Approved <a href="approval.php" class="ml-5">View</a></td>
      <td><a class="btn btn-info" href="appointment.php">Scheduled Appointment</a></td>
    </tr>
    </tr>
  </tbody>
</table>

</div>

<?php require_once 'config/footer.php'?>