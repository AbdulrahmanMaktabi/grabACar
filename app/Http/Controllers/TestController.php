<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return Tag::all();
    }

    public function store(Tag $tag)
    {
        $tag->create(request(['name', 'description']));
        return response()->json($tag, 201);
    }

    public function show($id)
    {
        return Tag::find($id);
    }

    public function update($tag_id)
    {
        $tag = Tag::find($tag_id);
        $tag->update(request(['name', 'description']));
        return response()->json($tag, 200);
    }

    public function destroy($tag_id)
    {
        $tag = Tag::find($tag_id);
        $tag->delete();
        return response()->json(null, 204);
    }
}
