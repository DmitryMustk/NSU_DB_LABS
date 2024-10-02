<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>

    </style>
</head>

<body>
	<div class="wrapper">
		<header>
    	    <h1>Courses list</h1>
    	</header>
		
		<main class="main">
		    <?php
		        $DB_HOST = 'localhost';
		        $DB_NAME = 'testdb'; 
		        $DB_USER = 'admin'; 
		        $DB_PASSWORD = 'nimda1234'; 
		
		        try {
		            $pdo = new PDO("mysql:host=" . $DB_HOST . "; dbname=" . $DB_NAME, $DB_USER, $DB_PASSWORD);
		            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		            $query = "SELECT ID, Title FROM Courses";
		            $stmt = $pdo->prepare($query);
		            $stmt->execute();
		
		            echo '<ul class="course-list">';
		            while ($course = $stmt->fetch(PDO::FETCH_ASSOC)) {
		                echo "<li><a href='course.php?ID={$course['ID']}'>{$course['Title']}</a></li>";
		            }
		            echo '</ul>';
		
		        } catch (PDOException $e) {
		            echo "<p>DB connect error: " . $e->getMessage() . "</p>";
		        }
		    ?>
		</main>	
		
		<button class="back-button" onclick="window.location.href='index.html'">Back to home</button>
		<p></p>
    	<footer>
    	    <p>&copy; 2024 All rights received</p>
    	</footer>
	</div>	
</body>
</html>

