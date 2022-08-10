<?= $this->extend('admin/layout') ?>


<?= $this->section('content') ?>

<script src="<?= base_url().SITE_URL ?>assets/js/jquery-menu-editor.js"></script>

<style type="text/css">
            .container { margin: 5px auto; }
        body { background-color:#fafafa;}
ol.example li.placeholder:before { position: absolute; }

.list-group-item > div { margin-bottom: 5px; }

.list-group-item > div { margin-right:15px !important;}
</style>



<div class="row">
  <form name="f_medialink" id="f_medialink" method="POST" enctype="multipart/form-data">
        <div class="col-12">
          <div class="card mb-4">
    
                <div class="ps-3 pe-3 pt-3 text-right">
                  <button type="submit" id="btn_f_medialink" class="btn btn-info"><i class="fas fa-check-square"></i> Save</button>
                </div>
         
            <div class="card-body px-0 pt-0 pb-2">
              <div class="p-0" id="content">
                <!-- content -->
               

                <div class="container">
                  <div class="row pt-2">
                          <div class="col-12 col-md-8">
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">  
                                  <?php foreach($mediaLink as $link){  ?>
                                    <div class="card mb-2">
                                      <div class="card-body">
                                        <div class="input-group">
                                          <label class="form-label"><?= $link->name ?></label>
                                        </div>
                                        <div class="input-group mb-1">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="min-width:75px;">Label</span>
                                          </div>
                                          <input type="text" class="form-control" style="padding-left:80px !important;"  id="label-<?= $link->id ?>" name="label-<?= $link->id ?>" placeholder="label..." value="<?= $link->label ?>" required>
                                        </div>
                                        <div class="input-group mb-2">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="min-width:75px;">Url</span>
                                          </div>
                                          <input type="text" class="form-control" style="padding-left:80px !important;"  id="url-<?= $link->id ?>" name="url-<?= $link->id ?>" placeholder="label..." value="<?= $link->url ?>" required>
                                        </div>
                                      </div>
                                   </div>
                                  <?php } ?>
                                 
                          </div>
                      </div>
                  </div>


                <!-- end content -->

              </div>
              <div>
              </div>
            </div>
          </div>
        </div>
      </form>
      </div>


      <script>
    $(document).ready(function() {

			$('#f_medialink').on('submit', function(e) {
				e.preventDefault();
        $("#btn_f_medialink").prop('disabled', true);
        $("#btn_f_medialink").html('Saving..');
        var data = new FormData();
        data.append('data', jQuery('#f_medialink').serialize());

        jQuery.ajax({
          url: '<?= base_url().SITE_URL?>medialink/store',
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          method: 'POST',
          type: 'POST', // For jQuery < 1.9
          success: function(data){
            var response = JSON.parse(data);
            if(response.status==200){
              $("#btn_f_medialink").prop('disabled', false);
              $("#btn_f_medialink").html('Save');
              $.toast({
                  heading: 'Success',
                  text: "Success, Social Media link updated.",
                  showHideTransition: 'fade',
                  icon: 'success',
                  showHideTransition: 'plain',
                  position: 'top-left',
                  loader: true,
                })
            } else {
                $("#btn_f_medialink").prop('disabled', false);
                $("#btn_f_medialink").html('Save');
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

      
      
