<?php

namespace App;

use App\Rules\EqualSizeRule;
use App\Rules\LoginRule;
use Opis\Database\Connection;
use Opis\Database\Database;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;
use Rakit\Validation\Validator;

class Application
{
    /**
     * @var RouteCollector
     */
    public $router;
    /**
     * @var Database
     */
    public $db;
    /**
     * @var \Twig\Environment
     */
    public $twig;

    /**
     * @var Validator
     */
    public $validator;

    /**
     * @var \App\Session
     */
    public $session;

    private Connection $connection;

    public function __construct()
    {
        $this->connection = new Connection(
            getenv('DB_DSN'),
            getenv('DB_USER'),
            getenv('DB_PASS')
        );
        $this->db = new Database($this->connection);
    }

    public static function init(): Application
    {
        $instance = new self();
        $instance->router = new RouteCollector();
        $loader = new \Twig\Loader\FilesystemLoader('../src/views');
        $instance->twig = new \Twig\Environment($loader);
        $instance->validator = new Validator([
            'required' => 'El campo es obligatorio',
        ]);
        $instance->validator->addValidator('equal_size', new EqualSizeRule());
        $instance->validator->addValidator('login_rule', new LoginRule($instance->db));
        $instance->session = new Session();

        return $instance;
    }

    public function run()
    {
        $dispatcher = new Dispatcher($this->router->getData());

        try {
            $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        } catch (HttpRouteNotFoundException $ex) {
            error_log($ex);
            http_response_code(404);
            $response = $this->twig->render('errors.twig', ['code' => 404, 'message' => 'Pagina No Encontrada']);
        } catch (HttpMethodNotAllowedException $ex) {
            error_log($ex);
            http_response_code(405);
            $response = $this->twig->render('errors.twig', ['code' => 405, 'message' => 'Método no permitido']);
        }
        echo $response;
    }

    public function savePoll(array $data)
    {
        $student = [
            'age' => $data['age'],
            'exam' => $data['exam'],
            'id_gender' => $data['gender'],
            'id_interest' => $data['interest'],
            'enrollment' => $data['enrollment'],
            'id_dificulty' => $data['dificulty'],
            'id_mentoring' => $data['mentoring'],
            'id_assitance' => $data['assistance'],
            'lowest_course' => $data['lowest_course'],
            'highest_course' => $data['highest_course'],
            'id_expected_grade' => $data['expectedgrade'],
        ];

        if ($this->db->insert($student)->into('students')) {
            $id_student = $this->db->getConnection()->getPDO()->lastInsertId();

            foreach ($data['answers'] as $proffesor => $answers) {
                $id_proffesor = $data['proffesors'][$proffesor];
                foreach ($answers as $id_question => $option) {
                    $this->db->insert([
                        'option' => $option,
                        'id_student' => $id_student,
                        'id_group' => $data['group'],
                        'id_subject' => $data['subject'],
                        'id_question' => $id_question,
                        'id_proffesor' => $id_proffesor,
                    ])->into('polls');
                }
            }
        }
    }

    public function getFormData(): array
    {
        return [
            'subjects' => $this->db->from('subjects')->select(['id', 'name', 'id_degree'])->all(),
            'degrees' => $this->db->from('degrees')->select(['id', 'name'])->all(),
            'groups' => $this->db->from('groups')->select()->all(),
            'exam' => 6,
            'enrollment' => 6,
            'genders' => $this->db->from('gender')->select()->all(),
            'mentoring' => $this->db->from('mentoring')->select()->all(),
            'interest' => $this->db->from('interest')->select()->all(),
            'expectedgrade' => $this->db->from('expected_grade')->select()->all(),
            'dificulty' => $this->db->from('dificulty')->select()->all(),
            'assistance' => $this->db->from('assistance')->select()->all(),
            'questions' => array_group_by($this->db->from('questions')->select()->all(), 'type', 'subtype'),
            'proffesors' => $this->db->from('proffesors')->join('prof_subject', function ($join) {
                $join->on('proffesors.id', 'prof_subject.id_proffesor');
            })->select()->all(),
            'answers' => ['NS', '1', '2', '3', '4', '5'],
            'columns' => 3,
        ];
    }

    public function getFormValidationRules(): array
    {
        return [
            'degree' => 'required|numeric',
            'subject' => 'required|numeric',
            'group' => 'required|numeric',
            'age' => 'required|numeric',
            'gender' => 'required|numeric',
            'lowest_course' => 'required|numeric',
            'highest_course' => 'required|numeric',
            'enrollment' => 'required|numeric',
            'exam' => 'required|numeric',
            'interest' => 'required|numeric',
            'mentoring' => 'required|numeric',
            'dificulty' => 'required|numeric',
            'expectedgrade' => 'required|numeric',
            'assistance' => 'required|numeric',
            'proffesors' => 'required|array|min:1|max:3',
            'proffesors.*' => 'required|numeric',
            'answers' => 'required|array|equal_size:proffesors',
            'answers.*' => 'required|array|min:23|max:23',
        ];
    }

    public function redirect(string $to)
    {
        header('Location: '.$to);
    }

    public function sendJSON($value)
    {
        header('Content-Type: application/json');

        return json_encode($value);
    }

    public function getJSON()
    {
        $json = file_get_contents('php://input');

        return json_decode($json);
    }
}
