<?php
    function get_weekdays(){
        global $wpdb;
        $blackout_weekdays_table = $wpdb->prefix . "sapo_blackout_weekdays";
        $weekdays = $wpdb->get_row("SELECT sunday,monday,tuesday,wednesday,thursday,friday, saturday FROM " . $blackout_weekdays_table . 
                                       " WHERE USER_ID = " . get_current_user_id());

        //if there is no data in the result set, display unchecked boxes and return
        if(empty($weekdays)) {
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Sundays">Sundays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Mondays">Mondays</label></div>' ;
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Tuesdays">Tuesdays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Wednesdays">Wednesdays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Thursdays">Thursdays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Fridays">Fridays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="Saturdays">Saturdays</label></div>';
            return;
        };
        
                                       
        //if there is data in the result set, render the checkboxes according to the results 
        if($weekdays->sunday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Sundays" checked>Sundays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Sundays">Sundays</label></div>';
        if($weekdays->monday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Mondays" checked>Mondays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Mondays">Mondays</label></div>';
        if($weekdays->tuesday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Tuesdays" checked>Tuesdays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Tuesdays">Tuesdays</label></div>';
        if($weekdays->wednesday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Wednesdays" checked>Wednesdays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Wednesdays">Wednesdays</label></div>';
        if($weekdays->thursday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Thursdays" checked>Thursdays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Thursdays">Thursdays</label></div>';
        if($weekdays->friday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Fridays" checked>Fridays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Fridays">Fridays</label></div>';    
        if($weekdays->saturday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Saturdays" checked>Saturdays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="Saturdays">Saturdays</label></div>';
    }
        
        
?>