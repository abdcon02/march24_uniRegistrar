<?php

    class Student
    {
        private $name;
        private $enroll_date;
        private $id;

        function __construct($name, $id = null, $enroll_date = '2015-03-24')
        {
            $this->name = $name;
            $this->enroll_date = $enroll_date;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function getEnrollDate()
        {
            return $this->enroll_date;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setEnrollDate($new_enroll_date)
        {
            $this->enroll_date = (string) $new_enroll_date;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO students (name, enrollment_date) VALUES ('{$this->getName()}', '{$this->getEnrollDate()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);

        }

        static function getAll()
        {
            $all_students = $GLOBALS['DB']->query("SELECT * FROM students");
            $returned_students = array();

            foreach($all_students as $student){
                $name = $student['name'];
                $id = $student['id'];
                $enroll_date = $student['enrollment_date'];
                $student = new Student($name, $id, $enroll_date);
                array_push($returned_students, $student);
            }
            return $returned_students;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students *;");
        }
    }

?>
