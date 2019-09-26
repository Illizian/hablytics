@extends('layouts.app')

@section('title')
    Admin Area
@endsection

@section('content')
    @component('components/card')
        <table class="text-left w-full border-collapse">
          <thead>
            <tr>
              <th class="p-2 bg-gray-100 font-bold uppercase text-sm text-gray-700 border-b border-gray-300">User</th>
              <th class="p-2 bg-gray-100 font-bold uppercase text-sm text-gray-700 border-b border-gray-300">Stats</th>
              <th class="p-2 bg-gray-100 font-bold uppercase text-sm text-gray-700 border-b border-gray-300">Actions</th>
            </tr>
          </thead>
          <tbody>
            @each('components/user', $users, 'user')
          </tbody>
        </table>
        <table>
    @endcomponent
@endsection
