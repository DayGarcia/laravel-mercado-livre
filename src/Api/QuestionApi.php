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
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }

    public function getItemQuestions(string $item_id)
    {
        $url = "questions/search?item=${item_id}";
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }

    public function createQuestion()
    {
        $url = 'questions';
        $response = $this->post($this->configuration->getAccessToken(), $url);

        return $response->json();
    }

    public function getQuestions()
    {
        $url = 'my/received_questions/search';
        $response = $this->get($this->configuration->getAccessToken(), $url);

        return $response->json();
    }
}
