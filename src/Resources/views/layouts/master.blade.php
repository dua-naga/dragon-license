<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dragon License')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .container {
            max-width: 600px;
            width: 90%;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo h1 {
            font-size: 2rem;
            background: linear-gradient(to right, #f39c12, #e74c3c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .content {
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(to right, #f39c12, #e74c3c);
            color: #fff;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(243, 156, 18, 0.4);
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 1rem;
        }
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #f39c12;
        }
        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .alert-danger {
            background: rgba(231, 76, 60, 0.3);
            border: 1px solid rgba(231, 76, 60, 0.5);
        }
        .alert-success {
            background: rgba(46, 204, 113, 0.3);
            border: 1px solid rgba(46, 204, 113, 0.5);
        }
        .steps {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        .step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            font-weight: 600;
        }
        .step.active {
            background: linear-gradient(to right, #f39c12, #e74c3c);
        }
        .step.completed {
            background: #2ecc71;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container">
        <div class="logo">
            <h1>🐉 Dragon License</h1>
        </div>
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>
