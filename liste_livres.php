<?php
require_once "db.php";

// Procedurale Methode
// $sql = "SELECT * FROM livres";
// $result = mysqli_query($conn, $sql);
// //FETCH assoc : (it gets the data in associative array form ['id' => 1, 'titre' => 'titre', 'auteur' => 'auteur', 'category' => 'category', 'date_ajout' => 'date_ajout', 'disponible' => 'disponible'])

// while ($row = mysqli_fetch_assoc($result)) {
//     echo $row['id'] . "<br>";
//     echo $row["titre"] ."<br>";
//     echo $row["auteur"] ."<br>";
//     echo $row["category"] ."<br>";
//     echo $row["date_ajout"] ."<br>";
//     echo $row["disponible"] ."<br>";
// }

// //FETCH array : (it gets the same result as FETCH assoc but gets the data in indexed array form [0,1,2,3,4,5])

// while ($row = mysqli_fetch_row($result)) {
//     echo $row[0] . "<br>";
//     echo $row[1] . "<br>";
//     echo $row[2] . "<br>";
//     echo $row[3] . "<br>";
//     echo $row[4] . "<br>";
//     echo $row[5] . "<br>";
// }


// mysqli_free_result($result);
// mysqli_close($db);


// POO Methode




require_once "db.php";


if ($db->connect_error) {
    die('Connection error: ' . $db->connect_error);
}


$check = $db->prepare("SELECT * FROM livres");
$check->execute();


$result = $check->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Books List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Date Added</th>
                <th>Available</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetching data as an associative array
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['titre'] . "</td>";
                echo "<td>" . $row['auteur'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['date_ajout'] . "</td>";
                echo "<td>" . $row['disponible'] ? 'Yes' : 'No' . "</td>";
                echo "</tr>";
            }
            
            // Reset the result pointer and fetch the data as a numeric array
            mysqli_data_seek($result, 0); // Reset pointer to the beginning of the result set

            //Fetch using row
            while ($row = mysqli_fetch_row($result)) {
                echo "<tr>";
                echo "<td>" . $row[0] . "</td>";
                echo "<td>" . $row[1] . "</td>";
                echo "<td>" . $row[2] . "</td>";
                echo "<td>" . $row[3] . "</td>";
                echo "<td>" . $row[4] . "</td>";
                echo "<td>" . $row[5] ? 'Yes' : 'No' . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php

$check->close();
$db->close();
?>

</body>
</html>
