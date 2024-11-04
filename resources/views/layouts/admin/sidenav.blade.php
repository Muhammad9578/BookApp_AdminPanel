<div class="sidenav py-5 bg-info" style = "position:fixed; z-index:1000; left:0; top:0; height:100%; width:228px;">

    <div class="row justify-content-center m-0">
        <div class="col-md-8 text-white text-center">
            <a href="">
                <img src="{{ asset('img/admin.png') }}" class="img-fluid rounded-circle mb-3">
            </a>
            <h5><a href="" style = "color:white; text-decoration:none; font-size:12px;">{{ Auth::user()->name }}</a></h5>
        </div>
    </div>

    <hr class="bg-white" />

    <ul class="nav flex-column ml-4">

        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('all_users.index') }}">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('chapters.index') }}">Chapters</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('poems.index') }}">Poems</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('plays.index') }}">Plays</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('quizzes.index') }}">Lesson Quiz</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('poem_quiz.index') }}">Poem Quiz</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('play_quiz.index') }}">Play Quiz</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('results.index') }}">Lesson Results</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('poem_results.index') }}">Poem Results</a>
        </li> 
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('play_results.index') }}">Play Results</a>
        </li>       
        
    </ul>
</div>
