<?php
include 'config/koneksi.php';
$query = "SELECT * FROM menu_items";
$menu_items = $mysqli->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lite Bite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="assets/styles/litebite_combined.css" />
</head>

<body>
  <?php include 'components/navbar.php'; ?>

  <!-- Hero Banner -->
  <section class="hero-banner position-relative overflow-hidden">
    <img src="assets/images/aboutus2.png" alt="Banner Image"
      class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
      style="z-index: 0; opacity: 0.65;" />

    <div class="hero-content position-relative z-1 text-white text-center d-flex flex-column justify-content-center align-items-center" style="min-height: 400px; padding: 2rem;">
      <h1 class="fw-bold display-4">Welcome to Lite Bite</h1>
      <p class="lead">Where freshness meets flavor every day</p>
    </div>
  </section>

  <!-- Menu Cards -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">OUR MENU</h2>

      <?php if ($menu_items->num_rows > 0): ?>
        <div class="scrolling-wrapper d-flex px-2 overflow-auto">
          <?php while ($item = $menu_items->fetch_assoc()): ?>
            <div class="card mx-2 mb-4 shadow-sm border-0" style="min-width: 18rem; flex: 0 0 auto;">
              <div class="bg-white d-flex align-items-center justify-content-center" style="height: 200px; overflow: hidden;">
                <img src="<?= htmlspecialchars($item['image_url']) ?>"
                  alt="<?= htmlspecialchars($item['name']) ?>"
                  class="img-fluid"
                  style="max-height: 100%; max-width: 100%; object-fit: contain;">
              </div>
              <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-semibold text-primary"><?= htmlspecialchars($item['name']) ?></h5>
                <p class="card-text text-muted small flex-grow-1"><?= nl2br(htmlspecialchars($item['description'])) ?></p>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <div class="text-center py-5">
          <i class="bi bi-emoji-frown display-1 text-muted"></i>
          <h4 class="mt-3">No menu items found</h4>
          <p class="text-muted">Please check back later, we're updating our menu!</p>
        </div>
      <?php endif; ?>

      <div class="text-center mt-4">
        <a href="menu.php" class="btn btn-custom">VIEW ALL MENU</a>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>