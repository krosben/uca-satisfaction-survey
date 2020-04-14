<?php

function properties_exists($obj, array $properties)
{
    return count(array_intersect(array_keys(get_object_vars($obj)), $properties)) > 0;
}
