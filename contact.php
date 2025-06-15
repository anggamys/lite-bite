<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lite Bite | Contact</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/styles/litebite_combined.css">
</head>

<body>

  <?php include 'components/navbar.php'; ?>

  <!-- Contact Form Section -->
  <div class="form-bg" style="background-image: url('assets/images/bg2.jpg');">
    <div class="container py-5 content-wrapper">
      <h2 class="contact-title-wrapper text-center mb-4">Contact Us</h2>
      <div class="row justify-content-center">
        <div class="col-md-6 form-section">
          <form id="contactForm">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
              <label for="subject" class="form-label">Subject</label>
              <input type="text" class="form-control" id="subject" required>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-order w-100">Submit</button>
          </form>
          <div id="contactResponse" class="alert alert-success mt-4 d-none" role="alert">
            Thank you! Your message has been sent successfully.
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Marquee -->
  <div class="top-marquee">
    <div class="marquee-content">
      Nourish your body, delight your taste buds – healthy eating reimagined for modern lifestyles. Order now!
    </div>
  </div>

  <!-- Contact Info Section -->
  <div class="contact-footer text-center text-md-start">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-start">
      <div class="mb-4 mb-md-0 text-center text-md-start">
        <img src="assets/images/logo3.png" alt="Lite Bite Logo" style="height: 120px;">
      </div>

      <div class="mb-4 mb-md-0">
        <h5>CONNECT WITH US</h5>
        <p><i class="bi bi-instagram"></i> @Lite_Bite.id</p>
        <p><i class="bi bi-whatsapp"></i> 0812-78994-5299 (Customer Care)</p>
        <p><i class="bi bi-envelope"></i> green@litebite.id</p>
      </div>

      <div>
        <h5>ORDER ONLINE</h5>
        <div class="d-flex gap-3 justify-content-center justify-content-md-start mt-2">
          <img src="assets/images/grabfood.png" alt="GrabFood">
          <img src="assets/images/gofood.png" alt="GoFood">
          <img src="assets/images/shopeefood.png" alt="ShopeeFood">
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById("contactForm").addEventListener("submit", function(e) {
      e.preventDefault();
      document.getElementById("contactResponse").classList.remove("d-none");
      this.reset();
    });
  </script>
</body>

</html>