<?php

function fetchHead()
{
    return '
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta name="description" content="Plongez dans l\'ambiance unique du Tilly American Festival en Normandie : concerts, animations et culture US au rendez-vous !"> -->
        <meta name="description" content="Plongez dans l’ambiance unique du Tilly American Festival, un festival rétro en Normandie (Calvados) : concerts, animations et culture US au cœur de la France !">
        <title>Tilly American Festival – Festival américain en Normandie (Calvados)</title>

        <!-- if development -->
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/js/script.js"></script>

        <!-- Production -->
        <!-- <link rel="stylesheet" href="build/assets/script-DETMqPBIi.css">
        <script type="module" src="build/assets/script-Dh_uEbM00.js"></script>
        <script type="module" src="https://tillyamericanfestival.com/js/script.js"></script> -->
        
        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <link rel="icon" type="image/x-icon" href="cowquitaf.ico">
';
}
