<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
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
		
					$query = "SELECT
								ID, Title
							  FROM Courses";
		            $stmt = $pdo->prepare($query);
					$stmt->execute();
				} catch (PDOException $e) {
					echo "DB connection error: " . $e->getMessage();
				}
			?>
			<table>
				<thead>
					<tr>
						<th>#</th>
						<th>Course Name</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$counter = 1;
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							echo "<tr>
									<td>{$counter}.</td>
									<td><a href='course.php?ID={$row['ID']}'>{$row['Title']}</a></td>
								  </tr>";
							$counter++;
						}
					?>
				</tbody>
			</table>	
		</main>	
		
		<p><button id="backButton" onclick="window.location.href='index.html'">Back to home</button></p>
		<p></p>
    	<footer>
    	    <p>&copy; 2024 All rights received</p>
    	</footer>
	</div>	
</body>
</html>

