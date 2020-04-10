<?php

namespace App;

use Opis\Database\Database;

class Statistics
{
    /**
     * @var Database
     */
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function resultsByDegrees(string $degree = null)
    {
        if (is_null($degree)) {
            return $this->db
                ->from('polls')
                ->join('subjects', function ($join) {
                    $join->on('polls.id_subject', 'subjects.id');
                })
                ->join('degrees', function ($join) {
                    $join->on('degrees.id', 'subjects.id_degree');
                })
                ->groupBy(['subjects.id_degree', 'polls.id_question', 'polls.option'])
                ->select(function ($include) {
                    $include->columns([
                        'degrees.name' => 'degree',
                        'polls.id_question' => 'question',
                        'polls.option' => 'option',
                    ])
                        ->count('*', 'votes')
                    ;
                })
                ->all()
            ;
        }

        return [];
    }

    public function stdesv()
    {
    }
}
