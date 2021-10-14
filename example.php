<?php

require './Menu.php';
require './MenuItem.php';

$data = array(
    array(
        'id' => 1,
        'title' => 'parent1',
        'href' => 'http://example.com/parent1',
        'parent' => null,
    ),
    array(
        'id' => 2,
        'title' => 'child1',
        'href' => 'http://example.com//parent1/child1',
        'parent' => 1,
    ),
    array(
        'id' => 3,
        'title' => 'parent2',
        'href' => 'http://example.com/parent2',
        'parent' => null,
    ),
    array(
        'id' => 4,
        'title' => 'child2',
        'href' => 'http://example.com/parent2/child2',
        'parent' => 3,
    ),
    array(
        'id' => 5,
        'title' => 'child3',
        'href' => 'http://example.com/parent2/child3',
        'parent' => 3,
    ),
);

function current_url()
{
    return 'http://example.com/parent2/child2';
}

$menu = new Menu($data);
$menu->setActive();
var_dump($menu->toArray());