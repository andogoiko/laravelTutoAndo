<!-- es lo mismo que ?php echo -->
    <!-- <h1><?= e($title) ?></h1> 
         <ul>
         <?php foreach ($users as $user) : ?>
             <li><?php echo e($user) ?></li>
         <?php endforeach; ?>
         </ul>
    -->

    <h1>{{ $title }}</h1>

    <hr>

    <!--@if(!empty($users))

        <ul>
            @foreach ($users as $user)
                <li>{{ $user }}</li>
            @endforeach
        </ul>

    @else

    <p>no hay usuarios registrados</p>
        
    @endif -->