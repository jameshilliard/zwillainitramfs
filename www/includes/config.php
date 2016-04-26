<?php

// Set the folder that you'd like data to be saved to.
define('DATA_FOLDER', '/'); // Default value = '/' und nicht anders

// Update Feeds
$updateFeed = array(
    'release' => array(
        'feed' => 'https://api.github.com/repos/zwilla/cryptoGlance-web-app/branches/Zwilla-patch-1',
        'zip' => 'https://github.com/zwilla/cryptoGlance-web-app/archive/Zwilla-patch-1.zip',
    ),
    'beta' => array(
        'feed' => 'https://api.github.com/repos/zwilla/cryptoGlance-web-app/branches/Zwilla-patch-1',
        'zip' => 'https://github.com/zwilla/cryptoGlance-web-app/archive/Zwilla-patch-1.zip',
    ),
    'nightly' => array(
        'feed' => 'https://api.github.com/repos/zwilla/cryptoGlance-web-app/branches/Zwilla-patch-1',
        'zip' => 'https://github.com/zwilla/cryptoGlance-web-app/archive/Zwilla-patch-1.zip',
    ),
);