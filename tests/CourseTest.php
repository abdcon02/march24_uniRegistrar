<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql:host=localhost;dbname=registrar_test');

    require_once "src/Course.php";
    require_once "src/Student.php";

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Course::deleteAll();
            Student::deleteAll();
        }

        function test_setId()
        {
            //Arrange
            $id = 1;
            $name = "English 101";
            $testCourse = new Course($name, $id);

            //Act
            $testCourse->setId(2);
            $result = $testCourse->getId();

            //Assert
            $this->assertEquals(2, $result);

        }

        function test_setName()
        {
            //Arrange
            $name = "Advanced French";
            $testCourse = new Course($name);

            //Act
            $testCourse->setName("Stupid English");
            $result = $testCourse->getName();

            //Assert
            $this->assertEquals("Stupid English", $result);

        }

        function test_setCourseNumber()
        {
            //Arrange
            $name = "Algebra";
            $id = 1;
            $testCourse = new Course($name, $id);

            //Act
            $testCourse->setCourseNumber(1004);
            $result = $testCourse->getCourseNumber();

            $this->assertEquals(1004, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Advanced French";
            $id = null;
            $course_number = 44;
            $testCourse = new Course($name, $id, $course_number);

            //Act
            $testCourse->save();
            $result = Course::getAll();

            //Assert
            $this->assertEquals($testCourse, $result[0]);

        }

        function test_getAll()
        {
            //Arrange
            $name = "Advanced French";
            $testCourse = new Course($name);
            $testCourse->save();

            $name2 = "Dancing in public places";
            $testCourse2 = new Course($name2);
            $testCourse2->save();
            //Act

            $result = Course::getAll();

            //Assert
            $this->assertEquals([$testCourse, $testCourse2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Advanced French";
            $testCourse = new Course($name);
            $testCourse->save();

            $name2 = "Dancing in public places";
            $testCourse2 = new Course($name2);
            $testCourse2->save();
            //Act
            Course::deleteAll();
            $result = Course::getAll();

            //Assert
            $this->assertEquals([], $result);
        }



        function test_find()
        {
            //Arrange
            $name = "Body Painting";
            $testCourse = new Course($name);
            $testCourse->save();
            $name2 = "Underwater Basket Weaving";
            $testCourse2 = new Course($name2);
            $testCourse2->save();
            //Act
            $result = Course::find($testCourse2->getId());
            //Assert
            $this->assertEquals($testCourse2, $result);
        }

        function test_updateName()
        {
            //Arrange
            $name = "Body Painting";
            $id = 1;
            $testCourse = new Course($name, $id);
            $testCourse->save();
            $new_name = "Garden Stuff";
            //Act
            $testCourse->updateName($new_name);
            //Assert
            $this->assertEquals($new_name, $testCourse->getName());
        }

        function test_updateCourseNumber()
        {
            //Arrange
            $name = "Body Painting";
            $id = 1;
            $testCourse = new Course($name, $id);
            $testCourse->save();
            $new_courseNumber = 199999;
            //Act
            $testCourse->updateCourseNumber($new_courseNumber);
            //Assert
            $this->assertEquals($new_courseNumber, $testCourse->getCourseNumber());
        }
        function test_delete()
        {
            //Arrange
            $name = "Lego Time";
            $testCourse = new Course($name);
            $testCourse->save();
            $name2 = "Underwater Basket Weaving";
            $testCourse2 = new Course($name2);
            $testCourse2->save();
            //Act
            $testCourse->delete();
            $result = Course::getAll();
            //Assert
            $this->assertEquals([$testCourse2], $result);
        }
        function testAddStudent()
        {
            //Arrange
            $name = "Learning World Domination";
            $id = 1;
            $testCourse = new Course($name, $id);
            $testCourse->save();

            $student = "Hal";
            $testStudent = new Student($student);
            $testStudent->save();

            //Act
            $testCourse->addStudent($testStudent);

            //Assert
            $this->assertEquals($testCourse->getStudents(), [$testStudent]);
        }
        function testGetStudents()
        {
            //Arrange
            $name = "Break Dancing";
            $id = 1;
            $testCourse = new Course($name, $id);
            $testCourse->save();

            $student = "Alvin";
            $student_id = 1;
            $testStudent = new Student($student, $student_id);
            $testStudent->save();

            $student2 = "Billy Jean";
            $student_id2 = 2;
            $testStudent2 = new Student($student2, $student_id2);
            $testStudent2->save();
            //Act
            $testCourse->addStudent($testStudent);
            $testCourse->addStudent($testStudent2);
            //Assert
            $this->assertEquals($testCourse->getStudents(), [$testStudent, $testStudent2]);
        }
        // function testDelete()
        // {
        //     //Arrange
        //     $name = "Archery";
        //     $id = 1;
        //     $testCourse = new Course($name, $id);
        //     $testCourse->save();
        //
        //     $student = "Billy Bob";
        //     $testStudent = new Student($student);
        //     $testStudent->save();
        //     //Act
        //     $testCourse->addStudent($testStudent);
        //     $testCourse->delete();
        //     //Assert
        //     $this->assertEquals([], $testStudent->getCourses());
        // }

    }

?>
