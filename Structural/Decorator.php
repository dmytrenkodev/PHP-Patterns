<?php

// Attach new behaviors to objects dynamically by wrapping them in other objects.
//
// Use when:
// You want to add responsibilities dynamically.
// + Highly flexible, composable.
// - Too many decorators can make debugging hard.

interface TextFormatter
{
    public function format(string $text): string;
}

class PlainTextFormatter implements TextFormatter
{
    public function format(string $text): string
    {
        return $text;
    }
}

abstract class TextFormatterDecorator implements TextFormatter
{
    protected TextFormatter $formatter;

    public function __construct(TextFormatter $formatter)
    {
        $this->formatter = $formatter;
    }
}

class UppercaseDecorator extends TextFormatterDecorator
{
    public function format(string $text): string
    {
        $text = $this->formatter->format($text);
        return strtoupper($text);
    }
}

class StarsDecorator extends TextFormatterDecorator
{
    public function format(string $text): string
    {
        $text = $this->formatter->format($text);
        return '***' . $text . '***';
    }
}

$formatter = new StarsDecorator(
    new UppercaseDecorator(
        new PlainTextFormatter()
    )
);

echo $formatter->format("hello world");
