<?php

interface FileSystemItem
{
    public function getName(): string;
    public function getSize(): int;
}

class File implements FileSystemItem
{
    private string $name;
    private int $size;

    public function __construct(string $name, int $size)
    {
        $this->name = $name;
        $this->size = $size;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}

class CustomDirectory implements FileSystemItem
{
    private string $name;
    private array $items = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addItem(FileSystemItem $item): void
    {
        $this->items[] = $item;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSize(): int
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->getSize();
        }

        return $total;
    }
}

$root = new CustomDirectory("root");
$root->addItem(new File("readme.txt", 5));

$images = new CustomDirectory("images");
$images->addItem(new File("photo1.jpg", 1200));
$images->addItem(new File("photo2.jpg", 1500));

$root->addItem($images);

echo $root->getSize();