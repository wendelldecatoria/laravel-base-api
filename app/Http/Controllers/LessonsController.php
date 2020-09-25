<?php

namespace App\Http\Controllers;
use App\Lesson;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Api\Transformer\LessonTransformer;
use Illuminate\Support\Facades\Validator;
use LessonsTableSeeder;

class LessonsController extends ApiController
{
    /**
     *
     * @var Api\Transformer\LessonTransformer
     * 
     * 
     * @todo reference the model here just like in Genesys Module
     */
    protected $lessonTransformer;
    protected $lesson;

    public function __construct(LessonTransformer $lessonTransformer, Lesson $lesson)
    {
        /**
         *  @todo return custom message for unauthorized access
         */
        
        /**
         *  Basic Auth only. No need application login
         * 
         */
        $this->middleware('auth.basic')->only(['store', 'update', 'destroy']);
        
        $this->lessonTransformer = $lessonTransformer;
        $this->lesson = $lesson;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * @todo  found out how to make message not required or type hint the input params to function? object oriented function parameters
     * @todo return paginated result
     */
    public function index()
    {
        return $this->setStatusCode(200)->respond('Success', $this->lessonTransformer->transformCollection($this->lesson->all()->toArray()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return $this->setStatusCode(400)->respondWithError($message = "Failed", $data = $error);
        }

        return $this->setStatusCode(200)->respond("Add lesson success");

        $this->lesson->insert($request->only(['title', 'body']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @todo make function params object oriented
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        if( !$lesson )
        {
            return $this->respondNotFound('Lesson does not exist');

        }

        return $this->setStatusCode(200)->respond($message = "Success", $data = $this->lessonTransformer->transform($lesson),);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
