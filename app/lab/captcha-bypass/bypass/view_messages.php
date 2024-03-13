<?php
session_start();
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : [];

require("../../../lang/lang.php");
$strings = tr();

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
        }
    </style>
    <title><?= $strings['title']; ?></title>
</head>

<body>
    <div class="container">
        <h2 class="mt-4"><?= $strings['view_messages']; ?></h2>
        <table class="table">
            <thead>
                <tr>
                    <th><?= $strings['name']; ?></th>
                    <th><?= $strings['message1']; ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($messages as $message) : ?>
            <?php list($name, $customMessage) = explode(', ', $message, 2); ?>
            <tr>
                <td><?= htmlspecialchars($name); ?></td>
                <td><?= htmlspecialchars($customMessage); ?></td>
            </tr>
        <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script id="VLBar" title="<?= $strings['title']; ?>" category-id="14" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>