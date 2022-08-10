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
  <form name="f_sitesetting" id="f_sitesetting" method="POST" enctype="multipart/form-data">
        <div class="col-12">
          <div class="card mb-4">
    
                <div class="ps-3 pe-3 pt-3 text-right">
                  <button type="submit" id="btn_f_sitesetting" class="btn btn-info"><i class="fas fa-check-square"></i> Save</button>
                </div>
         
            <div class="card-body px-0 pt-0 pb-2">
              <div class="p-0" id="content">
                <!-- content -->
               

                <div class="container">
                  <div class="row pt-2">
                          <div class="col-12 col-md-8">
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">  
                                  
                                    <div class="card mb-2">
                                      <div class="card-body">
                                        <div class="input-group">
                                          <label class="form-label">Global</label>
                                        </div>
                                        <div class="input-group mb-1">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="min-width:130px;">Site Name</span>
                                          </div>
                                          <input type="text" class="form-control" style="padding-left:135px !important;"  id="siteName" name="siteName" placeholder="Site name..." value="<?= $global->siteName ?>" required>
                                        </div>
                                        <div class="input-group mb-2">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="min-width:130px;">Frontend Url</span>
                                          </div>
                                          <input type="text" class="form-control" style="padding-left:135px !important;"  id="frontEndUrl" name="frontEndUrl" placeholder="Front end url..." value="<?= $global->frontEndUrl ?>" required>
                                        </div>
                                      </div>
                                   </div>



                                   <div class="card mb-2">
                                      <div class="card-body">
                                        <div class="input-group">
                                          <label class="form-label">Header</label>
                                        </div>
                                        <div class="input-group mb-1">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="min-width:130px;">Title</span>
                                          </div>
                                          <input type="text" class="form-control" style="padding-left:135px !important;"  id="title" name="title" placeholder="Title..." value="<?= $header->title ?>" required>
                                        </div>
                                        <div class="input-group mb-2">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="min-width:130px;">Tagline</span>
                                          </div>
                                          <input type="text" class="form-control" style="padding-left:135px !important;"  id="tagline" name="tagline" placeholder="Tagline ..." value="<?= $header->tagline ?>" required>
                                        </div>
                                        <div class="input-group mb-2">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="min-width:130px;">Description</span>
                                          </div>
                                          <textarea class="form-control" style="padding-left:135px !important;" id="description-text" placeholder="Description ..." required><?= $header->description ?></textarea>
                                          <input type="hidden" id="description" name="description" value="<?= $header->description ?>" required>
                                        </div>
                                        <div class="input-group mb-2">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="min-width:130px;">Link</span>
                                          </div>
                                          <input type="text" class="form-control" style="padding-left:135px !important;"  id="link" name="link" placeholder="Link ..." value="<?= $header->link ?>" required>
                                        </div>
                                      </div>
                                   </div>


                                   <div class="card mb-2">
                                      <div class="card-body">
                                        <div class="input-group">
                                          <label class="form-label">Footer</label>
                                        </div>
                                        <div class="input-group mb-1">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="min-width:130px;">Email</span>
                                          </div>
                                          <input type="email" class="form-control" style="padding-left:135px !important;"  id="email" name="email" placeholder="Email..." value="<?= $footer->email ?>" required>
                                        </div>
                                        <div class="input-group mb-2">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="min-width:130px;">Telp</span>
                                          </div>
                                          <input type="text" class="form-control" style="padding-left:135px !important;"  id="telp" name="telp" placeholder="Telp ..." value="<?= $footer->telp ?>" required>
                                        </div>
                                        <div class="input-group mb-2">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="min-width:130px;">Fax</span>
                                          </div>
                                          <input type="text" class="form-control" style="padding-left:135px !important;"  id="fax" name="fax" placeholder="Fax ..." value="<?= $footer->fax ?>" required>
                                        </div>
                                        <div class="input-group mb-2">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="min-width:130px;">Alamat</span>
                                          </div>
                                          <textarea class="form-control" style="padding-left:135px !important;" id="alamat-text" placeholder="Alamat ..." required><?= $footer->alamat ?></textarea>
                                          <input type="hidden"  id="alamat" name="alamat" value="<?= $footer->alamat ?>" required>
                                        </div>
                                      </div>
                                   </div>
                                 
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

      $('#description-text').change(function() {
          $('#description').val($(this).val());
      });

      $('#alamat-text').change(function() {
          $('#alamat').val($(this).val());
      });

			$('#f_sitesetting').on('submit', function(e) {
				e.preventDefault();
        $("#btn_f_sitesetting").prop('disabled', true);
        $("#btn_f_sitesetting").html('Saving..');
        var data = new FormData();
        data.append('data', jQuery('#f_sitesetting').serialize());

        jQuery.ajax({
          url: '<?= base_url().SITE_URL?>sitesetting/store',
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          method: 'POST',
          type: 'POST', // For jQuery < 1.9
          success: function(data){
            var response = JSON.parse(data);
            if(response.status==200){
              $("#btn_f_sitesetting").prop('disabled', false);
              $("#btn_f_sitesetting").html('Save');
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
                $("#btn_f_sitesetting").prop('disabled', false);
                $("#btn_f_sitesetting").html('Save');
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

      
      
