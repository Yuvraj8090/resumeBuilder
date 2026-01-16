<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource with DataTables.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Template::select(['id', 'name', 'slug', 'is_premium', 'thumbnail', 'created_at']);
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('is_premium', function($row){
                    return $row->is_premium 
                        ? '<span class="badge bg-warning text-dark">Premium</span>' 
                        : '<span class="badge bg-success">Free</span>';
                })
                ->editColumn('thumbnail', function($row){
                    $url = $row->thumbnail ? asset($row->thumbnail) : 'https://via.placeholder.com/50';
                    return '<img src="'.$url.'" border="0" width="50" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function($row){
                    $editUrl = route('admin.templates.edit', $row->id);
                    $deleteUrl = route('admin.templates.destroy', $row->id);
                    $csrf = csrf_field();
                    $method = method_field('DELETE');
                    
                    return "
                        <div class='d-flex gap-2'>
                            <a href='{$editUrl}' class='btn btn-primary btn-sm'>Edit</a>
                            <form action='{$deleteUrl}' method='POST' onsubmit='return confirm(\"Are you sure?\");'>
                                {$csrf}
                                {$method}
                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                            </form>
                        </div>
                    ";
                })
                ->rawColumns(['is_premium', 'thumbnail', 'action'])
                ->make(true);
        }

        return view('admin.templates.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.templates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'html_code' => 'required',
            'thumbnail' => 'nullable|url', // Or image validation if uploading
        ]);

        Template::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'html_code' => $request->html_code,
            'thumbnail' => $request->thumbnail,
            'is_premium' => $request->has('is_premium') ? 1 : 0,
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $template = Template::findOrFail($id);
        return view('admin.templates.edit', compact('template'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $template = Template::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'html_code' => 'required',
        ]);

        $template->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Update slug or keep original
            'html_code' => $request->html_code,
            'thumbnail' => $request->thumbnail,
            'is_premium' => $request->has('is_premium') ? 1 : 0,
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $template = Template::findOrFail($id);
        $template->delete();

        return redirect()->route('admin.templates.index')->with('success', 'Template deleted successfully');
    }
}