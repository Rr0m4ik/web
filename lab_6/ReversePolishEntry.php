<!DOCTYPE html>
<html>
<head>
    <title>Калькулятор обратной польской записи</title>
</head>
<body>
    <div class="container">
        <h2>Калькулятор обратной польской записи</h2>
        <form method="GET">
            <input type="text" name="expression" placeholder="Введите выражение" required>
            <button type="submit">Вычислить</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $input = trim($_GET["expression"]);
            $tokens = explode(" ", $input);
            $stack = [];
            $error = null;

            foreach ($tokens as $token) {
                if ($token === "") {
                    continue;
                }

                if (is_numeric($token)) {
                    array_push($stack, (int) $token);
                } else {
                    if (count($stack) < 2) {
                        $error = "Ошибка: недостаточно операндов для операции '$token'";
                        break;
                    }
                    $b = array_pop($stack);
                    $a = array_pop($stack);
                    switch ($token) {
                        case "+":
                            $res = $a + $b;
                            break;
                        case "-":
                            $res = $a - $b;
                            break;
                        case "*":
                            $res = $a * $b;
                            break;
                        default:
                            $error = "Ошибка: неизвестный оператор '$token'";
                            break 2;
                    }
                    array_push($stack, $res);
                }
            }

            echo '<div class="result">';
            if ($error) {
                echo '<div class="error">' . $error . "</div>";
            } elseif (count($stack) !== 1) {
                echo '<div class="error">Некорректное выражение</div>';
            } else {
                echo "Результат: <strong>" . $stack[0] . "</strong>";
            }
            echo "</div>";
        } ?>
    </div>
</body>
</html>