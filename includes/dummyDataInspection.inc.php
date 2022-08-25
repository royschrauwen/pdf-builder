<?php
// Voorbeeldrapportage
$oInspection = new Inspection(
    "1234567890",
    "Verbetervoorstel",
    "23-08-2022 09:36",
    "EQUANS Services Noord B.V.",
    "Roy Schrauwen",
    "0612345678",
    "Jasper en Juraj",
    "Exporteren rapportages naar PDF - 01293213",
    "Renko van den Hout",
    "Kantoor Aptic",

    [ 
        new Theme(
        "Orde en netheid",
            [
                new Finding(
                "omschrijving bevinding 1 1",
                "type 1",
                "collega's 1",
                "afdeling 1",
                [
                    "http://placekitten.com/400/300", 
                    "http://placekitten.com/1200/900"
                ],
                "acties genomen 1",
                [
                    new FollowUpAction(
                        "omschrijving 1",
                        "type 1",
                        "actiehouder a 1",
                        "actiehouder b 1",
                        "24-08-2022"
                    ),
                    new FollowUpAction(
                        "omschrijving 2",
                        "type 2",
                        "actiehouder a 2",
                        "actiehouder b 2",
                        "25-08-2022"
                    ),
                    new FollowUpAction(
                        "omschrijving 3",
                        "type 3",
                        "actiehouder a 3",
                        "actiehouder b 3",
                        "26-08-2022"
                    )
                ]
                    ),
                new Finding(
                    "omschrijving bevinding deel 2",
                    "Ook een type",
                    "Collega's die meeliepen",
                    "afdeling 2",
                    [
                        "http://placekitten.com/600/450", 
                        "http://placekitten.com/500/300"
                    ],
                    "acties genomen 1",
                    [
                        new FollowUpAction(
                            "omschrijving 1",
                            "type 1",
                            "actiehouder a 1",
                            "actiehouder b 1",
                            "24-08-2022"
                        ),
                        new FollowUpAction(
                            "omschrijving 2",
                            "type 2",
                            "actiehouder a 2",
                            "actiehouder b 2",
                            "25-08-2022"
                        ),
                        new FollowUpAction(
                            "omschrijving 3",
                            "type 3",
                            "actiehouder a 3",
                            "actiehouder b 3",
                            "26-08-2022"
                        )
                    ]
                        )
    ]),
                    new Theme(
        "Veiligheid",
        [
            new Finding(
                "omschrijving van thema 2",
                "type 2",
                "collega's 2",
                "afdeling 2",
                [
                    "http://placekitten.com/800/600",  
                    "http://placekitten.com/1600/1200"
                ],
                "acties genomen 2",
                [
                    new FollowUpAction(
                        "omschrijving 3",
                        "type 13",
                        "actiehouder a 3",
                        "actiehouder b 3",
                        "24-08-2022"
                    ),
                    new FollowUpAction(
                        "omschrijving 4",
                        "type 4",
                        "actiehouder a 4",
                        "actiehouder b 4",
                        "25-08-2022"
                    )
                ]
                    )
    ])
    ]
);