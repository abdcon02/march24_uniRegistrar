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

        static function find($search_id)
        {
            $found_student = null;
            $students = Student::getAll();
            foreach($students as $student){
                if($student->getId() == $search_id){
                    $found_student = $student;
                }
            }
            return $found_student;
        }

        function updateName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE students SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function updateEnrollDate($new_date)
        {
            $GLOBALS['DB']->exec("UPDATE students SET enrollment_date = '{$new_date}' WHERE id = {$this->getId()};");
            $this->setEnrollDate($new_date);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM courses_students WHERE students_id = {$this->getId()};");
        }

        function addCourse($course)
        {
            $GLOBALS['DB']->exec("INSERT INTO courses_students (courses_id, students_id) VALUES ({$course->getId()}, {$this->getId()});");
        }

        function getCourses()
        {
            $query = $GLOBALS['DB']->query("SELECT courses.* FROM
                students JOIN courses_students ON (students.id = courses_students.students_id)
                JOIN courses ON (courses_students.courses_id = courses.id)
                WHERE students.id = {$this->getId()};");

            $courses_enrolled = array();
            if(!empty($query)){
                foreach($query as $course){
                    $name = $course['name'];
                    $id = $course['id'];
                    $course_number = $course['course_number'];
                    $new_course = new Course($name, $id, $course_number);
                    array_push($courses_enrolled, $new_course);
                }
            }
            return $courses_enrolled;
        }

    }

?>
