<?php

require_once 'entity.php';

class Degree extends Entity
{
    public string $name;
}

class Subject extends Entity
{
    public string $name;
    public Degree $degree;
}

class Group extends Entity
{
    public string $name;
}
