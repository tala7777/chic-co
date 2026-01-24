<?php
$files = ['composer.json', 'package.json']; // Check common config files
foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $bom = pack('CCC', 0xef, 0xbb, 0xbf);
        if (str_starts_with($content, $bom)) {
            echo "Removing BOM from $file\n";
            file_put_contents($file, substr($content, 3));
        } else {
            echo "No BOM found in $file\n";
        }
    }
}
