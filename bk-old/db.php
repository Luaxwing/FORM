<!-- for date base -->
<?php
date_default_timezone_set("Asia/Taipei");
$dsn = "mysql:host=localhost;charset=utf8;dbname=material";
$pdo = new PDO($dsn, 'root', '');
session_start();

print_r($pdo);


function all($table = null, $where = '', $other = '')
{
    global $pdo;
    $sql = "select * from `$table` ";

    if (isset($table) && !empty($table)) {

        if (is_array($where)) {

            if (!empty($where)) {
                // 固定會有
                foreach ($where as $col => $value) {
                    $tmp[] = "`$col`='$value'";
                }
                // ----

                $sql .= " where " . join(" && ", $tmp);
            }
        } else {
            $sql .= " $where";
        }

        $sql .= $other;
        //echo 'all=>'.$sql;
        $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } else {
        echo "錯誤:沒有指定的資料表名稱";
    }
}

function total($table, $id)
{
    global $pdo;
    $sql = "select count(`id`) from `$table` ";

    if (is_array($id)) {
        // 固定會有
        foreach ($id as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        // ----
        $sql .= " where " . join(" && ", $tmp);
    } else if (is_numeric($id)) {
        $sql .= " where `id`='$id'";
    } else {
        echo "錯誤:參數的資料型態比須是數字或陣列";
    }
    //echo 'find=>'.$sql;
    $row = $pdo->query($sql)->fetchColumn();
    return $row;
}

function find($table, $id)
{
    global $pdo;
    $sql = "select * from `$table` ";

    if (is_array($id)) {
        // 固定會有
        foreach ($id as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        // ----
        $sql .= " where " . join(" && ", $tmp);
    } else if (is_numeric($id)) {
        $sql .= " where `id`='$id'";
    } else {
        echo "錯誤:參數的資料型態比須是數字或陣列";
    }
    //echo 'find=>'.$sql;
    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function update($table, $id, $cols)
{
    global $pdo;

    $sql = "update `$table` set ";

    if (!empty($cols)) {
        // 固定會有
        foreach ($cols as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        // ----
    } else {
        echo "錯誤:缺少要編輯的欄位陣列";
    }

    $sql .= join(",", $tmp);
    $tmp = [];
    if (is_array($id)) {
        // 固定會有
        foreach ($id as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        // ----
        $sql .= " where " . join(" && ", $tmp);
    } else if (is_numeric($id)) {
        $sql .= " where `id`='$id'";
    } else {
        echo "錯誤:參數的資料型態比須是數字或陣列";
    }
    // echo $sql;
    return $pdo->exec($sql);
}

function insert($table, $values)
{
    global $pdo;

    $sql = "insert into `$table` ";
    $cols = "(`" . join("`,`", array_keys($values)) . "`)";
    $vals = "('" . join("','", $values) . "')";

    $sql = $sql . $cols . " values " . $vals;

    //echo $sql;

    return $pdo->exec($sql);
}

function del($table, $id)
{
    global $pdo;
    $sql = "delete from `$table` where ";

    if (is_array($id)) {
        // 固定會有
        foreach ($id as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        // ----
        $sql .= join(" && ", $tmp);
    } else if (is_numeric($id)) {
        $sql .= " `id`='$id'";
    } else {
        echo "錯誤:參數的資料型態比須是數字或陣列";
    }
    //echo $sql;

    return $pdo->exec($sql);
}

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}



?>















<!-- for file management -->

<?php


function inputType($file, $inpytType)
{
    ?>
    <tr>
        <td>
            <?= $file['id']; ?>
        </td>
        <td>
            <?php
            switch ($inpytType) {
                case "image":
                    image_Type($file);
                    break;
                default:
                    file_Type($file);
                    break;
            }
            ?>
        </td>
        <td>
            <?= $file['type']; ?>
        </td>
        <td>
            <?= $file['size']; ?>
        </td>
        <td>
            <?= $file['desc']; ?>
        </td>
        <td>
            <?= $file['create_at']; ?>
        </td>
        <td>
            <div class="row">
                <div class="col-4"><a class="btn btn-success" href="./edit.php?id=<?= $file['id']; ?>">修改</a></div>
                <div class="col-4"><a class="btn btn-danger" href="./api/del.php?id=<?= $file['id']; ?>">刪除</a></div>
                <div class="col"></div>
            </div>


        </td>
    </tr>
    <?php

}

function image_Type($file)
{
    ?>
    <img class='thumbs' src="imgs/<?= $file['name']; ?>" width="150" height="100">
    <?php
}

function file_Type($file)
{
    ?>
    <div class="file_icon">
        <i class="fa-solid fa-file" style="font-size : 100px;"></i>
    </div>
    <?php
}