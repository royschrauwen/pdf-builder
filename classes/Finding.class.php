<?php

/**
 * EQUANS PDF Inspection PDF Findings
 *
 * @copyright  2022 Aptic
 * @version    Release: 0.1.0
 * @since      Class available since Release 0.1.0
 */ 
class Finding {

    private string $vDescription;
    private int $vType;
    private array $aColleagues;
    private array $aImages;
    private string $vActionsTaken;
    private array $aFollowUpActions = [];

    function __construct(
        string $vDescription,
        string $vType,
        array  $aColleagues,
        ?array $aImages,
        string $vActionsTaken,
        array  $aFollowUpActions
    ) {
        $this->vDescription = $vDescription;
        $this->vType = $vType;
        $this->aColleagues = $aColleagues;
        $this->aImages = $aImages;
        $this->vActionsTaken = $vActionsTaken ?? "-";


            foreach ($aFollowUpActions as $fua) {
                if (isset($fua)) {
                    $newFuA = new FollowUpAction(
                        $fua['description'],
                        $fua['actionType'],
                        $fua['colleague']['name'],
                        $fua['linkedColleague']['name'],
                        $fua['tsPlanned']
                    );
                    $this->aFollowUpActions[] = $newFuA;
                }
            }


    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->vDescription;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->vType;
    }

    /**
     * @return array
     */
    public function getColleagues(): array
    {
        return $this->aColleagues;
    }

    public function printColleguesAndDepartments() : string
    {

        $returnData = '<ul class="colleagues-list">';
        for($i=0;$i<count($this->getColleagues());$i++){
            $returnData .= '<li>';
            $returnData .= $this->getColleagues()[$i]['name'];
            if($this->getColleagues()[$i]['department']) {
                $returnData .= ' - ';
                $returnData .= $this->getColleagues()[$i]['department'];
            }
            $returnData .= '</li>';
        }
        $returnData .= '</ul>';
        return $returnData;
    }



    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->aImages;
    }

    /**
     * @return string
     */
    public function getActionsTaken(): string
    {
        return $this->vActionsTaken;
    }

    /**
     * @return array
     */
    public function getFollowUpActions(): array
    {
        return $this->aFollowUpActions;
    }



}