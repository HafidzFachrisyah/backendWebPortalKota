<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row">
        <div class="col-12">
          <form name="f_profile" id="f_profile" method="POST" enctype="multipart/form-data">
          <div class="card mb-4">
            
            <div class="card-body px-0 pt-0 pb-2 ps-3 pe-3">
              
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $data->id ?>">
           
            <div class="col col-12 col-md-5">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email.." value="<?= $data->email ?>" readonly>
              </div>
              <div class="mb-3 mt-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username.." value="<?= $data->username ?>">
              </div>
            </div>
           

              
            </div>

            <div class="card-footer pt-0">

              
              <div class="row">
                <div class="col col-10 text-left">
                <div class="input-group text-left clearfix">
                      <button type="submit" id="btn_f_profile" class="btn btn-info float-left"><i class="fa fa-save"></i> Update</button>
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

			$('#f_profile').on('submit', function(e) {
				e.preventDefault();
        var data = new FormData();
        data.append('data', jQuery('#f_profile').serialize());
        $("#btn_f_profile").prop('disabled', true);
        $("#username").prop('disabled', true);
        $("#email").prop('disabled', true);
        $("#btn_f_profile").html('Saving..');



        jQuery.ajax({
          url: '<?= base_url().SITE_URL?>user/profile',
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
                  text: "Success, profile updated.",
                  showHideTransition: 'fade',
                  icon: 'success',
                  showHideTransition: 'plain',
                  position: 'top-left',
                  loader: true,
                });
                $("#btn_f_profile").prop('disabled', false);
                 $("#btn_f_profile").html('<i class="fa fa-save"></i> Update');
                $("#username").prop('disabled', false);
                $("#email").prop('disabled', false);
               
            } else {
                $("#btn_f_profile").prop('disabled', false);
                $("#username").prop('disabled', false);
                $("#email").prop('disabled', false);
                $("#btn_f_profile").html('<i class="fa fa-save"></i> Update');
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

      
      