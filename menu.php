<?php
include 'config/koneksi.php';

function renderMenuSection($mysqli, $categoryLabel, $categoryKey, $icon)
{
    echo "<div class='section-title d-flex align-items-center gap-2 mb-4 mt-5'>
            <i class='bi bi-$icon fs-3 text-success'></i>
            <h3 class='mb-0'>$categoryLabel</h3>
          </div>";

    echo "<div class='row g-4'>";

    $stmt = $mysqli->prepare("SELECT * FROM menu_items WHERE category = ?");
    $stmt->bind_param("s", $categoryKey);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($item = $result->fetch_assoc()) {
        $productId = (int) $item['id'];
        echo "
        <div class='col-lg-4 col-md-6'>
            <a href='product_detail.php?id=$productId' class='text-decoration-none text-dark'>
                <div class='card h-100 shadow-sm border-0'>
                    <img src='" . htmlspecialchars($item['image_url']) . "' class='card-img-top' alt='" . htmlspecialchars($item['name']) . "' style='object-fit: cover; height: 200px;'>
                    <div class='card-body d-flex flex-column'>
                        <h5 class='card-title text-primary fw-semibold'>" . htmlspecialchars($item['name']) . "</h5>
                        <p class='card-text flex-grow-1'>" . nl2br(htmlspecialchars($item['description'])) . "</p>
                        <div class='text-muted small mb-2'>
                            Carb: {$item['carb']}g | Protein: {$item['protein']}g | Fat: {$item['fat']}g
                        </div>
                        <div class='badge bg-success text-white px-3 py-2 align-self-start'>Calories: {$item['calories']}</div>
                    </div>
                </div>
            </a>
        </div>";
    }

    echo "</div>";
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
        <div class="main-text">
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