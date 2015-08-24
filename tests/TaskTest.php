<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Task.php';
    require_once 'src/Category.php';

    $server = 'mysql:host=localhost;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class TaskTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Task::deleteAll();
            Category::deleteAll();
        }

        function test_getId()
        {
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $due_date = 0000;
            $test_task = new Task($description, $category_id, $due_date, $id);
            $test_task->save();

            $result = $test_task->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCategoryId()
        {
          $name = "Home Stuff";
          $id = null;
          $test_category = new Category($name, $id);
          $test_category->save();

          $description = "Wash the dog";
          $category_id = $test_category->getId();
          $due_date = 0000;
          $test_task = new Task($description, $category_id, $due_date, $id);
          $test_task->save();

          $result = $test_task->getCategoryId();

          $this->assertEquals(true, is_numeric($result));
        }


        function test_save()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();


            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $due_date = 0000;
            $test_task = new Task($description, $category_id, $due_date, $id);

            //Act
            $test_task->save();

            //Assert
            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $due_date = 0000;
            $test_Task = new Task($description, $category_id, $due_date, $id);
            $test_Task->save();

            $description2 = "Water the lawn";
            $test_Task2 = new Task($description2, $category_id, $due_date, $id);
            $test_Task2->save();

            //Act
            $result = Task::getAll();

            //Assert
            $this->assertEquals([$test_Task, $test_Task2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $due_date = 0000;
            $test_Task = new Task($description, $category_id, $due_date, $id);
            $test_Task->save();

            $description2 = "Water the lawn";
            $test_Task2 = new Task($description2, $category_id, $due_date, $id);
            $test_Task2->save();

            //Act
            Task::deleteAll();

            //Assert
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }

        // function test_getId ()
        // {
        //     //Arrange
        //     $description = "Wash the dog";
        //     $id = 1;
        //     $test_Task = new Task($description, $id);

        //     //Act
        //     $result = $test_Task->getId();

        //     //Assert
        //     $this->assertEquals(1, $result);
        // }

        function test_find()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $due_date = 0000;
            $test_Task = new Task($description, $category_id, $due_date, $id);
            $test_Task->save();


            $description2 = "Water the lawn";
            $test_Task2 = new Task($description2, $category_id, $due_date, $id);
            $test_Task2->save();

            //Act
            $result = Task::find($test_Task->getId());

            //Assert
            $this->assertEquals($test_Task, $result);
        }
    }
?>
