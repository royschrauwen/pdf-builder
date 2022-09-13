<?php
/**
 * EQUANS PDF Reports - Inspection Template
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Inspection extends Report {

    protected ?string $idReport;
    protected ?string $vDate;
    protected ?string $vDepartment;
    protected ?string $vReportedByName;
    protected ?string $vReportedByPhone;
    protected ?string $vPresentColleagues;
    protected ?string $vProjectNameNumber;
    protected ?string $vClientName;
    protected ?string $vLocationDescription;
    protected ?array  $aThemes;

    function __construct(
        string $idReport,
        string $vDate,
        string $vDepartment,
        string $vReportedByName,
        string $vReportedByPhone,
        string $vPresentColleagues,
        string $vProjectNameNumber,
        string $vClientName,
        string $vLocationDescription,
        array  $aThemes,
    ) {
        $this->idReport = $idReport;
        $this->vType = $vType;
        $this->vDate = $vDate;
        $this->vDepartment = $vDepartment;
        $this->vReportedByName = $vReportedByName;
        $this->vReportedByPhone = $vReportedByPhone;
        $this->vPresentColleagues = $vPresentColleagues;
        $this->vProjectNameNumber = $vProjectNameNumber;
        $this->vClientName = $vClientName;
        $this->vLocationDescription = $vLocationDescription;
        $this->aThemes = $aThemes;
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
                <td><b>Meegelopen</b><br>' . $this->vPresentColleagues . '</td>
            </tr>
    
            <tr>
                <td><b>Projectnaam en -nummer</b><br>' . $this->vProjectNameNumber . '</td>
                <td><b>Klantnaam</b><br>' . $this->vClientName . '</td>
                <td><b>Locatiebeschrijving</b><br>' . $this->vLocationDescription . '</td>
            </tr>
        </table>
        ';

        foreach ($this->aThemes as $theme) {

            $vContentHTML .= '
            <div class="inspection-theme">
            <p class="inspection-theme-header"><b>Thema: ' . $theme->getThemeName() . '</b></p>
            ';
        
        
            foreach ($theme->getFindings() as $finding) {
                $vContentHTML .= '
                <div class="inspection-finding">
        
                <p><b>Omschrijving</b><br>' . $finding->getDescription() . '</p>
                <p><b>Type</b><br>' . $finding->getType() . '</p>
                <p><b>Gesproken met</b><br>' . $finding->getCollegues() . ' - ' . $finding->getDepartment() . '</p>
                </div>
                ';
    
                // Images indien aanwezig
                if(count($finding->getImages()) > 0) {

                    $vContentHTML .= '<table class="report-images">';
                    $vContentHTML .= '<tr>';

                    for ($i=0; $i < count($finding->getImages()); $i++) {
                        $vContentHTML .= "<td><center><img class='rapport-afbeelding' alt='' src='" . $finding->getImages()[$i] . "'></center></td>";
                    }

                    $vContentHTML .= '</tr>';
                    $vContentHTML .= '</table>';
                }

                $vContentHTML .= '
                        <div class="inspection-finding">
                
                        <p><b>Reeds genomen acties</b><br>' . $finding->getActionsTaken() . '</p>';
    
        
                // Vervolgacties indien aanwezig
                if(count($finding->getFollowUpActions()) > 0) {

                    $vContentHTML .= '
                    <p style="margin-left: 0.25rem"><b>Vervolgacties</b></p>';

                    for ($i=0; $i < count($finding->getFollowUpActions()) ; $i++) {
                        $vContentHTML .= $finding->getFollowUpActions()[$i]->getSingleActionHTML($i);
                    }
                }

                $vContentHTML .= '</div></div>';
            }
        }
        return $vContentHTML;
    }

    
}
