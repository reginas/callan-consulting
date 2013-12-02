<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

/**
 * Map array keys/columns with real column table names with requested types, then you can make sql with this
 */
class TF_DBC
{
    protected static $table_name = '';
    public static $valid_types = array(
        'INT'       => "(11) NOT NULL DEFAULT 0",
        'BIGINT'    => "(20) NOT NULL DEFAULT 0",
        'DATE'      => " DEFAULT NULL",
        'DATETIME'  => " DEFAULT NULL",
        'TIMESTAMP' => " DEFAULT 0",
        'VARCHAR'   => "(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''",
        'TEXT'      => " DEFAULT NULL",
        'LONGTEXT'  => " DEFAULT NULL",
        'DECIMAL'   => "(15,2) NOT NULL DEFAULT 0", // only price format is available in dbc for decimal type
    );
    protected static $default_columns   = array(
        'id'        => "BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY",
        '_group'    => "VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Group rows, like virtual tables'", // required
        '_key'      => "VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Like key in array, or id'"  // required
    );
    protected static $tableColumns      = array(); // Table columns from database
    protected static $reservedColumns   = array('_group', '_key');

    // For storing registered maps key orders
    protected static $registeredMaps        = NULL; // db cache
    protected static $registeredMapsMapped  = array(); // mapped cache
    protected static $registeredMapsID      = '__self__registered_maps';
    protected static $mapRegisteredMaps     = array('value'=>'longtext');

    public static function __init()
    {
        if (self::$table_name) return;

        global $wpdb;

        self::$table_name = $wpdb->prefix .'tf_'. strtolower(preg_replace('/[^A-Za-z]/', '_', TF_THEME_PREFIX)) .'_dynamic_container';
    }

    public static function __destructor()
    {
        // Save $registeredMaps options
        if (!( self::$registeredMaps )) return;

        $map = self::map( self::$mapRegisteredMaps );

        if (!count( self::select($map, array(
            '_group'    => self::$registeredMapsID,
            'where'     => array(
                '_key'  => "='".(self::$registeredMapsID)."'"
            ),
            'suffix'    => 'LIMIT 1'
        )) )) { // Insert if not exists
            self::insert($map, array(
                array(
                    '_group'    => self::$registeredMapsID,
                    '_key'      => self::$registeredMapsID
                )
            ));
        }

        self::update( $map, array(
            '_group'    => self::$registeredMapsID,
            'set'       => array(
                'value' => serialize( self::$registeredMaps )
            ),
            'where'     => array(
                '_key'  => "='".(self::$registeredMapsID)."'"
            ),
            'suffix'    => 'LIMIT 1'
        ) );
    }

    protected static function getRegisteredMaps()
    {
        $map = self::map( self::$mapRegisteredMaps );

        if ( self::$registeredMaps === NULL ) {
            $row = self::select($map, array(
                '_group'    => self::$registeredMapsID,
                'where'     => array(
                    '_key'  => "='".(self::$registeredMapsID)."'"
                ),
                'suffix'    => 'LIMIT 1'
            ));

            $row = array_shift($row);

            self::$registeredMaps = unserialize( $row['value'] );
        }

        return (self::$registeredMaps);
    }

