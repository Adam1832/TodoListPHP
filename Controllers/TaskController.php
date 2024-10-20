
<?php

namespace Controllers;

use Models\Task;

class TaskController {
    private $tasks = [];

    public function __construct() {
      
        if (file_exists('tasks.json')) {
            $this->tasks = json_decode(file_get_contents('tasks.json'), true);
        }
    }

    public function index() {
       
        global $twig;
        echo $twig->render('tasks/index.html.twig', ['tasks' => $this->tasks]);
    }

    public function add() {
        global $twig;
        echo $twig->render('tasks/add.html.twig');
    }

    public function store() {
    
        $description = $_POST['description'] ?? '';
        $newTask = ['id' => uniqid(), 'description' => $description, 'completed' => false];
	$this->tasks[] = $newTask;
        $this->saveTasks();
        header('Location: /');
    }
    public function complete($id) {

        foreach ($this->tasks as &$task) {
            if ($task['id'] === $id) {
                $task['completed'] = true;
                break;
            }
        }
        $this->saveTasks();
        header('Location: /');
    }

    public function delete($id) {
        $this->tasks = array_filter($this->tasks, fn($task) => $task['id'] !== $id);
        $this->saveTasks();
        header('Location: /');
    }

    private function saveTasks() {
        file_put_contents('tasks.json', json_encode($this->tasks));
    }
}

