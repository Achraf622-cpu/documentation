<?php
require_once "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $category = $_POST['category'];
    $date_ajout = date("Y-m-d");

    $check = $db->prepare("INSERT INTO livres (titre, auteur, category, date_ajout) values (?,?,?,?)");
    $check->bind_param("ssss", $title, $auteur, $category, $date_ajout);

    if ($check->execute()) {
        echo "<div class='alert success'>User added successfully!</div>";
    } else {
        echo "<div class='alert error'>Error: Unable to add user.</div>";
    }

    $check->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"] {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .alert {
            margin-top: 10px;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }
        .alert.success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Add New Book</h1>

    <form method="POST">
        <input type="text" name="titre" placeholder="Title" required>
        <input type="text" name="auteur" placeholder="Author" required>
        <input type="text" name="category" placeholder="Category" required>

        <button type="submit">Add Book</button>
    </form>
</div>

</body>
</html>
