<?php

namespace DesignPatterns\Patterns\AbstractFactory;

class JsonFactory extends AbstractFactory
{
    public function createText(string $context) : Text
    {
        return new JsonText($content);
    }
}