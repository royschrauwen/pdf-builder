<?php

// Voorbeeldrapportage IncidentReport
$oIndicentReport = new IncidentReport(
    vType: 'Incident',
    dtDateTime: '2021-01-01 12:00:00',
    vSubtype: 'Geen verzuim verwacht',
    idReport: "1234567890",
    vDepartment: "EQUANS Services Noord B.V.",
    vReportedByName: "Roy Schrauwen",
    vReportedByPhone: "+31 6 12345678",
    vReportedByEmail: "test@aptic.nl",
    vProjectNameNumber: "TestProject IncidentReport 0.1",
    vClientName: "Renko",
    vLocationDescription: "Kantoor Aptic",
    vDescription: "Omschrijving",
    aImages: [
        "http://placekitten.com/400/300", 
        "http://placekitten.com/1200/900"
        ],
    vInjuredPersonType: 'Medewerker',
    vInjuredInjuryType: 'Gebroken arm',
    vInjuredConsequences: 'Geen',
    dtInjuredAbsenceStart: '2021-01-01',
    dtInjuredAbsenceEnd: '2021-01-01',
    vWitnessName: 'Jan Jansen',
    vWitnessType: 'Getuige',
    vPeopleInformed: 'Ja',
    vConsequences: 'Geen',
    vConsequencesDescription: 'Geen',
    bSanction: false,
    bRex: true,
    bHipo: false,
    vDirectCauses: 'Geen',
    vDirectCauseDescription: 'Geen',
    vIndirectCauses: 'Geen',
    vRiskFactors: 'Geen',
    vRiskFactorsDescription: 'Geen',
    bIsDone: true,
    vDirectActionsWho: 'Geen',
    vDirectActionsHow: 'Geen',
    dtDirectActionsWhen: '2021-01-01',
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

);