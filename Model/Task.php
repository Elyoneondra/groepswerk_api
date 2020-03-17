<?php


class Task
{
    private $taskId;
    private $taskDate;
    private $taskDescription;

    /**
     * @return mixed
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * @param mixed $taskId
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
    }

    /**
     * @return mixed
     */
    public function getTaskDate()
    {
        return $this->taskDate;
    }

    /**
     * @param mixed $taskDate
     */
    public function setTaskDate($taskDate)
    {
        $this->taskDate = $taskDate;
    }

    /**
     * @return mixed
     */
    public function getTaskDescription()
    {
        return $this->taskDescription;
    }

    /**
     * @param mixed $taskDescription
     */
    public function setTaskDescription($taskDescription)
    {
        $this->taskDescription = $taskDescription;
    }


}