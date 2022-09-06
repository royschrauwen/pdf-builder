<?php
// Voorbeeldrapportage
$oInspection = new Inspection(
    idReport: "1234567890",
    vType: "Verbetervoorstel",
    vDate: "23-08-2022 09:36",
    vDepartment: "EQUANS Services Noord B.V.",
    vReportedByName: "Roy Schrauwen",
    vReportedByPhone: "0612345678",
    vPresentColleagues: "Jasper en Juraj",
    vProjectNameNumber: "Exporteren rapportages naar PDF - 01293213",
    vClientName: "Renko van den Hout",
    vLocationDescription: "Kantoor Aptic",

    aThemes: [ 
        new Theme(
            vThemeName: "Orde en netheid",
            aFindings: [
                new Finding(
                    vDescription: "omschrijving bevinding 1 1",
                    vType: "type 1",
                    vCollegues: "collega's 1",
                    vDepartment: "afdeling 1",
                    aImages: [
                    "http://placekitten.com/400/300", 
                    "http://placekitten.com/1200/900"
                    ],
                    vActionsTaken: "acties genomen 1",
                    aFollowUpActions: [
                        new FollowUpAction(
                            vDescription: "omschrijving 1",
                            vActionType: "type 1",
                            vReportedActionHolder: "actiehouder a 1",
                            vLinkedActionHolder: "actiehouder b 1",
                            vPlannedDate: "24-08-2022"
                        ),
                        new FollowUpAction(
                            vDescription: "omschrijving 2",
                            vActionType: "type 2",
                            vReportedActionHolder: "actiehouder a 2",
                            vLinkedActionHolder: "actiehouder b 2",
                            vPlannedDate: "25-08-2022"
                        ),
                        new FollowUpAction(
                            vDescription: "omschrijving 3",
                            vActionType: "type 3",
                            vReportedActionHolder: "actiehouder a 3",
                            vLinkedActionHolder: "actiehouder b 3",
                            vPlannedDate: "26-08-2022"
                        )
                    ]
                        ),
                new Finding(
                    vDescription: "omschrijving bevinding deel 2",
                    vType: "Ook een type",
                    vCollegues: "Collega's die meeliepen",
                    vDepartment: "afdeling 2",
                    aImages: [
                        "http://placekitten.com/600/450", 
                        "http://placekitten.com/500/300"
                    ],
                    vActionsTaken: "acties genomen 1",
                    aFollowUpActions: [
                        new FollowUpAction(
                            vDescription: "omschrijving 1",
                            vActionType: "type 1",
                            vReportedActionHolder: "actiehouder a 1",
                            vLinkedActionHolder: "actiehouder b 1",
                            vPlannedDate: "24-08-2022"
                        ),
                        new FollowUpAction(
                            vDescription: "omschrijving 2",
                            vActionType: "type 2",
                            vReportedActionHolder: "actiehouder a 2",
                            vLinkedActionHolder: "actiehouder b 2",
                            vPlannedDate: "25-08-2022"
                        ),
                        new FollowUpAction(
                            vDescription: "omschrijving 3",
                            vActionType: "type 3",
                            vReportedActionHolder: "actiehouder a 3",
                            vLinkedActionHolder: "actiehouder b 3",
                            vPlannedDate: "26-08-2022"
                        )
                    ]
                        )
    ]),
                    new Theme(
                        vThemeName: "Veiligheid",
                        aFindings: [
            new Finding(
                vDescription: "omschrijving van thema 2",
                vType: "type 2",
                vCollegues: "collega's 2",
                vDepartment: "afdeling 2",
                aImages: [
                    "http://placekitten.com/800/600",  
                    "http://placekitten.com/1600/1200"
                ],
                vActionsTaken: "acties genomen 2",
                aFollowUpActions: [
                    new FollowUpAction(
                        vDescription: "omschrijving 3",
                        vActionType: "type 13",
                        vReportedActionHolder: "actiehouder a 3",
                        vLinkedActionHolder: "actiehouder b 3",
                        vPlannedDate: "24-08-2022"
                    ),
                    new FollowUpAction(
                        vDescription: "omschrijving 4",
                        vActionType: "type 4",
                        vReportedActionHolder: "actiehouder a 4",
                        vLinkedActionHolder: "actiehouder b 4",
                        vPlannedDate: "25-08-2022"
                    )
                ]
                    )
    ])
    ]
);