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
    private string $vType;
    private string $vCollegues;
    private string $vDepartment;
    private array  $aImages;
    private string $vActionsTaken;
    private array  $aFollowUpActions;

    function __construct(
        string $vDescription,
        string $vType,
        string $vCollegues,
        string $vDepartment,
        array  $aImages,
        string $vActionsTaken,
        array  $aFollowUpActions,
    ) {
        $this->vDescription = $vDescription;
        $this->vType = $vType;
        $this->vCollegues = $vCollegues;
        $this->vDepartment = $vDepartment;
        $this->aImages = $aImages;
        $this->vActionsTaken = $vActionsTaken;
        $this->aFollowUpActions = $aFollowUpActions;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->vDescription;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->vType;
    }

    /**
     * @return string
     */
    public function getCollegues(): string
    {
        return $this->vCollegues;
    }

    /**
     * @return string
     */
    public function getDepartment(): string
    {
        return $this->vDepartment;
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