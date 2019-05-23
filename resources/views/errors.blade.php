@if ($errors->any())
        <div class="errors-container">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
                @endforeach
            </ul>
       </div>     
@endif