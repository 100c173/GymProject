@extends('/dashboard/manager/layout')
@section('content')

<br><br>
<style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Georgia', serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form Container Styling */
        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            border: 1px solid #ccc;
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
            font-size: 28px;
            text-transform: uppercase;
            border-bottom: 2px solid #7f8c8d;
            padding-bottom: 10px;
        }

        /* Form Group Styling */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            color: #34495e;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.2);
        }

        /* Submit Button Styling */
        .submit-btn {
            width: 100%;
            background-color: #3498db;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .submit-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .submit-btn:active {
            transform: translateY(1px);
        }

    </style>
    <div class="form-container">
        <h1>Edit Session</h1>
        <form action="{{route('sessions.update',$session->id)}}" method="POST">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{$session->name}}">
            </div>

            <div class="form-group">
                <label for="name">Date</label>
                <input type="text" name="date" value="{{$session->times->first()->day}}">
            </div>

            <div class="form-group">
                <label for="name">Start Time</label>
                <input type="text" name="start_time" value="{{$session->times->first()->start_time}}">
            </div>

            <div class="form-group">
                <label for="name">End Time</label>
                <input type="text" name="end_time" value="{{$session->times->first()->end_time}}">
            </div>

            <div class="form-group">
                <label for="name">Session status</label>
                <input type="text" name="end_time" value="">
            </div>


            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Save</button>
        </form>

@endsection