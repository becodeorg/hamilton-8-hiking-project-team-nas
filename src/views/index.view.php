<?php
try{
foreach ($names as $name) {
        echo "<p>" . $name['name'] . "</p>";
    }
    echo "Connection complete";
} catch (Exception $e) {
    echo $e->getMessage();
}