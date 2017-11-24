<?php

foreach ($allVocLists as $vocList){
    echo $vocList['listName'].' <a href="/test/ChillVoc/Web/admin/Modifier-liste/'.$vocList['id'].'/">Modifier</a><br/>';

}
