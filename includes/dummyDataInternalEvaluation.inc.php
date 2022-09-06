<?php

// Voorbeeldrapportage Intern
$oInternalEvaluation = new InternalEvaluation(
    vWorkingTitle: "Testrapportage EQUANS",
    idReport: "1234567890",
    vType: "Verbetervoorstel",
    dtDateTime: "23-08-2022 09:36",
    vDepartment: "EQUANS Services Noord B.V.",
    vReportedByName: "Roy Schrauwen",
    vReportedByPhone: "0612345678",
    vReportedByEmail: "roy@aptic.nl",
    vCause: "Exporteren rapportages naar PDF",
    vReference: "Renko van den Hout",
    vCustomerInternal: "Intern",
    vDescription: "Praesent blandit laoreet nibh. Nunc sed turpis. Phasellus ullamcorper ipsum rutrum nunc. Morbi ac felis. Maecenas vestibulum mollis diam. Nunc sed turpis. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. 
    
    Nam adipiscing. Integer tincidunt. Praesent egestas tristique nibh.
    
    Aenean ut eros et nisl sagittis vestibulum. Cras varius. Praesent blandit laoreet nibh. Sed hendrerit. Proin magna.
    
    Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Praesent ac massa at ligula laoreet iaculis. Praesent ut ligula non mi varius sagittis. Vivamus consectetuer hendrerit lacus. Fusce vel dui.",
    vNorm: "2014/108/EG Electro Magnetisch compatabiliteit (CE)",
    vNormParagraph: "Pellentesque habitant morbi tristique",
    vProcess: "Advies, Engineering, Design, PDF",
    vImpactLevel: "Project / Contract",
    vSegment: "Nader te bepalen",
    vProjectNameNumber: "PDF-Rapportage 0.0.1",
    vClientName: "Aptic",
    aImages: [
        "http://placekitten.com/800/450", 
        "http://placekitten.com/640/480", 
        "http://placekitten.com/300/300"
    ],
    vCauseDescription: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur massa nisi, finibus eget tellus ut, vestibulum faucibus odio. Aenean et velit justo. Praesent sit amet dapibus erat, cursus placerat est.",
    vCauseAnalysis: "Dit is de oorzaakanalyse van dit rapport",
    vSizeAnalysis: "Omvang is gemiddeld",
    vHowShouldBeSolved: "Roy maakt een PHP document dat gebruikt maakt van een library om een pagina naar PDF te kunnen omzetten",
    vActionsTaken: "Library is gedownload. Het begin van de template is gemaakt",
    vPlanningDate: "23-08-2022",
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