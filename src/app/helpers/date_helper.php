<?php
function time_elapsed_string($datetime)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    if ($diff->y > 0) {
        return $diff->y > 1 ? $diff->format("%y years ago") : "1 year ago";
    } elseif ($diff->m > 0) {
        return $diff->m > 1 ? $diff->format("%m months ago") : "1 month ago";
    } elseif ($diff->d > 0) {
        return $diff->d > 1 ? $diff->format("%d days ago") : "1 day ago";
    } elseif ($diff->h > 0) {
        return $diff->h > 1 ? $diff->format("%h hours ago") : "1 hour ago";
    } elseif ($diff->i > 0) {
        return $diff->i > 1 ? $diff->format("%i minutes ago") : "1 minute ago";
    } else {
        return "Just now";
    }
}
