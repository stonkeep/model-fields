<?php


namespace stonkeep\ModelFields;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait ModelFieldsTrait
{
    /**
     * returns model fields
     *       * If data comes back, the data belonging to MODEL
     * @param null $data
     * @return array
     */
    public static function fields($data = null)
    {
        //takes columns from class tables
        $fields = Schema::getColumnListing((new self())->getTable());
        //alternate fields with keys
        $fields = array_flip($fields);;
        //checks if hiddenFields field exists in class and remove unwanted fields
        if (property_exists(self::class, 'hiddenFields')) {
            foreach ((new self())->hiddenFields as $item) {
                unset($fields[$item]);
            }
        }
        //remove hidden fields
        foreach ((new self())->getHidden() as $item) {
            unset($fields[$item]);
        }
        //Remove dates
        foreach ((new self())->getDates() as $item) {
            unset($fields[$item]);
        }
        //Remove guarded
        foreach ((new self())->getGuarded() as $item) {
            unset($fields[$item]);
        }
        //alternate fields with keys
        $fields = array_keys($fields);
        if (!is_null($data)) {
            if (is_array($data)) {
                if (isList($data)) {
                    $data = collect($data)->only($fields)->toArray();
                } else {
                    $data = array_map(function ($item) use ($fields) {
                        return collect($item)->only($fields)->toArray();
                    }, $data);
                }
            }
        }
        //if data was passed in the parameter then returns the data consistent with the table. If not, returns only the fields in the table
        return $data ?: $fields;
    }
}
