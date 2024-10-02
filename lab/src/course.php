<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Course</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<div class="wrapper">
	<body>
		<header>
			<h1>Course information</h1>
		</header>
		
		<div class="main">
		<div class="student-card">
			<?php
				$DB_HOST = 'localhost';
				$DB_NAME = 'testdb';
				$DB_USER = 'admin';
				$DB_PASSWORD = 'nimda1234';

				$courseID = $_GET['ID'];
				try {
					$pdo = new PDO("mysql:host=" . $DB_HOST . ";dbname=" . $DB_NAME, $DB_USER, $DB_PASSWORD);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$Q = "SELECT 
								c.Title AS courseTitle,
								c.Description AS courseDescription
						  FROM
								Courses c
						  WHERE
								c.ID = :CourseID";
					$stmt = $pdo->prepare($Q);
					$stmt->execute(["CourseID" => $courseID]);
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					
					echo "<h2>{$row['courseTitle']}</h3>";
					echo "<p>{$row['courseDescription']}</p>";

					$Q = "SELECT 
								s.ID as StudentID, 
								s.FirstName,
								s.LastName,
								e.Grade
						  FROM 
							    Students s 
						  INNER JOIN 
								Enrollments e on e.CourseID = :CourseID
						  WHERE e.StudentID=s.ID;";

					$stmt = $pdo->prepare($Q);
					$stmt->execute(["CourseID" => $courseID]);

					echo "<h3>Students </h3>";
					
						
				} catch (PDOException $e) {
					echo "DB connection error:" . $e->getMessage();
				}
			?>
			<table>
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Grade</th>
					</tr>
					<?php
						echo "<tbody>";
						$counter  = 1;
						$gradeSum = 0;
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							$fullName = $row['FirstName'] . ' ' . $row['LastName'];
							echo "<tr>
									<td>{$counter}.</td>
									<td><a href='student.php?ID={$row['StudentID']}'>{$fullName}</a></td>
									<td>{$row['Grade']}</td>
								  </tr>";
							$counter++;
							$gradeSum += $row['Grade'];
					    }
						$avgGrade = round($gradeSum / ($counter - 1), 2);
						echo "</tbody>";
						echo "</table>";
						echo "<p>Average grade: {$avgGrade}</p>"
					?>
		
		</div>
			<button class="back-button" onclick="window.location.href='index.html'">Back to courses</button>
			<p></p>
		</div>
		
	</body>
	</div>
		<footer>
			<p>&copy; 2024 All rights received</p>
		</footer>
</html>
