<html>
<head>
    <meta charset='utf-8'>
    <title>Groups</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>All the groups</h1>
    </header>

    <div class="wrapper">
        <div class="main">
			<?php
				$DB_HOST = 'localhost';
    			$DB_NAME = 'testdb'; 
    			$DB_USER = 'admin'; 
    			$DB_PASSWORD = 'nimda1234'; 

    			try {
    			    $pdo = new PDO("mysql:host=" . $DB_HOST . ";dbname=" . $DB_NAME, $DB_USER, $DB_PASSWORD);
    			    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    			    $Q = "SELECT 
    			              g.ID AS GroupID, 
    			              f.Name AS FacultyName, 
    			              CONCAT(s.FirstName, ' ', s.LastName) AS LeaderName
    			          FROM 
    			              Groups g
    			          INNER JOIN 
    			              Faculties f ON g.FacultyID = f.ID
    			          INNER JOIN 
    			              Students s ON g.LeaderID = s.ID;";

    			    $stmt = $pdo->prepare($Q);
    			    $stmt->execute();

    			    echo '<table>';
    			    echo '<thead>
    			            <tr>
    			                <th>Group ID</th>
    			                <th>Faculty Name</th>
    			                <th>Leader</th>
    			            </tr>
    			          </thead>';
    			    echo '<tbody>';
    			    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    			        echo "<tr>
    			                <td><a href='group.php?ID={$row['GroupID']}'>{$row['GroupID']}</td></a>>
    			                <td>{$row['FacultyName']}</td>
    			                <td>{$row['LeaderName']}</td>
    			              </tr>";
    			    }
    			    echo '</tbody>';
    			    echo '</table>';
    			} catch (PDOException $e) {
    			    echo "DB connection error: " . $e->getMessage();
    			}
		
			?>
            <p><button id="backButton" onclick="window.location.href='index.html'" >Back to home</button></p>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 All rights received</p>
    </footer>
	<script src="script.js"></script>
</body>
</html>

