<?php

declare(strict_types=1);

namespace Bot\Collection;

use Iterator;

abstract class AbstractCollection implements Iterator
{
    protected int $position = 0;
    protected array $data = [];

    abstract public function add($item);

    public function current()
    {
        return $this->data[$this->position];
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return isset($this->data[$this->position]);
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->position = 0;
    }

    public function isEmpty(): bool
    {
        return empty($this->data);
    }
}