    /**
     * @param array $columns astructure: array( 'columns_name' => 'SQL with column type definition', ... )
     * @param bool $defaultColumns create or not default columns (error if allready exists)
     */
    protected static function createTable($columns = array(), $defaultColumns = false)
    {
        $sql        = "CREATE TABLE ".(self::$table_name)." (";
        $counter    = 0;

        if ($defaultColumns) {
            foreach ((self::$default_columns) as $key=>$val)
            {
                $sql .= ($counter++ ? "," : "")."
                    ".$key." ".$val;
            }
        }

        if (count($columns)) { // append custom columns
            foreach ($columns as $key=>$val) {
                $sql .= ($counter++ ? "," : "")."
                    ".$key." ".$val;
            }
        }

        if ($defaultColumns)
            $sql .= ",
                UNIQUE `unique_grup_key` (`_group`, `_key`)";

        $sql .= "
            ) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        if ($counter)
            @dbDelta($sql);
    }

    /**
     * Load table columns from database
     */
    protected static function getColumns($forceDbRead = false, $withDefault = false)
    {
        global $wpdb;

        if ($forceDbRead || !(self::$tableColumns))
        {
            if (!(self::$tableColumns)) {
                if (!count( @$wpdb->get_results( $wpdb->prepare("SHOW TABLES LIKE %s", self::$table_name) ) )) {
                    self::createTable(array(), true);
                }
            }

            $doWhile = true;
            $counter = 0;
            while ($doWhile)
            {
                $tableColumns = $wpdb->get_results('SHOW COLUMNS FROM ' . self::$table_name);
                if (!count($tableColumns)) {
                    self::createTable(array(), true);
                    $tableColumns = $wpdb->get_results('SHOW COLUMNS FROM ' . self::$table_name);
                }

                self::$tableColumns = array();
                foreach ($tableColumns as $column) {
                    self::$tableColumns[ $column->Field ] = '~';
                }
                $tableColumns = self::$tableColumns;

                // Check if default columns exists
                $rereadColumns = false;
                foreach (self::$default_columns as $key=>$val)
                {
                    if (!isset( $tableColumns[ $key ] )) {
                        self::createTable();
                        $rereadColumns = true;
                        break;
                    }
                }

                $counter++;

                if ($rereadColumns) {
                    if ($counter > 1)
                        die(sprintf(__('To many while() iterations in %s ()', 'tfuse'), __METHOD__));
                    continue;
                } else {
                    $doWhile = false;
                }
            }
        }

        $tableColumns = self::$tableColumns;

        if (!$withDefault) { // Exclude default columns, leave only dynamic generated
            $defalut_columns = self::$default_columns;
            foreach ($tableColumns as $key=>$val) {
                if (isset($defalut_columns[ $key ])) {
                    unset($tableColumns[$key]);
                }
            }
        }

        return $tableColumns;
    }

    /**
     * Check if table exists, if has necessary columns, and create if not
     */
    protected static function allocColumns($columns)
    {
        global $wpdb;

        $touchTable     = false;

        $tableColumns   = self::getColumns();

        $availableTypes = // array( 'varchar'=>3(columns), 'int'=>2(columns), ... )
        $maxIncrements  = // Find max increments in field names from table for each type (varchar=12, int=7, text=0, ...)
            array_fill_keys( array_keys( self::$valid_types), 0 );
        if (count($tableColumns)) {
            foreach (array_keys($tableColumns) as $column) {
                $tmp        = explode('_', $column);
                $type       = $tmp[0];
                $increment  = intval($tmp[1]);
                unset($tmp);

                if (!isset( self::$valid_types[ $type ] ))
                    continue;

                // find max increment
                if ($maxIncrements[ $type ] < $increment)
                    $maxIncrements[ $type ] = $increment;

                // count available types
                $availableTypes[ $type ]++;
            }
        }

        // Find what columns need to create
        foreach ($columns as $key=>$type) {
            $availableTypes[ $type ]--; // if x < 0 , will be created
        }

        $createColumns = array();
        foreach ($availableTypes as $type=>$count) {
            while ( ($availableTypes[$type]++) < 0 ) {
                $createColumns[ $type .'_'. (++$maxIncrements[$type]) ] = $type . self::$valid_types[$type];
            }
        }

        if (count($createColumns)) {
            self::createTable($createColumns);
            self::getColumns(true); // reload from db (replace cache)
        }
    }

    /**
     * Check if array for mapping has invalid types specified
     */
    protected static function hasInvalidTypes($columns)
    {
        foreach($columns as $key=>$val)
        {
            if ( !isset( self::$valid_types[ strtoupper($val) ] ) )
                return true;
        }

        return false;
    }

    /**
     * Table name where is stored all data
     */
    public static function getTableName()
    {
        return self::$table_name;
    }

    /**
     * Input:  array( 'a'=>'varchar', 'b'=>'varchar', 'c'=>'int' ) // 'a','b','c',... should be safe strings [a-z][_a-z0-9]
     * * array( '<custom-name-used-only-in-code>'=>'<required-type>')
     *
     * Return: array( 'a'=>'varchar_1', 'b'=>'varchar_2', 'c'=>'int_1' )
     * * array( '<custom-name-used-only-in-code>'=>'<mapped-table-column>')
     */
    private static function map($columns)
    {
        $columns = array_map('strtoupper', $columns);

        if (self::hasInvalidTypes($columns))
            die(sprintf(__('Invalid column type "%s" given in %s ()', 'tfuse'), print_r(array_values($columns), true), __METHOD__));

        self::allocColumns($columns);

        $dbColumns = self::getColumns();
        ksort( $dbColumns );
        $newColumns             = $columns; // new version of $columns with mapped fields
        $countColumns           = count($columns); // how many columns remains not mapped
        $exitingTypesInColumns  = array_fill_keys( array_keys( self::$valid_types), true);
        /// if this type exists anymore in $columns, else skip searching without sense
        foreach ($dbColumns as $column=>$val)
        {
            $tmp  = explode('_', $column);
            $type = $tmp[0];

            if(!$exitingTypesInColumns[$type])
                continue;

            if ( FALSE === ($Key = array_search($type, $columns)) ) { // Find column with this $type
                $exitingTypesInColumns[$type] = false; // If not found, do not search anymore for $type like that
                continue;
            } else {
                $newColumns[ $Key ] = $column;
                unset( $columns[$Key] );

                $countColumns--;
                if($countColumns < 1) break; // If no more columns to map
            }
        }

        if($countColumns>0) die(sprintf(__('Something wrong happened: %s () not allocated all columns', 'tfuse'), __METHOD__));

        return $newColumns;
    }

    /**
     * Register map columns to a group (where the order of columns is maintained internally, to maintain data consistency)
     * Return: mapped columns (if allready registered, you can get it via ::get_map($group)
     */
    public static function register_map($id, $columns)
    {
        $maps = self::getRegisteredMaps();

        if (!isset($maps[$id]))
            $maps[$id] = array();

        $columns = array_map('strtoupper', $columns);

        $newMap = array();
        // Order old/existing keys as they was last time (this is saved in db), and move them to $newMap
        if (count($maps[$id]))
        {
            foreach ($maps[$id] as $alias=>$val) {
                if (isset( $columns[$alias] )) {
                    if ( $maps[$id][$alias] != $columns[$alias] )
                        die(sprintf(__('Field "%s" from mapId="%s" already defined sometimes, has different type: oldType="%s", newType="%s".
                            %s You cannot use another type for that fieldName, please provide another fieldName or use the old type.', 'tfuse'), $alias, $id, $maps[$id][$alias], $columns[$alias], '<br/>'));

                    $newMap[ $alias ] = $columns[$alias];
                    unset($columns[$alias]);
                } else {
                    $newMap[ $alias ] = $maps[$id][ $alias ];
                }
            }
        }
        // Append the rest (columns that do not exists in db, next time new registers will be ordered by this)
        if (count($columns))
        {
            foreach ($columns as $alias=>$key)
            {
                $newMap[ $alias ] = $columns[$alias];
                unset($columns[$alias]);
            }
        }

        $maps[$id] = $newMap;

        self::$registeredMapsMapped[$id] = self::map($maps[$id]);

        // assign this after ::map(), to be sure it contains correct types for fields, ::map() check types
        self::$registeredMaps = $maps;

        return self::$registeredMapsMapped[$id];
    }

    /**
     * Return already registered map
     */
    public static function get_map($id)
    {
        if (!isset( self::$registeredMapsMapped[$id] ))
            die(sprintf(__('Map id "%s" is not registered, in %s ()', 'tfuse'), $id, __METHOD__));

        return self::$registeredMapsMapped[$id];
    }

    /**
     * Use this instead creating manual sql for inserting data in container
     * First argument: array returned by ::map()
     * Second argument: array with arrays of data with key names like in array from first argument
     */
    public static function insert($map, $rows, $debug = false)
    {
        global $wpdb;

        if (!count($rows)) return;

        $sqlColumns = array_merge(
            array_fill_keys( self::$reservedColumns, '~' ),
            array_flip($map)
        );

        $sql = "INSERT INTO ".(self::getTableName())."
            (".implode(', ', array_keys($sqlColumns)).")
            VALUES ";

        $sqlColumnsCount    = count($sqlColumns);
        $sqlRows            = array();
        $counter            = 0;
        foreach ($rows as $row)
        {
            foreach ($sqlColumns as $column=>$alias) {
                if ( in_array($column, self::$reservedColumns) ) {

                    if (!isset( $row[ $column ] ))
                        die(sprintf(__('Required key "%s" not found in row, in %s ()', 'tfuse'), $column, __METHOD__));

                    $newSqlRow[ $column ] = $wpdb->prepare('%s', $row[ $column ]);
                } else {
                    if (isset( $row[ $alias ] ))
                        $newSqlRow[ $column ] = $wpdb->prepare('%s', $row[ $alias ]);
                    else
                        $newSqlRow[ $column ] = "''";
                }
            }

            $sql .= ($counter++ ? ',' : '')."
                (". implode(', ', $newSqlRow) .")";
        }

        if ($debug)
            tf_print($sql);

        if ($counter)
            return $wpdb->query($sql);
        else
            return null;
    }

    /**
     * Use this instead creating manual sql for simple selects
     * First argument: array returned by ::map()
     * Second argument: array with conditions
     */
    public static function select($map, $options, $debug = false)
    {
        global $wpdb;

        // Options array structure
        // ! Be sure that in $options are safe sql strings (sql injections... use $wpdb->prepare(...))
        array(
            '_group'    => 'my_group_name', // required // string or array, if array, will generate _group IN (...)
            'where'     => array( // optional // Array or String " AND _key IN (1,2,5)"
                'mappedColumnsAliasKey1' => "=7", // [key from $map] => 'sql' >--result--> $map[key].' sql'
                'mappedColumnsAliasKey2' => "='foo'",
                'mappedColumnsAliasKey3' => "LIKE 'bar%'",
            ),
            'sql_joins' => '"INNER JOIN ".$wpdb->posts." AS posts ON posts.ID = ".$map["alias"]', // optional // placed after FROM
            'suffix'    => '...' // optional // appended to the end of the sql // LIMIT '5' or '5,10' // ORDER BY $map["alias"] ASC ...
        );

        // Verify $options structure
        if (!isset( $options['_group'] ))
            die(sprintf(__('Required option "_group" not found in $options, in %s ()', 'tfuse'), __METHOD__));

        // Generate select sql
        $sql =  "SELECT ";

        $sql .= "\n".implode(', ', self::$reservedColumns);
        foreach ($map as $alias=>$column) {
            $sql .= ",\n". $column .' AS '. $alias;
        }

        $sql .= "\n  FROM ". (self::getTableName()) ." AS tf_container";

        if (isset( $options['sql_joins'] ))
            $sql .= "\n". $options['sql_joins'];

        $sql .= "\n  WHERE _group";
        if (is_array($options['_group'])) {
            foreach ($options['_group'] as $key=>$_group)
                $options['_group'][ $key ] = $wpdb->prepare('%s', $_group);
            $sql .= " IN (". implode(',', $options['_group']) .")";
        } else {
            $sql .= " = ". $wpdb->prepare('%s', $options['_group']);
        }
        $sql .= " ";

        if (isset($options['where']))
        {
            if (is_array($options['where']))
            {
                $where = array();
                foreach ($options['where'] as $alias=>$sqlWhere)
                {
                    if ( in_array($alias, self::$reservedColumns) )
                        $field   = $alias;
                    elseif (!isset( $map[ $alias ] ))
                        die(sprintf(__('Invalid argument "%s" given in $options["where"] (not found alias in $map), in %s ()', 'tfuse'), $alias, __METHOD__));
                    else
                        $field   = $map[ $alias ];

                    $where[] = $field ." ". trim($sqlWhere);
                }

                $sql .= "\n    AND ". implode(' AND ', $where);
            }
            else
            {
                $sql .= "\n    AND ". $options['where'];
            }
        }

        if (isset($options['suffix']) && trim($options['suffix']))
            $sql .= "\n  ".$options['suffix'];

        if ($debug)
            tf_print($sql);

        return $wpdb->get_results($sql, ARRAY_A);
    }

    /**
     * Use this instead creating manual sql for simple updates
     * First argument: array returned by ::map()
     * Second argument: array with conditions
     */
    public static function update($map, $options, $debug = false)
    {
        global $wpdb;

        // Options array structure
        // ! Be sure that in $options are safe sql strings (sql injections... use $wpdb->prepare(...))
        array(
            '_group'    => 'my_group_name', // required // string or array, if array, will generate _group IN (...)
            'set'       => array( // required // Array or String for SET." ".$map[key]." = 'foo'"
                'mappedColumnsAliasKey1' => "7", // [key from $map] => value >--result--> $map[key]."='value'"
                'mappedColumnsAliasKey2' => "foo",
                'mappedColumnsAliasKey3' => "2012-02-28",
            ),
            'where'     => array( // optional // Array or String " AND _key IN (1,2,5)"
                'mappedColumnsAliasKey1' => "=7", // [key from $map] => 'sql' >--result--> $map[key].' sql'
                'mappedColumnsAliasKey2' => "='foo'",
                'mappedColumnsAliasKey3' => "LIKE 'bar%'",
            ),
            'suffix'    => '...' // optional // appended to the end of the sql // LIMIT '5' or '5,10' // ORDER BY $map["alias"] ASC ...
        );

        // Verify $options structure
        if (!isset( $options['_group'] ))
            die(sprintf(__('Required option "_group" not found in $options, in %s ()', 'tfuse'), __METHOD__));
        if (!isset( $options['set'] ))
            die(sprintf(__('Required option "set" not found in $options, in ()', 'tfuse'), __METHOD__));

        // Generate update sql
        $sql =  "UPDATE ". (self::getTableName()) ." SET";

        if (is_array($options['set']))
        {
            $set = array();
            foreach ($options['set'] as $alias=>$value)
            {
                if ( in_array($alias, self::$reservedColumns) )
                    $field   = $alias;
                elseif (!isset( $map[ $alias ] ))
                    die(sprintf(__('Invalid argument "%s" given in $options["set"] (not found alias in $map), in %s ()', 'tfuse'), $alias, __METHOD__));
                else
                    $field   = $map[ $alias ];

                $set[] = $field ." = ". $wpdb->prepare('%s', $value);
            }

            $sql .= "\n". implode(", \n", $set);
        }
        else
        {
            $sql .= "\n". $options['set'];
        }

        $sql .= "\n  WHERE _group";
        if (is_array($options['_group'])) {
            foreach ($options['_group'] as $key=>$_group)
                $options['_group'][ $key ] = $wpdb->prepare('%s', $_group);
            $sql .= " IN (". implode(',', $options['_group']) .")";
        } else {
            $sql .= " = ". $wpdb->prepare('%s', $options['_group']);
        }
        $sql .= " ";

        if (isset($options['where']))
        {
            if (is_array($options['where']))
            {
                $where = array();
                foreach ($options['where'] as $alias=>$sqlWhere)
                {
                    if ( in_array($alias, self::$reservedColumns) )
                        $field   = $alias;
                    elseif (!isset( $map[ $alias ] ))
                        die(sprintf(__('Invalid argument "%s" given in $options["where"] (not found alias in $map), in %s ()', 'tfuse'), $alias, __METHOD__));
                    else
                        $field   = $map[ $alias ];

                    $where[] = $field ." ". trim($sqlWhere);
                }

                $sql .= "\n    AND ". implode(' AND ', $where);
            }
            else
            {
                $sql .= "\n    AND ". $options['where'];
            }
        }

        if (isset($options['suffix']) && trim($options['suffix']))
            $sql .= "\n  ".$options['suffix'];

        if ($debug)
            tf_print($sql);

        return $wpdb->query($sql);
    }

    /**
     * Use this instead creating manual sql for simple deletes
     * First argument: array returned by ::map()
     * Second argument: array with conditions
     */
    public static function delete($map, $options, $debug = false)
    {
        global $wpdb;

        // Options array structure
        // ! Be sure that in $options are safe sql strings (sql injections... use $wpdb->prepare(...))
        array(
            '_group'    => 'my_group_name', // required // string or array, if array, will generate _group IN (...)
            'where'     => array( // optional // Array or String " AND _key IN (1,2,5)"
                'mappedColumnsAliasKey1' => "=7", // [key from $map] => 'sql' >--result--> $map[key].' sql'
                'mappedColumnsAliasKey2' => "='foo'",
                'mappedColumnsAliasKey3' => "LIKE 'bar%'",
            ),
            'suffix'    => '...' // optional // appended to the end of the sql // LIMIT '5' or '5,10' // ORDER BY $map["alias"] ASC ...
        );

        // Verify $options structure
        if (!isset( $options['_group'] ))
            die(sprintf(__('Required option "_group" not found in $options, in %s ()', 'tfuse'), __METHOD__));

        // Generate update sql
        $sql =  "DELETE FROM ". (self::getTableName());

        $sql .= "\n  WHERE _group";
        if (is_array($options['_group'])) {
            foreach ($options['_group'] as $key=>$_group)
                $options['_group'][ $key ] = $wpdb->prepare('%s', $_group);
            $sql .= " IN (". implode(',', $options['_group']) .")";
        } else {
            $sql .= " = ". $wpdb->prepare('%s', $options['_group']);
        }
        $sql .= " ";

        if (isset($options['where']))
        {
            if (is_array($options['where']))
            {
                $where = array();
                foreach ($options['where'] as $alias=>$sqlWhere)
                {
                    if ( in_array($alias, self::$reservedColumns) )
                        $field   = $alias;
                    elseif (!isset( $map[ $alias ] ))
                        die(sprintf(__('Invalid argument "%s" given in $options["where"] (not found alias in $map), in %s ()', 'tfuse'), $alias, __METHOD__));
                    else
                        $field   = $map[ $alias ];

                    $where[] = $field ." ". trim($sqlWhere);
                }

                $sql .= "\n    AND ". implode(' AND ', $where);
            }
            else
            {
                $sql .= "\n    AND ". $options['where'];
            }
        }

        if (isset($options['suffix']) && trim($options['suffix']))
            $sql .= "\n  ".$options['suffix'];

        if ($debug)
            tf_print($sql);

        return $wpdb->query($sql);
    }
}

// Required to init tableName and others...
TF_DBC::__init();

// (hack) Register __destruct
class __TF_TEMP_DB_CONTAINER_CLASS {
    public function __destruct() {
        TF_DBC::__destructor();
    }
}
$__TF_TEMP_DB_CONTAINER_CLASS = new __TF_TEMP_DB_CONTAINER_CLASS();

/**
 * cleaner way to work with dbc (instead of TF_DBC class)
 */
class TF_DBC_CLIENT
{
    protected $map_id   = null;
    protected $_group   = null;

    protected $columns  = null;

    protected $map      = null;

    protected $debug    = false;

    public function __construct($map_id, $_group, $columns = null, $columns_limit = 33)
    {
        /**
         * If columns are set.
         * If not, they can be later returned by filter in lazy_init()
         * (in case when you need to create an instance, but columns are available later from filters)
         */
        if ($columns !== null) {
            if (count($columns) > $columns_limit) {
                trigger_error(get_class($this).': columns limit '.$columns_limit.' exceeded. (map_id='.$map_id.', _group='.$_group.')', E_USER_ERROR);
                return;
            }
            $this->columns = $columns;
        }

        $this->map_id   = $map_id;
        $this->_group   = $_group;
    }

    protected function lazy_init()
    {
        if ($this->map !== null)
            return;

        if ($this->columns === null) {
            $filter_name    = 'tf_dbc_client_lazy_init__'. $this->map_id .'__'. $this->_group;
            $result         = apply_filters($filter_name, array());
            if (empty($result['columns']) || !isset($result['columns'])) {
                trigger_error(get_class($this).': ' . sprintf(__('Lazy init filter returned invalid result. (map_id=%s, _group=%s)', 'tfuse'), $this->map_id, $this->_group), E_USER_ERROR);
                return;
            }

            $this->columns = $result['columns'];
        }

        $this->map = TF_DBC::register_map($this->map_id, $this->columns);
    }

    public function get_map($key = null)
    {
        $this->lazy_init();

        return ($key !== null ? $this->map[$key] : $this->map);
    }

    public function get_group()
    {
        return $this->_group;
    }
    public function set_group($new_group)
    {
        $this->_group = trim($new_group);
    }

    public function get_debug()
    {
        return $this->debug;
    }
    public function set_debug($value)
    {
        $this->debug = (bool)$value;
    }

    public function get_table_name()
    {
        return TF_DBC::getTableName();
    }

    public function insert($rows)
    {
        if (!count($rows))
            return;

        foreach ($rows as $key => $row) {
            if (!isset($row['_group'])) {
                $rows[$key]['_group'] = $this->_group;
            }
        }

        return TF_DBC::insert($this->get_map(), $rows, $this->get_debug());
    }

    public function select($where = null, $suffix = null, $sql_joins = null, $_group = null)
    {
        $args = array();

        $args['_group'] = $_group === null ? $this->_group : $_group;

        if ($where !== null)
            $args['where'] = $where;

        if ($sql_joins !== null)
            $args['sql_joins'] = $sql_joins;

        if ($suffix !== null)
            $args['suffix'] = $suffix;

        return TF_DBC::select($this->get_map(), $args, $this->get_debug());
    }

    public function update($set, $where = null, $suffix = null, $_group = null)
    {
        $args = array();

        $args['_group'] = $_group === null ? $this->_group : $_group;

        $args['set']    = $set;

        if ($where !== null)
            $args['where'] = $where;

        if ($suffix !== null)
            $args['suffix'] = $suffix;

        return TF_DBC::update($this->get_map(), $args, $this->get_debug());
    }

    public function delete($where = null, $suffix = null, $_group = null)
    {
        $args = array();

        $args['_group'] = $_group === null ? $this->_group : $_group;

        if ($where !== null)
            $args['where'] = $where;

        if ($suffix !== null)
            $args['suffix'] = $suffix;

        return TF_DBC::delete($this->get_map(), $args, $this->get_debug());
    }
}