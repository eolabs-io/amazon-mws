<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

abstract class AmazonMwsModel extends Model
{
    use HasFactory;

    /**
     * Get the current connection name for the model.
     *
     * @return string|null
     */
    public function getConnectionName()
    {
        return config('amazon-mws.database.connection') ?? $this->connection;
    }
}
