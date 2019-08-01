<?php require_once 'config/header.php';?>
<?php require_once 'config/functions.php';
if (!isAdmin()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
?>
<!-- Nav bar START -->
<div class="nav-item dropdown">
        
        <img class="nav-link dropdown-toggle" src="img/user.png" alt="admin" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <div class="dropdown-divider"></div>
          <a id="logout" href="index.php?logout='1'">Logout</a>
        </div>
      </div>
    
  </div> 
</nav>
<!-- Nav bar END -->


<div class="container">
<!-- Students table -->
<?php studentTable() ?>

 <!-- Add Student Button -->
    <div id="adds"><td class="row"><a class="btn btn-success" data-toggle="modal" data-target="#addStudent">Add Student</a></td></div>

<!-- Modal 1: ID number input START -->
<div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Add Student Advisee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
         <div class="modal-body">
         <div class="md-form mb-5">
        <div class="modal-footer d-flex justify-content-end">
      </div>
      
  
        <form class="addnum" name="addnum">
        <div class="form-group">
        <label for="idnum">ID Number</label>
          <input id="idnum" type="text" name="id_num" >  
        
        </div>
        </form>
         </div>
         <div class="modal-footer">
         <div class="mr-5" id="content">
         <?php echo $studentrow['student']; ?>
         </div>
         
            <button id="add" class="btn btn-info" name="check_id">Add</button>
         
         </div>
         
      </div>
   </div>
</div>
</div>
<!-- Modal 1: ID number input END -->

<!-- Modal 2: Set Appointment START -->
<div class="modal fade" id="set" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title font-weight-bold">Appointment for Submition</h2>
            </div>
           
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    
                    <div class="row">
                    <form name="appointment" class="appointment">
                    <label data-error="wrong" data-success="right" for="month">Month:</label>
                    <input placeholder="" name="month" type="text" id="month" class="form-control validate col-lg-2">
                    
                    <label data-error="wrong" data-success="right" for="date">Day:</label>
                    <input placeholder="" name="day" type="text" id="day" class="form-control validate col-lg-2">

                    <label data-error="wrong" data-success="right" for="year">Year:</label>
                    <input placeholder="" name="year" type="text" id="year" class="form-control validate col-lg-2">
                    </div>
                </div>
 
                <div class="md-form mb-3">
                    <div class="form-group">
                    <label data-error="wrong" data-success="right" for="time">Time:</label>
                    <input placeholder="" name="time" type="text" id="time" class="form-control validate col-lg-5">
                    </div>

                    <div class="form-group">
                    <label data-error="wrong" data-success="right" for="venue">Venue:</label>
                    <input placeholder="" name="venue" type="text" id="venue" class="form-control validate col-lg-5">
                    </div>
                    <input type="hidden" id="studentId" class="form-control">  
                 </div>
                 </form>
 
            </div>
            <div class="modal-footer d-flex justify-content-center">
               
                <a id="appoint" class="btn btn-info">Submit <i class="fa fa-paper-plane-o ml-1"></i></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal 2: Set Appointment END -->

<script>
// Show student searched by ID number
$("#idnum").on("keydown", function(event){
			if(event.which==13){
				$.ajax({
					type: "POST",
					url: "id_pr.php",
					data:{
          str: $("#idnum").val()
					},
					success: function(data){	
						$("#content").text(data);
						
					}
				});
			}
    });

$(document).ready(function(){
  $(document).on('click', 'a[data-role=update]', function(){
    var id = $(this).data('id');
    $("#studentId").val(id);
    $("#set").modal('toggle');
});

  $('#appoint').click(function(){
    var id = $('#studentId').val();
    var month = $('#month').val();
    var day = $('#day').val();
    var year = $('#year').val();
    var time = $('#time').val();
    var venue = $('#venue').val();
    $.ajax({
      url: 'id_pr.php',
      method: 'POST',
      todo: 'getAppoint',
      data: { id: id, month: month, day: day, year: year, time: time, venue: venue},
      success: function(message){
        $("#apps").html(message);
        $("#set").modal('hide');
      },
      error: function(){
        alert("Error");
      }
    });
  });
});

// $(document).ready(function(){
//   $("button#add").click(function(){
//     $.ajax({
//       type: "POST",
//       url: "id_pr.php",
//       data: $('form.addnum').serialize(),
//       success: function(message){
//         $("#adds").html(message)
//         $("#addStudent").modal('hide');
//       },
//       error: function(){
//         alert("Error");
//       }
//     });
//   });



 
</script>
<?php require_once 'config/footer.php'?>
