<?php 

try {
    $db = new PDO("sqlite:./data/travel.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database Connected";

    $sql = "SELECT * FROM countries";
    $countries = $db->query($sql)->fetchAll();

    $sql = "SELECT 
            c.CountryCode, 
            i.ImageID, 
            i.Title, 
            i.FileName 
        FROM Countries c
        INNER JOIN ImageDetails i ON c.CountryCode = i.CountryCode";

    $result = $db->query($sql);
    $allData = $result->fetchAll();

    $imagesByCountry = [];
    foreach ($allData as $row) {
        $imagesByCountry[$row['CountryCode']][] = $row;
    }
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
    <style>
        .gallery {
            display: flex;
            flex-wrap: wrap; 
            gap: 20px;       
            margin-top: 20px;
        }
        .image-card img {
            width: 100%;
            height: 480px;
            object-fit: cover; 
        }
    </style>
</head>
<body>
    <!-- Form -->
    <form method="POST" action="index.php">
        <select name="country">
            <option value="all">All Countries</option>
        
        <?php foreach ($countries as $country): ?>
            <option value="<?php echo htmlspecialchars($country['CountryCode']); ?>">
                <?php echo htmlspecialchars($country['CountryName']); ?>                
        </option>
        <?php endforeach; ?>
        
        </select>
        <button type="submit">Filter</button>
    </form>

    <!-- Images -->
    <div class="gallery">
        <?php 
        $filter = $_POST['country'] ?? 'all';
        foreach ($imagesByCountry as $code => $images): 
            if ($filter === 'all' || $filter === $code): 
                foreach ($images as $img): ?>
                    <div class="image-card">
                        <img src="data/images/<?php echo htmlspecialchars($img['FileName']); ?>" 
                             alt="<?php echo htmlspecialchars($img['Title']); ?>">
                    </div>
                <?php endforeach; 
            endif;
        endforeach; 
        ?>
    </div>

</body>
</html>