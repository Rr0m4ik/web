<!DOCTYPE html>
<html>
<head>
    <title>Проверка високосного года</title>
</head>
<body>
    <h2>Проверка года на високосность</h2>

    <form method="POST">
        Введите год:
        <input type="number" name="year" min="1" max="30000" required>
        <input type="submit" value="Проверить">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $year = (int)$_POST["year"];

        echo $year . "!";

        function isLeapYear($year){
            if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) {
                return true;
              } else {
                return false;
              }
            }


        echo "<p>Результат:</p>";
        if (isLeapYear($year)) {
            echo "YES";
          } else {
            echo "NO";
          }
    } ?>
</body>
</html>
