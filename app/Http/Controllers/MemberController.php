<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $members = Auth::user()->members()->latest()->paginate(5);
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMemberRequest $request)
    {
        //
        $attributes = $request->except(['cni_recto', 'cni_verso']);
        $attributes['membershipid'] = "PENDING";

        $member = Auth::user()->members()->create($attributes);

        if($request->cni_recto){
            $path = $request->cni_recto->store('media');
            $member->cni_recto = $path;
        }

        if($request->cni_verso){
            $path = $request->cni_verso->store('media');
            $member->cni_verso = $path;
        }
        $member->save();

        return Redirect::route('member.index')->with('success', 'Member saved!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
