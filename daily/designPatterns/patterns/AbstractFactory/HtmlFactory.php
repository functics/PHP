<?php

namespace DesignPatterns\Patterns\AbstractFactory;

class HtmlFactory extends AbstractFactory
{
    public function createText(string $context) : Text
    {
        return new HtmlText($content);
    }
}