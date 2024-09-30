<html>
<head>
    <meta charset='utf-8'>
    <title>Студент</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<div class="wrapper">
<body>
    <header>
        <h1>Листок студента</h1>
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
                    echo "<div class='photo-placeholder'></div>"; // Место для фото
                    echo "<h2>{$row['LastName']} {$row['FirstName']}</h2>";
                    echo "<p>Группа: <a href='group.php?GroupID={$row['GroupID']}'>{$row['GroupID']}</a></p>";

                    $Q = "SELECT c.Title FROM Enrollments e 
                          INNER JOIN Courses c ON e.CourseID = c.ID 
                          WHERE e.StudentID = :studentID";
                    $stmt = $pdo->prepare($Q);
                    $stmt->execute(['studentID' => $studentID]);

                    echo "<h3>Факультативы:</h3>";
                    echo "<ul>";
                    while ($course = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<li>{$course['Title']}</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>Студент не найден.</p>";
                }
            } catch (PDOException $e) {
                echo "Ошибка: " . $e->getMessage();
            }
        ?>
    </div>
    
	<p><button id="backButton" onclick="window.location.href='students.php'">Назад к студентам</button></p>
       </main>
    <footer>
        <p>&copy; 2024 Все права защищены</p>
    </footer>
    <script src="script.js"></script>
</body>
</div>
</html>

