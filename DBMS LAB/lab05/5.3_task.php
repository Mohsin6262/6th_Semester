<?php

function is_prime($num) {
    if ($num < 2) return false;
    for ($i = 2; $i * $i <= $num; $i++) {
        if ($num % $i == 0) return false;
    }
    return true;
}

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th></th>";
for ($col = 1; $col <= 10; $col++) {
    echo "<th>" . $col . "</th>";
}
echo "</tr>";

for ($row = 1; $row <= 10; $row++) {
    echo "<tr><th>" . $row . "</th>";
    for ($col = 1; $col <= 10; $col++) {
        $result = number_format($row / $col, 3);
        $number_type = ($row % 2 == 0) ? "Even" : "Odd";
        $prime_info = is_prime($row) ? "Prime" : "";
        echo "<td>" . $result . "<br>(" . $number_type . ($prime_info ? ", " . $prime_info : "") . ")</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>
