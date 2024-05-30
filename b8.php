<!DOCTYPE html> 
<html> 
<head> 
    <title>Hotel Reservation System</title> 
</head> 
<body> 
    <h2>Hotel Reservation System</h2> 
    <h3>Insert Records</h3> 
    <form method="post" action="<?php echo 
htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
        <table> 
            <tr> 
                <td>Room Number:</td> 
                <td><input type="number" name="room_number" required></td> 
            </tr> 
            <tr> 
                <td>Room Type:</td> 
                <td><input type="text" name="room_type" required></td> 
            </tr> 
            <tr> 
                <td>Capacity:</td> 
                <td><input type="number" name="capacity" required></td> 
            </tr> 
            <tr> 
                <td>Status:</td> 
                <td> 
                    <select name="status" required> 
                        <option value="available">Available</option> 
                        <option value="booked">Booked</option> 
                    </select> 
                </td> 
            </tr> 
        </table> 
        <br> 
        <input type="submit" name="insert" value="Insert Record"> 
    </form> 
    <?php 
    $servername = "localhost"; 
    $username = "root"; 
    $password = "";  
    $database = "hotel_reservation";  
    $conn = new mysqli($servername, $username, $password, $database); 
    if ($conn->connect_error) { 
        die("Connection failed: " . $conn->connect_error); 
    } 
    if (isset($_POST['insert'])) { 
        $room_number = $_POST["room_number"]; 
        $room_type = $_POST["room_type"]; 
        $capacity = $_POST["capacity"]; 
        $status = $_POST["status"]; 
        $sql_insert = "INSERT INTO rooms (room_number, room_type, capacity, 
status) 
        VALUES ('$room_number', '$room_type', '$capacity', '$status')"; 
        if ($conn->query($sql_insert) === TRUE) { 
            echo "<script>alert('Record inserted 
successfully.');window.location.href = 'index.php';</script>"; 
        } else { 
            echo "<script>alert('Error: " . $sql_insert . "\\n" . $conn->error 
. "');window.location.href = 'index.php';</script>"; 
        } 
    } 
    ?> 
    <h3>Available Rooms</h3> 
    <?php 
    $sql_available = "SELECT * FROM rooms WHERE status = 'available'"; 
    $result_available = $conn->query($sql_available); 
    if ($result_available->num_rows > 0) { 
        echo "<table border='1'> 
        <tr> 
        <th>Room Number</th> 
        <th>Room Type</th> 
        <th>Capacity</th> 
        </tr>"; 
        while($row = $result_available->fetch_assoc()) { 
            echo "<tr> 
            <td>" . $row["room_number"] . "</td> 
            <td>" . $row["room_type"] . "</td> 
            <td>" . $row["capacity"] . "</td> 
            </tr>"; 
        } 
        echo "</table>"; 
    } else { 
        echo "No available rooms."; 
    } 
    ?> 
    <h3>Booked Rooms</h3> 
    <?php 
    $sql_booked = "SELECT * FROM rooms WHERE status = 'booked'"; 
    $result_booked = $conn->query($sql_booked); 
    if ($result_booked->num_rows > 0) { 
        echo "<table border='1'> 
        <tr> 
        <th>Room Number</th> 
        <th>Room Type</th> 
        <th>Capacity</th> 
        </tr>"; 
        while($row = $result_booked->fetch_assoc()) { 
            echo "<tr> 
            <td>" . $row["room_number"] . "</td> 
            <td>" . $row["room_type"] . "</td> 
            <td>" . $row["capacity"] . "</td> 
            </tr>"; 
        } 
        echo "</table>"; 
    } else { 
        echo "No booked rooms."; 
    } 
    $conn->close(); 
    ?> 
    <h3>Check-in</h3> 
    <form method="post" > 
        Room Number: <input type="number" name="room_number" required><br><br> 
        <input type="submit" name="check_in" value="Check-in"> 
    </form> 
    <h3>Check-out</h3> 
    <form method="post" > 
        Room Number: <input type="number" name="room_number" required><br><br> 
        <input type="submit" name="check_out" value="Check-out"> 
    </form> 
    <?php 
    $conn = new mysqli($servername, $username, $password, $database); 
    if (isset($_POST['check_in'])) { 
        $room_number = $_POST["room_number"]; 
        $sql_check_room = "SELECT * FROM rooms WHERE room_number = 
'$room_number' AND status = 'available'"; 
        $result_check_room = $conn->query($sql_check_room); 
        if ($result_check_room->num_rows == 1) { 
            $sql_check_in = "UPDATE rooms SET status = 'booked' WHERE 
room_number = '$room_number'"; 
            if ($conn->query($sql_check_in) === TRUE) { 
                echo "<script>alert('Room checked in 
successfully.');window.location.href = 'index.php';</script>"; 
            } else { 
                echo "<script>alert('Error: " . $sql_check_in . "\\n" . $conn->error . "');</script>"; 
            } 
        } else { 
            echo "<script>alert('Room is not available for check
in.');window.location.href = 'index.php';</script>"; 
        } 
    } 
    if (isset($_POST['check_out'])) { 
        $room_number = $_POST["room_number"]; 
        $sql_check_room = "SELECT * FROM rooms WHERE room_number = 
'$room_number' AND status = 'booked'"; 
        $result_check_room = $conn->query($sql_check_room); 
        if ($result_check_room->num_rows == 1) { 
            $sql_check_out = "UPDATE rooms SET status = 'available' WHERE 
room_number = '$room_number'"; 
            if ($conn->query($sql_check_out) === TRUE) { 
                echo "<script>alert('Room checked out 
successfully.');window.location.href = 'index.php';</script>"; 
            } else { 
                echo "<script>alert('Error: " . $sql_check_out . "\\n" . 
$conn->error . "');</script>"; 
            } 
        } else { 
            echo "<script>alert('Room is either not booked or does not 
exist.'); window.location.href = 'index.php';</script>"; 
 
        } 
    } 
    $conn->close(); 
    ?> 
</body> 
</html>
