<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;
use Yajra\DataTables\Facades\DataTables;

class ResumeController extends Controller
{
    /**
     * Display the index page.
     */
    public function index()
    {
        return view('resumes.index');
    }

    /**
     * Process DataTables AJAX request.
     */
    public function data(Request $request)
    {
        if ($request->ajax()) {
            // FIX: Select 'template_id' instead of 'template_style'
            // FIX: Eager load 'template' so we can show the name
            $query = Resume::with('template')
                           ->where('user_id', Auth::id())
                           ->select(['id', 'title', 'template_id', 'created_at', 'updated_at']);

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('M d, Y');
                })
                // FIX: Show the Template Name instead of the ID
                ->addColumn('template_style', function ($row) {
                    $name = $row->template ? $row->template->name : 'Standard';
                    return '<span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">'.$name.'</span>';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('resumes.edit', $row->id);
                    $deleteUrl = route('resumes.destroy', $row->id);
                    $previewUrl = route('resumes.preview', $row->id);
                    
                    $csrf = (string) csrf_field(); 
                    $method = (string) method_field('DELETE');

                    return "
                        <div class='flex items-center justify-end gap-2'>
                            <a href='{$previewUrl}' target='_blank' class='px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 text-sm font-semibold transition flex items-center gap-1'>
                                <i data-lucide='eye' class='w-3 h-3'></i> View
                            </a>
                            <a href='{$editUrl}' class='px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 text-sm font-semibold transition'>
                                Edit
                            </a>
                            <form action='{$deleteUrl}' method='POST' onsubmit='return confirm(\"Delete this resume?\");' style='display:inline;'>
                                {$csrf}
                                {$method}
                                <button type='submit' class='px-3 py-1.5 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-100 text-sm font-semibold transition'>
                                    Delete
                                </button>
                            </form>
                        </div>
                    ";
                })
                ->rawColumns(['action', 'template_style'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('resumes.create');
    }

    public function store(Request $request)
    {
        // Validation (Removed template_style)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'linkedin_url' => 'nullable|url|max:255',
            'summary' => 'nullable|string',
            
            // Arrays
            'experiences' => 'nullable|array',
            'education' => 'nullable|array',
            'skills' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();

            // A. Create Resume
            $resume = Resume::create([
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'linkedin_url' => $validated['linkedin_url'] ?? null,
                'summary' => $validated['summary'] ?? null,
                'template_id' => 1, // Default to ID 1 (ensure you have a template with ID 1)
            ]);

            // B. Save Relations
            $this->saveRelations($resume, $request);

            DB::commit();

            // Redirect to Template Selection instead of Index
            return redirect()->route('resumes.selectTemplate', $resume->id)
                ->with('success', 'Resume created! Please select a template.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit(Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) abort(403);
        $resume->load(['experiences', 'education', 'skills']);
        return view('resumes.edit', compact('resume'));
    }

    public function update(Request $request, Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) abort(403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'linkedin_url' => 'nullable|url',
            'summary' => 'nullable|string',
            'experiences' => 'nullable|array',
            'education' => 'nullable|array',
            'skills' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();

            $resume->update([
                'title' => $validated['title'],
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'linkedin_url' => $validated['linkedin_url'] ?? null,
                'summary' => $validated['summary'] ?? null,
                // Do NOT update template_id here, that is done in selectTemplate
            ]);

            $this->saveRelations($resume, $request);

            DB::commit();
            return redirect()->route('resumes.index')->with('success', 'Resume updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy(Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) abort(403);
        $resume->delete();
        return back()->with('success', 'Resume deleted successfully.');
    }

    // --- Template Selection & Preview ---

    public function selectTemplate($id)
    {
        $resume = Resume::where('user_id', Auth::id())->findOrFail($id);
        $templates = Template::all();
        return view('resumes.select-template', compact('resume', 'templates'));
    }

    public function updateTemplate(Request $request, $id)
    {
        $resume = Resume::where('user_id', Auth::id())->findOrFail($id);
        
        $resume->update([
            'template_id' => $request->template_id
        ]);
        
        return redirect()->route('resumes.preview', $id);
    }

    public function preview($id)
    {
        $resume = Resume::with(['template', 'education', 'experiences', 'skills'])
                        ->where('user_id', Auth::id())
                        ->findOrFail($id);

        if (!$resume->template) {
            return redirect()->route('resumes.selectTemplate', $id);
        }

        try {
            return Blade::render($resume->template->html_code, ['resume' => $resume]);
        } catch (\Exception $e) {
            return response("Error rendering template: " . $e->getMessage(), 500);
        }
    }

    // --- Private Helper ---

    private function saveRelations(Resume $resume, Request $request)
    {
        // 1. Experiences
        if ($request->has('experiences')) {
            $resume->experiences()->delete();
            $data = collect($request->experiences)->filter(fn($i) => !empty($i['job_title']))->map(function($i){
                $i['is_current'] = isset($i['is_current']) ? 1 : 0;
                return $i;
            });
            if($data->isNotEmpty()) $resume->experiences()->createMany($data->toArray());
        }

        // 2. Education
        if ($request->has('education')) {
            $resume->education()->delete();
            $data = collect($request->education)->filter(fn($i) => !empty($i['degree']));
            if($data->isNotEmpty()) $resume->education()->createMany($data->toArray());
        }

        // 3. Skills
        if ($request->has('skills')) {
            $resume->skills()->delete();
            $data = collect($request->skills)->filter(fn($i) => !empty($i['name']));
            if($data->isNotEmpty()) $resume->skills()->createMany($data->toArray());
        }
    }
}