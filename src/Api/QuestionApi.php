<?php

namespace DayGarcia\LaravelMercadoLivre\Api;

use DayGarcia\LaravelMercadoLivre\Api;
use DayGarcia\LaravelMercadoLivre\Configuration;

class QuestionApi extends Api
{
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getQuestion(string $question_id)
    {
        $url = "questions/${question_id}";
        return $this->get($this->configuration->getAccessToken(), $url);
    }

    public function getItemQuestions(string $item_id)
    {
        $url = "questions/search?item=${item_id}";
        return $this->get($this->configuration->getAccessToken(), $url);
    }

    public function createQuestion()
    {
        $url = 'questions';
        return $this->post($this->configuration->getAccessToken(), $url);
    }

    public function getQuestions()
    {
        $url = 'my/received_questions/search';
        return $this->get($this->configuration->getAccessToken(), $url);
    }
}
