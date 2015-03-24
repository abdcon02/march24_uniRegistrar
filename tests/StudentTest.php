<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql:host=localhost;dbname=registrar_test');

    require_once "src/Student.php";
    require_once "src/Course.php";

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();
        }

        function test_setId()
        {
            //Arrange
            $id = 1;
            $name = "John Smith";
            $testStudent = new Student($name, $id);

            //Act
            $testStudent->setId(2);
            $result = $testStudent->getId();

            //Assert
            $this->assertEquals(2, $result);

        }

        function test_setName()
        {
            //Arrange
            $name = "John Smith";
            $testStudent = new Student($name);

            //Act
            $testStudent->setName("Pocahontas");
            $result = $testStudent->getName();

            //Assert
            $this->assertEquals("Pocahontas", $result);

        }

        function test_setEnrollDate()
        {
            //Arrange
            $name = "John Doe";
            $id = 1;
            $testStudent = new Student($name, $id);

            //Act
            $testStudent->setEnrollDate("2015-01-01");
            $result = $testStudent->getEnrollDate();

            $this->assertEquals("2015-01-01", $result);
        }

        function test_save()
        {
            //Arrange
            $name = "George Washington";
            // $id = 1;
            // $enroll_date = "2015-01-01";
            $testStudent = new Student($name);

            //Act
            $testStudent->save();
            $result = Student::getAll();

            //Assert
            $this->assertEquals($testStudent, $result[0]);

        }

        function test_getAll()
        {
            //Arrange
            $name = "John Adams";
            $testStudent = new Student($name);
            $testStudent->save();

            $name2 = "Thomas Jefferson";
            $testStudent2 = new Student($name2);
            $testStudent2->save();
            //Act

            $result = Student::getAll();

            //Assert
            $this->assertEquals([$testStudent, $testStudent2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $name = "John Madison";
            $testStudent = new Student($name);
            $testStudent->save();

            $name2 = "Benjamin Franklin";
            $testStudent2 = new Student($name2);
            $testStudent2->save();

            //Act
            Student::deleteAll();
            $result = Student::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Ron Swanson";
            $testStudent = new Student($name);
            $testStudent->save();
            $name2 = "Leslie Knope";
            $testStudent2 = new Student($name2);
            $testStudent2->save();
            //Act
            $result = Student::find($testStudent2->getId());
            //Assert
            $this->assertEquals($testStudent2, $result);
        }

        function test_updateName()
        {
            //Arrange
            $name = "Ron Swanson";
            $testStudent = new Student($name);
            $testStudent->save();
            $new_name = "Leslie Knope";
            //Act
            $testStudent->updateName($new_name);
            //Assert
            $this->assertEquals($new_name, $testStudent->getName());
        }

        function test_updateEnrollDate()
        {
            //Arrange
            $name = "Bob Ross";
            $testStudent = new Student($name);
            $testStudent->save();
            $new_enrollDate = "2015-01-01";

            //Act
            $testStudent->updateEnrollDate($new_enrollDate);

            //Assert
            $this->assertEquals($new_enrollDate, $testStudent->getEnrollDate());
        }

        function test_delete()
        {
            //Arrange
            $name = "Fred Rogers";
            $testStudent = new Student($name);
            $testStudent->save();

            $name2 = "John Doe";
            $testStudent2 = new Student($name2);
            $testStudent2->save();

            //Act
            $testStudent->delete();
            $result = Student::getAll();

            //Assert
            $this->assertEquals([$testStudent2], $result);
        }

        function testAddCourse()
        {
            //Arrange
            $name = "Fred Rogers";
            $testStudent = new Student($name);
            $testStudent->save();

            $course_name = "Train Engineering";
            $testCourse = new Course($course_name);
            $testCourse->save();

            //Act
            $testStudent->addCourse($testCourse);

            //Assert
            $this->assertEquals($testStudent->getCourses(), [$testCourse]);
        }

        function testGetCourses()
        {
            //Arrange
            $name = "Billy Jean";
            $testStudent = new Student($name);
            $testStudent->save();

            $course_name = "History of Pop Music";
            $testCourse = new Course($course_name);
            $testCourse->save();

            $course_name2 = "Break Dancing";
            $testCourse2 = new Course($course_name2);
            $testCourse2->save();

            //Act
            $testStudent->addCourse($testCourse);
            $testStudent->addCourse($testCourse2);

            //Assert
            $this->assertEquals($testStudent->getCourses(), [$testCourse, $testCourse2]);
        }

        function testDelete()
        {
            //Arrange
            $name = "Katniss Everdeen";
            $testStudent = new Student($name);
            $testStudent->save();

            $name2 = "Peetaee";
            $testStudent2 = new Student($name2);
            $testStudent2->save();

            $course_name = "Archery";
            $testCourse = new Course($course_name);
            $testCourse->save();

            //Act
            $testStudent->addCourse($testCourse);
            $testStudent2->addCourse($testCourse);
            $testStudent->delete();
            $result = $testCourse->getStudents();

            //Assert
            $this->assertEquals([$testStudent2], $result);
        }

    }

?>
