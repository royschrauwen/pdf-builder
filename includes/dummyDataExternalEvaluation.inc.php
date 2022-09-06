<?php

// Voorbeeldrapportage
$oExternalEvaluation = new ExternalEvaluation(
    vWorkingTitle: "Testrapportage EQUANS",
    idReport: "1234567890",
    vType: "Verbetervoorstel",
    dtDateTime: "23-08-2022 09:36",
    vDepartment: "EQUANS Services Noord B.V.",
    vReportedByName: "Roy Schrauwen",
    vCause: "Exporteren rapportages naar PDF",
    vReference: "Renko van den Hout",
    vDescription: "Praesent blandit laoreet nibh. Nunc sed turpis. Phasellus ullamcorper ipsum rutrum nunc. Morbi ac felis. Maecenas vestibulum mollis diam. Nunc sed turpis. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. 
    
    Nam adipiscing. Integer tincidunt. Praesent egestas tristique nibh.
    
    Aenean ut eros et nisl sagittis vestibulum. Cras varius. Praesent blandit laoreet nibh. Sed hendrerit. Proin magna.
    
    Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Praesent ac massa at ligula laoreet iaculis. Praesent ut ligula non mi varius sagittis. Vivamus consectetuer hendrerit lacus. Fusce vel dui.",
    vNorm: "2014/108/EG Electro Magnetisch compatabiliteit (CE)",
    vNormParagraph: "Pellentesque habitant morbi tristique",
    vClientName: "Aptic",
    vCauseAnalysis: "Oorzaakanalyse",
    vSizeAnalysis: "Medium",
    vHowShouldBeSolved: "Roy maakt een PHP document dat gebruikt maakt van een library om een pagina naar PDF te kunnen omzetten",

    aFollowUpActions: [
        new FollowUpAction(
            vDescription: "Styling voorleggen aan Renko / Lorentz",
            vActionType: "intern",
            vReportedActionHolder: "Renko",
            vLinkedActionHolder: "Roy",
            vPlannedDate: "23 aug 2022"
        ),
        new FollowUpAction(
            vDescription: "Andere pagina's maken",
            vActionType: "intern",
            vReportedActionHolder: "Roy",
            vLinkedActionHolder: "Roy",
            vPlannedDate: "23 aug 2022"
        )
    ],
    vEffectiveness: "Doeltreffendheid is hoog"
);