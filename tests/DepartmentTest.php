<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $DB = new PDO('pgsql:host=localhost;dbname=registrar_test');

    require_once "src/Course.php";
    require_once "src/Student.php";
    require_once "src/Department.php";

    class DepartmentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Course::deleteAll();
            Student::deleteAll();
            Department::deleteAll();
        }

        function test_setId()
        {
            //Arrange
            $id = 1;
            $name = "English";
            $testDepartment = new Department($name, $id);

            //Act
            $testDepartment->setId(2);
            $result = $testDepartment->getId();

            //Assert
            $this->assertEquals(2, $result);

        }

        function test_setName()
        {
            //Arrange
            $name = "French";
            $testDepartment = new Department($name);

            //Act
            $testDepartment->setName("Stupid English");
            $result = $testDepartment->getName();

            //Assert
            $this->assertEquals("Stupid English", $result);

        }

        function test_save()
        {
            //Arrange
            $name = "French";
            $testDepartment = new Department($name);

            //Act
            $testDepartment->save();
            $result = Department::getAll();

            //Assert
            $this->assertEquals($testDepartment, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "French";
            $testDepartment = new Department($name);
            $testDepartment->save();

            $name2 = "Math";
            $testDepartment2 = new Department($name2);
            $testDepartment2->save();
            //Act

            $result = Department::getAll();

            //Assert
            $this->assertEquals([$testDepartment, $testDepartment2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Math";
            $testDepartment = new Department($name);
            $testDepartment->save();

            $name2 = "Biology";
            $testDepartment2 = new Department($name2);
            $testDepartment2->save();

            //Act
            Department::deleteAll();
            $result = Department::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Math";
            $testDepartment = new Department($name);
            $testDepartment->save();
            $name2 = "Physics";
            $testDepartment2 = new Department($name2);
            $testDepartment2->save();

            //Act
            $result = Department::find($testDepartment2->getId());

            //Assert
            $this->assertEquals($testDepartment2, $result);
        }

        function test_updateName()
        {
            //Arrange
            $name = "Body Painting";
            $testDepartment = new Department($name);
            $testDepartment->save();
            $new_name = "Art";

            //Act
            $testDepartment->updateName($new_name);

            //Assert
            $this->assertEquals($new_name, $testDepartment->getName());
        }

        function test_delete()
        {
            //Arrange
            $name = "Legos";
            $testDepartment = new Department($name);
            $testDepartment->save();
            $department_id = $testDepartment->getId();

            $name2 = "Underwater Basket Weaving";
            $testDepartment2 = new Department($name2);
            $testDepartment2->save();

            $course = "Writing";
            $testCourse = new Course($course, $id = null, $course_number = 1, $department_id);
            //Act
            $testDepartment->delete();
            $result = Department::getAll();
            //Assert
            $this->assertEquals([$testDepartment2], $result);
        }

        function testAddStudent()
        {
            //Arrange
            $name = "History";
            $testDepartment = new Department($name);
            $testDepartment->save();

            $student = "Hal";
            $testStudent = new Student($student);
            $testStudent->save();

            //Act
            $testDepartment->addStudent($testStudent);

            //Assert
            $this->assertEquals($testDepartment->getStudents(), [$testStudent]);
        }
    }
?>
