<?php

namespace App;

use App\Rules\EqualSizeRule;
use Opis\Database\Connection;
use Opis\Database\Database;
use Phroute\Phroute\Dispatcher;
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
     * @var Connection
     */
    private Connection $connection;

    public function __construct()
    {
        $this->connection = new Connection(
            getenv('DB_DSN'),
            getenv('DB_USER'),
            getenv('DB_PASS')
        );
        $this->db = new Database($this->connection);
        $this->router = new RouteCollector();
        $loader = new \Twig\Loader\FilesystemLoader('../src/views');
        $this->twig = new \Twig\Environment($loader);
        $this->validator = new Validator();
        $this->validator->addValidator('equal', new EqualSizeRule());
    }

    public function run()
    {
        $dispatcher = new Dispatcher($this->router->getData());

        try {
            $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        } catch (\Phroute\Phroute\Exception\HttpRouteNotFoundException $ex) {
            error_log($ex);
            http_response_code(404);
            $response = $this->twig->render('errors.twig', ['code' => 404, 'message' => 'Pagina No Encontrada']);
        } catch (\Phroute\Phroute\Exception\HttpMethodNotAllowedException $ex) {
            error_log($ex);
            http_response_code(405);
            $response = $this->twig->render('errors.twig', ['code' => 405, 'message' => 'Método no permitido']);
        }
        echo $response;
    }

    // TODO: Change field value to option
    public function savePoll(array $data)
    {
        $student = [
            'age' => $data['age'],
            'highest_course' => $data['highest-course'],
            'lowest_course' => $data['lowest-course'],
            'enrollment' => $data['enrollment'],
            'exam' => $data['exam'],
            'id_gender' => $data['gender'],
            'id_mentoring' => $data['mentoring'],
            'id_interest' => $data['interest'],
            'id_dificulty' => $data['dificulty'],
            'id_expected_grade' => $data['expectedgrade'],
            'id_assitance' => $data['assistance'],
        ];

        if ($this->db->insert($student)->into('students')) {
            $id_student = $this->db->from('students')->count();

            $this->db->insert([
                'id_subject' => $data['subject'],
                'id_student' => $id_student,
                'id_group' => $data['group'],
            ])->into('polls');

            foreach ($data['answers'] as $proffesor => $answers) {
                $id_proffesor = $data['proffesors'][$proffesor];
                foreach ($answers as $id_question => $value) {
                    $votes = $this->db->update('answers')
                        ->where('id_question')
                        ->is($id_question)
                        ->andWhere('id_proffesor')
                        ->is($id_proffesor)
                        ->andWhere('value')
                        ->is($value)
                        ->increment('votes')
                    ;
                    if (0 === $votes) {
                        $this->db->insert([
                            'value' => $value,
                            'votes' => 1,
                            'id_question' => $id_question,
                            'id_proffesor' => $id_proffesor,
                            'id_students' => $id_student,
                        ])->into('answers');
                    }
                }
            }
        }
    }

    public function redirect(string $to)
    {
        header('Location: '.$to);
    }
}
