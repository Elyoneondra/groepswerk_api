<?php


class Config_example
{
    private $application_folder = "";
    private $root_folder;

    private $db_host = "";
    private $db_database = "";
    private $db_user = '';
    private $db_pass = '';

    public function __construct( $path )
    {
        $this->application_folder = $path;
        $this->root_folder = $_SERVER['DOCUMENT_ROOT'] . $this->application_folder ;
    }

    /**
     * @return string
     */
    public function getDbHost()
    {
        return $this->db_host;
    }

    /**
     * @return string
     */
    public function getDbDatabase()
    {
        return $this->db_database;
    }


    /**
     * @return string
     */
    public function getApplicationFolder()
    {
        return $this->application_folder;
    }

    /**
     * @return string
     */
    public function getRootFolder()
    {
        return $this->root_folder;
    }

    /**
     * @return string
     */
    public function getDbDsn()
    {
        return 'mysql:host=' . $this->getDbHost() . ';dbname=' . $this->getDbDatabase();
    }

    /**
     * @return string
     */
    public function getDbUser()
    {
        return $this->db_user;
    }

    /**
     * @return string
     */
    public function getDbPass()
    {
        return $this->db_pass;
    }

}