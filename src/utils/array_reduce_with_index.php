<?php

/**
 * Iteratively reduce the array to a single value using a callback function
 * with recives prev current and index.
 *
 * @param array $arr      the array to be grouped
 * @param mixed $callback
 * @param mixed $initial
 */
function array_reduce_with_index(array $array, $callback, $initial)
{
    $prev = $initial;
    for ($index = 0; $index < sizeof($array); ++$index) {
        $prev = $callback($prev, $array[$index], $index);
    }

    return $prev;
}
