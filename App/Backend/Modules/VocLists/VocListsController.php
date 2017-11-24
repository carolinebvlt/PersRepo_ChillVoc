<?php

namespace App\Backend\Modules\VocLists;


use Entities\VocList;
use Fram\BackController;
use Fram\Request;

class VocListsController extends BackController
{
    public function executeIndex(){
        $this->page->addVar('title', 'Listes existantes');
        $manager = $this->managers->getManagerOf('VocLists');
        $allVocLists = $manager->allVocLists();
        $this->page->addVar('allVocLists', $allVocLists);
    }

    public function executeAdd(Request $request){
        $this->page->addVar('title', 'Ajout d\'une liste');

        if ($request->postExists('listName')) {
            $vocList = new VocList([
               'listName'=>$request->postData('listName'),
               'language' =>$request->postData('language')
            ]);
            $manager = $this->managers->getManagerOf('VocLists');

            // Vérifications
            if ($manager->availableListName($request->postData('listName'))){
                $vocList->setListName($request->postData('listName'));
                $vocList->setLang($request->postData('lang'));
                $manager->addVocList($vocList);
                $this->app->user()->setFlash('Liste ajoutée!');
            }
            else{
                $this->app->user()->setFlash('Une liste porte déjà ce nom !');
            }
            $this->page->addVar('vocList', $vocList);
        }
    }
    public function executeUpdate(Request $request) {
        $this->page->addVar('title', 'Modifier une liste');

        $manager =  $this->managers->getManagerOf('VocLists');
        $listToUpdate = $manager->getUnique($request->getData('id'));
        $this->page->addVar('listToUpdate', $listToUpdate);
    }
}