<?php
include_once '../../config/koneksi.php';

function getProductById($mysqli, $id)
{
    if (!is_numeric($id)) {
        return null;
    }

    $stmt = $mysqli->prepare("SELECT * FROM menu_items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->num_rows > 0 ? $result->fetch_assoc() : null;
    $stmt->close();

    return $product;
}
