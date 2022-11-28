<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>



<div class="row">
        <div class="col-12">
          <form name="f_user" id="f_user" method="POST" enctype="multipart/form-data">
          <div class="card mb-4">
            <div class="card-header pb-0">

              
              <div class="row">
                <div class="col col-10 text-left">
                  <a href="<?= base_url().SITE_URL?>user"><i class="fa fa-arrow-left me-2"></i> Back</a>
                </div>
                <div class="col col-2 text-right clearfix">
                  <div class="input-group text-right clearfix">
                      <button type="submit" id="btn_f_user" class="btn btn-info float-right"><i class="fa fa-save"></i> <?= ($id)?'Update':'Save'?></button>
                    </div>
                </div>
              </div>

            </div>
            <div class="card-body px-0 pt-0 pb-2 ps-3 pe-3">
              
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?>">
           

            

            <div class="mb-3">
              <div class="row">
                <div class="col col-md-8">

                <?php if($id ==''){ ?>
                  
                 <div class="mb-3">
                   <label for="username" class="form-label">Username</label>
                   <input type="text" class="form-control" id="username" name="username" placeholder="Username.." value="<?= $username ?>" required>
                 </div>

                 <div class="mb-3">
                   <label for="email" class="form-label">Email</label>
                   <input type="email" class="form-control" id="email" name="email" placeholder="Email.." value="<?= $email ?>" required>
                 </div>

                 <?php } else {?>

                  <div class="mb-3">
                   <label for="username" class="form-label">Username</label>
                   <input type="text" class="form-control" id="username" value="<?= $username ?>" required readonly>
                 </div>

                 <div class="mb-3">
                   <label for="email" class="form-label">Email</label>
                   <input type="email" class="form-control" id="email"  value="<?= $email ?>" required readonly>
                 </div>

                 <?php } ?>
 
                 

                 <div class="mb-4">
                    <label for="opd" class="form-label">Opd</label>
                    <select class="form-select" name="opd" id="opd" aria-label="Default select example" required readonly>
                      <option value="" disabled="disabled">--Chose One--</option>
                      
                      
                      <?php
                        foreach($opds as $op){ 
                      ?>
                        
                        <option value="<?= $op->id ?>" <?= ($op->id==$opd)? 'selected':'' ?> ><?= $op->attributes->name ?></option>
                      <?php 
                          
                        } 
                      ?>
                    </select>
                  </div>

                  
                  <?php if($id ==''){ ?>

                  <hr class="mt-3" id="hr">
                    
                  <div class="mb-3" id="password_div">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" minlength="6" class="form-control" id="password" name="password" placeholder="Password.." value="" required>
                  <div class="ms-2 mt-1 text-sm" id="CheckPasswordStrong"></div>
                </div>

                <div class="mb-3" id="password2_div">
                  <label for="password2" class="form-label">Re-type Password</label>
                  <input type="password" class="form-control" id="password2" name="password2" placeholder="Re-type Password.." value="" required>
                  <div class="ms-2 mt-1 text-sm" id="CheckPasswordMatch"></div>
                </div>


                <script>
                   $("#btn_f_user").prop('disabled', true);
                  function checkPasswordMatch() {
                      var password = $("#password").val();
                      var confirmPassword = $("#password2").val();
                      if (password != confirmPassword) {
                          $("#btn_f_user").prop('disabled', true);
                          $("#CheckPasswordMatch").css('color', 'red');
                          $("#CheckPasswordMatch").html("Passwords does not match!");
                      } else {
                          var password = $("#password").val();
                          var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,30}$/;
                          if (password.match(decimal)) {
                            $("#btn_f_user").prop('disabled', false);
                            $("#CheckPasswordMatch").css('color', 'green');
                            $("#CheckPasswordMatch").html("Passwords match.");
                          } else {
                            $("#btn_f_user").prop('disabled', true);
                            $("#CheckPasswordMatch").css('color', 'red');
                            $("#CheckPasswordMatch").html("Passwords match. but password must be 8 to 30 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character");
                          }
                          
                      }
                  }

                  function checkPassword() {
                      var password = $("#password").val();
                      var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,30}$/;
                      if (password.match(decimal)) {
                        $("#btn_f_user").prop('disabled', false);
                        $("#CheckPasswordStrong").css('color', 'green');
                        $("#CheckPasswordStrong").html("You have strong password.");
                      } else {
                        $("#btn_f_user").prop('disabled', true);
                        $("#CheckPasswordStrong").css('color', 'red');
                        $("#CheckPasswordStrong").html("Password must be 8 to 30 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character");
                      }
                  }

                

                  $(document).ready(function () {
                    $("#password").keyup(checkPassword);
                    $("#password2").keyup(checkPasswordMatch);
                  });
              </script>
              
                 <?php } ?>
 

                </div>
                <div class="col col-md-8">
                 

                  
                  <div id="dangerzone">
                  <?php if($id !=''){ ?>
                  <hr>
                        <label class="form-label">Danger Zone</label>
                          <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()"><i class="fa fa-trash"></i> Delete</button>
                          </div>
                  <?php } ?>
                  </div>

                </div>
              </div>
            </div>
           

              
            </div>
          </div>
          </form>
        </div>
      </div>

      <script>
          function confirmDelete() {
          Swal.fire({
            icon: 'question',
            title: 'Are you sure?',
            text: "You will not be able to recover this user !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Save',
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              $.ajax({
                    url: "<?= base_url().SITE_URL?>user/delete",
                    type: "POST",
                    data: {
                        id: $("#id").val()
                    },
                    dataType: "html",
                    success: function (data) {
                      var response = JSON.parse(data);
                      console.log(response.status);
                      if(response.status==200){
                        Swal.fire({
                          icon:'success',
                          title: 'Done!',
                          text: "It was succesfully deleted!",
                          type: "success",
                          confirmButtonColor: "#11A789",
                          closeOnConfirm: true,
                          willClose: () => {
                            window.location.replace("<?= base_url().SITE_URL ?>user");
                          }
                        });
                      } else {
                        swal.fire("Error deleting!", "Please try again", "error");
                      }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal.fire("Error deleting!", "Please try again", "error");
                    }
                });
            }
          })
          }

          
        function redirecttourl(){
          window.location.replace("<?= base_url().SITE_URL ?>user");
        }

    </script>


