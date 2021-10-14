<?php

class MenuItem
{
	public $id;
	public $title;
	public $href;
	public $parent;
	public $children;
	public $active = false;

	public function __construct($item)
	{
		$this->id = $item['id'];
		$this->title = $item['title'];
		$this->href = $item['href'];

		// for now, the parent is the menu id
		// will become a MenuItem by using `setParent`
		$this->parent = $item['parent'];

		$this->children = new Menu(array());
	}

	public function setParent($menuItem)
	{
		$this->parent = $menuItem;
	}

	public function appendChild($menuItem)
	{
		$this->children->appendChild($menuItem);
	}

	public function setActive()
	{
		$this->active = true;
		if ($this->parent) {
			$this->parent->setActive();
		}
	}

	public function toArray()
	{
		$arr = array(
			'id' => $this->id,
			'title' => $this->title,
			'href' => $this->href,
			'active' => $this->active,
			'below' => $this->children->toArray(),
		);
		return $arr;
	}
}
