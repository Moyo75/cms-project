<?php


function insert_categories()
{

    global $connection;

    if (isset($_POST["submit"])) {

        $cat_title = $_POST["cat_title"];
        if ($cat_title == "" || empty($cat_title)) {
            echo "<p class='alert alert-danger'>This field should not be empty.</p>";
        } else {
            // echo "$cat_title was submitted!";
            $query = "INSERT INTO categories(cat_title) VALUES ('$cat_title')";

            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die("<p class='alert alert-danger'>Query failed:</p>" . mysqli_error($connection));
            }
        }
    }
}

function findAllCategories()
{

    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = $row["cat_title"];
        $cat_id = $row["cat_id"];


        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
        echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategories()
{

    global $connection;

    if (isset($_GET["delete"])) {
        $the_cat_id = $_GET["delete"];

        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";

        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}


function confirmQuery($result)
{
    global $connection;

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }
}
