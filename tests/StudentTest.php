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

    }

?>
