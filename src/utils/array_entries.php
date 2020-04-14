<?php

/**
 * Get and array of [[ key, value ], ] pairs of given array.
 *
 * @param array $arr the array to be grouped
 */
function array_entries(array $array): array
{
    $entries = [];
    foreach ($array as $key => $value) {
        $entries[] = [$key, $value];
    }

    return $entries;
}
