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
            padding: 20px;
        }
        .container {
            max-width: 480px;
            width: 100%;
            padding: 35px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 25px;
        }
        .logo h1 {
            font-size: 1.6rem;
            background: linear-gradient(to right, #f39c12, #e74c3c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .content h2 {
            font-size: 1.3rem;
            margin-bottom: 8px;
            text-align: center;
        }
        .content > p {
            text-align: center;
            color: rgba(255,255,255,0.6);
            font-size: 0.9rem;
            margin-bottom: 25px;
        }
        .info-box {
            background: rgba(255, 255, 255, 0.06);
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .info-box h4 {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(255,255,255,0.5);
            margin-bottom: 12px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            padding: 6px 0;
        }
        .info-row:not(:last-child) {
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .info-row .label {
            color: rgba(255,255,255,0.5);
        }
        .info-row .value {
            color: #fff;
            font-weight: 500;
        }
        .btn {
            display: inline-block;
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, #f39c12, #e74c3c);
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-align: center;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(243, 156, 18, 0.4);
        }
        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            box-shadow: none;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .btn-group .btn {
            flex: 1;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            color: rgba(255,255,255,0.8);
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.06);
            color: #fff;
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }
        .form-group input::placeholder {
            color: rgba(255,255,255,0.3);
        }
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #f39c12;
            background: rgba(255, 255, 255, 0.1);
        }
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 0.9rem;
        }
        .alert-danger {
            background: rgba(231, 76, 60, 0.2);
            border: 1px solid rgba(231, 76, 60, 0.4);
            color: #ff6b6b;
        }
        .alert-success {
            background: rgba(46, 204, 113, 0.2);
            border: 1px solid rgba(46, 204, 113, 0.4);
            color: #2ecc71;
        }
        .steps {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
            gap: 8px;
        }
        .step {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.5);
        }
        .step.active {
            background: linear-gradient(135deg, #f39c12, #e74c3c);
            color: #fff;
        }
        .step.completed {
            background: #2ecc71;
            color: #fff;
        }
        .icon-error {
            text-align: center;
            margin-bottom: 20px;
        }
        .icon-error svg {
            width: 60px;
            height: 60px;
        }
        .display-field {
            background: rgba(0,0,0,0.2);
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 0.95rem;
            color: #fff;
            margin-top: 6px;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container">
        <div class="logo">
            <h1>Dragon License</h1>
        </div>
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>
