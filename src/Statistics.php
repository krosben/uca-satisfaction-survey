<?php

namespace App;

class Statistics
{
    /**
     * @var \App\Application
     */
    private $app;

    private $filters;

    private $studentFilters;

    private $pollFilters;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->studentFilters = $this->app->db->schema()->getColumns('students');
        $this->pollFilters = $this->app->db->schema()->getColumns('polls');
        $this->filters = $app->getJSON();
    }

    public function setfilters($filters)
    {
        $this->filters = (object) $filters;
    }

    public function asJSON()
    {
        return $this->app->sendJSON($this->generate());
    }

    private function generate()
    {
        $query = $this->app->db->from('polls');
        if (properties_exists($this->filters, $this->studentFilters)) {
            $query->join('students', function ($join) {
                $join->on('polls.id_student', 'students.id');
            });
        }
        $query->join('subjects', function ($join) {
            $join->on('polls.id_subject', 'subjects.id');
        })
            ->join('degrees', function ($join) {
                $join->on('degrees.id', 'subjects.id_degree');
            })
        ;

        if (isset($this->filters->id_degree)) {
            $query->where('subjects.id_degree')->is($this->filters->id_degree);
        }

        foreach ($this->pollFilters as $pollFilter) {
            if (isset($this->filters->{$pollFilter})) {
                $query->where("polls.{$pollFilter}")->is($this->filters->{$pollFilter});
            }
        }

        foreach ($this->studentFilters as $studentFilter) {
            if (isset($this->filters->{$studentFilter})) {
                $query->where("students.{$studentFilter}")->is($this->filters->{$studentFilter});
            }
        }

        $result = $query->groupBy(['subjects.id_degree', 'polls.id_question', 'polls.option'])
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
        $isNull = is_null($this->filters->id_degree);

        return $this->getOptionsMean(
            $this->groupOptionsBy($isNull ? 'degree' : 'question', $result),
            $isNull ? '' : 'pregunta '
        );
    }

    private function groupOptionsBy(string $key, array $data): array
    {
        return array_reduce($data, function ($prev, $current) use (&$key) {
            if (array_key_exists($current->{$key}, $prev)) {
                $prev[$current->{$key}][$current->option] += $current->votes;
            } else {
                $prev[$current->{$key}] = array_fill(0, 6, 0);
                $prev[$current->{$key}][$current->option] = $current->votes;
            }

            return $prev;
        }, []);
    }

    private function getOptionsMean(array $data, string $prefix)
    {
        return array_reduce(
            array_entries($data),
            function ($means, $current) use ($prefix) {
                [$key,$options] = $current;
                $votes = array_sum($options);
                $mean = array_reduce_with_index($options, function ($prev, $current, $index) {
                    return (($index + 1) * $current) + $prev;
                }, 0) / $votes - 1;

                return array_merge($means, ["{$prefix}{$key}" => round($mean, 2)]);
            },
            []
        );
    }
}
