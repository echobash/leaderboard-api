@extends('layouts.app')

@section('content')
    <div class="leaderboard-container">
        <h1 class="title">🏆 Leaderboard 🏆</h1>

        @if($winner)
            <h2 class="winner">🎉 Current Winner: {{ $winner->user->name }} with {{ $winner->points }} points! 🎉</h2>
        @endif

        <table class="leaderboard-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Points</th>
                    <th>QR Code</th>
                    <th>Actions</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="{{ $winner && $winner->user_id == $user->id ? 'highlight-winner' : '' }}">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->points }} pts</td>
                        <td>
                            <img src="{{ asset('storage/qrcodes/' . $user->id . '.png') }}" width="50" class="qr-code">
                        </td>
                        <td>
                            <form action="/users/{{ $user->id }}/points" method="post" class="action-buttons">
                                @csrf
                                <button class="btn increase" name="increment" value="1">+</button>
                                <button class="btn decrease" name="increment" value="0">-</button>
                            </form>
                        </td>
                        <td>
                            <form action="/users/{{ $user->id }}" method="post">
                                @csrf @method('DELETE')
                                <button class="btn delete">X</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="/users" method="post" class="user-form">
            @csrf
            <input type="text" name="name" placeholder="Name" required>
            <input type="number" name="age" placeholder="Age" required>
            <input type="text" name="address" placeholder="Address" required>
            <button class="btn add-user">Add User</button>
        </form>
    </div>

    <style>
        .leaderboard-container {
            max-width: 800px;
            margin: auto;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .title {
            color: #222;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .winner {
            color: #4CAF50;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .leaderboard-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .leaderboard-table th, .leaderboard-table td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .leaderboard-table th {
            background-color: #f4f4f4;
        }

        .qr-code {
            border-radius: 5px;
        }

        .highlight-winner {
            background-color: #c8e6c9;
            font-weight: bold;
        }

        .btn {
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 1rem;
            margin: 3px;
            border-radius: 4px;
        }

        .increase {
            background-color: #4CAF50;
            color: white;
        }

        .decrease {
            background-color: #f44336;
            color: white;
        }

        .delete {
            background-color: #ff5722;
            color: white;
        }

        .add-user {
            background-color: #2196F3;
            color: white;
            padding: 8px 15px;
        }

        .user-form {
            margin-top: 20px;
        }

        .user-form input {
            padding: 8px;
            margin: 5px;
            width: 200px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
@endsection
