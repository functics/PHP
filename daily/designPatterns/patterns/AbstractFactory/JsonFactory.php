<?php

namespace Patterns\AbstractFactory;

class JsonFactory extends AbstractFactory
{
    public function createText(string $context) : Text
    {
        return new JsonText($context);
    }
}