<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagsRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(PAGINATION_COUNT);
        return view('admin.tags.index', ['tags' => $tags]);
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(TagsRequest $request)
    {

        try {
            DB::beginTransaction();

            $tag = Tag::create($request->all());

            //save translations
            $tag->name = $request->name;
            $tag->save();
            DB::commit();

            return redirect()->back()->with('success', __('general.update_success'));

        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error('Tag create failed: ' . $exception->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }
    }

    public function edit($id)
    {
        $tag = Tag::find($id);

        if (!$tag)
            return redirect()->route('admin.tags')->with(['error' => __('general.notExist')]);

        return view('admin.tags.edit', compact('tag'));
    }

    public function update(TagsRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $tag = Tag::find($id);

            if (!$tag)
                return redirect()->route('admin.tags')->with(['error' => __('general.notExist')]);


            $tag->update($request->except('_token', 'id'));

            //save translations
            $tag->name = $request->name;
            $tag->save();

            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => __('general.update_success')]);

        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error('Tag create failed: ' . $exception->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }
    }

    public function destroy($id)
    {
        try {

            $tag = Tag::find($id);

            if (!$tag)
                return redirect()->route('admin.tags')->with(['error' => __('general.notExist')]);


            $tag->delete();

            return redirect()->route('admin.tags')->with(['success' => __('general.update_success')]);

        } catch (\Exception $exception) {

            Log::error('Tag create failed: ' . $exception->getMessage());

            return redirect()->back()->with('error', __('general.update_error'));
        }

    }
}
