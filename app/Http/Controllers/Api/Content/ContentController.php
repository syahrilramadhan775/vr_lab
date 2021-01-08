<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Http\Resources\Content\ContentResources;
use App\Http\Resources\Content\ContentSubcriptionResources;
use App\Models\Content\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $content = Content::all();

        return ContentResources::collection($content);
    }

    //Shape 1
    // public function contentSub(Request $request)
    // {
    //     $order = $request->order;
    //     $category = $request->category;

    //     $content = Content::whereHas('SubcriptionType', function ($query) use ($order) {
    //         $query->where('order', '>=', $order);
    //     })->get();

    //     if (!$category)
    //         return ContentSubcriptionResources::collection($content);
    //     else
    //         return ContentSubcriptionResources::collection(Content::Filters($order, $category));
    // }

    //Shape 2
    public function contentSub(Request $request)
    {
        $order = $request->order;
        $category = $request->category;

        if (!$category)
            return ContentSubcriptionResources::collection(ContentFilteredController::getOrder($order));
        else
            return ContentSubcriptionResources::collection(ContentFilteredController::getContentFiltered($order, $category));
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
