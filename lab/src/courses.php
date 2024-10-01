<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Курсы</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .course-list {
            max-width: 600px;
            margin: 30px auto;
            padding: 0;
            list-style: none; 
            background-color: #34495e;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            padding: 20px;
        }

        .course-list li {
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

        .course-list li:hover {
            background-color: #3b5068; 
        }

        .course-list a {
            color: #e74c3c;
            text-decoration: none;
            font-size: 18px;
        }

        .course-list a:hover {
            color: #47a447;
            text-decoration: underline;
        }

        h1 {
            text-align: center;
            color: #fff;
            margin-top: 20px;
        }

        .back-button {
            display: block;
            margin: 30px auto 0;
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

        footer {
            text-align: center;
            padding: 10px 0;
            background: #34495e;
            color: #ffffff;
            margin-top: 20px;
        }
    </style>
</head>
<body>
	<div class="wrapper">
	<div class="main">
    <header>
        <h1>Courses list</h1>
    </header>

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

    <button class="back-button" onclick="window.location.href='index.html'">Назад на главную</button>
	</div>
	</div>

    <footer>
        <p>&copy; 2024 All rights received</p>
    </footer>
</body>
<script src=script.js></script>
</html>

