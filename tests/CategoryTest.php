<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Category.php";
    require_once 'src/Task.php';

    $server = 'mysql:host=localhost;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CategoryTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Category::deleteAll();
            Task::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Work stuff";
            $test_Category = new Category($name);

            //Act
            $result = $test_Category->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Work stuff";
            $id = 1;
            $test_Category = new Category($name, $id);

            //Act
            $result = $test_Category->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Work stuff";
            $test_Category = new Category($name);
            $test_Category->save();

            //Act
            $result = Category::getAll();

            //Assert
            $this->assertEquals($test_Category, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Work stuff";
            $name2 = "Home stuff";
            $test_Category = new Category($name);
            $test_Category->save();
            $test_Category2 = new Category($name);
            $test_Category2->save();

            //Act
            $result = Category::getAll();

            //Assert
            $this->assertEquals([$test_Category, $test_Category2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Wash the dog";
            $name2 = "Home stuff";
            $test_Category = new Category($name);
            $test_Category->save();
            $test_Category2 = new Category($name);
            $test_Category2->save();

            //Act
            Category::deleteAll();
            $result = Category::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Wash the dog";
            $name2 = "Home stuff";
            $test_Category = new Category($name);
            $test_Category->save();
            $test_Category2 = new Category($name2);
            $test_Category2->save();

            //Act
            $result = Category::find($test_Category->getId());

            //Assert
            $this->assertEquals($test_Category, $result);
        }
        
        // function testGetTasks()
        // {
        //     $name = "Work stuff";
        //     $id = null;
        //     $test_Category = new Category($name, $id);
        //     $test_Category->save();
            
        //     $test_category_id = $test_Category->getId();
            
        //     $description = "Email client";
        //     $due_date = 0000;
        //     $test_task = new Task($description, $test_category_id, $due_date, $id);
        //     $test_task->save();
            
        //     $description2 = "Meet with boss";
        //     $test_task2 = new Task($description2, $test_category_id, $due_date, $id);
        //     $test_task2->save();
            
        //     $result = $test_Category->getTasks();
            
        //     $this->assertEquals([$test_task, $test_task2], $result);
        // }
        
        function testAddTask()
        {
            //Arrange
            $name = "Work stuff";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();
            
            $description = "File reports";
            $id2 = 2;
            $due_date = 1234;
            $test_task = new Task($description, $due_date, $id2);
            $test_task->save();
            
            //Act
            $test_category->addTask($test_task);
            
            //Assert
            $this->assertEquals($test_category->getTasks(), [$test_task]);
        }
        
        function testGetTasks()
        {
            //Arrange
            $name = "Home stuff";
            $id = 1;
            $test_category = new Category($name, $id);
            $test_category->save();
            
            $description = "Wash the dog";
            $id2 = 2;
            $due_date = 1234;
            $test_task = new Task($description, $due_date, $id2);
            $test_task->save();
            
            $description2 = "take out the trash";
            $id3 = 3;
            $due_date2 = 2345;
            $test_task2 = new Task($description2, $due_date2, $id3);
            $test_task2->save();
            
            //Act
            $test_category->addTask($test_task);
            $test_category->addTask($test_task2);
            
            //Assert
            $this->assertEquals($test_category->getTasks(), [$test_task, $test_task2]);
        }
    }
?>
