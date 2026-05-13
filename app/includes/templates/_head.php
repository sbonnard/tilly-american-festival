<?php

function fetchHead()
{
    return '
        <!-- =============================================
             BASE
        ============================================= -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow">
        <meta name="author" content="Tilly American Festival">
        <meta name="keywords" content="festival rockabilly, festival country, festival bluegrass, Normandie, Calvados, rock\'n\'roll, festival américain, Tilly-sur-Seulles, culture américaine, festival vintage">
 
        <title>Tilly American Festival 2026 – Rockabilly, Country &amp; Bluegrass en Normandie</title>
        <meta name="description" content="Le Tilly American Festival, c\'est 3 jours de rockabilly, country et bluegrass en plein cœur de la Normandie (Calvados). Concerts live, voitures US, culture américaine à Tilly-sur-Seulles.">
        <link rel="canonical" href="https://tillyamericanfestival.com/">
 
        <!-- =============================================
             OPEN GRAPH (Facebook, WhatsApp, LinkedIn…)
        ============================================= -->
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Tilly American Festival">
        <meta property="og:locale" content="fr_FR">
        <meta property="og:url" content="https://tillyamericanfestival.com/">
        <meta property="og:title" content="Tilly American Festival 2026 – Rockabilly, Country &amp; Bluegrass en Normandie">
        <meta property="og:description" content="3 jours de rockabilly, country et bluegrass en Normandie. Concerts live, voitures US et culture américaine à Tilly-sur-Seulles (Calvados).">
        <meta property="og:image" content="https://tillyamericanfestival.com/og-image.jpg">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="Affiche du Tilly American Festival 2026">
 
        <!-- =============================================
             TWITTER / X
        ============================================= -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Tilly American Festival 2026 – Rockabilly, Country &amp; Bluegrass en Normandie">
        <meta name="twitter:description" content="3 jours de rockabilly, country et bluegrass en Normandie. Concerts live, voitures US et culture américaine à Tilly-sur-Seulles.">
        <meta name="twitter:image" content="https://tillyamericanfestival.com/og-image.jpg">
 
        <!-- =============================================
             DONNÉES STRUCTURÉES JSON-LD
        ============================================= -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "MusicEvent",
            "name": "Tilly American Festival 2026",
            "description": "Festival de rockabilly, country et bluegrass en Normandie. 3 jours de concerts live, voitures US et culture américaine à Tilly-sur-Seulles.",
            "url": "https://tillyamericanfestival.com",
            "image": "https://tillyamericanfestival.com/og-image.jpg",
            "startDate": "2026-09-12",
            "endDate": "2026-09-14",
            "eventStatus": "https://schema.org/EventScheduled",
            "eventAttendanceMode": "https://schema.org/OfflineEventAttendanceMode",
            "genre": ["Rockabilly", "Country", "Bluegrass", "Rock\'n\'Roll"],
            "location": {
                "@type": "Place",
                "name": "Tilly-sur-Seulles",
                "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "Tilly-sur-Seulles",
                    "postalCode": "14250",
                    "addressRegion": "Normandie",
                    "addressCountry": "FR"
                }
            },
            "organizer": {
                "@type": "Organization",
                "name": "Association Tilly American Festival",
                "url": "https://tillyamericanfestival.com"
            }
        }
        </script>
 
        <!-- =============================================
             FAVICON & ICÔNES
        ============================================= -->
        <link rel="icon" type="image/x-icon" href="/cowquitaf.ico">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
 
        <!-- =============================================
             STYLES & SCRIPTS
        ============================================= -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
 
        <!-- Production -->
        <link rel="stylesheet" href="' . buildCSS . '">
        <script type="module" src="' . buildJS . '"></script> 
        <script type="module" src="https://tillyamericanfestival.com/js/script.js"></script>
    
        <!-- Développement -->
       <!--  <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/js/script.js"></script> -->
    ';
}

//     return '
//         <meta charset="UTF-8">
//         <meta name="viewport" content="width=device-width, initial-scale=1.0">
//         <!-- <meta name="description" content="Plongez dans l\'ambiance unique du Tilly American Festival en Normandie : concerts, animations et culture US au rendez-vous !"> -->
//         <meta name="description" content="Plongez dans l’ambiance unique du Tilly American Festival, un festival rétro en Normandie (Calvados) : concerts, animations et culture US au cœur de la France !">
//         <title>Tilly American Festival – Festival américain en Normandie (Calvados)</title>

//         <!-- if development -->
//         <script type="module" src="http://localhost:5173/@vite/client"></script>
//         <script type="module" src="http://localhost:5173/js/script.js"></script>

//         <!-- Production -->
//         <!-- <link rel="stylesheet" href="build/assets/script-BaBi-CTX.css">
//         <script type="module" src="build/assets/script-CsaCvbW0.js"></script>
//         <script type="module" src="https://tillyamericanfestival.com/js/script.js"></script> -->

//         <!-- AOS -->
//         <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
//         <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

//         <link rel="icon" type="image/x-icon" href="cowquitaf.ico">
// ';