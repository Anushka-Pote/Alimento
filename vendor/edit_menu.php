<?php
session_start();
include 'partials/_dbconnect.php';
$rid = $_SESSION['r_id'];

// Check if the user is logged in or redirect to the login page
if (!isset($_SESSION['vendorloggedin']) || $_SESSION['vendorloggedin'] != true) {
  $login_status = false;
  header("location: vendor_login.php");
  exit;
}else{
  $login_status = true;

}
// Update the menu item if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $m_id = $_POST['m_id'];
    $m_name = $_POST['m_name'];
    //$m_description = $_POST['item_description'];
    $m_price = $_POST['m_price'];
    $m_type = $_POST['m_type'];

    $sql = "UPDATE `menu` SET `m_name` = '$m_name', 
            `m_price` = '$m_price', `m_type` = '$m_type' WHERE `m_id` = '$m_id'";
    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <!-- Bootstrap icons  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="main.css"> -->
    <link rel="stylesheet" href="../output.css">
    <style>
        body{
            max-width: 1140px;
            margin: auto;
            font-family: Arial, Helvetica, sans-serif;
        }
        .header{
            display: flex;
            justify-content: space-between;
            height: 10vh;
            margin: 10px 0;
            border-bottom: 2px solid maroon;
        }
        .header img{
            height: 100%;
        }
        .logout{
            height: 100%;
            display: flex;
            align-items: center;
        }
        .order-table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-table th,
        .order-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .order-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .veg{
            padding: 4px 12px;
            background: green;
            color: white;
            border-radius: 6px;
        }
        .nonveg{
            padding: 4px 12px;
            background: red;
            color: white;
            border-radius: 6px;
        }
        .menu-container{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn{
            padding: 10px 20px;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;

        }
        .btn:hover{
            color: black;
        }
        .update-form {
            position: absolute;
            margin-top: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .update-form input[type="text"],
        .update-form input[type="number"],
        .update-form select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .update-form input[type="submit"] {
            padding: 8px 16px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete{
            background-color: transparent;
            border: none;
            height: 2rem;
            width: 2rem;
        }
        .update{
            background-color: transparent;
            border: none;
            height: 2rem;
            width: 2rem;
        }
        .delete img, .update img{
            height: 90%;
            /* width: 100%; */
        }
        button:hover{
            cursor: pointer;
        }
        .deleteForm{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .update-form{
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .update-form input[type="submit"]:hover {
            background-color: #218838;  
        }
        .button-container{
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .close{
            position: absolute;
            background: transparent;
            top:10px;
            right: 10px;
            color: red;
            border: none;
        }
        .btn{
            padding: 10px 20px;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<nav
        class="hidden  lg:flex sm:max-w-xl md:max-w-2xl lg:max-w-5xl xl:max-w-7xl w-full items-center justify-between max-w-7xl mx-auto font-poppins py-4">
        <a href="index.php"><img src="../images/logo/logo.webp" alt="logo" class="w-36"></a>
        
        <div class="flex">

            <div class="mx-3">
                <?php if ($login_status == true) {
                    echo '<a href="vendor_logout.php" class="bg-red-500 hover:bg-red-600 transition-all ease-in-out duration-75 cursor-pointer w-max px-6 py-2 text-white rounded-full">Logout</a>';
                } else {
                    echo '<a href="user_login.php" class="bg-gray-900 hover:bg-gray-800 focus:border-white cursor-pointer w-max transition-all ease-in-out duration-75 px-6 py-2 text-white rounded-full">Login</a>';
                } ?>
            </div>

    </nav>

    <!-- nav for small device  -->
    <div class="flex items-center justify-between max-w-7xl mx-auto font-poppins bg-white py-3 px-5 lg:hidden">
        <a href="index.php"><img src="../images/logo/logo.webp" alt="logo" class="w-36 "></a>
        <i class="bi bi-list menu select-none text-3xl"></i>
    </div>
    <div class="bg-gray-200 w-full top-5 font-poppins overflow-hidden px-5 py-3 hidden lg:hidden mb-5" id="nav-items">
        <div class="flex flex-col gap-4">
            
            <div>
                <h2 class="text-base text-gray-400 mt-3">User actions</h2>
                <div class="h-[1px] bg-gray-300 w-full"></div>
            </div>
            <?php if ($login_status == true) {
                echo '<a href="vendor_logout.php" class="bg-red-500 hover:bg-red-600 transition-all ease-in-out duration-75 cursor-pointer w-max px-6 py-2 text-white rounded-full">Logout</a>';
            } else {
                echo '<a href="user_login.php" class="bg-gray-900 hover:bg-gray-800 focus:border-white cursor-pointer w-max transition-all ease-in-out duration-75 px-6 py-2 text-white rounded-full">Login</a>';
            }
            ?>
        </div>
    </div>
    <br>

    <div class="menu-container">
        <h1>
            Menu Information
        </h1>
        <div class="btn-container">
            <a href='add_menu.php'><button class="btn" style="background-color: #008080;">ADD</button></a>  
            <a href='home.php'><button class="btn" style="background-color: #FF8C00;">BACK</button></a> 
        </div>
    </div>


    <table class="order-table">
        <thead>
            <th>Item ID</th>
            <th>Item Name</th>
            <!-- <th>Item Description</th> -->
            <th>Item Price</th>
            <th>Item Category</th>
        </thead>

        <?php
        // Retrieve data from the menu table
        $sql = "SELECT * FROM `menu` WHERE `r_id` = '$rid'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['m_id'] . "</td>";
                echo "<td>" . $row['m_name'] . "</td>";
                //echo "<td>" . $row['item_description'] . "</td>";
                echo "<td>" . $row['m_price'] . "</td>";
                if($row['m_type'] == "Veg"){
                    echo "<td> <span class='veg'>" . $row['m_type'] . "</span></td>";
                } else {
                    echo "<td> <span class='nonveg'>" . $row['m_type'] . "</span></td>";
                }
            }
        } else {
            echo "<tr><td colspan='6'>ADD items in the menu to display here</td></tr>";
        }

    
        ?>
    </table>

    <h1>Edit Menu </h1>
    <table class="order-table">
        <tr>
            <th>Item ID</th>
            <th>Item Name</th>
            <!-- <th>Item Description</th> -->
            <th>Item Price</th>
            <th>Item Category</th>
            <th>Update Item</th>
        </tr>

        <?php
        // Retrieve data from the menu table
        $sql = "SELECT * FROM `menu` WHERE `r_id` = '$rid'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['m_id'] . "</td>";
                echo "<td>" . $row['m_name'] . "</td>";
                //echo "<td>" . $row['item_description'] . "</td>";
                echo "<td>" . $row['m_price'] . "</td>";
                echo "<td>" . $row['m_type'] . "</td>";

                // Adding a form to update the item
                echo "<td>";
                echo "<div class='button-container'>";
                echo "<button class='update' onclick=\"toggleUpdateForm('" . $row['m_id'] . "')\"><img src='https://img.icons8.com/?size=100&id=6697&format=png&color=000000'></button>";

                echo "<div id='updateForm" . $row['m_id'] . "' class='update-form' style='display: none;'>";
                echo "<button class='close' onclick=\"toggleUpdateForm('" . $row['m_id'] . "')\">X</button>";
                echo "<form action='edit_menu.php' method='post'>";
                echo "<input type='hidden' name='m_id' value='" . $row['m_id'] . "'>";
                echo "Name: <input type='text' name='m_name' value='" . $row['m_name'] . "'><br>";
                echo "Price: <input type='number' name='m_price' value='" . $row['m_price'] . "'><br>";
                echo "Category: <select name='m_type'>";
                echo "<option value='Veg' " . ($row['m_type'] === 'Veg' ? 'selected' : '') . ">Veg</option>";
                echo "<option value='Non-Veg' " . ($row['m_type'] === 'Non-Veg' ? 'selected' : '') . ">Non-Veg</option>";
                echo "</select><br>";
                echo "<input type='submit' value='Update'>";
                echo "</form>";
                echo "</div>";

                echo "<form action='delete_menu.php' class='deleteForm' method= 'post'>";
                echo "<input type='hidden' name='delete_item' value='" . $row['m_id'] . "'><br>";
                echo "<button type='submit' class='delete'> <img src='https://img.icons8.com/?size=100&id=1oFCDPb4GGqp&format=png&color=000000'> </button>";
                echo "</form>";
                echo "</div>";
                echo "</td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No items in the menu yet</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    <script>
        function toggleUpdateForm(id) {
            var form = document.getElementById('updateForm' + id);
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
    <script src="../menu.js"></script>
</body>
</html>
