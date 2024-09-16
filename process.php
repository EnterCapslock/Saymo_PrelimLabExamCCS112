<?php
session_start();

if (!isset($_SESSION['inventory'])) {
    $_SESSION['inventory'] = array();
}

if (!isset($_SESSION['result'])) {
    $_SESSION['result'] = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $searchName = trim($_POST['search']);
    if (isExist($searchName)) {
        $_SESSION['result'] = "<li>" . htmlspecialchars($searchName) . ": " . htmlspecialchars($_SESSION['inventory'][$searchName]) . "</li>";
    } else {
        $_SESSION['result'] = "<li>Product not found</li>";
    }
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addItem"])) {
    $itemName = trim($_POST["inputName"]);
    $quantity = (int)$_POST["quantity"];

    if (!isExist($itemName) && $quantity > 0) {
        $_SESSION['inventory'][$itemName] = $quantity;
        $_SESSION['result'] = "<li>Item added successfully.</li>";
    } else {
        $_SESSION['result'] = "<li>Item already exists.</li>";
    }
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["clearResult"])) {
    $_SESSION['result'] = ""; 
    header("Location: index.php");
    exit;
}

function isExist($itemName) {
    foreach ($_SESSION['inventory'] as $item => $quantity) {
        if ($item === $itemName) {
            return true;
        }
    }
    return false;
}
?>
