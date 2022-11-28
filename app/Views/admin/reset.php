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
                      <button type="submit" id="btn_f_user" class="btn btn-info float-right"><i class="fa fa-save"></i> Update</button>
                    </div>
                </div>
              </div>

            </div>
            <div class="card-body px-0 pt-0 pb-2 ps-3 pe-3">
              
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?>">
           

            

            <div class="mb-3">
              <div class="row">
                <div class="col col-md-8">

              

                  <div class="mb-3">
                   <label for="username" class="form-label">Username</label>
                   <input type="text" class="form-control" id="username" value="<?= $username ?>" required readonly>
                 </div>

 

                  
                 

                  <hr class="mt-3">
                    
                  <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" minlength="6" class="form-control" id="password" name="password" placeholder="Password.." value="" required>
                  <div class="ms-2 mt-1 text-sm" id="CheckPasswordStrong"></div>
                </div>

                <div class="mb-3">
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
                        $("#btn_f_user").prop('disabled', false);
                          $("#CheckPasswordMatch").css('color', 'green');
                          $("#CheckPasswordMatch").html("Passwords match.");
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
  var data = new FormData();
  data.append('data', jQuery('#f_user').serialize());
  $("#btn_f_user").prop('disabled', true);
  $("#password").prop('disabled', true);
  $("#password2").prop('disabled', true);
  $("#btn_f_user").html('Saving..');



  jQuery.ajax({
    url: '<?= base_url().SITE_URL?>user/password',
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    method: 'POST',
    type: 'POST', // For jQuery < 1.9
    success: function(data){
      var response = JSON.parse(data);
      if(response.status==200){
       
        $.toast({
            heading: 'Success',
            text: "Success, user password updated.",
            showHideTransition: 'fade',
            icon: 'success',
            showHideTransition: 'plain',
            position: 'top-left',
            loader: true
          });
          $("#btn_f_user").prop('disabled', false);
           $("#btn_f_user").html('<i class="fa fa-save"></i> Update');
          $("#password").prop('disabled', false);
          $("#password2").prop('disabled', false);
         
      } else {
          $("#btn_f_user").prop('disabled', false);
          $("#password").prop('disabled', false);
          $("#password2").prop('disabled', false);
          $("#btn_f_user").html('<i class="fa fa-save"></i> Update');
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



      
      
