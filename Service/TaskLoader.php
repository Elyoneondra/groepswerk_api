<?php


class TaskLoader
{
    public function __construct( DBInterface $DBI )
    {
        $this->dbinterface = $DBI;
    }

    private function taskData(array $taskData)
    {
        $task = new Task();
        $task->setTaskId($taskData['taa_id']);
        $task->setTaskDate($taskData['taa_datum']);
        $task->setTaskDescription($taskData['taa_omschr']);

        return $task;
    }

    public function getTasks(){
        $tasksData = $this->dbinterface->getData('SELECT * FROM taak');

        $tasks = array();
        foreach ($tasksData as $taskData) {
            $tasks[] = $this->taskData($taskData);
        }

        return $tasks;

    }

    public function getOneTask($id){
        $task = $this->dbinterface->getData('SELECT * FROM taak where taa_id ='.$id);
        return $task[0];
    }

    public function addTask(){
        $task = new Task();
        $task->setTaskDate($_POST['taa_datum']);
        $task->setTaskDescription($_POST['taa_omschr']);

        $sql = "INSERT INTO taak SET taa_datum = '" . $task->getTaskDate() . "', taa_omschr = '" . $task->getTaskDescription() . "'";

        return $this->dbinterface->executeSQL($sql);

    }

    public function updateTask(){
        $task = new Task();
        $task->setTaskDate($_POST['taa_datum']);
        $task->setTaskDescription($_POST['taa_omschr']);

        $sql = "UPDATE taak SET taa_datum = '" . $task->getTaskDate() . "', taa_omschr = '" . $task->getTaskDescription() . "'";

        return $this->dbinterface->executeSQL($sql);
    }

    public function deleteTask($id){
        $sql = "DELETE FROM taak WHERE taa_id = '" . $id . "'";

        return $this->dbinterface->executeSQL($sql);
    }
}