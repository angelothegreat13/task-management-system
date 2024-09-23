<?php
// app/Helpers/helpers.php

if (!function_exists('getNextStatus')) {

    /**
     * Get the next sequential status for a task.
     *
     * @param string $currentStatus
     * @return string|null
     */
    function getNextStatus(string $currentStatus): ?string
    {
        $statuses = config('task.status_sequence');

        if (!in_array($currentStatus, $statuses)) {
            return null;
        }

        $currentStatusIndex = array_search($currentStatus, $statuses);
        $statusesLastIndex = count($statuses) - 1;

        return $currentStatusIndex !== false && $currentStatusIndex < $statusesLastIndex
            ? $statuses[$currentStatusIndex + 1]
            : null;
    }
}
