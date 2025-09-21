<!DOCTYPE html>
<html>
<head>
    <title>перевод из числа в слово</title>
</head>
<body>
    <form method="POST">
        Введите цифру от 0 до 9:
        <input type="number" name="digit" min="0" max="9" required>
        <input type="submit" value="перевести">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $words = [
            0 => "Ноль",
            1 => "Один",
            2 => "Два",
            3 => "Три",
            4 => "Четыре",
            5 => "Пять",
            6 => "Шесть",
            7 => "Семь",
            8 => "Восемь",
            9 => "Девять",
        ];

        $digit = (int) ($_POST["digit"] ?? -1);

        echo "<p>Результат: ";
        echo $words[$digit];
        echo "</p>";
    } ?>
</body>
</html>
