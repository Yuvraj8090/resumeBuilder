<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ResumeController extends Controller
{
    /**
     * Display the index page (The Table View).
     */
    public function index()
    {
        return view('resumes.index');
    }

    /**
     * Process DataTables AJAX request (Fast Loading).
     */
   /**
     * Process DataTables AJAX request.
     */
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $query = Resume::where('user_id', Auth::id())
                           ->select(['id', 'title', 'template_style', 'created_at', 'updated_at']);

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('M d, Y');
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('resumes.edit', $row->id);
                    $deleteUrl = route('resumes.destroy', $row->id);
                    
                    // FIX: Use csrf_field() to generate the full <input> tag
                    // Casting to (string) ensures it renders the HTML, not the object
                    $csrf = (string) csrf_field(); 
                    $method = (string) method_field('DELETE');

                    return "
                        <div class='flex items-center justify-end gap-2'>
                            <a href='{$editUrl}' class='px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 text-sm font-semibold transition'>
                                Edit
                            </a>
                            <form action='{$deleteUrl}' method='POST' onsubmit='return confirm(\"Are you sure you want to delete this resume?\");'>
                                {$csrf}
                                {$method}
                                <button type='submit' class='px-3 py-1.5 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-100 text-sm font-semibold transition'>
                                    Delete
                                </button>
                            </form>
                        </div>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resume.
     */
    public function create()
    {
        return view('resumes.create');
    }

    /**
     * Store a newly created resume and all its relations in one go.
     */
    public function store(Request $request)
    {
        // 1. Validate Main Resume Data and Nested Arrays
        $validated = $request->validate([
            // Resume Table
            'title' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'linkedin_url' => 'nullable|url|max:255',
            'summary' => 'nullable|string',
            'template_style' => 'nullable|string',
            
            // Experience Table
            'experiences' => 'nullable|array',
            'experiences.*.job_title' => 'required|string',
            'experiences.*.employer' => 'required|string',
            'experiences.*.city' => 'nullable|string',
            'experiences.*.start_date' => 'nullable|date',
            'experiences.*.end_date' => 'nullable|date',
            'experiences.*.is_current' => 'boolean',
            'experiences.*.description' => 'nullable|string',
            
            // Education Table
            'education' => 'nullable|array',
            'education.*.institution' => 'required|string',
            'education.*.degree' => 'required|string',
            'education.*.city' => 'nullable|string',
            'education.*.start_date' => 'nullable|date',
            'education.*.end_date' => 'nullable|date',
            'education.*.is_current' => 'boolean',
            'education.*.description' => 'nullable|string',

            // Skills Table
            'skills' => 'nullable|array',
            'skills.*.name' => 'required|string',
            'skills.*.level' => 'nullable|string', // e.g., Beginner, Expert
        ]);

        try {
            DB::beginTransaction();

            // A. Create the Main Resume
            $resume = Resume::create([
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'linkedin_url' => $validated['linkedin_url'] ?? null,
                'summary' => $validated['summary'] ?? null,
                'template_style' => $validated['template_style'] ?? 'modern',
            ]);

            // B. Bulk Insert Relations
            if (!empty($request->experiences)) {
                $resume->experiences()->createMany($request->experiences);
            }

            if (!empty($request->education)) {
                $resume->education()->createMany($request->education);
            }

            if (!empty($request->skills)) {
                $resume->skills()->createMany($request->skills);
            }

            DB::commit();

            return redirect()->route('resumes.index')
                ->with('success', 'Resume created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            logger('Resume Create Error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create resume. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resume $resume)
    {
        // Security check
        if ($resume->user_id !== Auth::id()) {
            abort(403);
        }

        // Eager load relations for performance
        $resume->load(['experiences', 'education', 'skills']);

        return view('resumes.edit', compact('resume'));
    }

    /**
     * Update the resume.
     * Strategy: Update parent, delete old relations, re-create new relations (simplest for complex forms).
     */
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
            'template_style' => 'nullable|string',
            
            // Nested arrays validation same as store...
            'experiences' => 'nullable|array',
            'experiences.*.job_title' => 'required|string',
            'education' => 'nullable|array',
            'skills' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();

            // 1. Update Main Resume
            $resume->update([
                'title' => $validated['title'],
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'linkedin_url' => $validated['linkedin_url'] ?? null,
                'summary' => $validated['summary'] ?? null,
                'template_style' => $validated['template_style'] ?? 'modern',
            ]);

            // 2. Sync Relations (Delete All & Re-create)
            // Note: For a production app with heavy usage, you might want to update existing IDs individually.
            // But for a Resume builder, wiping and rewriting is safe and much cleaner.
            
            $resume->experiences()->delete();
            if (!empty($request->experiences)) {
                $resume->experiences()->createMany($request->experiences);
            }

            $resume->education()->delete();
            if (!empty($request->education)) {
                $resume->education()->createMany($request->education);
            }

            $resume->skills()->delete();
            if (!empty($request->skills)) {
                $resume->skills()->createMany($request->skills);
            }

            DB::commit();
            return redirect()->route('resumes.index')
                ->with('success', 'Resume created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            logger('Resume Update Error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update resume.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) {
            abort(403);
        }

        $resume->delete(); // Cascading deletes should handle relations if set in DB, otherwise Eloquent events needed.

        return back()->with('success', 'Resume deleted successfully.');
    }
}