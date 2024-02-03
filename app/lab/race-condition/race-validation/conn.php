<?php
  
    // connecting the database
    $conn = new PDO('sqlite:productsDB.sqlite3');

    // Setting connection attributes
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $query = "CREATE TABLE IF NOT EXISTS codes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        code INTEGER NOT NULL
    );";

    $conn->exec($query);
    
    
    // $query = "CREATE TABLE IF NOT EXISTS products (
    //     id INTEGER PRIMARY KEY AUTOINCREMENT,
    //     imageName TEXT NOT NULL,
    //     title TEXT NOT NULL,
    //     details TEXT NOT NULL,
    //     price INTEGER NOT NULL,
    //     isCart INTEGER NOT NULL
    // );";

    $query = "CREATE TABLE IF NOT EXISTS products (
        id INTEGER NOT NULL,
        imageName TEXT NOT NULL,
        title TEXT NOT NULL,
        details TEXT NOT NULL,
        price INTEGER NOT NULL,
        isCart INTEGER NOT NULL
    );";

    $conn->exec($query);

    $checkRowsQuery = "SELECT COUNT(*) FROM products;";
    $result = $conn->query($checkRowsQuery)->fetchColumn();
    
    if ($result != 3) {
        $deleteOldDataQuery = "DELETE FROM products;";
        $conn->exec($deleteOldDataQuery);
    
        $initialRowsQuery = "
            INSERT INTO products (id, imageName, title, details, price, isCart)
            VALUES 
                (1, 'yavuzlar.png', 'Yavuzlar Expert', 'Possibility to contact a yavuz expert for assistance.', 101.99, 0),
                (2, 'cat.jpg', 'Thief Cat', 'He stole 100 dollars to buy fish, do you want to help him?', 100, 0),
                (3, 'flag.png', 'Finish Flag', 'Here is the flag that will win you the race.', 149.99, 0);
        ";
    
        $conn->exec($initialRowsQuery);
    }
    
?>