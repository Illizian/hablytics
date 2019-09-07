@extends('layouts.app')

@section('title')
    Diaries
@endsection

@section('content')
    @each('components/diary', $diaries, 'diary')
@endsection
