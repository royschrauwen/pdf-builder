<?php

// Voorbeeldrapportage Intern
$report = new InternalEvaluation(
    "Testrapportage EQUANS",
    "1234567890",
    "Verbetervoorstel",
    "23-08-2022 09:36",
    "EQUANS Services Noord B.V.",
    "Roy Schrauwen",
    "0612345678",
    "roy@aptic.nl",
    "Exporteren rapportages naar PDF",
    "Renko van den Hout",
    "Intern",
    "Praesent blandit laoreet nibh. Nunc sed turpis. Phasellus ullamcorper ipsum rutrum nunc. Morbi ac felis. Maecenas vestibulum mollis diam. Nunc sed turpis. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. 
    
    Nam adipiscing. Integer tincidunt. Praesent egestas tristique nibh.
    
    Aenean ut eros et nisl sagittis vestibulum. Cras varius. Praesent blandit laoreet nibh. Sed hendrerit. Proin magna.
    
    Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Praesent ac massa at ligula laoreet iaculis. Praesent ut ligula non mi varius sagittis. Vivamus consectetuer hendrerit lacus. Fusce vel dui.",
    "2014/108/EG Electro Magnetisch compatabiliteit (CE)",
    "Pellentesque habitant morbi tristique",
    "Advies, Engineering, Design, PDF",
    "Project / Contract",
    "Nader te bepalen",
    "PDF-Rapportage 0.0.1",
    "Aptic",
    [
        "http://placekitten.com/800/450", 
        "http://placekitten.com/640/480", 
        "http://placekitten.com/300/300"
    ],
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur massa nisi, finibus eget tellus ut, vestibulum faucibus odio. Aenean et velit justo. Praesent sit amet dapibus erat, cursus placerat est.",
    "Dit is de oorzaakanalyse van dit rapport",
    "Omvang is gemiddeld",
    "Roy maakt een PHP document dat gebruikt maakt van een library om een pagina naar PDF te kunnen omzetten",
    "Library is gedownload. Het begin van de template is gemaakt",
    "23-08-2022",
    [
        new FollowUpAction(
            "Styling voorleggen aan Renko / Lorentz",
            "intern",
            "Renko",
            "Roy",
            "23 aug 2022"
        ),
        new FollowUpAction(
            "Andere pagina's maken",
            "intern",
            "Roy",
            "Roy",
            "23 aug 2022"
        )
    ],
    "Doeltreffendheid is hoog"
);