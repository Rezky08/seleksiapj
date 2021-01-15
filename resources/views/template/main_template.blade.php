@extends('template.template')
@include('template.navbar')
@include('template.sidebar')

@section('title', $title)
    @push('content')
        @section('navbar')
        @show

        <div class="columns my-3">
            {{-- sidebar --}}
            <div class="column is-one-fifth">
                <div class="container px-3">
                    @stack('sidebar')
                </div>
            </div>
            {{-- main --}}
            <div class="column">

                <div class="block">
                    <span class="has-text-weight-bold is-size-3">{{ ucwords($title) }}</span>
                </div>

                <div class="container">
                    @if (Session::has('error'))
                        <div class="notification is-danger">
                            <button class="delete"></button>
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="notification is-success">
                            <button class="delete"></button>
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @stack('main')
                </div>
            </div>
        </div>
    @endpush
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                    var $notification = $delete.parentNode;

                    $delete.addEventListener('click', () => {
                        $notification.parentNode.removeChild($notification);
                    });
                });
            });

        </script>
    @endpush
