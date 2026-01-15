
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Resume - Build Your Career with Intelligence</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .bg-gradient-main { background: radial-gradient(circle at top right, #f3e8ff 0%, #ffffff 50%, #e0e7ff 100%); }
        .hover-lift { transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .hover-lift:hover { transform: translateY(-8px); }
        .shimmer { position: relative; overflow: hidden; }
        .shimmer::after {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
            transform: rotate(45deg); animation: shimmer 3s infinite;
        }
        @keyframes shimmer { 0% { margin-left: -100%; } 100% { margin-left: 100%; } }
    </style>
</head>
<body class="bg-gradient-main text-slate-900 overflow-x-hidden">

    <nav class="fixed top-0 w-full z-50 glass py-4">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="p-2 bg-indigo-600 rounded-lg text-white">
                    <i data-lucide="sparkles" class="w-6 h-6"></i>
                </div>
                <span class="text-xl font-bold tracking-tight text-indigo-950">AI Resume</span>
            </div>
            <div class="hidden md:flex gap-8 text-sm font-medium text-slate-600">
                <a href="#features" class="hover:text-indigo-600 transition">Features</a>
                <a href="#templates" class="hover:text-indigo-600 transition">Templates</a>
                <a href="#pricing" class="hover:text-indigo-600 transition">Pricing</a>
            </div>
            <div class="flex items-center gap-4">
                <button class="text-sm font-semibold hover:text-indigo-600"><a href="{{ route('login') }}">Login</a></button>
                <button class="bg-indigo-600 text-white px-5 py-2.5 rounded-full text-sm font-semibold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition transform hover:scale-105">
                    Start Building
                </button>
            </div>
        </div>
    </nav>

    <section class="pt-32 pb-20 px-6">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-flex items-center gap-2 bg-indigo-50 text-indigo-700 px-4 py-1.5 rounded-full text-sm font-medium mb-6">
                    <i data-lucide="zap" class="w-4 h-4 fill-indigo-500"></i> Trusted by 50k+ Job Seekers
                </div>
                <h1 class="text-6xl md:text-7xl font-extrabold tracking-tight leading-[1.1] mb-6">
                    Build Your Resume with <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">AI in Minutes</span>
                </h1>
                <p class="text-lg text-slate-600 mb-10 max-w-lg leading-relaxed">
                    Smart, fast, and ATS-friendly resumes that help you land interviews. Let our AI write the perfect bullet points for you.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <button class="bg-indigo-600 text-white px-8 py-4 rounded-xl font-bold shadow-xl shadow-indigo-200 hover:bg-indigo-700 transition shimmer">
                        Create Resume Free
                    </button>
                    <button class="flex items-center justify-center gap-2 px-8 py-4 rounded-xl font-bold border-2 border-slate-200 hover:bg-white transition">
                        <i data-lucide="layout-template" class="w-5 h-5"></i> See Templates
                    </button>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -top-10 -left-10 w-64 h-64 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
                <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
                <div class="relative glass rounded-3xl p-4 shadow-2xl border-indigo-100 transform rotate-2">
                    <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?auto=format&fit=crop&w=800&q=80" alt="Resume App Preview" class="rounded-2xl shadow-inner">
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white/50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">How It Works</h2>
                <div class="h-1.5 w-20 bg-indigo-600 mx-auto rounded-full"></div>
            </div>
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                        <i data-lucide="user-plus" class="w-8 h-8"></i>
                    </div>
                    <h3 class="font-bold mb-2 text-lg">Enter Details</h3>
                    <p class="text-slate-500 text-sm">Fill in your education and work experience.</p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300">
                        <i data-lucide="palette" class="w-8 h-8"></i>
                    </div>
                    <h3 class="font-bold mb-2 text-lg">Choose Template</h3>
                    <p class="text-slate-500 text-sm">Select from dozens of professional designs.</p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <i data-lucide="cpu" class="w-8 h-8"></i>
                    </div>
                    <h3 class="font-bold mb-2 text-lg">AI Enhances Content</h3>
                    <p class="text-slate-500 text-sm">AI rewrites your bullet points for impact.</p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-teal-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-teal-600 group-hover:text-white transition-all duration-300">
                        <i data-lucide="download" class="w-8 h-8"></i>
                    </div>
                    <h3 class="font-bold mb-2 text-lg">Download Resume</h3>
                    <p class="text-slate-500 text-sm">Export to PDF or Word in one click.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="mb-16">
                <h2 class="text-4xl font-bold mb-4">Supercharged Features</h2>
                <p class="text-slate-500">Everything you need to beat the competition.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="glass p-8 rounded-3xl hover-lift border-indigo-50">
                    <div class="p-3 bg-indigo-50 rounded-xl w-fit mb-6 text-indigo-600">
                        <i data-lucide="pen-tool" class="w-6 h-6 fill-indigo-100"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">AI Writing Assistant</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Let AI handle the writer's block. Generates powerful verbs and metrics.</p>
                </div>
                <div class="glass p-8 rounded-3xl hover-lift border-indigo-50">
                    <div class="p-3 bg-purple-50 rounded-xl w-fit mb-6 text-purple-600">
                        <i data-lucide="shield-check" class="w-6 h-6 fill-purple-100"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">ATS Optimization</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Pass the robot screeners with keyword-optimized content automatically.</p>
                </div>
                <div class="glass p-8 rounded-3xl hover-lift border-indigo-50">
                    <div class="p-3 bg-blue-50 rounded-xl w-fit mb-6 text-blue-600">
                        <i data-lucide="layout" class="w-6 h-6 fill-blue-100"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Multiple Templates</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Choose between Creative, Modern, or Classic designs for any industry.</p>
                </div>
                <div class="glass p-8 rounded-3xl hover-lift border-indigo-50">
                    <div class="p-3 bg-emerald-50 rounded-xl w-fit mb-6 text-emerald-600">
                        <i data-lucide="eye" class="w-6 h-6 fill-emerald-100"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Real-time Preview</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">See changes instantly as you type with our side-by-side live editor.</p>
                </div>
                <div class="glass p-8 rounded-3xl hover-lift border-indigo-50">
                    <div class="p-3 bg-orange-50 rounded-xl w-fit mb-6 text-orange-600">
                        <i data-lucide="file-text" class="w-6 h-6 fill-orange-100"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Cover Letter Gen</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Generate a matching cover letter that aligns with your resume perfectly.</p>
                </div>
                <div class="glass p-8 rounded-3xl hover-lift border-indigo-50">
                    <div class="p-3 bg-rose-50 rounded-xl w-fit mb-6 text-rose-600">
                        <i data-lucide="gauge" class="w-6 h-6 fill-rose-100"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Resume Score</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Get a real-time score based on best practices and job descriptions.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-900 text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl font-bold mb-6">Interactive AI Editor</h2>
                <p class="text-slate-400 mb-8">Our editor is designed to be as simple as filling out a form. Watch as the AI transforms your basic input into professional highlights.</p>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 bg-slate-800 p-4 rounded-2xl border border-slate-700">
                        <div class="w-10 h-10 rounded-full bg-indigo-500/20 flex items-center justify-center text-indigo-400">
                            <i data-lucide="check" class="w-5 h-5"></i>
                        </div>
                        <p class="font-medium">Auto-Formatting & Page Layout</p>
                    </div>
                    <div class="flex items-center gap-4 bg-slate-800 p-4 rounded-2xl border border-slate-700">
                        <div class="w-10 h-10 rounded-full bg-purple-500/20 flex items-center justify-center text-purple-400">
                            <i data-lucide="check" class="w-5 h-5"></i>
                        </div>
                        <p class="font-medium">One-Click AI Rewrite</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="bg-white rounded-2xl shadow-2xl p-6 text-slate-800 flex gap-4">
                    <div class="w-1/3 border-r border-slate-100 pr-4 hidden sm:block">
                        <div class="w-full h-4 bg-slate-100 rounded mb-4"></div>
                        <div class="space-y-2">
                            <div class="w-full h-2 bg-slate-50 rounded"></div>
                            <div class="w-3/4 h-2 bg-slate-50 rounded"></div>
                            <div class="w-5/6 h-2 bg-slate-50 rounded"></div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-8 h-8 rounded bg-indigo-600"></div>
                            <div class="h-4 w-32 bg-slate-200 rounded"></div>
                        </div>
                        <div class="space-y-4">
                            <div class="h-32 bg-indigo-50 rounded-xl border-2 border-dashed border-indigo-200 p-4 flex flex-col justify-center">
                                <div class="h-2 w-1/2 bg-indigo-200 rounded mb-2"></div>
                                <div class="h-2 w-full bg-indigo-100 rounded mb-2"></div>
                                <div class="h-2 w-3/4 bg-indigo-100 rounded"></div>
                            </div>
                            <button class="w-full py-2 bg-indigo-600 text-white rounded-lg text-xs font-bold flex items-center justify-center gap-2">
                                <i data-lucide="wand-2" class="w-3 h-3"></i> AI Rewrite
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="templates" class="py-24 px-6">
        <div class="max-w-7xl mx-auto text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Professional Templates</h2>
            <p class="text-slate-500 max-w-xl mx-auto">Expertly crafted designs that meet industry standards.</p>
        </div>
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="relative group overflow-hidden rounded-2xl shadow-xl hover-lift">
                <img src="https://images.unsplash.com/photo-1544652478-6653e09f18a2?auto=format&fit=crop&w=400&q=80" alt="Modern" class="w-full h-80 object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-indigo-950 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition flex items-end justify-center pb-8">
                    <button class="bg-white text-indigo-900 px-6 py-2 rounded-full font-bold">Use This Template</button>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-2xl shadow-xl hover-lift">
                <img src="https://images.unsplash.com/photo-1544652478-6653e09f18a2?auto=format&fit=crop&w=400&q=80" alt="Classic" class="w-full h-80 object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-indigo-950 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition flex items-end justify-center pb-8">
                    <button class="bg-white text-indigo-900 px-6 py-2 rounded-full font-bold">Use This Template</button>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-2xl shadow-xl hover-lift">
                <img src="https://images.unsplash.com/photo-1544652478-6653e09f18a2?auto=format&fit=crop&w=400&q=80" alt="Executive" class="w-full h-80 object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-indigo-950 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition flex items-end justify-center pb-8">
                    <button class="bg-white text-indigo-900 px-6 py-2 rounded-full font-bold">Use This Template</button>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-2xl shadow-xl hover-lift">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=400&q=80" alt="Creative" class="w-full h-80 object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-indigo-950 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition flex items-end justify-center pb-8">
                    <button class="bg-white text-indigo-900 px-6 py-2 rounded-full font-bold">Use This Template</button>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white/50">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12">
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                    <h4 class="text-xl font-bold mb-6 text-slate-400">Traditional Way</h4>
                    <ul class="space-y-4">
                        <li class="flex gap-3 text-slate-400">
                            <i data-lucide="x-circle" class="w-5 h-5 text-red-300"></i> Messy Word templates
                        </li>
                        <li class="flex gap-3 text-slate-400">
                            <i data-lucide="x-circle" class="w-5 h-5 text-red-300"></i> Hours of formatting
                        </li>
                        <li class="flex gap-3 text-slate-400">
                            <i data-lucide="x-circle" class="w-5 h-5 text-red-300"></i> Manual keyword research
                        </li>
                    </ul>
                </div>
                <div class="bg-indigo-600 p-8 rounded-3xl shadow-2xl shadow-indigo-200">
                    <h4 class="text-xl font-bold mb-6 text-indigo-200">AI Resume Way</h4>
                    <ul class="space-y-4">
                        <li class="flex gap-3 text-white">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-indigo-300"></i> Auto-formatted for ATS
                        </li>
                        <li class="flex gap-3 text-white">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-indigo-300"></i> Done in under 5 minutes
                        </li>
                        <li class="flex gap-3 text-white">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-indigo-300"></i> Real-time AI optimizations
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing" class="py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Simple, Transparent Pricing</h2>
                <p class="text-slate-500">Start for free, upgrade when you're ready.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass p-10 rounded-3xl border-slate-200 flex flex-col">
                    <h3 class="font-bold text-xl mb-2">Starter</h3>
                    <p class="text-slate-500 mb-6">Perfect for testing</p>
                    <div class="text-4xl font-extrabold mb-8">$0<span class="text-lg font-medium text-slate-400">/mo</span></div>
                    <ul class="space-y-4 mb-10 flex-grow text-sm">
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-emerald-500"></i> 1 AI Resume</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-emerald-500"></i> Basic Templates</li>
                        <li class="flex items-center gap-3"><i data-lucide="x" class="w-4 h-4 text-slate-300"></i> Cover Letter Gen</li>
                    </ul>
                    <button class="w-full py-3 rounded-xl border-2 border-slate-200 font-bold hover:bg-slate-50 transition">Get Started</button>
                </div>
                <div class="bg-indigo-600 p-10 rounded-3xl shadow-2xl text-white transform scale-105 relative overflow-hidden flex flex-col">
                    <div class="absolute top-4 right-4 bg-white/20 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Most Popular</div>
                    <h3 class="font-bold text-xl mb-2">Professional</h3>
                    <p class="text-indigo-200 mb-6">Best for job seekers</p>
                    <div class="text-4xl font-extrabold mb-8">$12<span class="text-lg font-medium text-indigo-300">/mo</span></div>
                    <ul class="space-y-4 mb-10 flex-grow text-sm">
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-indigo-300"></i> Unlimited Resumes</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-indigo-300"></i> Premium AI Writer</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-indigo-300"></i> Cover Letter Generator</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-indigo-300"></i> No Watermark</li>
                    </ul>
                    <button class="w-full py-3 rounded-xl bg-white text-indigo-600 font-bold shadow-lg hover:bg-slate-50 transition">Start Free Trial</button>
                </div>
                <div class="glass p-10 rounded-3xl border-slate-200 flex flex-col">
                    <h3 class="font-bold text-xl mb-2">Agency</h3>
                    <p class="text-slate-500 mb-6">For career coaches</p>
                    <div class="text-4xl font-extrabold mb-8">$49<span class="text-lg font-medium text-slate-400">/mo</span></div>
                    <ul class="space-y-4 mb-10 flex-grow text-sm">
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-emerald-500"></i> Up to 10 Users</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-emerald-500"></i> White-labeling</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-emerald-500"></i> Priority Support</li>
                    </ul>
                    <button class="w-full py-3 rounded-xl border-2 border-slate-200 font-bold hover:bg-slate-50 transition">Contact Sales</button>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white/30 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass p-8 rounded-3xl">
                    <div class="flex gap-1 text-orange-400 mb-4">
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                    </div>
                    <p class="italic text-slate-600 mb-6 text-sm leading-relaxed">"I landed my dream job at Google! The AI rewrite tool fixed bullet points I'd been struggling with for weeks."</p>
                    <div class="flex items-center gap-3">
                        <img src="https://i.pravatar.cc/100?u=1" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                        <div>
                            <div class="font-bold text-sm">Alex Rivera</div>
                            <div class="text-xs text-slate-400">Software Engineer</div>
                        </div>
                    </div>
                </div>
                <div class="glass p-8 rounded-3xl">
                    <div class="flex gap-1 text-orange-400 mb-4">
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                    </div>
                    <p class="italic text-slate-600 mb-6 text-sm leading-relaxed">"The ATS-friendly designs are amazing. I started getting calls from recruiters within 48 hours of updating."</p>
                    <div class="flex items-center gap-3">
                        <img src="https://i.pravatar.cc/100?u=2" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                        <div>
                            <div class="font-bold text-sm">Sarah Jenkins</div>
                            <div class="text-xs text-slate-400">Marketing Manager</div>
                        </div>
                    </div>
                </div>
                <div class="glass p-8 rounded-3xl">
                    <div class="flex gap-1 text-orange-400 mb-4">
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-orange-400"></i>
                    </div>
                    <p class="italic text-slate-600 mb-6 text-sm leading-relaxed">"Simple, elegant, and powerful. It’s like having a career coach and a designer in your pocket."</p>
                    <div class="flex items-center gap-3">
                        <img src="https://i.pravatar.cc/100?u=3" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                        <div>
                            <div class="font-bold text-sm">Marcus Thorne</div>
                            <div class="text-xs text-slate-400">Product Designer</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 px-6">
        <div class="max-w-5xl mx-auto glass rounded-[3rem] p-12 text-center bg-gradient-to-br from-indigo-600 to-purple-700 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 p-20 bg-white/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
            <h2 class="text-4xl md:text-5xl font-extrabold mb-8 relative z-10">Start Building Your Resume Today</h2>
            <button class="relative z-10 bg-white text-indigo-600 px-10 py-5 rounded-2xl font-black text-xl shadow-2xl hover:scale-105 transition-transform duration-300">
                Get Started For Free
            </button>
        </div>
    </section>

    <footer class="py-20 px-6 border-t border-slate-200">
        <div class="max-w-7xl mx-auto grid md:grid-cols-4 gap-12">
            <div>
                <div class="flex items-center gap-2 mb-6">
                    <div class="p-2 bg-indigo-600 rounded-lg text-white">
                        <i data-lucide="sparkles" class="w-6 h-6"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-indigo-950">AI Resume</span>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed">Making job hunting easier with artificial intelligence. Join over 50,000 successful applicants.</p>
            </div>
            <div>
                <h5 class="font-bold mb-6">Product</h5>
                <ul class="space-y-4 text-slate-500 text-sm">
                    <li><a href="#" class="hover:text-indigo-600">Features</a></li>
                    <li><a href="#" class="hover:text-indigo-600">Templates</a></li>
                    <li><a href="#" class="hover:text-indigo-600">Resume Score</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold mb-6">Support</h5>
                <ul class="space-y-4 text-slate-500 text-sm">
                    <li><a href="#" class="hover:text-indigo-600">Help Center</a></li>
                    <li><a href="#" class="hover:text-indigo-600">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-indigo-600">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold mb-6">Newsletter</h5>
                <div class="flex gap-2">
                    <input type="email" placeholder="Email" class="bg-slate-100 px-4 py-2 rounded-lg text-sm w-full outline-none focus:ring-2 ring-indigo-200">
                    <button class="bg-indigo-600 text-white p-2 rounded-lg"><i data-lucide="send" class="w-4 h-4"></i></button>
                </div>
                <div class="flex gap-4 mt-6 text-slate-400">
                    <i data-lucide="twitter" class="w-5 h-5 hover:text-indigo-500 cursor-pointer transition"></i>
                    <i data-lucide="linkedin" class="w-5 h-5 hover:text-indigo-500 cursor-pointer transition"></i>
                    <i data-lucide="github" class="w-5 h-5 hover:text-indigo-500 cursor-pointer transition"></i>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-20 text-center text-slate-400 text-xs">
            © 2026 AI Resume Builder Inc. All rights reserved.
        </div>
    </footer>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>