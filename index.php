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
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&display=swap" rel="stylesheet" />
</head>

<body>
  <?php include 'components/navbar.php'; ?>

  <!-- Hero Banner -->
  <section class="hero-banner position-relative overflow-hidden">
    <img src="assets/images/aboutus2.png" alt="Banner Image"
      class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
      style="z-index: 0; opacity: 0.45;" />

    <div class="hero-content position-relative z-1 text-white text-center d-flex flex-column justify-content-center align-items-center" style="min-height: 400px; padding: 2rem;">
      <h1 class="fw-bold display-4">Welcome to Lite Bite</h1>
      <p class="lead">Where freshness meets flavor every day</p>
    </div>
  </section>

  <!-- Menu Section -->
  <section class="py-5 bg-light" id="menu">
    <div class="container">
      <h2 class="text-center mb-5 menu-title">OUR MENU</h2>

      <?php if ($menu_items->num_rows > 0): ?>
        <div class="scrolling-wrapper px-2">
          <?php while ($item = $menu_items->fetch_assoc()): ?>
            <div class="menu-card bg-white shadow-sm" style="min-width: 300px;">
              <div class="text-center p-3">
                <img src="<?= htmlspecialchars($item['image_url']) ?>" 
                     alt="Picture of <?= htmlspecialchars($item['name']) ?>"
                     class="rounded-circle" 
                     style="width: 220px; height: 220px; object-fit: cover;"
                     onerror="this.src='assets/images/default-menu.jpg';">
              </div>
              <div class="p-4 text-center d-flex flex-column justify-content-start" style="min-height: 180px;">
                <h5 class="fw-bold" style="color: #2B321B;"><?= htmlspecialchars($item['name']) ?></h5>
                <p class="menu-description"><?= nl2br(htmlspecialchars($item['description'])) ?></p>
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

      <div class="text-center mt-5">
        <a href="menu.php" class="btn btn-custom">VIEW ALL MENU</a>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
