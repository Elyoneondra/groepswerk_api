<?php


class TaskLoader
{
    private $dbinterface;
    private $messageservice;

    public function __construct( DBInterface $DBI, MessageService $messageService )
    {
        $this->dbinterface = $DBI;
        $this->messageservice = $messageService;
    }

//Toon alle taken
    public function getTasks(){
        $tasksData = $this->dbinterface->getData('SELECT * FROM taak');

        return json_encode($tasksData);

    }

//Toon 1 taak
    public function getOneTask($id){
        $task = $this->dbinterface->getData('SELECT * FROM taak where taa_id ='.$id);

        //Als de taak niet bestaat
        if(!$task) return $this->messageservice->AddMessage("Sorry, deze taak bestaat niet!", "error");

        return json_encode($task[0]);
    }

//1 taak toevoegen
    public function addTask(){
        $task = file_get_contents('php://input');
        $task= json_decode($task, true);

        $taskDate = htmlentities($task['taa_datum'], ENT_QUOTES);
        $taskDescription = htmlentities($task['taa_omschr'], ENT_QUOTES);

        //Datum controleren
        $dateFormat = "Y-m-d";
        $checkDate = DateTime::createFromFormat($dateFormat, $taskDate);
        $correctDate = $checkDate && $checkDate->format($dateFormat) == $taskDate;

        if (!$correctDate) return $this->messageservice->AddMessage("Sorry, incorrecte datum!", "error");
        if (strlen($taskDescription) > 30) return $this->messageservice->AddMessage("Sorry, de taak omschrijving mag niet langer dan 30 karakters zijn", "error");


        $sql = "INSERT INTO taak SET taa_datum = '" . $taskDate . "', taa_omschr = '" . $taskDescription . "'";

        return $this->dbinterface->executeSQL($sql);
    }

//een taak updaten
    public function updateTask($id, $data){
        //Check if task exists
        $task = $this->dbinterface->getData('SELECT * FROM taak where taa_id ='.$id);

        $taskDate = $data['taa_datum'];
        $taskDescription = $data['taa_omschr'];

        //Datum controleren
        $dateFormat = "Y-m-d";
        $checkDate = DateTime::createFromFormat($dateFormat, $taskDate);
        $correctDate = $checkDate && $checkDate->format($dateFormat) == $taskDate;

        if (!$task){
            return $this->messageservice->AddMessage("Sorry, deze taak bestaat niet!", "error");
        }
        else {
            if (!$correctDate) return $this->messageservice->AddMessage("Sorry, incorrecte datum!", "error");
            if (strlen($taskDescription) > 30) return $this->messageservice->AddMessage("Sorry, de taak omschrijving mag niet langer dan 30 karakters zijn", "error");

            $sql = "UPDATE taak SET taa_datum = '" .$taskDate. "', taa_omschr = '". $taskDescription . "' WHERE taa_id = '" . $id . "'";

            return $this->dbinterface->executeSQL($sql);
        }
    }

//een taak verwijderen
    public function deleteTask($id){
        //Check if task exists
        $task = $this->dbinterface->getData('SELECT * FROM taak where taa_id ='.$id);

        if (!$task) return $this->messageservice->AddMessage("Sorry, deze taak bestaat niet!", "error");
        else $sql = "DELETE FROM taak WHERE taa_id = '" . $id . "'";

        return $this->dbinterface->executeSQL($sql);
    }
}