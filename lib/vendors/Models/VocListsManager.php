<?php

namespace Models;

use Entities\VocList;
use Fram\Manager;

class VocListsManager extends Manager
{
    public function allVocLists() {
        $rq = $this->dao->query('SELECT * FROM vocLists');
        $rq->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE , 'Entities\VocList');
        $allVocLists = $rq->fetchAll();
        $rq->closeCursor();
        return $allVocLists;
    }

    public function addVocList(VocList $vocList) {
        $requete = $this->dao->prepare('INSERT INTO vocLists(listName, lang) VALUES(:listName, :lang)');
        $requete->execute([
            'listName' =>$vocList->listName(),
            'lang' =>$vocList->lang()]);
    }

    public function availableListName($listName) {
        $req = $this->dao->prepare('SELECT id FROM vocLists  WHERE listName=:listName');
        $req->execute(['listName'=>$listName]);
        $result = $req->fetch();
        $req->closeCursor();
        return !$result;
    }

    public function count(){
        return $this->dao->query('SELECT COUNT(*) FROM vocLists')->fetchColumn();
    }

    public function getUnique($id){
        $rq = $this->dao->prepare('SELECT * FROM vocLists WHERE id=:id');
        $rq->execute(['id'=>$id]);
        $rq->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE , 'Entities\VocList');
        $uniqueList = $rq->fetch();
        return $uniqueList;
    }

    public function update(VocList $vocList) {

    }
}