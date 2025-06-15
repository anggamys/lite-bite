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
    <img src="assets/images/aboutus2.png" alt="Banner Image" class="w-100 h-100 object-fit-cover position-absolute top-0 start-0" style="z-index: 0; opacity: 0.65;" />

    <div class="hero-content position-relative z-1 text-white text-center d-flex flex-column justify-content-center align-items-center" style="min-height: 400px; padding: 2rem;">
      <h1 class="fw-bold display-4">Welcome to Lite Bite</h1>
      <p class="lead">Where freshness meets flavor every day</p>
    </div>
  </section>

  <!-- Menu Cards -->
  <section class="py-5">
    <div class="container text-center">
      <h2 class="mb-4">OUR MENU</h2>
    </div>

    <div class="scrolling-wrapper px-4">
      <?php while ($item = $menu_items->fetch_assoc()): ?>
        <div class="card mx-2 mb-4" style="width: 18rem; border: none; box-shadow: 0 6px 12px rgba(0,0,0,0.1);">
          <div style="background-color: #fff; height: 200px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <img src="<?= htmlspecialchars($item['image_url']) ?>"
              alt="<?= htmlspecialchars($item['name']) ?>"
              style="max-height: 100%; max-width: 100%; object-fit: contain;">
          </div>
          <div class="card-body">
            <h5 class="card-title fw-bold"><?= htmlspecialchars($item['name']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($item['description']) ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <div class="text-center mt-4">
      <a href="menu.php" class="btn btn-custom">VIEW ALL MENU</a>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>