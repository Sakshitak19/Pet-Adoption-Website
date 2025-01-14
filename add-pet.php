<?php
include('db1.php'); // Include the database connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['petName'];
    $species = $_POST['species'];
    $nationality = $_POST['nationality'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    
    // Insert pet data into the database
    $sql = "INSERT INTO pets (name, species, nationality, size, price, email, contact, address, image)
            VALUES ('$name', '$species', '$nationality', '$size', '$price', '$email', '$contact', '$address', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "New pet added successfully";
        header("Location: user-pg.php"); // Redirect to pet gallery page after adding the pet
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 60px;
            background-color: #f9f9f9;
        }

        /* Navigation Bar */
        nav {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px 30px;
            font-size: 22px;
            font-weight: bold;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 100;
            height: 60px;
            line-height: 60px; 
        }

        nav .nav-links {
            display: flex;
            list-style: none;
        }

        nav .nav-links li {
            margin: 0 25px;
        }

        nav .nav-links li a {
            color: #000;
            transition: color 0.3s ease, text-decoration 0.3s ease;
            font-weight: bold;
            text-decoration: none;
        }

        nav .nav-links li a:hover {
            color: #f26a6a;
        }

       
        .container {
        margin: 20px 5%;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    form .form-group {
        flex: 1 1 calc(33% - 20px); /* Adjust to show 3 fields in a row */
        display: flex;
        flex-direction: column;
    }

    form input, form select, form textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    form textarea {
        height: 80px;
    }

    .row-gap {
        display: flex;
        justify-content: space-between;
        gap: 20px; /* Adjusts the gap between grouped fields */
        width: 100%;
    }

    .form-button {
        text-align: center;
        width: 100%;
    }

    .form-button button {
        padding: 8px 20px; /* Makes the button smaller */
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .form-button button:hover {
        background-color: #45a049;
    }
        h1 {
            color: #333;
        }

        .error {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div>
    <nav>
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="adoption.html">Adoption Process</a></li>
            <li><a href="PG.html">Pet Gallery</a></li>
            <li><a href="add-pet.php">Add pet</a></li>
            <li><a href="user-pg.php">User pet gallery</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="index.php">Login/Register</a></li>
        </ul>
    </nav>
</div><br><br><br>

<div class="container">
    <center><h1 style="color:orange">Add a Pet</h1></center><br><br>

    <form id="addPetForm" enctype="multipart/form-data" method="POST" onsubmit="return validateForm()">
        <!-- Row 1 -->
        <div class="form-group">
            <b><label for="petName">Pet Name:</label></b>
            <select id="petName" name="petName" required>
                <option value="">Select a Pet</option>
                <option value="Cat">Cat</option>
                <option value="Dog">Dog</option>
                <option value="Parrot">Parrot</option>
                <option value="Rabbit">Rabbit</option>
            </select>
        </div>

        <div class="form-group">
           <b><label for="species">Species:</label></b> 
            <input type="text" id="species" name="species" required>
        </div>

        <div class="form-group">
           <b> <label for="size">Size:</label></b>
            <select id="size" name="size" required>
                <option value="">Select Size</option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
            </select>
        </div>

        <!-- Row 2 -->
        <div class="row-gap">
            <div class="form-group">
               <b><label for="price">Price:</label></b> 
                <input type="number" id="price" name="price" required>
            </div>

            <div class="form-group">
                <b><label for="email">Email:</label></b>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
               <b> <label for="contact">Mobile Number:</label></b>
                <input type="text" id="contact" name="contact" pattern="^\d{10}$" required>
            </div>
        </div>

        <!-- Row 3 -->
        <div class="row-gap">
            <div class="form-group">
                <b><label for="address">Address:</label></b>
                <textarea id="address" name="address" required></textarea>
            </div>

            <div class="form-group">
                <b><label for="nationality">Nationality:</label></b>
                <input type="text" id="nationality" name="nationality" required>
            </div>

            <div class="form-group">
                <b><label for="image">Image:</label></b>
                <input type="file" id="image" name="image" required>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-button">
            <button type="submit">Add Pet</button>
        </div>
    </form>
</div>



<script>
    function validateForm() {
        let petName = document.getElementById("petName").value;

        if (petName === "") {
            alert("Please select a pet name.");
            return false;
        }

        return true;
    }
</script>


</body>
</html>
