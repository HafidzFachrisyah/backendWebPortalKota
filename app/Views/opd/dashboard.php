<?= $this->extend('opd/layout') ?>

<?= $this->section('content') ?>
      <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Post</p>
                    <h5 class="font-weight-bolder mb-0" id="totalPost">
                     <img class="img-fluid" src="<?= base_url().SITE_URL ?>assets/img/loading.gif" width="40">
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-custom shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Draft</p>
                    <h5 class="font-weight-bolder mb-0" id="totalDraftPost">
                     <img class="img-fluid" src="<?= base_url().SITE_URL ?>assets/img/loading.gif" width="40">
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-custom shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Publihed Post</p>
                    <h5 class="font-weight-bolder mb-0" id="totalPublishedPost">
                     <img class="img-fluid" src="<?= base_url().SITE_URL ?>assets/img/loading.gif" width="40">
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-custom shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="latestPost">
        <p class="text-center">
          <img class="img-fluid mt-3" src="<?= base_url().SITE_URL ?>assets/img/loading.gif" width="80">
        </p>
      </div>
          
      <script>
        $(window).ready(function(){
          $("#totalPost").load("<?= base_url().SITE_URL ?>dashboard/getAllPost");
          $("#totalDraftPost").load("<?= base_url().SITE_URL ?>dashboard/getAllDraftPost");
          $("#totalPublishedPost").load("<?= base_url().SITE_URL ?>dashboard/getAllPublishedPost");
          $("#latestPost").load("<?= base_url().SITE_URL ?>dashboard/getLatestPost");
        });
      </script>

      <?= $this->endSection() ?>

      
      