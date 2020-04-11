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

    public function resultsByDegrees($params)
    {
        $query = $this->db
            ->from('polls')
            ->join('subjects', function ($join) {
                $join->on('polls.id_subject', 'subjects.id');
            })
            ->join('degrees', function ($join) {
                $join->on('degrees.id', 'subjects.id_degree');
            })
        ;

        if (!is_null($params->degree)) {
            $query->where('subjects.id_degree')->is($params->degree);
        }

        return $query->groupBy(['subjects.id_degree', 'polls.id_question', 'polls.option'])
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

    public function stdesv()
    {
    }
}
