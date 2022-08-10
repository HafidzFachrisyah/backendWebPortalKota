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
        <div class="col-12">
          <div class="card mb-4">
    
                <div class="ps-3 pe-3 pt-3 text-right">
                  <button id="btnOutput" type="button" class="btn btn-info"><i class="fas fa-check-square"></i> Save</button>
                </div>
         
            <div class="card-body px-0 pt-0 pb-2">
              <div class="p-0" id="content">
                <!-- content -->
               

                <div class="container">
                  <div class="row pt-2">
                          <div class="col-md-6">
                              <div class="card mb-3">
                                  <div class="card-body">
                                      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">  

                                      <ul id="myEditor" class="sortableLists list-group">
                                        <p class="text-center">
                                            <img class="img-fluid" src="<?= base_url().SITE_URL ?>assets/img/loading.gif" width="40">
                                        </p>
                                      </ul>
                                  </div>
                              </div>
                              
                             
                              
                              
                             
                          </div>
                          <div class="col-md-6">
                              <div class="card border-primary mb-3">
                                  <div class="card-header bg-primary text-white ">Edit item</div>
                                  <div class="card-body">
                                      <form id="frmEdit" class="form-horizontal">
                                          <div class="form-group">
                                              <label for="text">Text</label>
                                              <div class="input-group input-group-sm">
                                                  <input type="text" class="form-control form-control-sm item-menu" name="text" id="text" placeholder="Text">
                                              </div>
                                              <input type="hidden" name="icon" class="item-menu">
                                          </div>
                                         
                                          <div class="form-group mt-0">
                                              <label for="text">Url</label>
                                              <input type="text" class="form-control form-control-sm item-menu"id="href" name="href" placeholder="URL">
                                              <div class="pl-2 pr-2">
                                              <a class="text-xs mr-3" href="#" data-toggle="modal" data-target="#categoriesModal">Get from categories</a>
                                              <a class="text-xs mr-3" href="#" data-toggle="modal" data-target="#pagesModal">Get from pages</a>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label for="target">Target</label>
                                              <select name="target" id="target" class="form-control form-control-sm item-menu">
                                                  <option value="_self">Self</option>
                                                  <option value="_blank">Blank</option>
                                                  <option value="_top">Top</option>
                                              </select>
                                          </div>
                                      </form>
                                  </div>
                                  <div class="card-footer">
                                      <button type="button" id="btnUpdate" class="btn btn-primary btn-sm" disabled><i class="fas fa-sync-alt"></i> Update</button>
                                      <button type="button" id="btnAdd" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

<!-- Modal -->
<div class="modal" id="categoriesModal" tabindex="-1" role="dialog" aria-labelledby="categoriesModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6>Choose category</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="categoriesClose">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
        <select class="custom-select" id="categoriesSelect">
            <option selected>Choose...</option>
            <option value="<?= FRONTEND_URL ?>berita">Berita</option>
            <?php foreach($categories as $ctgItem ) { ?>
              <option value="<?= FRONTEND_URL ?>berita/category/<?= $ctgItem->attributes->slug ?>"><?= $ctgItem->attributes->name ?></option>
            <?php } ?>
        </select>
        </div>
      </div>
      
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal" id="pagesModal" tabindex="-1" role="dialog" aria-labelledby="pagesModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6>Choose page</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="pagesClose">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
        <select class="custom-select" id="pagesSelect">
            <option selected>Choose...</option>
            <?php foreach($pages as $page ) { ?>
              <option value="<?= FRONTEND_URL ?>page/<?= $page->attributes->slug ?>"><?= $page->attributes->title ?></option>
            <?php } ?>
        </select>
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
      </div>




      <script>
      jQuery(document).ready(function () {
                /* =============== DEMO =============== */
                // menu items

                function httpGet(theUrl) {
                    var xmlHttp = new XMLHttpRequest();
                    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
                    xmlHttp.send( null );
                    return xmlHttp.responseText;
                }

                var url = "<?= base_url().SITE_URL ?>menu/getAllMenu";

                var rawmenu =  httpGet(url);

                const menuArray = rawmenu.split("<script type=");
                var arrayjson = menuArray[0];

                console.log(arrayjson);
                
                // sortable list options
                var sortableListOptions = {
                    placeholderCss: {'background-color': "#cccccc"}
                };

                var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions});
                editor.setForm($('#frmEdit'));
                editor.setUpdateButton($('#btnUpdate'));
               
                    editor.setData(arrayjson);
              

                $('#btnOutput').on('click', function () {
                    var str = editor.getString();
                    console.log(str);
                    var data = new FormData();

                    data.append('menu',str);

                  jQuery.ajax({
                    url: '<?= base_url().SITE_URL?>menu/store',
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
                            text: "Success, menu updated.",
                            showHideTransition: 'fade',
                            icon: 'success',
                            showHideTransition: 'plain',
                            position: 'top-left',
                            loader: true,
                          })
                        
                      } else {
                       
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

                $("#btnUpdate").click(function(){
                    editor.update();
                });

                $('#btnAdd').click(function(){
                    editor.add();
                });
                /* ====================================== */

                /** PAGE ELEMENTS **/
                $('[data-toggle="tooltip"]').tooltip();
                $.getJSON( "https://api.github.com/repos/davicotico/jQuery-Menu-Editor", function( data ) {
                    $('#btnStars').html(data.stargazers_count);
                    $('#btnForks').html(data.forks_count);
                });
            });

            $('#categoriesSelect').on('change', function() {
                // console.log(this.value);
                $('#href').val(this.value);
                $( "#categoriesClose" ).trigger( "click" );
            });


            $('#pagesSelect').on('change', function() {
                // console.log(this.value);
                $('#href').val(this.value);
                $( "#pagesClose" ).trigger( "click" );
            });

           

        </script>
    


      <?= $this->endSection() ?>

      
      
