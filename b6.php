<!DOCTYPE html> 
<html> 
<head> 
    <title>Customer Management System</title> 
    <style> 
        table { 
            border-collapse: collapse; 
            width: 100%; 
        } 
        th, td { 
            border: 1px solid #dddddd; 
            text-align: left; 
            padding: 8px; 
        } 
        th { 
            background-color: #f2f2f2; 
        } 
    </style> 
</head> 
<body> 
<h2>Customer Management System</h2> 
<button onclick="document.getElementById('addForm').style.display = 
'block'">Add Customer Information</button> 
<button onclick="document.getElementById('deleteForm').style.display = 
'block'">Delete Customer Records</button> 
<button onclick="document.getElementById('searchForm').style.display = 
'block'">Search for Particular Entries</button> 
<form id="sortForm" method="post" style="display: inline;"> 
    <input type="hidden" name="sort_and_display" value="true"> 
    <input type="submit" value="Sort Database and Display All Records"> 
</form> 
<form id="displayForm" method="post" style="display: inline;"> 
    <input type="hidden" name="display_all" value="true"> 
    <input type="submit" value="Display All Records"> 
</form> 
<div id="addForm" style="display: none;"> 
    <h3>Add Customer Information</h3> 
    <form method="post"> 
        <label for="customer_id">Customer ID:</label> 
        <input type="text" id="customer_id" name="customer_id" required><br> 
        <label for="customer_name">Customer Name:</label> 
        <input type="text" id="customer_name" name="customer_name" 
required><br> 
        <label for="item_purchased">Item Purchased:</label> 
        <input type="text" id="item_purchased" name="item_purchased" 
required><br> 
        <label for="mobile_number">Mobile Number:</label> 
        <input type="text" id="mobile_number" name="mobile_number" 
required><br> 
        <input type="submit" name="add_customer" value="Add Customer"> 
    </form> 
</div> 
<div id="deleteForm" style="display: none;"> 
    <h3>Delete Customer Records</h3> 
    <form method="post"> 
        <label for="customer_id_delete">Customer ID:</label> 
        <input type="text" id="customer_id_delete" name="customer_id" 
required><br> 
        <input type="submit" name="delete_customer" value="Delete Customer"> 
    </form> 
</div> 
<div id="searchForm" style="display: none;"> 
    <h3>Search for Particular Entries</h3> 
    <form method="post"> 
        <label for="customer_id_search">Customer ID:</label> 
        <input type="text" id="customer_id_search" name="customer_id" 
required><br> 
        <input type="submit" name="search_customer" value="Search Customer"> 
    </form> 
</div> 
</body> 
</html> 
<?php 
 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "customer_info"; 
$conn = new mysqli($servername, $username, $password, $database); 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
 
if (isset($_POST['add_customer'])) { 
    $customer_id = $_POST['customer_id']; 
    $customer_name = $_POST['customer_name']; 
    $item_purchased = $_POST['item_purchased']; 
    $mobile_number = $_POST['mobile_number']; 
 
    if (strlen($mobile_number) != 10 || !ctype_digit($mobile_number)) { 
        echo "<script>alert('Invalid mobile number');</script>"; 
    } else { 
        $sql = "INSERT INTO `customer`(`customer_id`, `customer_name`, `item_purchased`, `mobile_number`) VALUES ('$customer_id', '$customer_name', '$item_purchased', 
'$mobile_number')"; 
        if ($conn->query($sql) === TRUE) { 
            echo "<script>alert('Customer added successfully');</script>"; 
        } else { 
            echo "<script>alert('Error adding customer: " . $conn->error . 
"');</script>"; 
        } 
    } 
} 
 
if (isset($_POST['delete_customer'])) { 
    $customer_id = $_POST['customer_id']; 
    $sql = "DELETE FROM `customer` WHERE `customer_id`='$customer_id'"; 
    if ($conn->query($sql) === TRUE) { 
        if ($conn->affected_rows > 0) { 
            echo "<script>alert('Customer deleted successfully');</script>"; 
        } else { 
            echo "<script>alert('Error: Customer with ID " . $customer_id . " 
not found');</script>"; 
        } 
    } else { 
        echo "<script>alert('Error deleting customer: " . $conn->error . 
"');</script>"; 
    } 
} 
 
if (isset($_POST['search_customer'])) { 
    $customer_id = $_POST['customer_id']; 
    $sql = "SELECT * FROM `customer` WHERE `customer_id`='$customer_id'"; 
    $result = $conn->query($sql); 
    if ($result->num_rows > 0) { 
        echo "<table>"; 
        echo "<tr><th>Customer ID</th><th>Name</th><th>Item 
Purchased</th><th>Mobile Number</th></tr>"; 
        while ($row = $result->fetch_assoc()) { 
            echo "<tr>"; 
            echo "<td>" . $row['customer_id'] . "</td>"; 
            echo "<td>" . $row['customer_name'] . "</td>"; 
            echo "<td>" . $row['item_purchased'] . "</td>"; 
            echo "<td>" . $row['mobile_number'] . "</td>"; 
            echo "</tr>"; 
        } 
        echo "</table>"; 
    } else { 
        echo "<script>alert('No results found');</script>"; 
    } 
} 
 
if (isset($_POST['display_all'])) { 
    $sql = "SELECT * FROM customer"; 
    $result = $conn->query($sql); 
    if ($result->num_rows > 0) { 
        echo "<table>"; 
        echo "<tr><th>Customer ID</th><th>Name</th><th>Item 
Purchased</th><th>Mobile Number</th></tr>"; 
        while ($row = $result->fetch_assoc()) { 
            echo "<tr>"; 
            echo "<td>" . $row['customer_id'] . "</td>"; 
            echo "<td>" . $row['customer_name'] . "</td>"; 
            echo "<td>" . $row['item_purchased'] . "</td>"; 
            echo "<td>" . $row['mobile_number'] . "</td>"; 
            echo "</tr>"; 
        } 
        echo "</table>"; 
    } else { 
        echo "<script>alert('No results found');</script>"; 
    } 
} 
 
if (isset($_POST['sort_and_display'])) { 
    $sql = "SELECT * FROM customer ORDER BY customer_name"; 
    $result = $conn->query($sql); 
    if ($result->num_rows > 0) { 
        echo "<table>"; 
        echo "<tr><th>Customer ID</th><th>Name</th><th>Item 
Purchased</th><th>Mobile Number</th></tr>"; 
        while ($row = $result->fetch_assoc()) { 
            echo "<tr>"; 
            echo "<td>" . $row['customer_id'] . "</td>"; 
            echo "<td>" . $row['customer_name'] . "</td>"; 
            echo "<td>" . $row['item_purchased'] . "</td>"; 
            echo "<td>" . $row['mobile_number'] . "</td>";  
            echo "</tr>"; 
        } 
        echo "</table>"; 
    } else { 
        echo "<script>alert('No results found');</script>"; 
    } 
} 
$conn->close(); 
?>
