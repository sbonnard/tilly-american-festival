<?php

function fetchHead()
{
    return '
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Site officiel du festival américain de Tilly-Sur-Seulles en Normandie : Le Tilly American Festival.">
        <title>Tilly American Festival</title>

        <!-- if development -->
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/js/script.js"></script>

        <!-- Production -->
        <link rel="stylesheet" href="build/assets/script-p5yvvnAD.css">
        <script type="module" src="build/assets/script--1LRezKC.js"></script>
        <script type="module" src="https://tillyamericanfestival.com/js/script.js"></script>
        
        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <link rel="icon" type="image/x-icon" href="cowquitaf.ico">
';
}
