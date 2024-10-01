<html>
<head>
    <meta charset='utf-8'>
    <title>Student</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<div class="wrapper">
<body>
    <header>
        <h1>Student card</h1>
    </header>
    <main class="main"> 
    <div class="student-card">
        <?php
            $DB_HOST = 'localhost';
            $DB_NAME = 'testdb'; 
            $DB_USER = 'admin'; 
            $DB_PASSWORD = 'nimda1234'; 

            $studentID = $_GET['ID'];

            try {
                $pdo = new PDO("mysql:host=" . $DB_HOST . "; dbname=" . $DB_NAME, $DB_USER, $DB_PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $Q = "SELECT ID, LastName, FirstName, GroupID FROM Students WHERE ID = :studentID";
                $stmt = $pdo->prepare($Q);
                $stmt->execute(['studentID' => $studentID]);

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    echo "<div class='photo-placeholder'></div>"; 
                    echo "<h2>{$row['LastName']} {$row['FirstName']}</h2>";
                    echo "<p>Group:: <a href='group.php?ID={$row['GroupID']}'>{$row['GroupID']}</a></p>";

                    $Q = "SELECT c.Title FROM Enrollments e 
                          INNER JOIN Courses c ON e.CourseID = c.ID 
                          WHERE e.StudentID = :studentID";
                    $stmt = $pdo->prepare($Q);
                    $stmt->execute(['studentID' => $studentID]);

                    echo "<h3>Courses:</h3>";
                    echo "<ul>";
                    while ($course = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<li>{$course['Title']}</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>Can't find the student :(</p>";
                }
            } catch (PDOException $e) {
                echo "DB connection error: " . $e->getMessage();
            }
        ?>
    </div>
    
	<p><button id="backButton" onclick="window.location.href='students.php'">Back to students</button></p>
       </main>
    <footer>
        <p>&copy; 2024 All rights received</p>
    </footer>
    <script src="script.js"></script>
</body>
</div>
</html>

