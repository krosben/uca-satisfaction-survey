<?php

namespace App;

class Statistics
{
    /**
     * @var \App\Application
     */
    private $app;

    private $params;

    private $response;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->params = $app->getJSON();
    }

    public function setParams($params)
    {
        $this->params = (object) $params;
    }

    public function asJSON()
    {
        $this->prepareRespose();

        return $this->app->sendJSON($this->response);
    }

    private function degrees()
    {
        $query = $this->app->db
            ->from('polls')
            ->join('subjects', function ($join) {
                $join->on('polls.id_subject', 'subjects.id');
            })
            ->join('degrees', function ($join) {
                $join->on('degrees.id', 'subjects.id_degree');
            })
        ;

        if (!is_null($this->params->degree)) {
            $query->where('subjects.id_degree')->is($this->params->degree);
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
        $isNull = is_null($this->params->degree);

        return $this->getOptionsMean(
            $this->groupOptionsBy($isNull ? 'degree' : 'question', $result),
            $isNull ? '' : 'pregunta '
        );
    }

    private function prepareRespose()
    {
        if (property_exists($this->params, 'degree')) {
            $this->response = $this->degrees();
        }
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
