<?php 

try {
    $db = new PDO("sqlite:.data/travel.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ATTR_ERRMODE);
}
catch(PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Tutorial 3</title>
</head>
<body>
    <form>
        <select name="country">
            <option value="">All Countries</option>
            <option value="<?php  ?>"><?php  ?></option>
        </select>
        <submit> Filter </submit>
    </form>
</body>
</html>