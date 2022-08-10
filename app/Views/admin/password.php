<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row">
        <div class="col-12">
          <form name="f_password" id="f_password" method="POST" enctype="multipart/form-data">
          <div class="card mb-4">
            
            <div class="card-body px-0 pt-0 pb-2 ps-3 pe-3">
              
           
            <div class="col col-12 col-md-5">
              <div class="mb-3 mt-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" minlength="6" class="form-control" id="password" name="password" placeholder="Password.." value="" required>
                <div class="ms-2 mt-1 text-sm" id="CheckPasswordStrong"></div>
              </div>
              <div class="mb-3">
                <label for="password2" class="form-label">Re-type Password</label>
                <input type="password" class="form-control" id="password2" name="password2" placeholder="Re-type Password.." value="" required>
                <div class="ms-2 mt-1 text-sm" id="CheckPasswordMatch"></div>
              </div>
            </div>


            <script>
              function checkPasswordMatch() {
                  var password = $("#password").val();
                  var confirmPassword = $("#password2").val();
                  if (password != confirmPassword) {
                      $("#btn_f_password").prop('disabled', true);
                      $("#CheckPasswordMatch").css('color', 'red');
                      $("#CheckPasswordMatch").html("Passwords does not match!");
                  } else {
                    $("#btn_f_password").prop('disabled', false);
                      $("#CheckPasswordMatch").css('color', 'green');
                      $("#CheckPasswordMatch").html("Passwords match.");
                  }
              }

              function checkPassword() {
                  var password = $("#password").val();
                  var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,30}$/;
                  if (password.match(decimal)) {
                    $("#btn_f_password").prop('disabled', false);
                    $("#CheckPasswordStrong").css('color', 'green');
                    $("#CheckPasswordStrong").html("You have strong password.");
                  } else {
                    $("#btn_f_password").prop('disabled', true);
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

            <div class="card-footer pt-0">

              
              <div class="row">
                <div class="col col-10 text-left">
                <div class="input-group text-left clearfix">
                      <button type="submit" id="btn_f_password" class="btn btn-info float-left" disabled><i class="fa fa-save"></i> Update</button>
                    </div>
                </div>
                <div class="col col-2 text-right clearfix">
                  
                </div>
              </div>

            </div>

          </div>
          </form>
        </div>
      </div>

      <script>
    $(document).ready(function() {

			$('#f_password').on('submit', function(e) {
				e.preventDefault();
        var data = new FormData();
        data.append('data', jQuery('#f_password').serialize());
        $("#btn_f_password").prop('disabled', true);
        $("#password").prop('disabled', true);
        $("#password2").prop('disabled', true);
        $("#btn_f_password").html('Saving..');



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
                  text: "Success, password updated. you will logout automatically, please re-login with new password !",
                  showHideTransition: 'fade',
                  icon: 'success',
                  showHideTransition: 'plain',
                  position: 'top-left',
                  loader: true,
                  afterHidden: function () {
                    window.location.replace("<?= base_url().SITE_URL.'logout' ?>");
                  }
                });
                $("#btn_f_password").prop('disabled', false);
                 $("#btn_f_password").html('<i class="fa fa-save"></i> Update');
                $("#password").prop('disabled', false);
                $("#password2").prop('disabled', false);
               
            } else {
                $("#btn_f_password").prop('disabled', false);
                $("#password").prop('disabled', false);
                $("#password2").prop('disabled', false);
                $("#btn_f_password").html('<i class="fa fa-save"></i> Update');
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

      
      