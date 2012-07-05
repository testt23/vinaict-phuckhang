<?php

if (isset($this->info)){
    echo getI18n($this->info->content, $_SESSION['language']);
}
?>