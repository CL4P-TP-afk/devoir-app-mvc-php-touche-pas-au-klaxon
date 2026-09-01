<?php

declare(strict_types=1);

$pageTitle = $pageTitle ?? 'Touche pas au klaxon';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>
        - Touche pas au klaxon
    </title>

    <link rel="stylesheet" href="/assets/css/main.css">
</head>