<?php
// Step 1:
if (!isset($_POST['step'])) {
    ?>
    <form method="post">
        <input type="hidden" name="step" value="2">
        <label>Inputkan Jumlah Baris:
            <input type="number" name="rows" required> Contoh: 1
        </label><br><br>
        <label>Inputkan Jumlah Kolom:
            <input type="number" name="cols" required> Contoh: 3
        </label><br><br>
        <button type="submit">SUBMIT</button>
    </form>
    <?php
}

// Step 2
elseif ($_POST['step'] == 2) {
    $rows = (int)$_POST['rows'];
    $cols = (int)$_POST['cols'];
    ?>
    <form method="post">w
        <input type="hidden" name="step" value="3">
        <input type="hidden" name="rows" value="<?php echo $rows; ?>">
        <input type="hidden" name="cols" value="<?php echo $cols; ?>">

        <?php
        for ($i = 1; $i <= $rows; $i++) {
            for ($j = 1; $j <= $cols; $j++) {
                echo "$i.$j: <input type='text' name='cell[$i][$j]'> ";
            }
            echo "<br>";
        }
        ?>
        <br>
        <button type="submit">SUBMIT</button>
    </form>
    <?php
}
// Step 3:
elseif ($_POST['step'] == 3) {
    $cells = $_POST['cell'];
    foreach ($cells as $i => $row) {
        foreach ($row as $j => $val) {
            echo "$i.$j : " . htmlspecialchars($val) . "<br>";
        }
    }
}
?>
