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

    }

?>
