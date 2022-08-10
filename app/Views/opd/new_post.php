<?= $this->extend('opd/layout') ?>

<?= $this->section('content') ?>

<script type="text/javascript">
    const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.withCredentials = false;
    xhr.open('POST', '<?= base_url().SITE_URL ?>post/upload');
    
    xhr.upload.onprogress = (e) => {
        progress(e.loaded / e.total * 100);
    };
    
    xhr.onload = () => {
       
        if (xhr.status === 403) {
            reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
            return;
        }
      
        if (xhr.status < 200 || xhr.status >= 300) {
            reject('HTTP Error: ' + xhr.status);
            return;
        }
      
        let text = xhr.responseText;
        const myArray = text.split("<script");
        let word = myArray[0];
        
        console.log(text);
      
        const json = JSON.parse(word);
        // console.log(json);
        // const json = JSON.parse( xhr.responseText );
      
        if (!json || typeof json.location != 'string') {
            reject('Invalid JSON: ' + xhr.responseText);
            return;
        }
      
        resolve(json.location);
    };
    
    xhr.onerror = () => {
      reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
    };
    
    const formData = new FormData();
    formData.append('file', blobInfo.blob(), blobInfo.filename());
    
    xhr.send(formData);
});

		tinymce.init({
	        selector: 'textarea#tinymce',
	        plugins: 'link image code',
          toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
	        images_upload_url: '<?= base_url().SITE_URL ?>post/upload',
          default_link_target: '_blank',
          images_upload_handler: image_upload_handler_callback
	    });

	
	</script>

<div class="row">
        <div class="col-12">
          <form name="f_post" id="f_post" method="POST" enctype="multipart/form-data">
          <div class="card mb-4">
            <div class="card-header pb-0">

              
              <div class="row">
                <div class="col col-10 text-left">
                  <a href="<?= base_url().SITE_URL?>post"><i class="fa fa-arrow-left me-2"></i> Back</a>
                </div>
                <div class="col col-2 text-right clearfix">
                  <div class="input-group text-right clearfix">
                      <button type="submit" id="btn_f_post" class="btn btn-info float-right"><i class="fa fa-save"></i> <?= ($id)?'Update':'Save'?></button>
                    </div>
                </div>
              </div>

            </div>
            <div class="card-body px-0 pt-0 pb-2 ps-3 pe-3">
              
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?>">
           

            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Title.." value="<?= $title ?>" required>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description.." required><?= $description ?></textarea>
            </div>
            <div class="mb-3">
              <div class="row">
                <div class="col col-md-8">
                  <label for="tinymce" class="form-label">Content</label>
                  <textarea class="form-control" id="tinymce" name="content" rows="9" placeholder="Content.."><?= $content ?></textarea>
                </div>
                <div class="col col-md-4">
                  <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" name="category" id="category" aria-label="Default select example" required readonly>
                      <option value="" disabled="disabled">--Chose One--</option>
    
                      <?php
                        foreach($categories as $ctg){ 
                          if(($ctg->id==7) OR ($ctg->id==9)) {
                      ?>
                        
                        <option value="<?= $ctg->id ?>" <?= ($ctg->id==$category->id)? 'selected':'' ?> ><?= $ctg->attributes->name ?></option>
                      <?php 
                          }
                        } 
                      ?>
                    </select>
                  </div>

                  <div>
                     
                        <img class="img-thumbnail" id="cover-thumbnail" src="<?= API_SITE.$image->attributes->url?>">
            
                      <input name="cover-default" id="cover-default" type="hidden" value="<?= $image->id?>">
                  </div>

                  <div class="mb-3">
                      <label for="cover" class="form-label">Cover Image</label>
                      <input class="form-control" name="cover" id="cover" type="file" accept=".jpg,.jpeg,.png" onchange="document.getElementById('cover-thumbnail').src = window.URL.createObjectURL(this.files[0])">
                      <input name="cover-default" id="cover-default" type="hidden" value="<?= $image->id?>">
                  </div>

                  <div class="form-check form-switch mb-3">
                    <input class="form-check-input" name="published" type="checkbox" id="flexSwitchCheckDefault" <?= ($published)?'checked':'' ?>>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Published</label>
                  </div>

                  <hr>

                  <div class="">
                        <label for="created_at" class="form-label">Created at : </label>
                        <span id="created_at" class="ms-2 text-sm"><?= $created_at ?></span>
                  </div>

                  <div class="">
                        <label for="updated_at" class="form-label">Updated at : </label>
                        <span id="updated_at" class="ms-2 text-sm"><?= $updated_at ?></span>
                  </div>

                  
                  <div>
                        <label for="author" class="form-label">Author : </label>
                        <span id="author" class="ms-2 text-sm"><?= $author ?></span>
                  </div>

                  <div class="mb-3">
                        <label for="author" class="form-label">Opd : </label>
                        <span id="author" class="ms-2 text-sm"><?= $opd ?></span>
                  </div>

                  
                  <div id="dangerzone">
                  <?php if($id !=''){?>
                  <hr>
                        <label class="form-label">Danger Zone</label>
                          <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()"><i class="fa fa-trash"></i> Delete</button>
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
          function confirmDelete() {
          Swal.fire({
            icon: 'question',
            title: 'Are you sure?',
            text: "You will not be able to recover this article !",
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
                    url: "<?= base_url().SITE_URL?>post/delete",
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
                            window.location.replace("<?= base_url().SITE_URL ?>post");
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
          window.location.replace("<?= base_url().SITE_URL ?>post");
        }

    </script>


<script>
    $(document).ready(function() {

			$('#f_post').on('submit', function(e) {
				e.preventDefault();
        $("#btn_f_post").prop('disabled', true);
        $("#btn_f_post").html('Saving..');
        var data = new FormData();
        jQuery.each(jQuery('#cover')[0].files, function(i, file) {
            data.append('cover-'+i, file);
        });

          data.append('data', jQuery('#f_post').serialize());
          data.append('content', tinyMCE.get('tinymce').getContent());


        jQuery.ajax({
          url: '<?= base_url().SITE_URL?>post/store',
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          method: 'POST',
          type: 'POST', // For jQuery < 1.9
          success: function(data){
            var response = JSON.parse(data);
            if(response.status==200){
              $("#btn_f_post").prop('disabled', false);
              $("#btn_f_post").html('<i class="fa fa-save"></i> Update');
              $.toast({
                  heading: 'Success',
                  text: "Success, New ariticle posted.",
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
                   $('#dangerzone').append('<hr><label class="form-label">Danger Zone</label><div class="d-grid gap-2"><button type="button" class="btn btn-outline-danger" onclick="confirmDelete()"><i class="fa fa-trash"></i> Delete</button></div>');
                }
            } else {
                $("#btn_f_post").prop('disabled', false);
                $("#btn_f_post").html('<i class="fa fa-save"></i> Save');
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



      
      
