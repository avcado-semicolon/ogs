<?php
include '/xampp/htdocs/dash/connection/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get action and table name from the form
    $action = $_POST["action"];
    $table_name = $_POST["table_name"];

    if ($action === "create") {
        // SQL to create the table with specified columns
        $sql = "CREATE TABLE $table_name (
            ID INT PRIMARY KEY,
            Picture VARCHAR(255),
            Fullname VARCHAR(255),
            Age INT,
            Gender VARCHAR(10),
            Section VARCHAR(20),
            Grade_level VARCHAR(10),
            Teacher VARCHAR(255)
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table $table_name created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    } elseif ($action === "drop") {
        // Check if the table exists before attempting to drop it
        $check_table_sql = "SHOW TABLES LIKE '$table_name'";
        $table_exists = $conn->query($check_table_sql)->num_rows > 0;

        if ($table_exists) {
            // SQL to drop the table
            $sql = "DROP TABLE $table_name";

            if ($conn->query($sql) === TRUE) {
                echo "Table $table_name dropped successfully";
            } else {
                echo "Error dropping table: " . $conn->error;
            }
        } else {
            echo "Table $table_name does not exist";
        }
    } elseif ($action === "rename") {
        // Check if the table exists before attempting to rename it
        $check_table_sql = "SHOW TABLES LIKE '$table_name'";
        $table_exists = $conn->query($check_table_sql)->num_rows > 0;

        if ($table_exists) {
            // Get new table name for renaming
            $new_table_name = $_POST["new_table_name"];

            // SQL to rename the table
            $sql = "ALTER TABLE $table_name RENAME TO $new_table_name";

            if ($conn->query($sql) === TRUE) {
                echo "Table $table_name renamed to $new_table_name successfully";
            } else {
                echo "Error renaming table: " . $conn->error;
            }
        } else {
            echo "Table $table_name does not exist";
        }
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create/Drop/Rename Table Form</title>
</head>
<body>
    <h2>Create/Drop/Rename Table</h2>
    <form action="create_table.php" method="post">
        <label for="action">Action:</label>
        <select id="action" name="action" required>
            <option value="create">Create</option>
            <option value="drop">Drop</option>
            <option value="rename">Rename</option>
        </select>
        <br>
        <label for="table_name">Table Name:</label>
        <input type="text" id="table_name" name="table_name" required>
        <br>

        <!-- Additional field for rename action -->
        <div id="rename-field" style="display: none;">
            <label for="new_table_name">New Table Name:</label>
            <input type="text" id="new_table_name" name="new_table_name">
            <br>
        </div>

        <button type="submit">Submit</button>
    </form>

    <script>
        // Show/hide the new table name field based on the selected action
        document.getElementById('action').addEventListener('change', function() {
            var renameField = document.getElementById('rename-field');
            if (this.value === 'rename') {
                renameField.style.display = 'block';
            } else {
                renameField.style.display = 'none';
            }
        });
    </script>
</body>
</html>
