<?php


class TaskLoader
{
    public function __construct( DBInterface $DBI )
    {
        $this->dbinterface = $DBI;
    }

//Toon alle taken
    public function getTasks(){
        $tasksData = $this->dbinterface->getData('SELECT * FROM taak');

        return json_encode($tasksData);

    }

//Toon 1 taak
    public function getOneTask($id){
        $task = $this->dbinterface->getData('SELECT * FROM taak where taa_id ='.$id);
        return json_encode($task[0]);
    }

//1 taak toevoegen
    public function addTask(){

        $task = file_get_contents('php://input');
        $task= json_decode($task, true);
        $taskDate = htmlentities($task['taa_datum'], ENT_QUOTES);
        $taskDescription = htmlentities($task['taa_omschr'], ENT_QUOTES);

        $sql = "INSERT INTO taak SET taa_datum = '" . $taskDate. "', taa_omschr = '" . $taskDescription. "'";

        return $this->dbinterface->executeSQL($sql);

    }

//een taak updaten
    public function updateTask($id, $data){
        $taskDate = $data['taa_datum'];
        $taskDescription = $data['taa_omschr'];

        $sql = "UPDATE taak SET taa_datum = '" .$taskDate. "', taa_omschr = '". $taskDescription . "' WHERE taa_id = '" . $id . "'";

        return $this->dbinterface->executeSQL($sql);
    }

//een taak verwijderen
    public function deleteTask($id){
        $sql = "DELETE FROM taak WHERE taa_id = '" . $id . "'";

        return $this->dbinterface->executeSQL($sql);
    }
}