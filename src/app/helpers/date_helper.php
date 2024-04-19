<?php
function getTimeDifference($postedDate)
{
    $now = new DateTime(); // Current date and time
    $postedDateTime = new DateTime($postedDate); // Posted date and time

    // Calculate the difference
    $difference = $now->diff($postedDateTime);

    // Format the difference
    if ($difference->y > 0) {
        return $difference->y . ' years ago';
    } elseif ($difference->m > 0) {
        return $difference->m . ' months ago';
    } elseif ($difference->d > 0) {
        return $difference->d . ' days ago';
    } elseif ($difference->h > 0) {
        return $difference->h . ' hours ago';
    } elseif ($difference->i > 0) {
        return $difference->i . ' minutes ago';
    } else {
        return 'just now';
    }
}
