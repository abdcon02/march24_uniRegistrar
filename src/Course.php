<?php

    class Course
    {
        private $name;
        private $id;
        private $course_number;

        function __construct($name, $id = null, $course_number = 0)
        {
            $this->name = $name;
            $this->id = $id;
            $this->course_number = $course_number;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function getCourseNumber()
        {
            return $this->course_number;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setCourseNumber($new_course_number)
        {
            $this->course_number = (int) $new_course_number;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO courses (name, course_number) VALUES ('{$this->getName()}', {$this->getCourseNumber()}) RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);

        }

        static function getAll()
        {
            $all_courses = $GLOBALS['DB']->query("SELECT * FROM courses");
            $returned_courses = array();

            foreach($all_courses as $class){
                $name = $class['name'];
                $id = $class['id'];
                $course_number = $class['course_number'];
                $course = new Course($name, $id, $course_number);
                array_push($returned_courses, $course);
            }
            return $returned_courses;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses *;");
        }

    }

 ?>
