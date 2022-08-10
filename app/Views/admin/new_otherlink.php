<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>


<div class="row">
        <div class="col-12">
          <form name="f_otherlink" id="f_otherlink" method="POST" enctype="multipart/form-data">
          <div class="card mb-4">
            <div class="card-header pb-0">

              
              <div class="row">
                <div class="col col-10 text-left">
                  <a href="<?= base_url().SITE_URL?>otherlink"><i class="fa fa-arrow-left me-2"></i> Back</a>
                </div>
                <div class="col col-2 text-right clearfix">
                  <div class="input-group text-right clearfix">
                      <button type="submit" id="btn_f_otherlink" class="btn btn-info float-right"><i class="fa fa-save"></i> <?= ($id)?'Update':'Save'?></button>
                    </div>
                </div>
              </div>

            </div>
            <div class="card-body px-0 pt-0 pb-2 ps-3 pe-3">
              
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?>">
           

              
            <div class="mb-3">
              <div class="row">
                <div class="col-8 col-md-8">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama.." value="<?= $nama ?>" required>
                </div>
                <div class="col-8 col-md-8">
                  <label for="url" class="form-label">Url</label>
                  <input type="text" class="form-control" id="url" name="url" placeholder="Url.." value="<?= $url ?>" required>
                </div>
                <div class="col-8 col-md-8">

                  <hr>

                  <div class="">
                        <label for="created_at" class="form-label">Created at : </label>
                        <span id="created_at" class="ms-2 text-sm"><?= $created_at ?></span>
                  </div>

                  <div class="">
                        <label for="updated_at" class="form-label">Updated at : </label>
                        <span id="updated_at" class="ms-2 text-sm"><?= $updated_at ?></span>
                  </div>
                  
                  <div id="dangerzone">
                  <?php if($id !=''){?>
                  <hr>
                        <label class="form-label">Danger Zone</label>
                          <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-danger" onclick="confirmDeleteOtherLink()"><i class="fa fa-trash"></i> Delete</button>
                          </div>
                  <?php }?>
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
          function confirmDeleteOtherLink() {
          Swal.fire({
            icon: 'question',
            title: 'Are you sure?',
            text: "You will not be able to recover this link !",
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
                    url: "<?= base_url().SITE_URL?>otherlink/delete",
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
                            window.location.replace("<?= base_url().SITE_URL ?>otherlink");
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
          window.location.replace("<?= base_url().SITE_URL ?>otherlink");
        }

    </script>


<script>
    $(document).ready(function() {

			$('#f_otherlink').on('submit', function(e) {
				e.preventDefault();
        $("#btn_f_otherlink").prop('disabled', true);
        $("#btn_f_otherlink").html('Saving..');
        var data = new FormData();
        data.append('data', jQuery('#f_otherlink').serialize());

        jQuery.ajax({
          url: '<?= base_url().SITE_URL?>otherlink/store',
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          method: 'POST',
          type: 'POST', // For jQuery < 1.9
          success: function(data){
            var response = JSON.parse(data);
            if(response.status==200){
              $("#btn_f_otherlink").prop('disabled', false);
              $("#btn_f_otherlink").html('<i class="fa fa-save"></i> Update');
              $.toast({
                  heading: 'Success',
                  text: "Success, New link created.",
                  showHideTransition: 'fade',
                  icon: 'success',
                  showHideTransition: 'plain',
                  position: 'top-left',
                  loader: true,
                })
                $("#id").val(response.data.data.id);
                var d= new Date(response.data.data.attributes.updatedAt);
                $("#updated_at").html(d.getDate()+'-'+d.getMonth()+'-'+d.getFullYear()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds());
                if ($('#dangerzone').children().length < 1){
                   $('#dangerzone').append('<hr><label class="form-label">Danger Zone</label><div class="d-grid gap-2"><button type="button" class="btn btn-outline-danger" onclick="confirmDeleteOtherLink()"><i class="fa fa-trash"></i> Delete</button></div>');
                }
            } else {
                $("#btn_f_otherlink").prop('disabled', false);
                $("#btn_f_otherlink").html('<i class="fa fa-save"></i> Save');
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



      
      
