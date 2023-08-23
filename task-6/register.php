<?php
$logsDirectory = "../logs/"; // Путь к директории для хранения логов

$response = array("success" => false, "message" => "");
$currentTime = date("d.m.Y H:i:s");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && $password === $confirmPassword) {
        // Массив с "существующими" юзерами
        $existingUsers = array(
            array("id" => 1, "name" => "root", "email" => "root@root.com"),
            array("id" => 2, "name" => "admin", "email" => "admin@gmail.com")
        );

        foreach ($existingUsers as $user) {
            if ($user["email"] === $email) {
                if (!is_dir($logsDirectory)) {
                    mkdir($logsDirectory, 0777, true);
                }

                // Записываем в логи неудачную регистрацию
                $logFilePath = $logsDirectory . "registration_log.txt";

                $logMessage = "[{$currentTime}]Try registration already email: " . $email . "\n";
                file_put_contents($logFilePath, $logMessage, FILE_APPEND);
                $response["message"] = "Email already exists";
                break;
            }
        }

        if (empty($response["message"])) {
            // Успешная регистрация
            $response["success"] = true;
            $response["message"] = "Registration successful!";

            // на случай отсутствия папки для логов, создаём её
            if (!is_dir($logsDirectory)) {
                mkdir($logsDirectory, 0777, true);
            }

            // Записываем в логи успешню регистрацию
            $logFilePath = $logsDirectory . "registration_log.txt";
            $logMessage = "[{$currentTime}]Successful registration for email: " . $email . "\n";
            file_put_contents($logFilePath, $logMessage, FILE_APPEND);
        }
    } else {
        // на случай отсутствия папки для логов, создаём её
        if (!is_dir($logsDirectory)) {
            mkdir($logsDirectory, 0777, true);
        }

        // Записываем в логи неудачную регистрацию
        $logFilePath = $logsDirectory . "registration_log.txt";
        $logMessage = "[{$currentTime}]Error registration for email: " . $email . "\n";
        file_put_contents($logFilePath, $logMessage, FILE_APPEND);

        $response["message"] = "Почта и пароль не соответсвует требованиям для регистрации";
    }
}

echo json_encode($response);
?>
