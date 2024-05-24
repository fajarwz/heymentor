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
        @auth
            <ul class="flex flex-row gap-x-3">
                <li class="flex flex-row">
                    <div class="my-auto">
                        {{ 'Hi, ' . auth()->user()->name . '!' }}
                    </div>
                </li>
                <li class="flex flex-row">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="d-inline bg-slate-300 px-8 py-4 text-base font-semibold">
                            Sign Out
                        </button>
                    </form>
                </li>
            </ul>
        @else
            @if (Route::currentRouteName() !== 'sign-in' && Route::currentRouteName() !== 'sign-up')
                <ul class="flex flex-row gap-x-3">
                    <li>
                        <a href="{{ route('sign-in') }}" class="bg-slate-300 px-8 py-4 text-base font-semibold">
                            Sign In
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sign-up') }}" class="bg-slate-300 px-8 py-4 text-base font-semibold">
                            Sign Up
                        </a>
                    </li>
                </ul>
            @endif
        @endauth
    </div>
</nav>