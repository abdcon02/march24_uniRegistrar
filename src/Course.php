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

        static function find($search_id)
        {
            $found_course = null;
            $courses = Course::getAll();
            foreach($courses as $class){
                if($class->getId() == $search_id){
                    $found_course = $class;
                }
            }
            return $found_course;
        }

        function updateName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE courses SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function updateCourseNumber($new_number)
        {
            $GLOBALS['DB']->exec("UPDATE courses SET course_number = '{$new_number}' WHERE id = {$this->getId()};");
            $this->setCourseNumber($new_number);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM courses_students WHERE courses_id = {$this->getId()};");
        }

        function addStudent($student)
        {
            $GLOBALS['DB']->exec("INSERT INTO courses_students (courses_id, students_id) VALUES ({$this->getId()}, {$student->getId()});");
        }

        function getStudents()
        {
            $query = $GLOBALS['DB']->query("SELECT students.* FROM
                courses JOIN courses_students ON (courses.id = courses_students.courses_id)
                JOIN students ON (courses_students.students_id = students.id)
                WHERE courses.id={$this->getId()};");
            $students_in_course = array();
            if(!empty($query)){
                foreach($query as $student) {
                    $name = $student['name'];
                    $id = $student['id'];
                    $enroll_date = $student['enrollment_date'];
                    $new_student = new Student($name, $id, $enroll_date);
                    array_push($students_in_course, $new_student);
                }
            }
            return $students_in_course;
        }

    }

 ?>
