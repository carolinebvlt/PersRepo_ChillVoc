<?php

namespace Entities;


use Fram\Entity;

class VocList extends Entity
{
    protected   $listName,
                $lang,
                $listVoc = [];


    public function listName()
    {
        return $this->listName;
    }

    public function lang()
    {
        return $this->lang;
    }

    public function listVoc()
    {
        return $this->listVoc;
    }

    public function setListName($listName)
    {
        $this->listName = $listName;
    }

    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    public function setListVoc($listVoc)
    {
        $this->listVoc = $listVoc;
    }
}