<?php

class Menu
{
	public $list = array();

	public function __construct($data)
	{
		$menuItems = array_map(function ($v) {
			return new MenuItem($v);
		}, $data);

		foreach ($menuItems as $i => $menuItem) {
			if ($menuItem->parent) {
				// assume that the parent should be before its children
				// e.g. [..., node, node, parent node, child node 1, child node 2, ...]
				$j = $i - 1;

				while ($j >= 0) {
					$mi = $menuItems[$j];

					if ($mi->id == $menuItem->parent) {
						$menuItem->setParent($mi);
						$mi->appendChild($menuItem);
						break;
					}

					$j--;
				}
			} else {
				$this->list[] = $menuItem;
			}
		}
	}

	public function setActive()
	{
		// assume that we have a function `current_url`
		$url = current_url();

		$list = $this->list;

		foreach ($list as $item) {
			if ($item->href == $url) {
				$item->setActive();
				break;
			} elseif ($item->children) {
				$item->children->setActive();
			}
		}
	}

	public function appendChild($menuItem)
	{
		$this->list[] = $menuItem;;
	}

	public function toArray()
	{
		return array_map(function ($item) {
			return $item->toArray();
		}, $this->list);
	}
}
