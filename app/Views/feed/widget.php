<?= $this->extend('feed/layout') ?>

<?= $this->section('content') ?>
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <tbody id="allPost">
                    <?php foreach($data as $post) { ?>
                     <?php #dd($post); ?>
                      <tr>
                        <td class="specifictd text-wrap ps-3 pe-3">
                          <a href="<?= FRONTEND_URL ?>view/<?= $post->attributes->slug ?>" target="_blank"><h6 class="mb-0 pb-0 text-md" ><?= $post->attributes->title ?></h6></a>
                          <p class="mt-0 text-sm pt-0 mb-0 pb-0"><?= date('d F Y',strtotime($post->attributes->updatedAt)) ?></p>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              
            </div>
          </div>
        </div>
      </div>


     

      <?= $this->endSection() ?>

      
      
