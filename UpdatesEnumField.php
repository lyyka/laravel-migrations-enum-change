<?php

namespace lyyka;

use DB;

/**
 * Trait UpdatesEnumField
 * @package App\Http\Controllers\Traits
 */
trait UpdatesEnumField
{
    /** @var string */
    private $table;

    /**
     * Sets the table variable which tells on which table to run the update query
     * @param string $table
     */
    protected function setTable(string $table): void
    {
        $this->table = $table;
    }

    /**
     * Converts an array of values to string which can be passed to MySQL query.
     * For example: ["a", "b", "c"] results in "'a','b','b'"
     * @param array $array
     * @return string
     */
    private function getEnumValuesString(array $array): string
    {
        // Rewrite array values so they have single quotation marks
        for ($i = 0; $i < count($array); $i++) {
            $array[$i] = "'" . $array[$i] . "'";
        }

        // Merge values with commas
        return implode(',', $array);
    }

    /**
     * Converts array of values to query string, builds the query and runs it
     * @param string $column
     * @param array $values
     */
    protected function updateDBEnum(string $column, array $values): void
    {
        // Create a string of array
        $valuesToString = $this->getEnumValuesString($values);

        // Get table
        $table = $this->table;
        
        // Run the query
        DB::statement("ALTER TABLE {$table} MODIFY COLUMN {$column} ENUM({$valuesToString})");
    }
}