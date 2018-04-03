@extends('layouts.display')
@section('recursive')
    <h1>All Categories printed using recursion</h1>

    @if(count($categ) > 0)
    <ul>
        <?php
        foreach ($categ as $c) {
            echo  $c;
        }
        ?>
    </ul>
    @endif
@endsection

@section('iterative')
    <h1>All Categories printed using iteration</h1>
    @if(count($categ2) > 0)
        <ul>
            <?php
            foreach ($categ2 as $c) {
                echo  $c;
            }
            ?>
        </ul>
    @endif

@endsection

@section('sidebar')

@endsection
