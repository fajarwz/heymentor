<nav class="max-w-6xl mx-auto py-8">
    <div class="flex flex-row justify-between items-center">
        <a href="{{ route('home') }}">
            <h3 class="text-2xl text-indigo-950 font-bold">
                HeyMentor
            </h3>
        </a>
        <ul class="flex flex-row gap-x-8">
            <li><a href="{{ route('home') }}">
                    Home
                </a></li>
            <li><a href="#">
                    Browse
                </a></li>
            <li><a href="#">
                    Popular
                </a></li>
            <li><a href="#">
                    Course
                </a></li>
            <li><a href="#">
                    Stories
                </a></li>
        </ul>
        <ul class="flex flex-row gap-x-3">
            <li><a href="{{ route('login') }}" class="bg-slate-300 px-8 py-4 text-base font-semibold">
                    Login
                </a></li>
            <li><a href="{{ route('register') }}" class="bg-slate-300 px-8 py-4 text-base font-semibold">
                    Register
                </a></li>
        </ul>
    </div>
</nav>