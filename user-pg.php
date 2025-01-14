<?php
include('db1.php'); // Include the database connection

// Fetch all pets from the database
$sql = "SELECT * FROM pets";
$result = $conn->query($sql);

$pets = [];
if ($result->num_rows > 0) {
    // Fetch each pet and add to the array
    while($row = $result->fetch_assoc()) {
        $pets[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 60px;
            background-color:rgba(227, 219, 219, 0.74);
        }
        /* Navigation Bar */
        nav {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 15px 30px; /* Adjust padding as needed */
    font-size: 22px;
    font-weight: bold;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    position: fixed; /* Fixes the navbar to the viewport */
    top: 0; /* Ensures the navbar is at the top */
    left: 0;
    width: 100%; /* Makes the navbar span the full width of the page */
    z-index: 100; /* Ensures the navbar stays above other elements */
    height: 60px; /* Define the navbar height */
    line-height: 60px; 
}


  nav .nav-links {
    display: flex;
    list-style: none;
    opacity: 1;
    animation: slideInNavLinks 1s forwards 0.5s; /* Animation for links */
  }

  nav .nav-links li {
    margin: 0 25px;
  }
  nav .nav-links li a {
    color: #000; /* Set text color to dark black */
    transition: color 0.3s ease, text-decoration 0.3s ease;
    font-weight: bold;
    position: relative;
    text-decoration: none;
    
}


  nav .nav-links li a:hover {
    color: #f26a6a;
  }

  nav .nav-links li a::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #f26a6a;
    transform: scaleX(0);
    transform-origin: bottom right;
    transition: transform 0.3s ease-out;
  }

  nav .nav-links li a:hover::after {
    transform: scaleX(1);
    transform-origin: bottom left;
  }

        h1 {
            text-align: center;
            color: #333;
        }

        #petGallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .pet-card {
            padding: 15px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }

        .pet-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .pet-card h3 {
            margin: 10px 0;
            font-size: 1.2rem;
            color: #333;
        }

        .price {
            font-weight: bold;
            color: #4CAF50;
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
          <li><a href="#user-pg.php">User pet gallery</a></li>
          <li><a href="contact.html">Contact Us</a></li>
          <li><a href="index.php">Login/Register</a></li>
        </ul>
    
      </nav>
      
</div><br><br><br>
<div><h1>Pet Gallery</h1></div>

<!-- Pet gallery -->
<div id="petGallery">
    <?php
    // Display all pets from the database
    foreach ($pets as $pet) {
        echo "
        <div class='pet-card'>
            <img src='{$pet['image']}' alt='{$pet['name']}'>
            <h3>{$pet['name']}</h3>
            <p>{$pet['species']} | {$pet['nationality']} | {$pet['size']}</p>
            <p class='price'>Price: \${$pet['price']}</p>
        </div>";
    }
    ?>
</div>

</body>
</html>
