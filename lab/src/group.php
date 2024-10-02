<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
	<style>
        .student-list {
            max-width: 600px;
            margin: 30px auto;
            padding: 0;
            list-style: none; 
            background-color: #34495e;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            padding: 20px;
        }

        .student-list li {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px 20px;
            margin: 5px 0;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s;
        }

        .student-list li:hover {
            background-color: #3b5068; 
        }

        .student-list .leader {
            font-weight: bold;
            border-left: 5px solid #e74c3c; 
            background-color: #ffebee; 
            color: #333;
        }

        .leader-icon {
            font-size: 18px;
            color: #e74c3c;
            margin-right: 10px;
        }

        .student-name {
            font-size: 18px;
        }

        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #47a447;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #3b8f3b;
        }
    </style>
</head>
<div class="wrapper">
<body>
	
    <header>
        <h1>Group information</h1>
    </header>

	<main class="main">
    <?php
		$DB_HOST = 'localhost';
    	$DB_NAME = 'testdb'; 
    	$DB_USER = 'admin'; 
    	$DB_PASSWORD = 'nimda1234'; 
		$groupID = $_GET['ID'];

    	try {
    	    $pdo = new PDO("mysql:host=" . $DB_HOST . ";dbname=" . $DB_NAME, $DB_USER, $DB_PASSWORD);
    	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	    $Q = "SELECT 
    	              s.ID AS StudentID, 
    	              s.FirstName, 
    	              s.LastName, 
    	              CASE WHEN g.LeaderID = s.ID THEN 1 ELSE 0 END AS IsLeader
    	          FROM 
    	              Students s
    	          INNER JOIN 
    	              Groups g ON s.GroupID = g.ID
    	          WHERE 
    	              g.ID = :GroupID;";

    	    $stmt = $pdo->prepare($Q);
    	    $stmt->execute(['GroupID' => $groupID]);

			echo '<ul class="student-list">';
    	    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$class =      $row['IsLeader'] ? 'leader' : '';
				$leaderIcon = $row['IsLeader'] ? '<span class="leader-icon">&#9733;</span>' : '';
				
				echo "<li class='$class'>";
				echo $leaderIcon;
				echo "<span class='student-name'><a href=student.php?ID={$row['StudentID']}>{$row['FirstName']} {$row['LastName']}</a></span>";
				echo "</li>";
    	    }
    	    echo '</ul>';
    	} catch (PDOException $e) {
    	    echo "DB connection error:" . $e->getMessage();
		}
	?>
	
	<p><button id="backButton" onclick="window.location.href='groups.php'">Back to groups</button></p>
       </main>	

	</main>
    <footer>
        <p>&copy; 2024 All rights received</p>
    </footer>
</body>
</div>
</html>

