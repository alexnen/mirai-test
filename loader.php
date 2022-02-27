<?php

function addFilesRecursive(string $dir)
{
    $dirContent = scandir($dir);
    foreach ($dirContent as $item) {
        if ($item != '.' && $item != '..') {
            $file = $dir . DIRECTORY_SEPARATOR . $item;

            if (is_dir($file)) {
                addFilesRecursive($file);
            } else {
                if (!in_array($file, get_included_files())) {
                    require_once $file;
                }
            }
        }
    }
}

$path = __DIR__ . '/app/services';
addFilesRecursive($path);

$path = __DIR__ . '/app';
addFilesRecursive($path);



