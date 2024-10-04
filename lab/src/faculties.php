<html lang="en">
<head>
    <meta charset='utf-8'>
    <title>Faculties</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>All the faculties</h1>
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
							  f.Name    AS FacultyName,
							  MIN(g.ID) AS MinGroupID,
							  MAX(g.ID) AS MaxGroupID 
						  FROM
							  Faculties f
						  LEFT JOIN
							  Groups g ON f.ID = g.FacultyID
						  GROUP BY
							  f.Name
                          ";

    			    $stmt = $pdo->prepare($Q);
    			    $stmt->execute();

    			    echo '<table>';
    			    echo '<thead>
    			            <tr>
    			                <th>#</th>
    			                <th>Faculty Name</th>
    			                <th>Groups</th>
    			            </tr>
    			          </thead>';
					echo '<tbody>';
					$counter = 1;
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$minGroupID = $row['MinGroupID'];
						$maxGroupID = $row['MaxGroupID'];

    			        echo "<tr>
    			                <td>{$counter}.</td>
    			                <td>{$row['FacultyName']}</td>
								<td>[
										<a href='group.php?ID={$minGroupID}'>{$minGroupID}</a> 
										-
										<a href='group.php?ID={$maxGroupID}'>{$maxGroupID}</a>
								]</td>
    			              </tr>";
						$counter++;
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
</body>
</html>
