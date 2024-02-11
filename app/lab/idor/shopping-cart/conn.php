<?php
    // connecting the database
    $conn = new PDO('sqlite:productsDB.sqlite3');

    // Setting connection attributes
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Code table
    // $query = "CREATE TABLE IF NOT EXISTS codes (
    //     id INTEGER PRIMARY KEY AUTOINCREMENT,
    //     code INTEGER NOT NULL
    // );";
    // $conn->exec($query);

    
    // Temp Table {Balance,Etc}
    $query = "CREATE TABLE IF NOT EXISTS temp (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        balance INTEGER NOT NULL
    );";

    $conn->exec($query);
    
    $checkRowsQuery = "SELECT COUNT(*) FROM temp;";
    $result = $conn->query($checkRowsQuery)->fetchColumn();
       
    if ($result != 1) {
        $deleteOldDataQuery = "DELETE FROM temp;";
        $conn->exec($deleteOldDataQuery);
    
        $query = "
        INSERT INTO temp(balance) VALUES (1000)";
    
        $conn->exec($query);
    }
    
   
    $query = $conn->prepare("SELECT id,balance FROM temp  ORDER BY id DESC LIMIT 1");
    $query->execute();
    $balance = $query->fetch(PDO::FETCH_ASSOC);
    $globalBalance = $balance['balance'];

    // Product Table

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
        piece INTEGER NOT NULL,
        isCart INTEGER NOT NULL
    );";

    $conn->exec($query);

    $checkRowsQuery = "SELECT COUNT(*) FROM products;";
    $result = $conn->query($checkRowsQuery)->fetchColumn();
    
    if ($result != 3) {
        $deleteOldDataQuery = "DELETE FROM products;";
        $conn->exec($deleteOldDataQuery);
    
        $initialRowsQuery = "
            INSERT INTO products (id, imageName, title, details, price, piece, isCart)
            VALUES 
                (1, 'yavuzlar.png', 'Yavuzlar Expert', 'Possibility to contact a yavuz expert for assistance.', 901.99, 0, 0),
                (2, 'cat.jpg', 'Thief Cat', 'He stole 100 dollars to buy fish, do you want to help him?', 100, 0, 0),
                (3, 'flag.png', 'Finish Flag', 'Here is the flag that will win you the race.', 1049.99, 0, 0);
        ";
    
        $conn->exec($initialRowsQuery);
    }
    
    // Message(shop) Table
    $query = "CREATE TABLE IF NOT EXISTS shopMessage (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        content TEXT NOT NULL,
        corner INTEGER NOT NULL
    );";

    $conn->exec($query);
    // Message(yavuzlar) Table
      $query = "CREATE TABLE IF NOT EXISTS shopYavuzlar (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        content TEXT NOT NULL,
        corner INTEGER NOT NULL
    );";

    $conn->exec($query);
?>