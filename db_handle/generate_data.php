<?php
function tableExists($pdo, $table)
{
    // check table exits in database
    $tableExistsQuery = "SHOW TABLES LIKE '$table'";
    try {
        $tableExists = $pdo->query($tableExistsQuery)->rowCount() > 0;
        return $tableExists ? true : false;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
function operateTable($pdo, $table, $count, $status)
{
    // table operation
    $arr = [];
    $columns = [];

    for ($i = 1; $i <= $count; $i++) {
        $columnName = $_POST['column' . $i];
        $columns[] = "$columnName VARCHAR(50)";
        $arr[] = $columnName;
    }

    $columnsString = empty($columns) ? '' : implode(', ', $columns);

    if (!$status) {
        /* avoid empty columnString sql error */
        $sql = "CREATE TABLE $table (
                id INT PRIMARY KEY AUTO_INCREMENT";
        if (!empty($columnsString)) {
            $sql .= ", $columnsString";
        }
        $sql .= ")";
        if (!empty($columnsString)) {
            $pdo->exec($sql);
        } else {
            echo "No dynamic columns specified. Table creation skipped.";
        }
    } else {
        $addId = "ADD COLUMN $table.id INT PRIMARY KEY AUTO_INCREMENT,";
        $pdo->exec($addId);
        foreach ($arr as $columnName) {
            $sql = "ALTER TABLE $table
                ADD COLUMN $columnName VARCHAR(50)";
            $pdo->exec($sql);
        }
    }
}
function dataInsert($pdo, $table, $count, $times)
{
    echo "data inserts work";
    $faker = Faker\Factory::create();

    for ($i = 1; $i <= $times; $i++) {
        $data = [];  // store data from faker
        $columns = [];   // to use for faker e.g. $faker->name

        for ($j = 1; $j <= $count; $j++) {
            $columns[] = $_POST['column' . $j];
        }
        // check at backend
        foreach ($columns as $column) {
            if ($column === 'startdate' || $column === 'enddate') {
                $startYear = '2015-01-01';
                $endYear = date('Y-m-d');
                $data[] = $faker->dateTimeBetween($startYear, $endYear)->format('Y-m-d');
            } else if ($column === 'quantity' || $column === "number") {
                $data[] = $faker->numberBetween(1, 100);
            } else if ($column === "price") {
                $price = $faker->randomFloat(2, 0, 100000);
                $data[] = number_format($price, 2) . " MMK";
            } else if ($column === "bankAccountNumber") {
                $data[] = $faker->randomNumber(8);
            } else if ($column === "gender") {
                $data[] = $faker->randomElement(['Male', 'Female', 'Other']);
            } else if ($column === "age") {
                $data[] = $faker->numberBetween(15, 60);
            } else if ($column === "description") {
                $data[] = implode(' ', array_map(function () use ($faker) { return $faker->word; }, range(1, 20)));
            } else if ($column === "country") {
                $data[] = $faker->country;
            } else if ($column === "state") {
                $data[] = $faker->state;
            } else {
                $data[] = $faker->$column;
            }
            // Data exists like data [] = $faker->number, $faker->quantity, etc.
        }

        print_r($data);

        // Build the SQL query with placeholders
        $sql = "INSERT INTO $table (";
        $sql .= implode(', ', $columns); // Dynamic column names
        $sql .= ") VALUES (";
        $sql .= implode(', ', array_fill(0, count($columns), '?')); // Placeholders for values
        $sql .= ")";

        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);

        // Bind values to the prepared statement
        for ($j = 0; $j < count($data); $j++) {
            $stmt->bindParam($j + 1, $data[$j]);
        }

        // Execute the prepared statement to insert data
        $stmt->execute();
    }
}
