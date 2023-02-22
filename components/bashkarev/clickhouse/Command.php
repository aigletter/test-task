<?php

namespace app\components\bashkarev\clickhouse;

class Command extends \bashkarev\clickhouse\Command
{
    /**
     * @param $table
     * @param $columns
     * @param $options
     * @return Command
     *
     * @todo temp decision
     */
    public function createTable($table, $columns, $options = null)
    {
        $options = $options ?? '';
        if (empty($options) || strpos($options, 'ENGINE')) {
            $options .= ' ENGINE = MergeTree()';
        }
        return parent::createTable($table, $columns, $options);
    }
}