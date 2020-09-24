<?php

namespace App\Api\Transformer;

class LessonTransformer extends Transformer {

    public function transform($lesson)
    {
        return [
            'title' => $lesson->title,
            'body' => $lesson->body,
            'active' => (boolean) $lesson->active
        ];
    }
}