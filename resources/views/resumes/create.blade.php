<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Create New Resume') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="resumeWizard()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <div class="flex items-center justify-between relative">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-slate-200 -z-10 rounded-full"></div>
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-indigo-600 -z-10 rounded-full transition-all duration-300" :style="'width: ' + ((step - 1) / 3 * 100) + '%'"></div>
                    
                    <template x-for="i in 4">
                        <div class="flex flex-col items-center cursor-pointer" @click="step > i ? step = i : null">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-colors duration-300 border-4"
                                 :class="step >= i ? 'bg-indigo-600 text-white border-indigo-100' : 'bg-white text-slate-400 border-slate-100'">
                                <span x-text="i"></span>
                            </div>
                            <span class="text-xs font-semibold mt-2" 
                                  :class="step >= i ? 'text-indigo-600' : 'text-slate-400'"
                                  x-text="['Contact', 'Experience', 'Education', 'Skills'][i-1]"></span>
                        </div>
                    </template>
                </div>
            </div>

            <form action="{{ route('resumes.store') }}" method="POST" class="bg-white/80 backdrop-blur-xl border border-white/50 shadow-xl rounded-3xl overflow-hidden">
                @csrf
                
                <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <i data-lucide="user-circle" class="w-6 h-6 text-indigo-500"></i>
                            Personal Information
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Resume Title</label>
                                <input type="text" name="title" required placeholder="e.g. My Software Engineer Resume" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                                <p class="text-xs text-slate-400 mt-1">For your own reference on the dashboard.</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                                <input type="text" name="full_name" value="{{ Auth::user()->name }}" required class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" required class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Phone</label>
                                <input type="tel" name="phone" placeholder="+1 (555) 000-0000" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">LinkedIn / Website</label>
                                <input type="url" name="linkedin_url" placeholder="https://linkedin.com/in/..." class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Professional Summary</label>
                                <div class="relative">
                                    <textarea x-model="summary" name="summary" rows="4" placeholder="Briefly describe your career highlights..." class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm"></textarea>
                                    
                                    <button type="button" 
                                            @click="rewriteSummary()"
                                            :disabled="isRewritingSummary"
                                            class="absolute bottom-3 right-3 text-xs flex items-center gap-1 bg-indigo-50 text-indigo-600 px-3 py-1.5 rounded-lg hover:bg-indigo-100 transition disabled:opacity-50">
                                        <i x-show="!isRewritingSummary" data-lucide="sparkles" class="w-3 h-3"></i>
                                        <svg x-show="isRewritingSummary" class="animate-spin h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        <span x-text="isRewritingSummary ? 'Thinking...' : 'AI Rewrite'"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                    <div class="p-8 bg-slate-50/50 min-h-[400px]">
                        <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <i data-lucide="briefcase" class="w-6 h-6 text-indigo-500"></i>
                            Work Experience
                        </h3>

                        <template x-for="(experience, index) in experiences" :key="experience.id">
                            <div class="mb-6 bg-white p-6 rounded-2xl shadow-sm border border-slate-200 relative group hover:border-indigo-300 transition">
                                <button type="button" @click="removeExperience(index)" class="absolute top-4 right-4 text-slate-300 hover:text-rose-500 transition" x-show="experiences.length > 0">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Job Title</label>
                                        <input type="text" :name="'experiences['+index+'][job_title]'" placeholder="e.g. Senior Developer" class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Employer</label>
                                        <input type="text" :name="'experiences['+index+'][employer]'" placeholder="e.g. Acme Corp" class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Start Date</label>
                                        <input type="date" :name="'experiences['+index+'][start_date]'" class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm text-slate-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">End Date</label>
                                        <input type="date" :name="'experiences['+index+'][end_date]'" class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm text-slate-500">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Description</label>
                                    <div class="relative">
                                        <textarea x-model="experiences[index].description" :name="'experiences['+index+'][description]'" rows="3" class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="• Led a team of 5 developers..."></textarea>
                                        
                                        <button type="button" 
                                                @click="rewriteExperience(index)"
                                                :disabled="experiences[index].isRewriting"
                                                class="absolute bottom-3 right-3 p-1.5 bg-indigo-50 text-indigo-600 rounded-md hover:bg-indigo-100 transition disabled:opacity-50" 
                                                title="Use AI to rewrite">
                                            
                                            <i x-show="!experiences[index].isRewriting" data-lucide="wand-2" class="w-4 h-4"></i>
                                            
                                            <svg x-show="experiences[index].isRewriting" class="animate-spin h-4 w-4 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <button type="button" @click="addExperience()" class="w-full py-4 border-2 border-dashed border-slate-300 rounded-2xl text-slate-500 font-semibold hover:border-indigo-400 hover:text-indigo-600 hover:bg-indigo-50 transition flex items-center justify-center gap-2">
                            <i data-lucide="plus-circle" class="w-5 h-5"></i> Add Position
                        </button>
                    </div>
                </div>

                <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                    <div class="p-8 bg-slate-50/50 min-h-[400px]">
                        <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <i data-lucide="graduation-cap" class="w-6 h-6 text-indigo-500"></i>
                            Education
                        </h3>

                        <template x-for="(edu, index) in education" :key="edu.id">
                            <div class="mb-6 bg-white p-6 rounded-2xl shadow-sm border border-slate-200 relative group hover:border-indigo-300 transition">
                                <button type="button" @click="removeEducation(index)" class="absolute top-4 right-4 text-slate-300 hover:text-rose-500 transition" x-show="education.length > 0">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Institution</label>
                                        <input type="text" :name="'education['+index+'][institution]'" placeholder="e.g. University of Technology" class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Degree / Certificate</label>
                                        <input type="text" :name="'education['+index+'][degree]'" placeholder="e.g. B.Sc. Computer Science" class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">City</label>
                                        <input type="text" :name="'education['+index+'][city]'" placeholder="New York, NY" class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Completion Date</label>
                                        <input type="date" :name="'education['+index+'][end_date]'" class="w-full rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm text-slate-500">
                                    </div>
                                </div>
                            </div>
                        </template>

                        <button type="button" @click="addEducation()" class="w-full py-4 border-2 border-dashed border-slate-300 rounded-2xl text-slate-500 font-semibold hover:border-indigo-400 hover:text-indigo-600 hover:bg-indigo-50 transition flex items-center justify-center gap-2">
                            <i data-lucide="plus-circle" class="w-5 h-5"></i> Add Education
                        </button>
                    </div>
                </div>

                <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <i data-lucide="cpu" class="w-6 h-6 text-indigo-500"></i>
                            Skills
                        </h3>

                        <div class="bg-indigo-50 p-4 rounded-xl mb-6 text-indigo-800 text-sm">
                            <p><strong>Tip:</strong> Add skills individually. These help the ATS (Applicant Tracking Systems) find your resume.</p>
                        </div>

                        <div class="space-y-3 mb-8">
                            <template x-for="(skill, index) in skills" :key="skill.id">
                                <div class="flex gap-3">
                                    <input type="text" :name="'skills['+index+'][name]'" placeholder="e.g. Python, Leadership, SEO" class="flex-1 rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500">
                                    <select :name="'skills['+index+'][level]'" class="rounded-lg border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-slate-600">
                                        <option value="beginner">Beginner</option>
                                        <option value="intermediate" selected>Intermediate</option>
                                        <option value="expert">Expert</option>
                                    </select>
                                    <button type="button" @click="removeSkill(index)" class="p-2 text-slate-400 hover:text-rose-500">
                                        <i data-lucide="x" class="w-5 h-5"></i>
                                    </button>
                                </div>
                            </template>
                        </div>

                        <button type="button" @click="addSkill()" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                            <i data-lucide="plus" class="w-4 h-4"></i> Add Another Skill
                        </button>
                    </div>
                </div>

                <div class="bg-slate-50 px-8 py-5 border-t border-slate-200 flex justify-between items-center">
                    <button type="button" x-show="step > 1" @click="step--" class="px-6 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-semibold hover:bg-slate-100 transition">
                        Back
                    </button>
                    <div x-show="step === 1"></div>
                    
                    <button type="button" x-show="step < 4" @click="step++" class="px-8 py-2.5 rounded-xl bg-indigo-600 text-white font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition transform flex items-center gap-2">
                        Next Step <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>

                    <button type="submit" x-show="step === 4" class="px-8 py-2.5 rounded-xl bg-emerald-600 text-white font-bold shadow-lg shadow-emerald-200 hover:bg-emerald-700 hover:-translate-y-0.5 transition transform flex items-center gap-2" style="display: none;">
                        <i data-lucide="check" class="w-4 h-4"></i> Create Resume
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('resumeWizard', () => ({
                step: 1,
                // Data Models
                summary: '',
                isRewritingSummary: false,
                
                // Init with empty description string for x-model binding
                experiences: [{ id: Date.now(), description: '', isRewriting: false }], 
                education: [{ id: Date.now() }],
                skills: [{ id: Date.now() }, { id: Date.now() + 1 }, { id: Date.now() + 2 }],

                // --- Experience Functions ---
                addExperience() {
                    this.experiences.push({ id: Date.now(), description: '', isRewriting: false });
                    this.$nextTick(() => lucide.createIcons());
                },
                removeExperience(index) {
                    this.experiences.splice(index, 1);
                },

                // --- AI Rewrite for Experience ---
                async rewriteExperience(index) {
                    const currentText = this.experiences[index].description;
                    
                    if (!currentText || currentText.length < 5) {
                        alert('Please write a few words first so the AI knows what to improve.');
                        return;
                    }

                    this.experiences[index].isRewriting = true;

                    try {
                        const response = await fetch('{{ route('ai.rewrite') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ text: currentText })
                        });

                        const data = await response.json();
                        if (data.content) {
                            this.experiences[index].description = data.content;
                        } else {
                            alert('AI Error: ' + (data.error || 'Unknown error'));
                        }
                    } catch (error) {
                        console.error(error);
                        alert('Connection failed.');
                    } finally {
                        this.experiences[index].isRewriting = false;
                    }
                },

                // --- AI Rewrite for Summary ---
                async rewriteSummary() {
                    if (!this.summary || this.summary.length < 5) {
                        alert('Please write a few words first.');
                        return;
                    }

                    this.isRewritingSummary = true;

                    try {
                        const response = await fetch('{{ route('ai.rewrite') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ text: this.summary })
                        });

                        const data = await response.json();
                        if (data.content) {
                            this.summary = data.content;
                        }
                    } catch (error) {
                        console.error(error);
                        alert('Connection failed.');
                    } finally {
                        this.isRewritingSummary = false;
                    }
                },

                // --- Education Functions ---
                addEducation() {
                    this.education.push({ id: Date.now() });
                    this.$nextTick(() => lucide.createIcons());
                },
                removeEducation(index) {
                    this.education.splice(index, 1);
                },

                // --- Skill Functions ---
                addSkill() {
                    this.skills.push({ id: Date.now() });
                    this.$nextTick(() => lucide.createIcons());
                },
                removeSkill(index) {
                    this.skills.splice(index, 1);
                }
            }));
        });
    </script>
</x-app-layout>