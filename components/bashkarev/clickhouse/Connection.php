<?php

namespace app\components\bashkarev\clickhouse;

class Connection extends \bashkarev\clickhouse\Connection
{
    public $commandClass = Command::class;
}