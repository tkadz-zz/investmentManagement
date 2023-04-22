<?php

class PignationView extends Users
{


    public function investmentLoop($recodsPerPage, $query){
        ?>
        <?php
        $records_per_page=$recodsPerPage;
        $paginate = new Pignation();
        $newquery = $paginate->paging($query,$records_per_page);
        $paginate->investmentLoop($newquery);
        $paginate->paginglink($query,$records_per_page);
        ?>
        <?php
    }


}