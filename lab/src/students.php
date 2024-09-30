<html>
<head>
    <meta charset='utf-8'>
    <title>Студенты</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Все студенты</h1>
    </header>
    
    <?php
        $DB_HOST = 'localhost';
        $DB_NAME = 'testdb'; 
        $DB_USER = 'admin'; 
        $DB_PASSWORD = 'nimda1234'; 

        try {
            $pdo = new PDO("mysql:host=" . $DB_HOST . "; dbname=" . $DB_NAME, $DB_USER, $DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $Q = "SELECT ID, LastName, FirstName FROM Students";
            $stmt = $pdo->prepare($Q);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Ошибка подключения: " . $e->getMessage();
        }
    ?>
    <table>
        <thead>
			<tr>
				<th>#</th>
                <th>Фамилия</th>
                <th>Имя</th>
            </tr>
        </thead>
        <tbody>
            <?php
				$counter = 1;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "<tr>
							<td>{$counter}.</td>		
                            <td><a href='student.php?ID={$row['ID']}'>{$row['LastName']}</a></td>
                            <td>{$row['FirstName']}</td>
                          </tr>";
					$counter++;
                }
            ?>
        </tbody>
    </table>

	<p><button id="backButton" onclick="window.location.href='index.html'">Назад на главную</button></p>

    <footer>
        <p>&copy; 2024 Все права защищены</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>

