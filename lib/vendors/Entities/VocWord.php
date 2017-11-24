<?php

namespace Entities;


use Fram\Entity;

class VocWord extends Entity
{
    protected   $idList,
                $VO,
                $VF;

    public function idList() {return $this->idList;}
    public function VO() {return $this->VO;}
    public function VF() {return $this->VF;}

    public function setIdList($idList) {$this->idList = $idList;}
    public function setVO($VO) {$this->VO = $VO;}
    public function setVF($VF) {$this->VF = $VF;}


}