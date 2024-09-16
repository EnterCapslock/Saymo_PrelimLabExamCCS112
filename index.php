<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
</head>
<body>
    <h1>Inventory</h1>

    <form action="process.php" method="post">
        <input type="text" name="search" placeholder="Search">
        <button type="submit">Search</button>
    </form>
    <br>

    <form action="process.php" method="post">
        <label for="inputName">Item</label>
        <input type="text" name="inputName" required>
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" min="1" required>
        <button type="submit" name="addItem">Add Item</button>
    </form>
    
    <h2>List of Items</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Item</th>
            <th>Quantity</th>
        </tr>

        <?php
        session_start(); 
        if (isset($_SESSION['inventory']) && !empty($_SESSION['inventory'])) {
            foreach ($_SESSION['inventory'] as $itemName => $quantity) {
                echo '<tr><td>' . htmlspecialchars($itemName) . '</td>
                          <td>' . htmlspecialchars($quantity) . '</td></tr>';
            }
        } else {
            echo '<tr><td colspan="2">No items in inventory</td></tr>';
        }
        ?>
    </table>

    <h2>Result</h2>
    <?php echo isset($_SESSION['result']) ? $_SESSION['result'] : ''; ?>
    <br>
    <form action="process.php" method="post">
        <button type="submit" name="clearResult">Clear Result</button>
    </form>

</body>
</html>
