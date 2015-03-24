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

        
    }

?>
