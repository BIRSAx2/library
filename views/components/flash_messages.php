<div class="text-center text-red-500">
    <?php
    if ($this->errors) {
        foreach ($this->errors as $error) {
            echo $error;
            echo "</br>";
        }
    } ?>
</div>
<div class="text-center text-green-500">

    <?php
    if ($this->messages) {
        foreach ($this->messages as $message) {
            echo $message;
            echo "</br>";
        }
    }
    ?>
</div>