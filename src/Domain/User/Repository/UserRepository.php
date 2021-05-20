<?php

namespace App\Domain\User\Repository;

use Illuminate\Database\Connection;

class UserRepository
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * The constructor.
     *
     * @param Connection $connection The database connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    // Add your custom query methods here...
}
