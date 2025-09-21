<html>
<head>
    <title>Счастливые билеты</title>
</head>
<body>
    <form method="POST">
        Начальный номер: <input type="text" name="start" required pattern="\d{6}"><br>
        Конечный номер: <input type="text" name="end" required pattern="\d{6}"><br>
        <input type="submit" value="Найти">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $start = $_POST["start"] ?? 100000;
        $end = $_POST["end"] ?? 100000;
        if ($end < $start) die ("некоректное start, end");

        if ($end <= 999999 && $end >= 100000 && $start <= 999999 && $start >= 100000) die ("некоректное start, end");
        echo "<p>Выходные данные:</p>";

        for ($num = $start; $num <= $end; $num++) {
            $ticket = str_pad($num, 6, "0", STR_PAD_LEFT);
            $sum1 = $ticket[0] + $ticket[1] + $ticket[2];
            $sum2 = $ticket[3] + $ticket[4] + $ticket[5];

            if ($sum1 == $sum2) {
                echo $ticket . "<br>";
            }
        }
    } ?>
</body>
</html>
