<!DOCTYPE html>
<html>
<head>
    <title>Знак зодиака</title>
</head>
<body>
    <form method="POST">
        Введите дату:
        <input type="text" name="date"
               placeholder="ДД.ММ.ГГГГ или другой формат" required>
        <input type="submit" value="Узнать">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $input = trim($_POST["date"] ?? "");
        $day = 0;
        $month = 0;
        $year = 0;
        
        // всё заменяем на точку
        $normalized = str_replace(['-', '/', ' ', ','], '.', $input);
        while (strpos($normalized, '..') !== false) {
            $normalized = str_replace('..', '.', $normalized);
        }
        // Удаляем точку в начале и конце, если есть ".15.03.2023", "15.03.2023."
        $normalized = trim($normalized, '.');
        
        $parts = explode('.', $normalized);
        
        if (count($parts) >= 2) {
            // Пытаемся определить день и месяц если будет дана дата на подобии "15.03.2023"
            if (strlen($parts[0]) <= 2 && strlen($parts[1]) <= 2) {
                $day = (int)$parts[0];
                $month = (int)$parts[1];
            } elseif (strlen($parts[0]) <= 2 && strlen($parts[1]) > 2) {
                $day = (int)$parts[0];
                $month = (int)substr($parts[1], 0, 2);
            }
            
            // Проверка валидности
            if ($day < 1 || $day > 31 || $month < 1 || $month > 12) {
                $day = 0;
                $month = 0;
            }
        }

        echo $day . "day";
        
        $zodiac = [
            ["Козерог", [12, 22], [1, 19]],
            ["Водолей", [1, 20], [2, 18]],
            ["Рыбы", [2, 19], [3, 20]],
            ["Овен", [3, 21], [4, 19]],
            ["Телец", [4, 20], [5, 20]],
            ["Близнецы", [5, 21], [6, 20]],
            ["Рак", [6, 21], [7, 22]],
            ["Лев", [7, 23], [8, 22]],
            ["Дева", [8, 23], [9, 22]],
            ["Весы", [9, 23], [10, 22]],
            ["Скорпион", [10, 23], [11, 21]],
            ["Стрелец", [11, 22], [12, 21]],
        ];

        $result = "Неверная дата";
        if ($day !== 0 && $month !== 0) {
            foreach ($zodiac as $sign) {
                if (
                    ($month == $sign[1][0] && $day >= $sign[1][1]) ||
                    ($month == $sign[2][0] && $day <= $sign[2][1])
                ) {
                    $result = $sign[0];
                    break;
                }
            }
        }

        echo "<p>Результат: $result</p>";
    } ?>
</body>
</html>