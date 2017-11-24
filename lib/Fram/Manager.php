<?php

namespace Fram;


class Manager
{
    protected   $dao,
                $managers = [];

    public function __construct()
    {
        $this->dao = PDOFactory::getMysqlConnexion();
    }

    public function getManagerOf($module)
    {
        if (!is_string($module) || empty($module))
        {
            throw new \InvalidArgumentException('Le module spécifié est invalide');
        }

        if (!isset($this->managers[$module]))
        {
            $manager = '\\Models\\'.$module.'Manager';

            $this->managers[$module] = new $manager();
        }

        return $this->managers[$module];
    }
}