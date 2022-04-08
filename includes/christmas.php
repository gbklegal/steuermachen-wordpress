<?php

/**
 * christmas.php
 * @author Tobias Roeder
 * @version 1.1
 */

/**
 * @param string $date - [YYYY-MM-DD]
 * 
 * @return int
 */
function get_weekday( string $date ):int {
    // 'w' 0 (for Sunday) through 6 (for Saturday)
    $result = (int) date('w', strtotime($date));

    return $result;
}

/**
 * @param string $christmasEve - [YYYY-MM-DD]
 * @param string $format - 'd.m.Y'
 * 
 * @return string
 */
function get1st_advent( string $christmas_eve, string $format = 'd.m.Y' ):string {
    $datetime = new DateTime($christmas_eve);
    $diff = get_weekday($christmas_eve) + 21;
    $datetime->modify('-' . $diff . ' day');

    return $datetime->format($format);
}

/**
 * calculates if its between 1st advent and second christmas day
 * 
 * @return bool
 */
function is_christmas_time():bool {
    $now = date('Y-m-d');
    $year_now = date('Y');
    $christmas_time_start = get1st_advent($year_now . '-12-24', 'Y-m-d');
    $christmas_time_end = date($yearNow . '-12-26');

    return $now >= $christmas_time_start && $now <= $christmas_time_end;
}