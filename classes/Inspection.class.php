<?php
/**
 * EQUANS PDF Inspection PDF
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Inspection extends Report {
    
    function __construct(
        protected ?string $idReport,
        protected ?string $vType,
        protected ?string $vDate,
        protected ?string $vDepartment,
        protected ?string $vReportedByName,
        protected ?string $vReportedByPhone,
        protected ?string $vPresentColleagues,
        protected ?string $vProjectNameNumber,
        protected ?string $vClientName,
        protected ?string $vLocationDescription,
        protected ?array $aThemes,
    ) {}



    /** Creates the HTML for the Header of the Inspection template */
    public function getHeaderHTML() : string {
        return '
        <table class="page-header">
        <tr>
            <td><img class="header-logo" src="images/logo.jpg" alt=""></td>
            <td><b>Meldingstype</b><br>' . $this->get('vType') . '</td>
            <td><b>Datum</b><br>' . $this->get('vDate') . '</td>
        </tr>
        <tr>
            <td><b>Registratienr</b><br>' . $this->get('idReport') . '</td>
            <td colspan="2"><b>EQUANS bedrijf</b><br>' . $this->get('vDepartment') . '</td>
        </tr>
    </table>
        ';
    }

    /** Creates the HTML for the Footer of the Inspection template */
    public function getFooterHTML() : string {
        return '
        <table class="page-footer">
            <tr>
                <td><i>Neem contact op met de lokale HSE afdeling van ' . $this->get('vDepartment') . ' voor meer informatie</i></td>
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
                <td><b>Melder</b><br>' . $this->get('vReportedByName') . '</td>
                <td><b>Tel</b><br>' . $this->get('vReportedByPhone') . '</td>
                <td><b>Meegelopen</b><br>' . $this->get('vPresentColleagues') . '</td>
            </tr>
    
            <tr>
                <td><b>Projectnaam en -nummer</b><br>' . $this->get('vProjectNameNumber') . '</td>
                <td><b>Klantnaam</b><br>' . $this->get('vClientName') . '</td>
                <td><b>Locatiebeschrijving</b><br>' . $this->get('vLocationDescription') . '</td>
            </tr>
        </table>
        ';

        foreach ($this->get('aThemes') as $theme) {

            $vContentHTML .= '
            <div class="inspection-theme">
            <p class="inspection-theme-header"><b>Thema: ' . $theme->get('vThemeName') . '</b></p>
            ';
        
        
            foreach ($theme->get('aFindings') as $finding) {
                $vContentHTML .= '
                <div class="inspection-finding">
        
                <p><b>Omschrijving</b><br>' . $finding->get('vDescription') . '</p>
                <p><b>Type</b><br>' . $finding->get('vType') . '</p>
                <p><b>Gesproken met</b><br>' . $finding->get('vCollegues') . ' - ' . $finding->get('vDepartment') . '</p>
                </div>
                ';
    


                // // Images, max 2 per row
                if(count($finding->get('aImages')) > 0) {

                    $vContentHTML .= '<table class="report-images">';
                    $vContentHTML .= '<tr>';


                    for ($i=0; $i < count($finding->get('aImages')); $i++) { 
                        $vContentHTML .= "<td><center><img class='rapport-afbeelding' alt='' src='" . $finding->get('aImages')[$i] . "'></center></td>";
                    }

                    $vContentHTML .= '</tr>';
                    $vContentHTML .= '</table>';

                }

                
        
        
                $vContentHTML .= '
                        <div class="inspection-finding">
                
                        <p><b>Reeds genomen acties</b><br>' . $finding->get('vActionsTaken') . '</p>';
        
        
        
        
        // // Vervolgacties indien aanwezig
        if(count($finding->get('aFollowUpActions')) > 0) {

            $vContentHTML .= '
            <p style="margin-left: 0.25rem"><b>Vervolgacties</b></p>';

            for ($i=0; $i < count($finding->get('aFollowUpActions')) ; $i++) { 
                $vContentHTML .= $finding->get('aFollowUpActions')[$i]->getSingleActionHTML($i);
        }


        }


        

        $vContentHTML .= '</div></div>';
            }
        

        }


        return $vContentHTML;
    }

    
}
