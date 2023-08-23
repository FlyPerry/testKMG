<?php

// Объявляем класс
class Init
{
     private function create()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=mydbtest', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE test (
            id INT AUTO_INCREMENT PRIMARY KEY,
            script_name VARCHAR(25),
            start_time INT,
            end_time INT,
            result ENUM('normal', 'illegal', 'failed', 'success')
        )";

        $pdo->exec($sql);
    }

    private function fill()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=mydbtest', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $possibleResults = ['normal', 'illegal', 'failed', 'success'];

        for ($i = 0; $i < 5; $i++) {
            $scriptName = "script" . ($i + 1);
            $startTime = time();
            $endTime = $startTime + rand(1, 1000);
            $result = $possibleResults[array_rand($possibleResults)];

            $sql = "INSERT INTO test (script_name, start_time, end_time, result) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$scriptName, $startTime, $endTime, $result]);
        }
    }

    public function get()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=mydbtest', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM test WHERE result IN ('normal', 'success')";
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public final function __construct()
    {
        try {
            $this->create();
            $this->fill();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
}

function visp($Arr)//Чисто для удобства
{
    echo '<div style="border : 1px dotted navy; margin-top : 20px; margin-bottom : 20px;"><pre>';
    print_r($Arr);
    echo "</div>";
    return true;
}

$init = new Init();
$results = $init->get();
print_r($results);
visp($results);
?>