<?php include("partials/header.php"); ?>

<section class="ftco-section">
  <div class="container">
    <div class="row">
      <?php foreach ($dishTypes as $dishType): ?>
        <div class="col-md-6 mb-5 pb-3">
          <h3 class="mb-5 heading-pricing ftco-animate"><?= htmlspecialchars($dishType['name']) ?></h3>
          <?php foreach ($topDishesByType[$dishType['id']] as $dish): ?>
            <div class="pricing-entry d-flex ftco-animate">
              <div class="desc pl-3">
                <div class="d-flex text align-items-center">
                  <h3><span><?= htmlspecialchars($dish['name']) ?></span></h3>
                  <span class="price"><?= htmlspecialchars($dish['price']) ?> Ft</span>
                </div>
                <div class="d-block">
                  <p><?= htmlspecialchars($dish['description']) ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="ftco-menu mb-5 pb-5">
  <div class="container">
    <div class="row d-md-flex">
      <div class="col-lg-12 ftco-animate p-md-5">
        <div class="row">
          <div class="col-md-12 nav-link-wrap mb-5">
            <div class="nav ftco-animate nav-pills justify-content-center" role="tablist">
              <?php foreach ($dishTypes as $i => $dishType): ?>
                <a class="nav-link <?= $i === 0 ? 'active' : '' ?>" data-toggle="pill" href="#tab-<?= $dishType['id'] ?>">
                  <?= htmlspecialchars($dishType['name']) ?>
                </a>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="col-md-12 d-flex align-items-center">
            <div class="tab-content ftco-animate">
              <?php foreach ($dishTypes as $i => $dishType): ?>
                <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="tab-<?= $dishType['id'] ?>">
                  <div class="row">
                    <?php foreach ($allDishesByType[$dishType['id']] as $dish): ?>
                      <div class="col-md-4 text-center">
                        <div class="menu-wrap">
                          <div class="text">
                            <h3><a href="#"><?= htmlspecialchars($dish['name']) ?></a></h3>
                            <p><?= htmlspecialchars($dish['description']) ?></p>
                            <p class="price"><span><?= htmlspecialchars($dish['price']) ?> Ft</span></p>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<?php include("partials/footer.php"); ?>
