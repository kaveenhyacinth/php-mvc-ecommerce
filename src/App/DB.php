<?php

    namespace App;

    use PDO;
    use PDOException;

    /**
     * @mixin PDO
     */
    class DB
    {
        private PDO $pdo;

        /**
         * @param array $config
         */
        public function __construct(array $config)
        {
            $defaultOptions = [
              PDO::ATTR_EMULATE_PREPARES => false,
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];

            try {
                $this->pdo = new PDO(
                  $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],
                  $config['username'],
                  $config['password'],
                  $config['options'] ?? $defaultOptions
                );
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
        }

        public function __call(string $name, array $arguments)
        {
            return call_user_func_array([$this->pdo, $name], $arguments);
        }
    }