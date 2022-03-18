<?php 
    function get_age_by_bday($birth_date){
        $today = date("m/d/Y");
        $diff = date_diff(date_create($birth_date), date_create($today));

        return (int) $diff->format('%y');
    }
?>