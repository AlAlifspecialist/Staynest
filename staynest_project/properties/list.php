<?php
include("../config/db.php");

$search = $_GET['search'] ?? '';
$max_price = $_GET['max_price'] ?? '';

$sql = "SELECT * FROM properties WHERE 1";

if(!empty($search)){
    $sql .= " AND PropertyTitle LIKE '%$search%'";
}

if(!empty($max_price)){
    $sql .= " AND PricePerMonth <= $max_price";
}

$result = $conn->query($sql);
?>

<form method="GET">
    <input type="text" name="search" placeholder="Search property">
    <input type="number" name="max_price" placeholder="Max price">
    <button type="submit">Search</button>
</form>

<hr>

<?php
while($row = $result->fetch_assoc()){
    echo "<div>";
    echo "<h3>".$row['PropertyTitle']."</h3>";
    echo "<p>Type: ".$row['PropertyType']."</p>";
    echo "<p>Address: ".$row['Address']."</p>";
    echo "<p>Price: ".$row['PricePerMonth']." DKK</p>";
    echo "<p>Status: ".$row['AvailabilityStatus']."</p>";
    echo "<a href='../bookings/book.php?id=".$row['PropertyID']."'>Book</a>";
    echo "</div><hr>";
}
?>