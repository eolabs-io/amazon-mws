<?php

namespace EolabsIo\AmazonMws\Domain\Shared;

use Illuminate\Support\Str;
use Illuminate\Support\LazyCollection;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\CsvHeaderRowCountMismatchException;

class Csv
{
    protected string $path;

    protected bool $processHeader = true;

    protected bool $headersToSnakeCase = false;

    protected string $delimiter = ',';

    protected array $headers = [];


    public static function from(string $file, string $delimiter = ',')
    {
        return new static($file, $delimiter);
    }

    public function __construct(string $path, string $delimiter = ',')
    {
        $this->path = $path;
        $this->useDelimiter($delimiter);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function noHeaderRow(): self
    {
        $this->processHeader = false;

        return $this;
    }

    public function useDelimiter(string $delimiter): self
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    public function headersToSnakeCase(): self
    {
        $this->headersToSnakeCase = true;

        return $this;
    }


    public function getRows(): LazyCollection
    {
        return LazyCollection::make(function () {
            $handle = fopen($this->getPath(), "r");
            $length = 0;

            if ($this->processHeader) {
                $this->headers = $this->processHeaderRow(fgetcsv($handle, $length, $this->delimiter));
            }

            while (($line = fgetcsv($handle, $length, $this->delimiter)) !== false) {
                yield $this->getValueFromRow($line);
            }

            fclose($handle);
        });
    }

    protected function processHeaderRow(array $headers): array
    {
        if ($this->headersToSnakeCase) {
            $headers = array_map(function ($header) {
                return Str::of($header)->camel()->snake();
            }, $headers);
        }

        return $headers;
    }

    protected function getValueFromRow(array $row): array
    {
        if (! $this->processHeader) {
            return $row;
        }

        throw_if(
            count($row) != count($this->headers),
            CsvHeaderRowCountMismatchException::class,
            "Header and Row Count must be equal!"
        );

        return array_combine($this->headers, $this->processRow($row));
    }

    public function processRow($row): array
    {
        return array_map(function ($item) {
            if ($item === '') {
                return null;
            }

            $encoding = mb_detect_encoding($item, 'UTF-8, ISO-8859-1, WINDOWS-1252, WINDOWS-1251', true);
            if ($encoding != 'UTF-8') {
                $item = iconv($encoding, 'UTF-8//IGNORE', $item);
            }

            return $item;
        }, $row);
    }
}
