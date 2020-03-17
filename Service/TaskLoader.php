<?php


class TaskLoader
{
    public function __construct( DBInterface $DBI )
    {
        $this->dbinterface = $DBI;
    }

    public function getTasks(){

        echo json_encode();
    }

    public function getOneTask($id){

        echo json_encode();
    }

    public function addTask(){

        echo json_encode();
    }

    public function updateTask(){

        echo json_encode();
    }

    public function deleteTask($id){

        echo json_encode();
    }
}