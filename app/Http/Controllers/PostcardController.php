<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostcardRequest;
use App\Http\Requests\UpdatePostcardRequest;
use App\Models\Postcard;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class PostcardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('postcards.index', [
            'postcards' => Postcard::where('is_draft', 0)
                ->where(function ($query) {
                    $query->where('offline_at', '>', now())
                        ->orWhereNull('offline_at');
                })
                ->paginate(20)
        ]);
    }

    public function search(Request $request){
            $keywords = $request->input('keywords');
            $postcards = Postcard::where('is_draft', 0)
            ->where(function ($query) {
                $query->where('offline_at', '>', now())
                    ->orWhereNull('offline_at');
            })
            ->where('title', 'LIKE', "%{$keywords}%")
            ->paginate(20);

            return view('postcards.search',compact('postcards','keywords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostcardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Postcard $postcard)
    {
        $postcards = Postcard::all();
        $is_draft = $postcard->is_draft;
        $offline_at = $postcard->offline_at;

        if($is_draft===0 & ($offline_at === null || strtotime($offline_at)>time())){
            return view('postcards.show', compact('postcard','postcards'));
        }else{
            $response = new Response(view('errors.410'), 410);
            throw new HttpResponseException($response);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postcard $postcard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostcardRequest $request, Postcard $postcard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Postcard $postcard)
    {
        //
    }
}
