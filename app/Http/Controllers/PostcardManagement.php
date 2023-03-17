<?php

namespace App\Http\Controllers;

use App\Models\Postcard;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostcardManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(){
        $this->middleware('auth');
    }


    public function index()
    {
        //
        return view('dashboard', [
            'postcards' => Postcard::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add_postcard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $postcard = new Postcard();
        $postcard->title = $request->title;
        $postcard->price = $request->price;
        $online_at = $request->online_at;
        $offline_at = $request->offline_at;

        $onlineAtDateTime = Carbon::parse($online_at);
        $postcard->online_at = $onlineAtDateTime->format('Y-m-d H:i:s');
        $offlineAtDateTime = Carbon::parse($offline_at);
        $postcard->offline_at = $offlineAtDateTime->format('Y-m-d H:i:s');
        if(isset($request->is_draft)){
            $postcard->is_draft = 1;
        }else{
            $postcard->is_draft = 0;
        }

        //get team
        $team = Team::where('user_id',Auth::user()->id)->first();
        $postcard->team_id = $team->id;
        $postcard->user_id = $team->user_id;
        $postcard->save();
        return redirect()->back()->with('success','Postcard created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $postcard = Postcard::find($id);
        return view('edit_postcard',compact('postcard'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $postcard = Postcard::find($id);
        $postcard->title = $request->title;
        $postcard->price = $request->price;

        if(isset($request->online_at)){
            $online_at = $request->online_at;
            $onlineAtDateTime = Carbon::parse($online_at);
            $postcard->online_at = $onlineAtDateTime->format('Y-m-d H:i:s');
        }

        if(isset($request->offline_at)){
            $offline_at = $request->offline_at;
            $offlineAtDateTime = Carbon::parse($offline_at);
            $postcard->offline_at = $offlineAtDateTime->format('Y-m-d H:i:s');
        }

        if(isset($request->is_draft)){
            $postcard->is_draft = 1;
        }else{
            $postcard->is_draft = 0;
        }

        //get team
        $team = Team::where('user_id',Auth::user()->id)->first();
        $postcard->team_id = $team->id;
        $postcard->user_id = $team->user_id;
        $postcard->save();
        return redirect()->back()->with('success','Postcard updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Postcard $postcard, Request $request)
    {

        if($postcard->trashed()){
            $postcard->forceDelete();
            return redirect()->back()->with('success','Postcard deleted successfully');
        }

        $postcard->delete();
        return redirect()->back()->with('success','Postcard moved to archive');

    }

    public function archive(){
        return view('archive', [
            'postcards' => Postcard::onlyTrashed()->get()
        ]);
    }

    public function restore(Postcard $postcard, Request $request){
        $postcard->restore();
        return redirect()->route('dashboard')->with('success','Postcard restored');
    }
}
