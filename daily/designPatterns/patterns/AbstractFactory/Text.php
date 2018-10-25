<?php

namespace DesignPatterns\Patterns\AbstractFactory;

abstract class Text
{
    /**
     * @var string
     */
    private $text;

    public function __construction(string $text)
    {
        $this->text = $text;
    }
}