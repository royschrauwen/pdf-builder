<?php

// Voorbeeldrapportage IncidentReport
$oIndicentReport = new IncidentReport(
    vType: 'Ongeval',
    dtDateTime: '2021-01-01 12:00:00',
    vSubtype: 'Geen verzuim verwacht',
    idReport: "1234567890",
    vDepartment: "EQUANS Services Noord B.V.",
    vReportedByName: "Roy Schrauwen",
    vReportedByPhone: "+31 6 12345678",
    vReportedByEmail: "test@aptic.nl",
    vProjectNameNumber: "TestProject IncidentReport 0.1",
    vClientName: "Renko Klantnaam",
    vLocationDescription: "Kantoor Aptic",
    vDescription: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus quam laborum, dignissimos dolor eum officiis ut quibusdam dolorum iste eius id po nostrum in molestias, perferendis omnis a mollitia cum.",
    aImages: [
        "https://placedog.net/400/300", 
        "https://placedog.net/800/600"
        ],
    vInjuredPersonType: 'Onderaannemer',
    vInjuredInjuryType: 'FAC - Eerste hulp/BHV',
    vInjuredConsequences: 'Hand, pols, vinger',
    dtInjuredAbsenceStart: '2021-01-01',
    dtInjuredAbsenceEnd: '2021-01-01',
    vWitnessName: 'Jan Jansen',
    vWitnessType: 'EQUANS Medewerker',
    vPeopleInformed: 'Lorentz Stout',
    vConsequences: 'Geen',
    vConsequencesDescription: 'Geen gevolgen dus ook geen omschrijving',
    bSanction: true,
    bRex: false,
    bHipo: true,
    vDirectCauses: 'Geen',
    vDirectCauseDescription: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus quam laborum, dignissimos dolor eum officiis ut quibusdam dolorum iste eius id po nostrum in molestias, perferendis omnis a mollitia cum.',
    vIndirectCauses: 'Geen',
    vRiskFactors: 'Geen',
    vRiskFactorsDescription: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus quam laborum, dignissimos dolor eum officiis ut quibusdam dolorum iste eius id po nostrum in molestias, perferendis omnis a mollitia cum.',
    bIsSolved: true,
    vDirectActionsWho: 'Renko',
    vDirectActionsHow: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus quam laborum, dignissimos dolor eum officiis ut quibusdam dolorum iste eius id po nostrum in molestias, perferendis omnis a mollitia cum.',
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