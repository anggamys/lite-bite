<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lite Bite | Locations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/litebite_combined.css" />
</head>

<body>

    <?php include 'components/navbar.php'; ?>

    <div class="container text-center py-5">
        <h2 class="section-title">Find Our Locations</h2>
        <div class="location-nav d-flex justify-content-center flex-wrap gap-3 mt-4">
            <a href="#surabaya">Surabaya</a>
            <a href="#malang">Malang</a>
            <a href="#yogyakarta">Yogyakarta</a>
            <a href="#jabodetabek">Jabodetabek</a>
            <a href="#bali">Bali</a>
        </div>
    </div>

    <?php
    function renderLocationSection($id, $title, $locations)
    {
        echo "<section id='$id' class='location-section bg-light'>";
        echo "<div class='container'>";
        echo "<h3 class='text-center'>$title</h3>";
        echo "<div class='row g-4'>";
        foreach ($locations as $loc) {
            echo "<div class='col-md-6 col-lg-4'>
              <div class='location-card p-4 h-100'>
                <h5 class='fw-bold text-success mb-2'>{$loc['name']}</h5>
                <p class='mb-2'>{$loc['address']}</p>
                <p class='mb-1'><strong>Hours:</strong><br>{$loc['hours']}</p>
                <p><i class='bi bi-telephone-fill'></i>{$loc['phone']}</p>
                <a href='{$loc['map_url']}' class='btn btn-custom rounded-pill mt-2' target='_blank'>Get Direction</a>
              </div>
            </div>";
        }
        echo "</div></div></section>";
    }

    // -- SURABAYA LOCATIONS
    $surabaya = [
        ["name" => "Galaxy Mall 1", "address" => "Galaxy Mall 1, Lt 2, Kec. Mulyorejo, Surabaya", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
        ["name" => "PTC", "address" => "Foodcourt PTC, Pakuwon Mall, Surabaya", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
        ["name" => "San Antonio", "address" => "Jl. Kalisari Utara I No.81, Mulyorejo", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
        ["name" => "Citraland", "address" => "Telaga Raya International Village, Citraland, Surabaya", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
        ["name" => "MERR", "address" => "Jl. Raya Semampir No.49E, Sukolilo", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"]
    ];

    // -- MALANG LOCATIONS
    $malang = [
        ["name" => "Soekarno Hatta", "address" => "Jl. Simpang Coklat, Lowokwaru", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
        ["name" => "Mall Olympic Garden", "address" => "Jl. Kawi No.24, Klojen", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
        ["name" => "Malang Town Square", "address" => "Jl. Veteran No.2, Klojen", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
        ["name" => "Malang City Point", "address" => "Jl. Terusan Dieng No.32", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
        ["name" => "Mall Dinoyo City", "address" => "Jl. MT. Haryono No.195", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"]
    ];

    // -- YOGYAKARTA LOCATIONS
    $jogja = [
        ["name" => "Ambarrukmo Plaza", "address" => "Jl. Laksda Adisucipto No.80", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
        ["name" => "Malioboro Mall", "address" => "Jl. Mataram No.31", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
        ["name" => "Lippo Plaza Jogja", "address" => "Jl. Laksda Adisucipto No.32", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"]
    ];

    // -- JABODETABEK LOCATIONS
    $jabodetabek = [
        ["name" => "PIK", "address" => "Kamal Muara RT.7/RW.2, Jakarta Utara", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
        ["name" => "BSD City", "address" => "Jl. Simplicity Utama No.5", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
        ["name" => "Summarecon Bekasi", "address" => "Jl. Baru Perjuangan No.88M", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"],
        ["name" => "Bintaro Pondok Aren", "address" => "Bintaro Trade Centre A2/11", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"]
    ];

    // -- BALI LOCATIONS
    $bali = [
        ["name" => "Denpasar Barat", "address" => "Jl. Pura Demak No.69, Denpasar", "hours" => "Mon - Sun | 09.00AM - 10.00PM", "phone" => "0821-7907-6890", "map_url" => "#"]
    ];

    // Render sections
    renderLocationSection('surabaya', 'Surabaya', $surabaya);
    renderLocationSection('malang', 'Malang', $malang);
    renderLocationSection('yogyakarta', 'Yogyakarta', $jogja);
    renderLocationSection('jabodetabek', 'Jabodetabek', $jabodetabek);
    renderLocationSection('bali', 'Bali', $bali);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>