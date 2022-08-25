<?php

// Voorbeeldrapportage
$oExternalEvaluation = new ExternalEvaluation(
    "Testrapportage EQUANS",
    "1234567890",
    "Verbetervoorstel",
    "23-08-2022 09:36",
    "EQUANS Services Noord B.V.",
    "Roy Schrauwen",
    "Exporteren rapportages naar PDF",
    "Renko van den Hout",
    "Praesent blandit laoreet nibh. Nunc sed turpis. Phasellus ullamcorper ipsum rutrum nunc. Morbi ac felis. Maecenas vestibulum mollis diam. Nunc sed turpis. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. 
    
    Nam adipiscing. Integer tincidunt. Praesent egestas tristique nibh.
    
    Aenean ut eros et nisl sagittis vestibulum. Cras varius. Praesent blandit laoreet nibh. Sed hendrerit. Proin magna.
    
    Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Praesent ac massa at ligula laoreet iaculis. Praesent ut ligula non mi varius sagittis. Vivamus consectetuer hendrerit lacus. Fusce vel dui.",
    "2014/108/EG Electro Magnetisch compatabiliteit (CE)",
    "Pellentesque habitant morbi tristique",
    "Aptic",
    "Oorzaakanalyse",
    "Medium",
    "Roy maakt een PHP document dat gebruikt maakt van een library om een pagina naar PDF te kunnen omzetten",

    [
        [
        "actie" => "Styling voorleggen aan Renko / Lorentz",
        "internExtern" => "intern",
        "voorgesteldeActiehouder" => "Renko",
        "daadwerkelijkeActiehouder" => "Roy",
        "plandatum" => "23 aug 2022"
        ],
        [
        "actie" => "Andere pagina's maken",
        "internExtern" => "intern",
        "voorgesteldeActiehouder" => "Roy",
        "daadwerkelijkeActiehouder" => "ook Roy",
        "plandatum" => "23 aug 2022"
        ]
    ],
    "Doeltreffendheid is hoog"
);