@include('partials.front')

<div class="container">
    <div class="section">

        
        <div class="row">
        <div class="col s12 center">
            <h2>
                Certificate
            </h2>
        </div>
        </div>
        
    <h3>User: {{ $course[0]->name }}</h3>
    <h3>Course: {{ $course[0]->title }}</h3>