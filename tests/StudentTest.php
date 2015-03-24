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

    }

?>
