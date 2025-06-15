<?php
include 'config/koneksi.php';

function renderMenuSection($mysqli, $categoryLabel, $categoryKey, $icon)
{
    echo "
    <div class='section-title d-flex align-items-center gap-2 mb-4 mt-5'>
        <i class='bi bi-$icon fs-3 text-success'></i>
        <h3 class='mb-0'>$categoryLabel</h3>
    </div>";

    $stmt = $mysqli->prepare("SELECT * FROM menu_items WHERE category = ?");
    $stmt->bind_param("s", $categoryKey);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "<div class='alert alert-warning text-center w-100'>
                <i class='bi bi-info-circle me-2'></i> No items available in <strong>$categoryLabel</strong> right now.
              </div>";
    } else {
        echo "<div class='row g-4'>";
        while ($item = $result->fetch_assoc()) {
            $productId = (int) $item['id'];
            echo "
            <div class='col-12 col-sm-6 col-lg-4'>
                <a href='product_detail.php?id=$productId' class='text-decoration-none text-dark'>
                    <div class='card h-100 shadow-sm border-0 hover-scale'>
                        <div class='ratio ratio-4x3 bg-white d-flex align-items-center justify-content-center'>
                            <img src='" . htmlspecialchars($item['image_url']) . "' 
                                class='img-fluid p-2 object-fit-contain' 
                                alt='" . htmlspecialchars($item['name']) . "'>
                        </div>
                        <div class='card-body d-flex flex-column'>
                            <h5 class='card-title text-primary fw-semibold'>" . htmlspecialchars($item['name']) . "</h5>
                            <p class='card-text flex-grow-1 text-muted small'>" . nl2br(htmlspecialchars($item['description'])) . "</p>
                            <div class='text-muted small mb-2'>
                                Carb: {$item['carb']}g | Protein: {$item['protein']}g | Fat: {$item['fat']}g
                            </div>
                            <span class='badge bg-success text-white px-3 py-2 align-self-start'>
                                Calories: {$item['calories']}
                            </span>
                        </div>
                    </div>
                </a>
            </div>";
        }
        echo "</div>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lite Bite | Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/styles/litebite_combined.css">
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <div class="container py-5">
        <div class="main-text text-center">
            Pure nourishment, crafted with care.<br>
            Fresh from nature, daily.
        </div>

        <?php
        renderMenuSection($mysqli, 'Salads & Wraps', 'salad', 'egg-fried');
        renderMenuSection($mysqli, 'Sandwiches', 'sandwich', 'stack');
        renderMenuSection($mysqli, 'Desserts', 'dessert', 'cup-straw');
        renderMenuSection($mysqli, 'Drinks', 'drink', 'cup');
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>