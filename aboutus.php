<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lite Bite | About Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/styles/litebite_combined.css" />
</head>

<body>

  <!-- Include Navbar -->
  <?php include 'components/navbar.php'; ?>

  <!-- Hero Banner -->
  <div class="container-fluid banner p-0">
    <img src="assets/images/aboutus1.png" alt="Lite Bite About Us Banner">
  </div>

  <!-- About Us & Team -->
  <section class="aboutus-section">
    <div class="container">

      <!-- About Us Content -->
      <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
          <img src="assets/images/aboutus2.png" alt="Lite Bite Dish" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-6">
          <h2 class="fw-bold mb-3">About Us</h2>
          <p>
            At <strong>Lite Bite</strong>, we’re passionate about crafting fresh, wholesome meals that
            spark joy and nourish the body. We combine quality ingredients with creative recipes to deliver
            food that’s both nutritious and irresistibly flavorful.
          </p>
          <p>
            Our cozy, welcoming spaces are designed to bring people together—whether you're
            catching up with friends, sharing lunch with family, or enjoying a moment of calm solo.
            We’re proud to serve with heart, care, and a sprinkle of flavor in every dish.
          </p>
        </div>
      </div>

      <!-- Our Team Section -->
      <div class="team-section text-center mt-5">
        <h2 class="fw-bold mb-4">Meet Our Team</h2>
        <div class="row justify-content-center">
          <!-- Team Member 1 -->
          <div class="col-md-4 d-flex flex-column align-items-center mb-4">
            <div class="icon-ourtim">
              <img src="assets/images/team1.png" alt="Ghabriella Auranizza Fransrico">
            </div>
            <h6>Ghabriella Auranizza Fransrico</h6>
            <p>Front-End Developer</p>
          </div>

          <!-- Team Member 2 -->
          <div class="col-md-4 d-flex flex-column align-items-center mb-4">
            <div class="icon-ourtim">
              <img src="assets/images/team2.jpg" alt="Dyah Inkud Daifatur Rahma">
            </div>
            <h6>Dyah Inkud Daifatur Rahma</h6>
            <p>Web Visual Designer</p>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer Banner -->
  <div class="container-fluid banner2 p-0">
    <img src="assets/images/aboutus3.png" alt="Lite Bite Experience">
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>