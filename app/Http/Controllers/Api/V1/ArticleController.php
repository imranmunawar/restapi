<?php

namespace App\Http\Controllers\Api\V1;

use App\Article;
use App\Events\FetchArticles;
use App\Jobs\FetchAllArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Api\APIController;

class ArticleController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $return = $this->respondInternalError('Something went wrong, please try again later');
        try {
            $articles = Article::where('id', '=', 1)->first();
            event( new FetchArticles($articles));
            $articles = Article::all();
            $return = $this->respondOK($articles);
        }catch (\Exception $ex) {
            dd($ex->getLine() . '  ' . $ex->getMessage());
            \Log::info($ex->getLine() . '  ' . $ex->getMessage());
            if(\App::environment('production')){
                Bugsnag::notifyException($ex);
            }
        } finally {
            return $return;
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
