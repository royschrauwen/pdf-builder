<?php
/**
 * EQUANS PDF Reports - Inspection Template
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Inspection extends Report {

    protected ?array $aPresentColleagues;
    /**
     * @var false|string
     */
    private $vDate;
    /**
     * @var array|mixed|string
     */
    private $vLocationDescription;
    /**
     * @var array|mixed|string
     */
    private $aThemes;

    function __construct(string $jsonData)
    {

        $reportData = json_decode(json_decode($jsonData), true);

        $this->vType = SJAQuery::get($reportData, 'reportType') ?? 0;


        $this->idReport = SJAQuery::get($reportData, '_id') ?? 0;
        $this->vDate = SJAQuery::get($reportData, 'tsDate') ? date('d-m-Y H:i', SJAQuery::get($reportData, 'tsDate')) : "-";
        $this->vDepartment = SJAQuery::get($reportData, 'department') ?? 0;
        $this->vReportedByName = SJAQuery::get($reportData, 'creator.name') ?? "";
        $this->vReportedByPhone = SJAQuery::get($reportData, 'creator.phoneNumber') ?? "";
        $this->aPresentColleagues = SJAQuery::get($reportData, 'presentColleagues') ?? "";
        $this->vProjectNameNumber = SJAQuery::get($reportData, 'projectNameNumber') ?? "";
        $this->vClientName = SJAQuery::get($reportData, 'location.clientName') ?? "";
        $this->vLocationDescription = SJAQuery::get($reportData, 'location.spot') ?? "";
        $this->aThemes = SJAQuery::get($reportData, 'themes') ?? "";
    }



    /** Creates the HTML for the Header of the Inspection template */
    public function getHeaderHTML() : string {
        return '
        <table class="page-header">
        <tr>
            <td><img class="header-logo" src="images/logo.jpg" alt=""></td>
            <td><b>Meldingstype</b><br>' . $this->vType . '</td>
            <td><b>Datum</b><br>' . $this->vDate . '</td>
        </tr>
        <tr>
            <td><b>Registratienr</b><br>' . $this->idReport . '</td>
            <td colspan="2"><b>EQUANS bedrijf</b><br>' . $this->vDepartment . '</td>
        </tr>
    </table>
        ';
    }

    /** Creates the HTML for the Footer of the Inspection template */
    public function getFooterHTML() : string {
        return '
        <table class="page-footer">
            <tr>
                <td><i>Neem contact op met de lokale HSE afdeling van ' . $this->vDepartment . ' voor meer informatie</i></td>
            </tr>
        </table>
        ';
    }

    /** Creates the HTML for the Concent of the Inspection template */
    public function getContentHTML() : string {
        $vContentHTML = '
        <div class="page-content">
        <table class="rapport-section">
            <tr>
                <td><b>Melder</b><br>' . $this->vReportedByName . '</td>
                <td><b>Tel</b><br>' . $this->vReportedByPhone . '</td>
                <td><b>Meegelopen</b><br>';


            $vContentHTML .= $this->aPresentColleagues ? Report::createListFromArray($this->aPresentColleagues) : '';

        $vContentHTML .= '</td>
            </tr>
    
            <tr>
                <td><b>Projectnaam en -nummer</b><br>' . $this->vProjectNameNumber . '</td>
                <td><b>Klantnaam</b><br>' . $this->vClientName . '</td>
                <td><b>Locatiebeschrijving</b><br>' . $this->vLocationDescription . '</td>
            </tr>
        </table>
        ';

//        var_dump($this->aThemes);

//        $vars = get_object_vars ( $this->aThemes );
//        foreach($vars as $key=>$value) {
//            var_dump($key);
//            var_dump($value);
//        }

        foreach ($this->aThemes as $vThemeName=>$aThemeFindingsObject) {

//            var_dump($this->aThemes);

            $theme = new Theme($vThemeName, $aThemeFindingsObject['findings']);

//            var_dump($theme);
            $vContentHTML .= '<div class="inspection-theme">';
            $vContentHTML .= $theme->printTeamName();

//            var_dump($theme->getFindings());

            foreach ($theme->getFindings() as $finding) {
                if (isset($finding)) {
                    $vContentHTML .= '
                <div class="inspection-finding">

                <p><b>Omschrijving</b><br>' . $finding->getDescription() . '</p>
                <p><b>Type</b><br>' . $finding->getType() . '</p>
                <p><b>Gesproken met</b>';
                    $vContentHTML .= $finding->printColleguesAndDepartments();
                    $vContentHTML .= '</p>
           
                </div>
                ';

                    // Images indien aanwezig
                    if (count($finding->getImages()) > 0) {

                        $vContentHTML .= '<table class="report-images">';
                        $vContentHTML .= '<tr>';

                        for ($i = 0; $i < count($finding->getImages()); $i++) {
                            $vContentHTML .= "<td><img class='rapport-afbeelding' alt='' src='" . $finding->getImages()[$i] . "'></td>";
                        }

                        $vContentHTML .= '</tr>';
                        $vContentHTML .= '</table>';
                    }


                }


                $vContentHTML .= '
                        <div class="inspection-finding">

                        <p><b>Reeds genomen acties</b><br>' . $finding->getActionsTaken() . '</p>';

//        var_dump($finding->getFollowUpActions());
                // Vervolgacties indien aanwezig
                if($finding->getFollowUpActions() !== null) {

                        $vContentHTML .= '
                    <p style="margin-left: 0.25rem"><b>Vervolgacties</b></p>';

//                    var_dump($finding->getFollowUpActions());

                        for ($i = 0; $i < count($finding->getFollowUpActions()); $i++) {
                        $vContentHTML .= $finding->getFollowUpActions()[$i]->getSingleActionHTML($i);
//                        $vContentHTML .= $finding->getFollowUpActions()[$i]->getFollowUpActionsHTML();
                            var_dump($finding->getFollowUpActions()[$i]->getDescription());
                        }
                }


                $vContentHTML .= '</div>';
                $vContentHTML .= '<hr>';

            }


            $vContentHTML .= '</div>';

        }


//        foreach ($this->aThemes as $theme) {
//
//            // Follow Up Actions in case of a follow up
////            if(count($this->aFollowUpActions) > 0) {
////                $vContentHTML .= $this->getFollowUpActionsHTML();
////            }
//
//
//            $vContentHTML .= '
//            <div class="inspection-theme">
//            <p class="inspection-theme-header"><b>Thema: ' . $theme->getThemeName() . '</b></p>
//            ';
        
        
//            foreach ($theme->getFindings() as $finding) {
//                $vContentHTML .= '
//                <div class="inspection-finding">
//
//                <p><b>Omschrijving</b><br>' . $finding->getDescription() . '</p>
//                <p><b>Type</b><br>' . $finding->getType() . '</p>
//                <p><b>Gesproken met</b><br>' . $finding->getCollegues() . ' - ' . $finding->getDepartment() . '</p>
//                </div>
//                ';
//
//                // Images indien aanwezig
//                if(count($finding->getImages()) > 0) {
//
//                    $vContentHTML .= '<table class="report-images">';
//                    $vContentHTML .= '<tr>';
//
//                    for ($i=0; $i < count($finding->getImages()); $i++) {
//                        $vContentHTML .= "<td><img class='rapport-afbeelding' alt='' src='" . $finding->getImages()[$i] . "'></td>";
//                    }
//
//                    $vContentHTML .= '</tr>';
//                    $vContentHTML .= '</table>';
//                }
//
//                $vContentHTML .= '
//                        <div class="inspection-finding">
//
//                        <p><b>Reeds genomen acties</b><br>' . $finding->getActionsTaken() . '</p>';
//
//
//                // Vervolgacties indien aanwezig
//                if(count($finding->getFollowUpActions()) > 0) {
//
//                    $vContentHTML .= '
//                    <p style="margin-left: 0.25rem"><b>Vervolgacties</b></p>';
//
//                    for ($i=0; $i < count($finding->getFollowUpActions()) ; $i++) {
//                        $vContentHTML .= $finding->getFollowUpActions()[$i]->getSingleActionHTML($i);
//                    }
//                }
//
//                $vContentHTML .= '</div></div>';
//            }
//        }
        return $vContentHTML;
    }

    
}
