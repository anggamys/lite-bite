<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lite Bite | Payment</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7"
    crossorigin="anonymous">
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/styles/payment.css">
</head>

<body class="with-overlay">
  <div class="container">
    <h2 class="card-title fw-bold">Payment</h2>
    <!-- Alamat Pengiriman -->
    <div class="section">
      <div class="section-title fw-bold">Address</div>
      <div class="card row">
        <div>
          <p id="alamatDisplay">Jl. Contoh No.123, Surabaya</p>
        </div>
        <button class="btn-small" onclick="ubahAlamat()">Change Address</button>
      </div>
    </div>

    <!-- Catatan Pesanan -->
    <form id="paymentForm">
      <label for="name" style="font-weight: bold;">Name</label>
      <input type="text" id="name" required>

      <label for="email" style="font-weight: bold;">Email</label>
      <input type="email" id="email" required>

      <label for="telepon" style="font-weight: bold;">No. Telepon</label>
      <input type="tel" id="telepon" required>

      <div class="section mt-3">
        <div class="section-title" style="font-weight: bold;">Notes for Seller</div>
        <textarea id="catatanUmum" placeholder="Contoh: Tidak pakai sambal"
          rows="3"
          style="width:100%; border-radius: 8px; padding: 10px; border: 1px solid #ccc;"></textarea>
      </div>

      <label for="method" style="font-weight: bold;">Payment Method</label>
      <select id="method" required>
        <option value>-- Select --</option>
        <option value="transfer">Transfer Bank</option>
        <option value="ewallet">E-Wallet</option>
        <option value="cod">Cash On Delivery</option>
      </select>

      <!-- Menu Terkait -->
      <div class="section mt-3">
        <div class="section-title">Menu Terkait</div>
        <div class="menu-terkait">
          <div class="menu-terkait-item">
            <img src="assets/images/salad2.png"
              alt="Salad" />
            <p style="margin: 6px 0;">PROTEIN GARDEN DELIGHT</p>
            <small>Rp69.900</small>
          </div>
          <div class="menu-terkait-item">
            <img src="assets/images/smoothies5.png" alt="Wrap" />
            <p style="margin: 6px 0;">STRAW MATCHA SWIRL</p>
            <small>Rp39.900</small>
          </div>
          <div class="menu-terkait-item">
            <img src="assets/images/sandwich5.png" alt="Wrap" />
            <p style="margin: 6px 0;">ROASTED BEEF CLASSIC</p>
            <small>Rp79.900</small>
          </div>
          <div class="menu-terkait-item">
            <img src="assets/images/splash5.png"
              alt="Juice" />
            <p style="margin: 6px 0;">BEACH SORBET SPLASH</p>
            <small>Rp34.900</small>
          </div>
        </div>
      </div>

      <div class="summary" id="orderSummary">
        <strong>Order Summary:</strong>
        <ul id="itemList"></ul>
        <p>Total: <span id="totalPrice">Rp0</span></p>
      </div>

      <button type="submit">Payment</button>
    </form>
  </div>

  <!-- Popup -->
  <div class="popup" id="confirmationPopup">
    <div class="popup-content">
      <h3>Thank You!</h3>
      <p>Your order is being processed.</p>
      <button onclick="closePopup()">Close</button>
    </div>
  </div>

  <script>
    const form = document.getElementById("paymentForm");
    const itemList = document.getElementById("itemList");
    const totalPriceEl = document.getElementById("totalPrice");

    const popup = document.getElementById("confirmationPopup");

    // Load cart data from localStorage
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    let total = 0;

    cart.forEach(item => {
      const li = document.createElement("li");
      li.textContent = `${item.name} x ${item.quantity} = Rp${item.price * item.quantity}`;
      itemList.appendChild(li);
      total += item.price * item.quantity;
    });

    totalPriceEl.textContent = `Rp${total.toLocaleString()}`;

    form.addEventListener("submit", function(e) {
      e.preventDefault();
      // Di sini bisa validasi tambahan kalau mau
      popup.style.display = "flex";

      // Optional: Clear cart setelah bayar
      localStorage.removeItem("cart");
    });

    function closePopup() {
      popup.style.display = "none";
      window.location.href = "order.html"; // redirect balik ke menu
    }

    // Load alamat dari localStorage kalau ada
    const alamatDisplay = document.getElementById("alamatDisplay");
    const savedAlamat = localStorage.getItem("alamatPengiriman");
    if (savedAlamat) alamatDisplay.textContent = savedAlamat;

    function ubahAlamat() {
      const newAlamat = prompt("Masukkan alamat pengiriman:");
      if (newAlamat) {
        alamatDisplay.textContent = newAlamat;
        localStorage.setItem("alamatPengiriman", newAlamat);
      }
    }

    function lanjutPembayaran() {
      const catatan = document.getElementById("catatanUmum").value;
      localStorage.setItem("catatanGlobal", catatan);
      window.location.href = "pembayaran.html";
    }
  </script>
</body>

</html>