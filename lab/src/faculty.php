<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial scale=1.0">
	<title>Faculty</title> 
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<div class="wrapper">
	<body>
		<header>
			<h1>Faculty information</h1>
		</header>
		<div class="main">
		<div class="student-card">	
			<?php
			    $DB_HOST = 'localhost';
			    $DB_NAME = 'testdb'; 
			    $DB_USER = 'admin'; 
			    $DB_PASSWORD = 'nimda1234'; 
			    $FacultyID = $_GET['ID'];
			    
			    try {
			        $pdo = new PDO("mysql:host=" . $DB_HOST . ";dbname=" . $DB_NAME, $DB_USER, $DB_PASSWORD);
			        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
					$Q = "SELECT
					    	f.Name AS FacultyName
						  FROM 
                            Faculties f 
						  WHERE 
                            f.ID = :FacultyID;";
			        $stmt = $pdo->prepare($Q);
			        $stmt->execute(['FacultyID' => $FacultyID]);
			        
			        $row = $stmt->fetch(PDO::FETCH_ASSOC);
					
					echo "<h3>{$row['FacultyName']} groups:</h3>";
			    } catch (PDOException $e) {
			        echo "DB connection error:" . $e->getMessage();
			    }
			?>
			<table>
				<thead>
					<tr>
						<th>#</th>
					    <th>Group</th>	
					</tr>
					<?php
						echo "<tbody>";
						$counter = 1;
						$Q = "SELECT
						    	g.ID AS GroupID
							  FROM 
                                Groups g 
							  WHERE 
                                g.FacultyID = :FacultyID";
						$stmt = $pdo->prepare($Q);
						$stmt->execute(['FacultyID' => $FacultyID]);
						
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							$groupID = $row["GroupID"];
							echo "<tr>
								    <td>{$counter}.</td>
									<td><a href='group.php?ID={$groupID}'>{$groupID}</a></td>
								  </tr>";
							$counter++;
						}
					?>
				</thead>
			</table>
		</div>	
		</main>
	</body>
</div>
</html>
