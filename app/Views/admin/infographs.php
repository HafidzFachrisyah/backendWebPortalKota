<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              
              <div class="row">
                <div class="col col-8 text-left">
                  <a href="<?= base_url().SITE_URL?>infograph/editor" class="btn btn-info btn-sm"><i class="fa fa-plus me-2"></i> New Infograph</a>
                </div>
                <div class="col col-4 text-right">
                  
                    <div class="input-group input-group-sm">
                    </div>
                  
                </div>
              </div>

            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody id="allInfograph">
                    <tr>
                      <td colspan="5">
                        <img class="img-fluid mt-3" src="<?= base_url().SITE_URL ?>assets/img/loading.gif" width="80">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center" id="pageCount">
                  <li class="text-center">
                  <img class="img-fluid" src="<?= base_url().SITE_URL ?>assets/img/loading.gif" width="40">
                  </li>
                </ul>
              </nav>
              </div>
            </div>
          </div>
        </div>
      </div>


      <script>
        $(window).ready(function(){
          $("#allInfograph").load("<?= base_url().SITE_URL ?>infograph/getAllInfograph");
           $("#pageCount").load("<?= base_url().SITE_URL ?>infograph/getPageCount");
        });
        
      </script>

      <?= $this->endSection() ?>

      
      
