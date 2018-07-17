<?php
    function get_weekdays(){
        global $wpdb;
        $blackout_weekdays_table = $wpdb->prefix . "sapo_blackout_weekdays";
        $weekdays = $wpdb->get_row("SELECT sunday,monday,tuesday,wednesday,thursday,friday, saturday FROM " . $blackout_weekdays_table . 
                                       " WHERE USER_ID = " . get_current_user_id());

        //if there is no data in the result set, display unchecked boxes and return
        if(empty($weekdays)) {
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="sunday">Sundays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="monday">Mondays</label></div>' ;
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="tuesday">Tuesdays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="wednesday">Wednesdays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="thursday">Thursdays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="friday">Fridays</label></div>';
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="weekday-cb" value="saturday">Saturdays</label></div>';
            return;
        };
        
                                       
        //if there is data in the result set, render the checkboxes according to the results 
        if($weekdays->sunday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="sunday" checked>Sundays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="sunday">Sundays</label></div>';
        if($weekdays->monday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="monday" checked>Mondays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="monday">Mondays</label></div>';
        if($weekdays->tuesday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="tuesday" checked>Tuesdays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="tuesday">Tuesdays</label></div>';
        if($weekdays->wednesday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="wednesday" checked>Wednesdays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="wednesday">Wednesdays</label></div>';
        if($weekdays->thursday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="thursday" checked>Thursdays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="thursday">Thursdays</label></div>';
        if($weekdays->friday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="friday" checked>Fridays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="friday">Fridays</label></div>';    
        if($weekdays->saturday)
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="saturday" checked>Saturdays</label></div>';
        else   
            echo '<div class="form-check-inline"><label class="form-check-label"><input class="form-check-input"type="checkbox" name="weekday-cb" value="saturday">Saturdays</label></div>';
    }
        
        
?>