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
  <section class="banner">
    <video class="video-bg" autoplay muted loop playsinline>
      <source src="https://drive.google.com/uc?id=1abn_0ZROAjNp5EgNmOMYPj2ja0SXksdZ" type="video/mp4" />
    </video>
    <div class="konten-banner">
      <h1 class="fw-bold">Welcome to Lite Bite</h1>
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
        <div class="card mx-2 mb-4" style="width: 18rem;">
          <img src="<?= htmlspecialchars($item['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['name']) ?>" style="object-fit: cover; height: 200px;">
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