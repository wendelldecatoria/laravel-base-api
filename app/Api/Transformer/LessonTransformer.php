<?php

namespace App\Api\Transformer;

class LessonTransformer extends Transformer {

    public function transform($lesson)
    {
        if(is_array($lesson)){
            return [
                'title' => $lesson['title'],
                'body' => $lesson['body'],
                'active' => (boolean) $lesson['active']
            ];
        }
        
        return [
            'title' => $lesson->title,
            'body' => $lesson->body,
            'active' => (boolean) $lesson->active
        ];
    }
}