<script>
    $(document).ready(function() {

			$('#f_user').on('submit', function(e) {
				e.preventDefault();
        $("#btn_f_user").prop('disabled', true);
        $("#btn_f_user").html('Saving..');
        var data = new FormData();
       

          data.append('data', jQuery('#f_user').serialize());


        jQuery.ajax({
          url: '<?= base_url().SITE_URL?>user/store',
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          method: 'POST',
          type: 'POST', // For jQuery < 1.9
          success: function(data){
            var response = JSON.parse(data);
            if(response.status==201){
              $("#username").prop('readonly', true);
                $("#username").removeAttr('name');
                $("#email").prop('readonly', true);
                $("#email").removeAttr('name');
                $("#password_div").remove();
                $("#password2_div").remove();
                $("#hr").remove();
              $("#btn_f_user").prop('disabled', false);
              $("#btn_f_user").html('<i class="fa fa-save"></i> Update');
              $.toast({
                  heading: 'Success',
                  text: "Success, New user created.",
                  showHideTransition: 'fade',
                  icon: 'success',
                  showHideTransition: 'plain',
                  position: 'top-left',
                  loader: true,
                })
                $("#id").val(response.data.id);
                if ($('#dangerzone').children().length < 1){
                   $('#dangerzone').append('<hr><label class="form-label">Danger Zone</label><div class="d-grid gap-2"><button type="button" class="btn btn-outline-danger" onclick="confirmDelete()"><i class="fa fa-trash"></i> Delete</button></div>');
                }
            } else if(response.status==200){
              $("#btn_f_user").prop('disabled', false);
              $("#btn_f_user").html('<i class="fa fa-save"></i> Update');
              $.toast({
                  heading: 'Success',
                  text: "Success, User updated.",
                  showHideTransition: 'fade',
                  icon: 'success',
                  showHideTransition: 'plain',
                  position: 'top-left',
                  loader: true,
                })
                $("#id").val(response.data.data.id);
            }else {
                $("#btn_f_user").prop('disabled', false);
                $("#btn_f_user").html('<i class="fa fa-save"></i> Save');
                $.toast({
                  heading: 'Error',
                  text: response.data.error.message,
                  showHideTransition: 'fade',
                  icon: 'error',
                  showHideTransition: 'plain',
                  position: 'top-left',
                  loader: true,
                })
            }
          }
      });
        
			});
		});
  </script>



      <?= $this->endSection() ?>



      
      
